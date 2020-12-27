@extends('frontend.layout.providerLayout')
@section('title','Track RFP')
@section('content')
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
                            <h3>Track RFP</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Track RFP</a></li>
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
                                            <div class="custom_container">
                                                <div class="wrp_rfp_req">
                                                    <div class="fltr_topp d-flex align-items-center">
                                                        <div class="section-heading">
                                                            <span>RFP Request</span>
                                                            <h2>Track Your RFP Requests</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 offset-sm-3">
                                                        <form class="trackRFPRequestForm" action="{{url('/provider/trackRFPRequest')}}">
                                                            <div class="form-group">
                                                                <label class="">RFQ ID:</label>
                                                                <input type="text" class="form-control" name="rfq_id" placeholder="Enter RFQ ID">
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <button class="btn btn_theme track_rfp_btn"><span>Track RFP</span></button>
                                                            </div>
                                                        </form>
                                                        <div class="track_all_anchr text-right">
                                                            <a href="{{url('/provider/trackAllRFPs')}}" class="">Track All RFP Request</a>
                                                        </div>
                                                        @if(!empty($quotation))
                                                            <div class="table_rfp_data">
                                                                <h4>Track RFP</h4>
                                                                <div class="table-responsive">
                                                                    <table class="table tabl_rfp_top table-bordered">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>RFQ ID:</th>
                                                                                <td>{{@$quotation['project_request_no']}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Category:</th>
                                                                                <td>{{@$quotation['request_for_proposal_detail']['user_type_detail']['name']}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Type of Services:</th>
                                                                                <td>
                                                                                    @if(isset($quotation['request_for_proposal_detail']['request_for_proposal_services']) && sizeof($quotation['request_for_proposal_detail']['request_for_proposal_services'])>0)
                                                                                        @foreach($quotation['request_for_proposal_detail']['request_for_proposal_services'] as $key => $requestForProposalService)
                                                                                            @if(!empty($requestForProposalService))
                                                                                                @if($key==1) ,@endif {{$requestForProposalService['user_service_detail']['name']}} 
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>From</th>
                                                                                <td>{{ucfirst(@$quotation['request_for_proposal_detail']['user_detail']['first_name'])}} {{ucfirst(@$quotation['request_for_proposal_detail']['user_detail']['last_name'])}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>To:</th>
                                                                                @if($quotation['user_detail']['user_property_detail']['type']=='individual')
                                                                                    <td>{{ucfirst(@$quotation['user_detail']['contact_name'])}} {{ucfirst(@$quotation['user_detail']['contact_last_name'])}}</td>
                                                                                @else
                                                                                    <td>{{ucwords(@$quotation['user_detail']['company_name'])}}</td>
                                                                                @endif
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Invitation Date:</th>
                                                                                <td>{{date('d-m-Y', strtotime($quotation['request_for_proposal_detail']['created_at']))}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Quotation Submission Date:</th>
                                                                                <td>{{date('d-m-Y', strtotime($quotation['request_for_proposal_detail']['proposal_submission_deadline_date']))}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Project Name:</th>
                                                                                <td>{{@$quotation['request_for_proposal_detail']['project_name']}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Project Number:</th>
                                                                                <td>{{@$quotation['request_for_proposal_detail']['project_no']}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Project Location:</th>
                                                                                <td>{{@$quotation['request_for_proposal_detail']['project_address']}}, {{@$quotation['request_for_proposal_detail']['project_city_detail']['name']}}, {{@$quotation['request_for_proposal_detail']['country_detail']['name']}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                @if(isset($respondAttachments) && sizeof($respondAttachments)>0)
                                                                    <div class="table-responsive">
                                                                        <table class="table tabl_rfp_botm table-bordered">
                                                                            <thead>
                                                                                <th>Sent By</th>
                                                                                <th>Comment</th>
                                                                                <th>Date of Action</th>
                                                                                <th>Attachment</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($respondAttachments as $key => $respondAttachment)
                                                                                    @if(!empty($respondAttachment))
                                                                                        <tr>
                                                                                            @if($respondAttachment['user_detail']['user_type_id']==1 || $respondAttachment['user_detail']['user_type_id']==2)
                                                                                                <td>{{ucfirst(@$respondAttachment['user_detail']['first_name'])}} {{ucfirst(@$respondAttachment['user_detail']['last_name'])}}</td>                                              
                                                                                            @elseif($respondAttachment['user_detail']['user_property_detail']['type']=='company')
                                                                                                <td>{{ucfirst(@$respondAttachment['user_detail']['company_name'])}}</td>                                       
                                                                                            @else
                                                                                                <td>{{ucfirst(@$respondAttachment['user_detail']['contact_name'])}} {{ucfirst(@$respondAttachment['user_detail']['contact_last_name'])}}</td>                                      
                                                                                            @endif
                                                                                            <td>{{$respondAttachment['document_name']}}</td>
                                                                                            <td>{{date('d/m/Y', strtotime($respondAttachment['created_at']))}}</td>
                                                                                            <td class="chat_icons">
                                                                                                <a href="{{url('/public/frontend/imgs/requestForProposal/respondAttachment/'.$respondAttachment['attachment'])}}" target="_blank" class="text-danger"><i class="fa fa-file"></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                                <!-- <tr>
                                                                                    <td>Query #1 sent by Provider:</td>
                                                                                    <td>18-06-2019</td>
                                                                                    <td>--</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Answer #1 sent by Client:</td>
                                                                                    <td>18-06-2019</td>
                                                                                    <td>--</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Answer #2 sent by Client:</td>
                                                                                    <td>20-06-2019</td>
                                                                                    <td>--</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Query #2 sent by Provider:</td>
                                                                                    <td>20-09-2019</td>
                                                                                    <td>--</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Answer #3 sent by Client:</td>
                                                                                    <td>20-09-2019</td>
                                                                                    <td>--</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Quotation Submitted:</td>
                                                                                    <td>19-04-2020</td>
                                                                                    <td>--</td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
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
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.trackRFPRequestForm').validate({
            ignore:[],
            rules:{
                rfq_id:{
                    required:true
                },
            },
            messages:{
                rfq_id:{
                    required:"Please enter RFQ ID"
                },
            }
        });

        $("body").on('click','.track_rfp_btn',function(){
            $('.trackRFPRequestForm').submit();
        });
    });
</script>
@stop