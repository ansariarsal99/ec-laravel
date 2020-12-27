<div class="modal fade modal_fit" id="for_pwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('public/frontend/img/forpwd.png')}}" class="img-fluid for_img pb-4" />
                    <p class="text-center emmob">Enter Registered Email</p>
                    <div class="from_reset">
                        <form id="forgotPassForm" action="{{url('/forgotPassword')}}" method="POST" role="form">
                            @csrf
                            <div class="col-sm-12">
                                <div class="clearfix text-left">
                                    <input type="text" name="email" class="form-control" value="" placeholder="Email" />
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary forgot_pass_sbmt_btn">Submit</button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#forgotPassForm').validate({
            rules:{
                email:{
                    required:true,
                    maxlength:100,
                    regex: email_regex,
                }
            },
            messages:{
                email:{
                    required:"Please enter email",
                    maxlength:"Maximum 100 characters are allowed",
                    regex: "Please enter valid email address",
                }
            }
        });

        $("body").on('click','.forgot_pass_sbmt_btn',function(){
            $('#forgotPassForm').submit();
        });
    });
</script>
@endpush