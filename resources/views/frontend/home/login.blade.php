@extends('frontend.layout.layout')
@section('title','Login')
@section('content')
    <section class="logiN_sec">
        <div class="custom_container">
            <div class="wrap_inr_login">
                <div class="row">
                    <div class="col-md-5">
                        <div class="rgt_info text-center d-flex flex-column justify-content-center">
                            <h2>NEW CUSTOMERS</h2>
                            <p>By creating an account with Mawad Mart, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <p class="alrdy">Don't have an account?</p>                            
                            <a href="{{url('signUp')}}" class="d-flex flex-column justify-content-center"><button class="btn btn_theme"><span>Sign up</span></button></a>
                        </div>
                    </div>  
                    <div class="col-md-7">  
                        <div class="wrap_login_form">
                            <section class="login_sec bsns_dtl">
                                <div class="new_div_aded">
                                    <div class="section-heading">
                                        <span>Welcome Back!</span>
                                        <h2>Sign In</h2>
                                    </div>
                                    <div class="wrap_register_white">
                                        <form class="userLoginForm" action="{{url('/login')}}" method="POST">
                                            <div class="inr_signup left_info">
                                                @csrf
                                                <div class="cont_rp_form">
                                                    <!-- <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>User type</label>
                                                                <select name="user_type" class="form-control custom-select">
                                                                    <option value="" selected>Choose User Type</option>
                                                                    <option value="individual">Individual</option>
                                                                    <option value="institution">Institution</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>Email/Contact Number</label>
                                                                <input type="text" name="email" class="form-control" placeholder="Email/Contact Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>Password</label>
                                                                <input type="password" name="password" class="form-control" placeholder="Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group text-left">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember_me">
                                                                    <label class="custom-control-label" for="customCheck">Remember me</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 text-right">
                                                            <a class="" data-toggle="modal" data-target="#for_pwd"><i>Forgot Password?</i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button_nex_prev">
                                                <div class="">
                                                    <div class="form-group text-right">
                                                        <button class="btn btn_theme btn_nex login_sub_btn" href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    @include('frontend.include.modals.forgotPassword')
@stop
@section('script')

<script type="text/javascript">
    window.onload = function () {
        if (typeof history.pushState === "function") {
            history.pushState("jibberish", null, null);
            window.onpopstate = function () {
                history.pushState('newjibberish', null, null);           
            };
        }
        else {
            var ignoreHashChange = true;
            window.onhashchange = function () {
                if (!ignoreHashChange) {
                    ignoreHashChange = true;
                    window.location.hash = Math.random();                
                }
                else {
                    ignoreHashChange = false;   
                }
            };
        }
    };
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.userLoginForm').validate({
            ignore:[],
            rules:{
                user_type:{
                    required:true
                },
                email:{
                    required:true
                },
                password:{
                    required:true
                }
            },
            messages:{
                user_type:{
                    required:"Please select user type"
                },
                email:{
                    required:"Please enter email/contact number",
                },
                password:{
                    required:"Please enter password",
                }
            }
        });

        $("body").on('click','.login_sub_btn',function(){
            // alert('here');
            $('.userLoginForm').submit();
        });
    });
</script>
@stop