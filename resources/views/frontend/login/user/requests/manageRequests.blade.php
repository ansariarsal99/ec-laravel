@extends('frontend.layout.layout')
@section('title','Manage Requests')
@section('content')
<style>
    /*.non_edtble .custom-control{
        display: inline-block;
    }
    .req_btns{
        margin-top: 30px;
    }
    .chat_icons i{
        font-size: 18px;    
    }*/
</style>
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Requests</li>
                <li class="breadcrumb-item active" aria-current="page">Manage Requests</li>
            </ol>
        </nav>
    </div>
    <section class="all_rfpreq_page_sec">
        <div class="custom_container">
            <div class="wrp_allrfp_req">
                <div class="fltr_topp d-flex align-items-center">
                    <div class="section-heading">
                        <!-- <span>All RFP Request</span> -->
                        <h2>Manage Requests</h2>
                    </div>
                </div>
                <p class="sub_ttl mb-2"><span class="text-danger font-weight-bold">Request Detail</span></p>
                <!-- <div class="fltr_topp d-flex justify-content-end align-items-center mb-3">
                    <div class="dropdown">
                        <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
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
                </div> -->
                <div class="table_all_rfp_data">
                    <div class="table-responsive mb-5">
                        <table class="table tabl_allrfp_botm table-bordered">
                            <thead class="non_edtble">
                                <tr>
                                    <th rowspan="2">Request ID</th>
                                    <th rowspan="2">Request Title</th>
                                    <th rowspan="2">Project Name</th>
                                    <th rowspan="2">Project No.</th>
                                    <th rowspan="2">Project City</th>
                                    <th rowspan="2">Type of Services</th>
                                    <th rowspan="2">Category</th>
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2">Number of Invitees</th>
                                    <th rowspan="2">Date of Invitation</th>
                                    <th colspan="2">Submission Deadline</th>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>Remaining Days</th>
                                </tr>
                            </thead>
                            <tbody class="non_edtble">
                                <tr>
                                    <td>{{@$request['request_no']}}</td>
                                    <td>{{@$request['request_title']}}</td>
                                    <td>{{@$request['project_name']}}</td>
                                    <td>{{@$request['project_no']}}</td>
                                    <td>{{@$request['project_city_name']}}</td>
                                    <td>{{@$service}}</td>
                                    <td>{{@$request['user_type']}}</td>
                                    @if($request['request_for_proposal_status_id']==1)
                                        <td class="bg-primary">{{@$request['request_for_proposal_status_name']}}</td>
                                    @elseif($request['request_for_proposal_status_id']==2)
                                        <td class="bg-danger">{{@$request['request_for_proposal_status_name']}}</td>
                                    @elseif($request['request_for_proposal_status_id']==3)
                                        <td class="bg-dark">{{@$request['request_for_proposal_status_name']}}</td>
                                    @elseif($request['request_for_proposal_status_id']==4)
                                        <td class="bg-warning">{{@$request['request_for_proposal_status_name']}}</td>
                                    @elseif($request['request_for_proposal_status_id']==5)
                                        <td class="bg-success">{{@$request['request_for_proposal_status_name']}}</td>
                                    @else
                                        <td class="bg-primary">{{@$request['request_for_proposal_status_name']}}</td>                                    
                                    @endif
                                    <td>{{@$noOfInvitees}}</td>
                                    <td>{{@date('d/m/Y', strtotime($request['created_at']))}}</td>
                                    <td>{{@date('d/m/Y', strtotime($request['proposal_submission_deadline_date']))}}</td>
                                    <td>{{@$days}}</td>
                                </tr>
                                <!-- <tr>
                                    <td>BM-CT-RFP-5241</td>
                                    <td>Wood Works</td>
                                    <td>Hospital A</td>
                                    <td>KKLJ24</td>
                                    <td>Riyadh</td>
                                    <td>Contractor</td>
                                    <td>Architectural Works</td>
                                    <td class="bg-danger">Under Progress</td>
                                    <td>2</td>
                                    <td>01/07/2019</td>
                                    <td>25/07/2019</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>BM-CT-RFP-5241</td>
                                    <td>Wood Works</td>
                                    <td>Hospital A</td>
                                    <td>KKLJ24</td>
                                    <td>Riyadh</td>
                                    <td>Contractor</td>
                                    <td>Architectural Works</td>
                                    <td class="bg-dark">Time Over</td>
                                    <td>2</td>
                                    <td>01/07/2019</td>
                                    <td>25/07/2019</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>BM-CT-RFP-5241</td>
                                    <td>Wood Works</td>
                                    <td>Hospital A</td>
                                    <td>KKLJ24</td>
                                    <td>Riyadh</td>
                                    <td>Contractor</td>
                                    <td>Architectural Works</td>
                                    <td class="bg-warning">Cancelled</td>
                                    <td>2</td>
                                    <td>01/07/2019</td>
                                    <td>25/07/2019</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>BM-CT-RFP-5241</td>
                                    <td>Wood Works</td>
                                    <td>Hospital A</td>
                                    <td>KKLJ24</td>
                                    <td>Riyadh</td>
                                    <td>Contractor</td>
                                    <td>Architectural Works</td>
                                    <td class="bg-success">Closed</td>
                                    <td>2</td>
                                    <td>01/07/2019</td>
                                    <td>25/07/2019</td>
                                    <td>10</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                        <div class="invt_tble">
                            <p class="sub_ttl mb-2"><span class="text-danger font-weight-bold">Invitee Detail</span></p>
                            <div class="table-responsive">
                                <table class="table tabl_allrfp_botm table-bordered" id="rfpTable">
                                    <thead class="non_edtble">
                                        <tr>
                                            <th rowspan="2">Select All <br />
                                                <form>
                                                    <div class="custom-control custom-checkbox text-center">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck_tbl" name="example1">
                                                        <label class="custom-control-label" for="customCheck_tbl"></label>
                                                    </div>
                                                </form> 
                                            </th>
                                            <th>Invitee Name</th>
                                            <th>RFP ID</th>
                                            <th>Status</th>
                                            <th>Chatting Center</th>
                                            <th>Document Center</th>
                                        </tr>
                                    </thead>
                                    <tbody class="non_edtble">
                                        @if(isset($requestForProposalAssignToUsers) && sizeof($requestForProposalAssignToUsers)>0)
                                            @foreach($requestForProposalAssignToUsers as $key => $requestForProposalAssignToUser)
                                                @if(!empty($requestForProposalAssignToUser))
                                                    <tr>
                                                        <td>
                                                            <form>
                                                                <div class="custom-control custom-checkbox text-center">
                                                                    <input type="checkbox" class="custom-control-input rfp_chek" id="customCheck_tbl{{$requestForProposalAssignToUser['id']}}" data-id="{{$requestForProposalAssignToUser['id']}}" name="example1">
                                                                    <label class="custom-control-label" for="customCheck_tbl{{$requestForProposalAssignToUser['id']}}"></label>
                                                                </div>
                                                            </form> 
                                                        </td>
                                                        <td>{{ucfirst(@$requestForProposalAssignToUser['user_detail']['contact_name'])}} {{ucfirst(@$requestForProposalAssignToUser['user_detail']['contact_last_name'])}}</td>
                                                        <td>{{ucfirst(@$requestForProposalAssignToUser['project_request_no'])}}</td>
                                                        @if(@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_id']==1)
                                                            <td class="bg-secondary">{{@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_detail']['name']}}</td>
                                                        @elseif(@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_id']==2)
                                                            <td class="bg-dark">{{@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_detail']['name']}}</td>
                                                        @elseif(@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_id']==3)
                                                            <td class="bg-info">{{@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_detail']['name']}}</td>
                                                        @elseif(@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_id']==4)
                                                            <td class="bg-primary">{{@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_detail']['name']}}</td>
                                                        @elseif(@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_id']==5)
                                                            <td class="bg-warning">{{@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_detail']['name']}}</td>
                                                        @elseif(@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_id']==6)
                                                            <td class="bg-success">{{@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_detail']['name']}}</td>
                                                        @elseif(@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_id']==7)
                                                            <td class="bg-danger">{{@$requestForProposalAssignToUser['request_for_proposal_assign_to_user_status_detail']['name']}}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td class="chat_icons">
                                                            <a href="javascript:;" class="text-danger mr-2"><i class="fa fa-comment"></i></a>
                                                            <a href="javascript:;" class="text-danger ml-2"><i class="fa fa-paperclip"></i></a>
                                                        </td>
                                                        <td class="chat_icons">
                                                            <a href="{{url('/user/requestDocumentCenter/'.base64_encode(@$requestForProposalAssignToUser['id']))}}" class="text-danger"><i class="fa fa-file"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <!-- <div class="table-responsive">
                        <table class="table tabl_allrfp_botm table-bordered">
                            <thead class="non_edtble">
                                <tr>
                                    <th>SN</th>
                                    <th>Document Type</th>
                                    <th>Date of Add</th>
                                    <th>Attachment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="non_edtble">
                                <tr>
                                    <td>1</td>
                                    <td>RFP</td>
                                    <td>14/07/2019</td>
                                    <td class="chat_icons">
                                        <a href="javascript:;" class="text-danger"><i class="fa fa-file"></i></a>
                                    </td>
                                    <td class="chat_icons">
                                        <a href="javascript:;" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                    @if($noOfInvitees>0)
                        <div class="req_btns">
                            <ul type="none" class="d-flex justify-content-between">
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme cncl_rfp"><span>Cancel Request</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme"><span>Send Message for selected invitee</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme del_rfp"><span>Delete Request</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme rjct_rfp"><span>Reject Proposal</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme acpt_rfp"><span>Accept Proposal</span></a>
                                    </div>
                                </li>
                            </ul>
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
        $("body").on('click','#customCheck_tbl',function(){
            var providerIds = [];
             // alert($(this).is(":checked"));
            if ($(this).is(":checked")) {
                $(this).closest('#rfpTable').find('.rfp_chek').prop('checked',true);
                isChecked = 'yes';
            }else{
                $(this).closest('#rfpTable').find('.rfp_chek').prop('checked',false);
                isChecked = 'no';
            }

            $(this).closest('#rfpTable').find('.rfp_chek').each(function(){
                thsId = $(this).data('id');
                providerIds.push(thsId);
            });
        });

        $("body").on('click','.cncl_rfp',function(){
            // alert($('.rfp_chek:checked').length);
            if ($('.rfp_chek:checked').length>0) {
                var ids = [];
                $('#rfpTable').find('.rfp_chek:checked').each(function(){
                    thsId = $(this).data('id');
                    ids.push(thsId);
                });
                // alert(ids);
                swal({
                  title: 'Are you sure you want to cancel the selected requests ?',
                  text: "You won't be able to revert this!",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, cancel it!',
                  cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        $('.loader').show();
                        $.ajax({
                            url:"{{url('user/requestForProposalAssignToUser/cancel')}}",
                            type:"POST",
                            data:{ids:ids},
                            success:function(resp){
                                $('.loader').hide();
                                if (resp.status=='success') {
                                    Swal.fire(
                                      'Cancelled!',
                                      'Requests has been cancelled.',
                                      'success'
                                    )
                                    window.location.replace("{{url('/user/manageRequest/'.$encReqId)}}");
                                }else{
                                    swal('Oops, Something went wrong');
                                }
                            },
                            error:function(){
                                $(".loader").hide();
                                swal('Oops, Something went wrong');
                            }
                        });
                    }
                }) 
            }else{
                swal('Please select the request');
            }
        });

        $("body").on('click','.rjct_rfp',function(){
            // alert($('.rfp_chek:checked').length);
            if ($('.rfp_chek:checked').length>0) {
                var ids = [];
                $('#rfpTable').find('.rfp_chek:checked').each(function(){
                    thsId = $(this).data('id');
                    ids.push(thsId);
                });
                // alert(ids);
                swal({
                  title: 'Are you sure you want to reject the selected requests ?',
                  text: "You won't be able to revert this!",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, reject it!',
                  cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        $('.loader').show();
                        $.ajax({
                            url:"{{url('user/requestForProposalAssignToUser/reject')}}",
                            type:"POST",
                            data:{ids:ids},
                            success:function(resp){
                                $('.loader').hide();
                                if (resp.status=='success') {
                                    Swal.fire(
                                      'Rejected!',
                                      'Requests has been rejected.',
                                      'success'
                                    )
                                    window.location.replace("{{url('/user/manageRequest/'.$encReqId)}}");
                                }else{
                                    swal('Oops, Something went wrong');
                                }
                            },
                            error:function(){
                                $(".loader").hide();
                                swal('Oops, Something went wrong');
                            }
                        });
                    }
                }) 
            }else{
                swal('Please select the request');
            }
        });

        $("body").on('click','.acpt_rfp',function(){
            // alert($('.rfp_chek:checked').length);
            if ($('.rfp_chek:checked').length>0) {
                var ids = [];
                $('#rfpTable').find('.rfp_chek:checked').each(function(){
                    thsId = $(this).data('id');
                    ids.push(thsId);
                });
                // alert(ids);
                swal({
                  title: 'Are you sure you want to accept the selected requests ?',
                  text: "You won't be able to revert this!",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, accept it!',
                  cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        $('.loader').show();
                        $.ajax({
                            url:"{{url('user/requestForProposalAssignToUser/accept')}}",
                            type:"POST",
                            data:{ids:ids},
                            success:function(resp){
                                $('.loader').hide();
                                if (resp.status=='success') {
                                    Swal.fire(
                                      'Accepted!',
                                      'Requests has been accepted.',
                                      'success'
                                    )
                                    window.location.replace("{{url('/user/manageRequest/'.$encReqId)}}");
                                }else{
                                    swal('Oops, Something went wrong');
                                }
                            },
                            error:function(){
                                $(".loader").hide();
                                swal('Oops, Something went wrong');
                            }
                        });
                    }
                }) 
            }else{
                swal('Please select the request');
            }
        });

        $("body").on('click','.del_rfp',function(){
            // alert($('.rfp_chek:checked').length);
            if ($('.rfp_chek:checked').length>0) {
                var ids = [];
                $('#rfpTable').find('.rfp_chek:checked').each(function(){
                    thsId = $(this).data('id');
                    ids.push(thsId);
                });
                // alert(ids);
                swal({
                  title: 'Are you sure you want to delete the selected requests ?',
                  text: "You won't be able to revert this!",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:"{{url('user/requestForProposalAssignToUser/delete')}}",
                            type:"POST",
                            data:{ids:ids},
                            success:function(resp){
                                $('.loader').hide();
                                if (resp.status=='success') {
                                    Swal.fire(
                                      'Deleted!',
                                      'Requests has been deleted.',
                                      'success'
                                    )
                                    window.location.replace("{{url('/user/manageRequest/'.$encReqId)}}");
                                }else{
                                    swal('Oops, Something went wrong');
                                }
                            },
                            error:function(){
                                $(".loader").hide();
                                swal('Oops, Something went wrong');
                            }
                        });
                    }
                }) 
            }else{
                swal('Please select the request');
            }
        });
    });
</script>
@stop