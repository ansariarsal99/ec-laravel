@extends('frontend.layout.layout')
@section('title','Edit Profile')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
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
                            <h4>Edit Profile</h4>
                            <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                        </div>
                        <div class="main_cntnt_dash">
                            <div class="card edit_prof_dash">
                                <div class="text-right log_btn">
                                    <a href="{{url('/user/changePassword')}}" class="btn btn_theme btn_edit"><span>Change Password</span></a>
                                </div>
                                <div class="cont_shd_frm">
                                    <div class="row">
                                        <div class="col-sm-10 offset-1">
                                            <form class="editProfileForm" enctype="multipart/form-data" method="POST" action="{{url('/user/editProfile')}}">
                                                @csrf
                                                <div class="text-center img_user">
                                                    <div class="pos_rel pic_top">
                                                        <span class="img_edtt pos_rel">
                                                            @if(Auth::check() && !empty(Auth::user()->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                                                                <img src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="img-fluid" id="prof_ch">
                                                            @else
                                                                <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" id="prof_ch">
                                                            @endif
                                                            <span class="edt_inpt">
                                                                <i class="fa fa-edit"></i>
                                                                <input type="file" name="profile_image" class="file_img">
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group text-left">
                                                            <label>User type</label>
                                                            <select name="user_type_id" disabled="" class="form-control custom-select">
                                                                <!-- <option value="" selected>Choose User Type</option> -->
                                                                @foreach($userTypes as $key => $userType)
                                                                    <option @if($user['user_type_id']==$userType['id']) selected="" @endif value="{{$userType['id']}}">{{$userType['name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Membership ID</label>
                                                            <input type="text" disabled="true" class="form-control" value="{{@$user['supplier_code']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($user['user_type_id']==1)
                                                    <div class="row">
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" name="first_name" class="form-control" value="{{@ucfirst($user['first_name'])}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" name="last_name" class="form-control" value="{{@ucfirst($user['last_name'])}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Institution Name</label>
                                                                <input type="text" name="institution_name" class="form-control" value="{{@$user['institution_name']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Owner First Name</label>
                                                                <input type="text" name="first_name" class="form-control" value="{{@ucfirst($user['first_name'])}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Owner Last Name</label>
                                                                <input type="text" name="last_name" class="form-control" value="{{@ucfirst($user['last_name'])}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>CR NUmber</label>
                                                                <input type="text" name="cr_number" class="form-control" value="{{@$user['cr_number']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Website Url</label>
                                                                <input type="text" name="website_url" class="form-control" value="{{@$user['website_url']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <!-- <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Type of User</label>
                                                            <select name="city" class="custom-select form-control">
                                                                <option data-display="Select Country">Individual</option>
                                                                <option value="1">Institution</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Contact Number</label>
                                                            <input type="email" disabled="true" class="form-control" value="{{@$user['isd_code']}} {{@$user['mobile_no']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input type="email" name="email" class="form-control" value="{{@$user['email']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Unit No.</label>
                                                            <input type="text" class="form-control" value="352">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Floor</label>
                                                            <input type="text" class="form-control" value="4">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Building</label>
                                                            <input type="text" class="form-control" value="Avenue Park">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Street No.</label>
                                                            <input type="text" class="form-control" value="12">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="nice_selc">
                                                                <label>Country</label>
                                                                <select name="city" class="custom-select form-control">
                                                                    <option data-display="Select Country">India</option>
                                                                    <option value="1">India</option>
                                                                    <option value="2">Africa</option>
                                                                    <option value="3">Australia</option>
                                                                    <option value="4">United Kingdom</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="nice_selc">
                                                                <label>City</label>
                                                                <select name="city" class="custom-select form-control">
                                                                    <option data-display="Select City">Banglore</option>
                                                                    <option value="1">Banglore</option>
                                                                    <option value="2">Jalandhar</option>
                                                                    <option value="3">Jalandhar</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Area Pincode</label>
                                                            <input type="text" class="form-control" value="165489">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d231315.11879429023!2d54.91364566917369!3d25.05786214558978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f14d60045b819%3A0xd9b8653e942019a9!2sPalm%20Islands%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1593423529009!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="form-group">
                                                    <div class="text-right log_btn">
                                                        <a href="" class="btn btn_theme edt_prof_sbmt_btn"><span>Update Changes</span></a>
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
    $('.file_img').on('change', function () {
        var input = this;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('prof_ch');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.editProfileForm').validate({
            ignore:[],
            rules:{
                first_name:{
                    required:true,
                    maxlength:50,
                    noSpace:true
                },
                last_name:{
                    required:true,
                    maxlength:50,
                    noSpace:true
                },
                email:{
                    required:true,
                    maxlength:100,
                    regex: email_regex,
                    remote: "{{url('/checkUserEmail')}}"+"?user_id={{base64_encode($user['id'])}}",
                },
                institution_name: {
                    // required: {
                    //     depends: function () {
                    //         return $('.usr_type_cls').val() == "2";
                    //     }
                    // },
                    required:true,
                    maxlength:50
                },
                cr_number: {
                    // required: {
                    //     depends: function () {
                    //         return $('.usr_type_cls').val() == "2";
                    //     }
                    // },
                    required:true,
                    maxlength:50
                },
                website_url: {
                    // required: {
                    //     depends: function () {
                    //         return $('.usr_type_cls').val() == "2";
                    //     }
                    // },
                    required:true,
                    maxlength:50
                },
            },
            messages:{
                first_name:{
                    required:"Please enter first name",
                    maxlength:"Maximum 50 characters are allowed",
                },
                last_name:{
                    required:"Please enter last name",
                    maxlength:"Maximum 50 characters are allowed",
                },               
                institution_name:{
                    required:"Please enter institution name",
                    maxlength:"Maximum 50 characters are allowed",
                },        
                cr_number:{
                    required:"Please enter cr number",
                    maxlength:"Maximum 50 characters are allowed",
                },           
                website_url:{
                    required:"Please enter website url",
                    maxlength:"Maximum 50 characters are allowed",
                },
                email:{
                    required:"Please enter email",
                    maxlength:"Maximum 100 characters are allowed",
                    regex: "Please enter valid email address",
                    remote: 'Email-id already registered',
                }, 
            }
        });

        $("body").on('click','.edt_prof_sbmt_btn',function(e){
            e.preventDefault();
            // alert('here');
            $('.editProfileForm').submit();
        });
    });
</script>
@stop