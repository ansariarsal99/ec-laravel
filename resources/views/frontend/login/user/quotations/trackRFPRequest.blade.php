@extends('frontend.layout.layout')
@section('title','RFP Requests')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">RFP Requests</li>
            </ol>
        </nav>
    </div>
    <section class="rfpreq_page_sec">
        <div class="custom_container">
            <div class="wrp_rfp_req">
                <div class="fltr_topp d-flex align-items-center">
                    <div class="section-heading">
                        <span>RFP Request</span>
                        <h2>Track Your RFP Requests</h2>
                    </div>
                </div>
                <div class="col-sm-6 offset-sm-3">
                    <form class="trackRFPRequestForm" method="POST" action="{{url('/user/trackRFPRequest')}}">
                        @csrf
                        <div class="form-group">
                            <label class="">RFQ ID:</label>
                            <input type="text" class="form-control" name="rfq_id" placeholder="Enter RFQ ID">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn_theme track_rfp_btn"><span>Track RFP</span></button>
                        </div>
                    </form>
                    
                    <div class="track_all_anchr text-right">
                        <a href="{{url('/user/trackAllRFP')}}" class="">Track All RFP Request</a>
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
                                                <th>Service Type:</th>
                                                <td>{{@$quotation['request_for_proposal_detail']['user_type_detail']['name']}}</td>
                                            </tr>
                                            <tr>
                                                <th>Main Category:</th>
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
                                                <td>{{ucfirst(@$quotation['user_detail']['contact_name'])}}</td>
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
                                            <!-- <tr>
                                                <th>Project Number:</th>
                                                <td>00DSA45997HJ</td>
                                            </tr> -->
                                            <tr>
                                                <th>Project Location:</th>
                                                <td>{{@$quotation['request_for_proposal_detail']['project_address']}}, {{@$quotation['request_for_proposal_detail']['project_city']}}, {{@$quotation['request_for_proposal_detail']['country_detail']['name']}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table tabl_rfp_botm table-bordered">
                                        <thead>
                                            <th>History of Action</th>
                                            <th>Date of Action</th>
                                            <th>Remarks</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Invitation Accepted by Provider</td>
                                                <td>16-06-2019</td>
                                                <td>--</td>
                                            </tr>
                                            <tr>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    @endif
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