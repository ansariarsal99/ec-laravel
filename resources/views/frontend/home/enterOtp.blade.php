@extends('frontend.layout.layout')
@section('title','Enter Otp')
@section('content')
    <section class="signuP_sec">
        <div class="custom_container">
            <div class="wrap_inr_OTP">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="wrp_white">
                            <div class="section-heading text-center">
                                <h2>OTP Verification</h2>
                            </div>
                            <div class="form_head">
                                <div class="text-center logo_login">
                                    <img src="{{asset('public/frontend/img/logo.png')}}" class="img-fluid">
                                </div>
                                <!-- <h5 class="text-center">Enter your Valid Mobile Number</h5> -->
                                <div class="form_head text-center">
                                    <h5>Please enter the OTP that you might have received on your registered contact number.</h5> 
                                    <!-- <p><strong>+ 91 94786 16633</strong> <small class="edt_num cp" data-toggle="modal" data-target="#numb_mod"> <i class="fa fa-edit"></i> Edit</small></p> -->
                                    <p><strong class="usr_mob_num">{{@$userDetail['mobile_no']}}</strong> <small class="edt_num cp"> <i class="fa fa-edit"></i> Edit</small></p>
                                    <!-- <h6>00:54s</h6> -->
                                    <h6><span id="resendTimer"></span></h6>
                                    <form id="otp_modal_form">
                                        <div class="col-sm-12">
                                            <div class="clearfix text-center otp_fields">
                                                <input type="text" class="form-control inpt_otp" id="otp1" minlength="1" maxlength="1" name="otp[]" />
                                                <input type="text" class="form-control inpt_otp" id="otp2" minlength="1" maxlength="1" name="otp[]" />
                                                <input type="text" class="form-control inpt_otp" id="otp3" minlength="1" maxlength="1" name="otp[]" />
                                                <input type="text" class="form-control inpt_otp" id="otp4" minlength="1" maxlength="1" name="otp[]" />
                                                <input type="text" class="form-control inpt_otp" id="otp5" minlength="1" maxlength="1" name="otp[]" />
                                                <input type="text" class="form-control inpt_otp" id="otp6" minlength="1" maxlength="1" name="otp[]" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-center log_btn">
                                                <p class="text-center resnd_otp rsend_btn">Haven't received OTP yet? <strong>Resend Code</strong></p>
                                                <!-- <a href="buildingMaterialServices.php" class="btn btn_theme"><span>Submit</span></a> -->
                                                <a href="javascript:;" class="btn btn_theme opt_submit_btn"><span>Submit</span></a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="encUserId" value="{{$encUserId}}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.include.modals.editMobileNumber')
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.otp_fields input').keyup(function(){
            var currleng = $(this).val().length;
            var maxleng = $(this).attr("maxlength");
            if(currleng == maxleng){
                $(this).next().focus();
            }
        });
        $('.otp_fields input').keydown(function(e) {
            if ((e.which == 8 || e.which == 46) && $(this).val() =='') {
                $(this).prev('input').focus();
            }
        });

        //resend otp disable enable
        var resendTimeLeft = 0;
        var timeElem = document.getElementById('resendTimer');
        var timerId;
        startCountdown();
        function startCountdown(){
            resendTimeLeft = 59;
            // $('.rsend_btn').attr('disabled',true);
            $('.rsend_btn').hide();
            $('#resendTimer').show();
            timerId = setInterval(countdown, 1000);
            // alert(timerId);
        }

        function countdown() {
            // alert(resendTimeLeft);
            if (resendTimeLeft == 0) {
                clearTimeout(timerId);
                doSomething();
            } else if(resendTimeLeft < 10 && resendTimeLeft != 0) {
                timeElem.innerHTML = '00:0'+resendTimeLeft+'s';
                resendTimeLeft--;
            }else{
                timeElem.innerHTML = '00:'+resendTimeLeft+'s';
                resendTimeLeft--;
            }
        }

        function doSomething() {
            // $('.rsend_btn').attr('disabled',false);
            $('.rsend_btn').show();
            $('#resendTimer').hide();
        }
        //resend otp disable enable end

        $("body").on('click','.edt_num',function(){
            $('.usr_edt_mob_num').val($('.usr_mob_num').text());
            $('.edt_opt_mob_modal').modal('show');
        });

        $("body").on('click','.updt_num',function(){
            $('.usr_mob_num').text($('.usr_edt_mob_num').val());
            $('.edt_opt_mob_modal').modal('hide');
        });

        $("body").on('click','.opt_submit_btn',function(){
            if ($('#otp1').val()!='' && $('#otp2').val()!='' && $('#otp3').val()!='' && $('#otp4').val()!='' && $('#otp5').val()!='' && $('#otp6').val()!='') {
                $('#otp_modal_form').submit();            
            }else{
                swal('', 'Please fill the otp', 'error');
            }
        });

        $('#otp_modal_form').validate({
            // ignore:[],
            rules:{
                'otp[]':{
                    required:true,
                },
                // 'otp_2':{
                //     required:true,
                // },
                // 'otp_3':{
                //     required:true,
                // },
                // 'otp_4':{
                //     required:true,
                // },
               
              
            },
            messages:{
                'otp[]':{
                    required:'Please enter digit',
                    // lettersonly:'Please enter letters only',
                },
                // 'otp_2':{
                //     required:'Please enter your name',
                //     // lettersonly:'Please enter letters only',
                // },
                // 'otp_3':{
                //     required:'Please enter your name',
                //     // lettersonly:'Please enter letters only',
                // },
                // 'otp_4':{
                //     required:'Please enter your name',
                //     // lettersonly:'Please enter letters only',
                // },
                
                
            },
            
            submitHandler:function(form){
                    // alert('no');
                    // var forms = $('#complete_profile_form').serializeArray();
                    $('.loader').show();
                    $.ajax({
                        // url : ajax_url+'/user/registerUser',
                        url : "{{url('/mobileOtpVerifyAjax')}}",
                        data : $('#otp_modal_form').serialize(),
                        type : 'post',

                        success : function(res){
                            // alert('yes');
                            $('.loader').hide();

                            if(res.status == 'success'){
                                // alert('success');
                                // swal('', 'Otp verified successfully', 'error');
                                swal({
                                  title: 'Otp verified successfully',
                                  // text: "You won't be able to revert this!",
                                  icon: 'success',
                                  showCancelButton: false,
                                  confirmButtonText: 'Ok'
                                }).then((result) => {
                                        window.location.replace("{{url('/login')}}");     
                                })
                            }else{
                                $('#otp_modal_form')['0'].reset();
                                swal('', 'Invalid otp', 'error');
                            }
                            

                        },
                        error : function(err){
                            alert(something_wrong);
                        }
                    });
                
                
            },
        })
    });
</script>
@stop