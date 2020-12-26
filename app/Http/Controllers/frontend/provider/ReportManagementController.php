<?php

namespace App\Http\Controllers\frontend\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Session;
use DataTables;
use App\BuildMartFeesAndCondtionAmount;
use App\BuildMartFeesAndCondtion;
use Auth;
use App\UserType;
use App\User;
use App\Product;
use App\UserBuildMartFee;
use App\ProductBuildMartFee;
use App\OrderItem,App\Order,App\Admin;
use Illuminate\Support\Facades\Mail;

class ReportManagementController extends Controller
{
    public function earningList(Request $request){
        
        // $adminCommsion   = OrderItem::with('Order','productName.productBuildMartFees','Order.user.userBuildMartFees','productName.sellerName','productName.sellerName.userBuildMartFees')
        //                              ->leftjoin('products','order_item.product_id','products.id')
        //                       ->leftjoin('orders','order_item.order_id','orders.id')
        //                       ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
        //                       ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
        //                       ->leftjoin('product_order_refunds as admin_refunds','order_item.admin_approved_product_order_refund_id','admin_refunds.id')
        //                       ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','admin_refunds.name as approvedrefundStatus','orders.placed_on as placed_on')
        //                       ->where('product_order_status_id',8)
        //                       ->orderBy('id','desc')->get()->toArray();
        // dd($adminCommsion);                      

        $refundOrderList   = OrderItem::with('Order','productName.productBuildMartFees','Order.user.userBuildMartFees','productName.sellerName','productName.sellerName.userBuildMartFees')
                              ->leftjoin('products','order_item.product_id','products.id')
                              ->leftjoin('orders','order_item.order_id','orders.id')
                              ->leftjoin('product_order_statuses','order_item.product_order_status_id','product_order_statuses.id')
                              ->leftjoin('product_order_refunds','order_item.product_order_refund_id','product_order_refunds.id')
                              ->leftjoin('product_order_refunds as admin_refunds','order_item.admin_approved_product_order_refund_id','admin_refunds.id')
                              ->select('order_item.*','products.item_name as product_name','orders.invoice_id as OrderInvoiceId','products.seller_item_code as ProductSellerCode','products.item_bar_code as ProductBarCode','product_order_statuses.name as orderStatus','product_order_refunds.name as refundStatus','admin_refunds.name as approvedrefundStatus','orders.placed_on as placed_on')
                              ->where('product_order_status_id',8)
                              ->orderBy('id','desc');                      
         
         // dd($refundOrderList);

         $startDate  = '';
         $endDate    = '';
         $seachData  = '';

         if(isset($_GET)){
            $startDate     = @$_GET['offer_start_date'];
            $endDate       = @$_GET['offer_end_date'];
            $seachData     = @$_GET['seachData'];
        
           
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
               


            $productUnderStorePaginate  = $refundOrderList->paginate(6); 
            $refundOrderList = $refundOrderList->get()->toArray();
          
          // dd($refundOrderList)

          // $conditionCheck = ProductBuildMartFee::where('product_id','=', $refundOrderList[0]['product_id']) 
          //                                       ->where('from_price','<=',$refundOrderList[0]['quantity_price'])
          //                                       ->where('to_price','>=',$refundOrderList[0]['quantity_price'])
          //                                       ->get()
          //                                       ->toArray(); 
          // dd($conditionCheck);       

         }

        return view('frontend.login.provider.reportManagement.earningManagement',compact('refundOrderList'));

    } 


      public function  sendBuildMartCommision(Request $request)
         {
             $input  = $request->all();
             $payCommsion = 'yes';
             $currentDateTime = date('Y-m-d H:i:s');
             $oderItemStatus  = OrderItem::where('id',$input['orderId'])
                                          ->where('product_id',$input['productId'])
                                          ->update([
                                             'admin_commission'       =>  $input['admin_commision'],
                                             'pay_admin_commission'   =>  $payCommsion,
                                             'admin_commission_date'  =>  $currentDateTime
                                          ]);

          
             // dd('HERE');

             $orderItemId   = OrderItem::where('id',$input['orderId'])->first();
             // dd($orderItemId);
             $itemRecord    = Order::where('id',$orderItemId['order_id'])->first();
             $productDetail = Product::where('id',$input['productId'])->first();
             $sellerDetail  = User::where('id',$productDetail['user_id'])->first();
             $UserDetail    = User::where('id',$itemRecord['user_id'])->first();
             $adminDetail   = Admin::where('id',1)->first();
              
              if (!empty($oderItemStatus)) {
                 $email   = $adminDetail['email'];
                 $subject = PROJECT_NAME." Admin Commsion From Seller";
                 $links = [];
                 $links['email'] = $email;
                 
                 $links['name']        = Auth::user()->first_name.' '.Auth::user()->last_name;
                // user name=> // $links['buyer_name']  = $UserDetail['first_name'].' '.$UserDetail['last_name'];
                 $links['buyer_name']  = $adminDetail['first_name'].' '.$adminDetail['last_name'];
                                        
                 $links['seller_name']    = $sellerDetail['contact_name'].' '.$sellerDetail['contact_last_name'];
                 $links['order_id']          = $itemRecord['invoice_id'];
                 $links['placed_on']         = $itemRecord['placed_on'];
                 $links['Product_name']      = $productDetail['item_name'];
                 $links['admin_commission']   = $orderItemId['admin_commission'];
                 // dd($link['admin_commission']);


                 if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){

                    Mail::send('frontend.emails.adminCommissionEmailToAdmin',[
                                                 'order_id'           => $links['order_id'],
                                                 'placed_on'          => $links['placed_on'],
                                                 'name'               => $links['name'],
                                                 'buyer_name'         => $links['buyer_name'],
                                                 'product_name'       => $links['Product_name'],
                                                 'seller_name'        => $links['seller_name'], 
                                                 'admin_commission'   => $links['admin_commission'],
                                                         ],function($message) use($email, $subject)
                       {
                           $message->to($email)->subject($subject);
                       });
                   }
                    $response['status']='true';
                    Session::flash('success',('Admin Commission has been sent to Admin'));               
              }else{
                    $response['status']='false';
              }

             return $response;
      }


}
