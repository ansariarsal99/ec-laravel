<?php

namespace App\Http\Controllers\frontend\provider;

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
use Date;
use DateTime;
use  PDF;
use App\ProductTax;
use App\ProductBuildMartFee;

class OrderManagementController extends Controller
{
  public function productCancellationRequestList(Request $request)
    {
     try{         
            $page = 'service_list';
            return view('frontend.login.provider.OrderManagement.ProductCancellationRequestList', compact('page'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();

        }
    }

  public function productCancellationRequestListIndex(Request $request)
    {

        $cart = array();
        $cart[] = 4;
        $cart[] = 5;
 
        // dd($cart);
        $productStatus = ProductOrderStatus::pluck('id')->toArray();
        $serviceList   = OrderItem::with('Order')->leftjoin('products','order_item.product_id','products.id')
                              ->leftjoin('orders','order_item.order_id','orders.id')
                              ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                              ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus')
                              ->orderBy('id','desc')
                              ->whereIn('product_order_status_id',$cart)
                              ->get();               

        return DataTables::of($serviceList)
                        ->addIndexColumn()
                        ->addColumn('status', function($serviceList){
                            if($serviceList->status == 'active') {
                                return '<td class="stats_item">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm btn-class">Active</button>
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item drop-class inactive-class" product-id="'.$serviceList->id.'" href="javascript:;">Make Inactive</a>
                                                </div>
                                            </div> 
                                        </td>';
                            }

                            return '<td class="stats_item">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger btn-sm btn-class">Inactive</button>
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item drop-class active-class" product-id="'.$serviceList->id.'" href="javascript:;">Make Active</a>
                                            </div>
                                        </div> 
                                    </td>';
                        })

                        ->addColumn('action', function ($serviceList) {
                          // dd($serviceList->product_order_status_id);
                          if($serviceList->product_order_status_id  == '4'){
                                return 
                                '<a href="' . url("provider/view/productCancellationRequest/".base64_encode($serviceList->id)) . '" class="text-primary" del_id="'.$serviceList->id.'" >  View</a>|
                                <a href="javascript:void(0)" class="text-success use_accept_btn" order_item_id="'.$serviceList->id.'" product_id="'.$serviceList->product_id.'" > Accept </a>|
                                <a href="javascript:void(0)" class="cp text-danger use_reject_btn" order_item_id="'.$serviceList->id.'" product_id="'.$serviceList->product_id.'"> Reject </a>';
                          }else{
                                return 
                                  '<a href="' . url("provider/view/productCancellationRequest/".base64_encode($serviceList->id)) . '" class="text-primary" del_id="'.$serviceList->id.'" >  View</a>';
                          }
                            
                        })
                        ->escapeColumns([])
                        ->make(true);
    }

    

      public function viewProductCancellationRequest(Request $request,$id)
        {
         try{             
            $orderItemId = base64_decode($id);
            $productDetail = OrderItem::where('id',$orderItemId)->with('Order','productName')->where('order_item.status','User Cancellation Request')->first();
            return view('frontend.login.provider.OrderManagement.view', compact('productDetail'));
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();

            }
        }


     public function orderProductList(Request $request)
       {
        try{             
              $page = 'service_list';
              return view('frontend.login.provider.OrderManagement.myOrder.productOrderList', compact('page'));
           } catch (Exception $e) {
               \Log::error($e->getMessage());
               Session::flash('error',trans('messages.frontend.common_error'));
               return redirect()->back();

           }
       }

     public function orderProductListIndex(Request $request)
      {

        $serviceList = OrderItem::join('products','order_item.product_id','products.id')
                                         ->join('orders','order_item.order_id','orders.id')
                                         ->join('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                                         ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','product_order_statuses.name as order_status')
                                         ->where('seller_id',Auth::user()->id)
                                         ->orderBy('id', 'desc')
                                         ->get();     

         return DataTables::of($serviceList)
                     ->addIndexColumn()
                     ->addColumn('status', function($serviceList){
                         if($serviceList->status == 'active') {
                             return '<td class="stats_item">
                                         <div class="btn-group">
                                             <button type="button" class="btn btn-success btn-sm btn-class">Active</button>
                                             <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                             <div class="dropdown-menu dropdown-menu-right">
                                                 <a class="dropdown-item drop-class inactive-class" product-id="'.$serviceList->id.'" href="javascript:;">Make Inactive</a>
                                             </div>
                                         </div> 
                                     </td>';
                         }

                         return '<td class="stats_item">
                                     <div class="btn-group">
                                         <button type="button" class="btn btn-danger btn-sm btn-class">Inactive</button>
                                         <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                         <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item drop-class active-class" product-id="'.$serviceList->id.'" href="javascript:;">Make Active</a>
                                         </div>
                                     </div> 
                                 </td>';
                     })

                    ->addColumn('action', function ($serviceList) {
                            return 
                            '<a href="' . url("provider/view/orderProduct/detail/".base64_encode($serviceList->id)) . '" class="text-primary" del_id="'.$serviceList->id.'" >  View</a>|
                            <a href="javascript:void(0)" class="text-success changeOrderStatus" order_item_id="'.$serviceList->id.'" product_id="'.$serviceList->product_id.'" orderStatusId="'.$serviceList->product_order_status_id.'" order_table_id ="'.$serviceList->order_id.'"> Change Order Status</a>';
                    })

                    ->escapeColumns([])
                    ->make(true);
       }

     public function viewOrderDetail(Request $request,$id)
       {
        try{             
               $orderItemId = base64_decode($id);
               $productDetail = OrderItem::where('id',$orderItemId)->first();
               // dd($productDetail);
               return view('frontend.login.provider.OrderManagement.myOrder.view', compact('productDetail'));
           } catch (Exception $e) {
               \Log::error($e->getMessage());
               Session::flash('error',trans('messages.frontend.common_error'));
               return redirect()->back();

           }
       }

         public function updatedOrderStatusBySeller(Request $request)
          {
              $input           = $request->all();
              $productDetail   = OrderItem::where('id',$input['productOrderId'])->first();
              $orderStatuses   = ProductOrderStatus::where('id','!=',4)->get();
              $view            = view('frontend.elements.statusOrderBySeller',compact('orderStatuses','productDetail'))->render();
              return $view;
          }

         

       public function  changeOrderStatusBySeller(Request $request)
          {
              $input         = $request->all();
              // dd($input);
              $productStatus = ProductOrderStatus::where('id',$input['order_status_id'])->first();
              // $productStatus['alias']
              $oderItemStatus = OrderItem::where('id',$input['orderId'])->where('product_id',$input['productId'])->update([
                                              'status' => 'User Cancellation Request',
                                              'product_order_status_id' => $productStatus['id']
                                             ]);

                $itemOrderRecord    = OrderItem::where('order_id',$input['order_table_id'])
                                            ->where('product_order_status_id','!=',5)->get()
                                            ->Count();
                // dd($itemOrderRecord);
                                            
                if($itemOrderRecord<1){
                    $itemOrderRecord    = Order::where('id',$input['order_table_id'])
                                            ->update([
                                                  'order_status' =>$productStatus['name']       
                                               ]);
                }

              if($input['order_status_id']==2){
                  $buildMartreply ='under process';
              }elseif($input['order_status_id']==3){
                  $buildMartreply ='Deliver To Warehouse';
              }elseif($input['order_status_id']==5){                  


                  $buildMartreply ='Order Cancelled';
              }elseif($input['order_status_id']==6){
                  $buildMartreply ='Deliver To Local Warehouse';
              }elseif($input['order_status_id']==7){
                  $buildMartreply ='Out For Delivery';
              }elseif($input['order_status_id']==8){
                  $buildMartreply ='Delivered';

                  //////////////////////After Delivered admin commision///////////////
                  
                  $refundOrder = OrderItem::with('Order','productName.productBuildMartFees','Order.user.userBuildMartFees','productName.sellerName','productName.sellerName.userBuildMartFees')
                                        ->where('id',$input['orderId'])
                                        ->where('product_id',$input['productId'])
                                        ->first();

                    // dd($refundOrder['productName']);

                    if($refundOrder['productName']['has_special_build_mart_fees']=='yes'){

                        $productBuildMartFee = ProductBuildMartFee::where('product_id',$refundOrder['productName']['id'])->get()->toArray();

                        if($refundOrder['productName']['special_build_mart_fees_type']=='according_to_order_amount'){
                           
                            $orderAmountByOrderCheck = ProductBuildMartFee::where('product_id','=', $refundOrder['productName']['id']) 
                                      ->where('from_price','<=',$refundOrder['quantity_price'])
                                      ->where('to_price','>=',$refundOrder['quantity_price'])
                                      ->first();
                                      // ->get()
                                      // ->toArray();

                            if(empty($orderAmountByOrderCheck)){

                                if($refundOrder['productName']['default_amount']=='yes'){
                                  
                                    if($refundOrder['productName']['default_amount_type']=='percent'){
                                        $adminCommisionPercent = $refundOrder['productName']['default_amount_build_mart_special_product'];
                                        $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];
                                    }else if($refundOrder['productName']['default_amount_type']=='amount'){
                                        $adminCommision  = $refundOrder['productName']['default_amount_build_mart_special_product'];
                                    }
                                }
                            }else{
                                // dd($orderAmountByOrderCheck);
                                if($orderAmountByOrderCheck['type']=='percent'){
                          
                                    $adminCommisionPercent = $orderAmountByOrderCheck['value'];
                                    $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];
                                }else if($orderAmountByOrderCheck['type']=='amount'){
                                  
                                    $adminCommision = $orderAmountByOrderCheck['value'];
                                }
                            }

                        }else if($refundOrder['productName']['special_build_mart_fees_type']=='any_order_amount'){

                            $orderAmountByOrderCheck = ProductBuildMartFee::where('product_id','=', $refundOrder['productName']['id']) 
                                    ->where('from_price','<=',$refundOrder['quantity_price'])
                                    ->where('to_price','>=',$refundOrder['quantity_price'])
                                    ->first();

                            if(empty($orderAmountByOrderCheck)){

                                if($refundOrder['productName']['default_amount']=='yes'){
                                  
                                    if($refundOrder['productName']['default_amount_type']=='percent'){

                                        $adminCommisionPercent = $refundOrder['productName']['default_amount_build_mart_special_product'];

                                        $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

                                    }else if($refundOrder['productName']['default_amount_type']=='amount'){
                                        $adminCommision = $refundOrder['productName']['default_amount_build_mart_special_product'];
                                    }

                                  }

                            }else{
                              $adminCommision = $orderAmountByOrderCheck['value'];
                            }

                        } 
                                                                     
                    }else if($refundOrder['productName']['has_special_build_mart_fees']=='no'){
                          
                        if($refundOrder['productName']['sellerName']['assigned_build_mart_fees']=='yes'){

                            if($refundOrder['productName']['sellerName']['is_build_mart_fees_approve_by_user']=='yes'){

                                if($refundOrder['productName']['sellerName']['build_mart_fees_type']=='according_to_order_amount'){
                                       
                                    $orderAmountByOrderCheck = UserBuildMartFee::where('user_id','=', $refundOrder['productName']['sellerName']['id']) 
                                        ->where('from_price','<=',$refundOrder['quantity_price'])
                                        ->where('to_price','>=',$refundOrder['quantity_price'])
                                        ->get()
                                        ->toArray();

                                    if(empty($orderAmountByOrderCheck)){
                    
                                        if($refundOrder['productName']['default_amount']=='yes'){
                                      
                                            if($refundOrder['productName']['default_amount_type']=='percent'){
                                                $adminCommisionPercent = $refundOrder['productName']['default_amount_build_mart_special_product'];
                                                $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

                                            }else if($refundOrder['productName']['default_amount_type']=='amount'){

                                                $adminCommision  = $refundOrder['productName']['default_amount_build_mart_special_product'];
                                            }

                                        }
                                          
                                    }else{ 
                                        $adminCommision = $orderAmountByOrderCheck[''];
                                    }

                                }else if($refundOrder['productName']['sellerName']['build_mart_fees_type']=='any_order_amount'){

                                    $orderAmountByOrderCheck = UserBuildMartFee::where('user_id','=', $refundOrder['productName']['sellerName']['id']) 
                                        ->where('from_price','<=',$refundOrder['quantity_price'])
                                        ->where('to_price','>=',$refundOrder['quantity_price'])
                                        ->first();

                                    if(empty($orderAmountByOrderCheck)){

                                        if($refundOrder['productName']['sellerName']['default_amount']=='yes'){
                                      
                                            if($refundOrder['productName']['sellerName']['default_amount_type']=='percent'){

                                                $adminCommisionPercent = $refundOrder['productName']['sellerName']['default_amount_build_mart'];

                                                $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

                                            }else if($refundOrder['productName']['sellerName']['default_amount_type']=='amount'){
                                                $adminCommision = $refundOrder['productName']['sellerName']['default_amount_build_mart'];
                                            }
                                        }

                                    }else{
                                        $adminCommision = $orderAmountByOrderCheck['value'];
                                    }
                                } 
                            }
                        }
                    }
                    // dd($adminCommision);

                   $updateAdminCommision = OrderItem::with('Order','productName.productBuildMartFees','Order.user.userBuildMartFees','productName.sellerName','productName.sellerName.userBuildMartFees')
                                         ->where('id',$input['orderId'])
                                         ->where('product_id',$input['productId'])
                                         ->update([
                                               'admin_commission' => $adminCommision
                                            ]);                   
                  ///////////////////end admin commission/////////////////////
                                        
              }

              // dd($input);

              $orderItemId   = OrderItem::where('id',$input['orderId'])->first();
              
              $itemRecord    = Order::where('id',$orderItemId['order_id'])->first();

              $productDetail = Product::where('id',$input['productId'])->first();
              // $orderDEtailForEmail = OrderItem::where('order_id',$input['orderId'])->first();
              $UserDetail    = User::where('id',$itemRecord['user_id'])->first();
               
               if (!empty($oderItemStatus)) {
                  $email   = $UserDetail['email'];
                  $subject = PROJECT_NAME." Order Status";
                  $links = [];
                  $links['email'] = $email;
                  
                  $links['name'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                  $links['buyer_name']  = $UserDetail['first_name'].' '.$UserDetail['last_name'];
                  // dd($links['buyer_name']);

                  $links['order_id']          = $itemRecord['invoice_id'];
                  $links['placed_on']         = $itemRecord['placed_on'];
                  $links['Product_name']      = $productDetail['item_name'];
                  $links['order_status_type'] = $buildMartreply;

                  // $productDetail

                  if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){

                     Mail::send('frontend.emails.productOrderStausesChangedBySeller',['order_id' => $links['order_id'],
                                                  'placed_on'          => $links['placed_on'],
                                                  'name'               => $links['name'],
                                                  'buyer_name'         => $links['buyer_name'],
                                                  'product_name'       => $links['Product_name'],
                                                  'order_status_type'  => $links['order_status_type'],

                                                          ],function($message) use($email, $subject)
                        {
                            $message->to($email)->subject($subject);
                        });
                    }
                     $response['status']='true';
                     Session::flash('success',('Changed Product order status has been sent to user'));               
               }else{
                     $response['status']='false';
               }

              return $response;
       }



       

     public function  acceptedProductCancellationRequest(Request $request)
        {
            $input         = $request->all();
            // dd($input);
            $productStatus = ProductOrderStatus::where('id',5)->first();
            // $productStatus['alias']
            $oderItemStatus = OrderItem::where('id',$input['orderId'])->where('product_id',$input['productId'])
                            ->update([
                                    'status'                  => 'User Cancellation Request',
                                    'product_order_status_id' => $productStatus['id']
                                   ]);

            $productOrderId   = OrderItem::where('id',$input['orderId'])->first();


             $itemOrderRecord    = OrderItem::where('order_id',$productOrderId['order_id'])
                                         ->where('product_order_status_id','!=',5)->get()
                                         ->Count();
             // dd($itemOrderRecord);
                                         
             if($itemOrderRecord<1){
                 $itemOrderRecord    = Order::where('id',$productOrderId['order_id'])
                                         ->update([
                                               'order_status' =>$productStatus['name']       
                                            ]);
             }
                            

            $orderItemId = OrderItem::where('id',$input['orderId'])->first();
            
            $itemRecord = Order::where('id',$orderItemId['order_id'])->first();

            $productDetail       = Product::where('id',$input['productId'])->first();
            // $orderDEtailForEmail = OrderItem::where('order_id',$input['orderId'])->first();
            $UserDetail          = User::where('id',$itemRecord['user_id'])->first();
            // dd($UserDetail);
             
             if (!empty($oderItemStatus)) {
                $email   = $UserDetail['email'];
                $subject = PROJECT_NAME." Cancellation request";
                $links = [];
                $links['email'] = $email;
                
                $links['name'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                $links['buyer_name']  = $UserDetail['first_name'].' '.$UserDetail['last_name'];
                // dd($links['buyer_name']);

                $links['order_id']    = $itemRecord['invoice_id'];
                $links['placed_on']   = $itemRecord['placed_on'];
                $links['Product_name']         = $productDetail['item_name'];
                // $links['cancellationReason']   = $input['reason'];

                // $productDetail

                if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){

                   Mail::send('frontend.emails.productCancellationRequestAcceptedBySeller',['order_id' => $links['order_id'],
                                                'placed_on'          => $links['placed_on'],
                                                'name'               => $links['name'],
                                                'buyer_name'         => $links['buyer_name'],
                                                'product_name'       => $links['Product_name'],
                                                // 'cancellationReason' => $links['cancellationReason'],

                                                        ],function($message) use($email, $subject)
                      {
                          $message->to($email)->subject($subject);
                      });
                  }
                   $response['status']='true';
                   Session::flash('success',('Product cancellation request has been accepted'));               
             }else{
                   $response['status']='false';
             }

            return $response;
        }


        public function  rejectedProductCancellationRequest(Request $request)
           {
               $input    = $request->all();
               // dd($input);
               $productStatus  = ProductOrderStatus::where('id',1)->first();
               $oderItemStatus = OrderItem::where('id',$input['orderId'])->where('product_id',$input['productId'])->update([
                                                      
                                 'status'                      => 'User Cancellation Request',
                                 'product_order_status_id'     => $productStatus['id'],
                                 'seller_cancellation_reason'  => $input['reason']
                            ]);

               $orderItemId = OrderItem::where('id',$input['orderId'])->first();
               
               $itemRecord = Order::where('id',$orderItemId['order_id'])->first();

               $productDetail       = Product::where('id',$input['productId'])->first();
               // $orderDEtailForEmail = OrderItem::where('order_id',$input['orderId'])->first();
               $UserDetail          = User::where('id',$itemRecord['user_id'])->first();
               // dd($UserDetail);
                
                if (!empty($oderItemStatus)) {
                   $email   = $UserDetail['email'];
                   $subject = PROJECT_NAME." Cancellation request";
                   $links = [];
                   $links['email'] = $email;
                   
                   $links['name'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                   $links['buyer_name']  = $UserDetail['first_name'].' '.$UserDetail['last_name'];
                   // dd($links['buyer_name']);

                   $links['order_id']    = $itemRecord['invoice_id'];
                   $links['placed_on']   = $itemRecord['placed_on'];
                   $links['Product_name']         = $productDetail['item_name'];
                   $links['cancellationReason']   = $input['reason'];

                   // $productDetail

                   if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){

                      Mail::send('frontend.emails.productCancellationRequestRejectedBySeller',['order_id' => $links['order_id'],
                                                   'placed_on'          => $links['placed_on'],
                                                   'name'               => $links['name'],
                                                   'buyer_name'         => $links['buyer_name'],
                                                   'product_name'       => $links['Product_name'],
                                                   'cancellationReason' => $links['cancellationReason'],

                                                           ],function($message) use($email, $subject)
                         {
                             $message->to($email)->subject($subject);
                         });
                     }
                      $response['status']='true';
                      Session::flash('success',('Product cancellation request has been rejected'));               
                }else{
                      $response['status']='false';
                }

               return $response;
           }
     
      /////////Cancelled Order list///////////////////////////////
      
      public function cancelledOrderList(Request $request)
        {
         try{   
             $page = 'service_list';
             return view('frontend.login.provider.OrderManagement.cancelledOrder.cancelledOrderList', compact('page'));
            }catch (Exception $e) {
                \Log::error($e->getMessage());
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();

            }
        }

        public function cancelledOrderListIndex(Request $request)
        {
               
               
                $cancelledOrderList   = OrderItem::with('Order')->leftjoin('products','order_item.product_id','products.id')
                                      ->leftjoin('orders','order_item.order_id','orders.id')
                                      ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                                      ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus')
                                      ->orderBy('id','desc')
                                      ->where('product_order_status_id',5)
                                      ->get();               

            return DataTables::of($cancelledOrderList)
                            ->addIndexColumn()
                            ->addColumn('status', function($cancelledOrderList){
                                if($cancelledOrderList->status == 'active') {
                                    return '<td class="stats_item">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-sm btn-class">Active</button>
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item drop-class inactive-class" product-id="'.$cancelledOrderList->id.'" href="javascript:;">Make Inactive</a>
                                                    </div>
                                                </div> 
                                            </td>';
                                }

                                return '<td class="stats_item">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger btn-sm btn-class">Inactive</button>
                                                <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item drop-class active-class" product-id="'.$cancelledOrderList->id.'" href="javascript:;">Make Active</a>
                                                </div>
                                            </div> 
                                        </td>';
                            })

                            ->addColumn('action', function ($cancelledOrderList) {

                                return '<a href="' . url("provider/view/cancelled/order/".base64_encode($cancelledOrderList->id)) . '" class="text-primary" del_id="'.$cancelledOrderList->id.'" >  View</a>'; 
                                
                            })
                            ->escapeColumns([])
                            ->make(true);
        }    

        public function viewCancelledOrderDetail(Request $request,$id)
          {
           try{             
              $orderItemId = base64_decode($id);
              $productDetail = OrderItem::where('id',$orderItemId)->with('Order','productName')->first();

              return view('frontend.login.provider.OrderManagement.cancelledOrder.view', compact('productDetail'));
              } catch (Exception $e) {
                  \Log::error($e->getMessage());
                  Session::flash('error',trans('messages.frontend.common_error'));
                  return redirect()->back();

              }
          }
        
          ///////////////////////Refund Order list///////////////////////////////
            
          public function refundOrderList(Request $request)
              {
               try{   

                 $buyerIds    = OrderItem::with('Order','Order.user')->leftjoin('products','order_item.product_id','products.id')
                                    ->leftjoin('orders','order_item.order_id','orders.id')
                                    ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                                    ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
                                    ->leftjoin('product_order_refunds as admin_refunds','order_item.admin_approved_product_order_refund_id','admin_refunds.id')
                                    ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','orders.placed_on as placed_on','admin_refunds.name as approvedrefundStatus','orders.user_id as user_id')
                                    ->where('product_order_status_id',5)
                                    ->orderBy('id','desc')->get()
                                    ->pluck('user_id')
                                    ->toArray();   

                $users =  User::whereIn('id',$buyerIds)->get()->toArray();                                                 

                $refundOrderList   = OrderItem::with('Order','Order.user')->leftjoin('products','order_item.product_id','products.id')
                                    ->leftjoin('orders','order_item.order_id','orders.id')
                                    ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                                    ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
                                    ->leftjoin('product_order_refunds as admin_refunds','order_item.admin_approved_product_order_refund_id','admin_refunds.id')
                                    ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','orders.placed_on as placed_on','admin_refunds.name as approvedrefundStatus','orders.user_id as user_id')
                                    ->where('product_order_status_id',5);
                                    // ->orderBy('id','desc');                                    


                // $refundOrderList   = OrderItem::with('Order')->leftjoin('products','order_item.product_id','products.id')
                //                       ->leftjoin('orders','order_item.order_id','orders.id')
                //                       ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                //                       ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
                //                       ->leftjoin('product_order_refunds as admin_refunds','order_item.admin_approved_product_order_refund_id','admin_refunds.id')
                //                       ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','admin_refunds.name as approvedrefundStatus')
                //                       ->orderBy('id','desc')
                //                       ->where('product_order_status_id',5)
                //                       ->get();  
                                    

                     $startDate  = '';
                     $endDate    = '';
                     $seachData  = '';
                     $sort       = '';   

                     if(isset($_GET)){
                        $startDate     = @$_GET['offer_start_date'];
                        $endDate       = @$_GET['offer_end_date'];
                        $seachData     = @$_GET['seachData'];
                        $sort          = @$_GET['sort'];
                        // $user_id       = @$_GET['user_id'];
                        // dd($user_id);
                  
                       
                         if ($startDate!='' && $endDate!='') {
                             
                             $refundOrderList = $refundOrderList->whereBetween('placed_on', [$startDate, $endDate]);

                         }else if ($endDate!= '') {
                             
                             $refundOrderList   = $refundOrderList->whereDate('placed_on', '=', $endDate);

                         }else if ($startDate!='') {
                             
                             $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $startDate);
                         
                         }else if ($seachData =='today') {
                         
                             $currentDate = date('Y-m-d');
                             $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $currentDate);
                         }else if ($seachData =="yesterday") {
                            $yesterdayDate = date('d.m.Y',strtotime("-1 days"));
                            $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $yesterdayDate);

                         }else if ($seachData =='current_week') {
                            
                            $day = date('w');
                            $week_start = date('m-d-Y', strtotime('-'.$day.' days'));
                            $week_end = date('m-d-Y', strtotime('+'.(6-$day).' days'));
                            $refundOrderList = $refundOrderList->whereBetween('placed_on', [$week_start, $week_end]);
                        
                         }else if ($seachData =="previous_week") {
                        
                            $privious_week_start_date = date('Y-m-d', strtotime('-14 days'));
                            $privious_week_end_date = date('Y-m-d', strtotime('-7 days'));
                            $refundOrderList = $refundOrderList->whereBetween('placed_on', [$privious_week_start_date, $privious_week_end_date]);
                        
                        }else if ($seachData =="current_month") {
                            $firstDay = new DateTime('first day of this month');
                            $firstDay = $firstDay->format('Y-m-d');
                            $lastDay  = new DateTime('last day of this month');
                            $lastDay  = $lastDay->format('Y-m-d');

                            $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                        }else if ($seachData =="previous_month") {
                            $firstDay = date('Y-m-d', strtotime('first day of previous month'));
                            $lastDay  = date('Y-m-d', strtotime('last day of previous month'));
                            // dd($lastDay);
                            $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                        }else if ($seachData =="current_year") {
                            $firstDay = date('Y-m-d', strtotime('1 Jan'));
                            $lastDay  = date('Y-m-d', strtotime('Dec 31'));
                            $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                        }else if ($seachData =="previous_year") {
                            $date = new DateTime();
                            $firstDay  =  new \DateTime('first day of January this year -1 years');
                            $firstDay  = $firstDay->format("Y-m-d");
        
                            $lastDay  =  new \DateTime('last day of December this year -1 years');
                            $lastDay  = $lastDay->format("Y-m-d");
                         
                            $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                        }

                        if($sort != ''){
                           $refundOrderList = $refundOrderList->orderBy('user_id',$sort); 
                        }     
                           


                        $productUnderStorePaginate  = $refundOrderList->paginate(6); 
                        $refundOrderList = $refundOrderList->get()->toArray();
                       
                     }
                      
                     $page = 'service_list';
                     return view('frontend.login.provider.OrderManagement.refundedOrder.sellerdbRefundList', compact('page','refundOrderList','users'));
                  }catch (Exception $e) {
                      \Log::error($e->getMessage());
                      Session::flash('error',trans('messages.frontend.common_error'));
                      return redirect()->back();

                  }
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

             
           public function  changeRefundStatusBySeller(Request $request)
              {
                  $input   = $request->all();
                 
                  $productStatus  = productOrderRefund::where('id',$input['order_status_id'])->first();

                  $oderItemStatus = OrderItem::where('id',$input['orderId'])->where('product_id',$input['productId'])                           ->update([
                                                  'product_order_refund_id' =>  $productStatus['id']
                                                ]);

                  if($input['order_status_id']==1){
                      $orderStatus ='Cancel Refund';
                  }elseif($input['order_status_id']==2){
                      $orderStatus ='20% of the Order';
                  }elseif($input['order_status_id']==3){
                      $orderStatus ='50% of the Order refund given to user';
                  }elseif($input['order_status_id']==4){
                      $orderStatus ='70% of the Order refund given to user';
                  }else{
                      $orderStatus ='Full Refund';
                  }

                  $orderItemId   = OrderItem::where('id',$input['orderId'])->first();
                  $itemRecord    = Order::where('id',$orderItemId['order_id'])->first();
                  $productDetail = Product::where('id',$input['productId'])->first();
                  $sellerDetail  = User::where('id',$productDetail['user_id'])->first();
                  $UserDetail    = User::where('id',$itemRecord['user_id'])->first();
                  $adminDetail   = Admin::where('id',1)->first();
                   
                   if (!empty($oderItemStatus)) {
                      $email   = $adminDetail['email'];
                      $subject = PROJECT_NAME." Refund from seller";
                      $links = [];
                      $links['email'] = $email;
                      
                      $links['name']        = Auth::user()->first_name.' '.Auth::user()->last_name;
         // user name=> // $links['buyer_name']  = $UserDetail['first_name'].' '.$UserDetail['last_name'];
                      $links['buyer_name']  = $adminDetail['first_name'].' '.$adminDetail['last_name'];
                                               



                      $links['seller_name']       = $sellerDetail['contact_name'].' '.$sellerDetail['contact_last_name'];
                      $links['order_id']          = $itemRecord['invoice_id'];
                      $links['placed_on']         = $itemRecord['placed_on'];
                      $links['Product_name']      = $productDetail['item_name'];
                      $links['order_status_type'] = $orderStatus;


                      if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){

                         Mail::send('frontend.emails.refundApprovalEmailToAdmin',['order_id' => $links['order_id'],
                                                      'placed_on'          => $links['placed_on'],
                                                      'name'               => $links['name'],
                                                      'buyer_name'         => $links['buyer_name'],
                                                      'product_name'       => $links['Product_name'],
                                                      'order_status_type'  => $links['order_status_type'],
                                                      'seller_name'        =>  $links['seller_name'],  

                                                              ],function($message) use($email, $subject)
                            {
                                $message->to($email)->subject($subject);
                            });
                        }
                         $response['status']='true';
                         Session::flash('success',('Refund status has been sent to Admin for approvel'));               
                   }else{
                         $response['status']='false';
                   }

                  return $response;
           }


          
          public function refundOrderSellerDetail(Request $request,$id){

              $orderItemDetail = OrderItem::with('productName.product_Image_for_order_Item','delivery_address','productName.sellerName','Order','productName.sellerName')->where('id',base64_decode($id))->first();
              $taxOnEveryProduct = ProductTax::select('tax_percent')->first();
              // dd($taxOnEveryProduct['tax_percent']);
              return view('frontend.login.provider.OrderManagement.refundedOrder.OrderDetails', compact('page','orderItemDetail','taxOnEveryProduct'));
          }


          public function getOrderPdf(Request $request)
          {  
              $input = $request->all();
              // $orderDetail =Order::with('orderItems')->where('invoice_id',base64_decode($input['id']))->first();

              $orderItemDetail = OrderItem::with('productName.product_Image_for_order_Item','delivery_address','productName.sellerName','Order','productName.sellerName')->where('id',base64_decode($input['id']))->first();
              // dd($orderItemDetail);
              // $orderItem = OrderItem::with('delivery_address','storeAddress')->where('order_id',$orderDetail['id'])->get()->toArray();
              $taxOnEveryProduct = ProductTax::select('tax_percent')->first();

              $taxProduct =$orderItemDetail['quantity_price']/100*$taxOnEveryProduct['tax_percent'];

              $subTotal = $orderItemDetail['quantity_price']-$taxProduct;

              $view = \View::make('frontend.login.provider.OrderManagement.refundedOrder.orderInvoice', ['page' => 'pdfquest','orderItem'=>$orderItemDetail,'taxProduct'=>$taxProduct,'subTotal'=>$subTotal]);
              $html_content = $view->render();
              PDF::AddPage();
              PDF::writeHTML($html_content, true, false, true, false, '');
              PDF::Output('orderInvoice.pdf', 'D');
              return redirect()->back();
          }


           ////////////Closed Orders/////////////25Nov 2020////////////

           public function closedOrderList(Request $request)
               {
                try{   



                   $refundOrderList   = OrderItem::with('Order','Order.user')->leftjoin('products','order_item.product_id','products.id')
                                  ->leftjoin('orders','order_item.order_id','orders.id')
                                  ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                                  ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
                                  ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','orders.placed_on as placed_on','orders.user_id as user_id')
                                  ->where('product_order_status_id',8)
                                  ->orderBy('id','desc');
                                  

                   $startDate  = '';
                   $endDate    = '';
                   $seachData  = '';
                   $sort       = ''; 


                   if(isset($_GET)){
                      $startDate     = @$_GET['offer_start_date'];
                      $endDate       = @$_GET['offer_end_date'];
                      $seachData     = @$_GET['seachData'];
                      $sort          = @$_GET['sort'];
                
                     
                       if ($startDate!='' && $endDate!='') {
                           
                           $refundOrderList = $refundOrderList->whereBetween('placed_on', [$startDate, $endDate]);

                       }else if ($endDate!= '') {
                           
                           $refundOrderList   = $refundOrderList->whereDate('placed_on', '=', $endDate);

                       }else if ($startDate!='') {
                           
                           $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $startDate);
                       
                       }else if ($seachData =='today') {
                       
                           $currentDate = date('Y-m-d');
                           $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $currentDate);
                       }else if ($seachData =="yesterday") {
                          $yesterdayDate = date('d.m.Y',strtotime("-1 days"));
                          $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $yesterdayDate);

                       }else if ($seachData =='current_week') {
                          
                          $day = date('w');
                          $week_start = date('m-d-Y', strtotime('-'.$day.' days'));
                          $week_end = date('m-d-Y', strtotime('+'.(6-$day).' days'));
                          $refundOrderList = $refundOrderList->whereBetween('placed_on', [$week_start, $week_end]);
                      
                       }else if ($seachData =="previous_week") {
                      
                          $privious_week_start_date = date('Y-m-d', strtotime('-14 days'));
                          $privious_week_end_date = date('Y-m-d', strtotime('-7 days'));
                          $refundOrderList = $refundOrderList->whereBetween('placed_on', [$privious_week_start_date, $privious_week_end_date]);
                      
                      }else if ($seachData =="current_month") {
                          $firstDay = new DateTime('first day of this month');
                          $firstDay = $firstDay->format('Y-m-d');
                          $lastDay  = new DateTime('last day of this month');
                          $lastDay  = $lastDay->format('Y-m-d');

                          $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                      }else if ($seachData =="previous_month") {
                          $firstDay = date('Y-m-d', strtotime('first day of previous month'));
                          $lastDay  = date('Y-m-d', strtotime('last day of previous month'));
                          // dd($lastDay);
                          $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                      }else if ($seachData =="current_year") {
                          $firstDay = date('Y-m-d', strtotime('1 Jan'));
                          $lastDay  = date('Y-m-d', strtotime('Dec 31'));
                          $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                      }else if ($seachData =="previous_year") {
                          $date = new DateTime();
                          $firstDay  =  new \DateTime('first day of January this year -1 years');
                          $firstDay  = $firstDay->format("Y-m-d");
               
                          $lastDay  =  new \DateTime('last day of December this year -1 years');
                          $lastDay  = $lastDay->format("Y-m-d");
                       
                          $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);

                      }else if($sort != ''){
                         $refundOrderList = $refundOrderList->orderBy('user_id',$sort); 
                      }     
                         


                      $productUnderStorePaginate  = $refundOrderList->paginate(6); 
                      $refundOrderList = $refundOrderList->get()->toArray();
                     
                   }


            
                      $page = 'service_list';
                      return view('frontend.login.provider.OrderManagement.closedOrder.closedList', compact('page','refundOrderList'));
                   }catch (Exception $e) {
                       \Log::error($e->getMessage());
                       Session::flash('error',trans('messages.frontend.common_error'));
                       return redirect()->back();

                   }
               }
        
        ////////////Refund Complete Orders/////////////25Nov 2020////////////

        public function RefundCompletedOrderList(Request $request)
            {
             // try{   

             $refundOrderList   = OrderItem::with('Order','Order.user')->leftjoin('products','order_item.product_id','products.id')
                                     ->leftjoin('orders','order_item.order_id','orders.id')
                                     ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                                     ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
                                     ->leftjoin('product_order_refunds as admin_refunds','order_item.admin_approved_product_order_refund_id','admin_refunds.id')
                                     ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','admin_refunds.name as approvedrefundStatus','orders.user_id as user_id')
                                     ->where('product_order_status_id',5)
                                     ->where('product_order_refund_id','!=',1)
                                     ->where('admin_approved_product_order_refund_id','!=',1)
                                     ->where('refund_order_approved_by_admin','=','yes')
                                     ->orderBy('id','desc');
                // dd($refundOrderList);

                               

                $startDate  = '';
                $endDate    = '';
                $seachData  = '';
                $sort       = ''; 



                if(isset($_GET)){
                   $startDate     = @$_GET['offer_start_date'];
                   $endDate       = @$_GET['offer_end_date'];
                   $seachData     = @$_GET['seachData'];
                   $sort          = @$_GET['sort'];
                  
                    if ($startDate!='' && $endDate!='') {
                        
                        $refundOrderList = $refundOrderList->whereBetween('placed_on', [$startDate, $endDate]);

                    }else if ($endDate!= '') {
                        
                        $refundOrderList   = $refundOrderList->whereDate('placed_on', '=', $endDate);

                    }else if ($startDate!='') {
                        
                        $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $startDate);
                    
                    }else if ($seachData =='today') {
                    
                        $currentDate = date('Y-m-d');
                        $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $currentDate);
                    }else if ($seachData =="yesterday") {
                       $yesterdayDate = date('d.m.Y',strtotime("-1 days"));
                       $refundOrderList =  $refundOrderList->whereDate('placed_on', '=', $yesterdayDate);

                    }else if ($seachData =='current_week') {
                       
                       $day = date('w');
                       $week_start = date('m-d-Y', strtotime('-'.$day.' days'));
                       $week_end = date('m-d-Y', strtotime('+'.(6-$day).' days'));
                       $refundOrderList = $refundOrderList->whereBetween('placed_on', [$week_start, $week_end]);
                   
                    }else if ($seachData =="previous_week") {
                   
                       $privious_week_start_date = date('Y-m-d', strtotime('-14 days'));
                       $privious_week_end_date = date('Y-m-d', strtotime('-7 days'));
                       $refundOrderList = $refundOrderList->whereBetween('placed_on', [$privious_week_start_date, $privious_week_end_date]);
                   
                   }else if ($seachData =="current_month") {
                       $firstDay = new DateTime('first day of this month');
                       $firstDay = $firstDay->format('Y-m-d');
                       $lastDay  = new DateTime('last day of this month');
                       $lastDay  = $lastDay->format('Y-m-d');

                       $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                   }else if ($seachData =="previous_month") {
                       $firstDay = date('Y-m-d', strtotime('first day of previous month'));
                       $lastDay  = date('Y-m-d', strtotime('last day of previous month'));
                       // dd($lastDay);
                       $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                   }else if ($seachData =="current_year") {
                       $firstDay = date('Y-m-d', strtotime('1 Jan'));
                       $lastDay  = date('Y-m-d', strtotime('Dec 31'));
                       $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                   }else if ($seachData =="previous_year") {
                       $date = new DateTime();
                       $firstDay  =  new \DateTime('first day of January this year -1 years');
                       $firstDay  = $firstDay->format("Y-m-d");
            
                       $lastDay  =  new \DateTime('last day of December this year -1 years');
                       $lastDay  = $lastDay->format("Y-m-d");
                    
                       $refundOrderList = $refundOrderList->whereBetween('placed_on', [$firstDay, $lastDay]);
                   }else if($sort != ''){
                       $refundOrderList = $refundOrderList->orderBy('user_id',$sort); 
                   }    

                   $productUnderStorePaginate  = $refundOrderList->paginate(6); 
                   $refundOrderList = $refundOrderList->get()->toArray();
                  
                }


         
                   $page = 'service_list';
                   return view('frontend.login.provider.OrderManagement.refundedOrder.completedRefundList', compact('page','refundOrderList'));
                // }catch (Exception $e) {
                //     \Log::error($e->getMessage());
                //     Session::flash('error',trans('messages.frontend.common_error'));
                //     return redirect()->back();

                // }
            }
        

  


        


}
