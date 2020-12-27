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
    /*.quotation_fltr_srt_cls.is_active {
        color: #cc3f2f;
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
                                                        <form id="quotationFltrsForm" action="{{url('/provider/quotations')}}" method="GET">
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
                                                                                            @foreach($users as $key => $user)
                                                                                                @if(!empty($user))
                                                                                                    <div class="prnt_child_chk">
                                                                                                        <div class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" @if(isset($data['clients']) && sizeof($data['clients'])>0 && in_array(@$user['id'],$data['clients'])) checked="" @endif class="custom-control-input" id="clientNameCheck{{$key}}" name="clients[]" value="{{ucfirst(@$user['id'])}}">
                                                                                                            <label class="custom-control-label" for="clientNameCheck{{$key}}">{{ucfirst(@$user['first_name'])}} {{ucfirst(@$user['last_name'])}}</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
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
                                                                                            @foreach($users as $key => $user)
                                                                                                @if(!empty($user['supplier_code']))
                                                                                                    <div class="prnt_child_chk">
                                                                                                        <div class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" @if(isset($data['membership_ids']) && sizeof($data['membership_ids'])>0 && in_array(@$user['id'],$data['membership_ids'])) checked="" @endif class="custom-control-input" id="clientMembIdCheck{{$key}}" name="membership_ids[]" value="{{ucfirst(@$user['id'])}}">
                                                                                                            <label class="custom-control-label" for="clientMembIdCheck{{$key}}">{{@$user['supplier_code']}}</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Three">
                                                                                    By Status (Client Side)
                                                                                  </a>
                                                                                </div>
                                                                                <div id="collapse_Three" class="collapse" data-parent="#accordion">
                                                                                    <div class="card-body">
                                                                                        <div class="meta_fltr">
                                                                                            @foreach($clientStatuses as $key => $clientStatus)
                                                                                                @if(!empty($clientStatus))
                                                                                                    <div class="prnt_child_chk">
                                                                                                        <div class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" @if(isset($data['user_statuses']) && sizeof($data['user_statuses'])>0 && in_array(@$clientStatus['id'],$data['user_statuses'])) checked="" @endif class="custom-control-input" id="clientStatusCheck{{$key}}" name="user_statuses[]" value="{{$clientStatus['id']}}">
                                                                                                            <label class="custom-control-label" for="clientStatusCheck{{$key}}">{{@$clientStatus['name']}}</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Four">
                                                                                    By Status (Provider Side)
                                                                                  </a>
                                                                                </div>
                                                                                <div id="collapse_Four" class="collapse" data-parent="#accordion">
                                                                                    <div class="card-body">
                                                                                        <div class="meta_fltr">
                                                                                            @foreach($providerStatuses as $key => $providerStatus)
                                                                                                @if(!empty($providerStatus))
                                                                                                    <div class="prnt_child_chk">
                                                                                                        <div class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" @if(isset($data['provider_statuses']) && sizeof($data['provider_statuses'])>0 && in_array(@$providerStatus['id'],$data['provider_statuses'])) checked="" @endif class="custom-control-input" id="providerStatusCheck{{$key}}" name="provider_statuses[]" value="{{$providerStatus['id']}}">
                                                                                                            <label class="custom-control-label" for="providerStatusCheck{{$key}}">{{@$providerStatus['name']}}</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Five">
                                                                                        By Type of Services
                                                                                    </a>
                                                                                </div>
                                                                                <div id="collapse_Five" class="collapse" data-parent="#accordion">
                                                                                    <div class="card-body">
                                                                                        <div class="meta_fltr">
                                                                                            @foreach($services as $key => $service)
                                                                                                @if(!empty($service))
                                                                                                    <div class="prnt_child_chk">
                                                                                                        <div class="custom-control custom-checkbox">
                                                                                                            <input type="checkbox" @if(isset($data['services']) && sizeof($data['services'])>0 && in_array(@$service['user_service_id'],$data['services'])) checked="" @endif class="custom-control-input" id="serviceCheck{{$key}}" name="services[]" value="{{@$service['user_service_id']}}">
                                                                                                            <label class="custom-control-label" for="serviceCheck{{$key}}">{{@$service['user_service_detail']['name']}}</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                            <!-- <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                                <label class="custom-control-label" for="customCheck4">Commercial</label>
                                                                                            </div>
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                                <label class="custom-control-label" for="customCheck5">Residential</label>
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Six">
                                                                                    By Date of Invitation
                                                                                  </a>
                                                                                </div>
                                                                                <div id="collapse_Six" class="collapse" data-parent="#accordion">
                                                                                    <div class="card-body">
                                                                                        <div class="meta_fltr">
                                                                                            <div class="form-group">
                                                                                                <!-- <label>From</label> -->
                                                                                                <input type="text" placeholder="From" onkeydown="return false" name="from_date" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" />
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <!-- <label>To</label> -->
                                                                                                <input type="text" placeholder="To" onkeydown="return false" name="to_date" class="form-control datetimepicker-input tmpckr" id="datetimepicker6" data-toggle="datetimepicker" data-target="#datetimepicker6" />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse_Seven">
                                                                                    By Remaining Time for Submission
                                                                                  </a>
                                                                                </div>
                                                                                <div id="collapse_Seven" class="collapse" data-parent="#accordion">
                                                                                    <div class="card-body">
                                                                                        <div class="meta_fltr">
                                                                                            <select class="form-control custom-select" name="remaining_days">
                                                                                                <option value="">Select No. of Days</option>
                                                                                                @for($i=1; $i <=100 ; $i++)
                                                                                                    <option @if(isset($data['remaining_days']) && !empty($data['remaining_days']) && $data['remaining_days']==$i) selected="" @endif value="{{$i}}">{{$i}}</option>
                                                                                                @endfor
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="botom_meta_dsgnr filtr_btn text-center my-3">
                                                                        <a class="btn btn_theme" href="{{url('/provider/quotations')}}"><span>Reset</span></a>
                                                                        <a class="btn btn_theme quotationFltrsCls" href="javascript:;"><span>Search</span></a>
                                                                    </div>
                                                                    <input type="hidden" class="sort_data_cls" name="sort_data" value="" /> 
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div class="rfp_quotatns_list fltr_down dropdown">
                                                            <span class="clkd_span sort_click dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-sort"></i>&nbsp;Sort
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item quotation_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='client_name_asc') is_active @endif" rel="client_name_asc" href="javascript:;">Client Name Ascending</a>
                                                                <a class="dropdown-item quotation_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='client_name_desc') is_active @endif" rel="client_name_desc" href="javascript:;">Client Name Descending</a>
                                                                <a class="dropdown-item quotation_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_name_asc') is_active @endif" rel="rfq_name_asc" href="javascript:;">RFQ Name Ascending</a>
                                                                <a class="dropdown-item quotation_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_name_desc') is_active @endif" rel="rfq_name_desc" href="javascript:;">RFQ Name Descending</a>
                                                                <a class="dropdown-item quotation_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_price_high_to_low') is_active @endif" rel="rfq_price_high_to_low" href="javascript:;">RFQ Price High to Low</a>
                                                                <a class="dropdown-item quotation_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='rfq_price_low_to_high') is_active @endif" rel="rfq_price_low_to_high" href="javascript:;">RFQ Price Low to High</a>
                                                                <a class="dropdown-item quotation_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='recent_submission_date') is_active @endif" rel="recent_submission_date" href="javascript:;">Recent Submission Date</a>
                                                            </div>
                                                        </div>
                                                    <!-- </div> -->
                                                </div>
                                                @if($quotations->total()>0)
                                                    <div class="wrap_quot_main">
                                                        @if(isset($quotations) && sizeof($quotations)>0)
                                                            @foreach($quotations as $key => $quotation)
                                                                @if(!empty($quotation))
                                                                    <?php //dd($quotation);
                                                                        $datetime1 = new DateTime();
                                                                        $datetime2 = new DateTime($quotation['request_for_proposal_proposal_submission_deadline_date'].' '.$quotation['request_for_proposal_proposal_submission_deadline_time']);
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
                                                                            @if(!empty($quotation['request_proposal_user_profile_image']) && file_exists(public_path('frontend/imgs/userProfile/'.$quotation['request_proposal_user_profile_image'])))
                                                                                <img src="{{asset('public/frontend/imgs/userProfile/'.$quotation['request_proposal_user_profile_image'])}}" class="img-fluid">
                                                                            @else
                                                                                <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                                                                            @endif
                                                                        </div>
                                                                        <div class="dsgnr_dtl">
                                                                            <div class="top_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                                <a href="javascript:;">{{@$quotation['request_for_proposal_request_title']}}</a>
                                                                                <div class="text-right">
                                                                                    @if(@$quotation['quotation_price']!=0)
                                                                                        <h6>Quotation: SR {{@$quotation['quotation_price']}}</h6>
                                                                                    @endif
                                                                                    <!-- <span class="text-success">Proposal Submitted</span> -->
                                                                                    <span class="rfp_stats my-2">Client Side: <span class="{{@$quotation['request_for_proposal_status_class_name']}} rfp_bdge">{{@$quotation['request_for_proposal_status_name']}}</span></span><br>
                                                                                    <span>Provider Side: <span class="{{@$quotation['request_for_proposal_assign_to_user_status_class_name']}} rfp_bdge">{{@$quotation['request_for_proposal_assign_to_user_status_name']}}</span></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                                <div class="left_info_dsgnr">
                                                                                    <p><strong>RFQ ID:</strong> {{@$quotation['project_request_no']}}</p>
                                                                                    <p><strong>Client Name:</strong> {{ucfirst
                                                                                    (@$quotation['request_proposal_user_first_name'])}} {{ucfirst
                                                                                    (@$quotation['request_proposal_user_last_name'])}}</p>
                                                                                    <p><strong>Client Membership ID:</strong> {{@$quotation['request_proposal_user_supplier_code']}}</p>
                                                                                    <p><strong>Contact Name:</strong> {{@$quotation['request_for_proposal_client_representative_name']}}</p>
                                                                                    <p><strong>Contact Number:</strong> {{@$quotation['request_for_proposal_client_representative_isd_code']}} {{@$quotation['request_for_proposal_client_representative_mobile_no']}}</p>
                                                                                    <p><strong>Email:</strong> {{@$quotation['request_for_proposal_client_representative_email']}}</p>
                                                                                    <p><strong>Type of Services:</strong> @foreach($quotation['requestForProposalDetail']['requestForProposalServicesDetail'] as $key => $serviceDetail) @if($key>=1) ,@endif{{$serviceDetail['userServiceDetail']['name']}} @endforeach </p>
                                                                                    <p><strong>Project Location:</strong> <a href="javascript:;" class="cp_loca"> {{@$quotation['request_for_proposal_project_address']}}, {{@$quotation['request_proposal_city_name']}}, {{@$quotation['request_proposal_country_name']}}</a></p>
                                                                                </div>
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
                                                                                    <a class="btn btn_theme btn-sm" href="{{url('/provider/messages?to_user='.base64_encode(@$quotation['request_proposal_user_id']))}}"><span>Chat with Client</span></a>
                                                                                    <a href="{{url('/provider/requestDocumentCenter/'.base64_encode($quotation['id']))}}" class="btn btn_theme btn-sm" href="javascript:;"><span>Document Center</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        <div class="numbr_pagintn mt-3">
                                                            {{ $quotations->appends(request()->except('page'))->links() }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="nf_img text-center">
                                                        <!-- <h1>Not Found</h1>                                     -->
                                                        <img src="{{asset('public/frontend/img/provider_not_found.png')}}" class="img-fluid mt-5">
                                                    </div>
                                                @endif
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

        $('.filtr_option').on('click', function(){
            $('.custm_filter_provdr').toggleClass('open'); 
        });

        var fromDate = "{{@$data['from_date']}}";
        var toDate = "{{@$data['to_date']}}";

        $('#datetimepicker5').datetimepicker({
            format: 'L',
            // minDate: moment(),
            defaultDate: fromDate,
            // options.minDate: true,
            // ignoreReadonly: true
        });
        $('#datetimepicker6').datetimepicker({
            format: 'L',
            // minDate: moment(),
            defaultDate: toDate,
            // ignoreReadonly: true
        });

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
        });

        $('body').on('click', function (e) {
            if (!$('.filtr_option').is(e.target) && $('.filtr_option').has(e.target).length === 0 && $('.open').has(e.target).length === 0 ) {
            $('.custm_filter_provdr').removeClass('open'); }
        });

        $("body").on('click','.quotationFltrsCls',function(){
            $("#quotationFltrsForm").submit();
        });

        $("body").on('click','.quotation_fltr_srt_cls',function(){
            // alert($(this).attr('rel'));
            $('.sort_data_cls').val($(this).attr('rel'));
            $("#quotationFltrsForm").submit();
        });

        
    });
</script>

@stop
