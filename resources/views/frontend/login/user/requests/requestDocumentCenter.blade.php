@extends('frontend.layout.layout')
@section('title','Request Document Center')
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
                <li class="breadcrumb-item active" aria-current="page">Request Document Center</li>
            </ol>
        </nav>
    </div>
    <section class="all_rfpreq_page_sec">
        <div class="custom_container">
            <div class="wrp_allrfp_req">
                <div class="fltr_topp d-flex align-items-center">
                    <div class="section-heading">
                        <!-- <span>All RFP Request</span> -->
                        <h2>Request Document Center</h2>
                    </div>
                </div>
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
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p class="mb-0">Document Center of RFP ID: <span class="text-danger font-weight-bold">{{@$requestForProposalAssignToUser['project_request_no']}}</span></p>
                        <div class="log_btn" data-id="{{@$encReqAssignId}}">
                            <a href="javascript:;" class="btn btn_theme resp_quot"><span>Respond</span></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table tabl_allrfp_botm table-bordered">
                            <thead class="non_edtble">
                                <tr>
                                    <th>SN</th>
                                    <th>Sent By</th>
                                    <th>Comment</th>
                                    <th>Date of Add</th>
                                    <th>Attachment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="non_edtble">
                                @if(isset($respondAttachments) && sizeof($respondAttachments)>0)
                                    @foreach($respondAttachments as $key => $respondAttachment)
                                        @if(!empty($respondAttachment))
                                            <tr>
                                                <td>{{$key+1}}</td>
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
                                                <td class="chat_icons" data-id="{{base64_encode($respondAttachment['id'])}}">
                                                    @if($respondAttachment['user_id']==Auth::user()->id)
                                                        <a href="javascript:;" class="text-danger del_rsp"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach 
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.include.modals.respondToRFPQuotation')
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on('click','.resp_quot',function(){
            enc_req_id = $(this).parent().data('id');
            // alert(enc_req_id);
            $('.encReqIdCls').val($(this).parent().data('id'));
            $('#respond_to_rfp_quotation_mod').modal('show');
        });

        $("body").on('click','.del_rsp',function(){
            var encRespId = $(this).parent().data('id');
            swal({
              title: 'Are you sure you want to delete the attachment ?',
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
                        url:"{{url('/provider/quotation/respond/delete')}}"+"/"+encRespId,
                        type:"POST",
                        success:function(resp){
                            $('.loader').hide();
                            if (resp.status=='success') {
                                Swal.fire(
                                  'Deleted!',
                                  'Attachment has been deleted.',
                                  'success'
                                )
                                window.location.replace("{{url('/user/requestDocumentCenter/'.$encReqAssignId)}}");
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
        });

    });
</script>
@stop