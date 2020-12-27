<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use Auth;
use Hash;
use File;
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
use App\RequestForProposalAttachFile;
use App\Notification;
use App\RequestForProposalRespondAttachment;

class RequestForProposalController extends Controller
{
    //
    public function requestForProposal(Request $request) {

        try{
            if ($request->isMethod('post')) {
                $data = $request->all();
                // dd($data);
                $reqForProposalServiceIds = [];
                $clientAddress = UserDeliveryAddress::with(['countryDetail'=>function($q){ $q->select('id','name'); }])->where('user_id',Auth::user()->id)->where('use_address_as_default','yes')->first();
                $clientAddress = !empty($clientAddress) ? $clientAddress->toArray() : [];
                if (empty($clientAddress)) {
                    Session::flash('error',trans('messages.frontend.add_default_address'));
                    return redirect('/user/locations');
                }

                if (isset($data['request_for_proposal_id']) && !empty($data['request_for_proposal_id'])) {
                    $decReqForProposalId = base64_decode($data['request_for_proposal_id']);
                    $createRquestForProposalId = $decReqForProposalId;

                    $reqForProposal =  RequestForProposal::where('id',$decReqForProposalId)->first();
                    $reqForProposal = !empty($reqForProposal) ? $reqForProposal->toArray() : [];

                    $reqForProposalServiceIds = RequestForProposalService::where('request_for_proposal_id',$decReqForProposalId)->pluck('user_service_id')->toArray();

                    $userTypeId = $reqForProposal['user_type_id'];

                    $userType = UserType::where('id',$userTypeId)->first();
                    $userType = !empty($userType) ? $userType->toArray() : [] ;
                    // dd($userTypeId); 
                    $providerIds = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)->pluck('user_id')->toArray();

                    $providers = User::whereIn('id',$providerIds)->select('id','user_type_id','contact_name')->get()->toArray();
                    $providerSelectedServiceIds = UserSelectedService::whereIn('user_id',$providerIds)->distinct('user_service_id')->pluck('user_service_id')->toArray();

                    $providerServices = UserService::where('user_type_id',$userTypeId)->whereIn('id',$providerSelectedServiceIds)->get()->toArray();
                    // dd($providerIds);
                    if (empty($providerServices)) {
                        Session::flash('error',trans('messages.frontend.request_for_proposal.services_not_available'));
                        return redirect()->back();
                    }
                }else{
                    $userTypeId = base64_decode($data['user_type_id']);
                    if (isset($data['provider_id']) && !empty($data['provider_id'])) {
                        RequestForProposalUserCheckProvider::create([
                                                             'user_id'=>Auth::user()->id,
                                                             'provider_id'=>base64_decode($data['provider_id']),
                                                             'user_type_id'=>$userTypeId
                                                            ]);
                    }
                    // $providerIds = explode(",", $data['provider_ids']);

                    $providerIds = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->pluck('provider_id')->toArray();

                    // dd(sizeof($providerIds));

                    $providers = User::whereIn('id',$providerIds)->select('id','user_type_id','contact_name')->get()->toArray();
                    $providerSelectedServiceIds = UserSelectedService::whereIn('user_id',$providerIds)->distinct('user_service_id')->pluck('user_service_id')->toArray();

                    $providerServices = UserService::where('user_type_id',$userTypeId)->whereIn('id',$providerSelectedServiceIds)->get()->toArray();
                    // dd($providerServices);
                    if (empty($providerServices)) {
                        Session::flash('error',trans('messages.frontend.request_for_proposal.services_not_available'));
                        return redirect()->back();
                    }

                    $userType = UserType::where('id',$userTypeId)->first();
                    $userType = !empty($userType) ? $userType->toArray() : [] ;
                    
                    // dd($userType['alias']);
                    if ($userType['alias']=='designer') {
                        $prvdr = 'DS';
                    }else if ($userType['alias']=='contractor') {
                        $prvdr = 'CT';                  
                    }else if ($userType['alias']=='consultant') {
                        $prvdr = 'CS';                  
                    }else if ($userType['alias']=='seller') {
                        $prvdr = 'SE';                  
                    }

                    $reqForProposalCount = RequestForProposal::where('save_for_later','yes')->orWhere('form_status','completed')->count();
                    // dd($reqForProposalCount);
                    // $no = sprintf("%06d", $reqForProposalCount);
                    $requestNo = 'BM-'.$prvdr.'-'.sprintf("%05d", $reqForProposalCount);
                    $projectNo = 'BM-'.$prvdr.'-'.sprintf("%05d", $reqForProposalCount);
                    // dd($projectNo);

                    $createRquestForProposalId = RequestForProposal::create([
                                                                            'user_id'=>Auth::user()->id,
                                                                            'user_type_id'=>$userTypeId,
                                                                            'request_no'=>$requestNo,
                                                                            'project_no'=>$projectNo
                                                                        ])->id;
                    if (!empty($createRquestForProposalId)) {
                        foreach ($providerIds as $key => $providerId) {
                            $prvdrReqNo = $key+1;
                            // dd($prvdrReqNo);
                            RequestForProposalAssignToUser::create([
                                                                    'request_for_proposal_id'=>$createRquestForProposalId,
                                                                    'user_id'=>$providerId,
                                                                    'project_request_no'=>$requestNo.'-'.$prvdrReqNo
                                                                ]);
                        }
                    }else{
                        Session::flash('error',trans('messages.frontend.common_error'));
                        return redirect()->back();
                    }

                    $reqForProposal =  RequestForProposal::where('id',$createRquestForProposalId)->first();
                    $reqForProposal = !empty($reqForProposal) ? $reqForProposal->toArray() : [];

                    // remove selected providers
                    RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->delete();                    
                }                

                $countries = Country::where('status','active')->select('id','name')->orderBy('name','asc')->get()->toArray();
                // dd($countries);

                $providers = RequestForProposalAssignToUser::where('request_for_proposal_id',$createRquestForProposalId)
                                                            ->with(['userDetail'=>function($q){ $q->select('id','user_type_id','contact_name'); }])
                                                            ->get()
                                                            ->toArray();

                
                $user = User::where('id',Auth::user()->id)->first();
                $user = !empty($user) ? $user->toArray() : [];
                
                if ($user['user_type_id']==1 || $user['user_type_id']==2) {
                    $clientName = ucfirst($user['first_name'])." ".ucfirst($user['last_name']);
                }else{
                    $clientName = ucwords($user['contact_name']);
                }

                // dd($reqForProposalServiceIds);
                $page = "requestForProposal";
                return view('frontend.login.user.requestForProposal.requestForProposal',compact('page','user','userType','clientName','clientAddress','createRquestForProposalId','providers','providerServices','countries','reqForProposal','reqForProposalServiceIds'));
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

    public function requestForProposalUpdateStep(Request $request) {

        $data = $request->all();
        // dd($data);
        $createRquestForProposalId = base64_decode($data['createRquestForProposalId']);
        $update = RequestForProposal::where('id',$createRquestForProposalId)
                                     ->update(['completed_step_no'=>$data['stepNo']]);
        // dd($update);
        if ($update) {
            // dd('if');
            return array('status'=>'success');
        }else{
            // dd('else');
            return array('status'=>'error');
        }
    }

    public function requestForProposalUpdateServiceCategories($encReqForProposalId, Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($encReqForProposalId);
        // dd($decReqForProposalId);
        // dd($data['service_ids']);
        if (isset($data['service_ids']) && !empty($data['service_ids'])) {
            RequestForProposalService::where('request_for_proposal_id',$decReqForProposalId)
                                      ->delete();
            foreach ($data['service_ids'] as $key => $serviceId) {
                RequestForProposalService::create([
                                                   'request_for_proposal_id'=>$decReqForProposalId,
                                                   'user_service_id'=>$serviceId
                                                ]);
            }
        }

        $update = RequestForProposal::where('id',$decReqForProposalId)
                                     ->update(['completed_step_no'=>$data['step_no']]);
        // dd($update);
        if ($update) {
            return array('status'=>'success');
        }else{
            return array('status'=>'error');
        }
    }

    public function requestForProposalUpdateProjectDetail($encReqForProposalId, Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($encReqForProposalId);
        // dd($decReqForProposalId);
        // dd($decReqForProposalId);
        $update = RequestForProposal::where('id',$decReqForProposalId)
                                     ->update([
                                                'completed_step_no'=>$data['step_no'],
                                                'project_name'=>$data['project_name'],
                                                'project_no'=>$data['project_no'],
                                                'project_address'=>$data['project_address'],
                                                // 'project_city'=>$data['project_city'],
                                                'project_city_id'=>$data['project_city_id'],
                                                'project_country_id'=>$data['project_country_id'],
                                            ]);
        // dd($update);
        if ($update) {
            return array('status'=>'success');
        }else{
            return array('status'=>'error');
        }
    }

    public function requestForProposalUpdateRequestDetail($encReqForProposalId, Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($encReqForProposalId);
        // dd($data);
        // dd($decReqForProposalId);
        $update = RequestForProposal::where('id',$decReqForProposalId)
                                     ->update([
                                                'completed_step_no'=>$data['step_no'],
                                                'request_title'=>$data['request_title'],
                                                'request_description'=>$data['request_description'],
                                                'request_remarks'=>$data['request_remarks'],
                                            ]);
        // dd($update);
        if ($update) {
            return array('status'=>'success','request_title'=>$data['request_title']);
        }else{
            return array('status'=>'error');
        }
    }

    public function requestForProposalUpdateProjectSite($encReqForProposalId, Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($encReqForProposalId);
        $time = date('H:i:s', strtotime($data['proposal_submission_deadline_time']));
        $date = date('Y-m-d', strtotime($data['proposal_submission_deadline_date']));
        $dateTime = date('Y-m-d H:i:s', strtotime($data['proposal_submission_deadline_date'].' '.$data['proposal_submission_deadline_time']));
        // dd($data);
        // dd($decReqForProposalId);
        $update = RequestForProposal::where('id',$decReqForProposalId)
                                     ->update([
                                                'completed_step_no'=>$data['step_no'],
                                                'questions_submission_deadline_date'=>date('Y-m-d', strtotime($data['questions_submission_deadline_date'])),
                                                'proposal_submission_deadline_date'=>date('Y-m-d', strtotime($data['proposal_submission_deadline_date'])),
                                                'proposal_submission_deadline_time'=>date('H:i:s', strtotime($data['proposal_submission_deadline_time'])),
                                                'proposal_submission_deadline_date_time'=>$dateTime,
                                                'project_site_visitable'=>$data['project_site_visitable'],
                                            ]);
        // dd($update);
        if ($update) {
            return array('status'=>'success');
        }else{
            return array('status'=>'error');
        }
    }

    public function requestForProposalUpdateRepresentative($encReqForProposalId, Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($encReqForProposalId);
        // dd($data);
        // dd($decReqForProposalId);
        $update = RequestForProposal::where('id',$decReqForProposalId)
                                     ->update([
                                                'completed_step_no'=>$data['step_no'],
                                                'client_representative_name'=>$data['client_representative_name'],
                                                'client_representative_isd_code'=>'+'.$data['isd_code'],
                                                'client_representative_mobile_no'=>$data['client_representative_mobile_no'],
                                                'client_representative_email'=>$data['client_representative_email'],
                                            ]);
        // dd($update);
        if ($update) {
            return array('status'=>'success');
        }else{
            return array('status'=>'error');
        }
    }

    public function requestForProposalUpdateAttachFile($encReqForProposalId, Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($encReqForProposalId);
        // dd($request->all());
        $useProfilePhoto = !empty($data['use_profile_photo']) ? "yes" : "no";
        // dd($useProfilePhoto);
        // $profileImage = Auth::user()->profile_image;
        $reqForProposal = RequestForProposal::where('id',$decReqForProposalId)->select('id','attach_file','attach_logo')->first();
        // dd($reqForProposal);
        if(isset($data['attach_file']) && !empty($data['attach_file'])){
            // dd($data);
            $image = $request->file('attach_file');
            $ext = $image->getClientOriginalExtension();
            // dd($image);
            $data['attach_file'] = time().'_'.rand().'.'.$ext;

            $destination_path = requestForProposalImageBasePath;

            if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                $image = Image::make($request->file('attach_file'));
                $image = $image->resize(600,null,function($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                $image->save($destination_path.'/attachFile/'.$data['attach_file']);

                if($reqForProposal['attach_file'] != null && file_exists(requestForProposalImageBasePath.'/attachFile/'.$reqForProposal['attach_file']) ) {
                    unlink(requestForProposalImageBasePath.'/attachFile/'.$reqForProposal['attach_file']);
                }

            }else{
                return array('status'=>'error');
            }
            
        }else{
            $data['attach_file'] = $reqForProposal['attach_file'];
        }

        if(isset($data['attach_logo']) && !empty($data['attach_logo']) && $useProfilePhoto=='no'){
            // dd($data);
            $image = $request->file('attach_logo');
            $ext = $image->getClientOriginalExtension();
            // dd($image);
            $data['attach_logo'] = time().'_'.rand().'.'.$ext;

            $destination_path = requestForProposalImageBasePath;

            if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                $image = Image::make($request->file('attach_logo'));
                $image = $image->resize(600,null,function($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                $image->save($destination_path.'/attachLogo/'.$data['attach_logo']);

                if($reqForProposal['attach_logo'] != null && file_exists(requestForProposalImageBasePath.'/attachLogo/'.$reqForProposal['attach_logo']) ) {
                    unlink(requestForProposalImageBasePath.'/attachLogo/'.$reqForProposal['attach_logo']);
                }

            }else{
                return array('status'=>'error');
            }
            
        }else{
            $data['attach_logo'] = $reqForProposal['attach_logo'];
        }

        if ($useProfilePhoto=='yes') {
            $data['attach_logo'] = null;
        }
        // dd($data);
        $update = RequestForProposal::where('id',$decReqForProposalId)
                                     ->update([
                                                'completed_step_no'=>$data['step_no'],
                                                'attach_file'=>$data['attach_file'],
                                                'attach_logo'=>$data['attach_logo'],
                                                'use_profile_photo'=>$useProfilePhoto,
                                            ]);
        // dd($update);
        if ($update) {
            return array('status'=>'success');
        }else{
            return array('status'=>'error');
        }
    }

    public function requestForProposalUploadAttachFile($encReqForProposalId, Request $request)
    {
        if($request->isMethod('post')){
            $data = [];
            $data['request_for_proposal_id'] = base64_decode($encReqForProposalId);
            if($request->hasfile('file')) { 
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename =time().'.'.$extension;
                // dd($file);
                $file->move(requestForProposalAttachFileImageBasePath, $filename);
                $data['name'] = $filename;
            }
            // dd($data);
            // dd('here');
            $imgId = RequestForProposalAttachFile::create([
                                                            'request_for_proposal_id'=>base64_decode($encReqForProposalId),
                                                            'name'=>$filename
                                                        ])->id;
            $file_type = 'image';
            // $add_image = PostImage::insertGetId([
            //                                 'user_id' => Auth::user()->id,
            //                                 'name' => $uploadFile,
            //                                 'file_type' => $file_type
            //                             ]);  
            // dd($add_image);
            return $response = array('status' => 'success', 'img_id' => $imgId, 'img_name' => $filename, 'file_type' => $file_type);            
        }
    }

    public function requestForProposalDeleteAttachFile(Request $request)
    {
        if($request->isMethod('post')){
            if($request->file_id) {
                $delete_image = RequestForProposalAttachFile::where(['id' => $request->file_id])->first();
            } else {
                $delete_image = RequestForProposalAttachFile::where(['name' => $request->removename])->first();
            }
            // dd($delete_image);
            if($delete_image != null){
                if(file_exists('public/frontend/imgs/requestForProposal/attachFile/'.$delete_image->name)){
                    unlink(requestForProposalAttachFileImageBasePath.'/'.$delete_image->name);
                }
                $delete_image->delete();
            }  

            return $response = array('status' => 'success', 'result' => $delete_image);            
        }
    }

    public function requestForProposalAttachFiles($encReqForProposalId, Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($encReqForProposalId);
        // dd($decReqForProposalId);
        $attachFiles = RequestForProposalAttachFile::where('request_for_proposal_id',$decReqForProposalId)->select('id','name')->get()->toArray();

        foreach ($attachFiles as $key => $attachFile) {
            $attachFiles[$key]['size'] = File::size(public_path('frontend/imgs/requestForProposal/attachFile/' . $attachFile['name']));
        }
        // dd($attachFiles);
        if (sizeof($attachFiles)>0) {
            return array('status'=>'success','attachFiles'=>$attachFiles);
        }else{
            return array('status'=>'empty');
        }
    }

    public function reviewProposalRequest($encReqForProposalId, Request $request) {

        try{
            $data = $request->all();
            $decReqForProposalId = base64_decode($encReqForProposalId);
            // dd($decReqForProposalId);
            $reqForProposalAssignToUsers = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)
                                                                          ->with(['userDetail'=>function($q){ $q->select('id','user_type_id','supplier_code','user_property_id','company_name','contact_name','contact_last_name','location','email','isd_code','mobile_no'); },'userDetail.userPropertyDetail','requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalDetail.userTypeDetail','requestForProposalDetail.countryDetail','requestForProposalDetail.userDetail'])
                                                                          ->get()
                                                                          ->toArray();
            $userName = ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name);
            // dd($reqForProposalAssignToUsers);
            $page = 'reviewProposalRequest';
            return view('frontend.login.user.requestForProposal.reviewProposalRequest',compact('page','reqForProposalAssignToUsers','userName','encReqForProposalId'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function requestForProposalInviteeDelete(Request $request) {

        $data = $request->all();
        $decProvideId = base64_decode($data['enc_provider_id']);
        $createRquestForProposalId = base64_decode($data['createRquestForProposalId']);
        $providerCount = RequestForProposalAssignToUser::where('request_for_proposal_id',$createRquestForProposalId)->count();
        if ($providerCount>1) {
            $deleteProvider = RequestForProposalAssignToUser::where('id',$decProvideId)->delete();
            $providers = RequestForProposalAssignToUser::where('request_for_proposal_id',$createRquestForProposalId)
                                                        ->with(['userDetail'=>function($q){ $q->select('id','user_type_id','contact_name'); }])
                                                        ->get()
                                                        ->toArray();

            $view = view('frontend.elements.requestForProposalInvitees',compact('providers'))->render();

            return array('status'=>'success','view'=>$view);
        }else{
            return array('status'=>'cannotDelete');
        }
    }

    public function requestForProposalSearchProviders(Request $request) {

        $data = $request->all();
        // dd($data);
        $createRquestForProposalId = base64_decode($data['createRquestForProposalId']);
        $userTypeId = RequestForProposal::where('id',$createRquestForProposalId)->value('user_type_id');
        $providerIds = RequestForProposalAssignToUser::where('request_for_proposal_id',$createRquestForProposalId)->pluck('user_id')->toArray();
        
        $providers = User::where('user_type_id',$userTypeId)
                          ->whereNotIn('id',$providerIds)
                          ->where('contact_name','like',$data['searchContent'].'%')
                          ->where('status','active')
                          ->get()
                          ->toArray();
        
        $view = view('frontend.elements.requestForProposalSearchProviders',compact('providers'))->render();

        return array('status'=>'success', 'view'=>$view);
    }

    public function requestForProposalInviteeAdd($encReqForProposalId, Request $request) {

        $data = $request->all();
        if (isset($data['provider_ids']) && sizeof($data['provider_ids'])>0) {
            $decReqForProposalId = base64_decode($encReqForProposalId);
            $providerCount = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)->count();
            $lastProviderProjectId = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)->orderBy('id','desc')->value('project_request_no');
            $projectNo = preg_replace('/-[^-]*$/', '', $lastProviderProjectId);
            $exploded = explode('-', $lastProviderProjectId);  
            $lastNum = intval(end($exploded));  
            $providerProjectId = $projectNo.'-'.strval($lastNum);
            // $providerIds = explode(",", $data['provider_ids']);
            // dd($data['provider_ids']);
                    // dd($providerCount);
            if ($providerCount<5) {
                foreach ($data['provider_ids'] as $key => $providerId) {
                    $providerCountAgain = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)->count();
                    $providerExist = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)->where('user_id',$providerId)->first();
                    if ($providerCountAgain<5 && empty($providerExist)) {
                        $lastNum = $lastNum+1;
                        RequestForProposalAssignToUser::create([
                                                                'request_for_proposal_id'=>$decReqForProposalId,
                                                                'user_id'=>$providerId,
                                                                'project_request_no'=>$projectNo.'-'.$lastNum
                                                            ]);                 
                    }
                }
                $providers = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)
                                                            ->with(['userDetail'=>function($q){ $q->select('id','user_type_id','contact_name'); }])
                                                            ->get()
                                                            ->toArray();

                $view = view('frontend.elements.requestForProposalInvitees',compact('providers'))->render();
                return array('status'=>'success','view'=>$view);
            }elseif ($providerCount>=5){
                return array('status'=>'cannotAdd');
            }else{
                return array('status'=>'error');            
            }
        }else{
            // dd('empty');
            return array('status'=>'empty');                        
        }
    }

    public function requestForProposalSelectServiceCategories(Request $request) {

        $data = $request->all();
        $decReqForProposalId = base64_decode($data['createRquestForProposalId']);
        $providerIds = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqForProposalId)
                                                        ->pluck('user_id')
                                                        ->toArray();
        $userTypeId = RequestForProposal::where('id',$decReqForProposalId)->value('user_type_id');
        $providerSelectedServiceIds = UserSelectedService::whereIn('user_id',$providerIds)->distinct('user_service_id')->pluck('user_service_id')->toArray();

        $providerServices = UserService::where('user_type_id',$userTypeId)->whereIn('id',$providerSelectedServiceIds)->get()->toArray();

        $reqForProposalServiceIds = RequestForProposalService::where('request_for_proposal_id',$decReqForProposalId)->pluck('user_service_id')->toArray();
        // dd($reqForProposalServiceIds);
        $view = view('frontend.elements.requestForProposalProviderServices',compact('providerServices','reqForProposalServiceIds'))->render();

        $update = RequestForProposal::where('id',$decReqForProposalId)
                                     ->update(['completed_step_no'=>$data['stepNo']]);
        // dd($update);
        if ($update) {
            return array('status'=>'success','view'=>$view);
        }else{
            return array('status'=>'error');
        }
    }

    public function requestForProposalSubmit($encReqForProposalId, Request $request) {

        try{
            $data = $request->all();
            $decReqForProposalId = base64_decode($encReqForProposalId);
            // dd($decReqForProposalId);
            $update = RequestForProposal::where('id',$decReqForProposalId)->update([
                                                                                    'form_status'=>'completed',
                                                                                    'request_for_proposal_status_id'=>2
                                                                                ]);

            if ($update) {
                $userTypeId = RequestForProposal::where('id',$decReqForProposalId)->value('user_type_id');
                $userTypeAlias = UserType::where('id',$userTypeId)->value('alias');

                $reqForProposalAssignToUsers = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','email'); }])->where('request_for_proposal_id',$decReqForProposalId)->get()->toArray();
                // dd($reqForProposalAssignToUsers);
                foreach ($reqForProposalAssignToUsers as $key => $reqForProposalAssignToUser) {
                    RequestForProposalAssignToUser::where('id',$reqForProposalAssignToUser['id'])->update(['request_for_proposal_assign_to_user_status_id'=>1]);
                    $mailData = [];
                    $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
                    $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                    $mailData['to_user'] = $reqForProposalAssignToUser['user_detail']['contact_name'];
                    $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
                    $mailData['subject'] = "Request For Proposal";
                    try{
                        $this->sendMail('requestForProposal', $data['email'], $mailData);  
                        $createdNotificationId = Notification::create([
                                                                    'sender_id'=>Auth::user()->id,
                                                                    'receiver_id'=>$reqForProposalAssignToUser['user_detail']['id'],
                                                                    'content_id'=>$decReqForProposalId,
                                                                    'type'=>'rfp_sent'
                                                                ])->id;
                        if (!empty($createdNotificationId)) {
                            // dd($createdNotificationId);
                            $this->sendNotification($createdNotificationId);
                        }              
                    }catch(\Exception $e){
                        
                    }                    
                }
                // dd($userTypeAlias);
                Session::flash('success',trans('messages.frontend.request_for_proposal.submit'));
                // return redirect('/user/submittedOffers?provider='.$userTypeAlias);
                return redirect('/user/myRequests');
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

    public function requestForProposalSaveForLater($encReqForProposalId, Request $request) {

        try{
            $data = $request->all();
            $decReqForProposalId = base64_decode($encReqForProposalId);
            // dd($decReqForProposalId);
            $update = RequestForProposal::where('id',$decReqForProposalId)->update([
                                                                                    'save_for_later'=>'yes',
                                                                                    'request_for_proposal_status_id'=>1
                                                                                ]);

            if ($update) {
                Session::flash('success',trans('messages.frontend.request_for_proposal.save'));
                return redirect('/user/buildingMaterialServices');
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

    public function quotations(Request $request) {

        try{

            $reqForProposalAssignToUsers = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                                          ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no','location','experience','user_property_id'); },'requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail.userPropertyDetail','userDetail.userSelectedServicesDetail.userServiceDetail'])
                                                                          ->orderBy('id','desc')
                                                                          ->paginate(5);
                                                                          // ->get()
                                                                          // ->toArray();
            // dd($reqForProposalAssignToUsers);            
            $page = 'quotations';
            return view('frontend.login.user.quotations.quotations',compact('page','reqForProposalAssignToUsers'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function requestForProposalProviderCheck(Request $request) {

        $data = $request->all();
        // dd($data);
        if ($data['isChecked']=="yes") {
            RequestForProposalUserCheckProvider::create([
                                                         'user_id'=>Auth::user()->id,
                                                         'provider_id'=>$data['providerId'],
                                                         'user_type_id'=>$data['userTypeId']
                                                        ]);
        }else{
            RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)
                                                ->where('provider_id',$data['providerId'])
                                                ->where('user_type_id',$data['userTypeId'])
                                                ->delete();
        }
        $selectedCount = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$data['userTypeId'])->count();
        return array('status'=>'success','selectedCount'=>$selectedCount);
    }

    public function requestForProposalProviderAllCheck(Request $request) {

        $data = $request->all();
        // dd($data);
        foreach ($data['providerIds'] as $key => $providerId) {
            $providerCheck = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('provider_id',$providerId)->first();
            
            if ($data['isChecked']=="yes") {
                if (empty($providerCheck)) {
                    RequestForProposalUserCheckProvider::create([
                                                                 'user_id'=>Auth::user()->id,
                                                                 'provider_id'=>$providerId,
                                                                 'user_type_id'=>$data['userTypeId']
                                                                ]);
                }
            }else{
                RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)
                                                    ->where('provider_id',$providerId)
                                                    ->where('user_type_id',$data['userTypeId'])
                                                    ->delete();
            }
            
        }
        // die;        
        $selectedCount = RequestForProposalUserCheckProvider::where('user_id',Auth::user()->id)->where('user_type_id',$data['userTypeId'])->count();
        // dd($selectedCount);
        return array('status'=>'success','selectedCount'=>$selectedCount);
    }

    public function reviewProposalRequestDetail($encReqId, Request $request) {

        try{
            $data = $request->all();
            $decReqId = base64_decode($encReqId);
            // dd($decReqForProposalId);
            $reqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)
                                                                          ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalDetail.userTypeDetail','requestForProposalDetail.countryDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','email','isd_code','mobile_no'); },])
                                                                          ->first()
                                                                          ->toArray();
            $userName = ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name);
            // dd($reqForProposalAssignToUser);
                $datetime1 = new DateTime();
                $datetime2 = new DateTime($reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_date'].' '.$reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_time']);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');//now do whatever you like with $days
                // dd($days);
            $page = 'reviewProposalRequest';
            return view('frontend.login.user.quotations.reviewProposalRequestDetail',compact('page','reqForProposalAssignToUser','userName','encReqId','days'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function proposalHistory($encReqId, Request $request) {

        try{
            $data = $request->all();
            $decReqId = base64_decode($encReqId);
            $userId = RequestForProposalAssignToUser::where('id',$decReqId)->value('user_id');
            // dd($userId);     
            $quotations = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                                          ->where('user_id',$userId)
                                                                          ->with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title','completed_step_no','project_name','project_no','questions_submission_deadline_date','proposal_submission_deadline_date','proposal_submission_deadline_time','form_status','created_at'); }])
                                                                          ->orderBy('id','desc')
                                                                          ->paginate(5);
                                                                          // ->get()
                                                                          // ->toArray();
            // dd(count($quotations));  
            if (count($quotations)) {
                $page = 'proposalHistory';
                return view('frontend.login.user.quotations.proposalHistory',compact('page','encReqId','quotations'));                
            }else{
                Session::flash('error',trans('messages.frontend.request_for_proposal.not_found'));
                return redirect()->back();
            }      
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function trackRFPRequest(Request $request) {

        try{
            $data = $request->all(); 
            if ($request->isMethod('post')) {
                // dd($data);
                $quotation = RequestForProposalAssignToUser::where('project_request_no',$data['rfq_id'])
                                                            ->with(['userDetail'=>function($q){ $q->select('id','contact_name'); },'requestForProposalDetail'=>function($q){ $q->select('id','user_id','user_type_id','completed_step_no','project_name','project_no','project_address','project_city','project_country_id','proposal_submission_deadline_date','form_status','created_at'); },'userDetail.userSelectedServicesDetail.userServiceDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name'); },'requestForProposalDetail.userTypeDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.countryDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail',])
                                                            ->first();
                $quotation = !empty($quotation) ? $quotation->toArray() : [];
                if (empty($quotation)) {
                    Session::flash('error',trans('messages.frontend.request_for_proposal.request_not_found'));
                    return redirect()->back();
                }
            }else{
                $quotation = [];
            }           
            // dd($quotation);
            $page = 'trackRFPRequest';
            return view('frontend.login.user.quotations.trackRFPRequest',compact('page','quotation'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function trackAllRFP(Request $request) {

        try{
            $data = $request->all();    
            $quotations = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('user_id',Auth::user()->id)->where('status','active'); })
                                                                          ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no','location','experience','user_property_id'); },'requestForProposalDetail'=>function($q){ $q->select('*'); },'userDetail.userPropertyDetail','userDetail.userSelectedServicesDetail.userServiceDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','isd_code','mobile_no','email'); },'requestForProposalDetail.userTypeDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.countryDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail',])
                                                                          ->orderBy('id','desc')
                                                                          // ->paginate(5);
                                                                          ->get()
                                                                          ->toArray();
            // dd($quotations);       
            $page = 'trackAllRFP';
            return view('frontend.login.user.quotations.trackAllRfp',compact('page','quotations'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function submittedOffers(Request $request) {

        try{
            $data = $request->all();
            $userTypeId = UserType::where('alias',$data['provider'])->value('id');
            // dd($userTypeId);
            $reqForProposalAssignToUsers = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q)use($userTypeId){ $q->where('user_type_id',$userTypeId)->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                                          ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no','location','experience','user_property_id'); },'requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail.userPropertyDetail','userDetail.userSelectedServicesDetail.userServiceDetail'])
                                                                          ->orderBy('id','desc')
                                                                          ->paginate(5);
                                                                          // ->get()
                                                                          // ->toArray();
            // dd($reqForProposalAssignToUsers);  
            if (count($reqForProposalAssignToUsers)) {
                $page = 'submittedOffers';
                return view('frontend.login.user.quotations.submittedOffers',compact('page','reqForProposalAssignToUsers'));               
            }else{
                Session::flash('error',trans('messages.frontend.submitted_offers.not_found'));
                return redirect()->back();
            }           
            
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
            $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','email'); }])->where('id',$decReqId)->first();
            $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];
            $mailData = [];
            $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
            $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
            $mailData['to_user'] = $reqForProposalAssignToUser['user_detail']['contact_name'];
            $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
            $mailData['subject'] = "Request For Proposal Removed";
            $mailData['request_status'] = "removed";
            // dd($reqForProposalAssignToUser);  

            try{
                $this->sendMail('requestForProposalStatus', $data['email'], $mailData);               
            }catch(\Exception $e){
                
            }  

            $delReqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)->delete();   
            
            Session::flash('success',trans('messages.frontend.request_for_proposal.remove'));
            return redirect()->back();
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function requestForProposalAccept($encReqId, Request $request) {

        try{
            $data = $request->all();
            $decReqId = base64_decode($encReqId);
            $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','user_id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','email'); },'requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','email'); }])->where('id',$decReqId)->first();
            $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];

            // dd($reqForProposalAssignToUser);  
            $mailData = [];
            $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
            $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
            $mailData['to_user'] = $reqForProposalAssignToUser['user_detail']['contact_name'];
            $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
            $mailData['subject'] = "Request For Proposal Accepted";
            $mailData['request_status'] = "accepted";
            // dd($data['email']);
            try{
                $this->sendMail('requestForProposalStatus', $data['email'], $mailData);               
            }catch(\Exception $e){
                
            }  

            $delReqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)->update(['user_status'=>'accepted']); 
            // dd('here');  
            // $page = 'proposalHistory';
            Session::flash('success',trans('messages.frontend.request_for_proposal.reject'));
            return redirect()->back();
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
            $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
            $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
            $mailData['to_user'] = $reqForProposalAssignToUser['user_detail']['contact_name'];
            $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
            $mailData['subject'] = "Request For Proposal Rejected";
            $mailData['request_status'] = "rejected";
            // dd($data['email']);
            try{
                $this->sendMail('requestForProposalStatus', $data['email'], $mailData);               
            }catch(\Exception $e){
                
            }  

            $delReqForProposalAssignToUser = RequestForProposalAssignToUser::where('id',$decReqId)->update(['user_status'=>'rejected']);   
            // $page = 'proposalHistory';
            Session::flash('success',trans('messages.frontend.request_for_proposal.reject'));
            return redirect()->back();
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function myRequests(Request $request) {

        try{
            $data = $request->all();  
            $page = 'myRequests';
            $myRequests = RequestForProposal::where('user_id',Auth::user()->id)
                                             ->where(function ($query) {
                                                    $query->where('save_for_later','yes')
                                                          ->orWhere('form_status','completed');
                                                })
                                             ->where('proposal_submission_deadline_date_time','<=',date('Y-m-d H:i:s'))
                                             // ->orderBy('id','desc')
                                             // ->get()
                                             // ->toArray();
                                             ->update(['request_for_proposal_status_id'=>3]);

            $myRequestCount = RequestForProposal::where('user_id',Auth::user()->id)
                                                 ->where(function ($query) {
                                                            $query->where('save_for_later','yes')
                                                                  ->orWhere('form_status','completed');
                                                        })
                                                 ->count();

            // dd($myRequestCount);
            return view('frontend.login.user.requests.myRequests',compact('page','myRequestCount'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function myRequestsIndex(Request $request) {

        $url = url('/');
        // dd('index');
        
        $myRequests = RequestForProposal::where('user_id',Auth::user()->id)
                                         ->where(function ($query) {
                                                    $query->where('save_for_later','yes')
                                                          ->orWhere('form_status','completed');
                                                })
                                         ->leftJoin('cities','cities.id','request_for_proposals.project_city_id')
                                         ->leftJoin('user_types','user_types.id','request_for_proposals.user_type_id')
                                         ->leftJoin('request_for_proposal_statuses','request_for_proposal_statuses.id','request_for_proposals.request_for_proposal_status_id')
                                         ->select('request_for_proposals.*','cities.name as project_city_name','user_types.name as user_type','request_for_proposal_statuses.name as request_for_proposal_status_name')
                                         ->orderBy('id','desc');
                                         // ->get()
                                         // ->toArray();
        // dd($myRequests);

        return DataTables::of($myRequests)
                            ->addIndexColumn()
                            // ->addColumn('action', function($row) use($url){
                            //     $edit_url = url('admin/generalManagement/question/edit/'.Crypt::encrypt($row->id));
                            //     return '<a href="'.$edit_url.'"><i class="fa fa-edit" title="Edit"></i></a>
                            //     <a href="'.url('admin/generalManagement/question/details').'/'.Crypt::encrypt($row->id).'"><i class="fa fa-eye" title="View"></i><a><a href="'.url("admin/generalManagement/question/delete/".Crypt::encrypt($row->id)).'" val="'.Crypt::encrypt($row->id).'" class="del_btn"  onclick="return confirm(\'Are you sure you want to delete?\')"><i class="fa fa-trash" title="Delete"></i></a>'; })
                            // ->addColumn('status', function ($row) {
                            //     return '<div class="status_button_toggle" ral="'.$row->id.'" rel="'.$row->status.'" id="status_button_'.$row->id.'"></div>';
                            // })
                            ->addColumn('check_box', function ($myRequest) {
                                return '<div class="custom-control custom-checkbox text-center"><input type="checkbox" class="custom-control-input rfp_chek" id="customCheck_tbl'.$myRequest->id.'" data-id="'.$myRequest->id.'" name="example1"><label class="custom-control-label" for="customCheck_tbl'.$myRequest->id.'"></label></div>';
                            })
                            ->addColumn('type_of_services', function ($myRequest) {
                                $services = RequestForProposalService::where('request_for_proposal_id',$myRequest->id)->with('userServiceDetail')->get()->toArray();
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
                            ->addColumn('request_id', function ($myRequest) {
                                $manageRequestUrl = url('/user/manageRequest')."/".base64_encode($myRequest->id);
                                return '<a style="color:#cc3f2f;" href='.$manageRequestUrl.'>'.$myRequest->request_no.'</a>';
                            })
                            ->addColumn('no_of_invitees', function ($myRequest) {
                                return RequestForProposalAssignToUser::where('request_for_proposal_id',$myRequest->id)->count();
                            })
                            ->addColumn('invitation_date', function ($myRequest) {
                                return date('d/m/Y', strtotime($myRequest->created_at));
                            })
                            ->addColumn('submission_date', function ($myRequest) {
                                return date('d/m/Y', strtotime($myRequest->proposal_submission_deadline_date));
                            })
                            ->addColumn('remaining_days', function ($myRequest) {
                                // return date('d/m/Y', strtotime($myRequest->proposal_submission_deadline_date));
                                $datetime1 = new DateTime();
                                $datetime2 = new DateTime($myRequest->proposal_submission_deadline_date.' '.$myRequest->proposal_submission_deadline_time);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%a');//now do whatever you like with $days

                                if ($datetime2<$datetime1 || $days==0) {
                                    $days = "--";    
                                }
                                // dd($days);
                                return $days;
                            })
                            ->escapeColumns([])
                            ->make(true); 
    }

    public function cancelRequestForProposal(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['ids']) && sizeof($data['ids'])>0) {
            foreach ($data['ids'] as $key => $requestId) {
                if (!empty($requestId)) {
                    RequestForProposal::where('id',$requestId)->update(['request_for_proposal_status_id'=>4]);

                    $reqForProposalAssignToUsers = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','contact_last_name','company_name','email','user_property_id'); },'userDetail.userPropertyDetail'])->where('request_for_proposal_id',$requestId)->get()->toArray();
                    // dd($reqForProposalAssignToUsers);
                    foreach ($reqForProposalAssignToUsers as $key => $reqForProposalAssignToUser) {
                        $mailData = [];
                        $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
                        $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                        
                        if ($reqForProposalAssignToUser['user_detail']['user_property_detail']['type']=='company') {
                            $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['company_name']);
                        }else{
                            $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['contact_name']).' '.ucfirst($reqForProposalAssignToUser['user_detail']['contact_last_name']);
                        }

                        $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
                        $mailData['subject'] = "Request For Proposal Cancelled";
                        // dd($data);
                        try{
                            $this->sendMail('requestForProposalCancelled', $data['email'], $mailData);  
                            // $createdNotificationId = Notification::create([
                            //                                             'sender_id'=>Auth::user()->id,
                            //                                             'receiver_id'=>$reqForProposalAssignToUser['user_detail']['id'],
                            //                                             'content_id'=>$decReqForProposalId,
                            //                                             'type'=>'rfp_sent'
                            //                                         ])->id;
                            // if (!empty($createdNotificationId)) {
                            //     // dd($createdNotificationId);
                            //     $this->sendNotification($createdNotificationId);
                            // }              
                        }catch(\Exception $e){
                            
                        }                    
                    }

                }
            }
            // Session::flash('success',trans('messages.frontend.common_error'));
            // return redirect('/user/myRequests');
            return $response = array('status'=>'success');
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function deleteRequestForProposal(Request $request) {

        $data = $request->all();
        // dd($data['ids']);
        if (isset($data['ids']) && sizeof($data['ids'])>0) {
            foreach ($data['ids'] as $key => $requestId) {
                if (!empty($requestId)) {
                    $attachLogo = RequestForProposal::where('id',$requestId)->value('attach_logo');
                    $attachFiles = RequestForProposalAttachFile::where('request_for_proposal_id',$requestId)->get()->toArray();
                    // dd($attachFiles);
                    if($attachLogo != null && file_exists(requestForProposalImageBasePath.'/attachLogo/'.$attachLogo) ) {
                        unlink(requestForProposalImageBasePath.'/attachLogo/'.$attachLogo);
                    }

                    if (isset($attachFiles) && sizeof($attachFiles)>0) {
                        foreach ($attachFiles as $key => $attachFile) {
                            if($attachFile['name'] != null && file_exists(requestForProposalImageBasePath.'/attachFile/'.$attachFile['name']) ) {
                                unlink(requestForProposalImageBasePath.'/attachFile/'.$attachFile['name']);
                            }                            
                        }
                    }
                    RequestForProposalAttachFile::where('request_for_proposal_id',$requestId)->delete();
                    RequestForProposalService::where('request_for_proposal_id',$requestId)->delete();
                    RequestForProposalAssignToUser::where('request_for_proposal_id',$requestId)->delete();
                    RequestForProposal::where('id',$requestId)->delete();
                }
            }
            // Session::flash('success',trans('messages.frontend.common_error'));
            // return redirect('/user/myRequests');
            return $response = array('status'=>'success');
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function changeSubmissionDeadlineRequestForProposal(Request $request) {

        $data = $request->all();
        $time = date('H:i:s', strtotime($data['submission_deadline']));
        $date = date('Y-m-d', strtotime($data['submission_deadline']));
        // dd($time);
        if (isset($data['ids']) && sizeof($data['ids'])>0) {
            foreach ($data['ids'] as $key => $requestId) {
                if (!empty($requestId)) {
                    RequestForProposal::where('id',$requestId)->update([
                                                                        'proposal_submission_deadline_date'=>$date,
                                                                        'proposal_submission_deadline_time'=>$time,
                                                                    ]);

                    $reqForProposalAssignToUsers = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','contact_last_name','company_name','email','user_property_id'); },'userDetail.userPropertyDetail'])->where('request_for_proposal_id',$requestId)->get()->toArray();
                    // dd($reqForProposalAssignToUsers);
                    foreach ($reqForProposalAssignToUsers as $key => $reqForProposalAssignToUser) {
                        $mailData = [];
                        $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
                        $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                        
                        if ($reqForProposalAssignToUser['user_detail']['user_property_detail']['type']=='company') {
                            $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['company_name']);
                        }else{
                            $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['contact_name']).' '.ucfirst($reqForProposalAssignToUser['user_detail']['contact_last_name']);
                        }

                        $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
                        $mailData['subject'] = "Request For Proposal Submission Deadline Changed";
                        // dd($data);
                        try{
                            $this->sendMail('requestForProposalSubmissionDeadlineChanged', $data['email'], $mailData);  
                            // $createdNotificationId = Notification::create([
                            //                                             'sender_id'=>Auth::user()->id,
                            //                                             'receiver_id'=>$reqForProposalAssignToUser['user_detail']['id'],
                            //                                             'content_id'=>$decReqForProposalId,
                            //                                             'type'=>'rfp_sent'
                            //                                         ])->id;
                            // if (!empty($createdNotificationId)) {
                            //     // dd($createdNotificationId);
                            //     $this->sendNotification($createdNotificationId);
                            // }              
                        }catch(\Exception $e){
                            
                        }                    
                    }
                }
            }
            // Session::flash('success',trans('messages.frontend.common_error'));
            // return redirect('/user/myRequests');
            return $response = array('status'=>'success');
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function manageRequest($encReqId, Request $request) {

        try{
            $decReqId = base64_decode($encReqId);
            // dd($decReqId);
            $request = RequestForProposal::where('request_for_proposals.id',$decReqId)
                                          ->leftJoin('cities','cities.id','request_for_proposals.project_city_id')
                                          ->leftJoin('user_types','user_types.id','request_for_proposals.user_type_id')
                                          ->leftJoin('request_for_proposal_statuses','request_for_proposal_statuses.id','request_for_proposals.request_for_proposal_status_id')
                                          ->select('request_for_proposals.*','cities.name as project_city_name','user_types.name as user_type','request_for_proposal_statuses.name as request_for_proposal_status_name')
                                          ->first();
            $request = !empty($request) ? $request->toArray() : [];

            $datetime1 = new DateTime();
            $datetime2 = new DateTime($request['proposal_submission_deadline_date'].' '.$request['proposal_submission_deadline_time']);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');//now do whatever you like with $days

            if ($datetime2<$datetime1 || $days==0) {
                $days = "--";    
            }

            $services = RequestForProposalService::where('request_for_proposal_id',$decReqId)->with('userServiceDetail')->get()->toArray();
            $service = '';
            foreach ($services as $key => $value) {
                if ($key==0) {
                    $sep = "";
                }else{
                    $sep = ",";
                }
                $service = $service.$sep.$value['user_service_detail']['name'];
            }

            $noOfInvitees = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqId)->count();

            $requestForProposalAssignToUsers = RequestForProposalAssignToUser::where('request_for_proposal_id',$decReqId)
                                                                              ->with(['userDetail'=>function($q){ $q->select('id','user_type_id','company_name','contact_name','contact_last_name'); },'requestForProposalAssignToUserStatusDetail'])
                                                                              ->get()
                                                                              ->toArray();
            // dd($requestForProposalAssignToUsers);       
            $page = 'myRequests';
            return view('frontend.login.user.requests.manageRequests',compact('page','request','days','service','requestForProposalAssignToUsers','encReqId','noOfInvitees'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function cancelRequestForProposalAssignToUser(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['ids']) && sizeof($data['ids'])>0) {
            foreach ($data['ids'] as $key => $requestId) {
                if (!empty($requestId)) {

                    RequestForProposalAssignToUser::where('id',$requestId)->update(['request_for_proposal_assign_to_user_status_id'=>5]);

                    $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','contact_last_name','company_name','email','user_property_id'); },'userDetail.userPropertyDetail'])->where('id',$requestId)->first();
                    $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];

                    $this->updateRequestForProposalAssignToUserStatus($reqForProposalAssignToUser['request_for_proposal_id']);
                    // dd($reqForProposalAssignToUsers);
                    $mailData = [];
                    $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
                    $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                    
                    if ($reqForProposalAssignToUser['user_detail']['user_property_detail']['type']=='company') {
                        $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['company_name']);
                    }else{
                        $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['contact_name']).' '.ucfirst($reqForProposalAssignToUser['user_detail']['contact_last_name']);
                    }

                    $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
                    $mailData['subject'] = "Request For Proposal Cancelled";
                    // dd($data);
                    try{
                        $this->sendMail('requestForProposalAssignToUserCancelled', $data['email'], $mailData);  
                        // $createdNotificationId = Notification::create([
                        //                                             'sender_id'=>Auth::user()->id,
                        //                                             'receiver_id'=>$reqForProposalAssignToUser['user_detail']['id'],
                        //                                             'content_id'=>$decReqForProposalId,
                        //                                             'type'=>'rfp_sent'
                        //                                         ])->id;
                        // if (!empty($createdNotificationId)) {
                        //     // dd($createdNotificationId);
                        //     $this->sendNotification($createdNotificationId);
                        // }              
                    }catch(\Exception $e){
                        
                    }  
                }
            }
            return $response = array('status'=>'success');
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function rejectRequestForProposalAssignToUser(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['ids']) && sizeof($data['ids'])>0) {
            foreach ($data['ids'] as $key => $requestId) {
                if (!empty($requestId)) {

                    RequestForProposalAssignToUser::where('id',$requestId)->update(['request_for_proposal_assign_to_user_status_id'=>7]);

                    $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','contact_last_name','company_name','email','user_property_id'); },'userDetail.userPropertyDetail'])->where('id',$requestId)->first();
                    $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];

                    $this->updateRequestForProposalAssignToUserStatus($reqForProposalAssignToUser['request_for_proposal_id']);
                    // dd($reqForProposalAssignToUsers);
                    $mailData = [];
                    $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
                    $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                    
                    if ($reqForProposalAssignToUser['user_detail']['user_property_detail']['type']=='company') {
                        $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['company_name']);
                    }else{
                        $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['contact_name']).' '.ucfirst($reqForProposalAssignToUser['user_detail']['contact_last_name']);
                    }

                    $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
                    $mailData['subject'] = "Request For Proposal Rejected";
                    // dd($data);
                    try{
                        $this->sendMail('requestForProposalAssignToUserRejected', $data['email'], $mailData);  
                        // $createdNotificationId = Notification::create([
                        //                                             'sender_id'=>Auth::user()->id,
                        //                                             'receiver_id'=>$reqForProposalAssignToUser['user_detail']['id'],
                        //                                             'content_id'=>$decReqForProposalId,
                        //                                             'type'=>'rfp_sent'
                        //                                         ])->id;
                        // if (!empty($createdNotificationId)) {
                        //     // dd($createdNotificationId);
                        //     $this->sendNotification($createdNotificationId);
                        // }              
                    }catch(\Exception $e){
                        
                    }
                }
            }
            return $response = array('status'=>'success');
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function acceptRequestForProposalAssignToUser(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['ids']) && sizeof($data['ids'])>0) {
            foreach ($data['ids'] as $key => $requestId) {
                if (!empty($requestId)) {

                    RequestForProposalAssignToUser::where('id',$requestId)->update(['request_for_proposal_assign_to_user_status_id'=>6]);

                    $reqForProposalAssignToUser = RequestForProposalAssignToUser::with(['requestForProposalDetail'=>function($q){ $q->select('id','request_title'); },'userDetail'=>function($q){ $q->select('id','contact_name','contact_last_name','company_name','email','user_property_id'); },'userDetail.userPropertyDetail'])->where('id',$requestId)->first();
                    $reqForProposalAssignToUser = !empty($reqForProposalAssignToUser) ? $reqForProposalAssignToUser->toArray() : [];

                    $this->updateRequestForProposalAssignToUserStatus($reqForProposalAssignToUser['request_for_proposal_id']);
                    // dd($reqForProposalAssignToUsers);
                    $mailData = [];
                    $data['email'] = $reqForProposalAssignToUser['user_detail']['email'];
                    $mailData['by_user'] = Auth::user()->first_name.' '.Auth::user()->last_name;
                    
                    if ($reqForProposalAssignToUser['user_detail']['user_property_detail']['type']=='company') {
                        $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['company_name']);
                    }else{
                        $mailData['to_user'] = ucfirst($reqForProposalAssignToUser['user_detail']['contact_name']).' '.ucfirst($reqForProposalAssignToUser['user_detail']['contact_last_name']);
                    }

                    $mailData['request_title'] = $reqForProposalAssignToUser['request_for_proposal_detail']['request_title'];
                    $mailData['subject'] = "Request For Proposal Accepted";
                    // dd($data);
                    try{
                        $this->sendMail('requestForProposalAssignToUserAccepted', $data['email'], $mailData);  
                        // $createdNotificationId = Notification::create([
                        //                                             'sender_id'=>Auth::user()->id,
                        //                                             'receiver_id'=>$reqForProposalAssignToUser['user_detail']['id'],
                        //                                             'content_id'=>$decReqForProposalId,
                        //                                             'type'=>'rfp_sent'
                        //                                         ])->id;
                        // if (!empty($createdNotificationId)) {
                        //     // dd($createdNotificationId);
                        //     $this->sendNotification($createdNotificationId);
                        // }              
                    }catch(\Exception $e){
                        
                    }
                }
            }
            return $response = array('status'=>'success');
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function deleteRequestForProposalAssignToUser(Request $request) {

        $data = $request->all();
        // dd($data['ids']);
        if (isset($data['ids']) && sizeof($data['ids'])>0) {
            foreach ($data['ids'] as $key => $requestId) {
                if (!empty($requestId)) {
                    // RequestForProposalAssignToUser::where('id',$requestId)->delete();
                    $requestForProposalId = RequestForProposalAssignToUser::where('id',$requestId)->value('request_for_proposal_id');
                    // dd($requestForProposalId);
                    $attachFiles = RequestForProposalRespondAttachment::where('request_for_proposal_id',$requestForProposalId)
                                                                       ->where('request_for_proposal_assign_to_user_id',$requestId)
                                                                       ->get()
                                                                       ->toArray();
                    // dd($attachFiles);
                    if (isset($attachFiles) && sizeof($attachFiles)>0) {
                        foreach ($attachFiles as $key => $attachFile) {
                            if($attachFile['attachment'] != null && file_exists(public_path('frontend/imgs/requestForProposal/respondAttachment/'.$attachFile['attachment'])) ) {
                                unlink(public_path('frontend/imgs/requestForProposal/respondAttachment/'.$attachFile['attachment']));
                            }                           
                        }
                    }
                    RequestForProposalRespondAttachment::where('request_for_proposal_id',$requestForProposalId)
                                                        ->where('request_for_proposal_assign_to_user_id',$requestId)
                                                        ->delete();
                    RequestForProposalAssignToUser::where('id',$requestId)->delete();  
                }
            }
            return $response = array('status'=>'success');
        }else{
            return $response = array('status'=>'error');
        }
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
            // dd($respondAttachments);   
            $page = 'myRequests';
            if (sizeof($respondAttachments)>0) {
                return view('frontend.login.user.requests.requestDocumentCenter',compact('page','requestForProposalAssignToUser','respondAttachments','encReqAssignId'));
            }else{
                Session::flash('error',trans('messages.frontend.request_for_proposal.respond_not_found'));
                return redirect()->back();
            }    
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function updateRequestForProposalAssignToUserStatus($requestId) {

        $totalReqs = RequestForProposalAssignToUser::where('request_for_proposal_id',$requestId)->count();
        $updatedReqs = RequestForProposalAssignToUser::where('request_for_proposal_id',$requestId)->where('request_for_proposal_assign_to_user_status_id','>',4)->count();
        // dd($updatedReqs);
        if ($totalReqs==$updatedReqs) {
            RequestForProposal::where('id',$requestId)->update(['request_for_proposal_status_id'=>5]);
        }
    }


}
