@extends('frontend.layout.layout')
@section('title','Change Password')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>
    </div>
    
    <section class="prof_dashboard padd_all_sec">
        <div class="container-fluid">
            <div class="row">                
                @include('frontend.include.userSidebar')
                <div class="col-sm-9">
                    <div class="mainside_wrap">
                        <div class="page_head">
                            <h4>Change Password</h4>
                            <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                        </div>
                        <div class="main_cntnt_dash">
                            <div class="card chng_pswd_dash">
                                <div class="cont_shd_frm">
                                    <div class="row">
                                        <div class="col-sm-10 offset-1">
                                            <form class="updatePasswordForm" method="POST" action="{{url('/user/changePassword')}}">
                                                @csrf
                                                <div class="row">
                                                    <label class="col-sm-4">Current Password</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-4">New Password</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input id="password" type="password" name="new_password" class="form-control" placeholder="New Password">
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
                                                <!-- <div class="form-group">
                                                    <div class="text-right log_btn">
                                                        <a href="javascript:;" class="btn btn_theme updt_pwd_btn"><span>Update Password</span></a>
                                                    </div>
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="pwd_chnge d-flex justify-content-between">
                                                            <div class="form-group">
                                                                <div class="text-right">
                                                                    <a href="{{url('/user/editProfile')}}" class="btn btn_theme"><span>Previous</span></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="text-right log_btn">
                                                                    <a href="javascript:;" class="btn btn_theme updt_pwd_btn"><span>Update Password</span></a>
                                                                </div>
                                                            </div>
                                                        </div>
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
            </div>
        </div>
    </section>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.updatePasswordForm').validate({
            ignore:[],
            rules:{
                current_password:{
                    required:true,
                    minlength:6,
                    maxlength:50
                },
                new_password:{
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
                current_password:{
                    required:"Please enter current password",
                    maxlength:"Maximum 50 characters are allowed",
                    minlength:"Password must contain atleast 6 characters",
                },
                new_password:{
                    required:"Please enter new password",
                    maxlength:"Maximum 50 characters are allowed",
                    minlength:"Password must contain atleast 6 characters",
                },
                confirm_password:{
                    required: "Please re-enter new password",
                    equalTo: "Confirm password did not match with new password"
                },
            }
        });

        $("body").on('click','.updt_pwd_btn',function(e){
            e.preventDefault();
            // alert('here');
            $('.updatePasswordForm').submit();
        });
    });
</script>
@stop