@extends('frontend.layout.layout')
@section('title','All RFP Requests')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">My Account</a></li>
                <li class="breadcrumb-item" aria-current="page">My Quotations</li>
                <li class="breadcrumb-item active" aria-current="page">Track All</li>
            </ol>
        </nav>
    </div>
    <section class="all_rfpreq_page_sec">
        <div class="custom_container">
            <div class="wrp_allrfp_req">
                <div class="fltr_topp d-flex align-items-center">
                    <div class="section-heading">
                        <!-- <span>All RFP Request</span> -->
                        <h2>Track All Quotations</h2>
                    </div>
                </div>
                <div class="fltr_topp d-flex justify-content-end align-items-center mb-3">
                    <div class="dropdown">
                      <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-sort"></i>&nbsp;Sort
                    </span>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:;">User Name Ascending</a>
                        <a class="dropdown-item" href="javascript:;">User Name Descending</a>
                        <a class="dropdown-item" href="javascript:;">RFQ Name Ascending</a>
                        <a class="dropdown-item" href="javascript:;">RFQ Name Descending</a>
                        <a class="dropdown-item" href="javascript:;">RFQ Price High to Low</a>
                        <a class="dropdown-item" href="javascript:;">RFQ Price Low to High</a>
                        <a class="dropdown-item" href="javascript:;">Recent Submission Date</a>
                    </div>
                </div>
            </div>
            <div class="table_all_rfp_data">
                <div class="table-responsive">
                    <table class="table tabl_allrfp_botm table-bordered">
                        <thead class="non_edtble">
                            <tr>
                                <th colspan="3">Reference</th>
                                <th rowspan="2">Service Type</th>
                                <th rowspan="2">Main Category</th>
                                <th rowspan="2">Status</th>
                                <th colspan="2">Status Since</th>
                                <th colspan="2">Date of Invitation</th>
                                <th colspan="2">Quotation Submision Deadline</th>
                                <th colspan="3">From (Client)</th>
                                <th colspan="4">To (Service Provider)</th>
                                <th rowspan="2">Project Name</th>
                                <th rowspan="2">Project No.</th>
                                <th rowspan="2">Project Location</th>
                            </tr>
                            <tr>
                                <th>Request</th>
                                <th>Provider</th>
                                <th>RFQ ID</th>
                                <th>Date of Action</th>
                                <th>Status Since</th>
                                <th>Date</th>
                                <th>Days since invitation</th>
                                <th>Date</th>
                                <th>Remaining Days</th>
                                <!-- <th>Name</th> -->
                                <th>Contact Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <!-- <th>Address</th> -->
                                <!-- <th>Name</th> -->
                                <th>Contact Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($quotations) && sizeof($quotations)>0)
                                @foreach($quotations as $key => $quotation)
                                    @if(!empty($quotation))
                                        <?php 
                                            $datetime = new DateTime();
                                            $ReqDate = new DateTime($quotation['request_for_proposal_detail']['created_at']);
                                            $ReqSubDate = new DateTime($quotation['request_for_proposal_detail']['proposal_submission_deadline_date']);
                                            $ReqDateInterval = $datetime->diff($ReqDate);
                                            $ReqDatedays = $ReqDateInterval->format('%a');//now do whatever you like with $days
                                            $ReqSubDateInterval = $datetime->diff($ReqSubDate);
                                            $ReqSubDatedays = $ReqSubDateInterval->format('%a');//now do whatever you like with $days
                                            // dd($datetime);
                                            if ($ReqSubDate>$datetime || $ReqSubDatedays==0) {
                                                $sign = "";
                                            }else{
                                                $sign = "-";
                                            }
                                        ?>
                                        <tr>
                                            <td>{{@$quotation['request_for_proposal_detail']['project_no']}}</td>
                                            <td>1</td>
                                            <td>{{@$quotation['project_request_no']}}</td>
                                            <td>{{@$quotation['request_for_proposal_detail']['user_type_detail']['name']}}</td>
                                            <td>
                                                @if(isset($quotation['request_for_proposal_detail']['request_for_proposal_services']) && sizeof($quotation['request_for_proposal_detail']['request_for_proposal_services'])>0)
                                                    @foreach($quotation['request_for_proposal_detail']['request_for_proposal_services'] as $key => $requestForProposalService)
                                                        @if(!empty($requestForProposalService))
                                                            @if($key==1) ,@endif {{$requestForProposalService['user_service_detail']['name']}} 
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="bg-primary">Waiting Acceptance by Vendor</td>
                                            <td>17/04/2019</td>
                                            <td>4</td>
                                            <td>{{date('d/m/Y', strtotime($quotation['request_for_proposal_detail']['created_at']))}}</td>
                                            <td>{{@$ReqDatedays}}</td>
                                            <td>{{date('d/m/Y', strtotime($quotation['request_for_proposal_detail']['proposal_submission_deadline_date']))}}</td>
                                            <td>{{$sign}}{{@$ReqSubDatedays}}</td>
                                            <!-- <td class="dbl_clk_edt">
                                                <input type="text" class="form-control" readonly/>
                                            </td> -->
                                            <td>
                                                {{ucfirst(@$quotation['request_for_proposal_detail']['user_detail']['first_name'])}} {{ucfirst(@$quotation['request_for_proposal_detail']['user_detail']['last_name'])}}
                                            </td>
                                            <td>
                                                {{@$quotation['request_for_proposal_detail']['user_detail']['isd_code']}} {{@$quotation['request_for_proposal_detail']['user_detail']['mobile_no']}}
                                            </td>
                                            <td>
                                                {{@$quotation['request_for_proposal_detail']['user_detail']['email']}}
                                            </td>
                                            <!-- <td>
                                                
                                            </td> -->
                                            <!-- <td>
                                               
                                            </td> -->
                                            <td>
                                                {{ucfirst(@$quotation['user_detail']['contact_name'])}}
                                            </td>
                                            <td>
                                                +{{@$quotation['user_detail']['isd_code']}} {{@$quotation['user_detail']['mobile_no']}}
                                            </td>
                                            <td>
                                                {{@$quotation['user_detail']['email']}}
                                            </td>
                                            <td>
                                                {{@$quotation['user_detail']['location']}}
                                            </td>
                                            <td>
                                                {{@$quotation['request_for_proposal_detail']['project_name']}}
                                            </td>
                                            <td>
                                                {{@$quotation['request_for_proposal_detail']['project_no']}}
                                            </td>
                                            <td>
                                                {{@$quotation['request_for_proposal_detail']['project_address']}}, {{@$quotation['request_for_proposal_detail']['project_city']}}, {{@$quotation['request_for_proposal_detail']['country_detail']['name']}}
                                            </td>
                                        </tr>                                        
                                    @endif
                                @endforeach
                            @endif
                            <!-- <tr>
                                <td>MM-DS-0001</td>
                                <td>2</td>
                                <td>MM-DS-0001-2</td>
                                <td>Consultant</td>
                                <td>Wooden Design</td>
                                <td class="bg-danger">Under Bidding by vendor</td>
                                <td>17/04/2019</td>
                                <td>4</td>
                                <td>12/11/2017</td>
                                <td>7</td>
                                <td>29/09/2018</td>
                                <td>-5</td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>MM-DS-0001</td>
                                <td>3</td>
                                <td>MM-DS-0001-3</td>
                                <td>Designer</td>
                                <td>Electrical Design</td>
                                <td class="bg-success">Quotation Submitted</td>
                                <td>17/04/2019</td>
                                <td>4</td>
                                <td>12/11/2017</td>
                                <td>7</td>
                                <td>29/09/2018</td>
                                <td>-5</td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>MM-DS-0001</td>
                                <td>4</td>
                                <td>MM-DS-0001-4</td>
                                <td>Contractor</td>
                                <td>Electrical Design</td>
                                <td class="bg-warning">Waiting Action by Client</td>
                                <td>17/04/2019</td>
                                <td>4</td>
                                <td>12/11/2017</td>
                                <td>7</td>
                                <td>29/09/2018</td>
                                <td>-5</td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>MM-DS-0001</td>
                                <td>5</td>
                                <td>MM-DS-0001-5</td>
                                <td>Consultant</td>
                                <td>Wooden Design</td>
                                <td class="bg-danger">Under Bidding by vendor</td>
                                <td>17/04/2019</td>
                                <td>4</td>
                                <td>12/11/2017</td>
                                <td>7</td>
                                <td>29/09/2018</td>
                                <td>-5</td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>MM-DS-0001</td>
                                <td>6</td>
                                <td>MM-DS-0001-6</td>
                                <td>Designer</td>
                                <td>Electrical Design</td>
                                <td class="bg-success">Quotation Submitted</td>
                                <td>17/04/2019</td>
                                <td>4</td>
                                <td>12/11/2017</td>
                                <td>7</td>
                                <td>29/09/2018</td>
                                <td>-5</td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>MM-DS-0001</td>
                                <td>7</td>
                                <td>MM-DS-0001-7</td>
                                <td>Consultant</td>
                                <td>Electrical Design</td>
                                <td class="bg-success">Quotation Submitted</td>
                                <td>17/04/2019</td>
                                <td>4</td>
                                <td>12/11/2017</td>
                                <td>7</td>
                                <td>29/09/2018</td>
                                <td>-5</td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                                <td class="dbl_clk_edt">
                                    <input type="text" class="form-control" readonly/>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')

@stop