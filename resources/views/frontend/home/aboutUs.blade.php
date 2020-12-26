@extends('frontend.layout.layout')
@section('title','Terms & Conditions')
@section('content')

<style>
    .about_us_content {
        padding: 0px 100px;
    }
    .abou_lt_txt {
        width: 100px;
        padding: 40px 20px;
        border: 1px solid #999;
        color: #666;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .abou_lt_txt h6{
        writing-mode: sideways-lr;
        text-orientation: upright;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 2.5px;
        line-height: 14px;
    }
    .abou_lt_txt div{
        width: 1px;
        height: 85px;
        background: #999;
        display: inline-block;
        margin-top: 25px;
    }
    .abou_lt_txt span{
        font-size: 24px;
        line-height: 40px;
        font-weight: 600;
        display: inline-block;
        margin-top: 30px;
    }
    .about_rt_txt h5{
        font-weight: 500;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 7.5px;
        margin-bottom: 18px;
    }
    .about_rt_txt h4{
        font-size: 48px;
        line-height: 48px;
        margin-bottom: 70px;
        font-weight: 600;
    }
    .dot{
        color: #cc3f2f;
    }
    .about_rt_txt p{
        text-align: justify;
        color: #666;
        line-height: 30px;
    }
    .our_team_sec{
        padding: 100px 0 0;
    }
    .our_team_head h3{
        margin-bottom: 60px;
        font-size: 16px;
        line-height: 32px;
        text-transform: uppercase;
        letter-spacing: 15px;
        padding-left: 400px;
        font-weight: 600;
    }
    .our_team_head h3::before{
        position: absolute;
        content:'';
        top: 16px;
        left: 100px;
        width: 100px;
        height: 1px;
        background: #999;
    }
    .members_sec {
        padding: 80px 0;
    }
    .pic_1 {
        width: 130px;
        height: 130px;
        object-fit: cover;
        display: inline-block;
    }
    .pic_1 img{
        border-radius: 100%;
    }
    .pic_txt h4{
        font-size: 18px;
        line-height: 34px;
        font-weight: 600;
        margin-bottom: 0;
        text-transform: capitalize;
    }
    .works_img{
        overflow: hidden;
    }
    .works_img img{
        width: 100%;
        height: 380px;
        object-fit: cover;
        transition: all 300ms ease-in-out;
    }
    .works_img img:hover{
        transform: scale(1.05) rotate(3deg)
    }
    .sample_wetxt {
        padding: 70px 0 0;
    }
    .works_txt h4{
        margin-top: 25px;
    }
    .sample_wetxt h6{
        line-height: 32px;
    }
    .sample_wetxt p{
        line-height: 30px;
        color: #666;
        margin-bottom: 0;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">


        <div class="wrapper_shala"> 
            <section class="about_us_sec">
                <div class="container">
                    <!--  -->
                    <div class="about_us_content">
                        <div class="row">
                            <div class="col-lg-3 col-md-5 col-sm-12">
                                <div class="abou_lt_txt">
                                    <h6>who we are</h6>
                                    <div></div>
                                    <span>01</span>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-7 col-sm-12">
                                <div class="about_rt_txt">
                                    <h5 class="rt_heading">our history</h5>
                                    <h4 class="rt_ttl">Creative and renovate construction<span class="dot">.</span></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </section>
            <section class="our_team_sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="our_team_head">
                                <h3>our team</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team_full_img">
                    <img src="{{asset('public/frontend/images/aboutUs/4.jpg')}}" class="img-fluid">
                </div>
                <div class="team_members">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1 col-sm-12">
                                <div class="members_sec">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12">
                                            <article class="mem_pic text-center">
                                                <div class="pic_1">
                                                    <img src="{{asset('public/frontend/images/aboutUs/5.jpg')}}" class="img-fluid">
                                                </div>
                                                <div class="pic_txt mt-4">
                                                    <h4>Alberto Kayel</h4>
                                                    <p>CEO Founder</p>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <article class="mem_pic text-center">
                                                <div class="pic_1">
                                                    <img src="{{asset('public/frontend/images/aboutUs/1.jpg')}}"  class="img-fluid">
                                                </div>
                                                <div class="pic_txt mt-4">
                                                    <h4>Alberto Kayel</h4>
                                                    <p>CO Founder</p>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <article class="mem_pic text-center">
                                                <div class="pic_1">
                                                    <img src="{{asset('public/frontend/images/aboutUs/2.jpg')}}" class="img-fluid">
                                                </div>
                                                <div class="pic_txt mt-4">
                                                    <h4>Gabriel Eldo</h4>
                                                    <p>CEO Founder</p>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <article class="mem_pic text-center mt-5">
                                                <div class="pic_1">
                                                    <img src="{{asset('public/frontend/images/aboutUs/3.jpg')}}" class="img-fluid">
                                                </div>
                                                <div class="pic_txt mt-4">
                                                    <h4>Elia Giovani</h4>
                                                    <p>Product Manager</p>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <article class="mem_pic text-center mt-5">
                                                <div class="pic_1">
                                                    <img src="{{asset('public/frontend/images/aboutUs/41.jpg')}}" class="img-fluid">
                                                </div>
                                                <div class="pic_txt mt-4">
                                                    <h4>Dalton Garrin</h4>
                                                    <p>Leader Construction</p>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <article class="mem_pic text-center mt-5">
                                                <div class="pic_1">
                                                    <img src="{{asset('public/frontend/images/aboutUs/5.jpg')}}" class="img-fluid">
                                                </div>
                                                <div class="pic_txt mt-4">
                                                    <h4>Maria Slovakia</h4>
                                                    <p>Accounting</p>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="what_do_sec">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="our_team_head">
                                <h3>what we do</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom_container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="works_img">
                                <img src="{{asset('public/frontend/images/aboutUs/4.jpg')}}" class="img-fluid">
                            </div>
                            <div class="pic_txt works_txt text-center">
                                <h4>Construction</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="works_img">
                                <img src="{{asset('public/frontend/images/aboutUs/21.jpg')}}" class="img-fluid">
                            </div>
                            <div class="pic_txt works_txt text-center">
                                <h4>Interior Design</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="works_img">
                                <img src="{{asset('public/frontend/images/aboutUs/31.jpg')}}" class="img-fluid">
                            </div>
                            <div class="pic_txt works_txt text-center">
                                <h4>Renovation</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-sm-12">
                            <div class="sample_wetxt">
                                <h6>Lorem Khaled Ipsum is a major key to success. You do know, you do know that they don’t want you to have lunch.</h6>
                                <p><br>I’m keeping it real with you, so what you going do is have lunch. Special cloth alert. Don’t ever play yourself. You should never complain, complaining is a weak emotion, you got life, we breathing, we blessed. In life there will be road blocks but we will over come it. In life you have to take the trash out, if you have trash in your life, take it out, throw it away, get rid of it, major key.</p>
                                <br>
                                <br>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="join_our_team">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="our_team_head">
                                <h3>join our team !</h3>
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
            </section>

        </div>
 
        
           
@stop
@section('script')
@stop