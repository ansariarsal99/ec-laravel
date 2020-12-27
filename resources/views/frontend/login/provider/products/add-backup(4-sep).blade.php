@extends('frontend.layout.providerLayout')
@section('title','My Stores Locations')
@section('content')
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
                        <h3>Products</h3>
                        <nav class="bread_nav_sec">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Products</a></li>
                                <li class="breadcrumb-item active">Item List</li>
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
                                        <div class="card_ttl d-flex align-items-center justify-content-between">
                                            <h3>Add New Products</h3>
                                        </div>
                                        <div class="add_product_form">
                                            <form id="add-product-form" action="{{url('provider/products/add')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-10 offset-sm-1">
                                                        <div class="form-group">
                                                            <label>Select Category</label>
                                                            <select class="form-control custom-select category_id_class" name="category_id">
                                                                <option selected="" disabled="">Select Category</option>
                                                                @foreach($productCategories as $category)
                                                                    <option value="{{$category->id}}">{{@$category->name}}</option>
                                                                @endforeach
                                                                <!-- <option>Category 1</option>
                                                                <option>Category 1</option>
                                                                <option>Category 1</option>
                                                                <option>Category 1</option> -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Select Sub Category</label>
                                                            <select class="form-control custom-select sub_category_class" name="sub_category_id">
                                                                <option selected="" disabled="">Select Sub Category</option>
                                                               <!--  <option>Sub-category 1</option>
                                                                <option>Sub-category 1</option>
                                                                <option>Sub-category 1</option>
                                                                <option>Sub-category 1</option> -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Enter Product Name</label>
                                                            <input type="text" name="product_name" class="form-control" value="">
                                                        </div>
                                                         <div class="form-group">
                                                            <label>Product Detail</label>
                                                            <textarea class="form-control" rows="5" placeholder="Write product details here..." name="detail"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Enter Price per Unit</label>
                                                            <input type="text" name="price_per_unit" class="form-control price_per_unit" value="" placeholder="SR">
                                                            <div class="weight-class">
                                                                
                                                            </div>
                                                            <div class="sh_pric_tble quantity_example">
                                                                <div class="row tab_head m-0">
                                                                    <div class="col-lg-4 br_right p-0">
                                                                        <h4>Quantity</h4>
                                                                    </div>
                                                                    <div class="col-lg-4 br_right p-0">
                                                                        <h4>Pcs.</h4>
                                                                    </div>
                                                                    <div class="col-lg-4 p-0">
                                                                        <h4>Price</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-0 mb-3">
                                                                    <div class="col-sm-4 inr_datat p-0 product-weight">
                                                                        <p></p>
                                                                    </div>
                                                                    <div class="col-sm-4 inr_datat p-0 product-weight">
                                                                        <p></p>
                                                                    </div>
                                                                    <div class="col-sm-4 inr_datat p-0 product-weight">
                                                                        <p></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="btn_right text-right">
                                                                <button class="btn btn_theme new-weight-btn" type="button"><span>Add New Weight</span></button>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Add Specification</label>
                                                            <div class="specification_class"></div>
                                                            <div class="sh_pric_tble specification_example">
                                                                <div class="row tab_head m-0">
                                                                    <div class="col-lg-3 br_right p-0">
                                                                        <h4>Title</h4>
                                                                    </div>
                                                                    <div class="col-lg-9 br_right p-0">
                                                                        <h4>Description</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-0 mb-3">
                                                                    <div class="col-sm-3 inr_datat p-0 product-spec">
                                                                        <p></p>
                                                                    </div>
                                                                    <div class="col-sm-9 inr_datat p-0 product-spec">
                                                                        <p></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="btn_right text-right">
                                                                <button class="btn btn_theme" type="button" data-toggle="modal" data-target="#specification"><span>Add New Specification</span></button>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group imge_uploader"> -->
                                                            <!-- <label>Add Images</label> -->
                                                            <!-- New image uploader -->
                                                            <!-- <div class="uploader__box js-uploader__box l-center-box"> -->
                                                                <!-- <form action="" method=""> -->
                                                                    <!-- <div class="uploader__contents">
                                                                        <label class="button button--secondary" for="fileinput">Select Files</label>
                                                                        <input id="fileinput" class="uploader__file-input file_img" type="file" value="" name="image">
                                                                    </div> -->
                                                                    <!-- <input class="button button--big-bottom" type="submit" value="Upload Selected Files"> -->
                                                                <!-- </form> -->
                                                            <!-- </div> -->
                                                            <!-- End -->
                                                        <!-- </div> -->

                                                        <div class="drop_area">
                                                            <div class="form-group" id="data_section_8">
                                                                <!-- certificate dropzone -->
                                                                <div class="drop_post_files dropzone dz-clickable" id="my-dropzone">             
                                                                    <div class="dz-default dz-message">
                                                                        <span>Drop files here to upload or click here</span>
                                                                    </div>
                                                                </div>
                                                                <!-- certificate dropzone -->
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="media_ids" id="image_ids">

                                                        <div class="row view_prof_dash">
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Mawad mart code</label><br />
                                                                    <span class="code">{{@$mawadCode}}</span>
                                                                    <input type="hidden" name="mawad_mart_code" value="{{@$mawadCode}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Bar code</label><br />
                                                                    <span class="code">
                                                                        <input type="hidden" name="bar_code" value="{{$barCode}}">
                                                                        <!-- <img src="img/barcode.png" class="img-fluid"> -->
                                                                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barCode, 'C93')}}" alt="barcode" style="width: 254px; height: 30px"  />
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row view_prof_dash">
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Supplier code</label><br />
                                                                    <span class="code">{{@$supplierCode}}</span>
                                                                    <input type="hidden" name="supplier_code" value="{{@$supplierCode}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="filter_div_seler">
                                                                <h4 class="chose_terms">Terms of Payment</h4>
                                                            </div>
                                                        </div>
                                                        <div class="view_prof_dash">
                                                            @if(!empty($termsOfPayments))
                                                            <input type="hidden" name="terms_payment_id" value="{{$termsOfPayments->id}}">
                                                            @foreach($termsOfPayments['userTermOfPaymentQuotas'] as $quota)
                                                            <!-- <div class="col-6 col-xs-12"> -->
                                                                <p>{{$quota->quota_percent}}% {{$quota->title}}</p>
                                                            <!-- </div> -->
                                                            @endforeach
                                                            @endif
                                                            <!-- <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                        <label class="custom-control-label" for="customCheck">50% Advance Payment</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                        <label class="custom-control-label" for="customCheck">25% Advance Payment</label>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <div class="btn_right text-right">
                                                            <button class="btn btn_theme product-submit-btn" type="button"><span>Submit</span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
    <div class="modal" id="new_weight">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Weight & Quantity</h4>
                    <button type="button" class="close weight-close" data-dismiss="modal">&times;</button>
                </div>

                  <!-- Modal body -->
                <div class="modal-body">
                    <div class="add_form">
                        <form id="add-weight-form" method="post" action="">
                            <div class="form-group">
                                <label>Select Pcs.</label>
                                <input type="text" name="pcs" class="form-control pcs-class">
                            </div>
                            <div class="form-group">
                                <label>Select Weight</label>
                                <input type="text" name="quantity" class="form-control weight-class">
                            </div>
                            <input type="hidden" name="price" class="product_price" value="">
                        </form>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn_theme add-weight-btn"><span>Add to List</span></button>
                </div>
            </div>
      </div>
    </div>
    <div class="modal" id="specification">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Specification</h4>
                    <button type="button" class="close specification-close" data-dismiss="modal">&times;</button>
                </div>

                  <!-- Modal body -->
                <div class="modal-body">
                    <div class="add_form">
                        <form id="specification_form">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control title-class">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control description-class" name="description"></textarea>
                                <!-- <input type="text" name="description" class="form-control"> -->
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn_theme add-list-btn"><span>Add to List</span></button>
                </div>
            </div>
      </div>
    </div>
</section>
    <!-- Choose Plan -->
@stop
@section('script')

<script type="text/javascript">
    var image_ids = [];
    $('#feed_post_id').val('');
    
    var myDropzone  = $('.drop_post_files').dropzone({ 
        url:"{{url('provider/product/add/image')}}",
        acceptedFiles:"image/*",
        addRemoveLinks:true,
        maxFiles: 8,
        maxFilesize:20,
        init: function() {
            this.on("sending", function(file, xhr, formData){
                formData.append("_token", "{{csrf_token()}}");
            });
            this.on("addedfile", function(file) {
                if (!file.type.match(/image.*/)) {
                    this.emit("thumbnail", file, "{{asset('/public/frontend/imgs/post_images/thumb.jpeg')}}");
                }
            })
        },
        success:function(file, resp){
            file.stored_id = resp.img_id;
            image_ids.push(resp.img_id);
            $('#image_ids').val(image_ids);
        },
        removedfile:function(file) {
            var file_id = file.stored_id;
                // var removename = file.name;
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{url('provider/product/delete/image')}}",
                    type: "POST",
                    data: {'file_id': file_id, '_token': _token},
                    dataType:'json',
                    success:function(data){
                        // console.log(data);
                        // drop_img_count--;
                    }
                });
                image_ids = jQuery.grep(image_ids, function(value) {
                  return value != file_id;
              });
                // // image_ids.pop(file_id);
                $('#image_ids').val(image_ids);
                file.previewElement.remove();
            }

        });
</script>
<script>
    $(document).on('change', '.category_id_class', function(){
        // alert(1);
        categoryId = $(this).val();
        $.ajax({
            url:"{{url('provider/get/subcategory')}}",
            data:{categoryId : categoryId},
            type:'POST',
            success:function(data) {
                $('.sub_category_class').html(data);
            }
        })
    })
</script>
<script type="text/javascript">
    $('#add-weight-form').validate({
            ignore:[],
            rules:{
                "pcs":{
                    required:true,
                    number:true    
                },
                "quantity" :{
                    required:true,
                    number:true
                }
            },
            messages:{
                "pcs":{
                    required:"Please enter number of pcs",
                },
                "quantity": {
                    required: "Please enter quantity"
                }
            },
        });

    $(document).on('click', '.add-weight-btn', function(){
        price = $('.price_per_unit').val();
        $('.product_price').val(price);
        // $('#add-weight-form').submit();
        if($("#add-weight-form").valid()){
           // test for validity
            $.ajax({
            url:"{{url('provider/product/add/weight')}}",
            type: "post",
            data:$('#add-weight-form').serialize(),
            success:function(data){
                $('.pcs-class').val('');
                $('.weight-class').val('');
                $('#new_weight').modal('hide');
                $('.quantity_example').hide();
                $('.weight-class').html(data);
            },
            error:function(){
                swal('Oops, Something went wrong');
            }
          });
        }
    })
</script>
<script type="text/javascript">
    $(document).on('click', '.new-weight-btn', function(){
        price = $('.price_per_unit').val();
        if(!price) {
            swal("Please enter price per unit");
        } else {
            $('#new_weight').modal('show');
        }
    })
</script>
<script type="text/javascript">
    $('#specification_form').validate({
        ignore:[],
        rules:{
            "title":{
                required:{
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },    
            },
            "description" :{
                required:{
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
            }
        },
        messages:{
            "title":{
                required:"Please enter title",
            },
            "description": {
                required: "Please enter description"
            }
        },
    });

    $(document).on('click', '.add-list-btn', function(){
        // $('#specification_form').submit();
        if($("#specification_form").valid()){
           // test for validity
            $.ajax({
            url:"{{url('provider/product/add/specification')}}",
            type: "post",
            data:$('#specification_form').serialize(),
            success:function(data){
                $('.title-class').val('');
                $('.description-class').val('');
                $('#specification').modal('hide');
                $('.specification_example').hide();
                $('.specification_class').html(data);
            },
            error:function(){
                swal('Oops, Something went wrong');
            }
          });
        }
    })
</script>

<script type="text/javascript">
  $('#add-product-form').validate({
            ignore:[],
            rules:{
                "category_id":{
                    required:true,    
                },
                "sub_category_id" :{
                    required:true,
                },
                // "product_name" :{
                //     required:{
                //         depends:function(){
                //             $(this).val($.trim($(this).val()));
                //             return true;
                //         }
                //     },
                // },
                "product_name" : {
                    required : true
                },
                "price_per_unit" :{
                    required:true,
                    number:true
                },
                "image" :{
                    required:true,
                    extension: "jpeg|jpg|png|bmp",
                },
                 "detail" : {
                    required:true,
                    minlength : 20,
                }
            },
            messages:{
                "category_id":{
                    required:"Please select category",
                },
                "sub_category_id": {
                    required: "Please select sub category"
                },
                "product_name": {
                    required: "Please enter product name"
                },
                "price_per_unit": {
                    required: "Please enter price per unit"
                },
                "image": {
                    required: "Please select sub category",
                    extension: "Only jpeg, jpg, bmp and png extensions are allowed"
                },
                 "detail" :{
                    required : "Please enter product detail",
                    minlength : "Minimum 20 characters are allowed"
                }
            },
        });

    $(document).on('click', '.product-submit-btn', function(){
        var text = $(".product-weight").children('p').text();
        var productSpec = $(".product-spec").children('p').text();
        var imageIds = $('#image_ids').val();
        
        if(text.length == 0) {
            swal("Please add product weight");
        }else if(productSpec.length == 0){
            swal("Please add product specification");
        } else if(!imageIds){
            swal("Please select product image");
        } else {
            $('#add-product-form').submit();
        }
    })  
</script>
<script type="text/javascript">
    $(document).on('click', '.weight-close', function(){
        $('.pcs-class').val('');
        $('.weight-class').val('');
    })

    $(document).on('click', '.specification-close', function(){
        $('.title-class').val('');
        $('.description-class').val('');
    })
</script>
@stop