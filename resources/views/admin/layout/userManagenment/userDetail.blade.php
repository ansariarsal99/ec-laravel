<?php  
    if (!empty(Auth::guard('admin')->user()['image'])) {
        $imgpath= userProfileImageBasePath.'/'.$userdata['profile_image'];    
    }                                                                                        
    if(!empty(Auth::guard('admin')->user()['image']) && file_exists($imgpath) ) { 
        // dd($imgpath);
        $admin_image = userProfileImagePath.'/'.$userdata['profile_image'];    
    }else{
        $admin_image = defaultAdminImagePath.'/no_image.png';  
        // dd($admin_image);
    }                                           
?> 

@extends('admin.layout.adminLayout')
@section('title','User List')
@section('content')

 @include('admin.include.header')
    <!-- Sidebar menu-->
    @include('admin.include.sidebar')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>User Management</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">User Management</a></li>
                                <li class="active">User Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      
    <div class="content">
        <div class="animated fadeIn">  
            <form method="post" id="termForm" action="" enctype="multipart/form-data">

              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title">User Detail</strong>
                    </div>
                    <input type="hidden" value="{{@$userdata->id}}" name="id">
                     
                       <div class="row">


                       <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>
                                    <div class="form-group">
                                        <div class="text-center img_prof user-img" id="admin_img">
                                           <img src="{{ $admin_image }}" id="" name="image" value="{{@$userdata['profile_image']}}" class="img-fluid user-img">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <input readonly=""   class="form-control mb-2" id="title" name="user_type" placeholder="Please enter title" type="text"  value="{{@$userdata->user_type}}">
                                    </div>

                                    <div class="form-group">
                                         <label>First Name</label>
                                           <input readonly=""  class="form-control mb-2" name="first_name" placeholder="Please enter description" value="{{@$userdata->first_name}}" type="text">
                                       
                                    </div>

                                    <div class="form-group">
                                         <label>Last Name</label>
                                           <input readonly="" class="form-control mb-2" rows="4" name="last_name" placeholder="Please enter description" value="{{@$userdata->last_name}}"type="text">
                                    </div>

                                    <div class="form-group">
                                         <label>Email</label>
                                          <input readonly=""  class="form-control mb-2" name="email" placeholder="Please enter description" value="{{@$userdata->email}}" type="text">
                                    </div>

                                    <div class="form-group">
                                         <label>Mobile no</label>
                                           <input readonly="" class="form-control mb-2" name="mobile_no" placeholder="Please enter description" value="{{@$userdata->mobile_no}}" type="text">
                                    </div>

                                    <div class="form-group">
                                         <label>Otp Verify Status</label>
                                           <input readonly="" class="form-control mb-2" name="otp_verify_status" placeholder="Please enter description" value="{{@$userdata->otp_verify_status}}" type="text">
                                    </div>
                                  
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>               
        </div> 
    </div>      
@stop

@section('script')

<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('.user-img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#botonAjax").change(function() {
      readURL(this);
    });
</script>

@stop