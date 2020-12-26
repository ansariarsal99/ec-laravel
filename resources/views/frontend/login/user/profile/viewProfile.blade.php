@extends('frontend.layout.layout')
@section('title','My Profile')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
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
                            <h4>My Profile</h4>
                            <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                        </div>
                        <div class="main_cntnt_dash">
                            <div class="card view_prof_dash">
                                <div class="text-right log_btn d-flex justify-content-between align-items-center">
                                    <span class="badge_new">{{@ucfirst($user['user_type_detail']['name'])}}</span>
                                    <a href="{{url('/user/editProfile')}}" class="btn btn_theme btn_edit"><span>Edit Profile</span>
                                    </a>
                                </div>
                                <div class="cont_shd_frm">
                                    <div class="row">
                                        <div class="col-sm-10 offset-1">
                                            <form>
                                                <div class="text-center img_user">
                                                    <div class="pos_rel pic_top">
                                                        @if(Auth::check() && !empty(Auth::user()->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                                                            <img src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="img-fluid" alt="">
                                                        @else
                                                            <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($user['user_type_id']==1)
                                                    <div class="row">
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" class="form-control" value="{{@ucfirst($user['first_name'])}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" class="form-control" value="{{@ucfirst($user['last_name'])}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Institution Name</label>
                                                                <input type="text" class="form-control" value="{{@$user['institution_name']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Contact Name</label>
                                                                <input type="text" class="form-control" value="{{@ucfirst($user['first_name'])}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label style="opacity: 0;" >Contact Name</label>
                                                                <input type="text" class="form-control" value="{{@ucfirst($user['last_name'])}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>CR Number</label>
                                                                <input type="text" class="form-control" value="{{@$user['cr_number']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Website Url</label>
                                                                <input type="text" class="form-control" value="{{@$user['website_url']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Membership ID</label>
                                                            <input type="text" class="form-control" value="{{@$user['supplier_code']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Contact Number</label>
                                                            <input type="email" class="form-control" value="{{@$user['isd_code']}} {{@$user['mobile_no']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input type="email" class="form-control" value="{{@$user['email']}}">
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
@stop