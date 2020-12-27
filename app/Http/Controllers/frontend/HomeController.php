<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Country;
use App\State;
use App\City;
use Auth;
use App\UserDeliveryAddress;
use App\UserPaymentCard;
use App\Term;
use App\UserType;
use App\UserProperty,App\UserService,App\UserSelectedService;
use App\Subscription,App\UserSubscription;
use App\UserStoreLocation,App\UserSubscriptionPayment;
use DateTime;
use App\UserProfessionImage;
use App\ProductCategory,App\Product;
use App\ProductWishlist;
use App\ProductSpecification;
use App\ProductWeight;
use App\ProductComparison;
use App\UserOtherService;
use App\GcmDevice;
use App\ProductSelectedCategory;
use App\ProductSelectedSubcategory;
use App\ProductPriceRange;
use App\UserProjectField;
use App\StoreLocationAddressType;
use App\UserSelectedProjectField;
use App\ProductCart;
use App\UserInquery;
use App\SellerDiscountCode;
use App\ProductTax;
use App\Order;
use App\OrderDeliveryAddress;
use App\OrderItem;
use App\DiscountedProduct;
use App\UserBrandImage;

use App\userProductSelectedCategory;
use App\userProductSelectedSubCategory;
use App\UserProductMaterialList;
use App\ProductSubCategory;
use App\productSellingMaterial;
use App\DeliveryPolicy;
use App\Career;
use App\ReturnAndExchangePolicy;

class HomeController extends Controller
{

    public function aboutUs(Request $request) {  
        try{      
            return view('frontend.home.aboutUs');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function faqs(Request $request) {  
        try{      
            return view('frontend.home.faqs');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function contactUs(Request $request) {  
        try{      
            return view('frontend.home.contactUs');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }
    
    public function index(Request $request) {
        try{
            // $footerDetail =Footer::first();
            $productCategories = ProductCategory::get()->toArray();

            $products = Product::with('productImages','productselectedcategory','productselectedsubcategory','productpricerange','minimumBuyingQuantityUnitDetail')->get()->toArray();

            return view('frontend.home.index',compact('footerDetail','productCategories','products'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

     public function guestProductDetail(Request $request,$id) {
        try{

         // dd('here');

          $product = Product::with(['userDetail'=>function($q){
              $q->select('id','supplier_code','contact_name','contact_last_name');
          },'productSpecifications','productSelectedCategories.productCategoryDetail'=>function($q){
              $q->select('id','name');
          },'productSelectedSubCategories.productSubCategoryDetail'=>function($q){
              $q->select('id','name');
          },'productSelectedSellingMaterials.productSellingMaterialDetail'=>function($q){
              $q->select('id','selling_material_name');
          },'productImages','productRelatedLinks','productSelectedKeywords.productKeywordDetail'=>function($q){
              $q->select('id','keyword_name');
          },'userStoreLocationDetail'=>function($q){
              $q->select('id','store_name');
          },'productBrandDetail'=>function($q){
              $q->select('id','brand_name');
          },'productColorDetail'=>function($q){
              $q->select('id','name');
          },'countryDetail'=>function($q){
              $q->select('id','name');
          },'productGradeDetail'=>function($q){
              $q->select('id','grade_name');
          },'diameterUnitDetail'=>function($q){
              $q->select('id','name');
          },'lengthUnitDetail'=>function($q){
              $q->select('id','name');
          },'widthUnitDetail'=>function($q){
              $q->select('id','name');
          },'depthUnitDetail'=>function($q){
              $q->select('id','name');
          },'heightUnitDetail'=>function($q){
              $q->select('id','name');
          },'thicknessUnitDetail'=>function($q){
              $q->select('id','name');
          },'particleUnitDetail'=>function($q){
              $q->select('id','name');
          },'productNewOptions.productSellingUnitDetail'=>function($q){
              $q->select('id','name');
          },'sellingUnitDetail'=>function($q){
              $q->select('id','name');
          },'availableQuantityUnitDetail'=>function($q){
              $q->select('id','name');
          },'availableQuantityContentUnitDetail'=>function($q){
              $q->select('id','name');
          },'minimumBuyingQuantityUnitDetail'=>function($q){
              $q->select('id','name');
          },'productPackings.eachContentUnitDetail','productPackings.contentUnitDetail','productPriceRanges.fromUnitDetail','productPriceRanges.toUnitDetail','productTermOfPayments.planDetail','productSpecialDeliveryFees'])->where('id', base64_decode($id))->first();
          $product = !empty($product) ? $product->toArray() : [];

          $productsFrstDetail = Product::where('id',base64_decode($id))->first();

          $sellerList = Product::with('productImages','productSpecification','productWeight','productpricerange','productpacking')->where('user_id','!=',$productsFrstDetail['user_id'])->where('item_name',$productsFrstDetail['item_name'])->where('selling_unit',$productsFrstDetail['selling_unit'])->get()->toArray();
          

          $minimum_buying_quality_number = $productsFrstDetail['minimum_buying_quality_number'];

           
          return view('frontend.login.productDetail',compact('product','productsFrstDetail','sellerList','minimum_buying_quality_number'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function login(Request $request) {
        try{
            if ($request->isMethod('post')) {
                $data = $request->all();
               
                if($data['email'] && $data['password'] && $request->_token){
                    if(is_numeric($data['email'])){
                        if(Auth::attempt([
                            'mobile_no'      => $data['email'],
                            'password'   => $data['password']],isset($data['remember_me'])&&!empty($data['remember_me']) ? true : false)){
                             $currentDate = date('Y-m-d H:i:s');

                            if (Auth::user()->otp_verify_status=='no') {
                                Auth::logout();
                                Session::flash('error', trans('messages.frontend.contact_no_not_verified'));
                                return redirect()->back();
                            }else if (Auth::user()->status=='inactive') {
                                Auth::logout();
                                Session::flash('error', trans('messages.frontend.status_is_inactive'));
                                return redirect()->back();
                            }

                            $userType = Auth::user()->user_type_id;
                            $userType = UserType::where('id',Auth::user()->user_type_id)->value('type');
                            User::where('id',Auth::user()->id)->update(['is_login'=>'yes']);
                            if ($userType=='provider') {

                                if (Auth::user()->transaction_status=='inactive') {
                                    User::where('id',Auth::user()->id)->update(['is_login'=>'no']);
                                    Auth::logout();
                                    Session::flash('error', trans('messages.frontend.transaction_cash_status_not_active'));
                                    return redirect()->back();
                                }
                                Session::flash('success', 'Welcome '.Auth::user()['contact_name']);
                                return redirect('/provider/profile');
                            }

                             dd($_COOKIE['guestId']);



                            Session::flash('success', 'Welcome '.Auth::user()['first_name']);
                            return redirect('/buildingMaterialServices');
                        }else{
                            Session::flash('error', trans('messages.frontend.login.enter_valid_credentials'));
                            return redirect()->back();
                        }
                    }else{
                        // dd('else');
                        if(Auth::attempt([
                            'email'      => $request['email'],
                            'password'   => $request['password']],isset($data['remember_me'])&&!empty($data['remember_me']) ? true : false)){
                            $currentDate = date('Y-m-d H:i:s');
                            if (Auth::user()->otp_verify_status=='no') {
                                Auth::logout();
                                Session::flash('error', trans('messages.frontend.contact_no_not_verified'));
                                return redirect()->back();
                            }else if (Auth::user()->status=='inactive') {
                                Auth::logout();
                                Session::flash('error', trans('messages.frontend.status_is_inactive'));
                                return redirect()->back();
                            }

                            $userType = Auth::user()->user_type_id;
                            $userType = UserType::where('id',Auth::user()->user_type_id)->value('type');
                            // dd($userType);
                            User::where('id',Auth::user()->id)->update(['is_login'=>'yes']);
                            if ($userType=='provider') {
                            
                                if (Auth::user()->transaction_status=='inactive') {
                                    User::where('id',Auth::user()->id)->update(['is_login'=>'no']);
                                    Auth::logout();
                                    Session::flash('error', trans('messages.frontend.transaction_cash_status_not_active'));
                                    return redirect()->back();
                                }
                                Session::flash('success', 'Welcome '.Auth::user()['contact_name']);
                                return redirect('/provider/profile');
                            }
                            ////////code for cookie data store to product cart table/////////
                             $user_id = Auth::User()->id;
                             $guest_id = $_COOKIE['guestId'];
                             $guest_items = ProductCart::where('user_id',$guest_id)->get()->toArray();
                                 if(!empty($guest_id) && !empty($guest_items)){

                                    $user_items = ProductCart::where('user_id',$user_id)->get()->toArray();
                                    $user_items = array_map(function($v){ return $v['id']; }, $user_items);
                                    foreach($guest_items as $value){
                                        if(in_array($value['id'], $user_items)){
                                            ProductCart::where('id',$value['id'])->delete();
                                        } else{
                                            ProductCart::where('id',$value['id'])->update(['user_id'=>$user_id]);
                                        }
                                    }
                                  }
                            ////////End code for cookie data store to product cart table/////////
                            Session::flash('success', 'Welcome '.Auth::user()['first_name']);
                            return redirect('/user/buildingMaterialServices');
                        }else{
                            Session::flash('error', trans('messages.frontend.login.enter_valid_credentials'));
                            return redirect()->back();
                        }
                    }
                }else{
                    Session::flash('error', trans('messages.frontend.login.enter_proper_credentials'));
                    return redirect()->back();
                }
            }
            return view('frontend.home.login');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function signUp(Request $request) {
        try{
            $countries = Country::orderBy('name','asc')->get()->toArray();
            $userTypes = UserType::where('type','user')->get()->toArray();

            return view('frontend.home.signUp',compact('countries','userTypes'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

   public function getTermsAndCondtion(Request $request) {

          $terms_condition = Term::orderby('created_at', 'desc')->first();
          // dd($news);
          return view('frontend.home.terms&Conditions', ['terms_condition' => $terms_condition]);
      }

      public function getDeliveryPolicy(Request $request) {

          $terms_condition = DeliveryPolicy::orderby('created_at', 'desc')->first();
          return view('frontend.home.deliveryPolicy', ['terms_condition' => $terms_condition]);
      }

      public function getCareer(Request $request) {

          $terms_condition = Career::orderby('created_at', 'desc')->first();
          return view('frontend.home.career', ['terms_condition' => $terms_condition]);
      }

      public function getReturnAndExchangePolicy(Request $request) {

          $terms_condition = ReturnAndExchangePolicy::orderby('created_at', 'desc')->first();
          return view('frontend.home.returnAndExchangePolicy', ['terms_condition' => $terms_condition]);
      }


    public function enterOtp($encUserId, Request $request) {
        try{
            $decUserId = base64_decode($encUserId);
            // dd($decUserId);
            $userDetail = User::where('id',$decUserId)->first();
            $userDetail = !empty($userDetail) ? $userDetail->toArray() : [];
            // dd($userDetail);
            return view('frontend.home.enterOtp',compact('encUserId','userDetail'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userRegistration(Request $request) {
        try{
            $data = $request->all();
            if (!empty($data)) {

                $userCount = User::where('user_type_id',1)->orWhere('user_type_id',2)->count();
                $userNo = 'BM-USER-'.sprintf("%06d", $userCount+1);

                $data['password'] = Hash::make($data['password']);
                // dd($data);
                // $userId = User::create($data)->id;
                $data['institution_name'] = $data['user_type_id']==2 ? $data['institution_name'] : null;
                $data['cr_number'] = $data['user_type_id']==2 ? $data['cr_number'] : null;
                $data['website_url'] = $data['user_type_id']==2 ? $data['website_url'] : null;
                $userId = User::create([
                                        'user_type_id'=>$data['user_type_id'],
                                        'supplier_code'=>$userNo,
                                        'institution_name'=>$data['institution_name'],
                                        'cr_number'=>$data['cr_number'],
                                        'website_url'=>$data['website_url'],
                                        'first_name'=>$data['first_name'],
                                        'last_name'=>$data['last_name'],
                                        'email'=>$data['email'],
                                        'mobile_no'=>$data['mobile_no'],
                                        'isd_code'=>'+'.$data['isd_code'],
                                        'password'=>$data['password'],
                                        ])->id;
                // dd($userId);
                if (!empty($userId) && $userId!=null) {

                    $useAdrDefault = 'no';
                    $data['use_address_as_default']='yes';
                    if (isset($data['addrs_count'])) {
                        for ($i=0; $i < $data['addrs_count'] ; $i++) { 
                            // dd($data['address'][$i]);
                            if (isset($data['address_title']) && $data['address_title'][$i]!=null && isset($data['address']) && $data['address'][$i]!=null && isset($data['province_name']) && $data['province_name'][$i]!=null && isset($data['postal_code']) && $data['postal_code'][$i]!=null && isset($data['country_id']) && $data['country_id'][$i]!=null && isset($data['city_id']) && $data['city_id'][$i]!=null && isset($data['location']) && $data['location'][$i]!=null) {
                                if ($useAdrDefault=='yes') {
                                    $data['use_address_as_default']='no';
                                }
                                $userDeliveryAddress = UserDeliveryAddress::create([
                                                                            'user_id'=>$userId,
                                                                            'address_title'=>$data['address_title'][$i],
                                                                            'address'=>$data['address'][$i],
                                                                            'province_name'=>$data['province_name'][$i],
                                                                            // 'street_no'=>$data['street_no'][$i],
                                                                            'postal_code'=>$data['postal_code'][$i],
                                                                            'country_id'=>$data['country_id'][$i],
                                                                            // 'state_id'=>$data['state_id'][$i],
                                                                            'city_id'=>$data['city_id'][$i],
                                                                            'location'=>$data['location'][$i],
                                                                            'latitude'=>@$data['latitude'][$i],
                                                                            'longitude'=>@$data['longitude'][$i],
                                                                            'use_address_as_default'=>$data['use_address_as_default']
                                                                            ]);
                                $useAdrDefault = 'yes';
                            }
                        }
                    }
                    // dd($data);
                    $usedDefault = 'no';
                    $data['use_card_as_default']='yes';
                    if (isset($data['cards_count'])) {
                        for ($i=0; $i < $data['cards_count'] ; $i++) { 
                            // dd($data['address'][$i]);
                            if (isset($data['card_type']) && $data['card_type'][$i]!=null && isset($data['card_no']) && $data['card_no'][$i]!=null && isset($data['name_on_card']) && $data['name_on_card'][$i]!=null && isset($data['expiry_month']) && $data['expiry_month'][$i]!=null && isset($data['expiry_year']) && $data['expiry_year'][$i]!=null && isset($data['cvv']) && $data['cvv'][$i]!=null) {
                                if ($usedDefault=='yes') {
                                    $data['use_card_as_default']='no';
                                }
                                $userPaymentCard = UserPaymentCard::create([
                                                                    'user_id'=>$userId,
                                                                    'card_type'=>$data['card_type'][$i],
                                                                    'card_no'=>$data['card_no'][$i],
                                                                    'name_on_card'=>$data['name_on_card'][$i],
                                                                    'expiry_month'=>$data['expiry_month'][$i],
                                                                    'expiry_year'=>$data['expiry_year'][$i],
                                                                    'cvv'=>$data['cvv'][$i],
                                                                    'use_card_as_default'=>$data['use_card_as_default']
                                                                    ]);
                                $usedDefault = 'yes';
                            }
                        }
                    }
                    // dd('here');
                    $encUser = base64_encode($userId);
                    /*send confirmation mail to user start*/
                    $data['email'] = $data['email'];
                    $mailData = [];
                    $mailData['name'] = $data['first_name'].' '.$data['last_name'];
                    
                    try{
                        $this->sendMail('userRegistrationSuccess', $data['email'], $mailData);               
                    }catch(\Exception $e){
                        
                    }
                    /*send confirmation mail to user end*/
                    return array('status'=>'success', 'encUser'=>$encUser);
                }else{
                    return array('status'=>'error');                    
                }
            }else{
                return array('status'=>'error');
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function mobileOtpVerifyAjax(Request $request) {

        $data = $request->all();
        // dd($data);
        $decUserId = base64_decode($data['encUserId']);
        $updateUser = User::where('id',$decUserId)->update([
                                                            'otp_verify_status'=>'yes',
                                                            'complete_profile'=>'yes'
                                                            ]);
        // Session::flash('error',trans('messages.frontend.mobile_otp_verify.success'));
        // return redirect('/login');
        return $response = array('status'=>'success');
    }

     public function buildingMaterialServices(Request $request) {
        try{

            $productCategories = ProductCategory::get()->toArray();
            // dd($productCategories);
            $page = 'buildingMaterialServices';
            return view('frontend.login.buildingMaterialServices',compact('productCategories','page'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

     public function productBuildingList(Request $request,$id) {
         try{
             $data = $request->all();
             $selectCategry = ProductSelectedCategory::where('category_id',base64_decode($id))->pluck('product_id');
             $products = Product::with('productImages','productselectedcategory','productselectedsubcategory','productpricerange','sellingUnitProduct')->whereIn('id',$selectCategry);
             $product_page = $products->paginate(9);
             $products = $products->get()->toArray();
             // ProductSelectedSubcategory
             if(empty($products)){ 
                    Session::flash('error', 'sorry,no product available for this category');   
                    // Session::flash('error, no product available');
               return redirect('/');
             }

             if(auth::check()){
                  $selectedProductIds = ProductComparison::with('productcomparison')->where('user_id',Auth::user()->id)->pluck('product_id')->toArray();
                  $productscount = ProductComparison::where('user_id',Auth::user()->id)->get()->count();
             }else{
                 $userId  = $_COOKIE['guestId'];
                 $selectedProductIds = ProductComparison::with('productcomparison')->where('user_id',$userId)->pluck('product_id')->toArray();
                 $productscount = ProductComparison::where('user_id',$userId)->get()->count();
             }
             
             // dd($productscount);
              $serviceList = Product::with('category','productImages')
                                         ->select('*')
                                         // ->where('user_id',\Auth::user()->id)
                                         ->where('category_id',base64_decode($id))
                                         ->where('type','service')
                                         ->orderBy('id', 'desc')->get()->toArray();
             
             // dd($products);           
             return view('frontend.login.buildingProductsList',compact('products','product_page','selectedProductIds','productscount','serviceList'));
         }catch(Exception $e){
             \Log::error($e->getMessage());
             Session::flash('error',trans('messages.frontend.common_error'));
             return redirect()->back();
         }
     }


   public function addProductAsWishlist(Request $request){

        $data = $request->all(); 
        if(auth::check()){
            $productWishlistRecord = ProductWishlist::where('user_id',Auth::User()->id)->where('product_id',$data['productId'])->first();
        }else{
            $userId  = $_COOKIE['guestId'];
            $productWishlistRecord = ProductWishlist::where('user_id',$userId)->where('product_id',$data['productId'])->first();
        }
        // dd($productWishlistRecord); 
        $response= [];
        if (empty($productWishlistRecord)) {
            $productWishlist =  ProductWishlist::create([
                                      'user_id'               =>$data['userId'],
                                      'product_id'            =>$data['productId'],
                                      // 'is_wishlisted'         =>$is_wishlisted
                                ]);
            $response['status']='true';
            $response['msg']= 'Product successfully added in whislist';      
        }else{               
            $updateproductWishlist = ProductWishlist::where('product_id',$data['productId'])->delete();
            $response['status']='false';
        }
        
       return $response; 

    }

    

     public function productWishlist(Request $request) {
        try{
          $productWishlistRecord = ProductWishlist::with('product.productImage','product.productpricerange')->where('user_id',Auth::user()->id)->get()->toArray();
         // dd($productWishlistRecord);

         
          if(empty($productWishlistRecord)){
              return redirect()->back();
          }
          $page = 'wishlist';

           return view('frontend.login.Wishlist',compact('productWishlistRecord','page'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }


    public function addCartProductAsWishlist(Request $request){

        $data = $request->all(); 
        // dd($data); 
        $data = $request->all();
        $productWishlistRecord = ProductWishlist::where('user_id',Auth::User()->id)->where('product_id',$data['productId'])->first();
        $response= [];
        if (empty($productWishlistRecord)) {
            $productWishlist =  ProductWishlist::create([
                                      'user_id'               =>$data['userId'],
                                      'product_id'            =>$data['productId'],
                                      // 'is_wishlisted'         =>$is_wishlisted
                                ]);
            $response=[];
         
            $cartCount = ProductCart::where('user_id',Auth::user()->id)->count();
            if($cartCount<2){
                ProductCart::where('product_id',$data['productId'])->delete();         
                $response['status']  = 'vaccantCart';
            }else{
                ProductCart::where('product_id',$data['productId'])->delete();
                $response['status']  = 'true';
            }

        }else{
            ProductWishlist::where('user_id',Auth::User()->id)->where('product_id',$data['productId'])->delete();
        }
       return $response; 

    }


      public function viewProductDeatil(Request $request,$id) {
         try{

           // $productId = base64_decode($id);
           // $product = Product::with('productImage','productSpecification','productWeight','productpricerange','productpacking')->where('id',$productId)->first();
           // $productsFrstDetail = Product::where('id',$productId)->first();

           // $sellerList = Product::with('productImage','productSpecification','productWeight','productpricerange','productpacking')->where('user_id','!=',$productsFrstDetail['user_id'])->where('item_name',$productsFrstDetail['item_name'])->where('selling_unit',$productsFrstDetail['selling_unit'])->get()->toArray();
           // $minimum_buying_quality_number = $productsFrstDetail['minimum_buying_quality_number'];


           // $productId = base64_decode($id);
              
              

           // $product = Product::with('productImages','productSpecification','productWeight','productpricerange','productpacking','product_price_range_single_unit_price')->where('id',$productId)->first();
           

           $product = Product::with(['userDetail'=>function($q){
               $q->select('id','supplier_code','contact_name','contact_last_name');
           },'productSpecifications','productSelectedCategories.productCategoryDetail'=>function($q){
               $q->select('id','name');
           },'productSelectedSubCategories.productSubCategoryDetail'=>function($q){
               $q->select('id','name');
           },'productSelectedSellingMaterials.productSellingMaterialDetail'=>function($q){
               $q->select('id','selling_material_name');
           },'productImages','productRelatedLinks','productSelectedKeywords.productKeywordDetail'=>function($q){
               $q->select('id','keyword_name');
           },'userStoreLocationDetail'=>function($q){
               $q->select('id','store_name');
           },'productBrandDetail'=>function($q){
               $q->select('id','brand_name');
           },'productColorDetail'=>function($q){
               $q->select('id','name');
           },'countryDetail'=>function($q){
               $q->select('id','name');
           },'productGradeDetail'=>function($q){
               $q->select('id','grade_name');
           },'diameterUnitDetail'=>function($q){
               $q->select('id','name');
           },'lengthUnitDetail'=>function($q){
               $q->select('id','name');
           },'widthUnitDetail'=>function($q){
               $q->select('id','name');
           },'depthUnitDetail'=>function($q){
               $q->select('id','name');
           },'heightUnitDetail'=>function($q){
               $q->select('id','name');
           },'thicknessUnitDetail'=>function($q){
               $q->select('id','name');
           },'particleUnitDetail'=>function($q){
               $q->select('id','name');
           },'productNewOptions.productSellingUnitDetail'=>function($q){
               $q->select('id','name');
           },'sellingUnitDetail'=>function($q){
               $q->select('id','name');
           },'availableQuantityUnitDetail'=>function($q){
               $q->select('id','name');
           },'availableQuantityContentUnitDetail'=>function($q){
               $q->select('id','name');
           },'minimumBuyingQuantityUnitDetail'=>function($q){
               $q->select('id','name');
           },'productPackings.eachContentUnitDetail','productPackings.contentUnitDetail','productPriceRanges.fromUnitDetail','productPriceRanges.toUnitDetail','productTermOfPayments.planDetail','productSpecialDeliveryFees'])->where('id', base64_decode($id))->first();
           $product = !empty($product) ? $product->toArray() : [];

           $productsFrstDetail = Product::where('id',base64_decode($id))->first();

           $sellerList = Product::with('productImages','productSpecification','productWeight','productpricerange','productpacking')->where('user_id','!=',$productsFrstDetail['user_id'])->where('item_name',$productsFrstDetail['item_name'])->where('selling_unit',$productsFrstDetail['selling_unit'])->get()->toArray();
           

           $minimum_buying_quality_number = $productsFrstDetail['minimum_buying_quality_number'];

            
           return view('frontend.login.productDetail',compact('product','productsFrstDetail','sellerList','minimum_buying_quality_number'));
         }catch(Exception $e){
             \Log::error($e->getMessage());
             Session::flash('error',trans('messages.frontend.common_error'));
             return redirect()->back();
         }
     }

      public function viewSellerDeatil(Request $request,$id) {
         try{
            $sellerId = base64_decode($id);
            $designer = User::with('countryDetail','userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userProfessionImagesDetail','userDefaultStoreLocation.cityDetail')->where('id',$sellerId)->first();
            $designer = !empty($designer) ? $designer->toArray() : [];
            // dd($designer);
            return view('frontend.login.sellerdetail.sellerDetail',compact('designer'));
         }catch(Exception $e){
             \Log::error($e->getMessage());
             Session::flash('error',trans('messages.frontend.common_error'));
             return redirect()->back();
         }
     }

    public function askQuestionToSeller(Request $request){
         if($request->isMethod('post')){
            $input       = $request->all();
            $input       = $request->except('_token');   
            $currentTime = date("Y-m-d H:i:s");
            $userId   = base64_decode($input['user_id']);
            $sellerId = base64_decode($input['seller_id']);
            // dd($sellerId);
            $description = $input['description'];
            $respondStatus = 'pending';
            $count = UserInquery::get()->count();
            $count =$count +1;
            $invoiceNumber = 'BM'.'-'.'INQ'.'-'.$count;
            // dd($invoiceNumber);

            UserInquery::create([
                          'inquery_id'      =>$invoiceNumber,
                           'user_id'        =>$userId,
                           'seller_id'      =>$sellerId,
                           'query'          =>$description,
                           'date_time'      =>$currentTime,
                           'respond_status' =>$respondStatus
                            ]);

              

         Session::flash('success','Query Sent successfully');
         return redirect()->back();
         }
     }
     

       public function compareProduct(Request $request){

        $data = $request->all(); 
        if(auth::check()){
            $productWishlistRecord = ProductComparison::where('user_id',Auth::User()->id)->where('product_id',$data['productId'])->first();
        }else{
            $userId  = $_COOKIE['guestId'];
            $productWishlistRecord = ProductComparison::where('user_id',$userId)->where('product_id',$data['productId'])->first();
        }
        // dd($productWishlistRecord); 
        $response= [];
        if (empty($productWishlistRecord)) {
            $productWishlist =  ProductComparison::create([
                                      'user_id'               =>$data['userId'],
                                      'product_id'            =>$data['productId'],
                                      // 'is_wishlisted'         =>$is_wishlisted
                                ]); 
            if(auth::check()){
               $productCount = ProductComparison::where('user_id',Auth::User()->id)->get()->count();
            }else{
               $userId  = $_COOKIE['guestId'];
               $productCount = ProductComparison::where('user_id',$userId)->get()->count();
            }
            // dd($productCount);
            if($productCount>=2 && $productCount<=5){
              $response['count']  = $productCount;
            }

            $response['status'] = 'true';
            $response['msg']    = 'Product successfully added in Comparison List';      
        }else{
            $updateproductWishlist = ProductComparison::where('product_id',$data['productId'])->delete();

            if(auth::check()){
               $productCount = ProductComparison::where('user_id',Auth::User()->id)->get()->count();
            }else{
               $userId  = $_COOKIE['guestId'];
               $productCount = ProductComparison::where('user_id',$userId)->get()->count();
            }
            // $productCount = ProductComparison::where('user_id',Auth::User()->id)->get()->count();
            // dd($productCount);
            if($productCount>=2 && $productCount<=5){
              $response['count']  = $productCount;
            }

            $response['status']='false';
            $response['msg']= 'Product successfully deleted in Comparison List';      
        }
        
       return $response; 

    }
     
    public function CompareProductList(Request $request) {
        try{
          if(auth::check()){
              $compareProductRecords = ProductComparison::where('user_id',Auth::user()->id)
                                        ->with('product.productImages','product.sellingUnitProduct','product.productpricerange','product.productBrandDetail','product.productColorDetail','product.diameterUnitDetail','product.widthUnitDetail','product.depthUnitDetail','product.lengthUnitDetail','product.heightUnitDetail','product.thicknessUnitDetail','product.particleUnitDetail','product.productSelectedSellingMaterials','product.productSelectedSellingMaterials.productSellingMaterialDetail')->get()->toArray();
          }else{
              $userId  = $_COOKIE['guestId'];
              $compareProductRecords = ProductComparison::where('user_id',$userId)
                                        ->with('product.productImages','product.sellingUnitProduct','product.productpricerange','product.productBrandDetail','product.productColorDetail','product.diameterUnitDetail','product.widthUnitDetail','product.lengthUnitDetail','product.depthUnitDetail','product.heightUnitDetail','product.thicknessUnitDetail','product.particleUnitDetail','product.productSelectedSellingMaterials','product.productSelectedSellingMaterials.productSellingMaterialDetail')->get()->toArray();
          }

          // dd($productWishlistRecord);
          if(empty($compareProductRecords)){
              return redirect()->back();
          }

           return view('frontend.login.productComparison',compact('compareProductRecords'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }


    public function logout(Request $request) {
        try{
            if (Auth::check()) {
                User::where('id',Auth::user()->id)->update(['is_login'=>'no']);
                Auth::logout();
            }
            session::flash('success',trans('messages.frontend.logout.success'));
            return redirect('/');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function checkUserEmail(Request $request){
        if (!empty($request['user_id'])) {
            $user_email   =  User::where('id','!=',base64_decode($request['user_id']))->where(['email'=>$request['email']])->first();
        }else{
            $user_email   =  User::where(['email'=>$request['email']])->first();
        }
     
        if(!empty($user_email)){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function checkUserMobile(Request $request){
        if (!empty($request['user_id'])) {
            $user_mobile_no   =  User::where('id','!=',$request['user_id'])->where(['mobile_no'=>$request['mobile_no']])->first();
        }else{
            $user_mobile_no   =  User::where(['mobile_no'=>$request['mobile_no']])->first();
        }
     
        if(!empty($user_mobile_no)){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function getStates(Request $request) {
        try {
            $data = $request->all();
            $states = State::where('country_id', $data['countryId'])->where('status','active')->orderBy('name', 'asc')->get();
            return view('frontend.elements.states', ['states' => $states])->render();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }      
    }

    public function getCities(Request $request) {
        try {
            $data = $request->all();
            $cities = City::where(['state_id' => $data['stateId']])
                            ->orderBy('name', 'asc')->get();
            return view('frontend.elements.cities', ['cities' => $cities])->render();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    public function getCountryRelatedCities(Request $request) {
        try {
            $data = $request->all();
            $cities = City::where(['country_id' => $data['country_id']])
                            ->orderBy('name', 'asc')->get()->toArray();
            // dd($cities);
            return view('frontend.elements.cities', ['cities' => $cities])->render();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    public function forgotPassword(Request $request) {
        try{
            $data = $request->all();
            // dd($data);
            $user = User::where('email',$data['email'])->first();
            // $user = !empty($user) ? $user->toArray() : [];
            // dd($user);
            if(!empty($user)){

                if($user['status'] == 'active'){

                    $key = mt_rand(6, 1000000);
                    $encodeKey = base64_encode($key);
                    $encodeId = base64_encode($user['id']);
                    $updateKey = User::where('id',$user['id'])->update(['reset_password_key' => $key]);
                    /*send forgot password mail to user start*/
                    $mailData = [];
                    $mailData['name'] = $user['first_name'].' '.$user['last_name'];
                    $mailData['link'] = url ('/resetPassword/').'/'.$encodeKey.'/'.$encodeId;
                    // dd($mailData['link']);
                    try{
                        $this->sendMail('forgotPassword', $data['email'], $mailData);               
                    }catch(\Exception $e){
                        
                    }
                    /*send forgot password mail to user end*/

                    Session::flash('success',trans('messages.frontend.forgot_password.link_sent_success'));
                    return redirect()->back();
                        
                }else{
                    Session::flash('error',trans('messages.frontend.forgot_password.account_deactivated'));
                    return redirect()->back();
                }
            }else{
                Session::flash('error',trans('messages.frontend.forgot_password.email_not_registered'));
                return redirect()->back();
            }
            return view('frontend.home.resetPassword');
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function resetPassword($encKey,$encUserId,Request $request) {
        try{
            // dd($encKey);
            if($request->isMethod('post')){
                $data = $request->all();  
                $decKey = base64_decode($encKey);
                $decUserId = base64_decode($encUserId);
                // dd($data);
                $userData = User::where(['id'=>$decUserId, 'reset_password_key' => $decKey])->first();
                // dd($userData);
                if(isset($userData) && $userData!=null && !empty($userData->reset_password_key)){

                    $update['password'] = Hash::make($data['confirm_password']);
                    $update['reset_password_key'] = null;

                    User::where(['id'=>$decUserId, 'reset_password_key' => $decKey])->update($update);
                    Session::flash('success',trans('messages.frontend.reset_password.password_update_success'));
                }else{
                    Session::flash('error',trans('messages.frontend.reset_password.link_expired'));
                }
                return redirect('/login'); 
            }
            // dd($decUserId);
            return view('frontend.home.resetPassword',compact('encKey','encUserId'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    //  public function providerSignUp(Request $request) {
    //     try{
    //         $countries = Country::orderBy('name','asc')->get()->toArray();

    //         return view('frontend.home.providerSignUp',compact('countries'));
    //     }catch(Exception $e){
    //         \Log::error($e->getMessage());
    //         Session::flash('error',trans('messages.frontend.common_error'));
    //         return redirect()->back();
    //     }
    // }

    public function providerSignUp(Request $request) {
        try{
            $countries    =  Country::orderBy('name','asc')->get()->toArray();
            $state        =  State::orderBy('name','asc')->get()->toArray();
            $userType     =  UserType::where('type','provider')->get()->toArray();
            $subscription =  Subscription::orderBy('title','asc')->get()->toArray();
            $storeLocationAddressTypes = StoreLocationAddressType::where('status','active')->get()->toArray();

              $productCategories = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();


            return view('frontend.home.providerSignUp',compact('countries','userType','subscription','state','storeLocationAddressTypes','productCategories'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function getSubCategoriesAndMaterialList(Request $request)
    {

       $data = $request->all();

       $subCategories    = ProductSubCategory::whereIn('category_id', $request->input('categoryId'))->get();
       // dd($subCategories);

       $materialList = productSellingMaterial::whereIn('product_category_id', $request->input('categoryId'))->get();
       
       $view1   = view('frontend.elements.productSubCategories', compact('subCategories'))->render();
      
       $view2   = view('frontend.elements.providerMaterials',['materialList' => $materialList])->render();
       
       $view    = array($view1,$view2);
       
       return $view;
    }

    public function getSubCategoriesBasedMaterialList(Request $request)
    {
       $data = $request->all();
      
       $materialList = productSellingMaterial::whereIn('product_sub_category_id', $request->input('subCategoryId'))->get();   

       $view = view('frontend.elements.providerMaterialsDependsSubCategories',['materialList' => $materialList])->render();
       return $view;
    } 



    public function becomeMember(Request $request) {

        $data  = $request->all();  
        // dd(@$data['experience']);
        $payload  = $request->all(); 
        $supplierCode = null;  

                // dd($data);
        $otp_verify_status = 'yes';
        $complete_profile  = 'yes';

        $userType = UserType::where('type', 'provider')
                                ->where('id', $data['user_type_id'])
                                ->first();

        $userCount = User::where('user_type_id',$data['user_type_id'])->count();

        if($userType) {
            $alias = $userType->alias;
            $supplierCode = $this->getSupplierCode($alias,$userCount);
        }
        if($request->file('profile_document')==null){
           $value =null;
        }else{
            $image = $request->file('profile_document');
            $value = time().'_'.rand().'.'.$image->getClientOriginalExtension();
            $destination_path = providerDocBasePath;
            $image->move($destination_path,$value);
        }

        if (isset($data['experience']) && !empty($data['experience'])) {
            $data['experience'] = $data['experience'];
        }else{
            $data['experience'] = 0;            
        }

        $dateOfBirth = date('Y-m-d', strtotime($data['date_of_birth']));

        if(empty($request['user_service_id'])){
    
            $password= Hash::make($data['password']);

            $newUserId =  User::create([
                                  'user_type_id'          =>$data['user_type_id'],
                                  'user_property_id'      =>$data['user_property_id'],
                                  'company_name'          =>@$data['company_name'],
                                  'contact_name'          =>$data['contact_name'],
                                  'mobile_no'             =>$data['mobile_no'],
                                  'isd_code'              =>'+'.$data['isd_code'],
                                  'email'                 =>$data['email'],
                                  'gender'                =>@$data['gender'],
                                  'date_of_birth'         =>@$dateOfBirth,
                                  'password'              =>$password,
                                  // 'confirm_password'     =>$data['confirm_password'],
                                  'cr_number'              =>$data['cr_number'],
                                  'website_url'            =>$data['website_url'],
                                  // 'postal_code'            =>$data['postal_code '],
                                  // 'address_line_1'         =>$data['address_line_1'],
                                  // 'address_line_2'         =>$data['address_line_2'],
                                  'landline'               =>$data['landline'],
                                  'landline_isd_code'      =>'+'.$data['landline_isd_code'],
                                  'country_id'             =>@$data['country_id'],   
                                  'experience'             =>@$data['experience'],   
                                  // 'city'                   =>$data['city'],  
                                  // 'location'               =>$data['location'],  
                                  'terms_conditions'       =>$data['terms_conditions'],  
                                  // $data['user_other_id']  
                                  'otp_verify_status'      =>$otp_verify_status,  
                                  'complete_profile'       =>$complete_profile,
                                  'supplier_code'          =>$supplierCode,
                                  'about_me'               =>$data['about_me'], 
                                  'contact_last_name'      =>$data['contact_last_name'],
                                  // 'postal_code'            =>$data['postal_code'],
                                  'profile_document'       =>$value         
                                ]);

            $newId         =  $newUserId->id;

            // $OtherServices =  UserOtherService::create([
            //                        'user_id'         =>  $newId,
            //                        'user_type_id'    =>  $data['user_type_id'],
            //                        'name'            =>  $data['other_name']
            //                 ]);

        }else{
         $data      = $request->except('user_service_id');   
          
         // $newUserId = User::create($data);
              $password= Hash::make($data['password']);
         
                       $newUserId =  User::create([
                                  'user_type_id'          =>$data['user_type_id'],
                                  'user_property_id'      =>$data['user_property_id'],
                                  'company_name'          =>@$data['company_name'],
                                  'contact_name'          =>$data['contact_name'],
                                  'mobile_no'             =>$data['mobile_no'],
                                  'isd_code'              =>'+'.$data['isd_code'],
                                  'email'                 =>$data['email'],
                                  'gender'                =>@$data['gender'],
                                  'date_of_birth'         =>@$dateOfBirth,
                                  'password'              =>$password,
                                  // 'confirm_password'     =>$data['confirm_password'],
                                  'cr_number'              =>$data['cr_number'],
                                  'website_url'            =>$data['website_url'],
                                  // 'additional_information' =>$data['additional_information'],
                                  // 'address_line_1'         =>$data['address_line_1'],
                                  // 'address_line_2'         =>$data['address_line_2'],
                                  'landline'               =>$data['landline'],
                                  'landline_isd_code'      =>'+'.$data['landline_isd_code'],
                                  'country_id'             =>@$data['country_id'],   
                                  'experience'             =>@$data['experience'],   
                                  // 'city'                   =>$data['city'],  
                                  // 'location'               =>$data['location'],  
                                  'terms_conditions'       =>$data['terms_conditions'],    
                                  'otp_verify_status'      =>$otp_verify_status,  
                                  'complete_profile'       =>$complete_profile,
                                  'about_me'               =>$data['about_me'], 
                                  'supplier_code'          =>$supplierCode,
                                  // 'user_other_id'          =>$data['user_other_id'],
                                  'contact_last_name'      =>$data['contact_last_name'],
                                  // 'postal_code'            =>$data['postal_code'],
                                  'profile_document'       => $value           
                                ]);

           $newId     = $newUserId->id;

           if($payload['user_service_id']!=null){
                $newId     = $newUserId->id;

                foreach($payload['user_service_id'] as $key =>  $serviceId){
                    $service =  UserSelectedService::create([
                                       'user_id'=>$newId,
                                       'user_service_id'=>$serviceId
                                ]);
                }
            }         

        }

        // dd($data);
        $userLocation = UserStoreLocation::where('user_id',$newId)->first();
        if (empty($userLocation)) {
            $data['use_address_as_default'] = 'yes';
        }else{
            $data['use_address_as_default'] = 'no';            
        }
        $createAddressId = UserStoreLocation::create([
                                                      'user_id'=>$newId,
                                                      'store_name'=>$data['store_name'],
                                                      'address_type_id'=>$data['address_type_id'],
                                                      'street'=>$data['street'],
                                                      'country_id'=>$data['location_country_id'],
                                                      'city_id'=>$data['city_id'],
                                                      'location'=>$data['location'],
                                                      'use_address_as_default'=>$data['use_address_as_default'],
                                                    ])->id;

        // if (User::where('user_other_id', '=', $data['user_other_id']))->exists()) {
         // dd($createAddressId);
        if (isset($data['project_field_ids']) && !empty($data['project_field_ids'])) {
            UserSelectedProjectField::where('user_id',$newId)
                                      ->delete();
            foreach ($data['project_field_ids'] as $key => $projectFieldId) {
                UserSelectedProjectField::create([
                                                   'user_id'=>$newId,
                                                   'user_project_field_id'=>$projectFieldId
                                                ]);
            }
        }
       
        if(isset($data['user_other_id'])){
           
          $updateOtherId= User::where('id',$newId)->update(['user_other_id'=>$data['user_other_id']]);
          
            if(isset($data['user_other_id'])){
                $data['user_other_id']='yes';
            }else{
                $data['user_other_id']='no';
            }
         // dd($data['user_other_id']);

            $OtherServices =  UserOtherService::create([
                                       'user_id'         =>  $newId,
                                       'user_type_id'    =>  $data['user_type_id'],
                                       'name'            =>  $data['other_name']
                                ]);


        }
        
        if(isset($data['profile_link'])){
           
          $updateProfileLink= User::where('id',$newId)->update(['profile_link'=>$data['profile_link']]);
        }   
         // dd($newId);
            $data['media_ids']    =  explode(',', $data['media_ids']);
            $updateProfessionImage =   UserProfessionImage::whereIn('id',$data['media_ids'])->update(['user_id'=>$newId]);
            
         if($data['user_type_id']=='6'){
              $data['brand_ids']     =  explode(',', $data['brand_ids']);
              $updateProfessionImage =   UserBrandImage::whereIn('id',$data['brand_ids'])->update(['user_id'=>$newId]);
          }

         if($data['user_type_id']=='6'){
             
                 foreach ($data['category_id'] as $key => $value) {
                    userProductSelectedCategory::create([
                                     'user_id'      => $newId,
                                     'category_id'  => $value
                                ]);
                 }
                
                 if($data['sub_category_id']!=null){
                      foreach ($data['sub_category_id'] as $key => $value1) {
                         userProductSelectedSubCategory::create([
                                          'user_id'          => $newId,
                                          'sub_category_id'  => $value1
                                     ]);
                      }
                  }
                 

                 foreach ($data['material_id'] as $key => $value2) {
                    UserProductMaterialList::create([
                                     'user_id'          => $newId,
                                     'material_id'      => $value2
                                ]);
                 }

          }

       if (!empty($newUserId)) {
            $response['status']='true';
            $response['id']=$newUserId->id;
       }else{
            $response['status']='false';
            $response['id']='';
       }
       return $response;
    }
    /**
     * Get Supplier Code
     * @param  string $alias 
     * @return string
     */
    private function getSupplierCode($alias,$userCount)
    {
        $prefix = null;
        $supplierCode = null;

        if($alias == 'designer') {
            $prefix = 'BM-DESIGNER-';
        } elseif ($alias == 'contractor') {
            $prefix = 'BM-CONTRACTOR-';
        } elseif ($alias == 'consultant') {
            $prefix = 'BM-CONSULTANT-';
        } else {
            $prefix = 'BM-SELLER-';
        }

        $supplierCode = $prefix.sprintf("%06d", $userCount+1);
        return $supplierCode;
    }
    
    public function memberType(Request $request){
        $data = $request->all();
        $userProperty =  UserProperty::where('user_type_id',$data['selcVal'])->get()->toArray();
        $userService  =  UserService::where('user_type_id',$data['selcVal'])->get()->toArray();
        $userProjectFields  =  UserProjectField::where('user_type_id',$data['selcVal'])->get()->toArray();
        // dd($userProjectFields);
        $view1   = view('frontend.elements.userproperties',['userProperty' => $userProperty,'userService' => $userService])->render();
        $view2   = view('frontend.elements.userservices',['userService' => $userService])->render();
        $projectFieldView  = view('frontend.elements.userProjectFields',['userProjectFields' => $userProjectFields])->render();
        $view = array($view1,$view2,$projectFieldView);
        return $view;
    }

    public function subscriptionPackRegister(Request $request){
        $data = $request->all();

        $userProp = Subscription::where('id',$data['subId'])->first();


        if (!empty($userProp)) {
        $data      = $request->except('subscribe_id');   
        $subscription =  UserSubscription::create([
                                  'user_id'        =>$data['registered_id'],
                              'subscription_id'    =>$data['subId'],
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

 

         
        // dd($new_time);

        UserSubscription::where('user_id',$data['registered_id'])->update([
                              'expiry_subscription_package'  =>$new_time
                         ]);

        $prop = User::where('id',$data['registered_id'])->update([
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

    //  public function registerCard(Request $request){
    //     $data = $request->all();
    //     $data = $request->except('cash_payment_id'); 
    //     $userProp = UserPaymentCard::where('user_id',$data['registered_id'])->first();
  
    //     if($userProp == null){
    //         $var = 'yes';
    //     }else{
    //         $var = 'no';
    //     }

    //     // dd('here');
    //     if (empty($userProp)) {

    //     $userPaymentCad =  UserPaymentCard::create([
    //                               'user_id'              =>$data['registered_id'],
    //                               'card_type'            =>$data['card_type'],
    //                               'card_no'              =>$data['card_no'],
    //                               'name_on_card'         =>$data['name_on_card'],
    //                               'expiry_month'         =>$data['expiry_month'],
    //                               'expiry_year'          =>$data['expiry_year'],
    //                               'cvv'                  =>$data['cvv'],
    //                               'use_card_as_default'  =>$var
    //                         ]);
    //     }

    //     $prop = User::where('id',$data['registered_id'])->update([
    //                            'payment_type'       =>'card',
    //                            'transaction_status' =>'Active'
    //                        ]);

    //     $cardId =  $userPaymentCad->id;

    //    if (!empty($userPaymentCad)) {
    //         $response['status']='true';
    //         $response['id']=$cardId;
    //    }else{
    //         $response['status']='false';
    //         $response['id']='';
    //    }
    //    return $response;
 
    // }

  public function invoiceImage(Request $request){ 
     
       $data = $request->all(); 
       $data = $request->except('cash_payment_id','payment_card_id'); 
       // dd($data);
       if($data['type']=="cash"){

           if(isset($data['uploader']) && !empty($data['uploader']))
             {
                $image = $request->file('uploader');
                $value = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                $destination_path = invoiceImageBasePath;
                $image->move($destination_path,$value);
                // dd($value);
                 $var = 'active';
                 $cashpayment1=   UserSubscriptionPayment::create([
                                              'user_id'              =>$data['registered_id'],
                                          'invoice_image'            =>$value,
                                          'payment_type'             =>$data['type'],
                                              'status'               =>$var
                                      ]);   
                 User::where('id',$data['registered_id'])->update([
                                                    'payment_type'       =>'cash',
                                                    'transaction_status' =>'inactive'
                                                ]);
                 $cardId =  $cashpayment1->id;
                 if (!empty($cashpayment1)) {
                      $response['status']='true';
                      $response['id']=$cardId;

                      $user = User::where('id',$data['registered_id'])->first();
                      $user = !empty($user) ? $user->toArray() : [];
                      
                      /*send confirmation mail to user start*/
                      $data['email'] = $user['email'];
                      $mailData = [];
                      $mailData['name'] = $user['contact_name'].' '.$user['contact_last_name'];
                      $mailData['supplier_code'] = $user['supplier_code'];
                      $mailData['company_name'] = $user['company_name'];

                      
                      try{
                          $this->sendMail('userRegistrationSuccess', $data['email'], $mailData);               
                      }catch(\Exception $e){
                          
                      }
                 }else{
                      $response['status']='false';
                      $response['id']='';
                 }
                  return $response;


                 // $prop = User::where('id',$data['registered_id'])->first();
                 // $prop['payment_type'] ='cash';

            }
        }else if($data['type']=="wiretransfer"){
         
            if(isset($data['uploader_wiretransfer']) && !empty($data['uploader_wiretransfer']))
               {
                 $image = $request->file('uploader_wiretransfer');

                 $value = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                 $destination_path = invoiceImageBasePath;
                 $image->move($destination_path,$value);
                 // dd($value);

                 $var = 'active';
                 $cashpayment2=   UserSubscriptionPayment::create([
                                               'user_id'              =>$data['registered_id'],
                                           'invoice_image'            =>$value,
                                            'payment_type'             =>$data['type'],
                                               'status'               =>$var
                                       ]);   

                 User::where('id',$data['registered_id'])->update([
                                                    'payment_type'       =>'wiretransfer',
                                                    'transaction_status' =>'inactive'
                                                ]);
               }
               $cardId =  $cashpayment2->id;
               if (!empty($cashpayment2)) {
                    $response['status']='true';
                    $response['id']=$cardId;
                    $user = User::where('id',$data['registered_id'])->first();
                    $user = !empty($user) ? $user->toArray() : [];
                    // dd($user);
                    /*send confirmation mail to user start*/
                    $data['email'] = $user['email'];
                    $mailData = [];
                    $mailData['name'] = $user['contact_name'].' '.$user['contact_last_name'];
                    $mailData['supplier_code'] = $user['supplier_code'];
                     $mailData['company_name'] = $user['company_name'];
                    try{
                        $this->sendMail('userRegistrationSuccess', $data['email'], $mailData);               
                    }catch(\Exception $e){
                        
                    }
               }else{
                    $response['status']='false';
                    $response['id']='';
               }
                return $response;


       }else if($data['type']=="card"){
              // dd($data);
            $userProp = UserPaymentCard::where('user_id',$data['registered_id'])->first();
            
            // dd('here');
            if($userProp == null){
                $var = 'yes';
            }else{
                $var = 'no';
            }
            
            $userPropCount = UserPaymentCard::count(); 
            // dd()
            // $mawadCodeCount = User::where('id', \Auth::user()->id)->count();
            $ItemNumber = $userPropCount +1;
            $usreId = $data['registered_id'];
            $transaction_id ='MW-TX000-'.$usreId.'-'.$ItemNumber;
            // dd($transaction_id);
             

            if (empty($userProp)) {

                    $userPaymentCad =  UserSubscriptionPayment::create([
                                          'user_id'              =>$data['registered_id'],
                                          'payment_type'         =>$data['type'],
                                         'card_type'             =>$data['card_type'],
                                          'card_no'              =>$data['card_no'],
                                          'name_on_card'         =>$data['name_on_card'],
                                          'expiry_month'         =>$data['expiry_month'],
                                          'expiry_year'          =>$data['expiry_year'],
                                          'cvv'                  =>$data['cvv'],
                                          'transaction_id'       => $transaction_id,
                                          'use_card_as_default'  =>$var
                                    ]);
            }

            $prop = User::where('id',$data['registered_id'])->update([
                                   'payment_type'       =>'card',
                                   'transaction_status' =>'inactive'
                               ]);


            $cardId =  $userPaymentCad['id'];
             // dd($cardId);
            if (!empty($cardId)) {
                 $response['status']='true';
                 $response['id']=$cardId;
                  // dd('success');
                 $user = User::where('id',$data['registered_id'])->first();
                 $user = !empty($user) ? $user->toArray() : [];
                 // dd($user);
                 /*send confirmation mail to user start*/
                 $data['email'] = $user['email'];
                 $mailData = [];
                 $mailData['name'] = $user['contact_name'].' '.$user['contact_last_name'];
                 $mailData['supplier_code'] = $user['supplier_code'];
                  $mailData['company_name'] = $user['company_name'];
                 try{
                     $this->sendMail('userRegistrationSuccess', $data['email'], $mailData);               
                 }catch(\Exception $e){
                     
                 }
                 /*send confirmation mail to user end*/
            }else{
                 $response['status']='false';
                 $response['id']='';
                 // dd('false');
            }
            return $response;
        }  

    }
    
    public function storeState(Request $request){
        $input   = $request->all();
        $states  = State::where('country_id',$input['country_id'])->get();
        $view    = view('admin.element.country',['states' => $states])->render();
        return $view;

    }

    
    
     public function storeLocationData(Request $request)
     {
        $data = $request->all();

        $userProp = UserStoreLocation::where('user_id',$data['registered_id'])->first();

        // if (empty($userProp)) {

        $userStorelocation =  UserStoreLocation::create([
                                 'user_id'               =>$data['registered_id'],
                                  'store_name'            =>$data['store_name'],
                                  'street'                =>$data['street'],
                                  'country_id'            =>$data['country_id'],
                                  'state_id'              =>$data['state_id'],
                                  'city'                  =>$data['city'],
                                  'location'              =>$data['location']
                            ]);
        // }


        // $cardId =  $userStorelocation->id;

        if (!empty($userStorelocation)) {
                $response['status']='true';
                 Session::flash('success','You are successfully registered as provider');
                // $response['id']=$cardId->id;
           }else{
                $response['status']='false';
                $response['id']='';
           }
           return $response;
 
    }

    public function uploadProviderImage(Request $request)
    {
        if($request->isMethod('post')){
            $data22 = $request->all();
            // dd($data22);
            $payload = [];
            // $userId = Auth::user()->id;
            // dd($userId);
            if($request->hasfile('file')) { 
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename =time().'.'.$extension;
                $file->move(providerBaseImgsPath, $filename);
                $payload['name'] = $filename;
            }
            $imgId = UserProfessionImage::create($payload)->id;
            // dd($imgId);
            $file_type = 'image';

            return $response = array('status' => 'success', 'img_id' => $imgId, 'img_name' => $filename, 'file_type' => $file_type);            
        }
    }

    public function deleteImage(Request $request){
        if($request->isMethod('post')){
            $delete_image = UserProfessionImage::where(['id' => $request->file_id])->first();
            // dd($delete_image);
            if($delete_image != null){
                if(file_exists('public/frontend/images/provider/'.$delete_image->name)){
                    unlink(providerBaseImgsPath.$delete_image->name);
                }
                $delete_image->delete();
            }  

            return $response = array('status' => 'success', 'result' => $delete_image);            
        }
    }

    public function registerToken(Request $request) {

        $data = $request->all();
        // dd($data);
        if (!empty($data['token']) && Auth::check()) {
            $device = GcmDevice::where('user_id',Auth::user()->id)->where('device_type','web')->first();

            if (!empty($device)) {
                GcmDevice::where('user_id',Auth::user()->id)->where('device_type','web')->update([
                                                                                                  'device_token'=>$data['token']
                                                                                                ]);
            }else{
                GcmDevice::create([
                                   'user_id'=>Auth::user()->id,
                                   'device_token'=>$data['token'],
                                   'device_type'=>'web',
                                  ]);
            }

            // $to = "c5QAu71o28mCh7Tac0WqY5:APA91bFagsIdgxesX42dvFmQCcmHFx9Tpsx85JTazSgyauuoTh0BMZtbok8oFannAA8g6oWf2aVyWO_AEWZLLOvPau9dQsWSzgxR0P3C_A1Yd9r4WzTBL_yKkjtUPDC4uE2_5XsiFnQ2";  
            // $from = "AAAAZGGD0dE:APA91bHDNXuIcECTOGHutzgw5dCIDoP5qfRWJeDWGRqnH_sr9r8aerNc_vN1lkPHhC7UBjJju3qvN_w9mdT7cT7r3Jf80GB1x-Ta60kHYCClYbLByz5uvLCo-6_EIj_hT8D1TarNyrYJ";
            // $msg = array
            //       (
            //         'body'  => "Testing Testing",
            //         'title' => "Hi, Amrit Darling",
            //         'receiver' => 'erw',
            //         'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
            //         'sound' => 'mySound'/*Default sound*/
            //       );

            // $fields = array
            //         (
            //             'to'        => $to,
            //             'notification'  => $msg
            //         );

            // $headers = array
            //         (
            //             'Authorization: key=' . $from,
            //             'Content-Type: application/json'
            //         );
            // // dd($fields);
            // //#Send Reponse To FireBase Server 
            // $ch = curl_init();
            // curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            // curl_setopt( $ch,CURLOPT_POST, true );
            // curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            // curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            // curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            // curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            // $result = curl_exec($ch );
            // // dd($result);
            // curl_close( $ch );

            return $response = array('status'=>'success');
        }
    }

     public function addProductAsCart(Request $request)
        {
            $data = $request->all(); 
            $response= [];
            $already_exist = ProductCart::where('user_id',$data['userId'])->where('product_id',$data['productId'])->first();
        
            if(!empty($already_exist)){
                $response['status'] = 'false';
                $response['msg']    = 'Product already exist in cart.';
            }else{
                $sellerDiscountCodeId = DiscountedProduct::with('sellerDiscountCode')
                                ->where('product_id',$data['productId'])
                                ->distinct('seller_discount_code_id')
                                ->pluck('seller_discount_code_id')
                                ->toArray();

                $priceRange  = ProductPriceRange::where('product_id',$data['productId'])->first();

                if(!empty($sellerDiscountCodeId)){
                   $cartProduct = SellerDiscountCode::where('id',$sellerDiscountCodeId)->first();
                }
                // dd($data);

                $productCartlist =  ProductCart::create([
                                        'user_id'                =>$data['userId'],
                                        'product_id'             =>$data['productId'],
                                        'product_discount_code'  =>@$cartProduct['discount_code'],
                                        'product_discount_type'  =>@$cartProduct['discount_type']

                                  ])->id;

                $productCart =ProductCart::where('id',$productCartlist)->first();

                $productDetail = Product::with('sellingUnitProduct')->where('id',$data['productId'])->first();
                // dd($productDetail);

               if($productDetail['defualt_selling_unit_price']!=null){
                  $updateProductCart = ProductCart::where('id',$productCartlist)
                         ->update([
                             'product_single_unit_price'=>$productDetail['defualt_selling_unit_price']
                          ]);

                  $cartQuantityPrice = $productDetail['defualt_selling_unit_price']*$productDetail['minimum_buying_quantity_number'];       

               }else{
                  $priceRange  = ProductPriceRange::where('product_id',$data['productId'])->first();
                  // dd($data);
                  
                  if(Auth::check()){               
                        $updateProductCart =  ProductCart::where('id',$productCartlist)
                                                ->where('user_id',Auth::user()->id)
                                                ->update([
                                  'product_single_unit_price'=>$priceRange['selling_unit_price']
                                         ]);
                  }else{
                      $userId  = $_COOKIE['guestId'];
                      $updateProductCart =  ProductCart::where('id',$productCartlist)
                                                ->where('user_id',$userId)
                                                ->update([
                                  'product_single_unit_price'=>$priceRange['selling_unit_price']
                                         ]);
                  }

                  $cartQuantityPrice = $priceRange['selling_unit_price']*$productDetail['minimum_buying_quantity_number'];                
                }
        
         
                $discount_type  = @$cartProduct['discount_type'];

                $discountAmount = @$cartProduct['discount_value'];

                if(@$discount_type=='percent'){
                        $balanceAmount =  @$discountAmount*$cartQuantityPrice/100;
                        $balanceAmount =  $cartQuantityPrice - $balanceAmount;
                  // dd($balanceAmount);

                }else if(@$discount_type=='value'){
                          $balanceAmount = $cartQuantityPrice - @$discountAmount;
                  // dd($balanceAmount);
                }

                ProductCart::where('id',$productCartlist)->update([
                    'product_quantity'             =>@$productDetail['minimum_buying_quantity_number'],
                    'product_quantity_price'       =>@$cartQuantityPrice,
                    'product_unit'                 =>@$productDetail['sellingUnitProduct']['name'],
                    'product_store_id'             =>@$productDetail['user_store_location_id'],
                    'product_name'                 =>@$productDetail['item_name'],
                    'product_price_after_discount' =>@$balanceAmount,
                    'product_discount_code'        =>@$cartProduct['discount_code'],
                    'product_discount_type'        =>@$cartProduct['discount_type'],
                     'seller_id'                   =>@$productDetail['user_id']
                ]);

                $card_type_item_count = ProductCart::where('user_id',$data['userId'])->count();
                $response['count']  =  $card_type_item_count;    
                $response['status'] = 'true';
                $response['msg']    = 'Product successfully added in Cart';
            }

            return $response; 

        }


    
   public function myCart(Request $request) {
        $countries        = Country::orderBy('name','asc')->get()->toArray();
        $myCartDetail     = ProductCart::where('user_id',Auth::user()->id)->pluck('product_id');

        $seller_product = ProductCart::with('product_name.sellerName','product_name.storeUnderProduct','product_name.product_Image_for_cart','product_name.productDiscountCode.sellerDiscountCode','product_name.productPriceCartProject','product_name.sellingUnitProduct')->where('user_id',Auth::user()->id)->where('payment_status','unpaid')->get()->groupBy('product_name')->toArray();
        
        $SellerIdOfpProducts = Product::with('productpricerange','storeUnderProduct')->whereIn('id',$myCartDetail)->pluck('user_id')->toArray();

        $sellerAdrress = User::whereIn('id',$SellerIdOfpProducts)->get()->toArray();
        $deliveryAddress  = UserDeliveryAddress::where('user_id',Auth::user()->id)->get()->toArray();
        
        $userCards = UserPaymentCard::where('user_id',Auth::user()->id)
                                             ->orderBy('id','desc')
                                             ->get()
                                             ->toArray();    
         if(empty($myCartDetail)){
             return redirect()->back();
         }

         return view('frontend.login.myCart',compact('myCartDetail','seller_product','deliveryAddress','countries','sellerAdrress','userCards'));
     }

      public function deleteMyCartItem(Request $request,$id)
       {
          $id   = $request->id;
          $cartCount = ProductCart::where('user_id',Auth::user()->id)->count();
          $resp = [];
          if($cartCount<2){
              ProductCart::where('product_id',$id)->delete();         
              $resp['status']  = 'vaccantCart';
              // return redirect('/user/buildingMaterialServices');
          }else{
              ProductCart::where('product_id',$id)->delete();
              $resp['status']  = 'true';
          }
          Session::flash('success','Cart item deleted successfully');
          return $resp;
       }


      public function updateMyCart(Request $request)
       {
          $data   = $request->all();
          $dataUpadted = ProductCart::where('id',$data['cart_id'])->update(['product_quantity'=>$data['quantity_number']]);  
          $productCart = ProductCart::where('id',$data['cart_id'])->first();
          // $number = 401;
          $conditionCheck = ProductPriceRange::where('product_id',$productCart['product_id'])
                                                  ->where('from_number','<=',$data['quantity_number'])
                                                  ->where('to_number','>=',$data['quantity_number'])
                                                  // ->where('id','!=',42)
                                                  ->first();

         if($conditionCheck!=null){

             $final_Quantity_Price = $conditionCheck['final_price'];
             $single_Unit_Price    = $conditionCheck['unit_price'];
                              
             $productPrice = $data['quantity_number'] * $conditionCheck['final_price'];

                 if($data['discount_type']!=null){

                     if($data['discount_type']=='percent'){
                         $balanceAmount =  $data['discountAmount']*$productPrice/100;
                         $balanceAmount =  number_format($balanceAmount, 2);
                         $balanceAmount =  $productPrice - $balanceAmount;
                         
                     }else if($data['discount_type']=='value'){
                         $balanceAmount = $productPrice - $data['discountAmount'];
                     }
                          ProductCart::where('id',$data['cart_id'])
                                     ->update([
                                                'product_quantity_price'    =>  $productPrice,
                                                'product_price_after_discount' =>  $balanceAmount
                                 ]);

                 }else{
                     ProductCart::where('id',$data['cart_id'])
                             ->update([
                                    'product_quantity_price'    =>  $productPrice
                                 ]); 
                     }

         }else{
             $product = Product::with('product_price_range_single_unit_price')->where('id',$productCart['product_id'])->first();
            
             $productPrice = $data['quantity_number'] * $product['product_price_range_single_unit_price']['final_price'];
             
                 if($data['discount_type']!=null){

                     if($data['discount_type']=='percent'){
                         $balanceAmount = $data['discountAmount']*$productPrice/100;
                          

                         $balanceAmount = $productPrice - number_format($balanceAmount, 2);
                         // dd($balanceAmount);
                           

                     }else if($data['discount_type']=='value'){
                         $balanceAmount = $productPrice - $data['discountAmount'];
                     }
                         // dd($balanceAmount);
                          ProductCart::where('id',$data['cart_id'])
                                     ->update([
                                                'product_quantity_price'    =>  $productPrice,
                                                'product_price_after_discount' =>  $balanceAmount
                                 ]);
                 }else{
                     
                        $balanceAmount = $productPrice;

                        ProductCart::where('id',$data['cart_id'])
                             ->update([
                                    'product_quantity_price'    =>  $productPrice
                                 ]); 
                    // dd($balanceAmount);
                 }
             $conditionCheck['final_price'] = $product['product_price_range_single_unit_price']['final_price'];     

         } 

          $sumAllProduct = ProductCart::where('user_id',Auth::user()->id)->pluck('product_quantity_price')->sum();
          $taxOnProductPercentage = ProductTax::first();
          $taxAmount = $taxOnProductPercentage['tax_percent']*$sumAllProduct/100;
          $grandTotal = $sumAllProduct  + $taxAmount;

          // dd($balanceAmount);
          $response['discount_prc']      = @$balanceAmount;
          $response['Sum_Product_Price'] = $sumAllProduct;
          $response['productPrice']      = $productPrice;
          $response['singleUnitPrice']   = $conditionCheck['final_price'];
          $response['taxAmount']         = $taxAmount;
          $response['grandTotal']        = $grandTotal;
          $response['status']            = 'success';

          // Session::flash('success','Cart item deleted successfully');
          return $response;
       }
      //  public function checkCouponInCart(Request $request)
      // {
      //    $data   = $request->all();
      //    $data =$request->except('_token'); 
      //    $discountCodeRecord =  ProductCart::where('user_id',$data['userId'])->where('product_discount_code',$data['discountCode'])->first();         
      //    if($discountCodeRecord!=null){
      //         $afterDiscountPrice = ProductCart::where('product_id',$discountCodeRecord['product_id'])->pluck('final_price')->sum();
      //         SellerDiscountCode::where('product_id',$discountCodeRecord['product_id'])->first();
              
      //         dd($discountCodeRecord);
      //         $response['status'] = 'true';

      //    }else{
      //        Session::flash('error','Discount Code do not exist in the record');
      //         $response['status'] = 'false';
      //    }
      //    return $response;
      // }

       public function checkCouponInCart(Request $request)
        {
           $data   = $request->all();
           $data   = $request->except('_token');
           // dd($data);
           $check_coupon = ProductCart::check_coupon($data);

           return $check_coupon;
        }

        public function cartAddDeliveryAddress(Request $request) {
            if($request->isMethod('post')){
                $data = $request->except('_token');
                $data['user_id'] = Auth::user()->id; 

                $createAddressId = UserDeliveryAddress::create([
                               'user_id'        =>$data['user_id'],
                               'address_title'  =>$data['address_title'],
                               'address'        =>$data['address'],
                               'province_name'  =>$data['province_name'],
                               'postal_code'    =>$data['postal_code'],
                               'location'       =>$data['location'],
                               'city_id'        =>$data['city_id'],
                               'country_id'     =>$data['country_id']
                     ])->id;

                $deliiveryAddress = UserDeliveryAddress::where('user_id',$data['user_id'])->get()->toArray();
                // dd($deliiveryAddress)
                return view('frontend.elements.cartDeliveryAddress', ['deliveryAddress' => $deliiveryAddress])->render();

            }else{
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }

        public function cartEditAddressModal($encAddrsId, Request $request) {
            try{
                $decAddrsId = base64_decode($encAddrsId);
                // dd($decAddrsId);
                $countries = Country::orderBy('name','asc')->get()->toArray();
                $userAddress = UserDeliveryAddress::where('id',$decAddrsId)->first();
                $userAddress = !empty($userAddress) ? $userAddress->toArray() : [];
                $cities = City::where('country_id',$userAddress['country_id'])->orderBy('name','asc')->get()->toArray();
                // dd($cities);
                $html = view('frontend.include.modals.cartEditAddressRender',compact('countries','userAddress','encAddrsId','cities'))->render();
                // dd($html);
                return array('status'=>'success','html'=>$html);
            }catch(Exception $e){
                \Log::error($e->getMessage());
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }

        public function cartUpdateAddress(Request $request) {
            try{
                $data = $request->except('_token','address_id');
                // dd($request->address_id);
                $data['user_id'] = Auth::user()->id; 
                $decAddrsId = base64_decode($request->address_id);
                $update = UserDeliveryAddress::where('id',$decAddrsId)->update($data);
                // dd($update);
                if ($update==1) {
                    Session::flash('success',trans('messages.frontend.user_profile.update_address_success'));
                    $deliiveryAddress = UserDeliveryAddress::where('user_id',$data['user_id'])->get()->toArray();
                    // dd($deliiveryAddress)
                    return view('frontend.elements.cartDeliveryAddress', ['deliveryAddress' => $deliiveryAddress])->render();
                    // return redirect('/user/locations');
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

        public function cartDeleteAddress($encAddrsId, Request $request) {
            try{
                $decAddrsId = base64_decode($encAddrsId);
                $UserId = Auth::user()->id; 
                $countDeliveryAddress = UserDeliveryAddress::where('user_id',$UserId)->count();
                // dd($countDeliveryAddress);
                if($countDeliveryAddress <2){
                     return array('status'=>'false');
                }else{
                     $delUserAddress = UserDeliveryAddress::where('id',$decAddrsId)->delete();
                return array('status'=>'success');
                }
                 
            }catch(Exception $e){
                \Log::error($e->getMessage());
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
        }
      
     ///////////////////Card Added tot//////////////////////////
        
         public function cardAddedToCart(Request $request) {
            // dd('here');
            try{
                if($request->isMethod('post')){
                    $data = $request->except('_token');
                    $data['user_id'] = Auth::user()->id; 
                    // dd($data);
                    $createPaymentMethodId = UserPaymentCard::create($data)->id;
                    $userCards      = UserPaymentCard::where('user_id',$data['user_id'])->get()->toArray();
                    return view('frontend.elements.cartDeliveryCard', ['userCards' => $userCards])->render();   
                       // dd($deliiveryAddress)
                }
            }catch(Exception $e){
                \Log::error($e->getMessage());
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
         }

         public function cartEditCardModal($encCardId, Request $request) {
             try{
                 $decCardId = base64_decode($encCardId);
                 // dd($decCardId);
                 $userCard = UserPaymentCard::where('id',$decCardId)->first();
                 $userCard = !empty($userCard) ? $userCard->toArray() : [];
                 // dd($userCard);
                 $html = view('frontend.include.modals.cartEditCardRender',compact('userCard','encCardId'))->render();
                 // dd($html);
                 return array('status'=>'success','html'=>$html);
             }catch(Exception $e){
                 \Log::error($e->getMessage());
                 Session::flash('error',trans('messages.frontend.common_error'));
                 return redirect()->back();
             }
         }

         public function cartUpdateCard(Request $request) {
             try{
                 $data = $request->except('_token','card_id');
                 $decCardId = base64_decode($request->card_id);
                 // dd($request->all());
                   $data['user_id'] = Auth::user()->id; 
                 $update = UserPaymentCard::where('id',$decCardId)->update($data);

                 if ($update==1) {
                     $userCards = UserPaymentCard::where('user_id',$data['user_id'])->get()->toArray();
                    // dd($userCards)
                    return view('frontend.elements.cartDeliveryCard', ['userCards' => $userCards])->render();
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
                 $UserId = Auth::user()->id; 
                 $countUserCard = UserPaymentCard::where('user_id',$UserId)->count();
                
                 if($countUserCard <2){
                      return array('status'=>'false');
                 }else{
                      $delUserCard = UserPaymentCard::where('id',$decCardId)->delete();
                      return array('status'=>'success');
                 }

             }catch(Exception $e){
                 \Log::error($e->getMessage());
                 Session::flash('error',trans('messages.frontend.common_error'));
                 return redirect()->back();
             }
         }

     
         // public function cartPayment(Request $request) {
         //    try{
         //        $data = $request->except('_token');
                
         //        $user_id        =  Auth::User()->id;
         //        $invoice_id     =  'INV'.rand(111,999).date('Ymd');
         //        $user_items     =  ProductCart::where('user_id',$user_id)->get()->toArray();
         //        $user_name      =  User::where('id',$user_id)->first();
         //        $sub_total      =  ProductCart::where('user_id',$user_id)->pluck('product_quantity_price')->sum();
         //        $tax            =  ProductTax::first();
         //        $tax_price      =  $tax['tax_percent']/100*$sub_total;
              
               
                
         //        if(!empty($user_items)){
         //            $order                   =  new Order;
         //            $order->invoice_id       =  $invoice_id; 
         //            $order->user_id          =  $user_id;
                  
         //            $order->sub_total        =  $sub_total;
         //            $order->tax_price        =  $tax_price;
                   
         //            $order->placed_on        =  date('Y-m-d');
                   
         //            $order->order_status     =  'pending';
         //            $order->save();
         //        }else{
         //            return redirect('user/buildingMaterialServices')->with('error','Your cart is Empty.');
         //        }
         
         //       ProductCart::where('user_id',$user_id)->delete();
         //       $resp = [];
         //       $resp['status']    =  'true';
         //       $resp['msg']       =  'order added successfully';
         //       $resp['order_id']  =  $order['invoice_id'];
             
         //       return $resp;
         //    }catch(Exception $e){
         //        \Log::error($e->getMessage());
         //        Session::flash('error',trans('messages.frontend.common_error'));
         //        return redirect()->back();
         //    }
         // }

         ///new uploaded 

        public function cartPayment(Request $request) {
            try{
                $data = $request->except('_token');
                // dd($data);
                $user_id        =  Auth::User()->id;
                $invoice_id     =  'BM-Order'.rand(111,999).date('Ymd');
                $user_items     =  ProductCart::where('user_id',$user_id)->get()->toArray();
                $user_name      =  User::where('id',$user_id)->first();

                $sub_total      =  ProductCart::where('user_id',$user_id)->pluck('product_quantity_price')->sum();
                $tax            =  ProductTax::first();
                $tax_price      =  $tax['tax_percent']/100*$sub_total;

                // dd($data);

                $check_coupon = ProductCart::check_coupon($data);
               
                 // dd($check_coupon);
                 // dd($addressType);
                
                if(!empty($user_items)){
                    $order                   =  new Order;
                    $order->invoice_id       =  $invoice_id; 
                    $order->user_id          =  $user_id;
                    $order->sub_total        =  $check_coupon['Sum_Product_Price'];
                    $order->tax_price        =  $check_coupon['taxAmount'];
                    $order->final_total      =  $check_coupon['grandTotal']; 
                    $order->placed_on        =  date('Y-m-d');
                    $order->deliver_on       =  null;
                    $order->order_status     =  'In Progress';
                    $order->save();
                    

                    // $latestOrder = Order::where('user_id',Auth::user()->id)->latest()->first();
                    
                    if($check_coupon['status']!='false'){  
                       
                        if(isset($check_coupon['DiscountPercent'])){
                           $check_coupon['DiscountPercent']=$check_coupon['DiscountPercent'];
                        }else{
                          $check_coupon['DiscountPercent'] =null;
                        }

                        $discountCodeRecord =  ProductCart::where('user_id',$data['userId'])->where('product_discount_code',$data['discountCode'])->first();

                        Order::where('user_id',$user_id)->where('id',$order->id)->update([
                                'coupon_name'           =>$data['discountCode'],
                                'coupon_type'           =>@$discountCodeRecord['product_discount_type'],
                                'discount_price'        =>@$check_coupon['DiscountValue'],
                                'discount_percent'      =>@$check_coupon['DiscountPercent']     
                        ]);
                    }

                    if($data['choose_address'] == 'store'){
                       $addressType = 'StoreAddress';
                       $product_store_id = '';
                    }else if($data['delivery_id'] != ''){
                       $addressType = 'DeliveryAddress';
                       $product_store_id = $data['delivery_id'];
                    }

                foreach ($user_items as $key => $value) {
                    OrderItem::create([
                                    'order_id'                 =>@$order->id,
                                    'seller_id'                =>@$value['seller_id'],
                                    'product_id'               =>@$value['product_id'],
                                    'address_type'             =>@$addressType,
                                    'product_store_id'         =>@$value['product_store_id'],
                                    'product_name'             =>@$value['product_name'],
                                    'quantity'                 =>@$value['product_quantity'],
                                    'quantity_price'           =>@$value['product_quantity_price'],
                                    'item_price'               =>@$value['product_single_unit_price'],
                                    'product_unit'             =>@$value['product_unit'],
                                    'user_delivery_address_id' =>@$data['delivery_id'],
                                    'product_order_status_id'  =>1,
                                    'status'                   => 'In Progress'
                            ]);         
                }

                }else{
                    return redirect('user/buildingMaterialServices')->with('error','Your cart is Empty.');
                }
         
               ProductCart::where('user_id',$user_id)->delete();
               $resp = [];
               $resp['status']    =  'true';
               $resp['msg']       =  'order added successfully';
               $resp['order_id']  =  $order['invoice_id'];
             
               return $resp;
            }catch(Exception $e){
                \Log::error($e->getMessage());
                Session::flash('error',trans('messages.frontend.common_error'));
                return redirect()->back();
            }
         }




    // public function viewSellerDeatil(Request $request,$id) {
    //     try{
    //        $decDesignerId = base64_decode($id);
    //        $designer = User::with('countryDetail','userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userProfessionImagesDetail','userDefaultStoreLocation.cityDetail')->where('id',$decDesignerId)->first();
    //        $designer = !empty($designer) ? $designer->toArray() : [];
    //        // dd($designer);
    //        return view('frontend.login.sellerdetail.sellerDetail',compact('designer'));
    //     }catch(Exception $e){
    //         \Log::error($e->getMessage());
    //         Session::flash('error',trans('messages.frontend.common_error'));
    //         return redirect()->back();
    //     }
    // } 


    

     // public function discountCode(Request $request){
          
     //     $allDiscountCodeProducts  = SellerDiscountCode::select('product_id')->pluck('product_id');
     //     $allProductsStoreLocation = Product::whereIn('id',$allDiscountCodeProducts)->pluck('user_store_location_id');
        
     //     $allStoresOfProducts = Product::with('productDiscountCode','category','subCategory','productImage','productselectedcategory','productselectedsubcategory','sellerProduct','storeUnderProduct')->whereIn('id',$allDiscountCodeProducts)->orderBy('user_store_location_id','asc');
             

     //     $allProductsUnderStores = Product::with('productDiscountCode','category','subCategory','productImage','productselectedcategory','productselectedsubcategory','sellerProduct','storeUnderProduct','product_selected_category')->whereIn('id',$allDiscountCodeProducts)->orderBy('user_store_location_id','asc');


     //     $product_name = '';
     //     $product_store = '';

     //     if(isset($_GET)){

     //         $product_name  = @$_GET['product_name'];
     //         $product_store = @$_GET['product_store'];

             

     //         if($product_name!=''){
     //               $allStoresOfProducts = $allStoresOfProducts->where(function($q) use($product_name){
     //                     $q->where('products.item_name','=',$product_name);
                     
     //             });
     //         }
     //         if($product_store!=''){
     //               $allProductsUnderStores = $allProductsUnderStores->wherehas('storeUnderProduct',function($q) use($product_store){
     //                     $q->where('store_name','=',$product_store);
                     
     //             });      
     //         }
     //          $storesPaginate         = $allStoresOfProducts->paginate(4);
     //          $allStoresOfProducts    = $allStoresOfProducts->get()->toArray();  

     //          $productUnderStorePaginate  = $allProductsUnderStores->paginate(4); 
     //          $allProductsUnderStores     = $allProductsUnderStores->get()->toArray();          

     //     }
              

     //  return view('frontend.home.discountCodes',compact('allStoresOfProducts','allProductsUnderStores','storesPaginate','productUnderStorePaginate'));
     // }


   public function discountProductsCode(Request $request){

        $date = date('Y-m-d');
        // dd(DiscountedProduct::with(['discountedProducts'=>function($query){
        //           return $query->where('seller_discount_code_id','=','discounted_products.id');
        //       }
        //   ])->whereHas('discountedProducts', function($q){
        //       $q->where('seller_discount_code_id', '=', 'discounted_products.id');
        //   })->get()->toArray());

        $allDiscountCodeProducts  =DiscountedProduct::select('product_id')->pluck('product_id');
        $allProductsStoreLocation = Product::whereIn('id',$allDiscountCodeProducts)->pluck('user_store_location_id');
        
        $allStoresOfProducts = Product::with('productDiscountCode.discountedProducts','productDiscountCode','category','subCategory','productImage','productselectedcategory','productselectedsubcategory','sellerProduct','storeUnderProduct')->whereIn('id',$allDiscountCodeProducts)->orderBy('user_store_location_id','asc');

        $product_name  = '';
         
        if(isset($_GET)){
             $product_name  = @$_GET['product_name'];
             if($product_name!=''){
                   $allStoresOfProducts = $allStoresOfProducts->where(function($q) use($product_name){
                         $q->where('products.item_name','like','%'.$product_name.'%');
                 });
             }

          $storesPaginate         = $allStoresOfProducts->paginate(6);
          $allStoresOfProducts    = $allStoresOfProducts->get()->toArray();
        }

        // dd($allStoresOfProducts);
      return view('frontend.home.discountCodes',compact('allStoresOfProducts','storesPaginate'));
   }

     public function discountCodeStore(Request $request){
          
         $allDiscountCodeProducts  = DiscountedProduct::select('product_id')->pluck('product_id');
         // $allProductsStoreLocation = Product::whereIn('id',$allDiscountCodeProducts)->pluck('user_store_location_id');
         $allProductsUnderStores = Product::with('sellerName','productDiscountCode.discountedProducts','productDiscountCode','category','subCategory','productImage','productselectedcategory','productselectedsubcategory','sellerProduct','storeUnderProduct','product_selected_category')->whereIn('id',$allDiscountCodeProducts)->orderBy('id','asc');
         

         $product_name  = '';
         $product_store = '';
         

         if(isset($_GET)){

             $product_name  = @$_GET['product_name'];
             $product_store = @$_GET['product_store'];

             
             if($product_store!=''){
               
                        // concat(first_name, ' ', last_name) 
                 $allProductsUnderStores = $allProductsUnderStores->wherehas('sellerName',function($q) 
                    use($product_store){
                       $q->where('contact_name','LIKE','%'.$product_store.'%')                   
                         ->orwhere('contact_last_name','LIKE','%'.$product_store.'%');
                    });

               
             }

          $productUnderStorePaginate  = $allProductsUnderStores->paginate(6); 
          $allProductsUnderStores = $allProductsUnderStores->get()->toArray();
         }
              
      return view('frontend.home.discountCodesProducts',compact('allProductsUnderStores','productUnderStorePaginate'));
     }

     /////////////////////////Add Brand.///Trademark///////////////////

      public function uploadProviderBrandImage(Request $request)
      {
          if($request->isMethod('post')){
              $data22 = $request->all();
              $payload = [];

              if($request->hasfile('file')) { 
                  $file = $request->file('file');
                  $extension = $file->getClientOriginalExtension();
                  $filename = time().'.'.$extension;
                  // dd($filename);
                  $file->move(providerBrandImgsBasePath, $filename);
                  $payload['name'] = $filename;
              }
              // $user_id = Auth::user()->id;
              $imgId = UserBrandImage::create([
                                             'name'    =>$filename,
                                      ])->id;
              // dd($imgId);
              $file_type = 'image';

              return $response = array('status' => 'success', 'img_id' => $imgId, 'img_name' => $filename, 'file_type' => $file_type);            
          }
      }

      public function deleteBrandImage(Request $request){
          if($request->isMethod('post')){
               $data =$request->all();
              $delete_image = UserBrandImage::where(['id' => $request['file_id']['id'] ])->first();
               // dd($delete_image);
              if($delete_image != null){
                  // dd($delete_image);
                  if(file_exists('public/frontend/images/providerBrandImages/'.$delete_image->name)){
                      unlink(providerBrandImgsBasePath.$delete_image->name);
                  }
                  $delete_image->delete();
              }  

              return $response = array('status' => 'success', 'result' => $delete_image);            
          }
      }


}
