<?php

namespace App\Http\Controllers\frontend\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use Auth;
use Hash;
use DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use App\UserType;
use App\UserDeliveryAddress;
use App\RequestForProposal;
use App\RequestForProposalAssignToUser;
use App\UserSelectedService;
use App\UserService;
use App\RequestForProposalService;
use App\Country;
use DateTime;
use App\RequestForProposalUserCheckProvider;
use App\RequestForProposalRespondAttachment;
use App\ChatRoom;
use App\RequestForProposalStatus;
use App\RequestForProposalAssignToUserStatus;

class RequestForProposalController extends Controller
{
    //
    public function trackRFPRequest(Request $request) {

        try{
            $data = $request->all();   
                // dd($data['rfq_id']);
            if (isset($data['rfq_id']) && !empty($data['rfq_id'])) {
                $quotation = RequestForProposalAssignToUser::where('project_request_no',$data['rfq_id'])
                                                            ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','contact_last_name','user_property_id'); },'requestForProposalDetail'=>function($q){ $q->select('id','user_id','user_type_id','completed_step_no','project_name','project_no','project_address','project_city_id','project_country_id','proposal_submission_deadline_date','form_status','created_at'); },'userDetail.userSelectedServicesDetail.userServiceDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name'); },'requestForProposalDetail.userTypeDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.countryDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalDetail.ProjectCityDetail','userDetail.userPropertyDetail'])
                                                            ->orderBy('id','desc')
                                                            ->first();
                $quotation = !empty($quotation) ? $quotation->toArray() : [];

                $respondAttachments = RequestForProposalRespondAttachment::where('request_for_proposal_assign_to_user_id',$quotation['id'])
                                                                          ->with('userDetail.userPropertyDetail')
                                                                          ->get()
                                                                          ->toArray();  
                // dd($respondAttachments);
                if (empty($quotation)) {
                    Session::flash('error',trans('messages.frontend.request_for_proposal.request_not_found'));
                    return redirect()->back();
                }
            }else{
                $quotation = [];
            }           
            // dd($quotation);         
            $page = 'trackRFPRequest';
            return view('frontend.login.provider.quotations.trackRFPRequest',compact('page','quotation','respondAttachments'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function trackAllRFP(Request $request) {

        try{
            $data = $request->all();   
            $quotations = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                         ->where('user_id',Auth::user()->id)
                                                         ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no','location','experience','user_property_id'); },'requestForProposalDetail'=>function($q){ $q->select('*'); },'userDetail.userPropertyDetail','userDetail.userSelectedServicesDetail.userServiceDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','isd_code','mobile_no','email'); },'requestForProposalDetail.userTypeDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.countryDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalDetail.ProjectCityDetail'])
                                                         ->orderBy('id','desc')
                                                          // ->paginate(5);
                                                         ->get()
                                                         ->toArray();
            // dd($quotations);          
            $page = 'trackAllRFP';
            return view('frontend.login.provider.quotations.trackAllRfp',compact('page','quotations'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function trackAllRFPs(Request $request) {

        try{
            $data = $request->all();   
            $quotations = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                         ->where('user_id',Auth::user()->id)
                                                         ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no','location','experience','user_property_id'); },'requestForProposalDetail'=>function($q){ $q->select('*'); },'userDetail.userPropertyDetail','userDetail.userSelectedServicesDetail.userServiceDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','isd_code','mobile_no','email'); },'requestForProposalDetail.userTypeDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.countryDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalDetail.ProjectCityDetail',])
                                                         ->orderBy('id','desc')
                                                          // ->paginate(5);
                                                         ->get()
                                                         ->toArray();
            // dd($quotations);          
            $page = 'trackAllRFP';
            return view('frontend.login.provider.quotations.trackAllRfps',compact('page','quotations'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function trackAllRFPsIndex(Request $request) {

        $url = url('/');
        // dd('index');
        
        // $myRequests = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
        $myRequests = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('request_for_proposals.completed_step_no',9)->where('request_for_proposals.form_status','completed')->where('request_for_proposals.status','active'); })
                                                    ->where('request_for_proposal_assign_to_users.user_id',Auth::user()->id)
                                                    ->leftJoin('request_for_proposals','request_for_proposals.id','request_for_proposal_assign_to_users.request_for_proposal_id')
                                                    ->leftJoin('user_types','user_types.id','request_for_proposals.user_type_id')
                                                    ->leftJoin('users as request_users','request_users.id','request_for_proposals.user_id')
                                                    ->leftJoin('users as assign_users','assign_users.id','request_for_proposal_assign_to_users.user_id')
                                                    ->leftJoin('user_properties','user_properties.id','assign_users.user_property_id')
                                                    ->leftJoin('cities','cities.id','request_for_proposals.project_city_id')
                                                    ->leftJoin('countries','countries.id','request_for_proposals.project_country_id')
                                                    ->leftJoin('request_for_proposal_assign_to_user_statuses','request_for_proposal_assign_to_user_statuses.id','request_for_proposal_assign_to_users.request_for_proposal_assign_to_user_status_id')
                                                    ->leftJoin('request_for_proposal_statuses','request_for_proposal_statuses.id','request_for_proposals.request_for_proposal_status_id')
                                                    ->select('request_for_proposal_assign_to_users.*','request_for_proposals.completed_step_no as completed_step_no','request_for_proposals.request_for_proposal_status_id','request_for_proposals.form_status as form_status','request_for_proposals.request_title as request_title','request_for_proposals.created_at as invitation_date','request_for_proposals.proposal_submission_deadline_date as submission_date','request_for_proposals.proposal_submission_deadline_time as submission_time','user_types.name as user_type','request_for_proposal_assign_to_user_statuses.name as request_for_proposal_assign_to_user_status_name','request_for_proposal_statuses.name as request_for_proposal_status_name','request_users.first_name as user_first_name','request_users.last_name as user_last_name','request_users.isd_code as user_isd_code','request_users.mobile_no as user_mobile_no','request_users.email as user_email','assign_users.company_name as provider_company_name','assign_users.contact_name as provider_contact_name','assign_users.contact_last_name as provider_contact_last_name','assign_users.isd_code as provider_isd_code','assign_users.mobile_no as provider_mobile_no','assign_users.email as provider_email','user_properties.type as user_property_type','request_for_proposals.project_no','request_for_proposals.project_name','request_for_proposals.project_address','cities.name as project_city','countries.name as project_country')
                                                    ->orderBy('id','desc');
                                                    // ->get()
                                                    // ->toArray();
        // dd($myRequests);

        return DataTables::of($myRequests)
                            ->addIndexColumn()
                            ->addColumn('type_of_services', function ($myRequest) {
                                $services = RequestForProposalService::where('request_for_proposal_id',$myRequest->request_for_proposal_id)->with('userServiceDetail')->get()->toArray();
                                $service = '';
                                foreach ($services as $key => $value) {
                                    if ($key==0) {
                                        $sep = "";
                                    }else{
                                        $sep = ",";
                                    }
                                    $service = $service.$sep.$value['user_service_detail']['name'];
                                }
                                return $service;
                            })
                            ->addColumn('request_status', function ($myRequest) {
                                if ($myRequest->request_for_proposal_assign_to_user_status_id==1) {
                                    return '<span class="bg-primary">'.$myRequest->request_for_proposal_assign_to_user_status_name.'</span>';
                                }else if ($myRequest->request_for_proposal_assign_to_user_status_id==2) {
                                    return '<span class="bg-danger">'.$myRequest->request_for_proposal_assign_to_user_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_assign_to_user_status_id==3) {
                                    return '<span class="bg-dark">'.$myRequest->request_for_proposal_assign_to_user_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_assign_to_user_status_id==4) {
                                    return '<span class="bg-warning">'.$myRequest->request_for_proposal_assign_to_user_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_assign_to_user_status_id==5) {
                                    return '<span class="bg-success">'.$myRequest->request_for_proposal_assign_to_user_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_assign_to_user_status_id==6) {
                                    return '<span class="bg-success">'.$myRequest->request_for_proposal_assign_to_user_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_assign_to_user_status_id==7) {
                                    return '<span class="bg-success">'.$myRequest->request_for_proposal_assign_to_user_status_name.'</span>';
                                    
                                }
                            })
                            ->addColumn('request_proposal_status', function ($myRequest) {
                                // return RequestForProposalAssignToUser::where('request_for_proposal_id',$myRequest->id)->count();
                                if ($myRequest->request_for_proposal_status_id==1) {
                                    return '<span class="bg-primary">'.$myRequest->request_for_proposal_status_name.'</span>';
                                }else if ($myRequest->request_for_proposal_status_id==2) {
                                    return '<span class="bg-danger">'.$myRequest->request_for_proposal_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_status_id==3) {
                                    return '<span class="bg-dark">'.$myRequest->request_for_proposal_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_status_id==4) {
                                    return '<span class="bg-warning">'.$myRequest->request_for_proposal_status_name.'</span>';
                                    
                                }else if ($myRequest->request_for_proposal_status_id==5) {
                                    return '<span class="bg-success">'.$myRequest->request_for_proposal_status_name.'</span>';
                                    
                                }
                            })
                            ->addColumn('rfq_id', function ($myRequest) {
                                $trachRFQUrl = url('/provider/trackRFPRequest?rfq_id=').$myRequest->project_request_no;
                                return '<a style="color:#cc3f2f;" href='.$trachRFQUrl.'>'.$myRequest->project_request_no.'</a>';
                            })
                            ->addColumn('invitation_date', function ($myRequest) {
                                return date('d/m/Y', strtotime($myRequest->invitation_date));
                            })
                            ->addColumn('since_days', function ($myRequest) {
                                $datetime1 = new DateTime();
                                $datetime2 = new DateTime($myRequest->invitation_date);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');//now do whatever you like with $days

                                // if ($datetime2<$datetime1 || $days==0) {
                                //     $days = "--";  
                                //     // RequestForProposal::where('id',$myRequest->id)->update(['request_for_proposal_status_id'=>3]);  
                                // }
                                // dd($days);
                                return $days;
                            })
                            ->addColumn('submission_date', function ($myRequest) {
                                return date('d/m/Y', strtotime($myRequest->submission_date));
                            })
                            ->addColumn('remaining_days', function ($myRequest) {
                                $datetime1 = new DateTime();
                                $datetime2 = new DateTime($myRequest->submission_date.' '.$myRequest->submission_time);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');//now do whatever you like with $days

                                if ($datetime2<$datetime1 || $days==0) {
                                    $days = "--";   
                                }
                                return $days;
                            })
                            ->addColumn('user_contact_name', function ($myRequest) {
                                return ucfirst($myRequest->user_first_name).' '.ucfirst($myRequest->user_last_name);
                            })
                            ->addColumn('user_contact_number', function ($myRequest) {
                                return $myRequest->user_isd_code.' '.$myRequest->user_mobile_no;
                            })
                            ->addColumn('provider_contact_name', function ($myRequest) {
                                if ($myRequest->user_property_type=='individual') {
                                    return ucfirst($myRequest->provider_contact_name).' '.ucfirst($myRequest->provider_contact_last_name);
                                }else{
                                    return ucwords($myRequest->provider_company_name);
                                }
                            })
                            ->addColumn('provider_contact_number', function ($myRequest) {
                                return $myRequest->provider_isd_code.' '.$myRequest->provider_mobile_no;
                            })
                            ->addColumn('project_location', function ($myRequest) {
                                return $myRequest->project_address.', '.$myRequest->project_city.', '.$myRequest->project_country;
                            })
                            ->escapeColumns([])
                            ->make(true); 
    }

    public function quotations(Request $request) {

        try{

            $data = $request->all();
            // $quotations = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
            // 															  ->where('user_id',Auth::user()->id)
            //                                                               ->with(['userDetail'=>function($q){ $q->select('id','experience'); },'requestForProposalAssignToUserStatusDetail'=>function($q){ $q->select('id','name','class_name'); },'requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','supplier_code','profile_image'); },'requestForProposalDetail.countryDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.projectCityDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.requestForProposalStatusDetail'=>function($q){ $q->select('id','name','class_name'); },'requestForProposalDetail'=>function($q){ $q->select('id','user_id','request_title','client_representative_name','client_representative_isd_code','client_representative_mobile_no','client_representative_email','project_address','project_city_id','project_country_id','request_for_proposal_status_id','proposal_submission_deadline_date','proposal_submission_deadline_time'); },'requestForProposalDetail.requestForProposalServicesDetail.userServiceDetail'])
            //                                                               ->orderBy('id','desc')
            //                                                               ->paginate(5);
            //                                                               // ->get()
            //                                                               // ->toArray();

            $quotations = RequestForProposalAssignToUser::where('request_for_proposal_assign_to_users.user_id',Auth::user()->id)
                                                    ->where('request_for_proposals.completed_step_no',9)
                                                    ->where('request_for_proposals.form_status','completed')
                                                    ->where('request_for_proposals.status','active');

            if(isset($data['clients']) && sizeof($data['clients'])>0){
                $quotations->whereIn('request_for_proposals.user_id',$data['clients']);
            }
            if(isset($data['membership_ids']) && sizeof($data['membership_ids'])>0){
                $quotations->whereIn('request_for_proposals.user_id',$data['membership_ids']);
            }
            if(isset($data['user_statuses']) && sizeof($data['user_statuses'])>0){
                $quotations->whereIn('request_for_proposals.request_for_proposal_status_id',$data['user_statuses']);
            }
            if(isset($data['from_date']) && !empty($data['from_date'])){
                $quotations->whereDate('request_for_proposals.created_at','>=',date('Y-m-d', strtotime($data['from_date'])));
            }
            if(isset($data['to_date']) && !empty($data['to_date'])){
                $quotations->whereDate('request_for_proposals.created_at','>=',date('Y-m-d', strtotime($data['to_date'])));
            }
            if(isset($data['remaining_days']) && !empty($data['remaining_days'])){
                $date = date('Y-m-d');
                $quotations->whereDate('request_for_proposals.proposal_submission_deadline_date',date('Y-m-d', strtotime($date. ' + '.$data['remaining_days'].' days')));
            }

            if(isset($data['provider_statuses']) && sizeof($data['provider_statuses'])>0){
                $quotations->whereIn('request_for_proposal_assign_to_users.request_for_proposal_assign_to_user_status_id',$data['provider_statuses']);
            }
            if(isset($data['services']) && sizeof($data['services'])>0){
                $quotations->whereHas('requestForProposalDetail.requestForProposalServicesDetail',function($q)use($data){
                    $q->whereIn('user_service_id',$data['services']);
                });
            }

            $quotations =               $quotations ->leftJoin('request_for_proposals','request_for_proposal_assign_to_users.request_for_proposal_id','request_for_proposals.id')
                                                    ->leftJoin('users as request_assign_user','request_for_proposal_assign_to_users.user_id','request_assign_user.id')
                                                    ->leftJoin('request_for_proposal_assign_to_user_statuses','request_for_proposal_assign_to_users.request_for_proposal_assign_to_user_status_id','request_for_proposal_assign_to_user_statuses.id')
                                                    ->leftJoin('users as request_proposal_user','request_for_proposals.user_id','request_proposal_user.id')
                                                    ->leftJoin('countries as request_proposal_country','request_for_proposals.project_country_id','request_proposal_country.id')
                                                    ->leftJoin('cities as request_proposal_city','request_for_proposals.project_city_id','request_proposal_city.id')
                                                    ->leftJoin('request_for_proposal_statuses','request_for_proposals.request_for_proposal_status_id','request_for_proposal_statuses.id')
                                                    ->select('request_for_proposal_assign_to_users.*','request_for_proposals.completed_step_no as request_for_proposal_completed_step_no','request_for_proposals.form_status as request_for_proposal_form_status','request_for_proposals.status as request_for_proposal_status','request_for_proposals.user_id as request_for_proposal_user_id','request_assign_user.id as request_assign_user_id','request_assign_user.experience as request_assign_user_experience','request_for_proposal_assign_to_user_statuses.name as request_for_proposal_assign_to_user_status_name','request_for_proposal_assign_to_user_statuses.class_name as request_for_proposal_assign_to_user_status_class_name','request_proposal_user.id as request_proposal_user_id','request_proposal_user.first_name as request_proposal_user_first_name','request_proposal_user.last_name as request_proposal_user_last_name','request_proposal_user.supplier_code as request_proposal_user_supplier_code','request_proposal_user.profile_image as request_proposal_user_profile_image','request_proposal_country.id as request_proposal_country_id','request_proposal_country.name as request_proposal_country_name','request_proposal_city.id as request_proposal_city_id','request_proposal_city.name as request_proposal_city_name','request_for_proposal_statuses.name as request_for_proposal_status_name','request_for_proposal_statuses.class_name as request_for_proposal_status_class_name','request_for_proposals.request_title as request_for_proposal_request_title','request_for_proposals.client_representative_name as request_for_proposal_client_representative_name','request_for_proposals.client_representative_isd_code as request_for_proposal_client_representative_isd_code','request_for_proposals.client_representative_mobile_no as request_for_proposal_client_representative_mobile_no','request_for_proposals.client_representative_email as request_for_proposal_client_representative_email','request_for_proposals.project_address as request_for_proposal_project_address','request_for_proposals.request_for_proposal_status_id as request_for_proposal_status_id','request_for_proposals.proposal_submission_deadline_date as request_for_proposal_proposal_submission_deadline_date','request_for_proposals.proposal_submission_deadline_time as request_for_proposal_proposal_submission_deadline_time','request_for_proposals.created_at as request_for_proposal_created_at')
                                                    ->with(['requestForProposalDetail' => function($q){ $q->select('id'); },'requestForProposalDetail.requestForProposalServicesDetail.userServiceDetail']);

            if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='client_name_asc'){
                $quotations->orderBy('request_proposal_user_first_name','asc');
            }elseif(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='client_name_desc'){
                $quotations->orderBy('request_proposal_user_first_name','desc');
            }elseif(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_name_asc'){
                $quotations->orderBy('request_for_proposal_request_title','asc');
            }elseif(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_name_desc'){
                $quotations->orderBy('request_for_proposal_request_title','desc');
            }elseif(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_price_high_to_low'){
                $quotations->orderBy('request_for_proposal_assign_to_users.quotation_price','desc');
            }elseif(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_price_low_to_high'){
                $quotations->orderBy('request_for_proposal_assign_to_users.quotation_price','asc');
            }elseif(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='recent_submission_date'){
                $quotations->orderBy('request_for_proposal_created_at','desc');
            }else{
                $quotations->orderBy('request_for_proposal_assign_to_users.id','desc');
            }            
            
            $quotations = $quotations->paginate(5);
            // dd($quotations);          
            // echo "<pre>"; print_r($quotations); die; 

            $reqForProposalIds = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                                       ->where('user_id',Auth::user()->id)
                                                                       ->distinct('request_for_proposal_id')
                                                                       ->pluck('request_for_proposal_id')
                                                                       ->toArray();

            $userIds = RequestForProposal::whereIn('id',$reqForProposalIds)
                                          ->distinct('user_id')
                                          ->pluck('user_id')
                                          ->toArray();

            $users = User::whereIn('id',$userIds)
                          ->where(function ($query) {
                                $query->where('user_type_id', '=', 1)
                                      ->orWhere('user_type_id', '=', 2);
                            })
                          ->where('status','active')
                          ->orderBy('id','desc')
                          ->get()
                          ->toArray();

            $clientStatuses = RequestForProposalStatus::get()->toArray();
            $providerStatuses = RequestForProposalAssignToUserStatus::get()->toArray();

            $services = RequestForProposalService::whereIn('request_for_proposal_id',$reqForProposalIds)
                                                  ->with('userServiceDetail')
                                                  ->select('user_service_id')
                                                  ->distinct('user_service_id')
                                                  ->get()
                                                  ->toArray();
            // dd($quotations);          
            // echo "<pre>"; print_r($quotations); die;  
            $page = 'quotations';
            return view('frontend.login.provider.quotations.quotations',compact('page','quotations','users','clientStatuses','providerStatuses','services','data'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function reviewProposalRequestDetail($encReqId, Request $request) {

        try{
            $data = $request->all();
            $decReqId = base64_decode($encReqId);
            // dd($decReqForProposalId);
            $reqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)
                                                                          // ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalDetail.userTypeDetail','requestForProposalDetail.countryDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','email','isd_code','mobile_no'); },])
                                                                          ->with(['userDetail'=>function($q){ $q->select('id','user_type_id','supplier_code','user_property_id','company_name','contact_name','contact_last_name','location','email','isd_code','mobile_no'); },'userDetail.userPropertyDetail','requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalDetail.userTypeDetail','requestForProposalDetail.countryDetail','requestForProposalDetail.userDetail'])
                                                                          ->first()
                                                                          ->toArray();

            // $userName = ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name);
            $userName = ucfirst($reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['first_name']).' '.ucfirst($reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['last_name']);
            // dd($reqForProposalAssignToUser);
            $datetime1 = new DateTime();
            $datetime2 = new DateTime($reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_date'].' '.$reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_time']);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');//now do whatever you like with $days
            // dd($days);
            $page = 'reviewProposalRequest';
            return view('frontend.login.provider.quotations.reviewProposalRequestDetail',compact('page','reqForProposalAssignToUser','userName','encReqId','days'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function requestForProposalDelete($encReqId, Request $request) {

        try{
            $data = $request->all();
            $decReqId = base64_decode($encReqId);
            $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','user_id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','email'); },'requestForProposalDetail.userDetail'])->where('id',$decReqId)->first();
            $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];

            // dd($reqForProposalAssignToUser);  
            $mailData = [];
            $data['email'] = $reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['email'];
            $mailData['by_user'] = Auth::user()->contact_name;
            $mailData['to_user'] = $reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['first_name'].' '.$reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['last_name'];
            $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
            $mailData['subject'] = "Request For Proposal Removed";
            $mailData['request_status'] = "removed";
            // dd($data['email']);
            try{
                $this->sendMail('requestForProposalStatus', $data['email'], $mailData);               
            }catch(\Exception $e){
                
            }  
            
            $delReqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)->delete();   
            // $page = 'proposalHistory';
            Session::flash('success',trans('messages.frontend.request_for_proposal.remove'));
            return redirect()->back();
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function quotationAccept(Request $request) {

        try{
        	if ($request->isMethod('post')) {
	            $data = $request->all();
	            // dd($data);
	            $decReqId = base64_decode($data['enc_req_id']);        
                $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','user_id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','email'); },'requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','email'); }])->where('id',$decReqId)->first();
                $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];

                // dd($reqForProposalAssignToUser);  
                $mailData = [];
                $data['email'] = $reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['email'];
                $mailData['by_user'] = Auth::user()->contact_name;
                $mailData['to_user'] = $reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['first_name'].' '.$reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['last_name'];
                $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
                $mailData['subject'] = "Request For Proposal Accepted";
                $mailData['request_status'] = "accepted";
                // dd($data['email']);
                try{
                    $this->sendMail('requestForProposalStatus', $data['email'], $mailData);               
                }catch(\Exception $e){
                    
                } 

	            $acptReqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)->update([
                                                                                                                'quotation_price'=>$data['quotation_price'],
                                                                                                                'provider_status'=>'accepted',
                                                                                                                'request_for_proposal_assign_to_user_status_id'=>2
                                                                                                            ]);     
	            // $page = 'proposalHistory';
	            Session::flash('success',trans('messages.frontend.request_for_proposal.accept'));
	            return redirect()->back();        		
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

    public function requestForProposalReject($encReqId, Request $request) {

        try{
            $data = $request->all();
            $decReqId = base64_decode($encReqId);
            $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','user_id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','email'); },'requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','email'); }])->where('id',$decReqId)->first();
            $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];

            // dd($reqForProposalAssignToUser);  
            $mailData = [];
            $data['email'] = $reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['email'];
            $mailData['by_user'] = Auth::user()->contact_name;
            $mailData['to_user'] = $reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['first_name'].' '.$reqForProposalAssignToUser['request_for_proposal_detail']['user_detail']['last_name'];
            $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
            $mailData['subject'] = "Request For Proposal Rejected";
            $mailData['request_status'] = "rejected";
            // dd($data['email']);
            try{
                $this->sendMail('requestForProposalStatus', $data['email'], $mailData);               
            }catch(\Exception $e){
                
            }  

            $delReqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)->update([
                                                                                                            'provider_status'=>'rejected',
                                                                                                            'request_for_proposal_assign_to_user_status_id'=>3
                                                                                                        ]);   
            // $page = 'proposalHistory';
            Session::flash('success',trans('messages.frontend.request_for_proposal.refuse'));
            return redirect()->back();
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function quotationRespond(Request $request) {

        try{
            if ($request->isMethod('post')) {
                $data = $request->all();
                // dd($data);

                if(isset($data['attachment']) && !empty($data['attachment'])){
                    $image = $request->file('attachment');
                    $attachment  = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                    $destination_path = requestForProposalRespondAttachmentImageBasePath;
                    $image->move($destination_path,$attachment);
                } 

                $decReqId = RequestForProposalAssignToUser::where('id',base64_decode($data['enc_req_id']))->value('request_for_proposal_id');  

                RequestForProposalRespondAttachment::create([
                                                                'user_id'=>Auth::user()->id,
                                                                'request_for_proposal_id'=>$decReqId,
                                                                'request_for_proposal_assign_to_user_id'=>base64_decode($data['enc_req_id']),
                                                                'document_name'=>$data['document_type'],
                                                                'attachment'=>$attachment
                                                            ]);

                RequestForProposalAssignToUser::where('id',base64_decode($data['enc_req_id']))->update([
                                                                                                        'request_for_proposal_assign_to_user_status_id'=>4
                                                                                                    ]);
                // $page = 'proposalHistory';
                Session::flash('success',trans('messages.frontend.request_for_proposal.respond'));
                return redirect()->back();              
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

    public function deleteQuotationRespond($encRespId, Request $request) {

        $data = $request->all();

        $decRespId = base64_decode($encRespId);
        // dd($decRespId);
        $attachment = RequestForProposalRespondAttachment::where('id',$decRespId)->value('attachment');
        if($attachment != null && file_exists(public_path('frontend/imgs/requestForProposal/respondAttachment/'.$attachment)) ) {
            unlink(public_path('frontend/imgs/requestForProposal/respondAttachment/'.$attachment));
        }
        RequestForProposalRespondAttachment::where('id',$decRespId)->delete();
        return $response = array('status'=>'success');
    }

    public function requestDocumentCenter($encReqAssignId, Request $request) {

        try{       
            $data = $request->all();  

            $decReqAssignId = base64_decode($encReqAssignId);

            $requestForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqAssignId)->first();
            $requestForProposalAssignToUser = !empty($requestForProposalAssignToUser) ? $requestForProposalAssignToUser->toArray() : [];

            $respondAttachments = RequestForProposalRespondAttachment::where('request_for_proposal_assign_to_user_id',$decReqAssignId)
                                                                      ->with('userDetail.userPropertyDetail')
                                                                      ->get()
                                                                      ->toArray();  

            $otherUserId = RequestForProposal::where('id',$requestForProposalAssignToUser['request_for_proposal_id'])->value('user_id');
            // dd($requestForProposalAssignToUser);   
            $page = 'quotations';
            // if (sizeof($respondAttachments)>0) {
                return view('frontend.login.provider.quotations.requestDocumentCenter',compact('page','requestForProposalAssignToUser','respondAttachments','encReqAssignId','otherUserId'));
            // }else{
            //     Session::flash('error',trans('messages.frontend.request_for_proposal.respond_not_found'));
            //     return redirect()->back();
            // }       
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function requestChatDocumentCenter($encOtherUserId, Request $request) {

        try{       
            $data = $request->all();  

            $decOtherUserId = base64_decode($encOtherUserId);
            // dd('here'); 
            $receiverId = $decOtherUserId;
            // $chatRoom = ChatRoom::with(['senderDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','company_name','contact_name','contact_last_name','user_property_id'); },'receiverDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','company_name','contact_name','contact_last_name','user_property_id'); },'senderDetail.userPropertyDetail','receiverDetail.userPropertyDetail'])
            //                     ->where([
            //                         'sender_id' => Auth::guard('web')->user()['id'],
            //                         'receiver_id' => (int)$receiverId,
            //                         'type' => 'user'
            //                     ])
            //                     ->orWhere(function($q) use ($receiverId){
            //                         $q->where([
            //                             'sender_id' => (int)$receiverId,
            //                             'receiver_id' => Auth::guard('web')->user()['id'],
            //                             'type' => 'user',
            //                         ]);
            //                     })
            //                     ->first();

            $chatRoom = ChatRoom::with(['senderDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','company_name','contact_name','contact_last_name','user_property_id'); },'receiverDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','company_name','contact_name','contact_last_name','user_property_id'); },'senderDetail.userPropertyDetail','receiverDetail.userPropertyDetail'])
                                ->where([
                                    'sender_id' => Auth::guard('web')->user()['id'],
                                    'receiver_id' => (int)$receiverId,
                                    'type' => 'user'
                                ])
                                ->orWhere(function($q) use ($receiverId){
                                    $q->where([
                                        'sender_id' => (int)$receiverId,
                                        'receiver_id' => Auth::guard('web')->user()['id'],
                                        'type' => 'user',
                                    ]);
                                })
                                ->first();
            $chatRoom = !empty($chatRoom) ? $chatRoom->toArray() : [];
            // dd($chatRoom);
            if ($chatRoom['sender_detail']['user_type_id']==1 || $chatRoom['sender_detail']['user_type_id']==2) {
                $senderName = ucfirst($chatRoom['sender_detail']['first_name']).' '.ucfirst($chatRoom['sender_detail']['last_name']);
            }elseif ($chatRoom['sender_detail']['user_property_detail']!=null && $chatRoom['sender_detail']['user_property_detail']['type']=='company') {
                $senderName = ucfirst($chatRoom['sender_detail']['company_name']);
            }else{
                $senderName = ucfirst($chatRoom['sender_detail']['contact_name']).' '.ucfirst($chatRoom['sender_detail']['contact_last_name']);
            }

            if ($chatRoom['receiver_detail']['user_type_id']==1 || $chatRoom['receiver_detail']['user_type_id']==2) {
                $receiverName = ucfirst($chatRoom['receiver_detail']['first_name']).' '.ucfirst($chatRoom['receiver_detail']['last_name']);
            }elseif ($chatRoom['receiver_detail']['user_property_detail']!=null && $chatRoom['receiver_detail']['user_property_detail']['type']=='company') {
                $receiverName = ucfirst($chatRoom['receiver_detail']['company_name']);
            }else{
                $receiverName = ucfirst($chatRoom['receiver_detail']['contact_name']).' '.ucfirst($chatRoom['receiver_detail']['contact_last_name']);
            }
            // dd($receiverName);
            $senderId = Auth::user()->id;
            $page = 'quotations';
            if (sizeof($chatRoom)>0) {
                return view('frontend.login.provider.quotations.requestChatDocumentCenter',compact('page','decOtherUserId','senderId','chatRoom','senderName','receiverName'));    
            }else{
                Session::flash('error',trans('messages.frontend.chat_document_center.not_found'));
                return redirect()->back();
            }
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }


}
