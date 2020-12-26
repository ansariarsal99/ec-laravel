<?php $footerDetail = App\Footer::first(); ?>
<footer class="dark-footer skin-dark-footer">
    <div class="custom_container">
        <div class="row">
            <div class="col-sm-4">
                <div class="left_ftr text-left">
                    <img src="{{asset('public/frontend/img/logo.png')}}" class="img-fluid">
                    <div class="wrap_adrs">
                        <!-- <h4>Mawad Mart</h4> -->
                        <p><i class="fa fa-phone"></i>&nbsp {{@$footerDetail['isd_code']}} {{@$footerDetail['contact_number']}}</p>
                        <p><i class="fa fa-envelope-o"></i> &nbsp{{@$footerDetail['email']}}</p>
                        <p> {!!@$footerDetail['address']!!}<br><br></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="rgt_ftr">
                    <div class="top_rgt prnt_ftr_div d-flex">
                        <div class="shop_div ftr_inr_div">
                            <h3>Follow Us on</h3>
                            <ul class="ftr_ul d-flex" type="none">
                                <li><i class="fa fa-facebook"></i></li>
                                <li><i class="fa fa-twitter"></i></li>
                                <li><i class="fa fa-instagram"></i></li>
                                <li><i class="fa fa-linkedin"></i></li>
                            </ul>
                            <div class="download_rgt">
                                <ul class="ftr_ul" type="none">
                                    <h3>Download The App Now</h3>
                                    <li class="same_i">
                                        <a class="" href=""><img src="{{asset('public/frontend/img/aps.svg')}}" class="img-fluid"></a>
                                        <a class="" href=""><img src="{{asset('public/frontend/img/pls.svg')}}" class="img-fluid"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mor_div ftr_inr_div">
                            <h3>More</h3>
                            <ul class="ftr_ul" type="none">
                                <a href="{{url('/career')}}"><li><i class="fa fa-angle-right"></i> Careers</li></a>
                                <li><i class="fa fa-angle-right"></i> Become Service Provider</li>
                                <a href="{{url('/deliveryPolicy')}}"><li><i class="fa fa-angle-right"></i> Delivery Policy</li></a>
                                <a href="{{url('/returnAndExchangePolicy')}}"><li><i class="fa fa-angle-right"></i> Returns & Exchange Policy</li></a>

                            </ul>
                        </div>
                    </div>
                    <div class="botm_rgt pymt_div">
                        <ul class="ftr_ul d-flex justify-content-between align-items-center" type="none">
                            <h3>Payment Methods</h3>
                            <li class="same_i">
                                <img src="{{asset('public/frontend/img/strip.png')}}" class="img-fluid">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>