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
use App\Admin,App\UserDeliveryAddress,App\UserStoreLocation;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
   public function userdataList(Request $request)
    {
       $subscriptionList = User::leftjoin('user_types','users.user_type_id','user_types.id')
       ->select('users.*','user_types.name as user_type_name')->with('userTypeDetail')->where('complete_profile','yes')->where('user_type_id',1)->get();
       // dd($subscriptionList);
    
      $page =  'individual';
      return view('admin.userManagenment.userList',compact('page'));
    }

   public function userListIndex(Request $request) 
   {
       $subscriptionList = User::leftjoin('user_types','users.user_type_id','user_types.id')
       ->select('users.*','user_types.name as user_type_name')->with('userTypeDetail')->where('complete_profile','yes')->where('user_type_id',1)->get();
       // $url = url('/');
       return DataTables::of($subscriptionList)
              ->addIndexColumn()

              ->addColumn('status', function ($subscriptionList) {
                  return '<div class="status_button_toggle" ral="' . $subscriptionList->id . '" rel="' . $subscriptionList->status . '" id="status_button_' . $subscriptionList->id . '"></div>';
              })
               ->addColumn('action', function ($subscriptionList) {
                  return 
                '<a href="' . url("admin/userManagement/detail/".base64_encode($subscriptionList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                <a href="' . url("admin/user/userDeliveryAddressIndividual/".base64_encode($subscriptionList->id)) . '" class="edit-btn"> <i class="fa fa-building" title="userStoreLocation"></i></a>';

                })
              ->escapeColumns([])
              ->make(true);                                
   }   

    public function detail(Request $request,$id)
    {
      $id   = base64_decode($id);
      $userdata = User::where('id',$id)->with('userTypeDetail')->first();
      // dd($userdata);
        $page =  'individual';
      return view('admin.userManagenment.userDetail',compact('page','userdata'));
    }

    public function changeUserIndividualStatus(Request $request){

        if($request->status && $request->id){
            $statusChanged = User::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

    public function userDeliveryAdressIndividual(Request $request,$id)
    {
      $id   = base64_decode($id);
      // dd($id);
      $userDeliveryLocation = UserDeliveryAddress::where('user_id',$id)->with('countryDetail')->get()->toArray();
      $page =  'individual';
      return view('admin.userManagenment.userIndividualStorelocation',compact('page','userDeliveryLocation'));
    }

   
    public function userInstitutionList(Request $request)
    {
       $subscriptionList = User::leftjoin('user_types','users.user_type_id','user_types.id')
       ->select('users.*','user_types.name as user_type_name')->with('userTypeDetail')->where('complete_profile','yes')->where('user_type_id',2)->get();
       // dd($subscriptionList);
    
      $page =  'institution';
      return view('admin.userManagenment.institution.userInstitutionList',compact('page'));
    }

   public function userInstitutionListIndex(Request $request) 
   {
       $subscriptionList = User::leftjoin('user_types','users.user_type_id','user_types.id')
       ->select('users.*','user_types.name as user_type_name')->with('userTypeDetail')->where('complete_profile','yes')->where('user_type_id',2)->get();
       // $url = url('/');
       return DataTables::of($subscriptionList)
              ->addIndexColumn()

              ->addColumn('status', function ($subscriptionList) {
                  return '<div class="status_button_toggle" ral="' . $subscriptionList->id . '" rel="' . $subscriptionList->transaction_status . '" id="status_button_' . $subscriptionList->id . '"></div>';
              })
               ->addColumn('action', function ($subscriptionList) {
                  return 
                  '<a href="' . url("admin/userManagement/Institutiondetail/".base64_encode($subscriptionList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>

                  <a href="' . url("admin/user/userDeliveryAddress/".base64_encode($subscriptionList->id)) . '" class="edit-btn"> <i class="fa fa-building" title="userStoreLocation"></i></a>';
                })
              ->escapeColumns([])
              ->make(true);                                
   }  

   public function userInstitutiondetail(Request $request,$id)
    {
      $id   = base64_decode($id);
      $userdata = User::where('id',$id)->with('userTypeDetail')->first();
      // dd($userdata);
        $page =  'institution';
      return view('admin.userManagenment.institution.userInstitutionDetail',compact('page','userdata'));
    }

  public function changeUserInstitutionStatus(Request $request){

        if($request->status && $request->id){
            $statusChanged = User::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

   public function userDeliveryAdressInstitution(Request $request,$id)
    {
      $id   = base64_decode($id);   
      $userDeliveryLocation = UserDeliveryAddress::where('user_id',$id)->with('countryDetail')->get()->toArray();
      // dd($userDeliveryLocation);
      $page =  'institution';
      return view('admin.userManagenment.institution.userStorelocation',compact('page','userDeliveryLocation'));
    }  

   public function userDesignerList(Request $request)
    {
      $page =  'designer';
      return view('admin.userManagenment.designer.DesignerList',compact('page'));
    }

   public function userDesignerListIndex(Request $request) 
   {
       $designerList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                           ->select('users.*','user_types.name as user_type_name')
                           ->where('user_type_id',3)
                           ->where('complete_profile','yes')
                           ->get();
                            

       return DataTables::of($designerList)
              ->addIndexColumn()
              ->addColumn('status', function ($designerList) {
                  return '<div class="status_button_toggle" ral="' . $designerList->id . '" rel="' . $designerList->status . '" id="status_button_' . $designerList->id . '"></div>';
              })
              ->addColumn('transaction_status', function ($designerList) {
                  return '<div class="transaction_button_toggle" ral="' . $designerList->id . '" rel="' . $designerList->transaction_status . '" id="status_button_trans_' . $designerList->id . '"></div>';
              })
              ->addColumn('certified_provider', function ($designerList) {
                  return '<div class="certified_provider_button_toggle" ral="' . $designerList->id . '" rel="' . $designerList->certified_provider . '" id="status_button_certi_' . $designerList->id . '"></div>';
              })
               ->addColumn('action', function ($designerList) {
                  return 
                  '<a href="' . url("admin/designer/detail/".base64_encode($designerList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                   <a href="' . url("admin/provider/storeLocation/".base64_encode($designerList->id)) . '" class="User"> <i class="fa fa-user" title="Designer Store Location"></i></a>';
                })
              ->escapeColumns([])
              ->make(true);                                          
   } 

   public function Designerdetail(Request $request,$id)
   {
      $id   = base64_decode($id);
      $userdata = User::where('id',$id)->with('userTypeDetail')->first();
      $invoice = UserSubscriptionPayment::where('user_id',$id)->first();
      // dd($invoice);
      $page =  'designer';
      return view('admin.userManagenment.designer.designerDetail',compact('page','userdata','invoice'));
   }

   public function changeDesigner_Status(Request $request){

        if($request->status && $request->id){
            $statusChanged = User::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Transaction Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
   }

  public function changeDesignerTransactionStatus(Request $request)
  {
    $data = $request->all();
        // dd($data);
      if($request->transaction_status && $request->id){
          $statusChanged = User::where(['id' => $request->id])->update(['transaction_status' => $request->transaction_status]);
          return ['transaction_status' => 'success', 'message' => 'Status changed successfully'];
      }else{
            // dd('notchANGED');
          return ['transaction_status' => 'error', 'message' => 'Some required details is missing'];
      }
  } 
  public function changeCertifiedProviderTransactionStatus(Request $request)
  {
    $data = $request->all();
        // dd($data);
      if($request->certified_provider && $request->id){
          $statusChanged = User::where(['id' => $request->id])->update(['certified_provider' => $request->certified_provider]);
          return ['certified_provider' => 'success', 'message' => 'Status changed successfully'];
      }else{
            // dd('notchANGED');
          return ['certified_provider' => 'error', 'message' => 'Some required details is missing'];
      }
  } 
  

   public function providerDesignerStoreLocation(Request $request,$id)
    {
      $id   = base64_decode($id);   
      // dd($userDeliveryLocation);
      $userLocation = UserStoreLocation::where('user_id',$id)->with('countryDetail','stateDetail')->get()->toArray();
      $page = 'designer';
      return view('admin.userManagenment.designer.designerStoreaddress',compact('page','userLocation'));
    }  


   public function userContractorList(Request $request)
   {
    // dd('here');
      $page =  'contractor';
      return view('admin.userManagenment.contractor.contractorList',compact('page'));
  }

  public function userContractorListIndex(Request $request) 
  {
       $contractorList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                             ->select('users.*','user_types.name as user_type_name')
                             ->where('user_type_id',4)
                             ->where('complete_profile','yes')
                             ->get();
                             

       return DataTables::of($contractorList)
              ->addIndexColumn()
              ->addColumn('status', function ($contractorList) {
                  return '<div class="status_button_toggle" ral="' . $contractorList->id . '" rel="' . $contractorList->status . '" id="status_button_' . $contractorList->id . '"></div>';
              })
              ->addColumn('transaction_status', function ($contractorList) {
                  return '<div class="transaction_button_toggle" ral="' . $contractorList->id . '" rel="' . $contractorList->transaction_status . '" id="status_button_trans_' . $contractorList->id . '"></div>';
              })
               ->addColumn('certified_provider', function ($designerList) {
                  return '<div class="certified_provider_button_toggle" ral="' . $designerList->id . '" rel="' . $designerList->certified_provider . '" id="status_button_certi_' . $designerList->id . '"></div>';
              })

               ->addColumn('action', function ($contractorList) {
                  return 
                  '<a href="' . url("admin/provider/contractor/detail/".base64_encode($contractorList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                  <a href="' . url("admin/provider/contractor/storeLocation/".base64_encode($contractorList->id)) . '" class="User"> <i class="fa fa-user" title="Designer Store Location"></i></a>';
                })
              ->escapeColumns([])
              ->make(true);                                          
   } 


   public function contractorDetail(Request $request,$id)
    {
      $id   = base64_decode($id);
      $userdata = User::where('id',$id)->with('userTypeDetail')->first();
      $invoice  = UserSubscriptionPayment::where('user_id',$id)->first();
      // dd($invoice);
      $page =  'contractor';
      return view('admin.userManagenment.contractor.contractorDetail',compact('page','userdata','invoice'));
    }

  public function changeContractorStatus(Request $request){

        if($request->status && $request->id){
            $statusChanged = User::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
  }

 public function changeContractorTransactionStatus(Request $request)
  {
    $data = $request->all();
        // dd($data);
      if($request->transaction_status && $request->id){
          $statusChanged = User::where(['id' => $request->id])->update(['transaction_status' => $request->transaction_status]);
          return ['transaction_status' => 'success', 'message' => 'Status changed successfully'];
      }else{
            // dd('notchANGED');
          return ['transaction_status' => 'error', 'message' => 'Some required details is missing'];
      }
  }


   public function providerContractorStoreLocation(Request $request,$id)
    {
      $id   = base64_decode($id);   
      // dd($userDeliveryLocation);
      $userLocation = UserStoreLocation::where('user_id',$id)->with('countryDetail','stateDetail')->get()->toArray();
      $page = 'contractor';
      return view('admin.userManagenment.contractor.contractorStoreaddress',compact('page','userLocation'));
    }  
    

    public function providerConsultantList(Request $request)
     {
      $page =  'consultant';
      return view('admin.userManagenment.consultant.consultantList',compact('page'));
    }

   public function providerConsultantListIndex(Request $request) 
  {
       $consultantList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                           ->select('users.*','user_types.name as user_type_name')
                           ->where('user_type_id',5)
                           ->where('complete_profile','yes')
                           ->get();
                            

       return DataTables::of($consultantList)
              ->addIndexColumn()
              ->addColumn('status', function ($consultantList) {
                  return '<div class="status_button_toggle" ral="' . $consultantList->id . '" rel="' . $consultantList->status . '" id="status_button_' . $consultantList->id . '"></div>';
              })
               ->addColumn('transaction_status', function ($consultantList) {
                  return '<div class="transaction_button_toggle" ral="' . $consultantList->id . '" rel="' . $consultantList->transaction_status . '" id="status_button_trans_' . $consultantList->id . '"></div>';
              })
               ->addColumn('certified_provider', function ($designerList) {
                  return '<div class="certified_provider_button_toggle" ral="' . $designerList->id . '" rel="' . $designerList->certified_provider . '" id="status_button_certi_' . $designerList->id . '"></div>';
              }) 

               ->addColumn('action', function ($consultantList) {
                  return 
                  '<a href="' . url("admin/provider/consultant/detail/".base64_encode($consultantList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                  <a href="' . url("admin/provider/consultant/storeLocation/".base64_encode($consultantList->id)) . '" class="User"> <i class="fa fa-user" title="Designer Store Location"></i></a>';
                })
              ->escapeColumns([])
              ->make(true);                                          
   } 

   public function consultantdetail(Request $request,$id)
    {
      $id   = base64_decode($id);
      $userdata = User::where('id',$id)->with('userTypeDetail')->first();
      $invoice  = UserSubscriptionPayment::where('user_id',$id)->first();
      // dd($invoice);
      $page =  'consultant';
      return view('admin.userManagenment.consultant.consultantDetail',compact('page','userdata','invoice'));
    }

   public function changeConsultantStatus(Request $request)
 {
        if($request->status && $request->id){
            $statusChanged = User::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
 }

 public function changeConsultantTransactionStatus(Request $request)
  {
    $data = $request->all();
        // dd($data); 
      if($request->transaction_status && $request->id){
          $statusChanged = User::where(['id' => $request->id])->update(['transaction_status' => $request->transaction_status]);
          return ['transaction_status' => 'success', 'message' => 'Status changed successfully'];
      }else{
            // dd('notchANGED');
          return ['transaction_status' => 'error', 'message' => 'Some required details is missing'];
      }
  }

   public function providerConsultantStoreLocation(Request $request,$id)
   {
      $id   = base64_decode($id);   
      // dd($userDeliveryLocation);
      $userLocation = UserStoreLocation::where('user_id',$id)->with('countryDetail','stateDetail')->get()->toArray();
      $page = 'consultant';
      return view('admin.userManagenment.consultant.consultantStoreaddress',compact('page','userLocation'));
   }


   public function providerSellerList(Request $request)
   {
      $page =  'seller';
      return view('admin.userManagenment.seller.sellerList',compact('page'));
   }

   public function providerSellerListIndex(Request $request) 
  {
       $sellerList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                           ->select('users.*','user_types.name as user_type_name')
                           ->where('user_type_id',6)                           
                           ->where('complete_profile','yes')
                           ->get();

       return DataTables::of($sellerList)
              ->addIndexColumn()
              ->addColumn('status', function ($sellerList) {
                  return '<div class="status_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->status . '" id="status_button_' . $sellerList->id . '"></div>';
              })

              ->addColumn('transaction_status', function ($sellerList) {
                  return '<div class="transaction_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->transaction_status . '" id="status_button_trans_' . $sellerList->id . '"></div>';
              })

              ->addColumn('action', function ($sellerList) {
                  return 
                  '<a href="' . url("admin/provider/seller/detail/".base64_encode($sellerList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                  <a href="' . url("admin/provider/seller/storeLocation/".base64_encode($sellerList->id)) . '" class="User"> <i class="fa fa-user" title="Designer Store Location"></i></a>';
                })
              ->escapeColumns([])
              ->make(true);                                          
   } 

   public function sellerdetail(Request $request,$id)
    {
      $id   = base64_decode($id);
      $userdata = User::where('id',$id)->with('userTypeDetail')->first();
      $invoice  = UserSubscriptionPayment::where('user_id',$id)->first();
      // dd($invoice);
      $page =  'seller';
      return view('admin.userManagenment.seller.sellerDetail',compact('page','userdata','invoice'));
    }

public function changeSellerStatus(Request $request)
 {
        if($request->status && $request->id){
            $statusChanged = User::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
 }

 public function changesellerTransactionStatus(Request $request)
  {
    $data = $request->all();
        // dd($data); 
      if($request->transaction_status && $request->id){
          $statusChanged = User::where(['id' => $request->id])->update(['transaction_status' => $request->transaction_status]);
          return ['transaction_status' => 'success', 'message' => 'Status changed successfully'];
      }else{
            // dd('notchANGED');
          return ['transaction_status' => 'error', 'message' => 'Some required details is missing'];
      }
  }
 public function providerSellerStoreLocation(Request $request,$id)
  {
      $id   = base64_decode($id);   
      // dd($userDeliveryLocation);
      $userLocation = UserStoreLocation::where('user_id',$id)->with('countryDetail','stateDetail')->get()->toArray();
      $page = 'seller';
      return view('admin.userManagenment.seller.sellerStoreaddress',compact('page','userLocation'));
  }
 public function allUserList(Request $request)
   {

      $sellerList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                        ->select('users.*','user_types.name as user_type_name')
                        // ->where('user_type_id',6)                           
                        ->where('complete_profile','yes')
                        ->get();
       // echo'<pre>';print_r($sellerList);die;                 
      // dd($sellerList);=
      $page =  'allUser';
      return view('admin.userManagenment.allUser.allUser',compact('page'));
   }


 public function allUserListIndex(Request $request) 
  {
       $sellerList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                        ->select('users.*','user_types.name as user_type_name')
                        // ->where('user_type_id',6)                           
                        ->where('complete_profile','yes')
                        ->get();

       return DataTables::of($sellerList)
              ->addIndexColumn()

               ->editColumn('city',function($sellerList) {
                  if($sellerList->city!=null){      
                      $city =  $sellerList->city;
                  }else{
                      $city= '-';
                  }
                  return $city;
              })  

              ->editColumn('supplier_code',function($sellerList) {
                   if($sellerList->supplier_code!=null){      
                       $supplier_code =  $sellerList->supplier_code;
                   }else{
                       $supplier_code= '-';
                   }
                   return $supplier_code;
               }) 

              ->editColumn('company_name',function($sellerList) {
                   if($sellerList->company_name!=null){      
                       $company_name =  $sellerList->company_name;
                   }else{
                       $company_name= '-';
                   }
                   return $company_name;
               }) 

              ->addColumn('status', function ($sellerList) {
                  return '<div class="status_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->status . '" id="status_button_' . $sellerList->id . '"></div>';
              })

              ->addColumn('transaction_status', function ($sellerList) {
                  return '<div class="transaction_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->transaction_status . '" id="status_button_trans_' . $sellerList->id . '"></div>';
              })

              ->addColumn('certified_provider', function ($sellerList) {
                  return '<div class="certified_provider_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->certified_provider . '" id="status_button_certi_' . $sellerList->id . '"></div>';
              }) 

              ->addColumn('action', function ($sellerList) {
                  return 
                  '<a href="' . url("admin/all/user/detail/".base64_encode($sellerList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                  <a href="' . url("admin/all/user/storeLocation/".base64_encode($sellerList->id)) . '" class="User"> <i class="fa fa-user" title="Designer Store Location"></i></a>';
                })
              ->escapeColumns([])
              ->make(true);                                          
   } 

 public function allUserdetail(Request $request,$id)
  {
     $id   = base64_decode($id);
     // dd($id);
     $userdata = User::where('id',$id)->with('userTypeDetail')->first();
     $invoice  = UserSubscriptionPayment::where('user_id',$id)->first();
     // dd($invoice);
     $page =  'allUser';
     return view('admin.userManagenment.allUser.allUserDetail',compact('page','userdata','invoice','id'));
  }

 public function changeSellerStatus1(Request $request)
  {
     if($request->status && $request->id){
         $statusChanged = User::where(['id' => $request->id])->update(['status' => $request->status]);
         return ['status' => 'success', 'message' => 'Status changed successfully'];
     }else{
         return ['status' => 'error', 'message' => 'Some required details is missing'];
     }
  }

  public function changesellerTransactionStatus1(Request $request)
   {
     $data = $request->all();
         // dd($data); 
       if($request->transaction_status && $request->id){
           $statusChanged = User::where(['id' => $request->id])->update(['transaction_status' => $request->transaction_status]);
           return ['transaction_status' => 'success', 'message' => 'Status changed successfully'];
       }else{
             // dd('notchANGED');
           return ['transaction_status' => 'error', 'message' => 'Some required details is missing'];
       }
   }
 
 public function allUserStoreLocation(Request $request,$id)
   {
     $id   = base64_decode($id);   
     // dd($userDeliveryLocation);
     $userLocation = UserStoreLocation::where('user_id',$id)->with('countryDetail','stateDetail')->get()->toArray();
     $page = 'allUser';
     return view('admin.userManagenment.allUser.allUserStoreaddress',compact('page','userLocation'));
  } 
 
}
