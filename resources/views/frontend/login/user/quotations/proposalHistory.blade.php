@extends('frontend.layout.layout')
@section('title','Proposal History')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proposal History</li>
            </ol>
        </nav>
    </div>
    <section class="quot_page_sec">
        <div class="custom_container">
            <div class="wrp_quot_lst">
                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <div class="quot_main_rgt">
                            <div class="fltr_topp d-flex align-items-center">
                                <div class="section-heading">
                                    <span>Previous Proposal Details</span>
                                    <h2>Proposal History</h2>
                                </div>
                            </div>
                            <div class="wrap_quot_main">
                                @if(isset($quotations) && sizeof($quotations)>0)
                                    @foreach($quotations as $key => $quotation)
                                        @if(!empty($quotation))
                                            <div class="single_list_desgnr">
                                                <div class="prop_hist">
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <div class="left_info_dsgnr">
                                                                <h3 class="req_tle">{{@$quotation['requestForProposalDetail']['request_title']}}</h3>
                                                                <!-- <p><strong>Request Title:</strong> +91 95786 65431</p> -->
                                                                <p><strong>Project Name:</strong> {{@$quotation['requestForProposalDetail']['project_name']}}</p>
                                                                <p><strong>RFQ Id:</strong> {{@$quotation['project_request_no']}}</p>
                                                                <p><strong>Submission Deadline:</strong> {{date('M d, Y', strtotime($quotation['requestForProposalDetail']['proposal_submission_deadline_date']))}} {{date('h:iA', strtotime($quotation['requestForProposalDetail']['proposal_submission_deadline_time']))}}</p>
                                                                <p><strong>Question Submission Deadline:</strong> {{date('M d, Y', strtotime($quotation['requestForProposalDetail']['questions_submission_deadline_date']))}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 sm_div">
                                                            <div class="vw_btn">
                                                                <p><i><small>Proposal Revision Date: {{date('d/M/Y', strtotime($quotation['requestForProposalDetail']['created_at']))}}</small></i></p>
                                                                <a href="{{url('/user/reviewProposalRequestDetail/'.base64_encode($quotation['id']))}}">
                                                                    <p class="pdf_txt cp"><span><i class="fa fa-file-pdf-o"></i> Click to view</span></p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- <div class="chngs_updt">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                                    <ul>
                                                        <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
                                                        <li>Ipsum consectetur amet, consectetur adipisicing elit</li>
                                                        <li>Dolor sit amet, consectetur adipisicing elit</li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="numbr_pagintn mt-3">
                                    {{ $quotations->links() }}
                                </div>
                                <!-- <div class="single_list_desgnr">
                                    <p><i><small>Proposal Revision Date: 30/Feb/2020</small></i></p>
                                    <p class="pdf_txt cp"><span><i class="fa fa-file-pdf-o"></i> Click to view</span></p>
                                    <div class="chngs_updt">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <ul>
                                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
                                            <li>Ipsum consectetur amet, consectetur adipisicing elit</li>
                                            <li>Dolor sit amet, consectetur adipisicing elit</li>
                                        </ul>
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
    </section>
@stop
@section('script')

@stop