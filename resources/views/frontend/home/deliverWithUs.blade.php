@extends('frontend.layout.layout')
@section('title','Deliver With Us')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/intlTelInput.css')}}">
<?php  
    $admin_image = defaultAdminImagePath.'/no_image.png';                                               
?>
<div class="register_sec bsns_dtl mt-3">
    <form class="deliverPersonSignUpForm">
        <div class="cont_rp_form">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-sm-10 mt-5">
                    <h6 class="reg_heding text-center mb-3">Registration of Delivery Person</h6>
                    <div class="addrs_div mt-4">
                        <div class="text-center img_user">
                            <div class="pos_rel pic_top">
                                <span class="img_edtt pos_rel">
                                    <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid inp_fl_img" id="prof_ch">
                                    <span class="edt_inpt">
                                        <i class="fa fa-edit"></i>
                                        <input type="file" name="profile_image" class="file_img botonAjax" attr_cls="inp_fl_img">
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group text-left">
                                    <label class="build_label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group text-left">
                                    <label class="build_label">Contact Name</label>
                                    <input type="text" name="contact_name" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group text-left">
                                    <label class="build_label" style="opacity: 0">Contact Name</label>
                                    <input type="text" name="contact_last_name" class="form-control" placeholder="Last Name">
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
                                <div class="form-group text-left">
                                    <label class="build_label">Email Address</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label class="build_label">Email Address</label>
                                    <input type="text" name="" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                        </div> -->
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
                                    <label class="build_label">Commercial Register Number</label>
                                    <input type="text" name="cr_number" class="form-control" placeholder="Commercial Register Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label class="build_label">Website URL</label>
                                    <div class="input-group">
                                        <input type="text" name="website_url" class="form-control" placeholder="https://www.example.com">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-link"></i></span>
                                        </div>
                                    </div>
                                    <label class="error" for="website_url"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label class="build_label">Additional Info</label>
                                    <input type="text" name="additional_information" class="form-control" placeholder="(If Any)">
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-2">Personal Information:</h6>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <!-- <label>Address</label> -->
                                    <input type="text" name="address_line_1" class="form-control mb-1" placeholder="Address Line 1, Building, Floor">
                                    <input type="text" name="address_line_2" class="form-control" placeholder="Address Line 2, Office Number">
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group intl_input text-left">
                                            <!-- <input type="tel" name="number" class="form-control" placeholder="Landline"> -->
                                            <input autocomplete="off" type="tel" name="landline" class="form-control phone" placeholder="Landline Number" value="+966"  id="phone2">
                                            <input type="hidden" class="form-control" name="landline_isd_code" id="isd_code2" value="966">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <!-- <input type="text" name="number" class="form-control" placeholder="Country"> -->
                                            <select class="form-control custom-select chng_cntry" name="country_id" type="text" value="">
                                                <option value="" selected disabled>Select Country </option>                          
                                                @foreach($countries as $country)
                                                    <option value="{{@$country['id']}}">{{@$country['name']}}</option>
                                                @endforeach                 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <!-- <input type="text" name="number" class="form-control" placeholder="City"> -->
                                            <select class="form-control custom-select chng_city" name="city_id">
                                            <option value="" disabled="" selected="">Select City</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="terms_conditions">
                                        <label class="custom-control-label" for="customCheck">I agree to the <a href="{{url('termsCondtion')}}" target="_blank" class="ter_links">Terms & Conditions.</a></label>
                                    </div>
                                    <label class="error" for="terms_conditions"></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="deliver_id" class="deliver_id" value="">
                    </div>
                    <div class="button_nex_prev">
                        <div class="">
                            <div class="form-group text-right">
                                <a class="btn btn_theme del_signUp_form_btn" href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></a>
                                <!-- <a class="btn btn_theme btn_nex" href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="register_sec subs_pla mt-3">
    <form class="vehicleInfoForm">
        <div class="cont_rp_form">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-sm-12">
                    <h6 class="reg_heding text-center mb-3">Vehicle Information</h6>
                    <div class="vehicle_contnt">
                        <input type="hidden" name="deliver_id" class="deliver_id" value="">
                        <div class="addrs_div vhcl_info_div">
                            <!-- <div class="svd_ic text-right">
                                <span class="cp text-danger rem_vehicle"><i class="fa fa-times"></i> Remove</span>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group text-left">
                                        <label class="build_label">Enter Number of Vehicle</label>
                                        <input type="text" name="vehicle_info[0][vehicle_number]" class="form-control" id="vehicleNum_0" placeholder="Number of Vehicle">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group text-left">
                                        <label class="build_label">Name of Vehicle</label>
                                        <input type="text" name="vehicle_info[0][vehicle_name]" class="form-control" id="vehicleNam_0" placeholder="Name of vehicle">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group text-left">
                                        <label class="build_label">Registration Number of Vehicle</label>
                                        <input type="text" name="vehicle_info[0][vehicle_registration_number]" class="form-control"  id="vehicleInfo_0" placeholder="Registration Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group text-left">
                                        <label class="build_label">Vehicle Chassis Number</label>
                                        <input type="text" name="vehicle_info[0][vehicle_chassis_number]" class="form-control"  id="vehicleChassis_0" placeholder="Enter Vehicle Chassis Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group single_img_upl text-center">
                                        <label class="build_label">Upload Vehicle ID</label>
                                        <div class="profle_pic text-center">
                                            <div class="img_prof text-center">
                                                <img src="{{@$admin_image}}" id="img-fluid" value="" class="img-fluid user-img inp_fl0_img">
                                                <span class="file_upload">
                                                    <i class="fa fa-pencil"></i>
                                                    <input accept="image/*" type="file" id="uploadVehicle_0" name="vehicle_info[0][image]" value="" class="file_type botonAjax" attr_cls="inp_fl0_img">
                                                </span>
                                                <label class="error text-center" for="uploadVehicle_0"></label>
                                            </div>
                                            <label id="botonAjax-error" class="error mt-3" for="botonAjax"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <span class="ad_vehicle_spn">+ Add Another Vehicle</span>
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
                                    <a class="btn btn_theme vehicle_info_form_btn" href="javascript:;"><span>Submit <i class="fa fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop
@section('script')
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
    $(document).ready(function(){
        $('.stor_subs, .subs_pla, .mk_pymtt, .succ_reg').hide();
        $('.btn_nex').click(function(){
            $('.register_sec').slideUp();
            $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
            $(this).closest('.register_sec').prev(".register_sec").removeClass('now');
        });
        $('.btn_prev').click(function(){
            $('.register_sec').slideUp();
            $(this).closest('.register_sec').prev(".register_sec").slideDown().addClass('now');
            $(this).closest('.register_sec').next(".register_sec").removeClass('now');
        });

        // function readURL1(input) {
        //     console.log("input ======== ",input);
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();            
        //         reader.onload = function(e) {
        //             $('.user-img').attr('src', e.target.result);
        //             // input.closest('.img_prof').find('.user-img').attr('src', e.target.result);
        //         }            
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }
        // $("body").on('change',".botonAjax",function() {
        //     readURL1(this);
        // });

        function readURL(input, attr_cls, this_url) {
            if (input.files && input.files[0]) {

                // this_url.next('label').find('span').text(input.files[0].name);
                // console.log(input.files[0].name);
                // alert(attr_cls);
                var reader = new FileReader();
                reader.onload = function(e) {
                  $('.'+attr_cls).attr('src', e.target.result);
                }                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('change','.botonAjax', function() {
            // alert($(this).attr('attr_cls'));
            readURL(this, $(this).attr('attr_cls'),$(this));
            // readURL(this, $(this).closest('.img_prof').find('.user-img').attr('attr_cls'),$(this));
        });

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

        // var deliverPersonSignUpFormValidator = $('.deliverPersonSignUpForm').validate({
        $('.deliverPersonSignUpForm').validate({
            ignore:[],
            rules:{
                company_name:{
                    required:true
                },
                contact_name:{
                    required:true,
                    maxlength:50,
                    // regex:name_regex, 
                    noSpace:true
                },
                contact_last_name:{
                    required:true,
                    maxlength:50,
                    // regex:name_regex, 
                    noSpace:true
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
                    maxlength:50
                },
                confirm_password:{
                    required:true,
                    equalTo:"#password"
                },
                cr_number: {
                    required: true,
                    maxlength:50
                },
                website_url: {
                    required: true,
                    maxlength:50
                }, 
                // additional_information: {
                //     required: true,
                //     maxlength:200
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
                    minlength:9,  
                    maxlength:15, 
                    remote: "{{url('/checkUserMobile')}}",
                }, 
                country_id:{
                    required:true,
                },
                city_id:{
                    required:true,
                },
                terms_conditions:{
                    required:true
                },
            },
            messages:{
                company_name:{
                    required:"Please enter company name"
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
                    equalTo: "Confirm password did not match with password"
                },         
                cr_number:{
                    required:"Please enter commercial register number",
                    maxlength:"Maximum 50 characters are allowed",
                },           
                website_url:{
                    required:"Please enter website url",
                    maxlength:"Maximum 50 characters are allowed",
                }, 
                additional_information:{
                    required:"Please enter additional info",
                    maxlength:"Maximum 200 characters are allowed",
                }, 
                address_line_1:{
                    required:"Please fill address line 1",
                },
                address_line_2:{
                    required:"Please fill address line 2",
                },  
                landline:{
                    required:"Please enter landline number",
                    minlength:"Minimum 9 characters are allowed",
                    maxlength:"Maximum 15 characters are allowed",
                    remote: 'Landline number already registered',
                }, 
                country_id:{
                    required:"Please select country",
                },
                city_id:{
                    required:"Please select city",
                },   
                terms_conditions:{
                    required:"Please agree terms & conditions"
                }
            },
            submitHandler: function(form) {
                // alert('here');
                // var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('/deliverWithUsRegistration')}}",
                    type: "post",
                    data: $('.deliverPersonSignUpForm').serialize(),
                    // data: da,
                    // contentType: false,
                    // processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        if (data.status=='success') {
                            $('.deliver_id').val(data.encUserId);
                            $('.register_sec').slideUp();
                            $('.del_signUp_form_btn').closest('.register_sec').next(".register_sec").slideDown().addClass('now');
                            $('.del_signUp_form_btn').closest('.register_sec').prev(".register_sec").removeClass('now');
                        }else{
                            toastr.error('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        $('.loader').hide();
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });

        $('.vehicleInfoForm').validate({
            ignore:[]
        });

        $("input[id^=vehicleNum_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please enter number of vehicle",
                  } 
              });   
        });

        $("input[id^=vehicleNam_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please enter name of vehicle",
                  } 
              });   
        });

        $("input[id^=vehicleInfo_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please enter registration number of vehicle",
                  } 
              });   
        });

        $("input[id^=vehicleChassis_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please enter vehicle chassis number",
                  } 
              });   
        });

        $("input[id^=uploadVehicle_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please upload vehicle id",
                  } 
              });   
        });

        $("body").on('click','.del_signUp_form_btn',function(){
            $('.deliverPersonSignUpForm').submit();

            // if ($('.deliverPersonSignUpForm').valid()) {
            //     $('.register_sec').slideUp();
            //     $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
            //     $(this).closest('.register_sec').prev(".register_sec").removeClass('now');
            // }

            // $('.register_sec').slideUp();
            // $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
            // $(this).closest('.register_sec').prev(".register_sec").removeClass('now');
        });

        
        
        $("body").on('click','.vehicle_info_form_btn',function(){
            if ($('.vehicleInfoForm').valid()) {
                // alert('valid');
                $('.loader').show();
                var vehicleForm=new FormData($(".vehicleInfoForm")[0]);
                // console.log("dd ========= ",vehicleForm);
                $.ajax({
                    url:"{{url('/deliverWithUsRegistration/addVehicles')}}",
                    type: "post",
                    // data:$('.deliverPersonSignUpForm').serialize(),
                    // data:$('.deliverPersonSignUpForm, .vehicleInfoForm').serialize(),
                    data:vehicleForm,
                    // data:deliveryPersonForm,
                    contentType: false,
                    processData: false,
                    success:function(resp){
                        if (resp.status=='success') {
                            // alert('success');
                            toastr.success('Delivery Person added successfully');
                            // window.location.href= "{{url('/')}}";
                            setInterval(function(){ window.location.href= "{{url('/')}}"; }, 1000);
                        }else{
                            $('.loader').hide();
                            toastr.error('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        $(".loader").hide();
                        swal('Oops, Something went wrong');
                    }
                });
            }
        });

        $("body").on('click','.ad_vehicle_spn',function(){
            var len = $('.vhcl_info_div').length; 
            // alert($('.vhcl_info_div').length);
            $('.vehicle_contnt').append('<div class="addrs_div vhcl_info_div"> <div class="svd_ic text-right"> <span class="cp text-danger rem_vehicle"><i class="fa fa-times"></i> Remove</span> </div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label class="build_label">Enter Number of Vehicle</label> <input type="text" name="vehicle_info['+len+'][vehicle_number]" class="form-control" id="vehicleNum_'+len+'" placeholder="Number of Vehicle"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label class="build_label">Name of Vehicle</label> <input type="text" name="vehicle_info['+len+'][vehicle_name]" class="form-control" id="vehicleNam_'+len+'" placeholder="Name of vehicle"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label class="build_label">Registration Number of Vehicle</label> <input type="text" name="vehicle_info['+len+'][vehicle_registration_number]" class="form-control" id="vehicleInfo_'+len+'" placeholder="Registration Number"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label class="build_label">Vehicle Chassis Number</label> <input type="text" name="vehicle_info['+len+'][vehicle_chassis_number]" class="form-control" id="vehicleChassis_'+len+'" placeholder="Enter Vehicle Chassis Number"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group single_img_upl text-center"> <label class="build_label">Upload Vehicle ID</label> <div class="profle_pic text-center"> <div class="img_prof text-center"> <img src="{{@$admin_image}}" id="img-fluid" name="invoice_image" value="" class="img-fluid user-img inp_fl'+len+'_img"> <span class="file_upload"> <i class="fa fa-pencil"></i> <input accept="image/*" type="file" id="uploadVehicle_'+len+'" name="vehicle_info['+len+'][image]" value="" class="file_type botonAjax" attr_cls="inp_fl'+len+'_img"> </span><label class="error text-center" for="uploadVehicle_'+len+'"></label> </div><label id="botonAjax-error" class="error mt-3" for="botonAjax"></label> </div></div></div></div></div>');

            $("input[id^=vehicleNum_").each(function(){
                  $(this).rules("add", {
                      required: true,
                       messages: {
                          required: "please enter number of vehicle",
                      } 
                  });   
            });

            $("input[id^=vehicleNam_").each(function(){
                  $(this).rules("add", {
                      required: true,
                       messages: {
                          required: "please enter name of vehicle",
                      } 
                  });   
            });

            $("input[id^=vehicleInfo_").each(function(){
                  $(this).rules("add", {
                      required: true,
                       messages: {
                          required: "please enter registration number of vehicle",
                      } 
                  });   
            });

            $("input[id^=vehicleChassis_").each(function(){
                  $(this).rules("add", {
                      required: true,
                       messages: {
                          required: "please enter vehicle chassis number",
                      } 
                  });   
            });

            $("input[id^=uploadVehicle_").each(function(){
                  $(this).rules("add", {
                      required: true,
                       messages: {
                          required: "please upload vehicle id",
                      } 
                  });   
            });
        });

        $("body").on('click', '.rem_vehicle', function(){
            $(this).parents('.addrs_div').remove();
        });

    });
</script>  
@stop