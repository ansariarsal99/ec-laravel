@extends('frontend.layout.layout')
@section('title','Seller Detail')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Seller List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Seller Detail</li>
            </ol>
        </nav>
    </div>
    <section class="desg_detl_page_sec">
        <div class="custom_container">
            <div class="wrp_dsgnr_dtl">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="desgnr_top_prof d-flex">
                            <div class="cert_div d-flex flex-column">
                                <div class="dsgnr_img">
                                    @if(!empty($designer->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.$designer->profile_image)))
                                        <img alt="" src="{{asset('public/frontend/imgs/userProfile/'.$designer->profile_image)}}" class="img-fluid">
                                    @else
                                        <img alt="" src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                                    @endif
                                </div>
                                @if(@$designer['certified_provider']=='yes')
                                    <div class="bd_img text-center mt-3">
                                        <img src="{{asset('public/frontend/img/badge.png')}}" class="img-fluid">
                                    </div>
                                @endif
                            </div>
                            <div class="dsgnr_dtl">
                                <div class="top_meta_dsgnr d-flex justify-content-between">
                                    @if(@$designer['user_property_detail']['type']=='company')
                                        <h5>{{ucwords(@$designer['company_name'])}}</h5>
                                    @else
                                        <h5>{{ucwords(@$designer['contact_name'])}} {{ucwords(@$designer['contact_last_name'])}}</h5>
                                    @endif
                                    <div class="rgt_ratng text-center">
                                        <span><small>9.8</small>/10</span>
                                        <span>140 Customer Reviews</span>
                                    </div>
                                </div>
                                <!-- <div class="rgt_ratng">
                                    <span>140 Customer Reviews</span>
                                </div> -->
                                <div class="desg_descr">
                                    <h5>Introduction</h5>
                                    <p class="pt-2">{{@$designer['about_me']}}</p>
                                </div>
                                <div class="left_info_dsgnr">
                                    <p><strong>Type of Entity:</strong> {{@$designer['user_property_detail']['name']}}</p>
                                    <p><strong>Category:</strong> {{@$designer['user_type_detail']['name']}}</p>
                                    <p><strong>Project Fields:</strong> @foreach($designer['user_selected_project_fields_detail'] as $key => $projectFieldDetail) @if($key>=1), @endif{{$projectFieldDetail['user_project_field_detail']['name']}} @endforeach</p>
                                    <p><strong>Type of Services:</strong> @foreach($designer['user_selected_services_detail'] as $key => $serviceDetail) @if($key>=1), @endif{{$serviceDetail['user_service_detail']['name']}} @endforeach</p>
                                    <p><strong>Experience:</strong> +{{@$designer['experience']}} (In @if(@$designer['experience']<=1) Year @else Years @endif)</p>
                                    @if(!empty($designer['profile_document']))
                                        <div class="clk_btn d-flex align-items-center">
                                            <p class="mr-2"><strong>Profile:</strong> <a href="javascript:;" class="cp_loca"></a></p>
                                            <a target="_blank" href="{{asset(providerDocBasePath.'/'.$designer['profile_document'])}}"><p class="pdf_txt cp"><span><i class="fa fa-file-pdf-o"></i> Click to view</span></p></a>
                                        </div>
                                    @endif
                                    @if(!empty($designer['profile_link']))
                                        <p><strong>Profile Link:</strong> <a href="{{@$designer['profile_link']}}" target="_blank" class="cp_loca"> {{@$designer['profile_link']}}</a></p>
                                    @endif
                                    <p><strong>Website:</strong> <a href="{{@$designer['website_url']}}" target="_blank" class="cp_loca"> {{@$designer['website_url']}}</a></p>
                                    @if(!empty($designer['user_profession_images_detail']))
                                        <div class="clk_btn d-flex align-items-center">
                                            <p class="mr-2"><strong>Photos:</strong> <a href="javascript:;" class="cp_loca"> </a></p>
                                            <div class="id_imgs">
                                                @foreach($designer['user_profession_images_detail'] as $key => $professionImage)
                                                    @if(!empty($professionImage) && file_exists('public/frontend/images/provider/'.$professionImage['name']))
                                                        <img src="{{asset('public/frontend/images/provider/'.$professionImage['name'])}}" class="img-fluid">                                                        
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <!-- <section class="servc_prov_dsgnr">
                            <div class="section-heading">
                                <span>Popular Services</span>
                                <h2>Services provided by Contractor</h2>
                            </div>
                            <div class="wrp_servc">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="bu-services-img  mb-30">
                                            <div class="img-holder">
                                                <figure class="pos_rel">
                                                    <a href="#"><img src="https://images.pexels.com/photos/159306/construction-site-build-construction-work-159306.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt=""></a>
                                                </figure>
                                            </div>
                                            <div class="text-holder">
                                                <h4><a href="#">Structural Material</a></h4>
                                                <p>Are you ready to make your dreams a reality, it begins with our best services</p>
                                                <a href="#" class="bu-color link"><span class="fa fa-arrow-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="bu-services-img  mb-30">
                                            <div class="img-holder">
                                                <figure class="pos_rel">
                                                    <a href="#"><img src="https://images.pexels.com/photos/3993876/pexels-photo-3993876.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt=""></a>
                                                </figure>
                                            </div>
                                            <div class="text-holder">
                                                <h4><a href="#">Architechtural Material</a></h4>
                                                <p>Are you ready to make your dreams a reality, it begins with our best services</p>
                                                <a href="#" class="bu-color link"><span class="fa fa-arrow-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="bu-services-img  mb-30">
                                            <div class="img-holder">
                                                <figure class="pos_rel">
                                                    <a href="#"><img src="https://bloncampus.thehindubusinessline.com/b-learn/insight/article25506957.ece/alternates/FREE_960/Steel-iStock" alt=""></a>
                                                </figure>
                                            </div>
                                            <div class="text-holder">
                                                <h4><a href="#">Electrical Material</a></h4>
                                                <p>Are you ready to make your dreams a reality, it begins with our best services</p>
                                                <a href="#" class="bu-color link"><span class="fa fa-arrow-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="bu-services-img  mb-30">
                                            <div class="img-holder">
                                                <figure class="pos_rel">
                                                    <a href="#"><img src="https://image1.masterfile.com/getImage/NjQ5LTA2MDQxNTUyZW4uMDAwMDAwMDA=APu19M/649-06041552en_Masterfile.jpg" alt=""></a>
                                                </figure>
                                            </div>
                                            <div class="text-holder">
                                                <h4><a href="#">Mechanical Material</a></h4>
                                                <p>Are you ready to make your dreams a reality, it begins with our best services</p>
                                                <a href="#" class="bu-color link"><span class="fa fa-arrow-right"></span></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section> -->
                    </div>
                    <?php //dd($designer); ?>
                    <div class="col-sm-3 pos_sticky">
                        <div class="desgnr_sid_info">
                            <h6>Seller Highlights</h6>
                            <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                <div class="left_info_dsgnr">
                                    <p><strong>Membership ID:</strong> {{ucfirst(@$designer['supplier_code'])}}</p>
                                    @if(@$designer['user_property_detail']['type']=='company')
                                        <p><strong>CR Number:</strong> {{@$designer['cr_number']}}</p>
                                    @else
                                        <p><strong>Identification Number:</strong> {{@$designer['cr_number']}}</p>
                                    @endif
                                    <p><strong>Contact Name:</strong> {{ucfirst(@$designer['contact_name'])}} {{ucfirst(@$designer['contact_last_name'])}}</p>
                                    <p><strong>Contact Number:</strong> {{@$designer['isd_code']}} {{@$designer['mobile_no']}}</p>
                                    <p><strong>Landline Number:</strong> {{@$designer['landline_isd_code']}} {{@$designer['landline']}}</p>
                                    <p><strong>Email:</strong> {{@$designer['email']}}</p>
                                    @if(@$designer['user_property_detail']['type']=='individual')
                                        <p><strong>Nationality:</strong> {{@$designer['country_detail']['name']}}</p>
                                        <p><strong>Gender:</strong> {{ucfirst(@$designer['gender'])}}</p>
                                        <p><strong>Date of Birth:</strong> {{date('d-m-Y', strtotime(@$designer['date_of_birth']))}}</p>
                                    @endif
                                    <p><strong>City:</strong> {{@$designer['user_default_store_location']['city_detail']['name']}}</p>
                                    <p><strong>Location:</strong> <br><a href="javascript:;" class="cp_loca">{{@$designer['user_default_store_location']['location']}}</a></p>
                                </div>
                            </div>
                            <form class="selectedProvidersForm" action="{{url('/user/requestForProposal')}}" method="POST">
                                <input type="hidden" name="provider_id" value="{{base64_encode(@$designer['id'])}}">
                                <input type="hidden" name="user_type_id" value="{{base64_encode(@$designer['user_type_id'])}}">
                            </form>
                           
                            <div class="botom_meta_dsgnr text-center">
                                <a class="btn btn_theme" href="{{url('/user/messages?to_user='.base64_encode(@$designer['id']))}}"><span>Ask a Query</span></a><br><br>
                              <!--   @if(Auth::check() && (Auth::user()->user_type_id==1 || Auth::user()->user_type_id==2))
                                    <a class="btn btn_theme req_for_prop" href="javascript:;"><span>Request Proposal</span></a>
                                @endif -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
<script type="text/javascript">
    $("body").on('click','.req_for_prop',function(){
        if (auth) {
            $(".selectedProvidersForm").submit();   
        }else{
            swal('Please login first');
        }
    });
</script>
@stop