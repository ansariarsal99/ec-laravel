@extends('frontend.layout.layout')
@section('title','My Requests')
@section('content')
<style>
    /*.non_edtble .custom-control{
        left: 20px;
    }
    .req_btns{
        margin-top: 30px;
    }*/
    .tabl_allrfp_botm td:nth-child(9) {
        padding: 0;
    }
    .tabl_allrfp_botm td:nth-child(9) > span{
        padding: 9px 10px 0;
        display: block;
        height: 40px;
        color: #fff;
    }
    .tabl_allrfp_botm td:nth-child(10) {
        padding: 0;
    }
    .tabl_allrfp_botm td:nth-child(10) > span{
        padding: 9px 10px 0;
        display: block;
        height: 40px;
        color: #fff;
    }
</style>
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Requests</li>
            </ol>
        </nav>
    </div>
    <section class="all_rfpreq_page_sec">
        <div class="custom_container">
            <div class="wrp_allrfp_req">
                <div class="fltr_topp d-flex align-items-center">
                    <div class="section-heading">
                        <!-- <span>All RFP Request</span> -->
                        <h2>My Requests</h2>
                    </div>
                </div>
                <!-- <div class="fltr_topp d-flex justify-content-end align-items-center mb-3">
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
                </div> -->
                <div class="table_all_rfp_data">
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
                                <!-- <tr>
                                    <td>
                                        <form>
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" class="custom-control-input" id="customCheck_tbl1" name="example1">
                                                <label class="custom-control-label" for="customCheck_tbl1"></label>
                                            </div>
                                        </form> 
                                    </td>
                                    <td>BM-CT-RFP-5241</td>
                                    <td>Wood Works</td>
                                    <td>Hospital A</td>
                                    <td>KKLJ24</td>
                                    <td>Riyadh</td>
                                    <td>Contractor</td>
                                    <td>Architectural Works</td>
                                    <td class="bg-primary">Not Yet Sent</td>
                                    <td>2</td>
                                    <td>01/07/2019</td>
                                    <td>25/07/2019</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>
                                        <form>
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" class="custom-control-input" id="customCheck_tbl1" name="example1">
                                                <label class="custom-control-label" for="customCheck_tbl1"></label>
                                            </div>
                                        </form> 
                                    </td>
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
                                    <td>
                                        <form>
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" class="custom-control-input" id="customCheck_tbl1" name="example1">
                                                <label class="custom-control-label" for="customCheck_tbl1"></label>
                                            </div>
                                        </form> 
                                    </td>
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
                                    <td>
                                        <form>
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" class="custom-control-input" id="customCheck_tbl1" name="example1">
                                                <label class="custom-control-label" for="customCheck_tbl1"></label>
                                            </div>
                                        </form> 
                                    </td>
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
                                    <td>
                                        <form>
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" class="custom-control-input" id="customCheck_tbl1" name="example1">
                                                <label class="custom-control-label" for="customCheck_tbl1"></label>
                                            </div>
                                        </form> 
                                    </td>
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
                    @if($myRequestCount>0)
                        <div class="req_btns">
                            <ul type="none" class="d-flex justify-content-between">
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme cncl_rfp"><span>Cancel Request</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme del_rfp"><span>Delete Request</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme chng_subm"><span>Change Submission Deadline</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="log_btn">
                                        <a href="javascript:;" class="btn btn_theme"><span>Send message for Invitees</span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>    
    @include('frontend.include.modals.requestForProposalChangeSubmissionDeadline')
@stop
@section('script')
<script>
    $(document).ready(function(){
        $(function() {
            // alert('here');
            var t = $('#rfpTable').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                ajax: '{{url('/user/myRequests/index')}}',
                columns: [
                    // { data: 'DT_RowIndex', name: 'id', searchable: false,  visible:true},                
                    // { data: 'exam_type_name', name: 'exam_types.name' },
                    { data: 'check_box', name: 'check_box', searchable: false,  visible:true, orderable:false },
                    { data: 'request_id', name: 'request_id' },
                    { data: 'request_title', name: 'request_title' },
                    { data: 'project_name', name: 'project_name' },
                    { data: 'project_no', name: 'project_no' },
                    { data: 'project_city_name', name: 'cities.name' },
                    { data: 'type_of_services', name: 'type_of_services' },
                    { data: 'user_type', name: 'user_types.name' },
                    { data: 'request_status', name: 'request_status' },
                    { data: 'no_of_invitees', name: 'no_of_invitees' },
                    { data: 'invitation_date', name: 'invitation_date' },
                    { data: 'submission_date', name: 'submission_date' },
                    { data: 'remaining_days', name: 'remaining_days' },
                    // { data: 'exam_paper_name', name: 'exam_papers.name' },
                    // { data: 'exam_paper_domain_name', name: 'exam_paper_domains.domain_name' },
                    // { data: 'exam_paper_sub_domain_name', name: 'exam_paper_sub_domains.sub_domain_name' },
                    // // { data: 'exam_type_name', name: 'exam_types.name' },
                    // { data: 'mark_for_mock', name: 'mark_for_mock', orderable:false }, 
                    // { data: 'status', name: 'status', orderable:false }, 
                    // { data: 'action', name: 'action', orderable:false },  
                ],
                // initComplete: function () {
                //     this.api().columns().every(function () {
                //         $('.searchable_table thead').after($('.searchable_table tfoot tr'))
                //         var column = this;
                //         var input = document.createElement("input");
                //         input.className = "tr_tfoot_input"
                //         $(input).appendTo($(column.footer()).empty())
                //         .on('keyup', function () {
                //             column.search($(this).val(), false, false, true).draw();
                //         });
                //     });
                // },
                // fnDrawCallback: function(){
                //     $('.status_button_toggle').each(function(i, e){
                //         // console.log($(this).attr('rel'));
                //         var attr_rel = $(this).attr('rel');
                //         var attr_ral = $(this).attr('ral');
                //         var attr_id = $(this).attr('id');
                //         $('#'+attr_id).btnSwitch({
                //             Theme: 'Light',
                //             ToggleState: attr_rel == 'active' ? true : false,
                //             OnCallback: function(val) {
                //                 changeStatus('active',attr_ral);
                //             },
                //             OffCallback: function(val) {
                //                 changeStatus('inactive',attr_ral);
                //             },
                //         });
                //     });
                // }
            });
        });

        // function changeStatus(status, id){
        //     // alert(status);
        //     $.ajax({
        //         url: "{{url('admin/generalManagement/question/changeStatus')}}",
        //         type:'post',
        //         data:{_token: "{{csrf_token()}}",id:id, status:status},
        //         dataType:'json',
        //         success:function(res){
        //             if(res.status == 'success'){
        //                 toastr.success(res.message);
        //             }else{
        //                 toastr.error(res.message);
        //             }
        //         },error(){
        //             toastr.error('Something went wrong');
        //         }
        //     })
        // }

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
                            url:"{{url('user/requestForProposal/cancel')}}",
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
                                    window.location.replace("{{url('/user/myRequests')}}");
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
                            url:"{{url('user/requestForProposal/delete')}}",
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
                                    window.location.replace("{{url('/user/myRequests')}}");
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

            // if (auth) {
                
            //     $.ajax({
            //         url:"{{url('/user/requestForProposal/providerAllCheck')}}",
            //         type: "post",
            //         data:{isChecked:isChecked,providerIds:providerIds},
            //         success:function(resp){
            //             $('.loader').hide();
            //             if (resp.status=='success') {
            //                 $(".quot_for_count").text(resp.selectedCount ? resp.selectedCount : '');
            //                 // alert('success');
            //                 // window.location.href= "{{url('enterOtp')}}"+"/"+resp.encUser;
            //             }else{
            //                 toastr.error('Oops, Something went wrong');
            //             }
            //         },
            //         error:function(){
            //             $(".loader").hide();
            //             swal('Oops, Something went wrong');
            //         }
            //     });
            // }
        });

        $("body").on('click','.chng_subm',function(){
            if ($('.rfp_chek:checked').length>0) {
                $('#subm_deadline_mod').modal('show');
            }else{
                swal('Please select the request');
            }
        });

        $('#datetimepicker6').datetimepicker({
            // format: 'L',
            minDate: moment(),
            // defaultDate: propSub,
            // ignoreReadonly: true
        });

        $('#changeSubmissionDeadlineForm').validate({
            rules:{
                proposal_submission_deadline_date:{
                    required:true
                }
            },
            messages:{
                proposal_submission_deadline_date:{
                    required:"Please select date"
                }
            },
            submitHandler: function (form) {
                var ids = [];
                $('#rfpTable').find('.rfp_chek:checked').each(function(){
                    thsId = $(this).data('id');
                    ids.push(thsId);
                });
                var sbmsn_deadline = $('.sbmsn_deadline').val();
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/changeSubmissionDeadline')}}",
                    type:"POST",
                    data:{ids:ids,submission_deadline:sbmsn_deadline},
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            Swal.fire(
                              'Changed!',
                              'Submission Deadline has been changed.',
                              'success'
                            )
                            window.location.replace("{{url('/user/myRequests')}}");
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
        });

        $("body").on('click','.chng_sbmsn_btn',function(){
            $('#changeSubmissionDeadlineForm').submit();
        });

    });
</script>

@stop