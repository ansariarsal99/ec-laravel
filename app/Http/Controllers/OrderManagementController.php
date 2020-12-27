<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Auth;
use Crypt;
use Exception;
use DataTables;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\ProductOrderStatus;
use App\Product;
use App\productOrderRefund;
use App\User;
use App\Admin;

class OrderManagementController extends Controller
{
    
      ///////////////////////Refund Order list///////////////////////////////
        
      public function refundOrderApprovalList(Request $request)
          {
           // try{   

          			 	$refundOrderList = OrderItem::with('Order')->leftjoin('products','order_item.product_id','products.id')
           	                      			->leftjoin('orders','order_item.order_id','orders.id')
           	                      			->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
           	                      			->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
           	                      			->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus')
           	                      			->orderBy('id','desc')
           	                      			->where('product_order_status_id',5)
           	                      			->get(); 

           	            // dd($refundOrderList);         
       
                 $page = 'order-refund';
                 return view('admin.orderManagement.redundApproval', compact('page'));
              // }catch (Exception $e) {
              //     \Log::error($e->getMessage());
              //     Session::flash('error',trans('messages.frontend.common_error'));
              //     return redirect()->back();

              // }
          }



     // productOrderRefund
      public function refundOrderApprovalListIndex(Request $request)
       {
              $refundOrderList   = OrderItem::with('Order')->leftjoin('products','order_item.product_id','products.id')
                                    ->leftjoin('orders','order_item.order_id','orders.id')
                                    ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                                    ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
                                    ->leftjoin('product_order_refunds as admin_refunds','order_item.admin_approved_product_order_refund_id','admin_refunds.id')
                                    ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','admin_refunds.name as approvedrefundStatus')
                                    ->orderBy('id','desc')
                                    ->where('product_order_status_id',5)
                                    ->where('product_order_refund_id','!=',null)
                                    ->get();               

               return DataTables::of($refundOrderList)
                    ->addIndexColumn()    

                    ->editColumn('product_order_refund_id', function ($refundOrderList) {
                       $vaccantSpace = '';
                       if(empty($refundOrderList->refundStatus)){
                         $vaccantSpace ='-';
                       }else{
                         $vaccantSpace = $refundOrderList->refundStatus;
                       }
                       return $vaccantSpace;

                    })  

                    ->editColumn('approvedrefundStatus', function ($refundOrderList) {
                       $vaccantSpace = '';
                       if(empty($refundOrderList->approvedrefundStatus)){
                         $vaccantSpace ='-';
                       }else{
                         $vaccantSpace = $refundOrderList->approvedrefundStatus;
                       }
                       return $vaccantSpace;

                    }) 

                    ->addColumn('action', function ($refundOrderList) {
                        
                       if($refundOrderList['refund_order_approved_by_admin']=='yes'){
                          $vaccantSpace ='-';
                          return $vaccantSpace;

                       }else{
                           return '<a href="javascript:void(0)" class="text-success changeOrderStatus" order_item_id="'.$refundOrderList->id.'" product_id="'.$refundOrderList->product_id.'" orderStatusId="'.$refundOrderList->product_order_refund_id.'" > Make Refund</a>';
                       }

                    })

                    ->escapeColumns([])
                    ->make(true);
       }    

    ////////////////////////////Make Refund///////////////////////
       public function updatedRefundStatusBySeller(Request $request)
          {
              $input           = $request->all();
              $productDetail   = OrderItem::where('product_order_refund_id',$input['refundStatusId'])->first();
              // dd($productDetail);
              $orderRefunds    = productOrderRefund::get();
              // dd($orderRefunds);
              $view            = view('frontend.elements.refundStatusBySeller',compact('orderRefunds','productDetail'))->render();
              return $view;
          }

         
       public function  changeRefundStatusByAdmin(Request $request)
          {
              $input   = $request->all();
              // dd($input);
              $productStatus  = productOrderRefund::where('id',$input['order_status_id'])->first();

              $oderItemStatus = OrderItem::where('id',$input['orderId'])->where('product_id',$input['productId'])                           ->update([
                                              'admin_approved_product_order_refund_id' =>  $productStatus['id'],
                                              'refund_order_approved_by_admin'=> 'yes'
                                            ]);

              if($input['order_status_id']==1){
                  $orderStatus ='Cancel Refund';
              }elseif($input['order_status_id']==2){
                  $orderStatus ='20% of the Order';
              }elseif($input['order_status_id']==3){
                  $orderStatus ='50% of the Order ';
              }elseif($input['order_status_id']==4){
                  $orderStatus ='70% of the Order';
              }else{
                  $orderStatus ='Full Refund';
              }

              $orderItemId   = OrderItem::where('id',$input['orderId'])->first();
              $itemRecord    = Order::where('id',$orderItemId['order_id'])->first();
              $productDetail = Product::where('id',$input['productId'])->first();
              $sellerDetail  = User::where('id',$productDetail['user_id'])->first();
              $UserDetail    = User::where('id',$itemRecord['user_id'])->first();
              // $adminDetail   = Admin::where('id',1)->first();

              ////////////Seller Email////////////////////
              $productRecord = Product::where('id',$input['productId'])->first();
              $sellerDetailRecord  = User::where('id',$productRecord['user_id'])->first();
               
              // dd($input);
             if (!empty($UserDetail['email'])) {
                   $email   = $UserDetail['email'];
                   $subject = PROJECT_NAME." Refund To User";
                   $links   = [];
                   $links['email']       = $email;
                   $links['buyer_name']  = $UserDetail['first_name'].' '.$UserDetail['last_name'];
                   $links['order_id']          = $itemRecord['invoice_id'];
                   $links['placed_on']         = $itemRecord['placed_on'];
                   $links['Product_name']      = $productDetail['item_name'];
                   $links['order_status_type'] = $orderStatus;

                   // if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){
                   
                      Mail::send('frontend.emails.refundApprovalEmailToAdmin',['order_id' => $links['order_id'],
                                                   'placed_on'          => $links['placed_on'],
                                                   'buyer_name'         => $links['buyer_name'],
                                                   'product_name'       => $links['Product_name'],
                                                   'order_status_type'  => $links['order_status_type'],
                                               ],function($message) use($email, $subject)
                         {
                             $message->to($email)->subject($subject);
                         });
                     // }
                      Session::flash('success',('Refund Status Email has been sent to User'));               
               }

              if (!empty($sellerDetailRecord['email'])) {
                 $email      = $sellerDetailRecord['email'];
                 // $email   = [$sellerDetail['email'],$UserDetail['email']];
                 $subject              = PROJECT_NAME." Approved Refund Status To Seller";
                 $links                = [];
                 $links['email']       = $email;
                 $links['buyer_name']  = $sellerDetailRecord['contact_name'].' '.$sellerDetailRecord['contact_last_name'];
                 $links['order_id']          = $itemRecord['invoice_id'];
                 $links['placed_on']         = $itemRecord['placed_on'];
                 $links['Product_name']      = $productDetail['item_name'];
                 $links['order_status_type'] = $orderStatus;

                 if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){
                 
                    Mail::send('frontend.emails.refundApprovalEmailFromAdminToUser',['order_id' => $links['order_id'],
                                                 'placed_on'          => $links['placed_on'],
                                                 'buyer_name'         => $links['buyer_name'],
                                                 'product_name'       => $links['Product_name'],
                                                 'order_status_type'  => $links['order_status_type'],
                                             ],function($message) use($email, $subject)
                       {
                           $message->to($email)->subject($subject);
                       });
                   }
                    Session::flash('success',('Refund Status Email has been sent to Seller and User'));               
              }
              $response['status']='true';
              return $response;
              // $response['status']='true';
       }

}
