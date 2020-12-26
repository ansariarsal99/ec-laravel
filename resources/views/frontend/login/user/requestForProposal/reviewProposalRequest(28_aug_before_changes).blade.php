@extends('frontend.layout.layout')
@section('title','Review Request For Proposal')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Review Proposal</li>
            </ol>
        </nav>
    </div>
    <section class="rev_prop_page_sec">
        <div class="custom_container">
            @if(isset($reqForProposalAssignToUsers) && sizeof($reqForProposalAssignToUsers)>0)
                @foreach($reqForProposalAssignToUsers as $key => $reqForProposalAssignToUser)
                    @if(!empty($reqForProposalAssignToUser))
                    <?php 
                        $datetime1 = new DateTime();
                        $datetime2 = new DateTime($reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_date'].' '.$reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_time']);
                        $interval = $datetime1->diff($datetime2);
                        $days = $interval->format('%a');//now do whatever you like with $days
                     ?>
                        <div class="wrp_rfp_req">
                            <div class="col-sm-10 offset-sm-1">
                                <!-- <div class="logo_genrtd">
                                    <p><strong class="text-muted">Generated Via</strong></p>
                                    <img src="{{asset('public/frontend/img/logo.png')}}" class="img-genrtd" />
                                </div> -->
                                <div class="fltr_topp">
                                    <div class="page_heading text-center">
                                        <!-- <img src="https://www.habtoor.com/images/AHG-Logo.jpg" class="clent_logo"> -->
                                        @if(!empty($reqForProposalAssignToUser) && ($reqForProposalAssignToUser['request_for_proposal_detail']['use_profile_photo']=='yes') && (Auth::user()->profile_image!=null) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                                            <img src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="clent_logo" />
                                        @elseif(!empty($reqForProposalAssignToUser) && file_exists(public_path('frontend/imgs/requestForProposal/attachLogo/'.$reqForProposalAssignToUser['request_for_proposal_detail']['attach_logo'])))
                                            <img src="{{asset('public/frontend/imgs/requestForProposal/attachLogo/'.$reqForProposalAssignToUser['request_for_proposal_detail']['attach_logo'])}}" class="clent_logo" />
                                        @endif
                                        <h1 class="text-uppercase">Review Request For Proposal</h1>
                                    </div>
                                </div>
                                <div class="prop_req_page">
                                    <h4 class="text-uppercase">Project Name</h4>
                                    <p class="mt-3 mb-0"><strong>{{$reqForProposalAssignToUser['request_for_proposal_detail']['user_type_detail']['name']}}:</strong>
                                        @if(isset($reqForProposalAssignToUser['request_for_proposal_detail']['request_for_proposal_services']) && sizeof($reqForProposalAssignToUser['request_for_proposal_detail']['request_for_proposal_services'])>0)
                                            @foreach($reqForProposalAssignToUser['request_for_proposal_detail']['request_for_proposal_services'] as $key => $requestForProposalService)
                                                @if(!empty($requestForProposalService))
                                                    @if($key==1) ,@endif {{$requestForProposalService['user_service_detail']['name']}} 
                                                @endif
                                            @endforeach
                                        @endif
                                    </p>
                                    <p class="mb-2"><strong>Request Title:</strong> {{@$reqForProposalAssignToUser['request_for_proposal_detail']['request_title']}}</p>
                                </div>
                                <div class="from_meta mt-5">
                                    <p><span><strong>From:</strong> {{@$userName}}</span> | <span><strong>Date:</strong> {{date('M d, Y', strtotime($reqForProposalAssignToUser['created_at']))}}</span></p>
                                    <p><strong>Prepared By:</strong> {{@$reqForProposalAssignToUser['request_for_proposal_detail']['client_representative_name']}} </p>
                                    <p><strong>Contact number:</strong> {{@$reqForProposalAssignToUser['request_for_proposal_detail']['client_representative_isd_code']}} {{@$reqForProposalAssignToUser['request_for_proposal_detail']['client_representative_mobile_no']}}</p>
                                    <p><strong>Email Address:</strong> {{@$reqForProposalAssignToUser['request_for_proposal_detail']['client_representative_email']}}</p>
                                </div>
                                <div class="to_meta mt-5">
                                    <p><span class="mr-2"><strong>To:</strong> xxxxxxx</span></p>
                                    <p><strong>Attn:</strong> xxxxxxx</p>
                                    <p><strong>Contact number:</strong> xxxxxxxx</p>
                                    <p><strong>Email Address:</strong> xxxxxxxxx</p>
                                </div>
                                <p class="mt-5 mb-5"><strong>RFQ ID:</strong> xxxxxxxx</p>
                                <div class="inro_div">
                                    <h6 class="text-uppercase">Introduction</h6>
                                    <p><span class="text-primary">{{@$userName}}</span> invites and welcomes proposals for the mentioned project. Based on your previous work experience, your firm has been selected to receive this RFQ and is invited to submit a proposal. Please take the time to carefully read and become familiar with the proposal requirements. All proposals submitted for consideration must be received by the time as specified below under the "SUBMISSION DEADLINE."</p>
                                </div>
                                <div class="descr_div mt-4">
                                    <h6 class="text-uppercase">Request Description</h6>
                                    <p>{{@$reqForProposalAssignToUser['request_for_proposal_detail']['request_description']}}</p>
                                </div>
                                <div class="proj_loct mt-4 mb-4">
                                    <h6 class="text-uppercase">Project & Location</h6>
                                    <p>This bid proposal is being requested for <span class="text-primary">{{@$reqForProposalAssignToUser['request_for_proposal_detail']['project_name']}}</span> which is or shall be located at <span class="text-primary">{{@$reqForProposalAssignToUser['request_for_proposal_detail']['project_address']}}, {{@$reqForProposalAssignToUser['request_for_proposal_detail']['project_city']}}, {{@$reqForProposalAssignToUser['request_for_proposal_detail']['country_detail']['name']}}.</span></p>
                                    <p class="mt-4"><strong>Submission Deadline: </strong>{{date('M d, Y', strtotime($reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_date']))}} {{date('h:iA', strtotime($reqForProposalAssignToUser['request_for_proposal_detail']['proposal_submission_deadline_time']))}} </p>
                                    <p class="mt-4"><strong>Question Submission Deadline: </strong>{{date('M d, Y', strtotime($reqForProposalAssignToUser['request_for_proposal_detail']['questions_submission_deadline_date']))}}</p>
                                </div>
                                <div class="table_quot">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>RFQ Contact Name</th>
                                                <th>Contact Number</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{@$userName}}</td>
                                                <td>{{Auth::user()->isd_code}} {{Auth::user()->mobile_no}}</td>
                                                <td>{{Auth::user()->email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="wid_chkk">
                                    <div class="row">
                                        <label class="col-sm-7">Site visit is Mandatory:</label>
                                        <div class="col-sm-5">
                                            <div class="form-group d-flex justify-content-between">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" @if($reqForProposalAssignToUser['request_for_proposal_detail']['project_site_visitable'] == 'yes') checked="" @endif class="custom-control-input" id="" name="">
                                                    <label class="custom-control-label" for="">Yes</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" @if($reqForProposalAssignToUser['request_for_proposal_detail']['project_site_visitable'] == 'no') checked="" @endif class="custom-control-input" id="" name="">
                                                    <label class="custom-control-label" for="">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-7">Attachment::</label>
                                        <div class="col-sm-5">
                                            <div class="form-group d-flex justify-content-between">
                                                <div class="custom-control custom-checkbox">
                                                    <input @if($reqForProposalAssignToUser['request_for_proposal_detail']['attach_file'] != null) checked="" @endif type="checkbox" class="custom-control-input" id="" name="">
                                                    <label class="custom-control-label" for="">Yes</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input @if($reqForProposalAssignToUser['request_for_proposal_detail']['attach_file'] == null) checked="" @endif type="checkbox" class="custom-control-input" id="" name="">
                                                    <label class="custom-control-label" for="">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="inro_div mb-4">
                                    <h6 class="text-uppercase">Proposal submission format</h6>
                                    <p>The following is a list of information that the Bidder Should include in their proposal submission.</p>
                                </div>
                                <!-- <div class="sub_bidders mb-4">
                                    <h6 class="text-uppercase">1-Summary of Bidder Information</h6>
                                    <ul type="disc">
                                        <li>Bidder's Name</li>
                                        <li>Bidder's Address</li>
                                        <li>Bidder's Contact Info (Preferred Communication Method)</li>
                                    </ul type="disc">
                                </div> -->
                                <div class="sub_bidders mb-4">
                                    <h6 class="text-uppercase">1-Summary of Bidder Information</h6>
                                    <ul type="disc">
                                        <li>Bidder's Name: {{ucfirst($reqForProposalAssignToUser['user_detail']['contact_name'])}}</li>
                                        <li>Bidder's Address: {{@$reqForProposalAssignToUser['user_detail']['location']}} </li>
                                        <li>Bidder's Contact Info: {{@$reqForProposalAssignToUser['user_detail']['isd_code']}} {{@$reqForProposalAssignToUser['user_detail']['mobile_no']}}</li>
                                    </ul type="disc">
                                </div>
                                <div class="sub_bidders mb-4">
                                    <h6 class="text-capitalize">2-Proposed completion time</h6>
                                    <ul type="disc">
                                        <li>Time Needed for scope of work to be completed</li>
                                    </ul>
                                </div>
                                <div class="sub_bidders mb-4">
                                    <h6 class="text-capitalize">3-Cost Proposal sale Details & Summary</h6>
                                    <ul type="disc">
                                        <li>Detailed and brief summary of total cost of the proposal</li>
                                    </ul>
                                </div>
                                <div class="sub_bidders mb-4">
                                    <h6 class="text-capitalize">4-Proposed terms of payments</h6>
                                    <ul type="disc">
                                        <li>Suggested terms of payments</li>
                                    </ul>
                                    <div class="terms_payment">
                                        <div class="row">
                                            <div class="col-lg-6 prvdr_adrs">
                                                <div class="wrap_svd_adrs svd_ic m-0">                                     
                                                    <ul type="none" class="p-0">
                                                        @if($reqForProposalAssignToUser['default_term_of_payment']!=null && isset($reqForProposalAssignToUser['default_term_of_payment']['user_term_of_payment_quotas']) && sizeof($reqForProposalAssignToUser['default_term_of_payment']['user_term_of_payment_quotas'])>0)
                                                            @foreach($reqForProposalAssignToUser['default_term_of_payment']['user_term_of_payment_quotas'] as $key => $quota)
                                                                <li>{{$quota['quota_percent']}}% {{$quota['title']}}</li>
                                                            @endforeach
                                                        @else
                                                            <li>100% Upfront payment</li>
                                                        @endif
                                                        <!-- <li>75% Advance payment</li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>                                                                                      
                                    </div>
                                </div>
                                <div class="sub_bidders mb-4">
                                    <h6 class="text-capitalize">5-Validity of Quotation</h6>
                                    <ul type="disc">
                                        <li>Count of offer valid days({{@$days}})</li>
                                    </ul>
                                </div>
                                <div class="gretng_sec d-flex justify-content-between">
                                    <div class="wrm_regrds">
                                        <p class="mt-3"><i>With all our greetings & Regards,</i></p>
                                        <p class="mt-3">{{@$userName}}</p>
                                    </div>
                                    <div class="logo_genrtd">
                                        <p><strong class="text-muted">Generated Via</strong></p>
                                        <img src="{{asset('public/frontend/img/logo.png')}}" class="img-genrtd" />
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    @endif
                @endforeach
            @endif

            <!-- <div class="wrp_rfp_req">
                <div class="col-sm-10 offset-sm-1">
                    <div class="logo_genrtd">
                        <p><strong class="text-muted">Generated Via</strong></p>
                        <img src="{{asset('public/frontend/img/logo.png')}}" class="img-genrtd" />
                    </div>
                    <div class="fltr_topp">
                        <div class="page_heading text-center">
                            <img src="https://www.habtoor.com/images/AHG-Logo.jpg" class="clent_logo">
                            <h1 class="text-uppercase">Review Request For Proposal</h1>
                        </div>
                    </div>
                    <div class="prop_req_page">
                        <h4 class="text-uppercase">Project Name</h4>
                        <p class="mt-3 mb-0"><strong>Designer:</strong> Architectural Design</p>
                        <p class="mb-2"><strong>Request Title:</strong> Lorem Ipsum</p>
                    </div>
                    <div class="from_meta mt-5">
                        <p><span><strong>From:</strong> James Wilson</span> | <span><strong>Date:</strong> April 16, 2019</span></p>
                        <p><strong>Prepared By:</strong> J Crimson, <br>
                            St. No. 23, Park Avenue, NY<br>
                            California, 456789</p>
                        <p><strong>Contact number:</strong> 0555 994612389</p>
                        <p><strong>Email Address:</strong> promlorem@gmial.com</p>
                    </div>
                    <div class="to_meta mt-5">
                        <p><span class="mr-2"><strong>To:</strong> xxxxxxx</span></p>
                        <p><strong>Attn:</strong> xxxxxxx</p>
                        <p><strong>Contact number:</strong> xxxxxxxx</p>
                        <p><strong>Email Address:</strong> xxxxxxxxx</p>
                    </div>
                    <p class="mt-5 mb-5"><strong>RFQ ID:</strong> xxxxxxxx</p>
                    <div class="inro_div">
                        <h6 class="text-uppercase">Introduction</h6>
                        <p><span class="text-primary">Client Name</span> invites and welcomes proposals for the mentioned project. Based on your previous work experience, your firm has been selected to receive this RFQ and is invited to submit a proposal. Please take the time to carefully read and become familiar with the proposal requirements. All proposals submitted for consideration must be received by the time as specified below under the "SUBMISSION DEADLINE."</p>
                    </div>
                    <div class="descr_div mt-4">
                        <h6 class="text-uppercase">Request Description</h6>
                        <p>The objective and ultimate goal for this project is - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="proj_loct mt-4 mb-4">
                        <h6 class="text-uppercase">Project & Location</h6>
                        <p>This bid proposal is being requested for Project name which is or shall be located at United States, California</p>
                        <p class="mt-4"><strong>Submission Deadline: </strong>April 29,2020 11:00PM</p>
                        <p class="mt-4"><strong>Question Submission Deadline: </strong>April 22, 2020</p>
                    </div>
                    <div class="table_quot">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th>RFQ Contact Name</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Freddy Kruger</td>
                                    <td>8975613265</td>
                                    <td>freddy.krug@gmail.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="wid_chkk">
                        <div class="row">
                            <label class="col-sm-7">Site visit is Mandatory:</label>
                            <div class="col-sm-5">
                                <div class="form-group d-flex justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" checked="">
                                        <label class="custom-control-label" for="customCheck">Yes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                        <label class="custom-control-label" for="customCheck">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-7">Attachment::</label>
                            <div class="col-sm-5">
                                <div class="form-group d-flex justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                        <label class="custom-control-label" for="customCheck">Yes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" checked="">
                                        <label class="custom-control-label" for="customCheck">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inro_div mb-4">
                        <h6 class="text-uppercase">Proposal submission format</h6>
                        <p>The following is a list of information that the Bidder Should include in their proposal submission.</p>
                    </div>
                    <div class="sub_bidders mb-4">
                        <h6 class="text-uppercase">1-Summary of Bidder Information</h6>
                        <ul type="disc">
                            <li>Bidder's Name</li>
                            <li>Bidder's Address</li>
                            <li>Bidder's Contact Info (Preferred Communication Method)</li>
                        </ul type="disc">
                    </div>
                    <div class="sub_bidders mb-4">
                        <h6 class="text-capitalize">2-Proposed completion time</h6>
                        <ul type="disc">
                            <li>Time Needed for scope of work to be completed</li>
                        </ul>
                    </div>
                    <div class="sub_bidders mb-4">
                        <h6 class="text-capitalize">3-Cost Proposal sale Details & Summary</h6>
                        <ul type="disc">
                            <li>Detailed and brief summary of total cost of the proposal</li>
                        </ul>
                    </div>
                    <div class="sub_bidders mb-4">
                        <h6 class="text-capitalize">4-Proposed terms of payments</h6>
                        <ul type="disc">
                            <li>Suggested terms of payments</li>
                        </ul>
                    </div>
                    <div class="sub_bidders mb-4">
                        <h6 class="text-capitalize">5-Validity of Quotation</h6>
                        <ul type="disc">
                            <li>Count of offer valid days</li>
                        </ul>
                    </div>
                    <div class="gretng_sec d-flex justify-content-between">
                        <div class="wrm_regrds">
                            <p class="mt-3"><i>With all our greetings & Regards,</i></p>
                            <p class="mt-3">Jason Moore</p>
                        </div>
                        <div class="logo_genrtd">
                            <p><strong class="text-muted">Generated Via</strong></p>
                            <img src="{{asset('public/frontend/img/logo.png')}}" class="img-genrtd" />
                        </div>
                    </div>
                </div>
            </div> -->
                    <div class="btn_sav_next d-flex justify-content-between">
                        <span>
                            <!-- <button class="btn btn_theme btn_stk_bck"><span>Back</span></button> -->
                            <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                        </span>
                        <a class="btn btn_theme btn_stk_next" href="javascript:;" data-toggle="modal" data-target="#toast_modal"><span>Submit</span></a>
                    </div>
        </div>
    </section>

    <div class="modal fade" id="toast_modal">
        <div class="modal-dialog modal-dialog-centered modal_sml_wid">
            <div class="modal-content">

              <!-- Modal Header -->
                <div class="modal-header">
                    <!-- <h4 class="modal-title">Modal Heading</h4> -->
                    <button type="button" class="close cls_rvw_modal" data-dismiss="modal">&times;</button>
                </div>

              <!-- Modal body -->
                <div class="modal-body">
                    <div class="info_toast">
                        <p>Hi,</p>
                        <p>We have the pleasure to send you this RFP attached hereunder.</p>
                        <!-- <p class="pdf_txt cp"><span><i class="fa fa-file-pdf-o"></i> Click to view</span></p> -->
                        <p>Kindly review and your quick response will be highly appreciated..<br><br>Thanks & Best Regards,</p>
                        <p class="text-danger">Mawad Mart</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
<script type="text/javascript">
    $("body").on('click','.cls_rvw_modal',function(){
        // alert("close");
        window.location.replace("{{url('/user/requestForProposal/submit/'.@$encReqForProposalId)}}");
    });

    $("body").on('click','.btn_sav_ltr',function(){
        window.location.replace("{{url('/user/requestForProposal/saveForLater/'.@$encReqForProposalId)}}");
    });
</script>
@stop