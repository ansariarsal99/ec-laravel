@extends('frontend.layout.layout')
@section('title','Sign Up')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/intlTelInput.css')}}">
    <section class="signuP_sec">
        <div class="custom_container">
            <div class="wrap_inr_signup">
                <div class="row">
                    <div class="col-md-8">  
                        <div class="wrap_signup_form">
                            <div class="page_numbers">
                                <div class="container">
                                    <ul class="numb_pag list-inline d-flex justify-content-around" type="none">
                                        <li class="list-inline-item bsns_dtl_li active"><span>1</span> Personal Details</li>
                                        <li class="list-inline-item stor_subs_li"><span>2</span> Address</li>
                                        <li class="list-inline-item"><span>3</span> Payment</li>
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
                                            <form class="userSignUpForm">
                                                @csrf
                                                <div class="cont_rp_form">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>User type</label>
                                                                <select name="user_type_id" class="form-control custom-select usr_type_cls">
                                                                    <option value="" selected>Choose User Type</option>
                                                                    <!-- <option value="individual">Individual</option>
                                                                    <option value="institution">Institution</option> -->
                                                                    @foreach($userTypes as $key => $userType)
                                                                        <option value="{{$userType['id']}}">{{$userType['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row insti_div">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>Institution Name</label>
                                                                <input type="text" name="institution_name" class="form-control" placeholder="Institution Name" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row insti_div">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>CR Number</label>
                                                                <input type="text" name="cr_number" class="form-control" placeholder="CR Number" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group text-left">
                                                                <label class="frst_nm_txt">First Name</label>
                                                                <input type="text" name="first_name" class="form-control frst_nm_plc" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group text-left">
                                                                <label class="last_nm_txt">Last Name</label>
                                                                <input type="text" name="last_name" class="form-control last_nm_plc" placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>Email Address</label>
                                                                <input type="text" name="email" class="form-control" placeholder="Email Address" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group intl_input text-left">
                                                                <label>Contact Number</label>
                                                                <input autocomplete="off" type="tel" name="mobile_no" class="form-control" placeholder="Contact Number" value="+966"  id="phone">
                                                                <input type="hidden" class="form-control" name="isd_code" id="isd_code" value="966">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>New Password</label>
                                                                <input autocomplete="off" type="password" id="password" name="password" class="form-control" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>Confirm New Password</label>
                                                                <input autocomplete="off" type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row insti_div">
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-left">
                                                                <label>Website Url</label>
                                                                <input type="text" name="website_url" class="form-control" placeholder="Website Url" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group text-left">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck_nw" name="terms_conditions">
                                                        <label class="custom-control-label" for="customCheck_nw">I agree to the <a href="{{url('termsCondtion')}}" class="ter_links" target="_blank"> Terms & Conditions.</a></label>
                                                    </div>
                                                    <!-- <label class="error" for="terms_conditions">Please agree terms & conditions</label> -->
                                                    <span class="error" id="terms_conditions_id"></span>
                                                </div>
                                            </form>
                                            <!-- <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="checked"> I agree Terms & Conditions</a>
                                                    </label>
                                                </div>
                                                <label class="error" for="checked"></label>
                                            </div> -->
                                        </div>
                                        <div class="button_nex_prev">
                                            <div class="">
                                                <div class="form-group text-right">
                                                    <a class="btn btn_theme usr_form" href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="register_sec stor_subs">
                                <div class="new_div_aded">
                                    <div class="sec_heading text-center">
                                        <h2>Address</h2>
                                    </div>
                                    <div class="wrap_register_white">
                                        <div class="inr_signup left_info">
                                            <form class="userDeliveryForm">
                                                <div class="cont_rp_form addr_prnt_div">
                                                    <div class="addrs_div">
                                                        <!-- <div class="svd_ic text-right">
                                                            <span class="cp text-danger addrs_rmv"><i class="fa fa-times"></i> Remove</span>
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Address Title/Name</label>
                                                                    <input type="text" name="address_title[]" class="form-control" placeholder="Home/Office/Store">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Address Detail</label>
                                                                    <input type="text" name="address[]" class="form-control" placeholder="Builiding Name/Floor No./Office No.">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Province</label>
                                                                    <input type="text" name="province_name[]" class="form-control" placeholder="Province Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Postal Code</label>
                                                                    <input type="text" name="postal_code[]" class="form-control" placeholder="Postal Code">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group text-left">
                                                                    <label>Country</label>
                                                                    <select name="country_id[]" class="form-control custom-select chng_cntry">
                                                                        <option value="" disabled="" selected>Select Country</option>
                                                                        @foreach($countries as $key => $country)
                                                                            @if(!empty($country))
                                                                                <option value="{{@$country['id']}}">{{@$country['name']}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group text-left">
                                                                    <label>City</label>
                                                                    <!-- <input type="text" name="city[]" class="form-control" placeholder="City"> -->
                                                                    <select class="form-control custom-select chng_city" name="city_id[]">
                                                                        <option value="" disabled="" selected="">Select City</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Location</label>
                                                                    <input id="pac-input" type="text" name="location[]" class="form-control" placeholder="Location">
                                                                    <!-- <input type="hidden" name="latitude" id="map_loc_lat_id">
                                                                    <input type="hidden" name="longitude" id="map_loc_lng_id">
                                                                    <div class="map"></div>
                                                                    <input type="text" id="pac-input" class="form-control" name="location[]" placeholder="Search Location" value="">
                                                                    <span>
                                                                        <label class="error" for="pac-input"></label>
                                                                    </span> -->
                                                                </div>
                                                                <div class="form-group text-left">
                                                                    <div class="adrs_map">
                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d231350.7620923537!2d55.1940508!3d25.0389721!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41ea57253d9dc545!2sOkzeela%20Star%20Building%20Materials%20Trading%20llc!5e0!3m2!1sen!2sin!4v1589633056776!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                               
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group text-left">
                                                            <span class="ad_adrs_spn">+ Add Another Address</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group text-right">
                                                            <span class="skpi_spn dlvry_form">SKIP <i class="fa fa-angle-double-right"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="addrs_count" class="addrs_count_cls" value="1">
                                            </form>                                            
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
                                                        <a class="btn btn_theme dlvry_form" href="javascript:;"><span>Next <i class="fa fa-arrow-right"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="register_sec docs_upload">
                                <div class="new_div_aded">
                                    <div class="sec_heading text-center">
                                        <h2>Payment Info</h2>
                                    </div>
                                    <div class="wrap_register_white">
                                        <div class="uplod_docs">
                                            <form class="userPaymentForm">
                                                <div class="cont_rp_form cards_prnt_div">
                                                    <div class="ad_cards_div">
                                                        <!-- <div class="svd_ic text-right">
                                                            <span class="cp text-danger"><i class="fa fa-times"></i> Remove</span>
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Card Type</label>
                                                                    <select name="card_type[]" class="form-control custom-select">
                                                                        <option value="" selected>Select Card</option>
                                                                        <option value="debit_card">Debit Card</option>
                                                                        <option value="credit_card">Credit Card</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Card Number</label>
                                                                    <input type="text" name="card_no[]" class="form-control" placeholder="Card Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Name on Card</label>
                                                                    <input type="text" name="name_on_card[]" class="form-control" placeholder="Name on Card">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Expiry Date</label>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group text-left">
                                                                            <select name="expiry_month[]" class="form-control custom-select">
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
                                                                            <select name="expiry_year[]" class="form-control custom-select">
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
                                                                    <input type="password" name="cvv[]" class="form-control" placeholder="CVV Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group text-left">
                                                            <span class="ad_card_spn">+ Add Another Card</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group text-right">
                                                            <span class="skpi_spn usr_reg">SKIP <i class="fa fa-angle-double-right"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="cards_count" class="cards_count_cls" value="1">
                                            </form>
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
                                                        <!-- <a class="btn btn_theme" href="{{url('enterOtp')}}"><span>Submit <i class="fa fa-arrow-right"></i></span></a> -->
                                                        <a class="btn btn_theme usr_reg" href="javascript:;"><span>Submit <i class="fa fa-arrow-right"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="rgt_info text-center d-flex flex-column justify-content-center">
                            <h2>NEW CUSTOMERS</h2>
                            <p>By creating an account with Mawad Mart, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <p class="alrdy">Already have an account?</p>
                            <a href="{{url('login')}}" class="btn btn_theme"><span>Login Now</span></a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
<script type="text/javascript">
    var default_map_position = {lat:28.5275198, lng:77.0688973};
</script>
<script src="{{url('public/frontend/js/common_map.js')}}"></script> 

<script type="text/javascript">
    $(document).ready(function(){
        var active;
        $('.stor_subs, .docs_upload, .succ_reg').hide();
        $('.btn_nex').click(function(){
            active = $('.numb_pag').find('.active');
            active.removeClass('active');
            active.next().addClass('active');
            $('.register_sec').slideUp();
            $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
            $(this).closest('.register_sec').prev(".register_sec").removeClass('now');
        });
        $('.btn_prev').click(function(){
            active = $('.numb_pag').find('.active');
            active.removeClass('active');
            active.prev().addClass('active');
            $('.register_sec').slideUp();
            $(this).closest('.register_sec').prev(".register_sec").slideDown().addClass('now');
            $(this).closest('.register_sec').next(".register_sec").removeClass('now');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.insti_div').hide();
        $("body").on('change','.usr_type_cls',function(){
            // alert($(this).val());
            if ($(this).val()==1) {
                $('.frst_nm_txt').text('First Name');
                $('.frst_nm_plc').attr('placeholder','First Name');
                $('.last_nm_txt').css('opacity', '1');
                $('.last_nm_txt').text('Last Name');
                $('.last_nm_plc').attr('placeholder','Last Name');
                $('.insti_div').hide();
            }else{
                $('.frst_nm_txt').text('Contact Name');
                $('.frst_nm_plc').attr('placeholder','First Name');
                $('.last_nm_txt').css('opacity', '0');
                $('.last_nm_plc').attr('placeholder','Last Name');
                $('.insti_div').show();
            }
        });
        // used for terms & conditions checkbox
        var agreeCheck = false;
        var ths;
        // personal details form validation
        var userFormValidator = $('.userSignUpForm').validate({
            ignore:[],
            rules:{
                user_type:{
                    required:true
                },
                first_name:{
                    required:true,
                    maxlength:50,
                    // regex:name_regex, 
                    noSpace:true
                },
                last_name:{
                    required:true,
                    maxlength:50,
                    // regex:name_regex, 
                    noSpace:true
                },
                institution_name: {
                    required: {
                        depends: function () {
                            return $('.usr_type_cls').val() == "2";
                        }
                    },
                    maxlength:50
                },
                cr_number: {
                    required: {
                        depends: function () {
                            return $('.usr_type_cls').val() == "2";
                        }
                    },
                    maxlength:50
                },
                website_url: {
                    required: {
                        depends: function () {
                            return $('.usr_type_cls').val() == "2";
                        }
                    },
                    maxlength:50
                },
                email:{
                    required:true,
                    maxlength:100,
                    regex: email_regex,
                    remote: "{{url('/checkUserEmail')}}",
                },
                mobile_no:{
                    required:true,
                    number:true,
                    minlength:9,  
                    maxlength:15, 
                    remote: "{{url('/checkUserMobile')}}",
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
                terms_conditions:{
                    required:true
                },
                checked:{
                    required:true
                }
            },
            messages:{
                user_type:{
                    required:"Please select user type"
                },
                first_name:{
                    required:"Please enter first name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
                },
                last_name:{
                    required:"Please enter last name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
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
                mobile_no:{
                    required:"Please enter contact number",
                    minlength:"Minimum 9 characters are allowed",
                    maxlength:"Maximum 15 characters are allowed",
                    remote: 'Contact number already registered',
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
                terms_conditions:{
                    required:"Please agree terms & conditions"
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

        var deliveryFormValidator = $('.userDeliveryForm').validate({
            ignore:[],
            rules:{
                "postal_code[]":{
                    digits:true
                },
            },
            messages:{
                "postal_code[]":{
                    required:"Please select user type"
                },
            },
        });

        // custom terms & conditions validation
        // $("body").on('change','#customCheck_nw',function(){
        //     if ($('input#customCheck_nw').is(':checked')) {
        //         agreeCheck = true;
        //         $('#terms_conditions_id').text('');
        //     }else{
        //         agreeCheck = false;
        //         $('#terms_conditions_id').text('Please agree terms & conditions');
        //     }
        // });

        // custom terms & conditions validation and proceed to Delivery Address
        $("body").on('click','.usr_form',function(e){
            e.preventDefault();

            // if ($('input#customCheck_nw').is(':checked')) {
            //     agreeCheck = true;
            //     $('#terms_conditions_id').text('');
            // }else{
            //     agreeCheck = false;
            //     $('#terms_conditions_id').text('Please agree terms & conditions');
            // }
            // alert(agreeCheck);
            if ($('.userSignUpForm').valid()) {
                active = $('.numb_pag').find('.active');
                active.removeClass('active');
                active.next().addClass('active');
                $('.register_sec').slideUp();
                $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
                $(this).closest('.register_sec').prev(".register_sec").removeClass('now');
            }
        }); 

        // sign up all forms submission
        $("body").on('click','.usr_reg',function(){
            $('.loader').show();
            $.ajax({
                url:"{{url('userRegistration')}}",
                type: "post",
                data:$('.userSignUpForm, .userDeliveryForm, .userPaymentForm').serialize(),
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        window.location.href= "{{url('enterOtp')}}"+"/"+resp.encUser;
                    }else{
                        toastr.error('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
        }); 

        // // get states of selected country
        // $("body").on('change', '.country_id_class', function(){
        //     $('.loader').show();
        //     var countryId = $(this).val();
        //     ths = $(this);
        //     // $('.region_request_class').val(regionId);
        //     $.ajax({
        //         url: "{{ url('/getStates') }}",
        //         data: {countryId:countryId},
        //         type: 'POST',
        //         success: function (data) {
        //             $('.loader').hide();
        //             // $('.state_id_class').html(data);
        //             // $('.city_id_class').html("<option value='' selected disabled> Select Town </option>");
        //             ths.closest('.addrs_div').find('.state_id_class').html(data);
        //             ths.closest('.addrs_div').find('.city_id_class').html("<option value='' selected disabled> Select Town </option>");
        //          }         
        //     });
        // });
        // // get cities of selected country
        // $("body").on('change', '.state_id_class', function(){   
        //     $('.loader').show(); 
        //     ths = $(this);       
        //     // const countryId = $('.region_request_class').val();
        //     const countryId = ths.closest('.addrs_div').find('.country_id_class option:selected').val();
        //     const stateId =$(this).val();
        //     // alert(countryId);
        //     // alert(stateId);
        //     $.ajax({
        //         url: "{{ url('/getCities') }}",
        //         data: {countryId:countryId, stateId:stateId},
        //         type: 'POST',
        //         success: function (data) {
        //             $('.loader').hide();
        //             ths.closest('.addrs_div').find('.city_id_class').html(data);
        //         }         
        //     });
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
                // $('.chng_city').html(data);
                ths.closest('.addrs_div').find('.chng_city').html(data);
               } 
           }); 
        });

        // append new address div
        $("body").on('click','.ad_adrs_spn',function(){
            $('.addr_prnt_div').append('<div class="addrs_div"> <div class="svd_ic text-right"> <span class="cp text-danger addrs_rmv"><i class="fa fa-times"></i> Remove</span> </div> <div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Address Title/Name</label> <input type="text" name="address_title[]" class="form-control" placeholder="Home/Office/Store"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Address Detail</label> <input type="text" name="address[]" class="form-control" placeholder="Builiding Name/Floor No./Office No."> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Province</label> <input type="text" name="province_name[]" class="form-control" placeholder="Province Name"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Postal Code</label> <input type="text" name="postal_code[]" class="form-control" placeholder="Postal Code"> </div></div></div><div class="row"> <div class="col-sm-6"> <div class="form-group text-left"> <label>Country</label> <select name="country_id[]" class="form-control custom-select chng_cntry"> <option value="" disabled="" selected>Select Country</option> @foreach($countries as $key=> $country) @if(!empty($country)) <option value="{{@$country["id"]}}">{{@$country["name"]}}</option> @endif @endforeach </select> </div></div><div class="col-sm-6"><div class="form-group text-left"><label>City</label><!-- <input type="text" name="city[]" class="form-control" placeholder="City"> --><select class="form-control custom-select chng_city" name="city_id[]"><option value="" disabled="" selected="">Select City</option></select></div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Location</label> <input id="pac-input" type="text" name="location[]" class="form-control" placeholder="Location"><!-- <input type="hidden" name="latitude" id="map_loc_lat_id"> <input type="hidden" name="longitude" id="map_loc_lng_id"> <div class="map"></div><input type="text" id="pac-input" class="form-control" name="location[]" placeholder="Search Location" value=""> <span> <label class="error" for="pac-input"></label> </span> --> </div><div class="form-group text-left"> <div class="adrs_map"> <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d231350.7620923537!2d55.1940508!3d25.0389721!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41ea57253d9dc545!2sOkzeela%20Star%20Building%20Materials%20Trading%20llc!5e0!3m2!1sen!2sin!4v1589633056776!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> </div></div></div></div></div>');
            // $('.addr_prnt_div').append('<div class="addrs_div"> <div class="svd_ic text-right"> <span class="cp text-danger addrs_rmv"><i class="fa fa-times"></i> Remove</span> </div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Address Title/Name</label> <input type="text" name="address_title[]" class="form-control" placeholder="Home/Office/Store"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Address Detail</label> <input type="text" name="address[]" class="form-control" placeholder="Builiding Name/Floor No./Office No."> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Province</label> <input type="text" name="province_name[]" class="form-control" placeholder="Province Name"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Postal Code</label> <input type="text" name="postal_code[]" class="form-control" placeholder="Postal Code"> </div></div></div><div class="row"> <div class="col-sm-6"> <div class="form-group text-left"> <label>City</label> <input type="text" name="city[]" class="form-control" placeholder="City"> </div></div><div class="col-sm-6"> <div class="form-group text-left"> <label>Country</label> <select name="country_id[]" class="form-control custom-select country_id_class"> <option value="" disabled="" selected>Select Country</option> @foreach($countries as $key=> $country) @if(!empty($country)) <option value="{{@$country["id"]}}">{{@$country["name"]}}</option> @endif @endforeach </select> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Location</label> <input type="hidden" name="latitude" id="map_loc_lat_id"> <input type="hidden" name="longitude" id="map_loc_lng_id"> <div class="map"></div><input type="text" id="pac-input" class="form-control" name="location[]" placeholder="Search Location" value=""> <span> <label class="error" for="pac-input"></label> </span> </div></div></div></div>');
            $('.addrs_count_cls').val(parseInt($('.addrs_count_cls').val())+1);
        });

        // remove new address div
        $("body").on('click','.addrs_rmv',function(){
            $(this).closest('.addrs_div').remove();
            $('.addrs_count_cls').val(parseInt($('.addrs_count_cls').val())-1);
        });

        // append new card div
        $("body").on('click','.ad_card_spn',function(){
            // $('.cards_prnt_div').append('<div class="ad_cards_div"><div class="svd_ic text-right"> <span class="cp text-danger cards_rmv"><i class="fa fa-times"></i> Remove</span> </div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Card Type</label> <select name="card_type[]" class="form-control custom-select"> <option selected>Select Card</option> <option value="master_card">Master Card</option> <option value="net_banking">Net Banking</option> <option value="american_express">American Express</option> </select> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Card Number</label> <input type="text" name="card_no[]" class="form-control" placeholder="Card Number"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Name on Card</label> <input type="text" name="name_on_card[]" class="form-control" placeholder="Name on Card"> </div></div></div><div class="row"> <div class="col-sm-6"> <label>Expiry Date</label> <div class="row"> <div class="col-sm-6"> <div class="form-group text-left"> <select name="expiry_month[]" class="form-control custom-select"> <option selected>Month</option> <option value="01">01</option> <option value="02">02</option> <option value="03">03</option> <option value="04">04</option> <option value="05">05</option> <option value="06">06</option> <option value="07">07</option> <option value="08">08</option> </select> </div></div><div class="col-sm-6"> <div class="form-group text-left"> <select name="expiry_year[]" class="form-control custom-select"> <option selected>Year</option> <option value="2021">2021</option> <option value="2022">2022</option> <option value="2023">2023</option> <option value="2024">2024</option> <option value="2025">2025</option> <option value="2026">2026</option> <option value="2027">2027</option> <option value="2028">2028</option> </select> </div></div></div></div><div class="col-sm-6"> <div class="form-group text-left"> <label>CVV Number</label> <input type="password" name="cvv[]" class="form-control" placeholder="CVV Number"> </div></div></div></div>');
            $('.cards_prnt_div').append('<div class="ad_cards_div"> <div class="svd_ic text-right"> <span class="cp text-danger cards_rmv"><i class="fa fa-times"></i> Remove</span> </div> <div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Card Type</label> <select name="card_type[]" class="form-control custom-select"> <option value="" selected>Select Card</option> <option value="debit_card">Debit Card</option> <option value="credit_card">Credit Card</option> </select> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Card Number</label> <input type="text" name="card_no[]" class="form-control" placeholder="Card Number"> </div></div></div><div class="row"> <div class="col-sm-12"> <div class="form-group text-left"> <label>Name on Card</label> <input type="text" name="name_on_card[]" class="form-control" placeholder="Name on Card"> </div></div></div><div class="row"> <div class="col-sm-6"> <label>Expiry Date</label> <div class="row"> <div class="col-sm-6"> <div class="form-group text-left"> <select name="expiry_month[]" class="form-control custom-select"> <option value="" selected>Month</option> <option value="01">01</option> <option value="02">02</option> <option value="03">03</option> <option value="04">04</option> <option value="05">05</option> <option value="06">06</option> <option value="07">07</option> <option value="08">08</option> <option value="09">09</option> <option value="10">10</option> <option value="11">11</option> <option value="12">12</option> </select> </div></div><div class="col-sm-6"> <div class="form-group text-left"> <select name="expiry_year[]" class="form-control custom-select"> <option value="" selected>Year</option> @for($i=0; $i < 10; $i++) <option value="{{date('Y')+$i}}">{{date('Y')+$i}}</option> @endfor </select> </div></div></div></div><div class="col-sm-6"> <div class="form-group text-left"> <label>CVV Number</label> <input type="password" name="cvv[]" class="form-control" placeholder="CVV Number"> </div></div></div></div>');
            $('.cards_count_cls').val(parseInt($('.cards_count_cls').val())+1);
        });

        // remove new card div
        $("body").on('click','.cards_rmv',function(){
            $(this).closest('.ad_cards_div').remove();
            $('.cards_count_cls').val(parseInt($('.cards_count_cls').val())-1);
        });

        // delivery address form validate
        $("body").on('click','.dlvry_form',function(e){
            e.preventDefault();
            // $('.userDeliveryForm').validate();
            if ($('.userDeliveryForm').valid()) {
                // alert('yes');
                active = $('.numb_pag').find('.active');
                active.removeClass('active');
                active.next().addClass('active');
                $('.register_sec').slideUp();
                $(this).closest('.register_sec').next(".register_sec").slideDown().addClass('now');
                $(this).closest('.register_sec').prev(".register_sec").removeClass('now');
            }else{
                // alert('no');
            }
        });

    });

</script>

<!-- <script>
  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    var types = document.getElementById('type-selector');
    var strictBounds = document.getElementById('strict-bounds-selector');

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);

    // Set the data fields to return when the user selects a place.
    autocomplete.setFields(
        ['address_components', 'geometry', 'icon', 'name']);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }

      infowindowContent.children['place-icon'].src = place.icon;
      infowindowContent.children['place-name'].textContent = place.name;
      infowindowContent.children['place-address'].textContent = address;
      infowindow.open(map, marker);
    });

    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    // function setupClickListener(id, types) {
    //   var radioButton = document.getElementById(id);
    //   radioButton.addEventListener('click', function() {
    //     autocomplete.setTypes(types);
    //   });
    // }

    // setupClickListener('changetype-all', []);
    // setupClickListener('changetype-address', ['address']);
    // setupClickListener('changetype-establishment', ['establishment']);
    // setupClickListener('changetype-geocode', ['geocode']);

    // document.getElementById('use-strict-bounds')
    //     .addEventListener('click', function() {
    //       console.log('Checkbox clicked! New state=' + this.checked);
    //       autocomplete.setOptions({strictBounds: this.checked});
    //     });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZWz-S1fLrUrzZ4OVeoREuZIIdnWTMwEU&libraries=places&callback=initMap"
    async defer></script> -->




<!-- <script type="text/javascript">
    var default_map_position = {lat:28.5275198, lng:77.0688973};
    getScript();
    var geocoder="";
    function initAutocomplete() {
        geocoder = new google.maps.Geocoder();
        
        var map = new google.maps.Map(document.getElementById('map'), {
          center: default_map_position,
          zoom: 10,
          mapTypeId: 'roadmap'
        });
        var markers = [];

        var icon = {
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        markers = new google.maps.Marker({
          map: map,
          draggable: true,
          //icon: icon,
          title: '',
          position: default_map_position
        });

        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        google.maps.event.addListener(map, 'click', function(event) {
            markers.setPosition(event.latLng);
            setMapLatLngToInput(event.latLng);
            setAddressToInput(event.latLng);
        });

        markers.addListener('dragend', function(event){
            setMapLatLngToInput(event.latLng);
            setAddressToInput(event.latLng);
        });


        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
            return;
          }

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            markers.setPosition(place.geometry.location);
            // alert(place.geometry.location.lat()+", "+place.geometry.location.lng());
            
            /*setting lat longs in input fields @29-march subodh*/
            setMapLatLngToInput(place.geometry.location);
            /*setting lat longs in input fields @29-march subodh end*/

            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
    }

    function setMapLatLngToInput(data){
        $('#map_loc_lat_id').val(data.lat());
        $('#map_loc_lng_id').val(data.lng());
    }

    function setAddressToInput(data){
        geocoder.geocode({
            'latLng': data
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#pac-input').val(results[0].formatted_address);
                }
            }
        });
    }

    function getScript() {
      var s = document.createElement('script');
      
      s.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDZWz-S1fLrUrzZ4OVeoREuZIIdnWTMwEU&libraries=places&callback=initAutocomplete";
      document.body.appendChild(s);
    }
</script> -->

<script src="{{ url('public/frontend/js/intlTelInput.js')}}"  type="text/javascript"></script>
<script src="{{ url('public/frontend/js/intlTelInput-jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // IntlTelInput Plugin Initialization
    var inputIntl=$("#phone").intlTelInput({             
      allowDropdown: true,
      autoHideDialCode: true,
      autoPlaceholder: "",
      dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            // alert(resp);
          var countryCode = (resp && resp.country) ? resp.country : "";
          // alert(countryCode);
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
    
    $("#phone").on("countrychange", function(e, countryData) {

        var dial_code = $("#phone").intlTelInput("getSelectedCountryData").dialCode;

        $('#isd_code').val(dial_code);
    });
</script>
@stop