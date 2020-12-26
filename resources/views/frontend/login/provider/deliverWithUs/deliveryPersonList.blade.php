@extends('frontend.layout.providerLayout')
@section('title',"Delivery Person's List")
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
                            <h3>Delivery Person's List</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Delivery Person's List</a></li>
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
                                            <div class="quot_main_rgt">
                                                <div class="fltr_topp d-flex align-items-center justify-content-between">
                                                    <div class="section-heading">
                                                        <!-- <span>List of Delivery Persons</span> -->
                                                        <h2>List of Delivery Persons</h2>
                                                    </div>
                                                    <!-- <a class="btn btn_theme"><span>Request Delivery</span></a> -->
                                                </div>
                                                <!-- <div class="fltr_topp d-flex justify-content-between align-items-center">
                                                    <div class="seldes_chk">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customChec1" name="example1">
                                                            <label class="custom-control-label" for="customChec1">Select/Deselct All</label>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-sort"></i>&nbsp;Sort
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Suggested</a>
                                                            <a class="dropdown-item" href="#">Customer Rating</a>
                                                            <a class="dropdown-item" href="#">Experience</a>
                                                            <a class="dropdown-item" href="#">Location</a>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                @if($deliveryPersons->total()>0)
                                                    <div class="wrap_quot_main">
                                                        @foreach($deliveryPersons as $key => $deliveryPerson)
                                                            @if(!empty($deliveryPerson))
                                                                <div class="single_list_desgnr d-flex">
                                                                    <div class="dsgnr_img">
                                                                        <!-- <img src="https://manofmany.com/wp-content/uploads/2019/06/50-Long-Haircuts-Hairstyle-Tips-for-Men-5.jpg" class="img-fluid"> -->
                                                                        @if(!empty($deliveryPerson->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.$deliveryPerson->profile_image)))
                                                                            <img alt="" src="{{asset('public/frontend/imgs/userProfile/'.$deliveryPerson->profile_image)}}" class="img-responsive">
                                                                        @else
                                                                            <img alt="" src="{{asset('public/frontend/img/no_image.png')}}" class="img-responsive">
                                                                        @endif
                                                                    </div>
                                                                    <div class="dsgnr_dtl">
                                                                        <div class="top_meta_dsgnr d-flex justify-content-between">
                                                                            <a href="{{url('/provider/deliveryPerson/detail/'.base64_encode($deliveryPerson['id']))}}">{{ucfirst(@$deliveryPerson['contact_name'])}} {{ucfirst(@$deliveryPerson['contact_last_name'])}}</a>
                                                                            <!-- <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCh" name="example1">
                                                                                <label class="custom-control-label" for="customCh"> </label>
                                                                            </div> -->
                                                                        </div>
                                                                        <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                                            <div class="left_info_dsgnr">
                                                                                <p><strong>Contact Number:</strong> {{@$deliveryPerson['isd_code']}} {{@$deliveryPerson['mobile_no']}}</p>
                                                                                <p><strong>Email:</strong> {{@$deliveryPerson['email']}}</p>
                                                                                <p><strong>City:</strong> {{@$deliveryPerson['cityDetail']['name']}}</p>
                                                                                <p><strong>Location:</strong> <a class="cp_loca"> {{@$deliveryPerson['address_line_1']}},{{@$deliveryPerson['address_line_2']}},{{@$deliveryPerson['cityDetail']['name']}},{{@$deliveryPerson['countryDetail']['name']}}</a></p>
                                                                            </div>
                                                                            <div class="rgt_ratng">
                                                                                <span><small>9.8</small>/10 <br>140 Customer Reviews</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="botom_meta_dsgnr text-right">
                                                                            <a class="btn btn_theme" href="{{url('/provider/deliveryPerson/detail/'.base64_encode($deliveryPerson['id']))}}"><span>Read More</span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach 
                                                        <div class="numbr_pagintn mt-3">
                                                            {{ $deliveryPersons->appends(request()->except('page'))->links() }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="nf_img text-center">
                                                        <img src="{{asset('public/frontend/img/provider_not_found.png')}}" class="img-fluid mt-5">
                                                    </div>
                                                @endif

                                                <!-- <div class="pagntns_btm">
                                                    <nav>
                                                        <ul class="pagination justify-content-center">
                                                            <li class="page-item disabled">
                                                              <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item active">
                                                              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item">
                                                              <a class="page-link" href="#">Next</a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div> -->
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
