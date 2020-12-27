@extends('frontend.layout.layout')
@section('title','Terms & Conditions')
@section('content')

 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
<style>
    .contact_us_sec{
        background: url('./img/10.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-color: rgba(0,0,0,0.7);
        background-blend-mode: overlay;
        height: 460px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .contact_us_sec h2{
        color: #fff;
        font-size: 40px;
        letter-spacing: 25px;
    }
    .contact_details_wrap {
        padding: 90px 0;
    }
    .contact_details_wrap .custom_container{
        padding: 0 85px;
    }
    .contact_details_wrap h3{
        margin-bottom: 20px;
    }
    .contact_details_wrap p{
        margin-bottom: 0px;
        line-height: 1.6;
        color: #7d7d7d;
    }
    .details_header{
        margin-bottom: 60px;
    }
    .info_phone i{
        font-size: 36px;
    }
    .info_phone h4{
        font-size: 14px;
        line-height: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 10px 0 5px;
    }
    .info_phone p{
        margin-bottom: 0px;
        line-height: 1.6;
        color: #7d7d7d;
    }
    .brdr_none{
        padding: 40px 68px;
        margin: 0 0 0 -1px !important;
        
    }
    .brdr_left{
        padding: 40px 68px;
        border-left: 1px solid #e5e5e5;
        margin: 0 0 0 -1px !important;
    }
    .details_info{
        margin-bottom: 100px;
    }
</style>
<div class="wrapper_shala">
    <section class="contact_us_sec">
        <div class="custom_container">
            <!--  -->
            <div class="wrap_terms-condtns">
                <div class="row">
                    <div class="col-md-12">  
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </section>
    <section class="contact_details_wrap">
        <div class="custom_container">
            <!--  -->
            <div class="wrap_terms-condtns contct_iner_details">
                <div class="contct_iner_details">
                    <div class="details_header">
                        <div class="row">
                            <div class="col-md-12">  
                                <h3>Contact Details</h3>
                                <p>If you need any help, please contact us or send us an email or go to our forum. <br> We are sure that you can receive our reply as soon as possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="details_info">
                        <div class="row">
                            <div class="col-lg-4 brdr_none">
                                <div class="info_phone">
                                    <i class="fa fa-mobile"></i>
                                    <h4>Phone</h4>
                                    <p>Phone 01: (0091) 8547 632521</p>
                                    <p>Phone 01: (0091) 8547 632521</p>
                                </div>
                            </div>
                            <div class="col-lg-4 brdr_left">
                                <div class="info_phone">
                                    <i class="fa fa-map-marker"></i>
                                    <h4>Address</h4>
                                    <p>69 Halsey St, New York, Ny 10002, United States.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 brdr_left">
                                <div class="info_phone">
                                    <i class="fa fa-envelope-o"></i>
                                    <h4>mail</h4>
                                    <a href="javascript:;">support@buildmart.com</a>
                                    <a href="javascript:;">hello@buildmart.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="get_touch_details">
                    <div class="details_header">
                        <div class="row">
                            <div class="col-md-12">  
                                <h3>Get In Touch With Us</h3>
                                <p>If you have any question, Please don’t hesitate to send us a message</p>
                            </div>
                        </div>
                    </div>
                    <div class="ticuh_form">
                        <form>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Enter Your Name...">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="youemail@domain.com">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Subject (Optional)">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea rows="5" class="form-control" placeholder="Here goes your message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button_nex_prev mt-5">
                                <div class="form-group text-right">
                                    <a class="btn btn_theme btn_nex" href="javascript:;"><span>Send Message</span></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </section>
</div>           

@stop
@section('script')
@stop