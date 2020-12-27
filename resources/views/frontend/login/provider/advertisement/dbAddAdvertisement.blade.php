<?php      
    $admin_image = defaultAdminImagePath.'/no_image.png';                                             
?>

@extends('frontend.layout.providerLayout')
@section('title','Advertisement')
@section('content')
            
        <div class="wrapper_shala seller_db_inner">
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
                                     <h4>Add Advertisements</h4>
                                    <nav class="bread_nav_sec">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"><a href="#">Add Advertisements</a></li>
                                            <!-- <li class="breadcrumb-item active">Item List</li> -->
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </section>
                        <div class="marg_over_bread">
                            <section class="item_list_sec p-0 ">
                                <div class="db_container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="cont_shd_frm">
                                                        <div class="add_adverts_wrap pad15">
                                                            <div class="col-sm-10 offset-1">
                                                                <form action="{{url('provider/advertisemnt/add')}}" id="addadvert" method="post" enctype="multipart/form-data">

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
                                                                                <select class="form-control custom-select" name="advertisement_appearence_id" click  >
                                                                                    <option selected disabled>Select Advertise Appearance</option>
                                                                                    <option value="1">Homepage</option>
                                                                                    <option value="2">Products Page</option>
            <!--                                                                    <option>Contractor's Page</option>
                                                                                    <option>Designer's Page</option> -->
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
           
        </div>

     
@stop
@section('script')

<script>
     $('.note').css('opacity', '0');

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