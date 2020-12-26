

<?php  
    if (!empty($userdata['profile_image'])) {
        $imgpath= userProfileImageBasePath.'/'.$userdata['profile_image'];    
    }                                                                                        
    if(!empty($userdata['profile_image']) && file_exists($imgpath) ) { 
        // dd($imgpath);
        $admin_image = userProfileImagePath.'/'.$userdata['profile_image'];    
    }else{
        $admin_image = defaultAdminImagePath.'/no_image.png';  
        // dd($admin_image);
    }                                           
?>

<?php  
      
    $paymentDataSubscription = App\UserSubscriptionPayment::where('user_id',$id)->first();

    $subscriptionChoosen = App\UserSubscription::where('user_id',$id)->first();

    // dd($paymentDataSubscription);
        if (!empty($paymentDataSubscription['invoice_image'])) {
          
            if (file_exists(invoiceImageBasePath.'/'.$paymentDataSubscription['invoice_image'])) {
                $image = 'fa fa-file-pdf-o';
            }else{
                $image = defaultImagePath;
            }
        }else{
            $image = defaultImagePath;
        }
?>

@extends('admin.layout.adminLayout')
@section('title','All User Detail')
@section('content')

 @include('admin.include.header')
    <!-- Sidebar menu-->
    <style>
     
     .vwnew_btn span {
         display: inline-block;
         background: #6a5e95;
         padding: 10px 17px;
         color: #fff;
         border-radius: 6px;
          box-shadow: 0 0 10px -1px #6a5e95;
      }

      .bd_img img{
          width: 50px;
          object-fit: cover;
      }
    </style>



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
                                <li class="active">All User Detail</li>
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
                       <strong class="card-title">All User Detail</strong>
                    </div>
                    <input type="hidden" value="{{@$userdata->id}}" name="id">
                     
                   <div class="row">
                       <div class="col-lg-10 offset-lg-1">
                            <div class="terms_page view_prof_dash my-4">
                                <form>
                                    <div class="text-center  user-img vw_pro_img my-4" id="admin_img">
                                       <img src="{{ @$admin_image }}" id="" name="image" value="{{@$userdata['profile_image']}}" class="img-fluid user-img">
                                    </div>
                                    @if(@$userdata['certified_provider']=='yes')
                                    <div class="bd_img text-center ">
                                        <img src="{{asset('public/frontend/img/badge.png')}}" class="img-fluid">       
                                    </div>
                                    @endif<br>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                 <label>Company Name</label>
                                                   <input readonly=""  class="form-control mb-2" name="company_name" placeholder="Please enter description" value="{{@$userdata->company_name}}" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                 <label>Contact Name</label>
                                                   <input readonly="" class="form-control mb-2" rows="4" name="contact_name" placeholder="Please enter description" value="{{@$userdata->contact_name}}"type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input readonly=""  class="form-control mb-2" name="email" placeholder="Please enter description" value="{{@$userdata->email}}" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                 <label>Contact Number</label>
                                                   <input readonly="" class="form-control mb-2" name="mobile_no" placeholder="Please enter description" value="{{@$userdata->mobile_no}}" type="text">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Otp Verify Status</label>
                                                <input readonly="" class="form-control mb-2" name="otp_verify_status" placeholder="Please enter description" value="{{@$userdata->otp_verify_status}}" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Complete profile Status</label>
                                                <input readonly="" class="form-control mb-2" name="complete_profile" placeholder="Please enter description" value="{{@$userdata->complete_profile}}" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Subscription</label>
                                                <input readonly="" class="form-control mb-2" name="complete_profile" placeholder="Please enter description" value="{{@$subscriptionChoosen['title']}}" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    @if($paymentDataSubscription['payment_type']!='card')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Subscription payment slip</label><br>
                                                <div class="vwnew_btn">
                                                    <a href="{{asset(invoiceImageBasePath.'/'.$paymentDataSubscription['invoice_image'])}}" download><span><i class="fa fa-file-pdf-o {{$image}}"></i> Click to view</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    @endif

                                    @if($paymentDataSubscription['payment_type']=='card')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Subscription Payment Transaction Id</label><br>
                                                <input readonly="" class="form-control mb-2" name="complete_profile" placeholder="Please enter description" value="{{@$paymentDataSubscription['transaction_id']}}" type="text">
                                            </div>
                                        </div>
                                    </div>  
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Rating of Reviews</label>
                                                <input readonly="" class="form-control mb-2" name="complete_profile" placeholder="Please enter description" value="3.5 star" type="text">
                                            </div>
                                        </div>
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