@extends('frontend.layout.layout')
@section('title','Reset Password')
@section('content')
    <section class="logiN_sec">
        <div class="custom_container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-sm-12">
                    <div class="card chng_pswd_dash">
                        <div class="rest_pwd_link">
                            <div class="row">
                                <div class="col-sm-10 offset-1">
                                    <form class="" method="POST" action="{{url('/resetPassword/'.$encKey.'/'.$encUserId)}}" id="resetPassForm">
                                        @csrf
                                        <div class="row">
                                            <label class="col-sm-4">New Password</label>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input id="password" type="password" name="password" class="form-control" placeholder="New Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4">Confirm New Password</label>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-right log_btn">
                                                <a href="javascript:;" class="btn btn_theme updt_pass_btn"><span>Update Password</span></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#resetPassForm').validate({
            rules:{
                password:{
                    required:true,
                    minlength:6,
                    maxlength:50
                },
                confirm_password:{
                    required:true,
                    equalTo:"#password"
                },
            },
            messages:{
                password:{
                    required:"Please enter password",
                    maxlength:"Maximum 50 characters are allowed",
                    minlength:"Password must contain atleast 6 characters",
                },
                confirm_password:{
                    required: "Please re-enter password",
                    equalTo: "Confirm password did not match with password"
                },
            }
        });

        $("body").on('click','.updt_pass_btn',function(){
            $('#resetPassForm').submit();
        });
    });
</script>
@stop