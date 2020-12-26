@extends('frontend.layout.layout')
@section('title','Terms & Conditions')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
<style>
    .faq_items ul li{
        position: relative;
        margin-bottom: 30px;
        background: #fff;
        box-shadow: 0px 4px 13px -4px rgba(0,0,0,0.2);
    }
    .faq_items .accordion a {
        color: #cc3f2f;
        font-size: 17px;
        width: 100%;
        display: block;
        cursor: pointer;
        font-weight: 600;
        padding: 15px 0 15px 18px;
        border: 1px solid #cc3f2f;
    }
    .faq_items .accordion li a.active {
        color: #ffffff;
        background-color: #cc3f2f;
        border: 1px solid #cc3f2f;
    }
    .faq_items .accordion .inr_list {
        font-size: 15px;
        display: none;
        padding: 15px 45px 15px 20px;
        margin-bottom: 0;
        color: #737375;
        line-height: 1.6;
    }
    .faq_items .accordion a::after {
        position: absolute;
        right: 20px;
        content: "+";
        top: 10px;
        color: #232323;
        font-size: 25px;
        font-weight: 700;
    }
    .faq_items .accordion li a.active::after {
        content: "-";
        font-size: 25px;
        color: #ffffff;
    }
    .code-txt{
        padding-left: 20px;
    }
    .code-txt small{
        padding-left: 33px;
    }
</style>
<div class="wrapper_shala">        
    <section class="signuP_sec">
    <div class="custom_container">
        <!--  -->
        <div class="wrap_terms-condtns">
            <div class="row">
                <div class="col-md-12">  
                    <div class="mainside_wrap">
                        <div class="faq_items">
                            <ul type="none" class="accordion">
                                <li>
                                    <a class="active">Lorem ipsum dolor sit?</a>
                                    <div class="inr_list">
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </li>
                               <li>
                                    <a class="">Lorem ipsum dolor sit?</a>
                                    <div class="inr_list">
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </li>
                                <li>
                                    <a class="">Lorem ipsum dolor sit?</a>
                                    <div class="inr_list">
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
    </div>
    </section>
</div>            
@stop
@section('script')
<script>
    $('.accordion > li:eq(0) a').addClass('active').next().slideDown();
        $('.accordion a').on('click', function(j) {
            var dropDown = $(this).closest('li').find('.inr_list');
            $(this).closest('.accordion').find('.inr_list').not(dropDown).slideUp();
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                $(this).closest('.accordion').find('a.active').removeClass('active');
                $(this).addClass('active');
            }
            dropDown.stop(false, true).slideToggle();
            j.preventDefault();
        });
</script>
@stop