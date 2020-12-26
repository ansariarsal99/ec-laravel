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
@section('title','provider Store Location(Contractor)')
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
                            <h1>User Management</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">User Management</a></li>
                                <li class="active">provider Store Location(Contractor)</li>
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
                       <strong class="card-title">provider Store Location(Contractor)</strong>
                    </div>
                    <div class="saved_adrss">
                        <div class="row">
                        @foreach($userLocation as $userLocations)
                            <div class="col-sm-6">
                                <div class="wrap_svd_adrs">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="prvdr_adrs">
                                                <div class="location_marker">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <h2 class="pt-2">{{$userLocations['store_name']}}</h2>
                                                <p class="mb-1">{{$userLocations['street']}}</p>
                                                <h5 class="mb-1">{{$userLocations['city']}},{{$userLocations['state_detail']['name']}},{{$userLocations['country_detail']['name']}}</h5>
                                                <p class="lc-mark">
                                                    <i class="fa fa-location-arrow mr-2" aria-hidden="true"></i>{{$userLocations['location']}}
                                                </p>
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
                            @endforeach
                   
                        </div>
                    </div>
                </div>
            </form>               
        </div> 
    </div>      
@stop

@section('script')


@stop