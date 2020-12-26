<!-- Use Card modal -->
<div class="modal fade edit_div" id="srch_providers_mod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Search Designers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card_info text-center">
                    <form id="addInviteeForm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control srch_prvdr" placeholder="Search {{@$userType['name']}}...">
                          </div>
                        <div class="provdr_listings">
                            <ul type="none" class="prvdr_list_cls">
                                <!-- <li>
                                    <div class="user_list d-flex justify-content-between align-items-center">
                                        <div class="list_info d-flex align-items-center">
                                            <figure class="m-0">
                                                <img src="{{asset('public/frontend/img/client3.jpg')}}" class="img-fluid">
                                            </figure>
                                            <h3 class="ml-3">John Doe</h3>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                            <label class="custom-control-label" for="customCheck"></label>
                                          </div>
                                    </div>
                                </li> -->
                            </ul>
                        </div> 
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_theme add_invitee_btn"><span>Submit</span></button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')
<!-- <script type="text/javascript">
    // alert('here');
    var SearchContent;
    $("body").on('keyup','.srch_prvdr',function(){
        // e.preventDefault();
        alert($(this).val());
        $.ajax({
            url:"{{url('user/requestForProposal/searchProviders')}}",
            type: "post",
            data:{ stepNo:stepNo, createRquestForProposalId:createRquestForProposalId },
            success:function(resp){
                $('.loader').hide();
                if (resp.status=='success') {
                    ths.closest('.repeted_div').hide();
                    ths.closest('.repeted_div').next().show();
                }else{
                    swal('Oops, Something went wrong');
                }
            },
            error:function(){
                $(".loader").hide();
                swal('Oops, Something went wrong');
            }
        });
    });
</script> -->
@endpush