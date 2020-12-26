@extends('frontend.layout.providerLayout')
@section('title','My Profile')
@section('content')
<style>
    /*.expry_plans{
    top: 27%;
    left: -28px;
    }
    .id_imgs{
    display: flex;
    flex-flow: row;
    flex-wrap: wrap;
    }
    .id_imgs img{
    width: 110px;
    object-fit: cover;
    margin-bottom: 7px;
    margin-right: 7px;
    }
    .custom-checkbox .custom-control-input:disabled:checked ~ .custom-control-label::before {
    background-color: rgba(225, 64, 47, 0.5);
    }*/
</style>
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
                        <h3>My Profile</h3>
                        <nav class="bread_nav_sec">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:;">Profile</a></li>
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
                                                <h2>My Profile</h2>
                                            </div>
                                            <div class="main_cntnt_dash">
                                                <div class="seler_card view_prof_dash">
                                                    <div class="text-right log_btn d-flex justify-content-between align-items-center">
                                                        <span class="badge_new">{{@ucfirst($user['user_type_detail']['name'])}}</span>
                                                        <a href="{{url('/provider/editProfile')}}" class="btn btn_theme btn_edit"><span>Edit Profile</span></a>
                                                    </div>
                                                    <div class="cont_shd_frm">
                                                        <div class="row">
                                                            <div class="col-sm-10 offset-1">
                                                                <form class="" method="" action="" id="">
                                                                    <div class="text-center img_user">
                                                                        <div class="pos_rel pic_top">
                                                                            @if(Auth::check() && !empty(Auth::user()->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                                                                            <img src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="img-fluid" alt="">
                                                                            @else
                                                                            <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" alt="">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label>Type of Entity</label>
                                                                                <input type="text" class="form-control properties" value="{{@ucfirst($user['user_property_detail']['name'])}}" propertyId="{{@$user['user_property_detail']['id']}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if(@$user['user_type_detail']['name'] != 'Seller')
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Type of Services</label><br>
                                                                                @foreach($UserSelectedServices as $key => $val)
                                                                                <?php $val=$val['user_service_detail'];?>
                                                                                @if($key>0), @endif{{$val['name']}}
                                                                                @endforeach         
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif 
                                                                    @if(@$user['user_selected_other_detail']!=null)
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Selected other service</label>
                                                                                <input type="text" name="" class="form-control" value="{{@$user['user_selected_other_detail'][0]['name']}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                     
                                                                    @if(@$user['user_type_detail']['name']!='Seller')
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Project Fields</label><br>
                                                                                @foreach($userSelectedProjectFields as $key => $userSelectedProjectField)
                                                                                @if($key>0), @endif{{$userSelectedProjectField['user_project_field_detail']['name']}}
                                                                                @endforeach         
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif 
                                                                    <div class="row">
                                                                        <div class="col-sm-6 compny_name_hide">
                                                                            <div class="form-group text-left">
                                                                                <label>Company Name</label>
                                                                                <input type="text" name="" class="form-control" placeholder="Company Name" value="{{@ucwords($user['company_name'])}}">
                                                                            </div>
                                                                        </div>
                                                                        <!--  <div class="col-sm-6">
                                                                            <div class="form-group text-left">
                                                                                <label>Contact Name</label>
                                                                                <input type="text" name="" class="form-control" placeholder="Contact Name" value="{{@ucwords($user['contact_name'])}}">
                                                                            </div>
                                                                            </div> -->
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group text-left">
                                                                                <label class="first_name_not_Freelance">Contact Name</label>
                                                                                <input type="text" name="contact_name" class="form-control" placeholder="First Name" value="{{@$user['contact_name']}} {{@$user['contact_last_name']}}">
                                                                            </div>
                                                                        </div>
                                                                        <!--   <div class="col-sm-3">
                                                                            <div class="form-group text-left">
                                                                             <label class="last_name_not_Freelance" style="opacity: 0px;">fdsf</label>
                                                                                <label class="last_name_not_Freelance"></label>
                                                                                <input type="text" name="contact_last_name" class="form-control" placeholder="Last Name" value="{{@$user['contact_last_name']}}">
                                                                            </div>
                                                                            </div> -->
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Membership ID</label>
                                                                                <input type="text"
                                                                                    name="supplier_code" class="form-control" disabled="" placeholder="Membership ID" value="{{@$user['supplier_code']}}">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label class="experience_not_in_seller">Years of Experience</label>
                                                                                <input type="text"
                                                                                    name="experience" class="form-control select_list_change" disabled="" placeholder="Years of Experience" value="+{{@$user['experience']}} (In Year)">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    @if($user['user_type_id'] == 6)


                                                                        <div class="form-group hideCategory">
                                                                            <label>Category</label><br>
                                                                                 {{$productCategoryImplode}}
                                                                            
                                                                            <label id="category_id[]-error" class="error" for="category_id[]"></label>
                                                                        </div>

                                                                        <div class="form-group hideSubCategory">
                                                                            <label>Sub Category</label><br>
                                                                                {{$productSubCategoryImplode}}
                                                                            
                                                                            <label id="sub_category_id[]-error" class="error" for="sub_category_id[]"></label>
                                                                        </div>

                                                                        <div class="form-group hideMaterial">
                                                                            <label>Selling Material</label><br>
                                                                                  {{$productmaterialImplode}}
                                                                            
                                                                            <label id="material_id[]-error" class="error" for="material_id[]"></label>
                                                                        </div>
                                                                        @endif
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label class="cr_Number_not_Freelance">CR Number</label>
                                                                                <input type="text"
                                                                                    name="cr_number" disabled="" class="form-control cr_placeholder" placeholder="Enter CR number" value="{{@$user['cr_number']}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group text-left">
                                                                                <label>Contact Number</label>
                                                                                <input type="text" name="" disabled="true" class="form-control" placeholder="Contact Number" value="{{@$user['isd_code']}} {{@$user['mobile_no']}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label>Landline</label>
                                                                                <input type="tel" name="landline" class="form-control" placeholder="Landline" value="{{@$user['landline_isd_code']}} {{@$user['landline']}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Email Address</label>
                                                                                <input type="text" name="" class="form-control" placeholder="Email Address" value="{{@$user['email']}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if(@$user['user_property_detail']['type']=='individual')
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group text-left">
                                                                                    <label>Nationality</label>
                                                                                    <input type="text" name="" class="form-control" placeholder="Nationality" value="{{@$user['country_detail']['name']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group text-left">
                                                                                    <label>Gender</label>
                                                                                    <input type="text" name="" class="form-control" placeholder="Gender" value="{{ucfirst(@$user['gender'])}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group text-left">
                                                                                    <label>Date of Birth</label>
                                                                                    <input type="text" name="" class="form-control" placeholder="Date of Birth" value="{{date('m/d/Y', strtotime(@$user['date_of_birth']))}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Introduction</label>       
                                                                                <input type="text" name="" class="form-control" placeholder="About me" disabled="" value="{{@$user['about_me']}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php  
                                                                        if (!empty($user['profile_document'])) {
                                                                          
                                                                            if (file_exists(providerDocBasePath.'/'.$user['profile_document'])) {
                                                                                $image = 'fa fa-file-pdf-o';
                                                                            }else{
                                                                                $image = defaultImagePath;
                                                                            }
                                                                        }else{
                                                                            $image = defaultImagePath;
                                                                        }
                                                                        ?>
                                                                    @if($user['profile_document']!=null)
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Profile Document</label>
                                                                                <div class="custom-file">
                                                                                    <a href="{{asset(providerDocBasePath.'/'.$user['profile_document'])}}" download>
                                                                                        <p class="pdf_txt cp" style="background: transparent;"><span><i class="{{$image}}"></i> Click to view</span></p>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif

                                                                    @if($user['profile_link']!=null)
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Profile Link</label>
                                                                                <input type="text" name="profile_link" class="form-control" placeholder="Profile Link" value="{{$user['profile_link']}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif               

                                                                     @if(@$multipleimages!=null)
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label>Photos</label>
                                                                                <div class="id_imgs">                    @foreach($multipleimages as $value)
                                                                                    <?php 
                                                                                        if (!empty($value['name'])) {
                                                                                            $imgpath= providerBaseImgsPath.$value['name'];
                                                                                            // dd($imgpath);    
                                                                                        }             
                                                                                        if(!empty($value['name']) && file_exists($imgpath) ) { 
                                                                                            // dd($imgpath);
                                                                                            $admin_image1 = providerImgsPath.'/'.$value['name'];    
                                                                                        }else{
                                                                                            $admin_image1 = defaultImagePath.'/no_image.png';  
                                                                                        }                                           
                                                                                        ?>
                                                                                    <img src="{{$admin_image1}}" class="img-fluid">
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif


                                                                        
                                                             
                                                                    @if(@$brandMultipleImages!=null)
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label>Brand Images</label>
                                                                                <div class="id_imgs">                    @foreach($brandMultipleImages as $value1)
                                                                                    <?php 
                                                                                        if (!empty($value1['name'])) {
                                                                                            $imgpath= providerBrandImgsBasePath.$value1['name'];    
                                                                                        }             
                                                                                        if(!empty($value1['name']) && file_exists($imgpath) ) { 
                                                                                            // dd($imgpath);
                                                                                            $admin_image = providerBrandImgsPath.'/'.$value1['name'];    
                                                                                        }else{
                                                                                            $admin_image = defaultImagePath.'/no_image.png';  
                                                                                        }                                           
                                                                                        ?>
                                                                                    <img src="{{$admin_image}}" class="img-fluid">
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif

                                                                    
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Website URL</label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" value="{{@$user['website_url']}}">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text"><i class="fa fa-link"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Additional Info</label>
                                                                                <input type="text" name="" class="form-control" value="{{@$user['additional_information']}}">
                                                                            </div>
                                                                        </div>
                                                                        </div> -->
                                                                    <!-- <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Address</label>
                                                                                <input type="text" name="address1" class="form-control mb-3" value="{{@$user['address_line_1']}}">
                                                                                <input type="text" name="address2" class="form-control mb-3" value="{{@$user['address_line_2']}}">
                                                                                <input type="tel" name="number" class="form-control" value="{{@$user['landline']}}">
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                               <label>Postal Code</label>
                                                                                <input type="tel" name="landline" class="form-control" placeholder="Landline" value="{{@$user['landline']}}">
                                                                                </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group text-left">
                                                                               <label class="last_name_not_Freelance"></label>
                                                                                <input type="text" name="" class="form-control" placeholder="Contact Name" value="{{@ucwords($user['country_detail']['name'])}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group text-left">
                                                                                <label class="last_name_not_Freelance"></label>
                                                                                <input type="text" name="" class="form-control" placeholder="City" value="{{@ucwords($user['city'])}}">
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        @if(\Auth::user()->userTypeDetail->alias == 'seller')
                                                                        <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Supplier Code</label>
                                                                                <input type="text" name="" class="form-control" value="{{@$user['supplier_code']}}">
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        @endif
                                                                        <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Location</label>
                                                                                <input type="text" name="" class="form-control" placeholder="Location" value="{{@$user['location']}}">
                                                                            </div>
                                                                        </div>
                                                                        </div> -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="button_nex_prev">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="text-right">
                                                                <a class="btn btn_theme btn_nex" href="javascript:;"><span>Submit <i class="fa fa-arrow-right"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div> -->
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
<?php
    $currentDate = date('Y-m-d H:i:s');
     // dd($currentDate);
    
    $userId = Auth::user()->id;
    $userType = Auth::user()->user_type_id;
    $userType = app\UserType::where('id',Auth::user()->user_type_id)->value('type');
    
    $userTypename = app\UserType::where('id',Auth::user()->user_type_id)->first();
    
    
    $expiryDate= Auth::user()->expiry_subscription_package;
    
    
     
    ?>
<input type="hidden" name="currentDate" class="todayDate" value="{{@$currentDate}}">
<input type="hidden" name="expiryDate" class="expiredDateSubscription" value="{{@$expiryDate}}">
<input type="hidden" name="userType" class="userType" value="{{@$userType}}">
<input type="hidden" name="userId" class="userId" value="{{@$userId}}">
<input type="hidden" name="userTypename" class="userTypename" value="{{@$user['user_type_detail']['id']}}">
<input type="hidden" name="user_Type_Idd" class="user_Type_Idd" value="{{$user['user_type_detail']['id']}}">


@include('frontend.include.modals.expirySubscriptionpackRefill')
<!-- @include('frontend.include.modals.expirySubscriptionChoose') -->
@stop
@section('script')
<script type="text/javascript">
     
      $(document).ready(function() {
         var user_Type_Iddd = $('.user_Type_Idd').val(); 
         if(user_Type_Iddd=6){
              $('.experience_not_in_seller').text('Years in Buisness');
              $('.select_list_change').attr('placeholder','Years in Buisness');
         }else{
              $('.experience_not_in_seller').text('Experience');
              $('.select_list_change').attr('placeholder','Years of Experience');
         }
     });



    var userTypeId = $('.userTypename').val();
    var userPropertId = $('.properties:checked').val();
    var userProp;
    if (userPropertId==2 || userPropertId==7 || userPropertId==10) {
        $('.indv_dtl').show();
      
    }else{
        $('.indv_dtl').hide();
     
       
    }
    
    var userTypeId = $('.userTypename').val();
    
     // alert(userTypeId);
    
      if(userTypeId==3){
             $('.first_name_not_Freelance').text('Designer  Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Identification Number');
             $('.cr_placeholder').attr('placeholder','Identification Number');
         }else if(userTypeId==4){
             $('.first_name_not_Freelance').text('Contractor Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Identification Number');
             $('.cr_placeholder').attr('placeholder','Identification Number');
         }else if(userTypeId==5){
             $('.first_name_not_Freelance').text('Consultant Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Identification Number');
             $('.cr_placeholder').attr('placeholder','Identification Number');
    
         }else{
             $('.first_name_not_Freelance').text('Contact Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Cr Number');
             $('.cr_placeholder').attr('placeholder','Cr Number');
    
         }
    
         var productId= $('.properties').attr('propertyId');      

            if(productId==2){
                 $('.first_name_not_Freelance').text('Designer Name');
                 $('.last_name_not_Freelance').css('opacity', '0');
                 $('.cr_Number_not_Freelance').text('Identification Number');  
                 $('.cr_placeholder').attr('placeholder','Identification Number'); 
                 $('.compny_name_hide').hide();

             }else if(productId==7){
                 $('.first_name_not_Freelance').text('Contractor Name');
                 $('.last_name_not_Freelance').css('opacity', '0');;
                 $('.cr_Number_not_Freelance').text('Identification Number');
                 $('.cr_placeholder').attr('placeholder','Identification Number'); 
                 $('.compny_name_hide').hide();

             }else if(productId==10){
                 $('.first_name_not_Freelance').text('Consultant Name');
                 $('.last_name_not_Freelance').css('opacity', '0');
                 $('.cr_Number_not_Freelance').text('Identification Number');
                 $('.cr_placeholder').attr('placeholder','Identification Number'); 
                 $('.compny_name_hide').hide();


             }else{
                  $('.first_name_not_Freelance').text('Contact Name');
                  $('.last_name_not_Freelance').css('opacity', '0');
                  $('.cr_Number_not_Freelance').text('Cr Number');
                  $('.cr_placeholder').attr('placeholder','Cr Number');
                  $('.compny_name_hide').show();

             }
    
    
    
     $(document).ready(function() {
    
          var currentDate = $('.todayDate').val();
             // alert(currentDate);
          var expiryDate  = $('.expiredDateSubscription').val();
             // alert(expiryDate);
          var usertype    = $('.userType').val();
             // alert(usertype);
    
             if (usertype =='provider') {
                  if(expiryDate < currentDate) {
                     $("#upgrade_plan").modal({
                         backdrop: 'static',
                         keyboard: false
                     });
                     $('#upgrade_plan').modal('show');
    
                  }else{
                     $('#upgrade_plan').modal('hide');
                  }
          
             }
    
    
         $(".chooseSubscriptionPack").click(function(){
             $('#expirysubscription').modal('show');
             var data  = $(this).closest('div').find('.titleSubscription').text();
             var pack  = $(".subPack").text(data);
             $('.subs_pack_cls').val($(this).data('id')); 
             var subscriptionId = $(this).closest('div').find('.sub_id').val();
             userId = $(".userId").val();
    
                 $('#dataSubmit').click(function(){
                     $.ajax({
                         url: "{{url('expiry_subscription-pack-choosen')}}",
                         type:'post',
                         data:{userId:userId,subscriptionId:subscriptionId,_token:"{{ csrf_token() }}" },
                         success:function(response){
                             if(response['status']='true'){                                
                                 // alert(response);
                                 $('#expirysubscription').modal('hide');
                                 $('#upgrade_plan').modal('hide');
                             }
    
                         },error(){
                             toastr.error('Something went wrong');
                         }       
                     })
                 });
    
         });
    
    });
</script>
@stop
