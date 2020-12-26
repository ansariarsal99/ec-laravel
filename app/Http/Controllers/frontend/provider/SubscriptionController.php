<?php

namespace App\Http\Controllers\frontend\provider;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use Auth;
use Hash;
use App\Country;
use App\UserPaymentCard;
use App\UserType;
use App\Subscription,App\UserSubscription;
use App\UserStoreLocation,App\UserSubscriptionPayment;
use DateTime;

class SubscriptionController extends Controller
{

 public function expirySubscriptionPackRegister(Request $request){
        $data = $request->all();
        // dd($data);
        $userId     = Auth::user()->id;
        $userProp   = Subscription::where('id',$data['subscriptionId'])->first();
        $collection = UserSubscription::where('user_id',$userId)->delete();

        if (!empty($userProp)) {
          $data       = $request->except('subscribe_id');
          $subscription =  UserSubscription::create([
                                    'user_id'        =>$userId,
                                'subscription_id'    =>$data['subscriptionId'],
                                    'price'          =>$userProp['price'],
                                    'title'          =>$userProp['title'],
                                    'description'    =>$userProp['description'],
                                    'time_limit'     =>$userProp['time_limit'],
                                    'time_type'      =>$userProp['time_type'],
                                    'status'         =>$userProp['status']
                              ]);
        }


       $subscriptionId     = $subscription->id;

        // date_default_timezone_set('Asia/Kolkata');
        $now = new DateTime();

        if($subscription['time_type']=='hour'){
         // $current_time_zone = 150;
         $expiryTime  = $subscription['time_limit'];
         $new_time    = date("Y-m-d H:i:s", strtotime("+$expiryTime hour"));
      
        }elseif($subscription['time_type']=='week'){

         $expiryTime  = $subscription['time_limit'];
         $new_time= date("Y-m-d H:i:s", strtotime("+$expiryTime week"));
         // dd($new_time);

        }elseif($subscription['time_type']=='month'){

         $expiryTime  = $subscription['time_limit'];
         $new_time = date("Y-m-d H:i:s", strtotime("+$expiryTime month"));
         // dd($new_time);

        }

       $prop = User::where('id',$data['userId'])->update([
                               'user_subscription_id'         =>$subscriptionId,
                               'expiry_subscription_package'  =>$new_time
                           ]);

      
       if (!empty($subscription)) {
            $response['status']='true';
            $response['id']=$subscription->id;
       }else{
            $response['status']='false';
            $response['id']='';
       }
       return $response;
    }


    public function updateSubscriptionPackRegister(Request $request){
        $data = $request->all();
        $userId     = Auth::user()->id;
        $userProp   = Subscription::where('id',$data['subscriptionId'])->first();
        // $collection = UserSubscription::where('user_id',$userId)->delete();

        if (!empty($userProp)) {
        $subscription =  UserSubscription::create([
                                  'user_id'        =>$userId,
                              'subscription_id'    =>$data['subscriptionId'],
                                  'price'          =>$userProp['price'],
                                  'title'          =>$userProp['title'],
                                  'description'    =>$userProp['description'],
                                  'time_limit'     =>$userProp['time_limit'],
                                  'time_type'      =>$userProp['time_type'],
                                  'status'         =>$userProp['status']
                            ]);
          }

       $subscriptionId     = $subscription->id;
        // dd($subscriptionId);


       // date_default_timezone_set('Asia/Kolkata');
       $now = new DateTime();

       if($subscription['time_type']=='hour'){
        // $current_time_zone = 150;
        $expiryTime  = $subscription['time_limit'];
        $new_time    = date("Y-m-d H:i:s", strtotime("+$expiryTime hour"));
       
       }elseif($subscription['time_type']=='week'){

        $expiryTime  = $subscription['time_limit'];
        $new_time= date("Y-m-d H:i:s", strtotime("+$expiryTime week"));
        // dd($new_time);

       }elseif($subscription['time_type']=='month'){

        $expiryTime  = $subscription['time_limit'];
        $new_time = date("Y-m-d H:i:s", strtotime("+$expiryTime month"));
        // dd($new_time);

       }

       UserSubscription::where('user_id',$userId)->update([
                             'expiry_subscription_package'  =>$new_time
                        ]);

       User::where('id',$userId)->update([
                              'user_subscription_id'         =>$subscriptionId,
                              'expiry_subscription_package'  =>$new_time
                          ]);


      
       if (!empty($subscription)) {
            $response['status']='true';
            $response['id']=$subscription->id;
       }else{
            $response['status']='false';
            $response['id']='';
       }
       return $response;
    }

    public function paymentSubscriptionPackRegister(Request $request)
    {
      // dd('here');
       // $userCards = UserPaymentCard::where('user_id',Auth::user()->id)
       //                                           ->orderBy('id','desc')
       //                                           ->get()
       //                                           ->toArray();
       $userCards = UserPaymentCard::where('user_id',Auth::user()->id)
                                                        ->orderBy('id','desc')
                                                        ->get()
                                                        ->toArray();
        // dd($userCards);
                                                  

      return view('frontend.login.provider.subscription.paymentSubscription',compact('userCards'));
    }


    

    public function subscriptionPayment(Request $request)
      { 
        $data = $request->all();  



        // dd($data);

        if($data['type']=='card'){

             // dd($subscription);

            $providerPaymentDelete = UserSubscriptionPayment::where('user_id',Auth::user()->id)->delete();
            $collectionDeleteSubscriptionPack = UserSubscription::where('user_id',Auth::user()->id)->delete();
            $userId = Auth::user()->id;
            

            $type='card';        
           
            $subscription = Subscription::where('id',$data['subscriptionId'])->first();
            $userProp = UserPaymentCard::where('id',$data['cardId'])->first();
            $var = 'inactive';
            $userSubscription =  UserSubscription::create([
                                      'user_id'        =>$userId,
                                  'subscription_id'    =>$data['subscriptionId'],
                                      'price'          =>$subscription['price'],
                                      'title'          =>$subscription['title'],
                                      'description'    =>$subscription['description'],
                                      'time_limit'     =>$subscription['time_limit'],
                                      'time_type'      =>$subscription['time_type'],
                                      'status'         =>$subscription['status']
                                ]);

            $providerSubscriptionPayment =  UserSubscriptionPayment::create([
                                  'user_id'              =>$userId,
                                  'payment_type'         =>$type,
                                  'card_type'            =>$userProp['card_type'],
                                  'card_no'              =>$userProp['card_no'],
                                  'name_on_card'         =>$userProp['name_on_card'],
                                  'expiry_month'         =>$userProp['expiry_month'],
                                  'expiry_year'          =>$userProp['expiry_year'],
                                  'cvv'                  =>$userProp['cvv'],
                                  'use_card_as_default'  =>$userProp['use_card_as_default'],
                                  // 'status'               =>$var
                            ]);
            
            User::where('id',$userId)->update(['transaction_status'=>$var]);

            $now = new DateTime();

            if($userSubscription['time_type']=='hour'){
             // $current_time_zone = 150;
             $expiryTime  = $userSubscription['time_limit'];
             $new_time    = date("Y-m-d H:i:s", strtotime("+$expiryTime hour"));
            
            }elseif($userSubscription['time_type']=='week'){

             $expiryTime  = $userSubscription['time_limit'];
             $new_time= date("Y-m-d H:i:s", strtotime("+$expiryTime week"));
             // dd($new_time);

            }elseif($userSubscription['time_type']=='month'){

             $expiryTime  = $userSubscription['time_limit'];
             $new_time = date("Y-m-d H:i:s", strtotime("+$expiryTime month"));
             // dd($new_time);

            }

            UserSubscription::where('user_id',$userId)->update([
                                  'expiry_subscription_package'  =>$new_time
                             ]);

            User::where('id',$userId)->update([
                                   'user_subscription_id'         =>$userSubscription['id'],
                                   'expiry_subscription_package'  =>$new_time
                               ]);


          if (!empty($providerSubscriptionPayment)) {
                  $response['status']='true';
                   Session::flash('success','Your payment is successfully paid');
             }else{
            // dd('out');

                  $response['status']='false';
                  $response['id']='';
             }
        return $response;

        }else if($data['type']=='cash'){
            $providerPaymentDelete = UserSubscriptionPayment::where('user_id',Auth::user()->id)->delete();
            $collectionDeleteSubscriptionPack = UserSubscription::where('user_id',Auth::user()->id)->delete();
            // dd('in');
           if(isset($data['uploader']) && !empty($data['uploader']))
             {
                $image = $request->file('uploader');
                $value = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                $destination_path = invoiceImageBasePath;
                $image->move($destination_path,$value);
                // dd($value);
                $userId = Auth::user()->id;
                $var = 'inactive';
                $cashpayment=   UserSubscriptionPayment::create([
                                              'user_id'              =>$userId,
                                          'invoice_image'            =>$value,
                                          'payment_type'             =>$data['type'],
                                              // 'status'               =>$var
                                      ]);
                User::where('id',$userId)->update(['transaction_status'=>$var]);

                

                 $cardId =  $cashpayment->id;

                 if (!empty($cashpayment)) {
                      $response['status']='true';
                       Session::flash('success','Your payment is not approved by admin');
                     
                 }else{
                      $response['status']='false';
                      $response['id']='';
                 }
                return $response;
               
            }
       }else if($data['type']=='wiretransfer'){
                $providerPaymentDelete = UserSubscriptionPayment::where('user_id',Auth::user()->id)->delete();
                $collectionDeleteSubscriptionPack = UserSubscription::where('user_id',Auth::user()->id)->delete();
                // dd($data);
               if(isset($data['uploader']) && !empty($data['uploader']))
                 {
                    $image = $request->file('uploader');
                    $value = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                    $destination_path = invoiceImageBasePath;
                    $image->move($destination_path,$value);
                    // dd($value);
                    $userId = Auth::user()->id;
                    $var = 'inactive';
                    $cashpayment=   UserSubscriptionPayment::create([
                                                  'user_id'              =>$userId,
                                              'invoice_image'            =>$value,
                                              'payment_type'             =>$data['type'],
                                                  // 'status'               =>$var
                                          ]);
                    User::where('id',$userId)->update(['transaction_status'=>$var]);

                     $cardId =  $cashpayment->id;

                     if (!empty($cashpayment)) {
                          $response['status']='true';
                           Session::flash('success','Your payment is not approved by admin');
                         
                     }else{
                          $response['status']='false';
                          $response['id']='';
                     }
                    return $response;
                   
                }
            }

       
      // return $response;
    }  
}
