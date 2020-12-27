<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use Auth;
use Hash;
use Intervention\Image\ImageManagerStatic as Image;
use App\UserType;
use App\RequestForProposalUserCheckProvider;
use App\UserProjectField;
use App\UserProperty;
use App\UserService;
use App\ProviderCity;
use App\UserInquery;
use Illuminate\Support\Facades\Mail;

use App\userProductSelectedCategory;
use App\userProductSelectedSubCategory;
use App\UserProductMaterialList;
use App\productSellingMaterial;

use App\ProductCategory;
use App\ProductSubCategory;
use App\UserBrandImage;

class ProviderController extends Controller
{
    //
    public function check_percentage(Request $request){
        $data = $request->all();
    }

    public function designerList(Request $request) {
        try{
            $data = $request->all();
            
            $userTypeId = UserType::where('alias','designer')->value('id');
            
            $designers = User::with('userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userDefaultStoreLocation.cityDetail')
                              ->where('user_type_id',$userTypeId)
                              ->where('complete_profile','yes')
                              ->where('status','active');
                              // ->orderBy('id','desc');

            if (isset($data['services']) && sizeof($data['services'])>0) {
                $designers = $designers->whereHas('userSelectedServicesDetail',function($q)use($data){ $q->whereIn('user_service_id',$data['services']); });
            }

            if (isset($data['project_fields']) && sizeof($data['project_fields'])>0) {
                $designers = $designers->whereHas('userSelectedProjectFieldsDetail',function($q)use($data){ $q->whereIn('user_project_field_id',$data['project_fields']); });
            }

            if (isset($data['entities']) && sizeof($data['entities'])>0) {
                $designers = $designers->whereIn('user_property_id',$data['entities']);
            }

            if (isset($data['city']) && !empty($data['city'])) {
                $designers = $designers->whereHas('userDefaultStoreLocation',function($q)use($data){ $q->where('city_id',$data['city']); });
            }

            if (isset($data['experience']) && !empty($data['experience'])) {
                $designers = $designers->where('experience',$data['experience']);
            }

            if (isset($data['sort_data']) && !empty($data['sort_data'])) {
                if ($data['sort_data']=='experience_low_to_high') {
                    $designers = $designers->orderBy('experience','asc');                                    
                }elseif ($data['sort_data']=='experience_high_to_low') {
                    $designers = $designers->orderBy('experience','desc');                                    
                }
            }else{
                $designers = $designers->orderBy('id','desc');                
            }
                              // ->paginate(5);
            // $designers = $designers->get()->toArray();
            $designers = $designers->paginate(5);
            // dd($designers->total());
            // echo "<pre>"; print_r($designers); die;
            $projectFields = UserProjectField::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userProperties = UserProperty::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userServices = UserService::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $projectCities = ProviderCity::where('status','active')->with(['cityDetail'=>function($q){ $q->select('id','name'); }])->get()->toArray();
            // dd($projectCities);
            if (Auth::check()) {
                $selectedCount = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->count();
                $selectedProviderIds = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->pluck('provider_id')->toArray();
            }else{
                $selectedCount = 0;
                $selectedProviderIds = [];
            }
            $page = 'designers';
            return view('frontend.login.user.designers.designerList',compact('page','designers','userTypeId','selectedCount','selectedProviderIds','projectFields','userProperties','userServices','projectCities','data'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function designerDetail($encDesignerId, Request $request) {
        try{
            $decDesignerId = base64_decode($encDesignerId);

            $designer = User::with('countryDetail','userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userProfessionImagesDetail','userDefaultStoreLocation.cityDetail')->where('id',$decDesignerId)->first();
            $designer = !empty($designer) ? $designer->toArray() : [];
            // dd($designer);
            $page = 'designers';
            return view('frontend.login.user.designers.designerDetail',compact('page','designer'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function contractorList(Request $request) {
        try{
            $data = $request->all();
            // dd($data);
            $userTypeId = UserType::where('alias','contractor')->value('id');
            
            // $contractors = User::with('userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userDefaultStoreLocation.cityDetail')
            //                     ->where('user_type_id',$userTypeId)
            //                     ->where('complete_profile','yes')
            //                     ->where('status','active')
            //                     ->orderBy('id','desc')
            //                     ->paginate(5);

            $contractors = User::with('userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userDefaultStoreLocation.cityDetail')
                              ->where('user_type_id',$userTypeId)
                              ->where('complete_profile','yes')
                              ->where('status','active');
                              // ->orderBy('id','desc');

            if (isset($data['services']) && sizeof($data['services'])>0) {
                $contractors = $contractors->whereHas('userSelectedServicesDetail',function($q)use($data){ $q->whereIn('user_service_id',$data['services']); });
            }

            if (isset($data['project_fields']) && sizeof($data['project_fields'])>0) {
                $contractors = $contractors->whereHas('userSelectedProjectFieldsDetail',function($q)use($data){ $q->whereIn('user_project_field_id',$data['project_fields']); });
            }

            if (isset($data['entities']) && sizeof($data['entities'])>0) {
                $contractors = $contractors->whereIn('user_property_id',$data['entities']);
            }

            if (isset($data['city']) && !empty($data['city'])) {
                $contractors = $contractors->whereHas('userDefaultStoreLocation',function($q)use($data){ $q->where('city_id',$data['city']); });
            }

            if (isset($data['experience']) && !empty($data['experience'])) {
                $contractors = $contractors->where('experience',$data['experience']);
            }

            if (isset($data['sort_data']) && !empty($data['sort_data'])) {
                if ($data['sort_data']=='experience_low_to_high') {
                    $contractors = $contractors->orderBy('experience','asc');                                    
                }elseif ($data['sort_data']=='experience_high_to_low') {
                    $contractors = $contractors->orderBy('experience','desc');                                    
                }
            }else{
                $contractors = $contractors->orderBy('id','desc');                
            }
                              // ->paginate(5);
            // $contractors = $contractors->get()->toArray();
            $contractors = $contractors->paginate(5);
            // dd($contractors->total());
            // echo "<pre>"; print_r($contractors); die;
            $projectFields = UserProjectField::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userProperties = UserProperty::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userServices = UserService::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $projectCities = ProviderCity::where('status','active')->with(['cityDetail'=>function($q){ $q->select('id','name'); }])->get()->toArray();
            // dd($projectCities);
            // $contractors = $contractors->get()->toArray();
            // dd($contractors);
            if (Auth::check()) {
                $selectedCount = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->count();
                $selectedProviderIds = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->pluck('provider_id')->toArray();
            }else{
                $selectedCount = 0;
                $selectedProviderIds = [];
            }
            $page = 'contractors';
            return view('frontend.login.user.contractors.contractorList',compact('page','contractors','userTypeId','selectedCount','selectedProviderIds','projectFields','userProperties','userServices','projectCities','data'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function contractorDetail($encContractorId, Request $request) {
        try{
            $decContractorId = base64_decode($encContractorId);

            $contractor = User::with('countryDetail','userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userProfessionImagesDetail','userDefaultStoreLocation.cityDetail')->where('id',$decContractorId)->first();
            $contractor = !empty($contractor) ? $contractor->toArray() : [];
            // dd($contractor);
            $page = 'contractors';
            return view('frontend.login.user.contractors.contractorDetail',compact('page','contractor'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function consultantList(Request $request) {
        try{
            $data = $request->all();
            // dd($data);
            $userTypeId = UserType::where('alias','consultant')->value('id');
            
            // $consultants = User::with('userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userDefaultStoreLocation.cityDetail')
            //                     ->where('user_type_id',$userTypeId)
            //                     ->where('complete_profile','yes')
            //                     ->where('status','active')
            //                     ->orderBy('id','desc')
            //                     ->paginate(5);
            //                     // ->get()
            //                     // ->toArray();
            // // $consultants = $consultants->toArray();
            // // dd($consultants);

            $consultants = User::with('userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userDefaultStoreLocation.cityDetail')
                              ->where('user_type_id',$userTypeId)
                              ->where('complete_profile','yes')
                              ->where('status','active');
                              // ->orderBy('id','desc');

            if (isset($data['services']) && sizeof($data['services'])>0) {
                $consultants = $consultants->whereHas('userSelectedServicesDetail',function($q)use($data){ $q->whereIn('user_service_id',$data['services']); });
            }

            if (isset($data['project_fields']) && sizeof($data['project_fields'])>0) {
                $consultants = $consultants->whereHas('userSelectedProjectFieldsDetail',function($q)use($data){ $q->whereIn('user_project_field_id',$data['project_fields']); });
            }

            if (isset($data['entities']) && sizeof($data['entities'])>0) {
                $consultants = $consultants->whereIn('user_property_id',$data['entities']);
            }

            if (isset($data['city']) && !empty($data['city'])) {
                $consultants = $consultants->whereHas('userDefaultStoreLocation',function($q)use($data){ $q->where('city_id',$data['city']); });
            }

            if (isset($data['experience']) && !empty($data['experience'])) {
                $consultants = $consultants->where('experience',$data['experience']);
            }

            if (isset($data['sort_data']) && !empty($data['sort_data'])) {
                if ($data['sort_data']=='experience_low_to_high') {
                    $consultants = $consultants->orderBy('experience','asc');                                    
                }elseif ($data['sort_data']=='experience_high_to_low') {
                    $consultants = $consultants->orderBy('experience','desc');                                    
                }
            }else{
                $consultants = $consultants->orderBy('id','desc');                
            }
                              // ->paginate(5);
            // $consultants = $consultants->get()->toArray();
            $consultants = $consultants->paginate(5);
            // dd($consultants->total());
            // echo "<pre>"; print_r($consultants); die;
            $projectFields = UserProjectField::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userProperties = UserProperty::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userServices = UserService::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $projectCities = ProviderCity::where('status','active')->with(['cityDetail'=>function($q){ $q->select('id','name'); }])->get()->toArray();
            // dd($projectCities);
            // $consultants = $consultants->get()->toArray();
            // dd($consultants);
            if (Auth::check()) {
                $selectedCount = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->count();
                $selectedProviderIds = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->pluck('provider_id')->toArray();
            }else{
                $selectedCount = 0;
                $selectedProviderIds = [];
            }
            $page = 'consultants';
            return view('frontend.login.user.consultants.consultantList',compact('page','consultants','userTypeId','selectedCount','selectedProviderIds','projectFields','userProperties','userServices','projectCities','data'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function consultantDetail($encConsultantId, Request $request) {
        try{
            $decConsultantId = base64_decode($encConsultantId);

            $consultant = User::with('countryDetail','userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userProfessionImagesDetail','userDefaultStoreLocation.cityDetail')->where('id',$decConsultantId)->first();
            $consultant = !empty($consultant) ? $consultant->toArray() : [];
            // dd($consultant);
            $page = 'consultants';
            return view('frontend.login.user.consultants.consultantDetail',compact('page','consultant'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    // public function sellerList(Request $request) {
    //     try{
    //         $page = 'sellers';
    //         return view('frontend.login.user.sellers.sellerList',compact('page'));
    //     }catch(Exception $e){
    //         \Log::error($e->getMessage());
    //         Session::flash('error',trans('messages.frontend.common_error'));
    //         return redirect()->back();
    //     }
    // }

    // public function sellerDetail(Request $request) {
    //     try{
    //         $page = 'sellers';
    //         return view('frontend.login.user.sellers.sellerDetail',compact('page'));
    //     }catch(Exception $e){
    //         \Log::error($e->getMessage());
    //         Session::flash('error',trans('messages.frontend.common_error'));
    //         return redirect()->back();
    //     }
    // }

    public function sellerList(Request $request) {
        try{
            $data = $request->all();
            
            $userTypeId = UserType::where('alias','seller')->value('id');
            // dd($userTypeId);
            $sellers = User::with('userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userDefaultStoreLocation.cityDetail')
                              ->where('user_type_id',$userTypeId)
                              ->where('complete_profile','yes')
                              ->where('status','active');
                              // ->orderBy('id','desc');

            if (isset($data['services']) && sizeof($data['services'])>0) {
                $sellers = $sellers->whereHas('userSelectedServicesDetail',function($q)use($data){ $q->whereIn('user_service_id',$data['services']); });
            }

            if (isset($data['project_fields']) && sizeof($data['project_fields'])>0) {
                $sellers = $sellers->whereHas('userSelectedProjectFieldsDetail',function($q)use($data){ $q->whereIn('user_project_field_id',$data['project_fields']); });
            }

            if (isset($data['entities']) && sizeof($data['entities'])>0) {
                $sellers = $sellers->whereIn('user_property_id',$data['entities']);
            }

            if (isset($data['city']) && !empty($data['city'])) {
                $sellers = $sellers->whereHas('userDefaultStoreLocation',function($q)use($data){ $q->where('city_id',$data['city']); });
            }

            if (isset($data['experience']) && !empty($data['experience'])) {
                $sellers = $sellers->where('experience',$data['experience']);
            }

            if (isset($data['sort_data']) && !empty($data['sort_data'])) {
                if ($data['sort_data']=='experience_low_to_high') {
                    $sellers = $sellers->orderBy('experience','asc');                                    
                }elseif ($data['sort_data']=='experience_high_to_low') {
                    $sellers = $sellers->orderBy('experience','desc');                                    
                }
            }else{
                $sellers = $sellers->orderBy('id','desc');                
            }
                              // ->paginate(5);
            // $sellers = $sellers->get()->toArray();
            $sellers = $sellers->paginate(5);
            // $projectFields = UserProjectField::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userProperties = UserProperty::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $userServices = UserService::where('user_type_id',$userTypeId)->where('status','active')->get()->toArray();
            $projectCities = ProviderCity::where('status','active')->with(['cityDetail'=>function($q){ $q->select('id','name'); }])->get()->toArray();
            // dd($projectCities);
            if (Auth::check()) {
                $selectedCount = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->count();
                $selectedProviderIds = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$userTypeId)->pluck('provider_id')->toArray();
            }else{
                $selectedCount = 0;
                $selectedProviderIds = [];
            }
            $page = 'sellers';
            return view('frontend.login.user.sellers.sellerList',compact('page','sellers','userTypeId','selectedCount','selectedProviderIds','projectFields','userProperties','userServices','projectCities','data'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function sellerDetail($encSellerId, Request $request) {
        try{
            $decSellerId = base64_decode($encSellerId);

            $seller = User::with('countryDetail','userTypeDetail','userPropertyDetail','userSelectedProjectFieldsDetail.userProjectFieldDetail','userSelectedServicesDetail.userServiceDetail','userProfessionImagesDetail','userDefaultStoreLocation.cityDetail','userMultipleCategories','userMultipleSubCategories','userMultipleSellingMaterial','UserbrandPhotos')->where('id',$decSellerId)->first();
            $seller = !empty($seller) ? $seller->toArray() : [];


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
             if(!empty($seller)){
                 $slcted_category_id = array_map(function($v){ return $v['category_id']; }, $seller['user_multiple_categories']);
             }

             $prdctCategory =  ProductCategory::whereIn('id',$slcted_category_id)->pluck('name')->toArray();

             $productCategoryImplode = implode(", ",$prdctCategory);

             

            $slcted_Subcategory_id = [];
             if(!empty($seller)){
                 $slcted_Subcategory_id = array_map(function($v){ return $v['sub_category_id']; }, $seller['user_multiple_sub_categories']);
             }

             $prdctSubCategory =  ProductSubCategory::whereIn('id',$slcted_Subcategory_id)->pluck('name')->toArray();

             $productSubCategoryImplode = implode(", ",$prdctSubCategory);    

            $slcted_material_id = [];
             if(!empty($seller)){
                 $slcted_material_id = array_map(function($v){ return $v['material_id']; }, $seller['user_multiple_selling_material']);
             }     

             $sellingMaterial =  productSellingMaterial::whereIn('id',$slcted_material_id)->pluck('selling_material_name')->toArray();

             $productmaterialImplode = implode(", ",$sellingMaterial);   
             // dd($productmaterialImplode);

             
              // $brandMultipleImages = UserBrandImage::where('user_id',Auth::user()->id)->get()->toArray();

            // dd($seller);
            $page = 'sellers';
            return view('frontend.login.user.sellers.sellerDetail',compact('page','seller','productCategories','productSubCategories','productSellingMaterial','productCategoryImplode','productSubCategoryImplode','productmaterialImplode','brandMultipleImages'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function inqueriesList(Request $request) {
          try{
              $userInqueries = UserInquery::where('seller_id',Auth::user()->id)->leftJoin('users','users.id','user_inqueries.user_id') ->select('user_inqueries.*','users.first_name as first_name','users.last_name as last_name');
              $start_date = '';
              $end_date = '';
              $sort = '';
              if(isset($_GET)){

                  $start_date = @$_GET['start_date'];
                  $end_date   = @$_GET['end_date'];
                  $sort   = @$_GET['sort'];

                  if($start_date != ''){
                        $userInqueries = $userInqueries->where(function($q) use($start_date){
                              $q->whereDate('user_inqueries.created_at','>=',date('Y-m-d',strtotime($start_date)));
                          
                      });      
                  }
                  if($end_date != ''){
                        $userInqueries = $userInqueries->where(function($q) use($end_date){
                              $q->whereDate('user_inqueries.created_at','<=',date('Y-m-d',strtotime($end_date)));
                          
                      });      
                  }
                  if($sort != ''){
                      // dd('here');
                        $userInqueries = $userInqueries->orderBy('users.first_name',$sort);                                    
                        
                  }         
                          
             

              }

              $userInqueries = $userInqueries->get()->toArray();

                          // dd($userInqueries);
              

              return view('frontend.login.provider.Inqueries.sellerdbInqueries',compact('userInqueries'));
          }catch(Exception $e){
              \Log::error($e->getMessage());
              Session::flash('error',trans('messages.frontend.common_error'));
              return redirect()->back();
          }
      }


      public function sendReply(Request $request)
      {
          $reply = $request->all();
          // $id =    ;
          // dd($reply['id']);
          $UserInquery = UserInquery::where('id',$reply['id'])->first();
          $User = User::where('id', $UserInquery['user_id'])->first();
          
          $user_name = User::where('id', $UserInquery['seller_id'])->first();

          /*send confirmation mail to user start*/
          // $data['subject'] ='Query Response';
          $email = $User['email'];
          // dd($email);
          
          UserInquery::where('id',$reply['id'])->update([
                                            'respond_status'=>'Completed',
                                            'response'=>$reply['reply']
                                         ]);

          $subject = PROJECT_NAME." Query Response";
          $links = [];
          $links['email'] = $email;

          $links['name'] = $User['first_name'].' '.$User['last_name'];
          $links['seller_name'] = $user_name['contact_name'].' '.$user_name['contact_last_name'];
          $links['question_to_user'] = $UserInquery['query'];
          $links['response_to_user'] = $reply['reply'];

        
               if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false){

                    Mail::send('frontend.emails.queryresponse',['response_to_user' => $links['response_to_user'],
                                                  'question_to_user'   => $links['question_to_user'],
                                                  'name'               => $links['name'],
                                                  'seller_name'        => $links['seller_name'],
                                                          ],function($message) use($email, $subject)
                        {
                            $message->to($email)->subject($subject);
                        });
                }

          Session::flash('success', 'Response sent to user successfully');
          return redirect()->back();
      }
}
