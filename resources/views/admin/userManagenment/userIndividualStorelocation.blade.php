<?php  
      // dd($invoice['invoice_image']);
    if (!empty($invoice['invoice_image'])) {
        $imgpath= invoiceImageBasePath.'/'.$invoice['invoice_image'];    
    }                                                                                        
    if(!empty($invoice['invoice_image']) && file_exists($imgpath) ) { 
        // dd($imgpath);
        $admin_image = invoiceImagePath.'/'.$invoice['invoice_image'];    
    }else{
        $admin_image = defaultAdminImagePath.'/no_image.png';  
        // dd($admin_image);
    }                                           
?>

@extends('admin.layout.adminLayout')
@section('title','User Delivery Detail(Individual)')
@section('content')

 @include('admin.include.header')
    <!-- Sidebar menu-->
    @include('admin.include.sidebar')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>User Detail(Individual)</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">User Management</a></li>
                                <li class="active">User Delivery Detail(Individual)</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">  
            <form method="post" id="termForm" action="" enctype="multipart/form-data">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title">User Delivery Detail(Individual)</strong>
                    </div>
                    <div class="wrap_adrs p-4">
                        <div class="row">
                           @foreach($userDeliveryLocation as $userLocations)
                            <div class="col-sm-6">
                                <div class="user_adrs pad20">
                                    <div class="adrs_topp">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="sav_adrs">
                                                    <p class=""><label class="badge badge-primary">{{$userLocations['address_title']}}</label></p>
                                                    <p class="nam_numb">{{$userLocations['province_name']}} &nbsp; &nbsp; &nbsp; {{$userLocations['city']}},{{$userLocations['country_detail']['name']}}</p>
                                                    <p class="adrs_usr"><i class="fa fa-location-arrow"></i> {{$userLocations['location']}} - {{$userLocations['postal_code']}}</p>
                                                    <p class="adrs_usr"><i class="fa fa-address-card-o"></i> {{$userLocations['address']}}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="use_new_adres d-flex flex-column align-items-center justify-content-center">
                                                    @if($userLocations['use_address_as_default']=='yes')
                                                    <span class="badg_deflt">
                                                     Default
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           <!--  <div class="col-sm-6">
                                <div class="user_adrs pad20">
                                    <div class="adrs_topp">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="sav_adrs">
                                                    <p class=""><label class="badge badge-primary">Ffc</label></p>
                                                    <p class="nam_numb">Sdf &nbsp; &nbsp; &nbsp; Sdf, Albania</p>
                                                    <p class="adrs_usr"><i class="fa fa-location-arrow"></i> Sdfsd - 3456</p>
                                                    <p class="adrs_usr"><i class="fa fa-address-card-o"></i> Dsg</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="use_new_adres d-flex flex-column align-items-center justify-content-center">
                                                    <span class="badg_deflt">Default</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </form>               
        </div> 
    </div>      
@stop

@section('script')

@stop