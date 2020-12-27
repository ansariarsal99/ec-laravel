<?php 
        if (!empty($UserAdvertisement['image'])) {
            $imgpath= frontendAdvertImageBasePath.'/'.$UserAdvertisement['image'];    
            // dd($imgpath);
        }                                                                                        
        if(!empty($UserAdvertisement['image']) && file_exists($imgpath) ) { 
            // dd($imgpath);
            $admin_image = frontendAdvertImagePath.'/'.$UserAdvertisement['image'];    
        }else{
            $admin_image = defaultAdminImagePath.'/no_image.png';  
            // dd($admin_image);
        }                                           
?>                                             

@extends('frontend.layout.layout')
@section('title','My Advertisements')
@section('content')
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Advertisements</li>
                    </ol>
                </nav>
            </div>
            
            <section class="prof_dashboard padd_all_sec">
                <div class="container-fluid">
                    <div class="row">
                        
                          @include('frontend.include.userSidebar')

                        <div class="col-sm-9">
                            <div class="mainside_wrap">
                                <!--  -->
                                <div class="page_head">
                                    <h4>Add New Advertisements</h4>
                                   <!--  <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                                </div>
                                <div class="main_cntnt_dash">
                                    <div class="card advert_dash_add">
                                        <!--  -->
                                        <div class="cont_shd_frm">
                                            <div class="add_adverts_wrap pad15">
                                                <div class="col-sm-10 offset-1">
                                                        <form action="{{url('/user/advertisemnt/user/add')}}" id="addadvert" method="post" enctype="multipart/form-data">
                                                          @csrf
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                 <label>Title</label>
                                                                                <input type="text" name="title" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                       
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label>Select Advertise Appearance</label>
                                                                                <select class="form-control custom-select" name="advertisement_appearence_id">
                                                                                    <option selected disabled>Select Advertise Appearance</option>
                                                                                    <option value="1">Homepage</option>
                                                                                    <option value="2">Products Page</option>
           
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label>Select Payment Method</label>
                                                                                <select class="form-control custom-select" name="payment_method">
                                                                                    <option selected disabled>Select Payment Method</option>
                                                                                    <option value="wallet">Wallet</option>
                                                                                    <option value="debit_card">Debit Card</option>
                                                                                    <option value="credit_card">Credit Card</option>
                                                                                    <option value="net_banking">Net Banking</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="text-left img_advert">
                                                                            <div class="pos_rel pic_top">
                                                                                <span class="img_edtt pos_rel">
                                                                                    <img src="{{@$admin_image}}" class="img-fluid user-img" id="prof_ch" name="image">
                                                                                    <span class="edt_inpt">
                                                                                        <i class="fa fa-edit"></i>
                                                                                        <input type="file" id="botonAjax" name="uploader" class="file_img" required="">
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <label class="note">Suggested Image size: (750 W * 140 H)</label>
                                                                        </div>
                                                                        <label id="botonAjax-error" class="error" for="botonAjax"></label>
                                                                    </div>

                                                                    <div class="text-right">
                                                                        <button class="btn btn_theme save"><span>Publish Advertisement</span></button>
                                                                    </div>
                                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

             @stop
@section('script')

<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
         $('.user-img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#botonAjax").change(function() {
      readURL(this);
    });
</script>


<script>

    $('#addadvert').validate({
        ignore:[],
        rules:{
            "title":{
                required:true,
            },
            "advertisement_appearence_id":{
                required:true,
            },
             "payment_method":{
                required:true,
            },
             "uploader":{
                required:true,
            },
        },
        messages:{
            "title":{
                required:"Please enter title",
            },

            "advertisement_appearence_id":{
                required:"Please select advertisement appearence",

            },
            "payment_method":{
                required:"Please select payment method",

            },
              "uploader":{
                required:"Please select image",
            },
        },
    });
</script>


@stop