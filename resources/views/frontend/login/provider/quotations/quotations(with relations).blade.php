@extends('frontend.layout.providerLayout')
@section('title','Request For Proposals (RFP)')
@section('content')
<style type="text/css">
    /*.file_inpt{
        height: 45px !important;
    }*/
    /*.file_inpt .custom-file-label{
        border-radius: 0;
        white-space: nowrap;
        overflow: hidden;
    }
    .file_inpt .custom-file-label::after{
        border-radius: 0;
    }*/
</style>
    <section class="outer_db_wraper db_seller_items_list">
        <div class="combine_side_main_slr_db d-flex">
            <div class="sidenav_seller_db">
                @include('frontend.include.providerSidebar')
            </div>
            <div class="main_seller_db item_list_seller_db">
                <section class="bread_top_sec">
                    <div class="db_container">
                        <div class="d-flex justify-content-between text-white pos_rel">
                            <div class="sid_controlr">
                                <i class="clos_sid fa fa-bars"></i>
                                <i class="opn_sid fa fa-times"></i>
                            </div>
                            <h3>Request For Proposals (RFP)</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">RFP</a></li>
                                    <!-- <li class="breadcrumb-item active">Item List</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </section>
                <div class="marg_over_bread">
                    <section class="item_list_sec p-0">
                        <div class="db_container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="quot_main_rgt">
                                                <div class="fltr_topp d-flex align-items-center justify-content-end mb-3">
                                                    <!-- <div class="section-heading">
                                                        <span>Review Quotations</span>
                                                        <h2>RFP Quotations</h2>
                                                    </div> -->
                                                    <a class="btn btn_theme text" href="{{url('/provider/trackAllRFPs')}}"><span>Track All RFP<span style="text-transform: lowercase;">s</span></span></a>
                                                </div>
                                                <div class="fltr_topp d-flex justify-content-end align-items-center">
                                                    <!-- <div class="meta_fltr pos_rel">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Search by Name">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="fltr_topp d-flex justify-content-end align-items-center mb-3"> -->
                                                        <div class="rfp_quotatns_list dropdown">
                                                            <span class="clkd_span filtr_option">
                                                                <i class="fa fa-sort"></i>&nbsp;Filter
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right custm_filter_provdr">
                                                                <div class="fltrs_accordn">
                                                                    <div id="accordion">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="card-link" data-toggle="collapse" href="#collapse_one">
                                                                                By Client Name
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse_one" class="collapse show" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="prnt_child_chk">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                                                <label class="custom-control-label" for="customCheck">Architectural Design</label>
                                                                                            </div>
                                                                                            <!-- <ul class="child_chk" type="none">
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                                                        <label class="custom-control-label" for="heck1">Wood & Plastic</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                                                        <label class="custom-control-label" for="heck2">Doors and Windows</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                                                        <label class="custom-control-label" for="heck3">Equipments</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                                                        <label class="custom-control-label" for="heck4">Special Construction</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                            </ul> -->
                                                                                        </div>
                                                                                        <div class="prnt_child_chk">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
                                                                                                <label class="custom-control-label" for="customCheck1">Structural Design</label>
                                                                                            </div>
                                                                                            <!-- <ul class="child_chk" type="none">
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                                                        <label class="custom-control-label" for="heck1">Site Work</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                                                        <label class="custom-control-label" for="heck2">Concrete</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                                                        <label class="custom-control-label" for="heck3">Block & Masonry</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                                                        <label class="custom-control-label" for="heck4">Thermal & Moisture</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                            </ul> -->
                                                                                        </div>
                                                                                        <div class="prnt_child_chk">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck2" name="example1">
                                                                                                <label class="custom-control-label" for="customCheck2">Electrical Design</label>
                                                                                            </div>
                                                                                            <!-- <ul class="child_chk" type="none">
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck11" name="example1">
                                                                                                        <label class="custom-control-label" for="heck11">Lightning</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck22" name="example1">
                                                                                                        <label class="custom-control-label" for="heck22">Electrical Power</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck33" name="example1">
                                                                                                        <label class="custom-control-label" for="heck33">Low Current System</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                            </ul> -->
                                                                                        </div>
                                                                                        <div class="prnt_child_chk">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="example1">
                                                                                                <label class="custom-control-label" for="customCheck3">Mechanical Design</label>
                                                                                            </div>
                                                                                            <!-- <ul class="child_chk" type="none">
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                                                        <label class="custom-control-label" for="heck1">Conveying System</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                                                        <label class="custom-control-label" for="heck2">Escalators</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                                                        <label class="custom-control-label" for="heck3">Plumbing</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                                                        <label class="custom-control-label" for="heck4">Fire Fighting</label>
                                                                                                    </div>
                                                                                                </li>
                                                                                            </ul> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Two">
                                                                                By Client Membership ID
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse_Two" class="collapse" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Commercial</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Residential</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Two">
                                                                                By Status (Client Side)
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse_Two" class="collapse" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Commercial</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Residential</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Two">
                                                                                By Status (Provider Side)
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse_Two" class="collapse" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Commercial</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Residential</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="botom_meta_dsgnr filtr_btn text-center my-3">
                                                                    <a class="btn btn_theme providerFltrsCls" href="https://pro.promaticstechnologies.com/build_mart/designer/list"><span>Reset</span></a>
                                                                    <a class="btn btn_theme providerFltrsCls" href="javascript:;"><span>Search</span></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="rfp_quotatns_list fltr_down dropdown">
                                                            <span class="clkd_span sort_click dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-sort"></i>&nbsp;Sort
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#">User Name Ascending</a>
                                                                <a class="dropdown-item" href="#">User Name Descending</a>
                                                                <a class="dropdown-item" href="#">RFQ Name Ascending</a>
                                                                <a class="dropdown-item" href="#">RFQ Name Descending</a>
                                                                <a class="dropdown-item" href="#">RFQ Price High to Low</a>
                                                                <a class="dropdown-item" href="#">RFQ Price Low to High</a>
                                                                <a class="dropdown-item" href="#">Recent Submission Date</a>
                                                            </div>
                                                        </div>
                                                    <!-- </div> -->
                                                </div>
                                                <div class="wrap_quot_main">
                                                    @if(isset($quotations) && sizeof($quotations)>0)
                                                        @foreach($quotations as $key => $quotation)
                                                            @if(!empty($quotation))
                                                                <?php //dd($quotation);
                                                                    $datetime1 = new DateTime();
                                                                    $datetime2 = new DateTime($quotation['requestForProposalDetail']['proposal_submission_deadline_date'].' '.$quotation['requestForProposalDetail']['proposal_submission_deadline_time']);
                                                                    $interval = $datetime1->diff($datetime2);
                                                                    // dd($interval);
                                                                    $days = $interval->format('%a');//now do whatever you like with $days
                                                                    $hours = $interval->format('%h');//now do whatever you like with $days

                                                                    if ($datetime2<$datetime1 || $days==0) {
                                                                        $days = "--";    
                                                                        $hours = "--";    
                                                                    }else{
                                                                        $days = sprintf("%02d", $days);
                                                                        $hours = sprintf("%02d", $hours);
                                                                    }
                                                                ?>
                                                                <div class="single_list_desgnr d-flex">
                                                                    <div class="dsgnr_img">
                                                                        <!-- <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img-fluid"> -->
                                                                        @if(!empty($quotation['requestForProposalDetail']['userDetail']['profile_image']) && file_exists(public_path('frontend/imgs/userProfile/'.$quotation['requestForProposalDetail']['userDetail']['profile_image'])))
                                                                            <img src="{{asset('public/frontend/imgs/userProfile/'.$quotation['requestForProposalDetail']['userDetail']['profile_image'])}}" class="img-fluid">
                                                                        @else
                                                                            <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                                                                        @endif
                                                                    </div>
                                                                    <div class="dsgnr_dtl">
                                                                        <div class="top_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                            <a href="javascript:;">{{@$quotation['requestForProposalDetail']['request_title']}}</a>
                                                                            <div class="text-right">
                                                                                @if(@$quotation['quotation_price']!=0)
                                                                                    <h6>Quotation: SR {{@$quotation['quotation_price']}}</h6>
                                                                                @endif
                                                                                <!-- <span class="text-success">Proposal Submitted</span> -->
                                                                                <span class="rfp_stats my-2">Client Side: <span class="{{@$quotation['requestForProposalDetail']['requestForProposalStatusDetail']['class_name']}} rfp_bdge">{{@$quotation['requestForProposalDetail']['requestForProposalStatusDetail']['name']}}</span></span><br>
                                                                                <span>Provider Side: <span class="{{@$quotation['requestForProposalAssignToUserStatusDetail']['class_name']}} rfp_bdge">{{@$quotation['requestForProposalAssignToUserStatusDetail']['name']}}</span></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                            <div class="left_info_dsgnr">
                                                                                <p><strong>RFQ ID:</strong> {{@$quotation['project_request_no']}}</p>
                                                                                <p><strong>Client Name:</strong> {{ucfirst
                                                                                (@$quotation['requestForProposalDetail']['userDetail']['first_name'])}} {{ucfirst
                                                                                (@$quotation['requestForProposalDetail']['userDetail']['last_name'])}}</p>
                                                                                <p><strong>Client Membership ID:</strong> {{@$quotation['requestForProposalDetail']['userDetail']['supplier_code']}}</p>
                                                                                <p><strong>Contact Name:</strong> {{@$quotation['requestForProposalDetail']['client_representative_name']}}</p>
                                                                                <p><strong>Contact Number:</strong> {{@$quotation['requestForProposalDetail']['client_representative_isd_code']}} {{@$quotation['requestForProposalDetail']['client_representative_mobile_no']}}</p>
                                                                                <p><strong>Email:</strong> {{@$quotation['requestForProposalDetail']['client_representative_email']}}</p>
                                                                                <p><strong>Type of Services:</strong> @foreach($quotation['requestForProposalDetail']['requestForProposalServicesDetail'] as $key => $serviceDetail) @if($key>=1) ,@endif{{$serviceDetail['userServiceDetail']['name']}} @endforeach </p>
                                                                                <p><strong>Project Location:</strong> <a href="javascript:;" class="cp_loca"> {{@$quotation['requestForProposalDetail']['project_address']}}, {{@$quotation['requestForProposalDetail']['projectCityDetail']['name']}}, {{@$quotation['requestForProposalDetail']['countryDetail']['name']}}</a></p>
                                                                                <!-- <p><strong>Experience:</strong> +{{@$quotation['userDetail']['experience']}} (In @if(@$quotation['userDetail']['experience']<=1) Year @else Years @endif)</p> -->
                                                                            </div>
                                                                            <!-- <div class="btn_quots d-flex flex-column justify-content-end" data-id="{{base64_encode(@$quotation['id'])}}">
                                                                                @if($quotation['user_status']=='rejected')
                                                                                    <button class="btn btn_theme rejc_btn">Rejected</button>
                                                                                @elseif($quotation['provider_status']=='accepted')
                                                                                    <button class="btn btn_theme acpt_btn">Accepted</button>
                                                                                    <button class="btn btn_theme respd_btn">Respond</button>
                                                                                @elseif($quotation['provider_status']=='rejected')
                                                                                    <button class="btn btn_theme rejc_btn">Rejected</button>
                                                                                @else
                                                                                    <button class="btn btn_theme acpt_btn acpt_quot">Accept</button>
                                                                                    <button class="btn btn_theme rejc_btn rjct_quot">Reject</button>
                                                                                    <button class="btn btn_theme respd_btn resp_quot">Respond</button>
                                                                                @endif
                                                                                <button class="btn btn_theme delt_btn">Delete</button>
                                                                            </div> -->
                                                                            <div class="rfp_timer">
                                                                                <h3>Time Remaining</h3>
                                                                                <div class="timer_box d-flex justify-content-around">
                                                                                    <div>
                                                                                        <h4>Days</h4>
                                                                                        <span>{{$days[0]}}</span>
                                                                                        <span>{{$days[1]}}</span>
                                                                                    </div>
                                                                                    <div>
                                                                                        <h4>Hours</h4>
                                                                                        <span>{{$hours[0]}}</span>
                                                                                        <span>{{$hours[1]}}</span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="botom_meta_dsgnr text-right">
                                                                            <!-- <div class="btn-group">
                                                                                <a class="btn btn_theme btn-sm" href="{{url('/provider/reviewProposalRequestDetail/'.base64_encode($quotation['id']))}}"><span>View Document</span></a>
                                                                            </div> -->
                                                                            <div class="btn-group">
                                                                                @if($quotation['request_for_proposal_assign_to_user_status_id']==1)
                                                                                    <a class="btn btn_theme btn-sm acpt_rfse" data-id="{{base64_encode(@$quotation['id'])}}" href="javascript:;"><span>Accept / Refuse Invitation</span></a>
                                                                                @else
                                                                                    <a class="btn btn_theme btn-sm" href="javascript:;"><span>Accept / Refuse Invitation</span></a>
                                                                                @endif
                                                                                <a class="btn btn_theme btn-sm" href="{{url('/provider/messages?to_user='.base64_encode(@$quotation['requestForProposalDetail']['userDetail']['id']))}}"><span>Chat with Client</span></a>
                                                                                <a href="{{url('/provider/requestDocumentCenter/'.base64_encode($quotation['id']))}}" class="btn btn_theme btn-sm" href="javascript:;"><span>Document Center</span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <div class="numbr_pagintn mt-3">
                                                        {{ $quotations->links() }}
                                                    </div>
                                                    <!-- <div class="single_list_desgnr d-flex">
                                                        <div class="dsgnr_img">
                                                            <img src="https://www.habtoor.com/images/AHG-Logo.jpg" class="img-fluid">
                                                        </div>
                                                        <div class="dsgnr_dtl">
                                                            <div class="top_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <a href="designerDetail.php">Alhabtoor Corporates</a><br>
                                                                    <span class="cntc_nm_compn">Contact Person: Shawn Nelson</span>
                                                                </div>
                                                                <div class="text-right">
                                                                    <h6>Quotation: SR 250,000</h6>
                                                                    <span class="text-success">Proposal Submitted</span>
                                                                </div>
                                                            </div>
                                                            <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                <div class="left_info_dsgnr">
                                                                    <p><strong>Contact Number:</strong> +91 95786 65431</p>
                                                                    <p><strong>Email:</strong> peter_willson@gmail.clm</p>
                                                                    <p><strong>Category:</strong> Architectural Work</p>
                                                                    <p><strong>Location:</strong> <a href="" class="cp_loca">13003 Southwest Suite, TX 7747, Dubai</a></p>
                                                                    <p><strong>Experience:</strong> +4 (In Years)</p>
                                                                </div>
                                                                <div class="btn_quots d-flex flex-column justify-content-end">
                                                                    <button class="btn btn_theme acpt_btn">Accept</button>
                                                                    <button class="btn btn_theme rejc_btn">Reject</button>
                                                                    <button class="btn btn_theme respd_btn">Respond</button>
                                                                    <button class="btn btn_theme delt_btn">Delete</button>
                                                                </div>
                                                            </div>
                                                            <div class="botom_meta_dsgnr text-right">
                                                                <div class="btn-group">
                                                                    <a class="btn btn_theme btn-sm" href="javascript:;"><span>View Document</span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <!-- <div class="pagntns_btm">
                                                    <nav>
                                                        <ul class="pagination justify-content-center">
                                                            <li class="page-item disabled">
                                                              <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item active">
                                                              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item">
                                                              <a class="page-link" href="#">Next</a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade edit_div" id="acpt_rfse_mod" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Accept / Refuse Invitation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="rfp_acpt_btns text-center">
                        <button type="button" class="btn btn_theme sbmt_quotation mr-2 acpt_quot"><span>Accept</span></button>
                        <button type="button" class="btn btn_theme sbmt_quotation ml-2 rjct_quot"><span>Refuse</span></button>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn_theme sbmt_quotation"><span>Submit</span></button>
                </div> -->
            </div>
        </div>
    </div>
    @include('frontend.include.modals.addQuotationPrice')
    @include('frontend.include.modals.respondToRFPQuotation')
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        var enc_req_id;
        var ths;
        $("body").on('click','.delt_btn',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            enc_req_id = $(this).parent().data('id');
            ths = $(this);
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                // alert('here');
                window.location.replace("{{url('/provider/requestForProposalDelete')}}"+"/"+enc_req_id);
                // $.ajax({
                //     url:"{{url('user/address/delete')}}"+"/"+enc_address_id,
                //     success:function(resp){
                //         $('.loader').hide();
                //         if (resp.status=='success') {
                //             ths.closest('.user_adrs').remove();
                //             Swal.fire(
                //               'Deleted!',
                //               'Your address has been deleted.',
                //               'success'
                //             )
                //         }else{
                //             swal('Oops, Something went wrong');
                //         }
                //     },
                //     error:function(){
                //         $(".loader").hide();
                //         swal('Oops, Something went wrong');
                //     }
                // });
              }
            })            
        });

        $("body").on('click','.acpt_quot',function(){
            // enc_req_id = $(this).parent().data('id');
            // alert(enc_req_id);
            $('.encReqIdCls').val(enc_req_id);
            $('#acpt_rfse_mod').modal('hide');
            $('#add_quotation_price_mod').modal('show');
        });

        $("body").on('click','.rjct_quot',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            // enc_req_id = $(this).parent().data('id');
            // alert(enc_req_id);
            $('#acpt_rfse_mod').modal('hide');
            ths = $(this);
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, refuse it!'
            }).then((result) => {
              if (result.value) {
                // alert('here');
                $(".loader").show();
                window.location.replace("{{url('/provider/requestForProposalReject')}}"+"/"+enc_req_id);
              }
            })            
        });

        $("body").on('click','.resp_quot',function(){
            enc_req_id = $(this).parent().data('id');
            // alert(enc_req_id);
            $('.encReqIdCls').val($(this).parent().data('id'));
            $('#respond_to_rfp_quotation_mod').modal('show');
        });

        $("body").on('click','.acpt_rfse',function(){
            enc_req_id = $(this).data('id');
            // alert(enc_req_id);
            $('#acpt_rfse_mod').modal('show');
        })
    });
</script>


<script>
    $(document).ready(function(){
        $('.filtr_option').on('click', function(){
            $('.custm_filter_provdr').toggleClass('open'); 
        });
    });
</script>

<script>
        $('body').on('click', function (e) {
            if (!$('.filtr_option').is(e.target) && $('.filtr_option').has(e.target).length === 0 && $('.open').has(e.target).length === 0 ) {
            $('.custm_filter_provdr').removeClass('open'); }
        });
</script>
@stop
