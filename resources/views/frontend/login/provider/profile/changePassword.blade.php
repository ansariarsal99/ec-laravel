@extends('frontend.layout.providerLayout')
@section('title','Change Password')
@section('content')
    <section class="outer_db_wraper db_seller_items_list">
        <div class="combine_side_main_slr_db d-flex">
            <div class="sidenav_seller_db">
                @include('frontend.include.providerSidebar')
            </div>
            <div class="main_seller_db item_list_seller_db">
                <section class="bread_top_sec">
                    <div class="db_container">
                        <div class="d-flex justify-content-between text-white pos_rel">
                            <div class="sid_controlr">
                                <i class="clos_sid fa fa-bars"></i>
                                <i class="opn_sid fa fa-times"></i>
                            </div>
                            <h3>Change Password</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Change Password</a></li>
                                    <!-- <li class="breadcrumb-item active">Item List</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </section>
                <div class="marg_over_bread">
                    <section class="item_list_sec p-0">
                        <div class="db_container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <section class="register_sec bsns_dtl">
                                                <div class="sec_heading text-center">
                                                    <h2>Change Password</h2>
                                                </div>
                                                <div class="main_cntnt_dash">
                                                    <div class="seler_card chng_pswd_dash">
                                                        <div class="cont_shd_frm">
                                                            <div class="row">
                                                                <div class="col-sm-10 offset-1">
                                                                    <form class="updatePasswordForm" method="POST" action="{{url('/provider/changePassword')}}">
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
                                                                                            <a href="{{url('/provider/editProfile')}}" class="btn btn_theme"><span>Previous</span></a>
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
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>                    
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