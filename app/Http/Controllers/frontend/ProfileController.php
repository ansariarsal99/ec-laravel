<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use Auth;
use Hash;
use Intervention\Image\ImageManagerStatic as Image;
use App\Country;
use App\UserDeliveryAddress;
use App\UserPaymentCard;
use App\UserType;
use App\Membership;
use App\MembershipLevel;
use App\UserAdvertisement;
use DataTables;
use App\City;
use App\Order;
use App\OrderItem;
use App\UserRating;
use  PDF;
use Illuminate\Support\Facades\Mail;
use App\Product;
use App\ProductOrderStatus;

class ProfileController extends Controller
{
    
    public function userProfile(Request $request) {
        try{

            $user = User::with('userTypeDetail')->where('id',Auth::user()->id)->first();
            $user = !empty($user) ? $user->toArray() : [];
            // dd($user);
            $page = 'myProfile';
            return view('frontend.login.user.profile.viewProfile',compact('user','page'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userEditProfile(Request $request) {

        try{
            if ($request->isMethod('post')) {
                $data = $request->except('_token');
                // dd($data);
                $profileImage = Auth::user()->profile_image;
                if(isset($data['profile_image']) && !empty($data['profile_image'])){
                    // dd($data);
                    $image = $request->file('profile_image');
                    $ext = $image->getClientOriginalExtension();
                    // dd($image);
                    $data['profile_image'] = time().'_'.rand().'.'.$ext;

                    $destination_path = userProfileImageBasePath;

                    if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                        $image = Image::make($request->file('profile_image'));
                        $image = $image->resize(600,null,function($constraint){
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });

                        $image->save($destination_path.'/'.$data['profile_image']);

                        if($profileImage != null && file_exists(userProfileImageBasePath.'/'.$profileImage) ) {
                            unlink(userProfileImageBasePath.'/'.$profileImage);
                        }

                    }else{
                        return redirect()->back()->with('error',trans('messages.frontend.user_profile.invalid_file_extension'));
                    }
                    
                }else{
                    $data['profile_image'] = $profileImage;
                }

                $updateUser = User::where('id',Auth::user()->id)->update($data);
                Session::flash('success',trans('messages.frontend.user_profile.profile_update_success'));
                return redirect('/user/profile');
            }

            $user = User::where('id',Auth::user()->id)->first();
            $user = !empty($user) ? $user->toArray() : [];
            $userTypes = UserType::where('type','user')->get()->toArray();
            // dd($user);
            $page = 'myProfile';
            return view('frontend.login.user.profile.editProfile',compact('user','page','userTypes'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userChangePassword(Request $request) {
        try{

            if ($request->isMethod('post')) {
                $data = $request->all();
                if(isset($data['current_password']) && !empty($data['current_password'])){
                    $user_data=User::where(['id'=>Auth::user()->id])->first();
                    if(Hash::check($data['current_password'],$user_data['password'])){
                        if(empty($user_data) || $user_data==null){
                            Session::flash('error',trans('messages.frontend.change_password.old_password_not_match'));
                            return redirect()->back();
                        }else{
                            if(isset($data['new_password']) && !empty($data['new_password'])){
                                $password=Hash::make($data['new_password']);
                                $update=User::where(['id'=>Auth::user()->id])->update(['password'=>$password]);
                                Session::flash('success',trans('messages.frontend.change_password.password_update_success'));
                                return redirect('/user/profile');
                            }
                        }
                    }else{
                        Session::flash('error',trans('messages.frontend.change_password.old_password_not_match'));
                        return redirect()->back();
                    }
                }else{
                    Session::flash('error',trans('messages.frontend.change_password.old_password_not_match'));
                    return redirect()->back();
                }
            }
            $page = 'myProfile';
            return view('frontend.login.user.profile.changePassword',compact('page'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userLocations(Request $request) {
        try{
            // dd($user);
            $countries = Country::orderBy('name','asc')->get()->toArray();
            $userAddresses = UserDeliveryAddress::where('user_id',Auth::user()->id)
                                                 ->with(['countryDetail'=>function($q){ $q->select('id','name'); },'cityDetail'])
                                                 ->orderBy('id','desc')
                                                 ->get()
                                                 ->toArray();
            // dd($userAddresses);
            $page = 'myLocations';
            return view('frontend.login.user.locations.myLocations',compact('page','countries','userAddresses'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userPaymentMethods(Request $request) {
        try{
            $userCards = UserPaymentCard::where('user_id',Auth::user()->id)
                                                 ->orderBy('id','desc')
                                                 ->get()
                                                 ->toArray();
            // dd($userCards);
            $page = 'paymentMethods';
            return view('frontend.login.user.paymentMethods.paymentMethods',compact('page','userCards'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userAddAddress(Request $request) {
        try{
            if($request->isMethod('post')){
                $data = $request->except('_token');
                $data['user_id'] = Auth::user()->id; 
                // dd($data);
                $createAddressId = UserDeliveryAddress::create($data)->id;
                if (!empty($createAddressId) && $createAddressId!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.add_address_success'));
                    return redirect('/user/locations');
                }else{
                    Session::flash('error',trans('messages.frontend.common_error'));
                    return redirect()->back();
                }
            }else{
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userAddCard(Request $request) {
        // dd('here');
        try{
            if($request->isMethod('post')){
                $data = $request->except('_token');
                $data['user_id'] = Auth::user()->id; 
                // dd($data);
                $createPaymentMethodId = UserPaymentCard::create($data)->id;
                if (!empty($createPaymentMethodId) && $createPaymentMethodId!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.add_card_success'));
                    return redirect('/user/paymentMethods');
                }else{
                    Session::flash('error',trans('messages.frontend.common_error'));
                    return redirect()->back();
                }
            }else{
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userEditAddressModal($encAddrsId, Request $request) {
        try{
            $decAddrsId = base64_decode($encAddrsId);
            // dd($decAddrsId);
            $countries = Country::orderBy('name','asc')->get()->toArray();
            $userAddress = UserDeliveryAddress::where('id',$decAddrsId)->first();
            $userAddress = !empty($userAddress) ? $userAddress->toArray() : [];
            $cities = City::where('country_id',$userAddress['country_id'])->orderBy('name','asc')->get()->toArray();
            // dd($cities);
            $html = view('frontend.include.modals.userEditAddressRender',compact('countries','userAddress','encAddrsId','cities'))->render();
            // dd($html);
            return array('status'=>'success','html'=>$html);
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userUpdateAddress(Request $request) {
        try{
            $data = $request->except('_token','address_id');
            $decAddrsId = base64_decode($request->address_id);
            // dd($decAddrsId);
            $update = UserDeliveryAddress::where('id',$decAddrsId)->update($data);
            // dd($update);
            if ($update==1) {
                Session::flash('success',trans('messages.frontend.user_profile.update_address_success'));
                return redirect('/user/locations');
            }else{
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userDeleteAddress($encAddrsId, Request $request) {
        try{
            $decAddrsId = base64_decode($encAddrsId);
            $delUserAddress = UserDeliveryAddress::where('id',$decAddrsId)->delete();
            // dd($delUserAddress);
            return array('status'=>'success');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userEditCardModal($encCardId, Request $request) {
        try{
            $decCardId = base64_decode($encCardId);
            // dd($decCardId);
            $userCard = UserPaymentCard::where('id',$decCardId)->first();
            $userCard = !empty($userCard) ? $userCard->toArray() : [];
            // dd($userCard);
            $html = view('frontend.include.modals.userEditCardRender',compact('userCard','encCardId'))->render();
            // dd($html);
            return array('status'=>'success','html'=>$html);
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userUpdateCard(Request $request) {
        try{
            $data = $request->except('_token','card_id');
            $decCardId = base64_decode($request->card_id);
            // dd($request->all());
            $update = UserPaymentCard::where('id',$decCardId)->update($data);
            // dd($update);
            if ($update==1) {
                Session::flash('success',trans('messages.frontend.user_profile.update_card_success'));
                return redirect('/user/paymentMethods');
            }else{
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userDeleteCard($encCardId, Request $request) {
        try{
            $decCardId = base64_decode($encCardId);
            $delUserCard = UserPaymentCard::where('id',$decCardId)->delete();
            // dd($decCardId);
            return array('status'=>'success');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userUpdateDefaultCard(Request $request) {
        try{
            if($request->isMethod('post')){
                $data = $request->except('card_id','_token');
                $decCardId = base64_decode($request->card_id);
                // $updatePaymentCard = UserPaymentCard::where('id',$decCardId)->update($data);
                // if ($data['use_card_as_default']=='yes') {
                //     $updateOtherPaymentCards = UserPaymentCard::where('id','<>',$decCardId)
                //                                                ->where('user_id',Auth::user()->id)
                //                                                ->update(['use_card_as_default'=>'no']);
                // }
                $updatePaymentCard = UserPaymentCard::where('id',$decCardId)->update(['use_card_as_default'=>'yes']);
                $updateOtherPaymentCards = UserPaymentCard::where('id','<>',$decCardId)
                                                           ->where('user_id',Auth::user()->id)
                                                           ->update(['use_card_as_default'=>'no']);
                // dd($updatePaymentCard);
                if (!empty($updatePaymentCard) && $updatePaymentCard!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.update_card_success'));
                    return redirect('/user/paymentMethods');
                }else{
                    Session::flash('error',trans('messages.frontend.common_error'));
                    return redirect()->back();
                }
            }else{
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userUpdateDefaultAddress(Request $request) {
        try{
            if($request->isMethod('post')){
                $data = $request->except('address_id','_token');
                $decAddressId = base64_decode($request->address_id);
                // dd($decAddressId);
                // $updateDeliveryAddress = UserDeliveryAddress::where('id',$decAddressId)->update($data);
                // if ($data['use_address_as_default']=='yes') {
                //     $updateOtherDeliveryAddresses = UserDeliveryAddress::where('id','<>',$decAddressId)
                //                                                ->where('user_id',Auth::user()->id)
                //                                                ->update(['use_address_as_default'=>'no']);
                // }
                $updateDeliveryAddress = UserDeliveryAddress::where('id',$decAddressId)->update(['use_address_as_default'=>'yes']);
                $updateOtherDeliveryAddresses = UserDeliveryAddress::where('id','<>',$decAddressId)
                                                           ->where('user_id',Auth::user()->id)
                                                           ->update(['use_address_as_default'=>'no']);
                // dd($updateDeliveryAddress);
                if (!empty($updateDeliveryAddress) && $updateDeliveryAddress!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.update_address_success'));
                    return redirect('/user/locations');
                }else{
                    Session::flash('error',trans('messages.frontend.common_error'));
                    return redirect()->back();
                }
            }else{
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

        public function userAdvertisement(Request $request)
   {
        
         // dd($expiry_date);
         $page = 'advertisement';
        return view('frontend.login.user.advertisement.Advertisement',compact('page'));
           
    }

   public function userAdvertisementListIndex(Request $request)
    {

        $userId = Auth::user()->id;
        $UserAdvertisementLIst = UserAdvertisement::select('user_advertisements.*')->where('user_id',$userId)->get();
     
       return DataTables::of($UserAdvertisementLIst)
              ->addIndexColumn()

              ->editColumn('image', function ($UserAdvertisementLIst) {
                    if(!empty($UserAdvertisementLIst->image) && file_exists(public_path('frontend/imgs/advert_image/'.$UserAdvertisementLIst->image))){
                        $image = asset('public/frontend/imgs/advert_image/'.$UserAdvertisementLIst->image);
                    }
                    else{
                        $image = asset('public/admin/images/upload-placeholder.png');
                    }
                 
                   return '<img class="img_td" src="'.$image.'" width="80px"/>';
                })   

               ->addColumn('action', function ($UserAdvertisementLIst) {
                  return 
                '<a href="' . url("user/advertisemnt/user/edit/".base64_encode($UserAdvertisementLIst->id)) . '" class="edit-btn cp text-primary">Edit</a>
                 <a href="' . url("user/advertisemnt/user/delete/".base64_encode($UserAdvertisementLIst->id)) . '" class="delete-btn cp text-danger" del_idd="'.$UserAdvertisementLIst->id.'" > Delete</a>';

                })
              ->escapeColumns([])
              ->make(true);    
           
    }

      public function deleteAdvertisement(Request $request,$id){
        
        $id   = $request->id;
        $data =   UserAdvertisement::where('id',$id)->delete();

          Session::flash('success','Advertisement deleted successfully');
         return array('status'=>'success');
           
    }

    public function AddAdvertisement(Request $request)
    {   
        if($request->isMethod('post')){ 
          $data = $request->all(); 
          $userId = Auth::user()->id;
       
          // dd($data['uploader']);
           if(isset($data['uploader']) && !empty($data['uploader'])){

                $image = $request->file('uploader');

                $value = time().'_'.rand().'.'.$image->getClientOriginalExtension();

                $destination_path = frontendAdvertImageBasePath;

                $image->move($destination_path,$value);
               } 
               
               $publish_date = date('Y-m-d H:i:s');
               $expiry_date =  date('Y-m-d H:i:s', strtotime($publish_date . ' +1 month'));


                        $admin = UserAdvertisement::create([

                            'advertisement_appearence_id' => $data['advertisement_appearence_id'],
                            'payment_method'              =>$data['payment_method'],
                            'title'                       =>$data['title'],
                            'publish_date'                =>$publish_date,
                            'expiry_date'                 =>$expiry_date,
                            'image'                       =>$value,
                             'user_id'                    =>$userId
                           ]);

                    Session::flash('success',('Advertisement added successfully'));
                    return redirect('user/advertisemnt/list');    
            }
         $page = 'advertisement';
        return view('frontend.login.user.advertisement.AddAdvertisement',compact('page'));
           
    }

    

    public function EditAdvertisement(Request $request,$id)
    {  
       $id = base64_decode($request->id);
       $UserAdvertisement = UserAdvertisement::where('id',$id)->with('advertisementAppearence')->first(); 
       // dd($UserAdvertisement);
        if($request->isMethod('post')){ 
          $data = $request->all(); 
          $data = $request->except('_token');
          // dd($data);
          $userId = Auth::user()->id;
               if(!empty($data['image'])){

                   if(isset($data['image']) && !empty($data['image'])){

                        $image = $request->file('image');

                        $value = time().'_'.rand().'.'.$image->getClientOriginalExtension();

                        $destination_path = frontendAdvertImageBasePath;

                        $image->move($destination_path,$value);
                        
                        $updateImage = UserAdvertisement::where('id',$data['id'])->update([
                                                                         'image' => $value
                                                                           ]);

                        $prev_img    = UserAdvertisement::where('id',$data['id'])->value('image');

                        if (!empty($prev_img) && file_exists(public_path('public/frontend/imgs/advert_image/'.$prev_img))) {
                            // unlink(base_path('public/frontend/imgs/advert_image/'.$prev_img));
                            $unlink_img = unlink(base_path('public/frontend/imgs/advert_image/'.$prev_img));
                        }
                      
                    } else{
                        unset($data['image']);
                    }
               }
                    
                $adverisemnt = UserAdvertisement::where('id',$data['id'])->first();          
                $admin = UserAdvertisement::where('id',$data['id'])->update([

                    'advertisement_appearence_id' =>$data['advertisement_appearence_id'],
                    'payment_method'              =>$data['payment_method'],
                     'title'                      =>$data['title']
                   ]);

                Session::flash('success',('Advertisement updated successfully'));
                return redirect('user/advertisemnt/list');
                        
            }
      
       
         $page = 'advertisement';
        return view('frontend.login.user.advertisement.EditAdvertisement',compact('page','UserAdvertisement'));
           
    }

    public function myMembership(Request $request){
        
        $membership =   Membership::first();
        $membershipLevel =   MembershipLevel::get()->toArray();
        // dd($membershipLevel);
        $page = 'membership';
        return view('frontend.login.user.membership.membership',compact('page','membership','membershipLevel'));
           
    }

   public function myOrders(Request $request){
          $page = 'myOrder';

          $ordersItemStatus = Order::with('orderItems.productName.product_Image_for_order_Item' ,'orderItems.delivery_address','orderItems.productName.sellerName','orderItems.productOrderStatus')->where('user_id',Auth::user()->id)->with(['orderItems'=>function($query){
                  return $query->where('product_order_status_id','=',5);
              }
          ])
          ->whereHas('orderItems', function($q){
              $q->where('product_order_status_id', '=', 5);
          })
          ->get()
          ->toArray();  

          // dd($ordersItemStatus);


          $deliveredOrderItems = Order::with('orderItems.productName.product_Image_for_order_Item' ,'orderItems.delivery_address','orderItems.productName.sellerName','orderItems.productOrderStatus')->where('user_id',Auth::user()->id)->with(['orderItems'=>function($query){
                  return $query->where('product_order_status_id','=',8);
              }
          ])
          
          ->whereHas('orderItems', function($q){
              $q->where('product_order_status_id', '=', 8);
          })
          ->get()
          ->toArray();  

          // dd($cancelledOrderItems);

          //  $ordersItemStatus= Order::with('orderItems.productName.product_Image_for_order_Item' ,'orderItems.delivery_address','orderItems.productName.sellerName')->where('user_id',Auth::user()->id)->with(['orderItems'=>function($query)
          //     {
          //         return $query->where('product_order_status_id','=',1);
          //     }
          // ])
          // ->get()->toArray();


          $orders = Order::with('orderItems.productName.product_Image_for_order_Item' ,'orderItems.delivery_address','orderItems.productName.sellerName','orderItems.productOrderStatus')->where('user_id',Auth::user()->id)->get()->toArray();
          // dd($orders);
          $orderId = Order::with('orderItems.productName.product_Image_for_order_Item','orderItems.delivery_address','orderItems.productName.sellerName')->where('user_id',Auth::user()->id)->pluck('id')->toArray();

          $cancelRequestAcceptedBySeller = OrderItem::whereIn('order_id',$orderId)->where('product_order_status_id',1)->get()->toArray();

          return view('frontend.login.user.product.myOrder',compact('page','orders','ordersItemStatus','deliveredOrderItems'));
      }


      public function orderDetails(Request $request,$id){
      
       $orderDetail= Order::with('orderItems.productName.product_Image_for_order_Item' ,'orderItems.delivery_address','orderItems.productName.sellerName')->where('user_id',Auth::user()->id)->where('invoice_id',base64_decode($id))->first();
    
       $orderItemDelivery  = OrderItem::with('productName.product_Image_for_order_Item','delivery_address','productName.sellerName')->where('order_id',$orderDetail['id'])->first();

       $orderItem  = OrderItem::with('productName.product_Image_for_order_Item','delivery_address','productName.sellerName','productName.storeUnderProduct')->where('order_id',$orderDetail['id'])->get()->toArray();
       // dd($orderItem); 
       $page = 'orderDetails';
       return view('frontend.login.user.product.orderDetails',compact('page','orderDetail','orderItem','orderItemDelivery','id'));
     }

     ///////////////////////Cancelled order details/////////////
      public function ProfileControllercancelledOrderDetails(Request $request,$id){
       
       $orderDetail= Order::with('orderItems.productName.product_Image_for_order_Item' ,'orderItems.delivery_address','orderItems.productName.sellerName')->where('user_id',Auth::user()->id)->where('invoice_id',base64_decode($id))->first();
    
       $orderItemDelivery  = OrderItem::with('productName.product_Image_for_order_Item','delivery_address','productName.sellerName')->where('order_id',$orderDetail['id'])->first();

       $orderItem  = OrderItem::with('productName.product_Image_for_order_Item','delivery_address','productName.sellerName','productName.storeUnderProduct')->where('order_id',$orderDetail['id'])->get()->toArray();
       // dd($orderItem); 
       $page = 'orderDetails';
       return view('frontend.login.user.product.orderDetails',compact('page','orderDetail','orderItem','orderItemDelivery','id'));
    }

    

    public function myRatingReview(Request $request){
        $input = $request->all();
        if($input['rating'] ==null){
           $input['rating']=1; 
        }
   
        $orders = UserRating::create([                        
                               'user_id'    =>Auth::user()->id, 
                               'product_id' =>$input['productId'],
                               'rating'     =>$input['rating'],
                               'review'     =>$input['review']
                           ])->id;

        if(!empty($orders)){
             Session::flash('success',('Review and Rating successfully added to product'));
            return redirect('user/product/myOrders');
        }else{
            Session::flash('error',('something went wrong'));
            return redirect()->back();
        }


    }

    public function getWithoutPdf(Request $request)
    {  
        $input = $request->all();
      
        $orderDetail =Order::with('orderItems')->where('user_id',Auth::user()->id)->where('invoice_id',base64_decode($input['id']))->first();

        $orderItem = OrderItem::with('delivery_address','storeAddress')->where('order_id',$orderDetail['id'])->get()->toArray();
        // dd();

        $view = \View::make('frontend.login.user.product.orderInvoice', ['page' => 'pdfquest','orderDetail' => $orderDetail,'orderItem'=>$orderItem]);
        $html_content = $view->render();
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('orderInvoice.pdf', 'D');
        return redirect()->back();
    }

    public function  cancelOrder(Request $request){
         $input          = $request->all();
         // dd($input);
         $productStatus = ProductOrderStatus::where('id',4)->first();
         $oderItemStatus = OrderItem::where('order_id',$input['orderId'])->where('product_id',$input['productId'])
                        ->update([
                                'status'=>'User Cancellation Request',
                                'cancellationReason'=>$input['reason'],
                                'product_order_status_id' => $productStatus['id']
                                ]);
         
         $itemRecord = Order::where('id',$input['orderId'])->first();

         $productDetail = Product::where('id',$input['productId'])->first();
         $orderDEtailForEmail = OrderItem::where('order_id',$input['orderId'])->first();
         $UserDetail = User::where('id',$orderDEtailForEmail['seller_id'])->first();
          
          if (!empty($oderItemStatus)) {
             $email   = $UserDetail['email'];
             $subject = PROJECT_NAME." Cancellation request";
             $links = [];
             $links['email'] = $email;
             
             $links['name'] = Auth::user()->first_name.' '.Auth::user()->last_name;
             $links['seller_name'] = $UserDetail['contact_name'].' '.$UserDetail['contact_last_name'];
             $links['order_id']    = $itemRecord['invoice_id'];
             $links['placed_on']   = $itemRecord['placed_on'];
             $links['Product_name']         = $productDetail['item_name'];
             $links['cancellationReason']   = $input['reason'];

             // $productDetail

             if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){

                Mail::send('frontend.emails.productCancellationRequest',['order_id' => $links['order_id'],
                                             'placed_on'          => $links['placed_on'],
                                             'name'               => $links['name'],
                                             'seller_name'        => $links['seller_name'],
                                             'product_name'       => $links['Product_name'],
                                             'cancellationReason' => $links['cancellationReason'],

                                                     ],function($message) use($email, $subject)
                   {
                       $message->to($email)->subject($subject);
                   });
               }
                $response['status']='true';
                Session::flash('success',('Product Cancellation Request has been sent to seller'));               
          }else{
                $response['status']='false';
          }

         return $response;
    }


}
