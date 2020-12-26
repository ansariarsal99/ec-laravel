<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request, Response, Session;
use App\Http\Controllers\Controller;
use DataTables;
use Config;
use Exception;
use App\User,App\UserSubscriptionPayment;
use App\UserSubscription;
use DateTime;
use App\Admin,App\UserStoreLocation;
use Illuminate\Support\Facades\Mail;

class UserCashTransferController extends Controller
{
    public function cashList(Request $request)
    {          
      $page =  'cashTransfer';
      return view('admin.UserCashTransfer.userInstitutionDesignerList',compact('page'));
    }

   public function cashListIndex(Request $request) 
   {

          $subscriptionList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                               ->leftjoin('user_subscriptions','users.id','user_subscriptions.user_id')
                               ->leftjoin('user_subscriptions_payments','users.id','user_subscriptions_payments.user_id')
                 ->select('users.*','user_types.name as user_type_name','user_subscriptions.title as title','user_subscriptions.price as price','user_subscriptions_payments.payment_type as payment_mode')         
                 ->where('complete_profile','yes')
                 ->whereIn('user_type_id',[3,4,5,6])
                 ->get();

            return DataTables::of($subscriptionList)
              ->addIndexColumn()
              ->addColumn('status', function ($subscriptionList) {
                  return '<div class="status_button_toggle" ral="' . $subscriptionList->id . '" rel="' . $subscriptionList->transaction_status . '" id="status_button_' . $subscriptionList->id . '"></div>';
              })
              ->addColumn('action', function ($subscriptionList) {
                  return 
                  '<a href="' . url("admin/user/cashTransfer/detail/".base64_encode($subscriptionList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                  <a href="' . url("admin/user/userStoreAddress/".base64_encode($subscriptionList->id)) . '" class="edit-btn"> <i class="fa fa-user" title="userDeliveryAddress"></i></a>';
              })
              ->escapeColumns([])
              ->make(true);                                
   } 

   public function cashdetail(Request $request,$id)
    {
      $id   = base64_decode($id);
      $userdata = User::where('id',$id)->with('userTypeDetail')->first();
      $invoice = UserSubscriptionPayment::where('user_id',$id)->first();
      // dd($invoice);
      $page =  'cashTransfer';
      return view('admin.UserCashTransfer.userInstitutionDesignerDetail',compact('page','userdata','invoice','id'));
    }

     public function changecashStatus(Request $request)
     {
        if($request->status && $request->id){

           $cardpayment = UserSubscriptionPayment::where(['user_id' => $request->id])->update(['status' => $request->status]);

           $statusChanged = User::where(['id' => $request->id])->update([
                                                       'transaction_status' =>$request->status
                                                        ]);
           $userData = User::where(['id' => $request->id])->first();


           if($userData['transaction_status'] == 'active') {         

                 $adminData = User::where(['id' => $request->id])->first();
                 $admin     = Admin::first();
                 $email     = $adminData->email;
                 $links['phone_no']    = $admin->phone_no;                   
                 $links['contact_name'] = $adminData->contact_name;
                 $links['email']        = $admin->email;
                 $subject = PROJECT_NAME." Subscription Package Started";

                 Mail::send('admin.email.paymentApproved', $links, function ($message) use ($email, $subject) {
                     $mail = $message->to($email)->subject($subject);
                 });
                 // session::flash('success', 'A link is sent on provider registered email Id.');
            return ['status' => 'success', 'message' => 'A link is sent on provider registered email Id.'];

             }
            return ['status' => 'success', 'message' => 'Status changed successfully'];

        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

    public function userStoreAddress(Request $request,$id)
    {
      $id   = base64_decode($id);   
      $userLocation = UserStoreLocation::where('user_id',$id)->with('countryDetail','stateDetail')->get()->toArray();
      $page =  'cashTransfer';
      return view('admin.UserCashTransfer.userStoreaddress',compact('page','userLocation'));
    }
}
