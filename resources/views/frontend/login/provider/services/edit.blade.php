@extends('frontend.layout.providerLayout')
@section('title','Edit Service')
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
                        <h3>Services</h3>
                        <nav class="bread_nav_sec">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Services</a></li>
                                <li class="breadcrumb-item active">Edit Services </li>
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
                                            <h3>Edit Service</h3>
                                        </div>
                                        <div class="add_product_form">
                                            <form id="edit-product-form" action="{{url('provider/services/edit/'.Crypt::encrypt($product->id))}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-10 offset-sm-1">
                                                        <div class="form-group">
                                                            <label>Select Category</label>
                                                            <select class="form-control custom-select category_id_class" name="category_id">
                                                                @foreach($productCategories as $category)
                                                                    <option value="{{$category->id}}" @if($category['id'] == $product['category_id']) selected @endif>{{@$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Select Sub Category</label>
                                                            <select class="form-control custom-select sub_category_class" name="sub_category_id">
                                                                @foreach($subCategories as $subCategory)
                                                                    <option value="{{$subCategory->id}}" @if($subCategory['id'] == $product['sub_category_id']) selected @endif>{{$subCategory->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Service Name</label>
                                                            <input type="text" name="product_name" class="form-control" value="{{@$product->product_name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="text" name="price_per_unit" class="form-control price_per_unit" value="{{@$product->price_per_unit}}" placeholder="SR">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" class="specification-count" value="{{count($product->productSpecification)}}">
                                                            <label>Add Specification</label>
                                                            <div class="specification_class"></div>
                                                            <div class="sh_pric_tble specification_example">
                                                                <div class="row tab_head m-0">
                                                                    <div class="col-lg-3 br_right p-0">
                                                                        <h4>Title</h4>
                                                                    </div>
                                                                    <div class="col-lg-6 br_right p-0">
                                                                        <h4>Description</h4>
                                                                    </div>
                                                                     <div class="col-lg-3 br_right p-0">
                                                                        <h4>Action</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-0 mb-3">
                                                                    <div class="col-sm-3 inr_datat p-0 product-spec">
                                                                        @foreach($product->productSpecification as $specification)
                                                                        <p class="title-class-{{$specification->id}}">{{$specification->title}}</p>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col-sm-6 inr_datat p-0 product-spec">
                                                                        @foreach($product->productSpecification as $specification)
                                                                        <p class="description-class-{{$specification->id}}">{{$specification->description}}</p>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col-sm-3 inr_datat p-0 product-spec">
                                                                        @foreach($product->productSpecification as $specification)
                                                                        <p class="spec-action-class-{{$specification->id}}">
                                                                            <a href="javascript:;" class="edit-spec text-info" specification_id="{{$specification->id}}">Edit</a>
                                                                            <a href="javascript:;" class="delete-btn delete-specification text-danger" del_id="{{$specification->id}}">Delete</a>
                                                                        </p>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="drop_area">
                                                            <div class="form-group" id="data_section_8">
                                                                <!-- certificate dropzone -->
                                                                <div class="drop_post_files dropzone dz-clickable" id="my-dropzone">             
                                                                    <div class="dz-default dz-message">
                                                                        <span>photos</span>
                                                                    </div>
                                                                </div>
                                                                <!-- certificate dropzone -->
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="media_ids" id="image_ids">

                                                  
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

    <div class="modal" id="edit_specification">
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
                            <input type="hidden" name="specificationId" class="specification-id-class" value="">
                        </form>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn_theme add-list-btn"><span>Save</span></button>
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
    var productId = "{{$product->id}}";
    $('#feed_post_id').val('');
    
    var myDropzone  = $('.drop_post_files').dropzone({ 
        url:"{{url('provider/product/add/image')}}"+'?product_id='+productId,
        acceptedFiles:"image/*",
        addRemoveLinks:true,
        maxFiles: 8,
        maxFilesize:20,
        init: function() {
            var myDropzone = this;
            var fullurl='<?php echo asset('public/frontend/images/products'); ?>';

            $.get('{{url('/provider/products/images')}}'+'/'+productId, function(data) {

                $.each(data.images, function (key, value) {

                    var file = {name: value.image};
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, fullurl + '/'+value.image);
                    myDropzone.emit("complete", file);
                });
            });
        },

        success:function(file, resp){
            file.stored_id = resp.img_id;
            image_ids.push(resp.img_id);
            $('#image_ids').val(image_ids);
        },
        removedfile:function(file) {
            var file_id = file.stored_id;
                var removename = file.name;
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{url('provider/product/delete/image')}}",
                    type: "POST",
                    data: {'file_id': file_id, '_token': _token,'removename': removename},
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
    $('#edit-weight-form').validate({
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

    
</script>

<script type="text/javascript">
    $(document).on('click', '.edit-spec', function(){
        var specificationId = $(this).attr('specification_id');
        $.ajax({
            url:"{{url('provider/service/specification')}}",
            type:"post",
            data:{specificationId:specificationId},
            success:function(data){
                $('.title-class').val(data.specification.title);
                $('.description-class').val(data.specification.description);
                $('.specification-id-class').val(data.specification.id);
               
                $('#edit_specification').modal('show');
            },
            error:function(){
                swal('Oops', 'Something went wrong');
            }
        })
        
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
            url:"{{url('provider/services-edit/specification')}}",
            type: "post",
            data:$('#specification_form').serialize(),
            success:function(data){
                $('.title-class-'+data.specification.id).text(data.specification.title);
                $('.description-class-'+data.specification.id).text(data.specification.description);
                $('#edit_specification').modal('hide');
            },
            error:function(){
                swal('Oops, Something went wrong');
            }
          });
        }
    })
</script>

<script type="text/javascript">
  $('#edit-product-form').validate({
            ignore:[],
            rules:{
                "category_id":{
                    required:true,    
                },
                "sub_category_id" :{
                    required:true,
                },
                "product_name" :{
                    required:{
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                },
                "price_per_unit" :{
                    required:true,
                    number:true,
                     min:1
                },
                "image" :{
                    required:true,
                    extension: "jpeg|jpg|png|bmp",
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
                }
            },
        });

    $(document).on('click', '.product-submit-btn', function(){
        var productId = "{{$product->id}}";
        // var text = $(".product-weight").children('p').text();
        // var productSpec = $(".product-spec").children('p').text();
        // 
        $.ajax({
            url:"{{url('provider/check/product/images')}}",
            data:{productId:productId},
            type:"post",
            success:function(resp){
                if(resp.images.length > 0){
                    $('#edit-product-form').submit();
                } else {
                    swal("Please add product image");
                }
            },
            error:function(){
                swal('Oops', 'Something went wrong');
            }
        })
        // var text = $(".product-weight").children('p').text();
        // var productSpec = $(".product-spec").children('p').text();
        // var imageIds = $('#image_ids').val();
        // if(!imageIds) {
        //     swal("Please add product image");
        // } else {
        //     $('#edit-product-form').submit();
        // }
        
        // if(text.length == 0) {
        //     swal("Please add product weight");
        // }else if(productSpec.length == 0){
        //     swal("Please add product specification");
        // } else if(!imageIds){
        //     swal("Please select product image");
        // } else {
        //     $('#edit-product-form').submit();
        // }
    })  
</script>

<script type="text/javascript">
    // $(document).on('click', '.weight-close', function(){
    //     $('.pcs-class').val('');
    //     $('.weight-class').val('');
    // })

    $(document).on('click', '.specification-close', function(){
        $('.title-class').val('');
        $('.description-class').val('');
    })
</script>


<script type="text/javascript">
    $(document).on('click','.delete-btn',function(e){
        var isDelete = 'no';
        // var text = $(".product-weight").children('p').text();
        var del_url;
        var id =$(this).attr('del_id');
        var productId = "{{$product->id}}";
        e.preventDefault();
        if($(this).hasClass('delete-weight')) {
            if($('.weight-count').val() > 1) {
                isDelete = 'yes';
            }
            del_url = "{{ url('provider/products/delete/weight') }}" + '/' + id;
        } else {
            if($('.specification-count').val() > 1) {
               isDelete = 'yes'; 
            }
            del_url = "{{ url('provider/services/delete/specification/') }}" + '/' + id;
        }
        var ths = $(this);
        if(isDelete == 'yes') {

            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                    url: del_url,
                    data:{productId:productId},
                    success:function(resp){
                        if(ths.hasClass('delete-weight')) {
                            $('.pieces-class-'+id).hide();
                            $('.quantity-class-'+id).hide();
                            $('.price-class-'+id).hide();
                            $('.action-class-'+id).hide();
                            $('.weight-count').val('');
                            $('.weight-count').val(resp.count);
                        } else {
                            $('.title-class-'+id).hide();
                            $('.description-class-'+id).hide();
                            $('.spec-action-class-'+id).hide();
                            $('.specification-count').val('');
                            $('.specification-count').val(resp.count);
                        }
                        $('.loader').hide();
                        if (resp.status=='success') {
                            
                            Swal.fire(
                              'Deleted!',
                              'Record has been deleted.',
                              'success'
                            )
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        $(".loader").hide();
                        swal('Oops, Something went wrong');
                    }
                });
              }
            })            
        } else {
            if($(this).hasClass('delete-weight')) {
                swal('Atleast one product weight is mandatory');
            } else {
                swal('Atleast one product specification is mandatory');
            }
        }
    });
</script>

@stop