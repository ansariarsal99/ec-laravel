@extends('frontend.layout.providerLayout')
@section('title',"Delivery Person Detail")
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/intlTelInput.css')}}">
<?php  
    $admin_image = defaultAdminImagePath.'/no_image.png';  
    $userType = App\UserType::where('id',Auth::user()->user_type_id)->value('name');
    // dd($userType);                                               
?>
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
                            <h3>Delivery Person Detail</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Delivery Person Detail</a></li>
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
                                            <div class="wrp_dsgnr_dtl">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <div class="provider_list_detail">
                                                            <div class="desgnr_top_prof d-flex">
                                                                <div class="dsgnr_img vehcl_usr_img">
                                                                    <!-- <img src="https://manofmany.com/wp-content/uploads/2019/06/50-Long-Haircuts-Hairstyle-Tips-for-Men-5.jpg" class="img-fluid"> -->
                                                                    @if(!empty($deliveryPerson['profile_image']) && file_exists(public_path('frontend/imgs/userProfile/'.$deliveryPerson['profile_image'])))
                                                                        <img alt="" src="{{asset('public/frontend/imgs/userProfile/'.$deliveryPerson['profile_image'])}}" class="img-fluid">
                                                                    @else
                                                                        <img alt="" src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                                                                    @endif
                                                                </div>
                                                                <div class="dsgnr_dtl">
                                                                    <div class="top_meta_dsgnr d-flex justify-content-between">
                                                                        <h5>{{ucwords(@$deliveryPerson['contact_name'])}} {{ucwords(@$deliveryPerson['contact_last_name'])}}</h5>
                                                                        <div class="rgt_ratng text-center">
                                                                            <span><small>9.8</small>/10</span>
                                                                            <span>140 Customer Reviews</span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="rgt_ratng">
                                                                        <span>140 Customer Reviews</span>
                                                                    </div> -->
                                                                    @if(!empty($deliveryPerson['additional_information']))
                                                                        <div class="desg_descr">
                                                                            <h5>Additional Info</h5>
                                                                            <p class="pt-2">{{@$deliveryPerson['additional_information']}}</p>
                                                                        </div>
                                                                    @endif
                                                                    <div class="left_info_dsgnr">
                                                                        <p><strong>Website:</strong> <a href="{{@$deliveryPerson['website_url']}}" target="_blank" class="cp_loca"> {{@$deliveryPerson['website_url']}}</a></p>
                                                                        <!-- <p><strong>Experience:</strong> +4 (In Years)</p>
                                                                        <p><strong>Category:</strong> Architectural Work</p>
                                                                        <p><strong>Type of Services :</strong> Interior</p> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(sizeof($deliveryPerson['user_vehicles'])>0)
                                                                <div class="provider_detail_wrap">
                                                                    <div class="row justify-content-center">
                                                                        @foreach($deliveryPerson['user_vehicles'] as $key => $userVehicle)
                                                                            @if(!empty($userVehicle))
                                                                                <div class="col-lg-6">
                                                                                    <div class="inr_content">
                                                                                        <div class="vecl_inr">
                                                                                            <h5>Number of Vehicle</h5>
                                                                                            <p>{{@$userVehicle['vehicle_number']}}</p>
                                                                                        </div>
                                                                                        <div class="vecl_inr">
                                                                                            <h5>Name of Vehicle</h5>
                                                                                            <p>{{@$userVehicle['vehicle_name']}}</p>
                                                                                        </div>
                                                                                        <div class="vecl_inr">
                                                                                            <h5>Register Number of Vehicle</h5>
                                                                                            <p>{{@$userVehicle['vehicle_registration_number']}}</p>
                                                                                        </div>
                                                                                        <div class="vecl_inr">
                                                                                            <h5>Chassis Number</h5>
                                                                                            <p>{{@$userVehicle['vehicle_chassis_number']}}</p>
                                                                                        </div>
                                                                                        @if(!empty($userVehicle['image']) && file_exists(userVehicleImgsBasePath.$userVehicle['image']))
                                                                                            <div class="vehicle_img">
                                                                                                <img src="{{userVehicleImgsPath.'/'.$userVehicle['image']}}" class="img-fluid">
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        <!-- <div class="col-lg-6">
                                                                            <div class="inr_content">
                                                                                <div class="vecl_inr">
                                                                                    <h5>Number of Vehicle</h5>
                                                                                    <p>5</p>
                                                                                </div>
                                                                                <div class="vecl_inr">
                                                                                    <h5>Name of Vehicle</h5>
                                                                                    <p>Lamborghini</p>
                                                                                </div>
                                                                                <div class="vecl_inr">
                                                                                    <h5>Register Number of Vehicle</h5>
                                                                                    <p>#4545441451</p>
                                                                                </div>
                                                                                <div class="vecl_inr">
                                                                                    <h5>Chssis Number</h5>
                                                                                    <p>4545645</p>
                                                                                </div>
                                                                                <div class="vehicle_img">
                                                                                    <img src="https://www.lamborghini.com/sites/it-en/files/DAM/lamborghini/share%20img/aventador-coupe-facebook-og.jpg" class="img-fluid">
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 pos_sticky">
                                                        <div class="desgnr_sid_info">
                                                            <h6>Delivery Person Highlights</h6>
                                                            <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                <div class="left_info_dsgnr">
                                                                    <p><strong>Membership ID:</strong> {{ucfirst(@$deliveryPerson['supplier_code'])}}</p>
                                                                    <p><strong>CR Number:</strong> {{@$deliveryPerson['cr_number']}}</p>
                                                                    <p><strong>Company Name:</strong> {{ucfirst(@$deliveryPerson['company_name'])}}</p>
                                                                    <p><strong>Contact Number:</strong> {{@$deliveryPerson['isd_code']}} {{@$deliveryPerson['mobile_no']}}</p>
                                                                    <p><strong>Landline Number:</strong> {{@$deliveryPerson['landline_isd_code']}} {{@$deliveryPerson['landline']}}</p>
                                                                    <p><strong>Email:</strong> {{@$deliveryPerson['email']}}</p>
                                                                    <p><strong>City:</strong> {{@$deliveryPerson['city_detail']['name']}}</p>
                                                                    <p><strong>Location:</strong> <br><a href="javascript:;" class="cp_loca">{{@$deliveryPerson['address_line_1']}},{{@$deliveryPerson['address_line_2']}},{{@$deliveryPerson['city_detail']['name']}},{{@$deliveryPerson['country_detail']['name']}}</a></p>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="botom_meta_dsgnr text-center">
                                                                <a class="btn btn_theme" href="javascript:;"><span>Ask a Query</span></a><br><br>
                                                                <a class="btn btn_theme" href="requestProposal.php"><span>Request Quote</span></a>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
@stop
@section('script')


@stop
