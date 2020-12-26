<?php

namespace App\Http\Controllers\frontend\provider;

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
use App\UserStoreLocation;
use App\State,App\UserSubscription;
use App\UserTermOfPayment;
use App\UserTermOfPaymentQuota;
use App\UserAdvertisement;
use App\AdvertisementAppearence;
use App\Membership;
use App\MembershipLevel;
use DateTime;
use DataTables;
use App\Subscription;
// App\UserSubscription;
use App\UserProfessionImage,App\AdminWireTransferDetail;
use File;
use App\UserSelectedService,App\UserOtherService,App\UserProperty;
use App\StoreLocationAddressType;
// use App\UserSelectedProjectField;
use App\City;
use App\UserSelectedProjectField;
use App\UserProjectField;
use App\DeliveryTermAndCondtion;
use App\ProviderDeliveryOption;
use App\UserBrandImage;

use App\userProductSelectedCategory;
use App\userProductSelectedSubCategory;
use App\UserProductMaterialList;
use App\productSellingMaterial;

use App\ProductCategory;
use App\ProductSubCategory;


class ProfileController extends Controller
{
    //
   public function providerProfile(Request $request) {
          try{

               $user = User::with('userTypeDetail','userPropertyDetail','countryDetail','userSelectedOtherDetail','userSelectedprojrctField.userProjectFieldDetail','userMultipleCategories','userMultipleSubCategories','userMultipleSellingMaterial')->where('id',Auth::user()->id)->first();

              $user = !empty($user) ? $user->toArray() : [];
              $multipleimages = UserProfessionImage::where('user_id',Auth::user()->id)->get()->toArray();
              // dd($user);
              $UserSelectedServices = UserSelectedService::with('userServiceDetail')->where('user_id',Auth::user()->id)->get()->toArray();
              $userSelectedProjectFields = UserSelectedProjectField::with('userProjectFieldDetail')->where('user_id',Auth::user()->id)->get()->toArray();
              
              $brandMultipleImages = UserBrandImage::where('user_id',Auth::user()->id)->get()->toArray();
               // dd($brandMultipleImages);

              $productCategories      = ProductCategory::where('status', 'active')
                                                             ->orderBy('name', 'asc')
                                                             ->get();
                         
              $productSubCategories   = ProductSubCategory::where('status', 'active')
                                                            ->orderBy('name', 'asc')
                                                            ->get();

              $productSellingMaterial = productSellingMaterial::where('status', 'active')
                                                            // ->orderBy('id', 'asc')
                                                            ->get();
              // dd($user);
              $slcted_category_id = [];
               if(!empty($user)){
                   $slcted_category_id = array_map(function($v){ return $v['category_id']; }, $user['user_multiple_categories']);
               }

               $prdctCategory =  ProductCategory::whereIn('id',$slcted_category_id)->pluck('name')->toArray();

               $productCategoryImplode = implode(", ",$prdctCategory);

               

              $slcted_Subcategory_id = [];
               if(!empty($user)){
                   $slcted_Subcategory_id = array_map(function($v){ return $v['sub_category_id']; }, $user['user_multiple_sub_categories']);
               }

               $prdctSubCategory =  ProductSubCategory::whereIn('id',$slcted_Subcategory_id)->pluck('name')->toArray();

               $productSubCategoryImplode = implode(", ",$prdctSubCategory);    

              $slcted_material_id = [];
               if(!empty($user)){
                   $slcted_material_id = array_map(function($v){ return $v['material_id']; }, $user['user_multiple_selling_material']);
               }     

               $sellingMaterial =  productSellingMaterial::whereIn('id',$slcted_material_id)->pluck('selling_material_name')->toArray();

               $productmaterialImplode = implode(", ",$sellingMaterial);          

              // dd($productmaterialImplode);
              // $projectFields = UserProjectField::where('user_type_id',$user['user_type_id'])->get()->toArray();

              $page = 'myProfile';
              return view('frontend.login.provider.profile.viewProfile',compact('user','page','multipleimages','UserSelectedServices','userSelectedProjectFields','brandMultipleImages','slcted_category_id','slcted_Subcategory_id','slcted_material_id','productCategories','productSubCategories','productSellingMaterial','productCategoryImplode','productSubCategoryImplode','productmaterialImplode'));
          }catch(Exception $e){
              \Log::error($e->getMessage());
              Session::flash('error',trans('messages.frontend.common_error'));
              return redirect()->back();
          }
      }

      public function providerEditProfile(Request $request) {
          try{
               if ($request->isMethod('post')) {
                  $dateOfBirth = date('Y-m-d', strtotime($request['date_of_birth']));
                  $updateDateOfBirth  =  User::where('id',Auth::user()->id)->update(['date_of_birth'=>$dateOfBirth]);
                  $data = $request->except('_token','media_ids','imageCount','date_of_birth','category_id','sub_category_id','material_id');

                  $Payload = $request->all(); 

                  $profileImage = Auth::user()->profile_image;

                  if(isset($data['profile_image']) && !empty($data['profile_image'])){
                      $image = $request->file('profile_image');
                      $ext = $image->getClientOriginalExtension();
                      $data['profile_image'] = time().'_'.rand().'.'.$ext;

                      $destination_path = userProfileImageBasePath;

                      if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                          $image = Image::make($request->file('profile_image'));
                          $image = $image->resize(600,null,function($constraint){
                                  $constraint->aspectRatio();
                                  $constraint->upsize();
                              });

                          $image->save($destination_path.'/'.$data['profile_image']);

                          // dd($image);
                          User::where('id',Auth::user()->id )->update(['profile_image'=>$data['profile_image']]);
                          if($profileImage != null && file_exists(userProfileImageBasePath.'/'.$profileImage) ) {
                              unlink(userProfileImageBasePath.'/'.$profileImage);
                          }

                      }else{
                          return redirect()->back()->with('error',trans('messages.frontend.user_profile.invalid_file_extension'));
                      }
                      
                  }else{
                      $data['profile_image'] = $profileImage;
                  }      

                  if(!empty($data['profile_document'])){
                      $image_document = $request->file('profile_document');
                      $value = time().'_'.rand().'.'.$image_document->getClientOriginalExtension();
                      $destination_path = providerDocBasePath;
                      $image_document->move($destination_path,$value);
                        
                      $updatedocument = User::where('id',Auth::user()->id)->update(['profile_document'=>$value]);
                  }

                  $data = $request->except('_token','media_ids','profile_document','profile_image','imageCount','date_of_birth');
                  // dd($data);
                  if ($data['user_property_id']!="2" && $data['user_property_id']!="7" && $data['user_property_id']!="10") {
                      $data['country_id'] = null;
                      $data['gender'] = null;
                      $data['date_of_birth'] = null;
                  }

                  // UserSelectedProjectField::where('user_id',Auth::user()->id)->delete();
                  
                  if (isset($data['project_field_ids']) && !empty($data['project_field_ids'])) {
                     
                      UserSelectedProjectField::where('user_id',Auth::user()->id)
                                                ->delete();

                      foreach ($data['project_field_ids'] as $key => $projectFieldId) {
                          UserSelectedProjectField::create([
                                                             'user_id'=>Auth::user()->id,
                                                             'user_project_field_id'=>$projectFieldId
                                                          ]);
                      }
                  }
                    $data = $request->except('_token','media_ids','imageCount','date_of_birth','project_field_ids','profile_document','profile_image','category_id','sub_category_id','material_id','brand_ids','brandimageCount');

                  $data['landline_isd_code'] = '+'.$data['landline_isd_code'];
                  $updateUser = User::where('id',Auth::user()->id)->update($data);



                   userProductSelectedCategory::where('user_id',Auth::user()->id)->delete();
                   userProductSelectedSubCategory::where('user_id',Auth::user()->id)->delete();
                   UserProductMaterialList::where('user_id',Auth::user()->id)->delete();

                  $updatedUser = user::where('id',Auth::user()->id)->first();     

                  if($updatedUser['user_type_id']=='6'){
                      
                          foreach ($Payload['category_id'] as $key => $value) {
                             userProductSelectedCategory::create([
                                              'user_id'      => Auth::user()->id,
                                              'category_id'  => $value
                                         ]);
                          }
                         
                          if(isset($Payload['sub_category_id'])){
                               foreach ($Payload['sub_category_id'] as $key => $value1) {
                                  userProductSelectedSubCategory::create([
                                                   'user_id'          => Auth::user()->id,
                                                   'sub_category_id'  => $value1
                                              ]);
                               }
                           }
                          

                          foreach ($Payload['material_id'] as $key => $value2) {
                             UserProductMaterialList::create([
                                              'user_id'          => Auth::user()->id,
                                              'material_id'      => $value2
                                         ]);
                          }

                   }

                     


                  Session::flash('success',trans('messages.frontend.user_profile.profile_update_success'));
                  return redirect('/provider/profile');
              }

            $user  = User::with('userTypeDetail','userPropertyDetail','userSelectedOtherDetail','UserProfessionPhotos','countryDetail','userSelectedprojrctField','userMultipleCategories','userMultipleSubCategories','userMultipleSellingMaterial')->where('id',Auth::user()->id)->first();
            
              $user         = !empty($user) ? $user->toArray() : [];
              $userTypes    = UserType::where('type','provider')->get()->toArray();
              $countries    =  Country::orderBy('name','asc')->get()->toArray();
              $imageCount   = UserProfessionImage::where('user_id',Auth::user()->id)->count();
              $userProperties = UserProperty::where('user_type_id',$user['user_type_id'])->get()->toArray();
              

              $productCategories      = ProductCategory::where('status', 'active')
                                                             ->orderBy('name', 'asc')
                                                             ->get();
                         
              $productSubCategories   = ProductSubCategory::where('status', 'active')
                                                            ->orderBy('name', 'asc')
                                                            ->get();

              $productSellingMaterial = productSellingMaterial::where('status', 'active')
                                                            // ->orderBy('id', 'asc')
                                                            ->get();

              $UserSelectedServices   = UserSelectedService::with('userServiceDetail')->where('user_id',Auth::user()->id) ->get()->toArray();


              $selectedProjectField = UserSelectedProjectField::with('userProjectFieldDetail')->where('user_id',Auth::user()->id) ->get()->toArray();
              $projectFields = UserProjectField::where('user_type_id',$user['user_type_id'])->get()->toArray();
              // dd($selectedProjectField['user_project_field_detail']);
              // dd($user);

              $slcted_project_field_id = [];
                 if(!empty($user)){
                     // $product = $product->toArray();
                     $slcted_project_field_id = array_map(function($v){ return $v['user_project_field_id']; }, $user['user_selectedprojrct_field']);
                    // echo '<pre>'; print_r($slcted_project_field_id);die;
                 }    

                 $slcted_category_id = [];
                  if(!empty($user)){
                      $slcted_category_id = array_map(function($v){ return $v['category_id']; }, $user['user_multiple_categories']);
                      // dd($slcted_category_id);
                  }

                 $slcted_Subcategory_id = [];
                  if(!empty($user)){
                      $slcted_Subcategory_id = array_map(function($v){ return $v['sub_category_id']; }, $user['user_multiple_sub_categories']);
                  }

                 $slcted_material_id = [];
                  if(!empty($user)){
                      $slcted_material_id = array_map(function($v){ return $v['material_id']; }, $user['user_multiple_selling_material']);
                  }                 


              
              $experience =$user['experience'];

              $brandimageCount = UserBrandImage::where('user_id',Auth::user()->id)->count();


              $page = 'myProfile';
              return view('frontend.login.provider.profile.editProfile',compact('user','page','userTypes','countries','imageCount','UserSelectedServices','userProperties','projectFields','selectedProjectField','slcted_project_field_id','experience','brandimageCount','slcted_category_id','slcted_Subcategory_id','slcted_material_id','productCategories','productSubCategories','productSellingMaterial'));
          }catch(Exception $e){
              \Log::error($e->getMessage());
              Session::flash('error',trans('messages.frontend.common_error'));
              return redirect()->back();
          }
      }

        public function getSubCategoriesAndMaterialListForSeller(Request $request)
        {

           $data = $request->all();
           // dd($data);

           $subCategories    = ProductSubCategory::whereIn('category_id', $request->input('categoryId'))->get();

           $materialList     = productSellingMaterial::whereIn('product_category_id', $request->input('categoryId'))->get();
           
           $view1   = view('frontend.elements.productSubCategories', compact('subCategories'))->render();
          
           $view2   = view('frontend.elements.providerMaterials',['materialList' => $materialList])->render();
           
           $view    = array($view1,$view2);
           
           return $view;
        }
      
      public function getSubCategoriesBasedMaterialListForSeller(Request $request)
      {
         $data = $request->all();
        
         $materialList = productSellingMaterial::whereIn('product_sub_category_id', $request->input('subCategoryId'))->get();   

         $view = view('frontend.elements.providerMaterialsDependsSubCategories',['materialList' => $materialList])->render();
         return $view;
      } 


    public function providerChangePassword(Request $request) {
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
                                return redirect('/provider/profile');
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
            return view('frontend.login.provider.profile.changePassword',compact('page'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function providerPaymentMethods(Request $request) {
        try{
            $userCards = UserPaymentCard::where('user_id',Auth::user()->id)
                                                 ->orderBy('id','desc')
                                                 ->get()
                                                 ->toArray();

            $wireTransferDetails=AdminWireTransferDetail::first();
                                                 
            // dd($userCards);
            $page = 'paymentMethods';
            return view('frontend.login.provider.paymentMethods.paymentMethods',compact('page','userCards','wireTransferDetails'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function providerAddCard(Request $request) {
        // dd('here');
        try{
            if($request->isMethod('post')){
                $data = $request->except('_token');
                $data['user_id'] = Auth::user()->id; 
                // dd($data);
                $createPaymentMethodId = UserPaymentCard::create($data)->id;
                if (!empty($createPaymentMethodId) && $createPaymentMethodId!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.add_card_success'));
                    return redirect('/provider/paymentMethods');
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

    public function providerEditCardModal($encCardId, Request $request) {
        try{
            $decCardId = base64_decode($encCardId);
            // dd($decCardId);
            $userCard = UserPaymentCard::where('id',$decCardId)->first();
            $userCard = !empty($userCard) ? $userCard->toArray() : [];
            // dd($userCard);
            $html = view('frontend.include.modals.providerEditCardRender',compact('userCard','encCardId'))->render();
            // dd($html);
            return array('status'=>'success','html'=>$html);
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function providerUpdateCard(Request $request) {
        try{
            $data = $request->except('_token','card_id');
            $decCardId = base64_decode($request->card_id);
            // dd($request->all());
            $update = UserPaymentCard::where('id',$decCardId)->update($data);
            // dd($update);
            if ($update==1) {
                Session::flash('success',trans('messages.frontend.user_profile.update_card_success'));
                return redirect('/provider/paymentMethods');
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

    public function providerDeleteCard($encCardId, Request $request) {
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

     public function providerUpdateDefaultCard(Request $request) {
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
                // dd($updatePaymentCard);

                $updatePaymentCard = UserPaymentCard::where('id',$decCardId)->update(['use_card_as_default'=>'yes']);
                $updateOtherPaymentCards = UserPaymentCard::where('id','<>',$decCardId)
                                                           ->where('user_id',Auth::user()->id)
                                                           ->update(['use_card_as_default'=>'no']);

                if (!empty($updatePaymentCard) && $updatePaymentCard!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.update_card_success'));
                    return redirect('/provider/paymentMethods');
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
    public function providerStoreLocations(Request $request) {
        try{

            $countries = Country::orderBy('name','asc')->get()->toArray();
            // dd($user);
            $storeLocations = UserStoreLocation::where('user_id',Auth::user()->id)
                                                 ->with(['countryDetail'=>function($q){ $q->select('id','name'); },
                                                         'stateDetail'=>function($q){ $q->select('id','name'); },
                                                         'cityDetail','storeLocationAddressTypeDetail'])
                                                 ->orderBy('id','desc')
                                                 ->get()
                                                 ->toArray();

            $storeLocationAddressTypes = StoreLocationAddressType::where('status','active')->get()->toArray();
            // dd($storeLocations);
            $page = 'myStoreLocations';
            return view('frontend.login.provider.storeLocations.storeLocations',compact('page','countries','storeLocations','storeLocationAddressTypes'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function providerAddStoreLocation(Request $request) {
        try{

            if($request->isMethod('post')){
                $data = $request->except('_token');
                $data['user_id'] = Auth::user()->id; 
                // dd($data);
                $userLocation = UserStoreLocation::where('user_id',Auth::user()->id)->first();
                if (empty($userLocation)) {
                    $data['use_address_as_default'] = 'yes';
                }
                $createAddressId = UserStoreLocation::create($data)->id;
                if (!empty($createAddressId) && $createAddressId!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.add_store_location_success'));
                    return redirect('/provider/storeLocations');
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

   public function providerUpdateDefaultStoreLocation(Request $request) {
        try{
            if($request->isMethod('post')){
                $data = $request->all();

                $data = $request->except('address_id','_token');
                $decAddressId = base64_decode($request->address_id);
                // $updateDeliveryAddress = UserStoreLocation::where('id',$decAddressId)->update($data);
                // dd($updateDeliveryAddress);
                // if ($data['use_address_as_default']=='yes') {
                //     $updateOtherDeliveryAddresses = UserStoreLocation::where('id','<>',$decAddressId)
                //                                                ->where('user_id',Auth::user()->id)
                //                                                ->update(['use_address_as_default'=>'no']);
                // }
                // dd($updateDeliveryAddress);

                 $updateDeliveryAddress = UserStoreLocation::where('id',$decAddressId)->update(['use_address_as_default'=>'yes']);
                $updateOtherDeliveryAddresses = UserStoreLocation::where('id','<>',$decAddressId)
                                                           ->where('user_id',Auth::user()->id)
                                                           ->update(['use_address_as_default'=>'no']);
                if (!empty($updateDeliveryAddress) && $updateDeliveryAddress!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.update_store_location_success'));
                    return redirect('/provider/storeLocations');
                }else{
                    // dd('else');
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

    public function providerDeleteStoreLocation($encAddrsId, Request $request) {
        try{
            $decAddrsId = base64_decode($encAddrsId);
            $delProviderStoreLocation = UserStoreLocation::where('id',$decAddrsId)->delete();
            // dd($delUserAddress);
            return array('status'=>'success');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function providerEditStoreLocationModal($encAddrsId, Request $request) {
        try{
            $decAddrsId = base64_decode($encAddrsId);
            // dd($decAddrsId);
            $countries = Country::orderBy('name','asc')->get()->toArray();
            $storeLocation = UserStoreLocation::where('id',$decAddrsId)->first();
            $storeLocation = !empty($storeLocation) ? $storeLocation->toArray() : [];
            $cities = City::where('country_id',$storeLocation['country_id'])->orderBy('name','asc')->get()->toArray();
            $states = State::where('country_id',$storeLocation['country_id'])->orderBy('name','asc')->get()->toArray();
            $storeLocationAddressTypes = StoreLocationAddressType::where('status','active')->get()->toArray();
            // dd($cities);
            $html = view('frontend.include.modals.providerEditStoreLocationRender',compact('countries','storeLocation','encAddrsId','states','storeLocationAddressTypes','cities'))->render();
            // dd($html);
            return array('status'=>'success','html'=>$html);
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function providerUpdateStoreLocation(Request $request) {
        try{
            $data = $request->except('_token','address_id');
            $decAddrsId = base64_decode($request->address_id);
            // dd($decAddrsId);
            $update = UserStoreLocation::where('id',$decAddrsId)->update($data);
            // dd($update);
            if ($update==1) {
                Session::flash('success',trans('messages.frontend.user_profile.update_store_location_success'));
                return redirect('/provider/storeLocations');
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

     public function providerSubscription(Request $request){
      try{
         
        $subscriptionRecord = UserSubscription::where('user_id',Auth::user()->id)->first();
         // dd($subscriptionRecord);

        $updatedSubscriptionRecord = Subscription::where('price','>',$subscriptionRecord['price'])->get()->toArray();
        $page = 'subscription';
        return view('frontend.login.provider.subscription.sellerdbSubscription',compact('page','subscriptionRecord','updatedSubscriptionRecord'));
      } catch(Exception $e){
           \Log::error($e->getMessage());
           Session::flash('error',trans('messages.frontend.common_error'));
      } 
    }


    public function providerDeliveryPaymentList(Request $request)
     {
         $page = 'termPayment';
        return view('frontend.login.provider.termPayment.delivery.deliveryPaymentList',compact('page'));
           
     }

   public function providerDeliveryPaymentListIndex(Request $request)
    {

        $userId = Auth::user()->id;
        $DeliveryPaymentList = DeliveryTermAndCondtion::select('delivery_term_and_condtions.*')->where('user_id',$userId)->get();
     
       return DataTables::of($DeliveryPaymentList)
               ->addIndexColumn()   
                
                ->editColumn('delivery_price',function($DeliveryPaymentList) {
                    return !empty($DeliveryPaymentList['delivery_price'])?$DeliveryPaymentList['delivery_price']:'-';
                 })
                
               
               ->addColumn('action', function ($DeliveryPaymentList) {
                  return 
                '<a href="' . url("provider/deliveryTerm/edit/".base64_encode($DeliveryPaymentList->id)) . '" class="edit-btn cp text-primary">Edit</a>
                 <a href="' . url("provider/deliveryTerm/delete/".base64_encode($DeliveryPaymentList->id)) . '" class="delete-btn cp text-danger" del_id="'.$DeliveryPaymentList->id.'" > Delete</a>';

                })
              ->escapeColumns([])
              ->make(true);     
    }

   public function addDeliveryTermsPayment(Request $request){
       try{
           $userId = Auth::user()->id;
           // $number = 401;
           // $conditionCheck = DeliveryTermAndCondtion::where('user_id',$userId)
           //                                           ->where('from_price_range','<=',$number)
           //                                           ->where('to_price_range','>=',$number)
           //                                           // ->where('id','!=',42)
           //                                           ->get()
           //                                           ->toArray();

           //  dd($conditionCheck);
           // $check = false;
           // $conditions = DeliveryTermAndCondtion::where('user_id',$userId)->get()->toArray();
           // foreach ($conditions as $key => $condition) {
           //      if ($number>=$condition['from_price_range'] && $number<=$condition['to_price_range']) {
           //          $check = true;
           //      }
           // }
           // dd($check);
           //          dd('here');


           if($request->isMethod('post')) {
               $data = $request->all();
               // dd($data);
               $userId = Auth::user()->id;
              $deliveryAddressId = DeliveryTermAndCondtion::where('user_id',$userId)->create([
                                           'user_id'          =>$userId,
                                           'from_price_range' =>$data['from_price_range'],
                                           'to_price_range'   =>$data['to_price_range'],
                                           'price_type'       =>$data['price_type']
                                       ]);

                   if($data['delivery_price'] !=null){
                       DeliveryTermAndCondtion::where('id',$deliveryAddressId->id)->update([
                                   'delivery_price' =>$data['delivery_price']
                                        ]);
                   }
                   Session::flash('success','Delivery payment is updated successfully');
                   return redirect('provider/delveryterms/list');
              } 

           $page = 'termPayment';
           return view('frontend.login.provider.termPayment.delivery.assign-delivery-terms',compact('page'));
       } catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
       } 
   }

   public function editDeliveryTermsPayment(Request $request,$id){
       try{

           $id = base64_decode($request->id);
           $delivery = DeliveryTermAndCondtion::where('id',$id)->first();
           // $userId = Auth::user()->id;
           if($request->isMethod('post')) {
               $data = $request->all();
               $userId = Auth::user()->id;
              $deliveryAddressId = DeliveryTermAndCondtion::where('id',$data['delivryId'])->update([
                                           'user_id'          =>$userId,
                                           'from_price_range' =>$data['from_price_range'],
                                           'to_price_range'   =>$data['to_price_range'],
                                           'price_type'       =>$data['price_type'],
                                           'delivery_price'   =>$data['delivery_price']
                                       ]);

                   Session::flash('success','Delivery payment is updated successfully');
                   return redirect('provider/delveryterms/list');
              } 
               // dd($delivery);
           $page = 'termPayment';
           return view('frontend.login.provider.termPayment.delivery.editDelivery',compact('page','delivery'));
       } catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
       } 
   }

   public function deleteDeliveryTermsPayment(Request $request,$id){
     
     $id   = $request->id;
     $data =   DeliveryTermAndCondtion::where('id',$id)->delete();
     Session::flash('success','Delivery payment deleted successfully');
     return array('status'=>'success');

   }
    

  public function providerTermsPayment(Request $request){
      try{
          $userId = Auth::user()->id;
           // dd($userId);

          $termPaymentquota = UserTermOfPayment::where('user_id',$userId)->with('userTermOfPaymentQuotas')->orderBy('id','desc')->get()->toArray();
        
          $page = 'termPayment';
          return view('frontend.login.provider.termPayment.providerTermsOfPayment',compact('page','termPaymentquota'));
      } catch(Exception $e){
           \Log::error($e->getMessage());
           Session::flash('error',trans('messages.frontend.common_error'));
      } 
    }

    public function validateFromOrderAmount(){

       // $check = false;
       $number = $_GET['from_price_range'];
       
       $userId = Auth::user()->id;
       $conditions = DeliveryTermAndCondtion::where('user_id',$userId)->get()->toArray();
        
       $conditionCheck = DeliveryTermAndCondtion::where('user_id',$userId)
                                                 ->where('from_price_range','<=',$number)
                                                 ->where('to_price_range','>=',$number)
       //                                           // ->where('id','!=',42)
                                                 ->get()
                                                 ->toArray();

                            
        if($conditionCheck !=null){
             return 'false';  
         }else{
             return 'true';  

         }

    
      
    }

    public function validateToOrderAmount(){

        $number = $_GET['to_price_range'];
      
        $userId = Auth::user()->id;
        $conditions = DeliveryTermAndCondtion::where('user_id',$userId)->get()->toArray();
         
        $conditionCheck = DeliveryTermAndCondtion::where('user_id',$userId)
                                                  ->where('from_price_range','<=',$number)
                                                  ->where('to_price_range','>=',$number)
        //                                           // ->where('id','!=',42)
                                                  ->get()
                                                  ->toArray();
             
         if($conditionCheck !=null){
              return 'false';  
          }else{

              return 'true';  
          }
   }

    
     public function providerTermsPaymentAddNewMethod(Request $request){
        try{
                // dd($data);
           if($request->isMethod('post')) {
               $data = $request->all();
               $userId = Auth::user()->id;

                $count = UserTermOfPayment::where('user_id',$userId)->count();
                // dd($count);
                if($count <1){
                       $var='yes';
                }else{
                       $var='no';
                }

               $usreTermPayment = UserTermOfPayment::create([
                                                       'name'=>$data['name'],
                                                       'number_of_quota'=>$data['number_of_quota'],
                                                       'user_id'=>$userId,
                                                       'use_term_of_payment_as_default'=> $var
                                                    ])->id;
              
                   foreach ($data['changeQuota'] as $key => $value) {
                     UserTermOfPaymentQuota::create([
                           'user_term_of_payments_id' => $usreTermPayment,
                                'quota_percent'  => $value['quota_percent'],
                                        'title'  => $value['title'],
                                        'user_id'=>$userId
                        ]);
                   }

               Session::flash('success','Record added successfully');
              return redirect('provider/TermsOfPayment');
                
            }

           $page = 'termPayment';
           return view('frontend.login.provider.termPayment.providerTermsPaymentAddNewMethod',compact('page','userId'));
        } catch(Exception $e){
           \Log::error($e->getMessage());
           Session::flash('error',trans('messages.frontend.common_error'));
      } 
    }

    public function validateEditFromOrderAmount( Request $request){

        $data = $request->all();
    
        $number = @$data['from_price_range'];
        $id =$data['id'];  

        $userId = Auth::user()->id;
        // $conditions = DeliveryTermAndCondtion::where('user_id',$userId)->get()->toArray();
         
        $conditionCheck = DeliveryTermAndCondtion::where('user_id',$userId)
                                                  ->where('from_price_range','<=',$number)
                                                  ->where('to_price_range','>=',$number)
                                                  ->where('id','!=',$id)
                                                  ->get()
                                                  ->toArray();
             
         if($conditionCheck !=null){
              return 'false';  
          }else{

              return 'true';  
          }           
         
   }

    public function validateEditToOrderAmount( Request $request){

        $data = $request->all();
        // dd($data);
        
        $number = @$data['to_price_range'];
        $id =$data['id'];  
        $userId = Auth::user()->id;
        // $conditions = DeliveryTermAndCondtion::where('user_id',$userId)->get()->toArray();
         
        $conditionCheck = DeliveryTermAndCondtion::where('user_id',$userId)
                                                  ->where('from_price_range','<=',$number)
                                                  ->where('to_price_range','>=',$number)
                                                  ->where('id','!=',$id)
                                                  ->get()
                                                  ->toArray();
             
         if($conditionCheck !=null){
              return 'false';  
          }else{

              return 'true';  
          }           
   }


      public function providerTermsPaymentEditMethod(Request $request,$id){

          $id = base64_decode($request->id);
          $termPayment = UserTermOfPayment::where('id',$id)->first();
          $termPaymentquota = UserTermOfPaymentQuota::where('user_term_of_payments_id',$termPayment['id'])->get()->toArray();
          $userId = Auth::user()->id;
          
          if($request->isMethod('post')) {
               $data = $request->all();

                    // dd($data); 
               $userId = Auth::user()->id;

               // $termPayment = UserTermOfPayment::where('id',$data['id'])->with('payment')->first(); 
               $usreTermPayment = UserTermOfPayment::where('id',$data['id'])->update([
                                                                                    'name'=>$data['name'],
                                                                                    'number_of_quota'=>$data['number_of_quota']
                                                                                 ]);
               // dd($usreTermPayment['id']);

               $delete_prev = UserTermOfPaymentQuota::where('user_term_of_payments_id',$data['id'])->delete();

               foreach ($data['changeQuota'] as $key => $value) {

                    $termPayment =  UserTermOfPaymentQuota::create([
                                         'user_term_of_payments_id' => $data['id'],
                                                   'quota_percent'  => $value['quota_percent'],
                                                           'title'  => $value['title'],
                                                          'user_id' => $userId
                          ]);
               }

            
              Session::flash('success','Record Upated successfully');
              return redirect('provider/TermsOfPayment');

           }


          $page = 'termPayment';
         
          return view('frontend.login.provider.termPayment.sellerdbTermsOfPaymentEdit',compact('page','termPaymentquota','termPayment'));
    }



     public function providerTermsPaymentdeleteMethod(Request $request,$id){
    
          $id = base64_decode($request->id);
          // dd($id);
          UserTermOfPayment::where('id',$id)->delete();
          UserTermOfPaymentQuota::where('user_term_of_payments_id',$id)->delete();

          Session::flash('success','Record deleted successfully');
         return array('status'=>'success');
           
    }


    public function providerUpdateDefaulTermsPayment(Request $request) {
        try{
            if($request->isMethod('post')){
                // $data = $request->all();
                $data = $request->except('user_term_of_payments_id','_token');
                $decAddressId = base64_decode($request->user_term_of_payments_id);
                // dd($decAddressId);

                // $updateDeliveryAddress = UserTermOfPayment::where('id',$decAddressId)->update($data);

                // if ($data['use_term_of_payment_as_default']=='yes') {
                //      // $var = 'no';
                //     $updateOtherDeliveryAddresses = UserTermOfPayment::where('id','<>',$decAddressId)
                //                                                ->where('user_id',Auth::user()->id)
                //                                                ->update(['use_term_of_payment_as_default'=>'no']);
                // }
                // dd($updateDeliveryAddress);

                $updateDeliveryAddress = UserTermOfPayment::where('id',$decAddressId)->update(['use_term_of_payment_as_default'=>'yes']);
                $updateOtherDeliveryAddresses = UserTermOfPayment::where('id','<>',$decAddressId)
                                                           ->where('user_id',Auth::user()->id)
                                                           ->update(['use_term_of_payment_as_default'=>'no']);


                if (!empty($updateDeliveryAddress) && $updateDeliveryAddress!=null) {
                    Session::flash('success',trans('messages.frontend.user_profile.update_payment_method_success'));
                    return redirect('provider/TermsOfPayment');
                }else{
                    // dd('else');
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

    public function providerAdvertisement(Request $request)
   {
        
         // dd($expiry_date);
         $page = 'advertisement';
        return view('frontend.login.provider.advertisement.dbAdvertisement',compact('page'));
           
    }

   public function providerAdvertisementListIndex(Request $request)
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
                '<a href="' . url("provider/advertisemnt/edit/".base64_encode($UserAdvertisementLIst->id)) . '" class="edit-btn cp text-primary">Edit</a>
                 <a href="' . url("provider/advertisemnt/delete/".base64_encode($UserAdvertisementLIst->id)) . '" class="delete-btn cp text-danger" del_id="'.$UserAdvertisementLIst->id.'" > Delete</a>';

                })
              ->escapeColumns([])
              ->make(true);    
           
    }

      public function providerDeleteAdvertisement(Request $request,$id){
        
        $id   = $request->id;
        $data =   UserAdvertisement::where('id',$id)->delete();

          Session::flash('success','Advertisement deleted successfully');
         return array('status'=>'success');
           
    }

    public function providerAddAdvertisement(Request $request)
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
                    return redirect('provider/advertisemnt/list');
                        
            }
      
       
         $page = 'advertisement';
        return view('frontend.login.provider.advertisement.dbAddAdvertisement',compact('page'));
           
    }

    

    public function providerEditAdvertisement(Request $request,$id)
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
                    'title'                       =>$data['title'],

                 
                   ]);

                Session::flash('success',('Advertisement updated successfully'));
                return redirect('provider/advertisemnt/list');
                        
            }
      
       
         $page = 'advertisement';
        return view('frontend.login.provider.advertisement.dbEditAdvertisement',compact('page','UserAdvertisement'));
           
    }

     public function providerMyMembership(Request $request){
        
        $membership =   Membership::first();
        $membershipLevel =   MembershipLevel::where('status','active')->get()->toArray();
        $page = 'advertisement';
        return view('frontend.login.provider.membership.sellerdbMembership',compact('page','membership','membershipLevel'));           
    }

       public function addDropzoneImage(Request $request){
       
        if ($request->isMethod('post')) {
                $data = $request->all();
                // dd($data);
                // echo "<pre>"; print_r($data);die;
                $user_id = $data['user_id'];
               
                if($request->hasFile('file')){
                    // dd('here');
                    $fileName = $_FILES['file']['name'];
                    if ($request->file('file')->isValid()){
                        // dd($data);
                       
                        $extension = $request->file('file')->getClientOriginalExtension();
                        $original  = $request->file('file')->getClientOriginalName();

                        $date = date('Y-m-d H:i:s');

                        $date_time = strtotime($date) * 1000;
                        // $destinationPath = base_path().'/'.productBasePath;
                        $destinationPath = public_path('frontend/images/provider/');

                        // $unique_id = $_GET['unique_id'];
                        if(empty($user_id)){
                            $user_id = Null;
                        }
                        // prx($user_id);
                        // $fileName = $date_time.'_'.rand(10000 , 99999).'.'.$extension;

                        if($extension=='png' || $extension=='jpg' || $extension=='jpeg' || $extension=='gif'){

                        $file = $request->file('file');
                        $file->move($destinationPath, $fileName);
                           
                        $add_image = UserProfessionImage::create([
                        'user_id' => $user_id,
                        'name' => $fileName,
                        // 'type' => $type
                        ]);
    // dd($add_image->id);
                            return $response = array('status' => 'success', 'img_id' => $add_image->id);
                        }else{  
                            return $response = array('status' => 'ext_error');
                        }
                    }      
                   
                }

            }

        // return $response = array('status' => 'success', 'img_id' => '3');
        } 



    public function getProviderMultipleImage(Request $request,$product_id)
     {
        $data = $request->all();

        $product_images = UserProfessionImage::select('id','name')->where('user_id',$product_id)->get()->toArray();
        // dd($product_images);
       
        $old_images = [];

        foreach ($product_images as $image) {
            // dd(file_exists(base_path().'/public/frontend/images/provider/'.$image['name']));
            if(file_exists(base_path().'/public/frontend/images/provider/'.$image['name'])){
                $old_images[] = [
                    'id'    => $image['id'],
                    'image' => $image['name'],
                    'size'  => File::size(base_path().'/'.providerBaseImgsPath.'/'.$image['name']),
                ];
            }
        }
        // dd($old_images);

        return $response = array('status' => 'ok','images'=>$old_images );
    }

       // this function is to delete product images
    public function deleteProviderImages(Request $request,$user_id=null){
        
        if ($request->isMethod('post')) {
            $data = $request->all(); 
            // echo '22';
            // dd($data);
            $user_id = $data['user_id'];
            if(empty($user_id)){
                if(!empty($data['file_id'])) {
                    $image = UserProfessionImage::where('id',$data['file_id'])->value('name'); 

                    $remove_image = unlink(base_path().'/'.providerBaseImgsPath.'/'.$image);

                    $delete = UserProfessionImage::where('id',$data['file_id'])->delete();

                    return $response = array('status'=>'success');
                }
                //dummy response
                // return $response = array('status'=>'success');

                if(!empty($data['filename'])) {   
                    $delete = UserProfessionImage::where('name',$data['filename'])->delete();

                    $remove_image = unlink(base_path().'/'.providerBaseImgsPath.'/'.$data['filename']);  
                                
                    return $response = array('status'=>'success');
                } 
            } else{
                if(!empty($data['file_id'])) {
                    $image = UserProfessionImage::where('id',$data['file_id'])->value('name'); 

                    $remove_image = unlink(base_path().'/'.providerBaseImgsPath.'/'.$image);

                    $delete = UserProfessionImage::where('id',$data['file_id'])->delete();

                    return $response = array('status'=>'success');
                } else{
                    $image = UserProfessionImage::where('user_id',$data['user_id'])->where('name',$data['filename'])->value('name');
                    // echo $image; die;
                    if(!empty($image)){
                        if(file_exists(base_path().providerBaseImgsPath.'/'.$image)){
                            $remove_image = unlink(base_path().providerBaseImgsPath.'/'.$image);  
                        }
                        UserProfessionImage::where('user_id',$data['user_id'])->where('name',$data['filename'])->delete();
                        
                        return $response = array('status'=>'success');

                    } else{
                        return $response = array('status'=>'false');
                    }
                }
            }
            
        }
    }

  
    public function chooseDeliveryOption(Request $request){

      if($request->isMethod('post')){
          $input = $request->all();
          // dd($input);
          $update = User::where('id',Auth::user()->id)->update(['delivery_option_id'=>$input['delivery_option_id']]);   

        return redirect()->back()->with('success','Delivery Option updated sucessfully');
       } 
       $userRecord = User::where('id',Auth::user()->id)->first();
       // dd($userRecord); 

      $deliveryOption = ProviderDeliveryOption::get()->toArray();
      return view('frontend.login.provider.termPayment.chooseDelivery.chooseDeliveryOption',compact('deliveryOption','userRecord'));
    }



    ////////////////////////////////Add Trademark////////////////////

        public function addDropzoneBrandImage(Request $request){
         if ($request->isMethod('post')) {
                 $data = $request->all();
                 // dd($data);
                 $user_id = $data['user_id'];
                
                 if($request->hasFile('file')){
                     $fileName = $_FILES['file']['name'];
                     if ($request->file('file')->isValid()){
                        
                         $extension = $request->file('file')->getClientOriginalExtension();
                         $original  = $request->file('file')->getClientOriginalName();

                         $date = date('Y-m-d H:i:s');

                         $date_time = strtotime($date) * 1000;
                         $destinationPath = public_path('frontend/images/providerBrandImages/');

                         if(empty($user_id)){
                             $user_id = Null;
                         }

                         if($extension=='png' || $extension=='jpg' || $extension=='jpeg' || $extension=='gif'){

                         $file = $request->file('file');
                         $file->move($destinationPath, $fileName);
                            
                         $add_image = UserBrandImage::create([
                         'user_id' => $user_id,
                         'name' => $fileName,
                         ]);
                             return $response = array('status' => 'success', 'img_id' => $add_image->id);
                         }else{  
                             return $response = array('status' => 'ext_error');
                         }
                     }      
                    
                 }

             }
         } 
       


       public function getProviderTrademarkImage(Request $request,$product_id)
        {
           $data = $request->all();

           $product_images = UserBrandImage::select('id','name')->where('user_id',$product_id)->get()->toArray();
           // dd($product_images);
          
           $old_images = [];

           foreach ($product_images as $image) {
               // dd(file_exists(base_path().'/public/frontend/images/provider/'.$image['name']));
               if(file_exists(base_path().'/public/frontend/images/providerBrandImages/'.$image['name'])){
                   $old_images[] = [
                       'id'    => $image['id'],
                       'image' => $image['name'],
                       'size'  => File::size(base_path().'/'.providerBrandImgsBasePath.'/'.$image['name']),
                   ];
               }
           }
           // dd($old_images);

           return $response = array('status' => 'ok','images'=>$old_images );
       }

          // this function is to delete product images
       public function deleteProviderTrademarkImage(Request $request,$user_id=null){
           
           if ($request->isMethod('post')) {
               $data = $request->all(); 
               // echo '22';
               // dd($data);
               $user_id = $data['user_id'];
               if(empty($user_id)){
                   if(!empty($data['file_id'])) {
                       $image = UserBrandImage::where('id',$data['file_id'])->value('name'); 

                       $remove_image = unlink(base_path().'/'.providerBrandImgsBasePath.'/'.$image);

                       $delete = UserBrandImage::where('id',$data['file_id'])->delete();

                       return $response = array('status'=>'success');
                   }
                   //dummy response
                   // return $response = array('status'=>'success');

                   if(!empty($data['filename'])) {   
                       $delete = UserBrandImage::where('name',$data['filename'])->delete();

                       $remove_image = unlink(base_path().'/'.providerBrandImgsBasePath.'/'.$data['filename']);  
                                   
                       return $response = array('status'=>'success');
                   } 
               } else{
                   if(!empty($data['file_id'])) {
                       $image = UserBrandImage::where('id',$data['file_id'])->value('name'); 

                       $remove_image = unlink(base_path().'/'.providerBrandImgsBasePath.'/'.$image);

                       $delete = UserBrandImage::where('id',$data['file_id'])->delete();

                       return $response = array('status'=>'success');
                   } else{
                       $image = UserBrandImage::where('user_id',$data['user_id'])->where('name',$data['filename'])->value('name');
                       // echo $image; die;
                       if(!empty($image)){
                           if(file_exists(base_path().providerBrandImgsBasePath.'/'.$image)){
                               $remove_image = unlink(base_path().providerBrandImgsBasePath.'/'.$image);  
                           }
                           UserBrandImage::where('user_id',$data['user_id'])->where('name',$data['filename'])->delete();
                           
                           return $response = array('status'=>'success');

                       } else{
                           return $response = array('status'=>'false');
                       }
                   }
               }
               
           }
       }

        /////////////////////////////////End dropzone  image////////////////////////



}
