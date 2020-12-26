<?php  
    $admin_image = defaultAdminImagePath.'/no_image.png';  
    // dd($admin_image);                                               
?>
@extends('frontend.layout.layout')
@section('title','Become a Service Provider')
@section('content')

<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/intlTelInput.css')}}">
    <section class="signuP_sec sgnup_prvdr">
        <div class="custom_container">
            <div class="wrap_inr_signup">
                <div class="row">
                    <div class="col-md-8">  
                        <div class="wrap_signup_form">
                            <!-- stepper -->
                            <div class="page_numbers">
                                <div class="container">
                                    <ul class="numb_pag list-inline d-flex justify-content-around" type="none">
                                        <li class="list-inline-item bsns_dtl_li first_dot active"><span>1</span> Personal Info</li>
                                        <li class="list-inline-item stor_subs_li second_dot"><span>2</span> Subscription Plan</li>
                                        <li class="list-inline-item mak_pymt_li third_dot"><span>3</span> Make Payment</li>
                                        <!-- <li class="list-inline-item stor_loc_li fourth_dot"><span>4</span> Store Location</li> -->
                                    </ul>
                                </div>
                            </div>
                            
                            <section class="register_sec bsns_dtl">
                                <div class="new_div_aded">
                                    <div class="sec_heading text-center">
                                        <h2>Personal Details</h2>
                                    </div>
                                    <div class="wrap_register_white">
                                        <div class="inr_signup left_info">
                                            <form class="first_form" method="post" name="userSignUpForm" id='' enctype="multipart/form-data" >
                                                <div class="cont_rp_form">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label class="build_label">Service Provider Category</label>
                                                                <select name="user_type_id" class="form-control custom-select ths_slct">
                                                                   <option selected disabled>Choose Your Category</option>
                                                                    @foreach($userType as $value)
                                                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="chng_on_select seller_select">
                                                        <div class="row">
                                                            <div class="col-sm-12 usr_prop">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="row" >
                                                            <div class="col-sm-12 usr_servic">
                                                                 
                                                            
                                                            </div> 
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label experience_not_in_seller">Years in Business</label>
                                                                    <select name="experience" class="form-control custom-select">
                                                                        <option value="" class="select_list_change" selected disabled>Years in Business</option>
                                                                        @for($i=0; $i <=50 ; $i++)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row not_selr">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Project Fields</label>
                                                                    <select name="project_field_ids[]" class="selc_fields form-control custom-select" multiple="multiple">
                                                                       <!-- <option selected disabled>Choose from List</option> -->
                                                                        <!-- @for($i=0; $i <=50 ; $i++)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor -->
                                                                    </select>
                                                                    <label class="error" for="project_field_ids[]"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 compny_name_hide">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label build_label">Company Name</label>
                                                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group text-left">
                                                                    <label class="first_name_not_Freelance build_label">Contact Name</label>
                                                                    <input type="text" name="contact_name" class="form-control" placeholder="First Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group text-left">
                                                                    <label class="last_name_not_Freelance" style="opacity: 0px" >saas</label>
                                                                    <input type="text" name="contact_last_name" class="form-control" placeholder="Last Name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row indv_dtl">
                                                            <div class="col-sm-4">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Nationality</label>
                                                                    <!-- <input type="text" name="company_name" class="form-control" placeholder="Company Name"> -->
                                                                    <select class="form-control custom-select" name="country_id">
                                                                        <option value="" selected disabled>Choose Nationality </option>
                                                                        @foreach($countries as $countr)
                                                                            <option value="{{@$countr['id']}}">{{@$countr['name']}}</option>
                                                                        @endforeach              
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Gender</label>
                                                                    <!-- <input type="text" name="company_name" class="form-control" placeholder="Company Name"> -->
                                                                    <select class="form-control custom-select" name="gender" type="text" value="">
                                                                        <option value="" selected disabled>Select Gender </option>
                                                                        <option value="male">Male </option>              
                                                                        <option value="female">Female </option>              
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Date of Birth</label>
                                                                    <input type="text" onkeydown="return false" name="date_of_birth" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" placeholder="Date of Birth">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="cr_Number_not_Freelance build_label">Commercial Register Number</label>
                                                                    <input type="text" name="cr_number" class="form-control cr_placeholder" placeholder="Commercial Register Number">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group intl_input text-left">
                                                                    <label class="build_label">Contact Number</label>
                                                                    <input autocomplete="off" type="tel" name="mobile_no" class="form-control phone" placeholder="Contact Number" value="+966"  id="phone1">
                                                                    <input type="hidden" class="form-control" name="isd_code" id="isd_code1" value="966">
                                                                </div>
                                                            </div>    

                                                            <div class="col-sm-6">
                                                                <div class="form-group intl_input text-left">
                                                                    <label class="build_label">Landline Number</label>
                                                                    <input autocomplete="off" type="tel" name="landline" class="form-control phone" placeholder="Landline Number" value="+966"  id="phone2">
                                                                    <input type="hidden" class="form-control" name="landline_isd_code" id="isd_code2" value="966">
                                                                   <!-- <input type="tel" name="landline" class="form-control" placeholder="Landline Number"> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Email Address</label>
                                                                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Password</label>
                                                                    <input type="password" id="password" name="password"  autocomplete="off" class="form-control" placeholder="*********">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Confirm Password</label>
                                                                    <input type="password" name="confirm_password"  autocomplete="off" class="form-control" placeholder="*********">
                                                                </div>
                                                            </div>
                                                        </div>

                                                         <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Introduction</label>          
                                                                    <textarea class="form-control text-align:left" rows="4" name="about_me" placeholder="Write a brief about you..."></textarea>
                                                                </div>
                                                            </div>
                                                        </div> 

                                                        <div class="form-group hideCategory">
                                                            <label class="build_label">Category</label>
                                                            <select class="form-control category_id_class mul_category" name="category_id[]" multiple="multiple">
                                                               
                                                                @foreach($productCategories as $category)
                                                                    <option value="{{$category->id}}">{{@$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label id="category_id[]-error" class="error" for="category_id[]"></label>
                                                        </div>

                                                        <div class="form-group hideSubCategory">
                                                            <label class="build_label">Sub Category</label>
                                                            <select class="form-control mul_category sub_category_class changeSubCategory" name="sub_category_id[]" multiple="multiple">
                                                            </select>
                                                            <label id="sub_category_id[]-error" class="error" for="sub_category_id[]"></label>
                                                        </div>

                                                        <div class="form-group hideMaterial">
                                                            <label class="build_label">Selling Material</label>
                                                            <select class="form-control mul_category selling_material_class" name="material_id[]" multiple="multiple">
                                                            </select>
                                                            <label id="material_id[]-error" class="error" for="material_id[]"></label>
                                                        </div>

                                                        
                                                        <label class="build_label">Company Profile</label>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                     <div class="custom-file">
                                                                        <input type="file"  class="custom-file-input user-img-first" id="botonAjax_first" name="profile_document" value="">
                                                                        <label class="custom-file-label" for="customFile">Attach your profile ...</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Profile Link</label>  
                                                                   <input type="text" name="profile_link" class="form-control" value="" placeholder="Profile link">
                                                                </div>
                                                            </div>
                                                        </div>  

                                                        <input type="hidden" name="media_ids" id="image_ids" value="">

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Photos Gallery</label>
                                                                    <div class="drop_area">
                                                                        <div class="form-group" id="data_section_8">
                                                                            <!-- certificate dropzone -->
                                                                            <div class="drop_post_files dropzone dz-clickable" id="my-dropzone">             
                                                                                <div class="dz-default dz-message">
                                                                                    <span>Photos</span>
                                                                                </div>
                                                                            </div>
                                                                            <!-- certificate dropzone -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="brand_ids" id="brand_ids" value="">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label class="build_label">Add Brands / Trademark</label>
                                                                    <div class="drop_area">
                                                                        <div class="form-group" id="data_section_9">
                                                                            
                                                                            <div class="drop_brand_files dropzone dz-clickable1" id="my-dropzone1">             
                                                                                <div class="dz-default dz-message">
                                                                                    <span>Add Brands / Trademark Photos</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                 <div class="form-group text-left">
                                                                    <label class="build_label">Website URL</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="website_url" class="form-control" placeholder="https://www.example.com">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><i class="fa fa-link"></i></span>
                                                                        </div>
                                                                    </div>
                                                                    <label id="website_url-error" class="error" for="website_url"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       <!--  <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Additional Info</label>
                                                                    <input type="text" name="additional_information" class="form-control" placeholder="(If Any)">
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="new_locas">
                                                                    <h4> Add Address </h4>
                                                                </div>
                                                                <div class="addrs_div">
                                                                    <div class="form-group text-left">
                                                                        <label class="build_label">Address Name</label>
                                                                        <input type="text" name="store_name" class="form-control" placeholder="Give name for your address to recognize later(e.g. Main Address, Address No.1, ...)">
                                                                        <!-- <input type="text" name="address_line_2" class="form-control mb-3" placeholder="Address Line 2, Office Number"> -->
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="build_label">Address Type</label>
                                                                                <select class="form-control custom-select" name="address_type_id">
                                                                                    @if(isset($storeLocationAddressTypes) && sizeof($storeLocationAddressTypes)>0 )
                                                                                        @foreach($storeLocationAddressTypes as $key => $storeLocationAddressType)
                                                                                            @if(!empty($storeLocationAddressType))
                                                                                                <option value="{{@$storeLocationAddressType['id']}}">{{@$storeLocationAddressType['name']}}</option>
                                                                                            @endif
                                                                                        @endforeach                        
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                              <label class="build_label">Street</label>
                                                                                <input type="text" name="street" class="form-control" placeholder="Street">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="country build_label">Country</label>
                                                                                <select class="form-control custom-select chng_cntry" name="location_country_id" type="text" value="">
                                                                                    <option value="" selected disabled>Select Country </option>                          
                                                                                    @foreach($countries as $countr)
                                                                                      <option value="{{@$countr['id']}}">{{@$countr['name']}}</option>
                                                                                    @endforeach                 
                                                                                </select>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label class="city build_label">City</label>
                                                                                <!-- <input type="text" name="city" class="form-control" placeholder="City"> -->
                                                                                <select class="form-control custom-select chng_city" name="city_id">
                                                                                    <option value="" disabled="" selected="">Select City</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label class="build_label">Location</label>
                                                                                <input type="text" name="location" class="form-control" placeholder="Location">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28900.22947607954!2d55.117153479588616!3d25.117811021706277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f152a683c0d79%3A0x546802ab643feb7f!2sThe%20Palm%20Jumeirah%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1593162628612!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="form-group text-left">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck_nw" name="terms_conditions" required="">
                                                    
                                                     <label class="custom-control-label" for="customCheck_nw">I agree to the <a href="{{url('termsCondtion')}}" class="ter_links">Terms & Conditions.</a></label>
                                                </div>
                                                  <span class="error" id="terms_conditions_id"></span>
                                            </div>
                                            </form>
                                        </div>
                                        <input type="hidden" name="registered_id" class="registered_id">


                                        <div class="button_nex_prev">
                                            <div class="">
                                                <div class="form-group text-right">
                                                    <a type="button" id="first_complete" class="btn btn_theme  " href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>

                            <section class="register_sec subs_pla">
                                <div class="new_div_aded">
                                    <div class="sec_heading text-center">
                                        <h2>Subscription Plans</h2>
                                    </div>
                                    <div class="wrap_register_white">
                                        <div class="subsc_plans">
                                            <div class="row">
                                            <input type="hidden" name="registered_id" class="registered_id">
                                            @foreach($subscription as $value)
                                                <div class="col-sm-6">
                                                    <div class="plan_wrpr text-center hjhh">
                                                <input type="hidden" name="id_sub" class="sub_id" value="{{$value['id']}}">
                                                            <h3 class="text-uppercase titleSubscription">{{ucfirst($value['title'])}} </h3>
                                                            <h4 class="pln_val">SR<span class="price_subscription">{{$value['price']}}</span><small>/ <span class="timelimit_subscription">{{$value['time_limit']}}</span> <span class="timetype_subscription">{{$value['time_type']}}</span></small></h4>
                                                            <ul type="none" class="pln_bnfts">
                                                            <li>{{$value['description']}} </li>
                                                            </ul>
                                                               <!--  <li><i class="fa fa-check"></i>{{$value['description']}} </li> -->
                                                            <button class="btn btn_theme chooseSubscriptionPack" data-id="{{base64_encode($value['id'])}}" data-toggle="modal"><span>Choose</span></button>
                                                        </div>
                                                </div>
                                            @endforeach

                                            

                                        </div>
                                            <input type="hidden" name="sub_active" value="" id="sub_active">
                                            <input type="hidden" name="subscriptionId" value="" class="subscriptionId">
                                            </div>

                                        </div>

                                        <div class="button_nex_prev">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="text-left">
                                                        <a class="btn btn-secondry btn_prev" href="#"><i class="fa fa-arrow-left"></i> Previous</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="text-right">
                                                        <a class="btn btn_theme " id="second_complete" href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <!-- </div> -->
                            </section>
                         
                            <section class="register_sec mk_pymtt">
                                <div class="new_div_aded">

                                    <?php
                                        $userSubscriptionPrice = App\UserSubscription::latest()->first();
                                    
                                    ?>
                                     <div class="pay_price">
                                        <h4>Total Payment:</h4>
                                        <h2>{{$userSubscriptionPrice['price']}} SR </h2>
                                    </div>

                                    <div class="sec_heading text-center">
                                        <h2>Make Payment</h2>
                                    </div>
                                    <div class="wrap_register_white">
                                        <div class="uplod_docs">                             
                                            <div class="acc-pay-detail">
                                                <div class="form-group ">
                                                    <div class="tabs_pymnt">
                                                        <ul class="nav nav-tabs">
                                                            <li class="nav-item">
                                                              <a class="text-center nav-link paydata" data-toggle="tab" paymentType="wallet-payment" href="#home"><i class="fa fa-google-wallet"></i><br> Wallet </a>
                                                            </li>
                                                            <li class="nav-item">
                                                              <a class="text-center nav-link paydata active" data-toggle="tab" paymentType="card-payment" href="#menu1"><i class="fa fa-credit-card"></i></br> Card</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="text-center nav-link paydata" data-toggle="tab" paymentType="cash-payment" href="#menu2"><i class="fa fa-money"></i></br> Cash</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="text-center nav-link paydata" data-toggle="tab" paymentType="sadad-payment" href="#menu3"><i class="fa fa-cc-diners-club"></i></br> Sadad</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="text-center nav-link paydata" data-toggle="tab" paymentType="wire-transfer-payment" href="#menu4"><i class="fa fa-exchange"></i></br> Wire Transfer</a>
                                                            </li>
                                                        </ul>
                                                                        <!-- Tab panes -->
                                                    <div class="tab-content">
                                                       <div class="tab-pane container fade" id="home">
                                                            <div class="tab_inr_pay wire_pay">
                                                                <h6>Wallet Balance:</h6>
                                                                <div class="wlt_balm">
                                                                    <div class="button_nex_prev">
                                                                       <div class="row">
                                                                            <div class="col-sm-12">
                                                                               <div class="text-center">
                                                                                   <a class="btn btn_theme btn_nex" href="myWallet.php"><span>Add Money <i class="fa fa-arrow-right"></i></span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                   </div>
                                                               </div>
                                                            </div>
                                                        </div>  
                                                        <div class="tab-pane container active" id="menu1">
                                                            <div class="tab_inr_pay">
                                                                <div class="ordr-addr">
                                                                    <div class="acc-body-addr">
                                                                            <div class="saved_adrss">
                                                                                <div class="row">
                                                                                    <div class="col-sm-6 cardDetail">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <div class="add_new_adrs">
                                                                            <div class="odr-head">
                                                                                <h4>Add New Card </h4>
                                                                            </div>
                                                                            <form class="thirdform" method="" name="thirdform">
                                                                                <div class="cont_rp_form">

                                                                                 <input type="hidden" name="cash_payment_id" class="cash_payment_id">

                                                                                <input type="hidden" name="registered_id" class="registered_id">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group text-left">
                                                                                                <label>Card Type</label>
                                                                                                <select name="card_type" class="form-control custom-select">

                                                                                                    <option selected disabled>Select Card</option>
                                                                                                    <option value="debit_card">Debit Card</option>
                                                                                                    <option value="credit_card">Credit Card</option>
                                                                                                  </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <input type="hidden" name="payment_card_id" value="" class="payment_card_id">

                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group text-left">
                                                                                               <label>Name on Card</label>
                                                                                               <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                   <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="form-group text-left">
                                                                                                <label>Card Number</label>
                                                                                                <input type="text" name="card_no" class="form-control" placeholder="Card Number">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                     <input type="hidden" name="type" value="card">


                                                                                    <div class="row">
                                                                                        <div class="col-sm-6">
                                                                                              <label>Expiry Date</label>
                                                                                                <div class="row">
                                                                                                   <div class="col-sm-6">
                                                                                                        <div class="form-group text-left"> 
                                                                                                            <select name="expiry_month" class="form-control custom-select">
                                                                                                            <option value="" selected>Month</option>
                                                                                                            <option value="01">01</option>
                                                                                                            <option value="02">02</option>
                                                                                                            <option value="03">03</option>
                                                                                                            <option value="04">04</option>
                                                                                                            <option value="05">05</option>
                                                                                                            <option value="06">06</option>
                                                                                                            <option value="07">07</option>
                                                                                                            <option value="08">08</option>
                                                                                                            <option value="09">09</option>
                                                                                                            <option value="10">10</option>
                                                                                                            <option value="11">11</option>
                                                                                                            <option value="12">12</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                               <div class="col-sm-6">
                                                                                                    <div class="form-group text-left">
                                                                                                        <select name="expiry_year" class="form-control custom-select">
                                                                                                            <option value="" selected>Year</option>
                                                                                                            @for($i=0; $i < 10; $i++)
                                                                                                                <option value="{{date('Y')+$i}}">{{date('Y')+$i}}</option>
                                                                                                            @endfor
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <div class="form-group text-left">
                                                                                            <label>CVV Number</label>
                                                                                                <input type="text" name="cvv" class="form-control" placeholder="CVV Number">
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
                                                                               
                                                        <div class="tab-pane container" id="menu2">
                                                            <div class="tab_inr_pay">
                                                                <div class="ordr-addr">
                                                                    <div class="acc-body-addr">
                                                                        <div class="form-group imge_uploader">
                                                                            <label>Payment Receipt</label>

                                                                               <form method="post" action="" class="thirdform-PaymentFORM"  enctype="multipart/form-data">

                                                                                 <input type="hidden" name="type" value="cash">

                                                                                <div class="profle_pic text-center">
                                                                                    <input type="hidden" name="registered_id" class="registered_id">
                                                                                    <input type="hidden" name="cash_payment_id" class="cash_payment_id">
                                                                                        <div class="img_prof user-img text-center">
                                                                                           <img src="{{@$admin_image}}" id="img-fluid" name="invoice_image" value="" class="img-fluid user-img">

                                                                                           <span class="file_upload">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                            <input type="file" id="botonAjax" name="uploader" value="" class="file_type">
                                                                                           </span>
                                                                                        </div>
                                                                                        <!-- <label class="error-upload" for="botonAjax"></label> -->
                                                                                        <label id="botonAjax-error" class="error mt-3" for="botonAjax"></label>
                                                                                </div>
                                                                                </form>
                                                                            <!-- End -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane container" id="menu3">
                                                            <div class="tab_inr_pay">
                                                                <div class="ordr-addr">
                                                                    <div class="acc-body-addr">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         </div>
                                                         <?php
                                                          $wireTransferDetails = App\AdminWireTransferDetail::first();
                                                         ?>
                                                            <div class="tab-pane container fade" id="menu4">
                                                                 <div class="tab_inr_pay wire_pay tabs_ttl_nw">
                                                                  <!-- <h6>Wire Transfer Details:</h6> -->
                                                                 <h6>Wire Transfer</h6>
                                                                 <div class="addNewCard">
                                                                      <form method="post"  class="fifth-WiretransferForm"  enctype="multipart/form-data">
                                                                          <!--  -->
                                                                          <!-- <div class="cont_rp_form"> -->
                                                                             <div class="row">
                                                                                  <div class="col-sm-12">
                                                                                      <div class="form-group text-left">
                                                                                          <label>Bank name</label>    
                                                                                          <input type="text" name="bank_name" class="form-control" placeholder="Bank name" value="{{$wireTransferDetails->bank_name}}" disabled="">
                                                                                      </div>
                                                                                  </div>
                                                                             </div>
                                                                             <div class="row">
                                                                                  <div class="col-sm-12">
                                                                                      <div class="form-group text-left">
                                                                                          <label>Account Name</label>
                                                                                          <input type="text" name="account_name" class="form-control" placeholder="Account Name" value="{{$wireTransferDetails['account_name']}}" disabled="">
                                                                                      </div>
                                                                                  </div>
                                                                             </div>
                                                                             <div class="row">
                                                                                  <div class="col-sm-12">
                                                                                      <div class="form-group text-left">
                                                                                          <label>Account iBAN Number</label>
                                                                                          <input type="text" name="account_iban_number" class="form-control" placeholder="Account iBAN Number" value="{{$wireTransferDetails['account_iban_number']}}" disabled="">
                                                                                      </div>
                                                                                  </div>
                                                                             </div>
                                                                          
                                                                             <input type="hidden" name="type" value="wiretransfer">

                                                                             <div class="profle_pic text-center">
                                                                                    <input type="hidden" name="registered_id" class="registered_id">
                                                                                    <input type="hidden" name="cash_payment_id" class="cash_payment_id">
                                                                                        <div class="img_prof wiretransfer-img text-center">
                                                                                             <img src="{{@$admin_image}}" id="img-fluid" name="invoice_image" value="" class="img-fluid wiretransfer-img">
                                                                                             <span class="file_upload">
                                                                                                <i class="fa fa-pencil"></i>
                                                                                                <input type="file" id="wire_transfer_botonAjax" name="uploader_wiretransfer" value="" class="file_type">
                                                                                             </span>
                                                                                        </div> 
                                                                                     <label id="wire_transfer_botonAjax-error" class="error mt-3" for="wire_transfer_botonAjax"></label>
                                                                             </div>

                                                                          <!-- </div> -->
                                                                          <!--  -->
                                                                      </form>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="button_nex_prev">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="text-left">
                                                        <a class="btn btn-secondry btn_prev" href="javascript:;"><i class="fa fa-arrow-left"></i> Previous</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="text-right">
                                                        <!-- <a class="btn btn_theme third_complete" href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></a> -->
                                                        <a class="btn btn_theme third_complete" href="javascript:;"><span>Submit <i class="fa fa-arrow-right"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           </section>

                            <section class="register_sec stor_subs">
                                <div class="new_div_aded">
                                    <div class="sec_heading text-center">
                                        <h2>Add Store Location</h2>
                                    </div>

                                    <div class="wrap_register_white">
                                        <div class="inr_signup left_info">
                                            <div class="ordr-addr">
                                                <div class="acc-body-addr">
                                                    <div class="add_new_adrs">
                                                        <div class="odr-head">
                                                            <h4> Add New Address </h4>
                                                        </div>
                                                        <form class="fourth_form" method="" name="fourth">

                                                         <input type="hidden" name="registered_id" class="registered_id">

                                                            <div class="cont_rp_form">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group text-left">
                                                                            <label>Store Name</label>
                                                                            <input type="text" name="store_name" class="form-control" placeholder="Store Name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group text-left">
                                                                            <label>Street</label>
                                                                            <input type="text" name="street" class="form-control" placeholder="Street ">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group text-left">
                                                                             <label>Country</label>
                                                                        <select class="form-control custom-select chng_cntry" name="country_id" type="text" value="">
                                                                        <option selected disabled>Select Country Name</option>                          
                                                                        @foreach($countries as $countr)
                                                                          <option value="{{@$countr['id']}}">{{@$countr['name']}}</option>
                                                                        @endforeach
                                                                           
                                                                        </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group text-left">
                                                                         <label>State</label>
                                                                        <select class="form-control custom-select state_class" name="state_id" type="text" value="">
                                                                        <option selected disabled>Select State Name</option>
                                                                        </select>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group text-left">
                                                                            <label>City</label>
                                                                            <input type="text" name="city" class="form-control" placeholder="City">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group text-left">
                                                                            <label>Location</label>
                                                                            <input type="text" name="location" class="form-control" placeholder="Location">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28900.22947607954!2d55.117153479588616!3d25.117811021706277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f152a683c0d79%3A0x546802ab643feb7f!2sThe%20Palm%20Jumeirah%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1593162628612!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               <!--  <div class="text-right">
                                                                    <button class="btn btn_theme store_location_save_button" type="button"><span>Add Address</span></button>
                                                                </div> -->
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="button_nex_prev">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="text-left">
                                                        <a class="btn btn-secondry btn_prev" href="#"><i class="fa fa-arrow-left"></i> Previous</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="text-right">
                                                        <a class="btn btn_theme fourth_submit"><span>Submit <i class="fa fa-arrow-right"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- stepper -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="rgt_info text-center d-flex flex-column justify-content-center">
                            <figure class="provider_img">
                                <img src="{{asset('public/frontend/img/bnr2.jpg')}}" class="img-fluid">
                                      
                            </figure>
                            <div class="new">
                                <h2>Registered User</h2>
                                <p>By creating an account with Mawad Mart, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                <p class="alrdy">Already have an account?</p>
                                <a class="btn btn_theme"><span>Login Now</span></a>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
       @include('frontend.include.modals.chooseSubscription')
@stop

@section('script')


<script>
    $(document).on('change', '.category_id_class', function(){
        categoryId = $(this).val();
        $.ajax({
            url:"{{url('provider/get/subcategoryAndMaterialList')}}",
            data:{categoryId : categoryId},
            type:'POST',
            success:function(data) {
                $('.sub_category_class').html(data[0]);
                $('.selling_material_class').html(data[1]); 
            }
        })
    })

    
    $(document).on('change', '.changeSubCategory', function(){
        subCategoryId = $(this).val();
        $.ajax({
            url:"{{url('provider/get/subcategory/depends/MaterialList/beforelogin')}}",
            data:{subCategoryId : subCategoryId},
            type:'POST',
            success:function(data) {
                $('.selling_material_class').html(data); 
            }
        })
    })

</script>
<script>
    
    $('.hideCategory').hide();
    $('.hideSubCategory').hide();
    $('.hideMaterial').hide(); 
    $('.hideBrandPhotos').hide(); 

    $('.experience_not_in_seller').text('Experience');
    $('.select_list_change').text('Years of Experience');

    $('.first_name_not_Freelance').text('Contact Name');
    $('.last_name_not_Freelance').css('opacity', '0');
    $('.cr_Number_not_Freelance').text('Commercial Register Number');
    $('.cr_placeholder').attr('placeholder','Commercial Register Number');
    $('.indv_dtl').hide();
    // $('.compny_name_hide').show();

    $('.ths_slct').on('change', function (){
        var selcVal = $(this).val();

        $('.experience_not_in_seller').text('Experience');
       $('.select_list_change').text('Years in Buisness');

        // alert(selcVal);
        $('.first_name_not_Freelance').text('Contact Name');
        $('.last_name_not_Freelance').css('opacity', '0');
        $('.cr_Number_not_Freelance').text('Commercial Register Number');
        $('.cr_placeholder').attr('placeholder','Commercial Register Number');
        $('.compny_name_hide').show();
        $('.indv_dtl').hide();
       // dd(selcVal);
        // $('.compny_name_hide').show();
        // alert(1);
        // if(selcVal=='3'){
        //     $('.first_name_not_Freelance').text('Designer  Name');
        //     $('.last_name_not_Freelance').css('opacity', '0');
        //     $('.cr_Number_not_Freelance').text('Identification Number');
        //     $('.cr_placeholder').attr('placeholder','Identification Number');
        //     $('.compny_name_hide').show();
        //      // $('.compny_name_hide').hide();
        // }else if(selcVal=='4'){
        //     $('.first_name_not_Freelance').text('Contractor Name');
        //     $('.last_name_not_Freelance').css('opacity', '0');
        //     $('.cr_Number_not_Freelance').text('Identification Number');
        //     $('.cr_placeholder').attr('placeholder','Identification Number');
        //     $('.compny_name_hide').show();
        //     // $('.compny_name_hide').hide();
        // }else if(selcVal=='5'){
        //     $('.first_name_not_Freelance').text('Consultant Name');
        //     $('.last_name_not_Freelance').css('opacity', '0');
        //     $('.cr_Number_not_Freelance').text('Identification Number');
        //     $('.cr_placeholder').attr('placeholder','Identification Number');
        //     $('.compny_name_hide').show();
        //     // $('.compny_name_hide').hide();

        // }else{
        //     $('.first_name_not_Freelance').text('Contact Name');
        //     $('.last_name_not_Freelance').css('opacity', '0');
        //     $('.cr_Number_not_Freelance').text('Cr Number');
        //     // $('.cr_placeholder').attr('placeholder','Cr Number');
        //     // $('.compny_name_hide').show();
        //     $('.compny_name_hide').show();
        // }

        $.ajax({
            url: "{{url('member-userType')}}",
            type:'post',
            data:{selcVal:selcVal,_token:"{{ csrf_token() }}" },
            // dataType:'json',
            success:function(data){

                $('.usr_prop').html(data['0']);
                $('.usr_servic').html(data['1']);
                if (selcVal==6) {
                    $('.not_selr').hide();

                     $('.hideCategory').show();
                     $('.hideSubCategory').show();
                     $('.hideMaterial').show(); 
                     
                     $(".mul_category").select2({
                        placeholder: "Select"
                     });

                    $('.hideBrandPhotos').show();
                    $('.hideprojectfield').hide();
                    $('.experience_not_in_seller').text('Years in Buisness');

                }else{
                    $('.select_list_change').text('Years of Experience');
                   
                    $('.hideprojectfield').show();   
                    $('.not_selr').show();
                    $('.selc_fields').html(data['2']);
                }
                    // alert('here');            
            },error(){
                toastr.error('Something went wrong');
            }
        })

    });

    $("body").on('click',".service_select",function(){

        var productId= $(this).attr('propertyId');  
        // alert(productId);
        // alert(2);
        if(productId=='2'){
            $('.first_name_not_Freelance').text('Designer Name');
            $('.last_name_not_Freelance').css('opacity', '0');
            $('.cr_Number_not_Freelance').text('Identification Number');  
            $('.cr_placeholder').attr('placeholder','Identification Number'); 
            $('.compny_name_hide').hide();
            $('.indv_dtl').show();
        }else if(productId=='7'){
            $('.first_name_not_Freelance').text('Contractor Name');
            $('.last_name_not_Freelance').css('opacity', '0');;
            $('.cr_Number_not_Freelance').text('Identification Number');
            $('.cr_placeholder').attr('placeholder','Identification Number'); 
            $('.compny_name_hide').hide();
            $('.indv_dtl').show();
        }else if(productId=='10'){
            $('.first_name_not_Freelance').text('Consultant Name');
            $('.last_name_not_Freelance').css('opacity', '0');
            $('.cr_Number_not_Freelance').text('Identification Number');
            $('.cr_placeholder').attr('placeholder','Identification Number'); 
            $('.compny_name_hide').hide();
            $('.indv_dtl').show();
        }else{
            $('.first_name_not_Freelance').text('Contact Name');
            $('.last_name_not_Freelance').css('opacity', '0');
            $('.cr_Number_not_Freelance').text('Commercial Register Number');
            $('.cr_placeholder').attr('placeholder','Commercial Register Number');
            $('.compny_name_hide').show();
            $('.indv_dtl').hide();
        }            
    });
</script>

<script type="text/javascript"> 
    // $(document).on('change','.chng_cntry',function(){
    //    var country_id = $(this).val();
    //    $.ajax({
    //        url:"{{url('getStateOfStore')}}",
    //        data:{ country_id:country_id,_token:"{{ csrf_token() }}" },
    //        type:'POST',
    //        success:function(data){
    //         $('.state_class').html(data);
    //        } 
    //    }); 
    // });

    $("body").on('change','.chng_cntry',function(){
       var country_id = $(this).val();
       ths = $(this);
       // alert(country_id);
       $.ajax({
           url:"{{url('getCountryRelatedCities')}}",
           data:{ country_id:country_id,_token:"{{ csrf_token() }}" },
           type:'POST',
           success:function(data){
            $('.chng_city').html(data);
            // ths.closest('.addrs_div').find('.chng_city').html(data);
           } 
       }); 
    });
</script>


<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script type="text/javascript">
    var image_ids = [];
    $('#feed_post_id').val('');
    
    var myDropzone  = $('.drop_post_files').dropzone({ 
        url:"{{url('add/image')}}",
        acceptedFiles:"image/*",
        addRemoveLinks:true,
        maxFiles: 5,
        maxFilesize:20,
        init: function() {
            this.on("sending", function(file, xhr, formData){
                formData.append("_token", "{{csrf_token()}}");
            });
            this.on("addedfile", function(file) {
                if (!file.type.match(/image.*/)) {
                    this.emit("thumbnail", file, "{{asset('/public/frontend/imgs/post_images/thumb.jpeg')}}");
                }
            })
        },
        success:function(file, resp){
            file.stored_id = resp.img_id;
            image_ids.push(resp.img_id);
             $('#image_ids').val(image_ids);
            // alert(ppp);
        },    
        removedfile:function(file) {
            var file_id = file.stored_id;
                // var removename = file.name;
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{url('delete/image')}}",
                    type: "POST",
                    data: {'file_id': file_id, '_token': _token},
                    dataType:'json',
                    success:function(data){
                       
                    }
                });
                image_ids = jQuery.grep(image_ids, function(value) {
                  return value != file_id;
              });
                // // image_ids.pop(file_id);
                $('#image_ids').val(image_ids);
                file.previewElement.remove();
            }

        });
</script>

<!-- ////////////////////////////////Add Brand////////////////// -->

<script type="text/javascript">
    var brand_image_ids = [];
    $('#feed_post_id1').val('');
    
    var myDropzone  = $('.drop_brand_files').dropzone({ 
        url:"{{url('add/brand')}}",
        acceptedFiles:"image/*",
        addRemoveLinks:true,
        maxFiles: 5,
        maxFilesize:20,
        init: function() {
            this.on("sending", function(file, xhr, formData){
                formData.append("_token", "{{csrf_token()}}");
            });
            this.on("addedfile", function(file) {
                if (!file.type.match(/image.*/)) {
                    this.emit("thumbnail", file, "{{asset('/public/frontend/imgs/post_images/thumb.jpeg')}}");
                }
            })
        },
        success:function(file, resp){
            file.stored_id = resp.img_id;
            // alert(file.stored_id);
            brand_image_ids.push(resp.img_id);
             $('#brand_ids').val(brand_image_ids);
        },    
        removedfile:function(file) {
            var file_id = file.stored_id;
                // var removename = file.name;
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{url('delete/brand')}}",
                    type: "POST",
                    data: {'file_id': file_id, '_token': _token},
                    dataType:'json',
                    success:function(data){
                       
                    }
                });
                brand_image_ids = jQuery.grep(brand_image_ids, function(value) {
                  return value != file_id;
              });
                // // image_ids.pop(file_id);
                $('#brand_ids').val(brand_image_ids);
                file.previewElement.remove();
            }

        });
</script>



<script>
    $(document).ready(function(){

    $("#first_complete").click(function(){

       register_sec_next = $(this).closest('.register_sec').next(".register_sec");
       register_sec_prev = $(this).closest('.register_sec').prev(".register_sec");
       var  registered_id =  $('.registered_id').val();
       // function(form) {
          var dd=new FormData($(".first_form")[0]);
     
       if(registered_id==''){

            if ($('.first_form').valid()) {
                var imageIds = $('#image_ids').val();
                var brand_ids  = $('#brand_ids').val();

                // alert('here');
                console.log('here');
 
                    memberData = $(".first_form").serialize();
                    $.ajax({
                        url: "{{url('memberSignup/home')}}",
                        type:'post',
                        data:dd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            $('.registered_id').val(response['id']);                   
                            if(response['status']=="true"){
                             $('.register_sec').slideUp();
                             register_sec_next.slideDown().addClass('now');
                             register_sec_prev.removeClass('now');
                            
                             $(".first_dot").removeClass('active');
                             $(".second_dot").addClass('active');
                           }
                        },error(){
                            toastr.error('Something went wrong');
                        }
                    })
                
              
            }
        }else{
          // alert('first_exit');
             $('.register_sec').slideUp();
             $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
             $(this).closest('.register_sec').prev(".register_sec").removeClass('now'); 
             $(".first_dot").removeClass('active');
             $(".second_dot").addClass('active');
        }
        
        // },
      });

    });

</script>

<!-- <script type="text/javascript">
   $(document).on('click', '.chooseSubscriptionPack', function(){
        $('#fffffsubscription').modal('show');
        var data  = $(this).closest('div').find('.titleSubscription').text();
        var pack  = $(".subPack").text(data);
        $('.subs_pack_cls').val($(this).data('id'));        

        var subId = $(this).closest('div').find('.sub_id').val();
         $('#sub_active').val(subId);
        var  registered_id =  $('.registered_id').val();
    }); 
</script> -->

<script type="text/javascript">
   $(document).on('click', '.chooseSubscriptionPack', function(){
        $('#modelSubscription').modal('show');
        var data  = $(this).closest('div').find('.titleSubscription').text();
        var pack  = $(".subPack").text(data);
        $('.subs_pack_cls').val($(this).data('id'));        

        var subId = $(this).closest('div').find('.sub_id').val();
        // alert(subId);
        $('.plan_wrpr').removeClass('active');
        $(this).closest('.plan_wrpr').addClass('active');

        var selectedPlan = $('#sub_active').val(subId);

        var  registered_id =  $('.registered_id').val();
    }); 
</script>


<script type="text/javascript">
    $("#second_complete").click(function(){
    // register_sec_next = $(this).closest('.register_sec').next(".register_sec");
    // register_sec_prev = $(this).closest('.register_sec').prev(".register_sec");

        subId= $('#sub_active').val();
        registered_id =  $('.registered_id').val();
        var  subscribe_id =  $('.subscriptionId').val();

        if(subscribe_id==''){
             if(subId!=''){
                $.ajax({
                url: "{{url('subscription-pack-choosen')}}",
                type:'post',
                data:{registered_id:registered_id,subscribe_id:subscribe_id,subId:subId,_token:"{{ csrf_token() }}" },
                success:function(response){
                    $('.subscriptionId').val(response['id']);
                         // alert(response['id']);
                     if(response['status']=="true"){
                          $('.register_sec').slideUp();
                         $('.register_sec').removeClass('now');
                         $('.mk_pymtt').slideDown().addClass('now');

                         $(".second_dot").removeClass('active');
                         $(".third_dot").addClass('active');
                       }
                    
                },error(){
                    toastr.error('Something went wrong');
                }
            })
            }else{

                swal('Please select subscription pack');
            }
        
        }else{
              // alert('second_exit');
             $('.register_sec').slideUp();
             $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
             $(this).closest('.register_sec').prev(".register_sec").removeClass('now'); 
             $(".second_dot").removeClass('active');
             $(".third_dot").addClass('active');
        }
    
  });
</script>



<script type="text/javascript">
 $(".third_complete").click(function(){
    
     // var headerIdMenu = $(this).closest('div').find('.sub_id').val();

    $('#sub_active').val(subId);
    registered_id =  $('.registered_id').val();

    var  payment_id =  $('.payment_card_id').val(); 


         form ='';
        $('.paydata').each(function(){

            if($(this).hasClass('active')){

                // thirdform-PaymentFORM
                
                var attrName = $(this).attr('paymentType');
                // alert(attrName);
                if(attrName=='wallet-payment'){
                    form = null;
                }else if(attrName=='card-payment'){
                    form = 'thirdform';
                  // alert(form);
                }else if(attrName=='cash-payment'){
                    form = 'thirdform-PaymentFORM';
                   // alert(form);
                }else if(attrName=='sadad-payment'){
                    form = null;
                }else if(attrName=='wire-transfer-payment'){
                    form = 'fifth-WiretransferForm';
                     // console.log(form);
                }

            }
        });
           if ($('.'+form).valid() || form==null) {
               // alert(form);
               if(form =='thirdform-PaymentFORM'){
                 var formData = new FormData($('.thirdform-PaymentFORM')[0]);
                
                 var  cash_payment =  $('.cash_payment_id').val();

                    if(cash_payment==''){
                             
                        if ($('.thirdform-PaymentFORM').valid()) {
                            // alert('here');
                          $.ajax({
                                url: "{{url('provider/invoice-image')}}",
                                type:'post',
                                data:formData,                    
                                processData: false,
                                contentType: false,
                                success:function(response){
                                 $('.cash_payment_id').val(response['id']);
                                    if(response['status']=="true"){
                                        location.href='{{url('/login')}}';
                                         $('.register_sec').slideUp();
                                         $('.register_sec').removeClass('now');
                                         $('.stor_subs').slideDown().addClass('now');

                                         $(".third_dot").removeClass('active');
                                         $(".fourth_dot").addClass('active');
                                     }else{
                                            toastr.error('Something went wrong ');    
                                        }  
                                },
                                error(){
                                    toastr.error('Something went wrong');
                                }
                            })
                          }else{

                          }

                     }else{
                            location.href='{{url('/login')}}';
                       
                            $('.register_sec').slideUp();
                            $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
                            $(this).closest('.register_sec').prev(".register_sec").removeClass('now'); 
                            $(".third_dot").removeClass('active');
                            $(".fourth_dot").addClass('active');
                        }
               
               }else if(form =='thirdform'){
                    var  payment_id =  $('.payment_card_id').val(); 
                   if(payment_id==''){
                        $.ajax({
                            // url: "{{url('registered-card-types')}}",
                            url: "{{url('provider/invoice-image')}}",
                            type:'post',
                            data:$(".thirdform").serialize(),
                            success:function(response){
                              // alert(response);
                              $('.payment_card_id').val(response['id']);
                                if(response['status']=="true"){
                                    // alert('ddd');
                                    location.href='{{url('/login')}}';
                                     $('.register_sec').slideUp();
                                     $('.register_sec').removeClass('now');
                                     $('.stor_subs').slideDown().addClass('now');
                                     $(".third_dot").removeClass('active');
                                     $(".fourth_dot").addClass('active');
                                   }else{
                                      toastr.error('Something went wrong ');    
                                   } 
                                
                            },error(){
                                toastr.error('Please select invoice image ');
                            }
                        })

              }else{
                        location.href='{{url('/login')}}';
                        $('.register_sec').slideUp();
                        $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
                        $(this).closest('.register_sec').prev(".register_sec").removeClass('now'); 
                        $(".third_dot").removeClass('active');
                        $(".fourth_dot").addClass('active');
                    }
             }else if(form =='fifth-WiretransferForm'){
                    var  payment_id =  $('.payment_card_id').val(); 
                    var formData = new FormData($('.fifth-WiretransferForm')[0]);
                   if(payment_id==''){
                        $.ajax({
                          url: "{{url('provider/invoice-image')}}",
                            type:'post',
                            // data:$(".thirdform").serialize(),
                            data:formData,                    
                            processData: false,
                            contentType: false,
                            success:function(response){
                             
                             $('.payment_card_id').val(response['id']);
                                if(response['status']=="true"){
                                    location.href='{{url('/login')}}';
                                     $('.register_sec').slideUp();
                                     $('.register_sec').removeClass('now');
                                     $('.stor_subs').slideDown().addClass('now');

                                     $(".third_dot").removeClass('active');
                                     $(".fourth_dot").addClass('active');
                                  }else{
                                     toastr.error('Something went wrong ');    
                                  } 
                                
                            },error(){
                                toastr.error('Please select invoice image ');
                            }
                        })

                   }else{
                        location.href='{{url('/login')}}';
                       $('.register_sec').slideUp();
                       $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
                       $(this).closest('.register_sec').prev(".register_sec").removeClass('now'); 
                       $(".third_dot").removeClass('active');
                       $(".fourth_dot").addClass('active');
                    }
            } 
        }
  });
</script>

<script type="text/javascript">
 $(".fourth_submit").click(function(){
         
           memberData = $(".fourth_form").serialize();
           var  registered_id =  $('.registered_id').val();
          if ($('.fourth_form').valid()) {
            $.ajax({

            url: "{{url('registered-store_location')}}",
            type:'post',
            data:$(".fourth_form").serialize(),
            // data:$(".first_form").serialize(),
            success:function(response){
               if(response['status']=="true"){
                   location.href='{{url('/login')}}';
                   }     
                
            },error(){
                toastr.error('Something went wrong');
            }
        })
        }
    
  });
</script>

<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
         $('.wiretransfer-img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#wire_transfer_botonAjax").change(function() {
      readURL(this);
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        var userFormValidator = $('.fifth-WiretransferForm').validate({
            ignore:[],
            rules:{

                uploader_wiretransfer:{
                    required:true,
                }
            },
            messages:{

                uploader_wiretransfer:{
                    required:"Please select invoice image",
                }     
             },

        });
 });
</script>

<script>
    function readURL1(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
         $('.user-img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#botonAjax").change(function() {
      readURL1(this);
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        var userFormValidator = $('.thirdform-PaymentFORM').validate({
            ignore:[],
            rules:{

                uploader:{
                    required:true,
                }
            },
            messages:{

                uploader:{
                    required:"Please select invoice image",
                }     
             },

        });
 });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        var userFormValidator = $('.thirdform').validate({
            ignore:[],
            rules:{

                card_type:{
                    required:true,
                },
                name_on_card:{
                    required:true,
                    maxlength:100,
                },
                expiry_month:{
                    required:true,
                  
                },
                card_no:{
                    required:true,
                     digits: true,
                },
                expiry_year:{
                    required:true,
                },
                  cvv:{
                    required:true,
                     digits: true,
                }
            },
            messages:{

                card_type:{
                    required:"Please select card type",
                },     
                name_on_card:{
                    required:"Please enter your name on card",
                },
                 card_no:{
                    required:"Please enter card number",
                },
                expiry_month:{
                    required:"Please select expiry month",
                },
                expiry_year:{
                    required:"Please select expiry year",
                   
                },
                cvv:{
                    required:"Please enter cvv",
                }
             },

        });
 });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        var userFormValidator = $('.fourth_form').validate({
            ignore:[],
            rules:{

                store_name:{
                    required:true,
                },
                street:{
                    required:true,
                },
                country_id:{
                    required:true,
                  
                },
                state_id:{
                    required:true,
                  
                },
                city:{
                    required:true,
                     
                },
                location:{
                    required:true,
                }
                
            },
            messages:{

                store_name:{
                    required:"Please enter store name",
                },     
                street:{
                    required:"Please enter street",
                },
                country_id:{
                    required:"Please select country",
                },
                 state_id:{
                    required:"Please select state",
                },
                city:{
                    required:"Please enter city",
                
                },
                location:{
                    required:"Please enter location",
                }
             },

        });

       
 });
</script>

<script type="text/javascript">
    $('.stor_subs, .subs_pla, .mk_pymtt, .succ_reg').hide();
    $('.btn_nex').click(function(){
        // alert('here');
        $('.register_sec').slideUp();
        $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
        $(this).closest('.register_sec').prev(".register_sec").removeClass('now');
    });

    $('.btn_prev').click(function(){
        $('.register_sec').slideUp();
        $(this).closest('.register_sec').prev(".register_sec").slideDown().addClass('now');
        $(this).closest('.register_sec').next(".register_sec").removeClass('now');


        $('.list-inline-item').each(function(){
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $(this).prev('.list-inline-item').addClass('active');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // used for terms & conditions checkbox
        var agreeCheck = false;
        var ths;
        // personal details form validation
        var userFormValidator = $('.first_form').validate({
            ignore:[],
            rules:{
                user_type_id:{
                    required:true,
                },
                user_property_id:{
                    required:true,
                    maxlength:50,
                    // regex:name_regex, 
                    noSpace:true,
                },
                "user_service_id[]":{
                    // required:true,
                    required: {
                        depends: function(element){
                         
                        if (  $('#customCheck_123').is(':checked')) {
                                return false;
                        } else {
                                return true;
                        }
                    }
                },
                    maxlength:50,
                    // noSpace:true,
                },
                other_name:{
                    // required:true,
                    required: {
                        depends: function(element){
                         
                            if (  $('#customCheck_123').is(':checked')) {
                                    return true;
                            } else {
                                    return false;
                            }
                        }
                    },
                },
                experience:{
                    // required:true
                    required: {
                        depends: function(element){
                         
                            if (  $('.ths_slct').val()=='6') {
                                    return false;
                            } else {
                                    return true;
                            }
                        }
                    },
                },
                "project_field_ids[]":{
                    // required:true
                    required: {
                        depends: function(element){
                            // alert($('.ths_slct').val());
                            if (  $('.ths_slct').val()=='6') {
                                    return false;
                            } else {
                                    return true;
                            }
                        }
                    },
                },
                company_name:{
                    required: {
                        depends: function(element){
                         
                            if (  $('input[name=user_property_id]:checked').val()=='2' ||  $('input[name=user_property_id]:checked').val()=='7'|| $('input[name=user_property_id]:checked').val()=='10') {
                                    return false;
                            } else {
                                    return true;
                            }
                        }
                    },
                },
                country_id:{
                    required: {
                        depends: function(element){
                         
                            if (  $('input[name=user_property_id]:checked').val()=='2' ||  $('input[name=user_property_id]:checked').val()=='7'|| $('input[name=user_property_id]:checked').val()=='10') {
                                    return true;
                            } else {
                                    return false;
                            }
                        }
                    },
                },
                gender:{
                    required: {
                        depends: function(element){
                         
                            if (  $('input[name=user_property_id]:checked').val()=='2' ||  $('input[name=user_property_id]:checked').val()=='7'|| $('input[name=user_property_id]:checked').val()=='10') {
                                    return true;
                            } else {
                                    return false;
                            }
                        }
                    },
                },
                date_of_birth:{
                    required: {
                        depends: function(element){
                         
                            if (  $('input[name=user_property_id]:checked').val()=='2' ||  $('input[name=user_property_id]:checked').val()=='7'|| $('input[name=user_property_id]:checked').val()=='10') {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                },
                contact_name:{
                    required:true,
                    maxlength:100,
                },
                contact_last_name:{
                    required:true,
                    maxlength:100,
                },
                mobile_no:{
                    required:true,
                    number:true,
                    minlength:9,  
                    maxlength:15, 
                    remote: "{{url('/checkUserMobile')}}",
                },
                email:{
                    required:true,
                    maxlength:100,
                    regex: email_regex,
                    remote: "{{url('/checkUserEmail')}}",
                },
                password:{
                    required:true,
                    minlength:6,
                    maxlength:50,
                },
                confirm_password:{
                    required:true,
                    equalTo:"#password",
                },  
                "category_id[]":{
                    required:true,    
                },

                "material_id[]":{
                  required:true,  
                },

                about_me:{
                   required:true,
                   maxlength:300,
                },

                // profile_document:{
                //     required:true,
                //     // equalTo:"#password",
                // },
                // profile_link:{
                //     required:true,
                // },
                cr_number:{
                    required:true,
                },
                website_url:{
                    required:true,
                    url: true,
                    normalizer: function( value ) {
                        var url = value;                 
                        // Check if it doesn't start with http:// or https:// or ftp://
                        if ( url && url.substr( 0, 7 ) !== "http://"
                            && url.substr( 0, 8 ) !== "https://"
                            && url.substr( 0, 6 ) !== "ftp://" ) {
                          // then prefix with http://
                          url = "http://" + url;
                        }                 
                        // Return the new url
                        return url;
                    }
                },
                // additional_information:{
                //     required:true,
                // },
                address_line_1:{
                    required:true,
                },
                address_line_2:{
                    required:true,
                },

                landline:{
                    required:true,
                    number:true,
                    minlength:7,
                },

                postal_code:{
                    required:true,
                    number:true,
                    // minlength:,
                },
                store_name:{
                    required:true,
                },
                street:{
                    required:true,
                },
                location_country_id:{
                    required:true,
                },
                // city:{
                //     required:true,
                // },
                city_id:{
                    required:true,
                },
                location:{
                    required:true,
                },

                terms_conditions:{
                    required:true,
                }
                //   checked:{
                //     required:true
                // }
            },
            messages:{

                user_type_id:{
                    required:"Please select user type",
                },
                user_property_id:{
                    required:"Please select property",
                },
                "user_service_id[]":{
                    required:"Please select service",
                },       
                other_name:{
                    required:"Please select other service",
                },  
                experience:{
                    required:"Please select Years in Business"
                },
                "project_field_ids[]":{
                    required:"Please choose project fields"
                },          
                company_name:{
                    required:"Please enter company name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
                },            
                gender:{
                    required:"Please select gender",
                },            
                date_of_birth:{
                    required:"Please select date of birth",
                },
                contact_name:{
                    required:"Please enter first name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
                },
                contact_last_name:{
                    required:"Please enter last name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
                },
                mobile_no:{
                    required:"Please enter contact number",
                    minlength:"Minimum 9 characters are allowed",
                    maxlength:"Maximum 15 characters are allowed",
                    remote: 'Contact number already registered',
                },
                email:{
                    required:"Please enter email",
                    maxlength:"Maximum 100 characters are allowed",
                    regex: "Please enter valid email address",
                    remote: 'Email-id already registered',
                },
                password:{
                    required:"Please enter password",
                    maxlength:"Maximum 50 characters are allowed",
                    minlength:"Password must contain atleast 6 characters",
                },
                confirm_password:{
                    required: "Please re-enter password",
                    equalTo: "Confirm password did not match with password",
                },

                about_me:{
                  required:"Please enter about yourself",
                  maxlength:"Maximum 200 characters are allowed",
                }, 
                "category_id[]":{
                  required:"Please select category",
                },

                "material_id[]":{
                  required:"Please select selling material",
                },
                // profile_document:{
                //     required:"Please select profile document",
                // }, 
                // profile_link:{
                //     required:"Please enter profile link",
                // }, 
                cr_number:{
                    required:"This field is required",
                },
                website_url:{
                    required:"Please enter website url",
                },
                // additional_information:{
                //     required:"Please enter additional information",
                // },
                address_line_1:{
                    required:"Please enter address line 1",
                },
                address_line_2:{
                    required:"Please enter address line 2",
                },
                landline:{
                    required:"Please enter landline number",
                },                
                postal_code:{
                    required:"Please enter postal code",
                },
                store_name:{
                    required:"Please enter name",
                },     
                street:{
                    required:"Please enter street",
                },
                country_id:{
                    required:"Please choose nationality",
                },
                location_country_id:{
                    required:"Please select country",
                },
                // city:{
                //     required:"Please enter city",
                // },
                city_id:{
                    required:"Please select city",
                },
                location:{
                    required:"Please enter location",
                },
                 terms_conditions:{
                    required:"Please agree terms & conditions",
                }
             },

             errorPlacement: function(error, element) {
      
                if (element.attr("name") == "terms_conditions") {
                    error.insertAfter('#terms_conditions_id');
                } else {
                    error.insertAfter(element);
                }                             
            },


        });

       
 });
</script>


<!-- 
<script type="text/javascript">
    $('.ths_slct').on('change', function (){
        var selcVal = $(this).val()
        // return false;
        $.ajax({
        url: "{{url('member-userType')}}",
        type:'post',
        data:{selcVal:selcVal,_token:"{{ csrf_token() }}" },
        // dataType:'json',
        success:function(data){
            // alert(data);
            // alert(data['1']);

            $('.usr_prop').html(data['0']);
            $('.usr_servic').html(data['1']);
            
        },error(){
            toastr.error('Something went wrong');
        }
    })

    });
</script> -->



<script src="{{ url('public/frontend/js/intlTelInput.js')}}"  type="text/javascript"></script>
<script src="{{ url('public/frontend/js/intlTelInput-jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // IntlTelInput Plugin Initialization
    var inputIntl=$(".phone").intlTelInput({             
      allowDropdown: true,
      autoHideDialCode: true,
      autoPlaceholder: "",
      dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          var countryCode = (resp && resp.country) ? resp.country : "";
          callback(countryCode);
        });
      },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      preferredCountries: [],
      separateDialCode: true,
      utilsScript: "public``/frontend/js/utils.js",
    });
</script>
<script type="text/javascript">
    
    $("#phone1").on("countrychange", function(e, countryData) {

        var dial_code = $("#phone1").intlTelInput("getSelectedCountryData").dialCode;

        $('#isd_code1').val(dial_code);
    });

    $("#phone2").on("countrychange", function(e, countryData) {

        var dial_code = $("#phone2").intlTelInput("getSelectedCountryData").dialCode;

        $('#isd_code2').val(dial_code);
    });
</script>
<script type="text/javascript">
    $('#datetimepicker5').datetimepicker({
        maxDate: moment(),
        // formatDate:'Y/m/d',
        format: 'L',
        // endDate: '0d'
        defaultDate: '01/01/2000',
        // options.minDate: true,
        // ignoreReadonly: true
    });
</script>
<!-- Multiple select -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".selc_fields").select2({
            placeholder: "Choose from List"
        });
    });
</script>
@stop