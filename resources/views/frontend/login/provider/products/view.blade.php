@extends('frontend.layout.providerLayout')
@section('title','View Product')
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
                        <h3>Product Detail</h3>
                        <nav class="bread_nav_sec">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Products</a></li>
                                <li class="breadcrumb-item active">Product Detail</li>
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
                                            <h3>View Product</h3>
                                        </div>
                                        <div class="add_product_form view_prof_dash">
                                            <div class="row">
                                                <div class="col-sm-10 offset-sm-1">                                                      
                                                    <div class="itm_heading mb-2">
                                                        <h4>1-Product Information</h4>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="build_label">Product Bar Code</label>
                                                        <input type="text" name="item_bar_code" class="form-control" value="{{@$product['item_bar_code']}}" placeholder="Enter Product Bar Code">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row align-items-end">
                                                            <div class="col-lg-12">
                                                                <label class="build_label">Product Name</label>
                                                            </div>
                                                        </div>
                                                        @if(!empty($product['item_name']))
                                                            <input type="text" name="item_name" class="form-control itm_nam" value="{{@$product['item_name']}}" placeholder="Enter Product Name">
                                                        @else
                                                            <input type="text" name="item_name" class="form-control itm_nam" value="{{@$product['item_name_arabic']}}" placeholder="Enter Product Name">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="build_label">Product Seller Code</label>
                                                        <input type="text" name="seller_item_code" class="form-control" value="{{@$product['seller_item_code']}}" placeholder="Enter product seller code">
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label class="build_label">Seller Membership ID</label>
                                                                <input type="text" readonly="" class="form-control" value="{{@$product['user_detail']['supplier_code']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label class="build_label">Seller Name</label>
                                                                <input type="text" readonly="" class="form-control" value="{{ucfirst(@$product['user_detail']['contact_name'])}} {{ucfirst(@$product['user_detail']['contact_last_name'])}}">
                                                            </div>
                                                        </div>    
                                                    </div>     
                                                    <div class="form-group main_description_class">
                                                        <div class="row align-items-end">
                                                            <div class="col-lg-12">
                                                                <label class="build_label">Product Description</label>
                                                            </div>
                                                        </div>      
                                                        <div>
                                                            @if(!empty($product['description_en']))
                                                                {!!@$product['description_en']!!}
                                                            @else
                                                                {!!@$product['description_en']!!}
                                                            @endif 
                                                        </div>
                                                    </div>
                                                    @if(isset($product['product_specifications']) && sizeof($product['product_specifications'])>0)
                                                        <div class="form-group">
                                                            <label class="build_label">Additional Info Sections</label>
                                                            <div class="">
                                                                <div class="table-responsive table_seler price_table">
                                                                    <table class="table table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Title</th>
                                                                                <th>Description</th>
                                                                                <th>Attachment</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="product_spec specification_class">
                                                                            @foreach($product['product_specifications'] as $key => $specification)
                                                                                @if(!empty($specification))
                                                                                    <tr>
                                                                                        <td>{{@$specification['title']}}</td>
                                                                                        <td><pre>{{@$specification['description']}}</pre></td>
                                                                                        <td>
                                                                                            @if(!empty($specification['image']) && file_exists(productSpecificationImgsBasePath.'/'.$specification['image']))
                                                                                                <?php 
                                                                                                    $array = explode('.', $specification['image']);
                                                                                                    $extension = end($array);
                                                                                                ?>
                                                                                                @if($extension=='docx' || $extension=='doc')
                                                                                                    <a href="{{productSpecificationImgsPath.'/'.$specification['image']}}" target="_blank"><img src="{{asset('/public/frontend/img/document_thumbnail.png')}}" class="img-fluid"></a>
                                                                                                @elseif($extension=='pdf')
                                                                                                    <a href="{{productSpecificationImgsPath.'/'.$specification['image']}}" target="_blank"><img src="{{asset('/public/frontend/img/pdf-thumbnail.jpeg')}}" class="img-fluid"></a>
                                                                                                @else
                                                                                                    <img src="{{productSpecificationImgsPath.'/'.$specification['image']}}" class="img-fluid">
                                                                                                @endif
                                                                                            @else
                                                                                                --
                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(isset($product['product_selected_categories']) && sizeof($product['product_selected_categories'])>0)
                                                        <div class="form-group">
                                                            <label class="build_label">Category</label>
                                                            <div>
                                                                @foreach($product['product_selected_categories'] as $key => $productCategory)
                                                                    @if(!empty($productCategory))
                                                                        <span class="badge badge-info badge_view_prdct">{{@$productCategory['product_category_detail']['name']}}</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(isset($product['product_selected_sub_categories']) && sizeof($product['product_selected_sub_categories'])>0)
                                                        <div class="form-group">
                                                            <label class="build_label">Sub Category</label>
                                                            <div>
                                                                @foreach($product['product_selected_sub_categories'] as $key => $productSubCategory)
                                                                    @if(!empty($productSubCategory))
                                                                        <span class="badge badge-info badge_view_prdct">{{@$productSubCategory['product_sub_category_detail']['name']}}</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(isset($product['product_selected_selling_materials']) && sizeof($product['product_selected_selling_materials'])>0)
                                                        <div class="form-group">
                                                            <label class="build_label">Type of Material</label>
                                                            <div>
                                                                @foreach($product['product_selected_selling_materials'] as $key => $productSellingMaterial)
                                                                    @if(!empty($productSellingMaterial))
                                                                        <span class="badge badge-info badge_view_prdct">{{@$productSellingMaterial['product_selling_material_detail']['selling_material_name']}}</span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(isset($product['product_images']) && sizeof($product['product_images'])>0)
                                                        <div class="form-group drop_area">
                                                            <label class="build_label">Product Photos</label>
                                                            <div class="prdut_pics">
                                                                @foreach($product['product_images'] as $key => $productImage)
                                                                    @if(!empty($productImage) && file_exists(productImgsBasePath.$productImage['name']))
                                                                        <img  src="{{productImgsPath.'/'.$productImage['name']}}">
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(isset($product['product_related_links']) && sizeof($product['product_related_links'])>0)
                                                        <div class="form-group">
                                                            <label class="build_label">Related Links</label>
                                                           <p class="bg-light">
                                                                @foreach($product['product_related_links'] as $key => $productRelatedLink)
                                                                    @if(!empty($productRelatedLink))
                                                                        <span class="bg-light spn-width mb-0"><a href="" class="text-primary">{{@$productRelatedLink['link']}} </a></span>
                                                                    @endif
                                                                @endforeach 
                                                           </p>
                                                        </div>
                                                    @endif
                                                    <!-- <div class="form-group">
                                                        <label class="build_label">Select Predefined Keywords</label>
                                                        <input type="text" name="pre_word" class="form-control" value="Lorem ipsum" placeholder="">
                                                    </div> -->
                                                    @if(isset($product['product_selected_keywords']) && sizeof($product['product_selected_keywords'])>0)
                                                        <div class="form-group">
                                                            <label class="build_label">Keywords</label>
                                                              <div>
                                                                @foreach($product['product_selected_keywords'] as $key => $productSelectedKeyword)
                                                                    @if(!empty($productSelectedKeyword))
                                                                        <span class="badge badge-info badge_view_prdct">{{@$productSelectedKeyword['product_keyword_detail']['keyword_name']}}</span>
                                                                    @endif
                                                                @endforeach 
                                                            </div>
                                                        </div> 
                                                    @endif
                                                    @if(!empty($product['ribbon']))
                                                        <div class="form-group">
                                                            <label class="build_label">Ribbon</label>
                                                            <input type="text" name="ribbon" class="form-control" value="{{@$product['ribbon']}}" placeholder="">
                                                        </div> 
                                                    @endif
                                                    @if(!empty($product['user_store_location_id']) && $product['user_store_location_detail']!=null && !empty($product['user_store_location_detail']['store_name']))
                                                        <div class="form-group">
                                                            <label class="build_label">Store</label>
                                                            <input type="text" name="store" class="form-control" value="{{@$product['user_store_location_detail']['store_name']}}" placeholder="">
                                                        </div> 
                                                    @endif

                                                    <div class="itm_heading mb-2">
                                                        <h4>2-Product Features & Properties</h4>
                                                    </div>
                                                    <div class="row">
                                                        @if(!empty($product['product_brand_id']) && $product['product_brand_detail']!=null && !empty($product['product_brand_detail']['brand_name']))
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <label class="build_label"> Brand</label>
                                                                        <input type="text" name="brand" class="form-control" value="{{@$product['product_brand_detail']['brand_name']}}" placeholder="">
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                        @endif
                                                        @if(!empty($product['product_color_id']) && $product['product_color_detail']!=null && !empty($product['product_color_detail']['name']))
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <label class="build_label">Color</label>
                                                                        <input type="text" name="color" class="form-control" value="{{@$product['product_color_detail']['name']}}" placeholder="">
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($product['country_id']) && $product['country_detail']!=null && !empty($product['country_detail']['name']))
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <label class="build_label">Country of Origin</label>
                                                                        <input type="text" name="country" class="form-control" value="{{@$product['country_detail']['name']}}" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($product['product_grade_id']) && $product['product_grade_detail']!=null && !empty($product['product_grade_detail']['grade_name']))
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <label class="build_label">Classification / Grade</label>
                                                                         <input type="text" name="grade" class="form-control" value="{{@$product['product_grade_detail']['grade_name']}}" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="items_size">
                                                        <div class="itms_size_quntt">
                                                            <!-- <div class="text-right">
                                                                <a href="javascript:;" class="add_new add_new_sel_unt">
                                                                    <i class="fa fa-plus"></i> Add New Unit
                                                                </a>
                                                            </div> -->
                                                            <div class="row new_opt_cls">
                                                                @if(!empty($product['diameter_number']) && !empty($product['diameter_unit_id']) && $product['diameter_unit_detail']!=null && !empty($product['diameter_unit_detail']['name']))
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Diameter</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="diameter_number" class="form-control" placeholder="" value="{{@$product['diameter_number']}}">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="diameter_number" class="form-control" placeholder="" value="{{@$product['diameter_unit_detail']['name']}}">
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!empty($product['length_number']) && !empty($product['length_unit_id']) && $product['length_unit_detail']!=null && !empty($product['length_unit_detail']['name']))
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Length</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="length_number" class="form-control" placeholder="" value="{{@$product['length_number']}}">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                         <input type="text" name="diameter_number" class="form-control" placeholder="" value="{{@$product['length_unit_detail']['name']}}">
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!empty($product['width_number']) && !empty($product['width_unit_id']) && $product['width_unit_detail']!=null && !empty($product['width_unit_detail']['name']))
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Width</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="width_number" class="form-control" placeholder="" value="{{@$product['width_number']}}">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                         <input type="text" name="diameter_number" class="form-control" placeholder="" value="{{@$product['width_unit_detail']['name']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!empty($product['depth_number']) && !empty($product['depth_unit_id']) && $product['depth_unit_detail']!=null && !empty($product['depth_unit_detail']['name']))
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Depth</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="depth_number" placeholder="" value="{{@$product['depth_number']}}" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="diameter_number" class="form-control" placeholder="" value="{{@$product['depth_unit_detail']['name']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!empty($product['height_number']) && !empty($product['height_unit_id']) && $product['height_unit_detail']!=null && !empty($product['height_unit_detail']['name']))
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Height</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="height_number" class="form-control" placeholder="" value="{{@$product['height_number']}}">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="height_number" class="form-control" placeholder="" value="{{@$product['height_unit_detail']['name']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!empty($product['thickness_number']) && !empty($product['thickness_unit_id']) && $product['thickness_unit_detail']!=null && !empty($product['thickness_unit_detail']['name']))
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Thickness</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="thickness_number" class="form-control" placeholder="" value="{{@$product['thickness_number']}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="height_number" class="form-control" placeholder="" value="{{@$product['thickness_unit_detail']['name']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!empty($product['particle_number']) && !empty($product['particle_unit_id']) && $product['particle_unit_detail']!=null && !empty($product['particle_unit_detail']['name']))
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Particles</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="particle_number" placeholder="" class="form-control" value="{{@$product['particle_number']}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="height_number" class="form-control" placeholder="" value="{{@$product['particle_unit_detail']['name']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(isset($product['product_new_options']) && sizeof($product['product_new_options'])>0)
                                                                    @foreach($product['product_new_options'] as $key => $productNewOption)
                                                                        @if(!empty($productNewOption))
                                                                            <div class="col-lg-6">
                                                                                <div class="size_chart">
                                                                                    <h5 class="chart_head mb-2">{{@$productNewOption['title']}}</h5>
                                                                                    <div class="row">
                                                                                        @if($productNewOption['option_type']=='without_unit')
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" name="particle_number" placeholder="" class="form-control" value="{{@$productNewOption['value']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" name="particle_number" placeholder="" class="form-control" value="{{@$productNewOption['value']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" name="height_number" class="form-control" placeholder="" value="{{@$productNewOption['product_selling_unit_detail']['name']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>                                                   

                                                    <?php $leastUnit = "";?>
                                                    <div class="itm_heading mb-2">
                                                        <h4>3-Quantities / Units / Packing</h4>
                                                    </div>
                                                    @if(!empty($product['selling_unit_id']) && $product['selling_unit_detail']!=null && !empty($product['selling_unit_detail']['name']))
                                                        <div class="form-group opt_choose_unit">
                                                            <label class="build_label">Selling Unit</label>
                                                            <input type="text" name="height_number" class="form-control" placeholder="" value="{{@$product['selling_unit_detail']['name']}}">
                                                        </div>
                                                    @endif
                                                    @if($product['is_packing_unit_checked']=='yes')
                                                        <div class="packing_content items_prices pck_unit_div">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="build_label">Packing</label>
                                                                        <div class="custom-control custom-checkbox">
                                                                           <input type="checkbox" onclick="return false"  checked="" class="custom-control-input packing_chck build_label" id="customCheckbox_new51" name="is_packing_unit_checked" value="yes">
                                                                           <label class="custom-control-label" for="customCheckbox_new51">In case product packed in different shapes and unit then identify below:</label>
                                                                       </div>
                                                                    </div>
                                                                </div>
                                                               <!--  <div class="col-lg-4">
                                                                    <p class="com_red text-right mb-0">
                                                                       <a href="javascript:;" class="add_pack">
                                                                            <i class="fa fa-plus"></i> Add packing unit
                                                                       </a>
                                                                    </p>
                                                                </div>   -->                                                              
                                                            </div>
                                                            <div class="pack_inr_div appendPacking">
                                                                @if(isset($product['product_packings']) && sizeof($product['product_packings'])>0)
                                                                    @foreach($product['product_packings'] as $key => $productPacking)
                                                                        @if(!empty($productPacking))
                                                                            <div class="pack_info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <h5 class="chart_head mb-2">Each</h5>
                                                                                        <div class="form-group">
                                                                                           <input type="text"  name="packing_append_div[0][each_content_unit]" class="form-control fromUnit each_content_unit" readonly="" placeholder="" value="{{@$productPacking['each_content_unit_detail']['name']}}">
                                                                                           <input type="hidden" name="packing_append_div[0][each_content_unit_id]" class="fromUnitId" value="" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <h5 class="chart_head mb-2">Content</h5>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                   <input type="text" name="packing_append_div[0][content_number]" id="content_number0" class="form-control content_number" value="{{@$productPacking['content_number']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                     <input type="text" name="height_number" class="form-control" placeholder="" value="{{@$productPacking['content_unit_detail']['name']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php $leastUnit =  @$productPacking['content_unit_detail']['name'];?>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div><br>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-6 qtty_stock_div">
                                                            <div class="size_chart">
                                                                <h5 class="chart_head mb-2">Quantity in stock</h5>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="available_quantity_number" placeholder="" class="form-control available_quantity_count" value="{{@$product['available_quantity_number']}}"> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="available_quantity_unit" readonly="" class="form-control fromUnit" placeholder="" value="{{@$product['available_quantity_unit_detail']['name']}}"> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 qtty_stock_cntnt_div">
                                                            <div class="size_chart">
                                                                 <h5 class="chart_head mb-2">Content</h5>
                                                                 <div class="row">
                                                                     <div class="col-6">
                                                                        <div class="form-group">
                                                                            <input type="text" readonly="" name="available_quantity_content_number" class="form-control available-price" placeholder="" value="{{@$product['available_quantity_content_number']}}">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="available_quantity_content_unit" placeholder="" class="form-control avilable-unit" value="{{@$product['available_quantity_content_unit_detail']['name']}}">
                                                                        </div>
                                                                     </div>
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="items_size">   
                                                       <label class="build_label">Minimum Buying quantity</label>
                                                       <div class="size_chart">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                   <div class="form-group">
                                                                       <input type="text" name="minimum_buying_quantity_number" class="form-control min_buying_qtty" value="{{@$product['minimum_buying_quantity_number']}}">
                                                                   </div>
                                                                </div>
                                                                <div class="col-6">
                                                                   <div class="form-group">
                                                                       <input type="text" name="minimum_buying_quantity_unit" class="form-control fromUnit" readonly="" placeholder="" value="{{@$product['minimum_buying_quantity_unit_detail']['name']}}">
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="items_size items_prices mb-3">
                                                        <div class="itm_heading mb-2">
                                                           <h4 class="build_label">4-Price</h4>
                                                        </div>
                                                        <div class="text-center tax-highlight my-2">
                                                            <h5>Price entered are inclusive of {{$productTax['tax_percent']}}% Tax.</h5>
                                                        </div>
                                                        @if($product['price_type']=='according_to_ordered_quantity')
                                                            <div class="row m-0 px-1">
                                                                <div class="col-lg-12">
                                                                    <div class="custom-control custom-radio mb-2">
                                                                        <input type="radio" checked="" class="custom-control-input ordrd_qtty" id="customRadio_new18"  name="price_type" value="according_to_ordered_quantity">
                                                                        <label class="custom-control-label build_label" for="customRadio_new18">Insert price according to ordered quantity:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="apnnd_div">
                                                                    @if(isset($product['product_price_ranges']) && sizeof($product['product_price_ranges'])>0)
                                                                        @foreach($product['product_price_ranges'] as $key => $productPriceRange)
                                                                            @if(!empty($productPriceRange))
                                                                                <div class="price_wrap main_div mb-2">
                                                                                    <div class="row m-0" part="0">
                                                                                        <div class="col-lg-3">
                                                                                            <label class="chart_head mb-2">From</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" id="fromNumber_0" name="price_firsrt_append_div[0][from_number]" class="form-control choosePriceInpt more_prc_inpt" rel="from_number" value="{{@$productPriceRange['from_number']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <label class="chart_head mb-2" style="opacity: 0;">To</label>
                                                                                            <div class="form-group">
                                                                                             <input type="text" name="price_firsrt_append_div[0][unit_price]" readonly="" class="form-control unit_price" value="{{@$product['selling_unit_detail']['name']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <label class="chart_head mb-2">To</label>
                                                                                            <div class="form-group">
                                                                                               <input type="text" id="toNumber_0" name="price_firsrt_append_div[0][to_number]" class="form-control choosePriceInpt more_prc_inpt" rel="to_number" value="{{@$productPriceRange['to_number']}}">
                                                                                           </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <label class="chart_head mb-2" style="opacity: 0;">To</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="price_firsrt_append_div[0][unit_price]" readonly="" class="form-control unit_price" value="{{@$product['selling_unit_detail']['name']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row m-0">
                                                                                        <div class="col-lg-3">
                                                                                            <div class="form-group">
                                                                                               <label>Price</label>
                                                                                               <div class="sell_unit_price ">
                                                                                                    <span>{{@$productPriceRange['selling_unit_price']}} SR/{{@$product['selling_unit_detail']['name']}}</span>
                                                                                               </div>
                                                                                           </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <div class="form-group">
                                                                                               <label>Discount</label>
                                                                                                <div class="discount_wrap d-flex">
                                                                                                    @if($productPriceRange['discount_type']=='percent')
                                                                                                        <span>{{@$productPriceRange['discount']}}%</span>
                                                                                                    @else
                                                                                                        <span>{{@$productPriceRange['discount']}} SR</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <div class="form-group">
                                                                                                <label>Price After Discount</label>
                                                                                                <div class="sell_unit_price d-flex">
                                                                                                    <span>{{@$productPriceRange['final_price']}} SR/{{@$product['selling_unit_detail']['name']}}</span>
                                                                                               </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-3">
                                                                                            <div class="form-group">
                                                                                                <label>Unit Price</label>
                                                                                                <div class="sell_unit_price d-flex">
                                                                                                    @if(!empty($leastUnit))
                                                                                                        <span>{{@$productPriceRange['unit_price']}} SR/{{@$leastUnit}}</span>
                                                                                                    @else
                                                                                                        <span>{{@$productPriceRange['unit_price']}} SR/{{@$product['selling_unit_detail']['name']}}</span>
                                                                                                    @endif
                                                                                               </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="size_chart">
                                                                <div class="insert_cus_price px-2">
                                                                    <div class="px-3 mb-0">
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" checked="" class="custom-control-input any_qtty" id="customRadio_new19" name="price_type" value="any_quantity_ordered">
                                                                            <label class="custom-control-label build_label" for="customRadio_new19">Or Insert price for any quantity ordered:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row any_qtty_div">
                                                                        <div class="col-lg-12">
                                                                            @if(isset($product['product_price_ranges']) && sizeof($product['product_price_ranges'])>0)
                                                                                @foreach($product['product_price_ranges'] as $key => $productPriceRange)
                                                                                    @if(!empty($productPriceRange))
                                                                                        <div class="row m-0 price_wrap">
                                                                                            <div class="col-lg-3">
                                                                                                <div class="form-group">
                                                                                                   <label>Price</label>
                                                                                                   <div class="sell_unit_price ">
                                                                                                        <span>{{@$productPriceRange['selling_unit_price']}} SR/{{@$product['selling_unit_detail']['name']}}</span>
                                                                                                   </div>
                                                                                               </div>
                                                                                            </div>
                                                                                            <div class="col-lg-3">
                                                                                                <div class="form-group">
                                                                                                   <label>Discount</label>
                                                                                                    <div class="discount_wrap d-flex">
                                                                                                        @if($productPriceRange['discount_type']=='percent')
                                                                                                            <span>{{@$productPriceRange['discount']}}%</span>
                                                                                                        @else
                                                                                                            <span>{{@$productPriceRange['discount']}} SR</span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-3">
                                                                                                <div class="form-group">
                                                                                                    <label>Price After Discount</label>
                                                                                                    <div class="sell_unit_price d-flex">
                                                                                                        <span>{{@$productPriceRange['final_price']}} SR/{{@$product['selling_unit_detail']['name']}}</span>
                                                                                                   </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-3">
                                                                                                <div class="form-group">
                                                                                                    <label>Unit Price</label>
                                                                                                    <div class="sell_unit_price d-flex">
                                                                                                        @if(!empty($leastUnit))
                                                                                                            <span>{{@$productPriceRange['unit_price']}} SR/{{@$leastUnit}}</span>
                                                                                                        @else
                                                                                                            <span>{{@$productPriceRange['unit_price']}} SR/{{@$product['selling_unit_detail']['name']}}</span>
                                                                                                        @endif
                                                                                                   </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>      
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div> 

                                                    <div class="items_size items_prices mb-3">                                                          
                                                        <div class="choose_plan_terms">
                                                            <div class="itm_heading mb-2">
                                                                <h4>5-Terms of payment</h4>
                                                            </div>
                                                            <div class="view_trms_nw  px-2">
                                                                @if($product['term_of_payment_type']=='according_to_order_amount')
                                                                    <div class="ad_more d-flex justify-content-between align-items-center">
                                                                        <div class="custom-control custom-radio mb-3">
                                                                            <input type="radio" checked="" class="custom-control-input slect_1" id="customRadio_new21" checked="" name="term_of_payment_type" value="according_to_order_amount">
                                                                            <label class="custom-control-label build_label" for="customRadio_new21">Choose plans according to order amount:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="apnd_plans_div">
                                                                        @if(isset($product['product_term_of_payments']) && sizeof($product['product_term_of_payments'])>0)
                                                                            @foreach($product['product_term_of_payments'] as $key => $productTermOfPayment)
                                                                                @if(!empty($productTermOfPayment))
                                                                                    <div class="main_cls plan_main_cls">
                                                                                        <div class="row" part="0">
                                                                                            <div class="col-sm-3">
                                                                                                <div class="form-group">
                                                                                                    <label>From(SR)</label>
                                                                                                    <input type="text" name="price_firsrt_append_div[0][unit_price]" readonly="" class="form-control unit_price" value="{{@$productTermOfPayment['from_price']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-2">
                                                                                                <div class="form-group">
                                                                                                   <label>Range</label>
                                                                                                    <div class="discount_wrap">
                                                                                                        <div class="price_percnt new_range text-center" style="height: 38px">
                                                                                                            <span class="range_spv_dv @if($productTermOfPayment['range_type']=='to') active @endif" type="to">To</span>
                                                                                                            <span class="range_spv_dv @if($productTermOfPayment['range_type']=='above') active @endif" type="above">Above</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden" name="plan_append_div[0][range_type]" class="range_typ_cls" value="to">
                                                                                            <div class="col-sm-3">
                                                                                                <div class="form-group">
                                                                                                    <label>To(SR)</label>
                                                                                                    <input type="text" name="price_firsrt_append_div[0][unit_price]" readonly="" class="form-control unit_price" value="{{@$productTermOfPayment['to_price']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-4">
                                                                                                <div class="form-group">
                                                                                                    <label>Plan</label>
                                                                                                     <input type="text" name="" readonly="" class="form-control unit_price" value="{{@$productTermOfPayment['plan_detail']['name']}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif

                                                                    </div>
                                                                @else
                                                                    <div class="custom-control custom-radio mb-3">
                                                                        <input type="radio" checked="" class="custom-control-input default_trm" id="customRadio_new22" name="term_of_payment_type" value="full_payment">
                                                                        <label class="custom-control-label build_label" for="customRadio_new22">No term of payment(100% Full Payment to be paid upon checkout)</label>
                                                                    </div>
                                                                @endif
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    @if($product['has_special_delivery_condition']=='yes')
                                                        <div class="items_size items_prices mb-3">
                                                            <div class="itm_heading mb-2">
                                                               <h4 class="build_label">6-Special Delivery Conditions</h4>
                                                            </div>
                                                            <div class="check_box_selects px-2">
                                                                <div class="custom-control custom-checkbox mb-2">
                                                                   <input type="checkbox" onclick="return false" checked="" readonly="" class="custom-control-input packing_chck spl_del_chck build_label" id="del_checkbox" name="has_special_delivery_condition" value="yes">
                                                                   <label class="custom-control-label build_label" for="del_checkbox">In case this product has a special delivery case than other products please define below:</label>
                                                                </div>
                                                            </div>
                                                            <div class="special_del_options del_optns">
                                                                @if(!empty($product['special_delivery_condition_type']) && $product['special_delivery_condition_type']=='free_delivery')
                                                                    <div class="custom-control custom-radio">
                                                                       <input type="radio" checked="" class="custom-control-input packing_chck build_label del_fee_rad" id="sd_box1" name="special_delivery_condition_type" value="free_delivery">
                                                                       <label class="custom-control-label build_label" for="sd_box1">Free Delivery</label>
                                                                    </div>
                                                                @elseif(!empty($product['special_delivery_condition_type']) && $product['special_delivery_condition_type']=='no_delivery')
                                                                    <div class="custom-control custom-radio">
                                                                       <input type="radio" class="custom-control-input packing_chck build_label del_fee_rad" id="sd_box2" name="special_delivery_condition_type" value="no_delivery">
                                                                       <label class="custom-control-label build_label" for="sd_box2">No Delivery</label>
                                                                    </div>
                                                                @else
                                                                    <div class="custom-control custom-radio fees_suboptions">
                                                                       <input type="radio" checked="" class="custom-control-input packing_chck build_label del_fee_rad delv_fee_inpt_rad" id="sd_box3" name="special_delivery_condition_type" value="according_to_order_amount">
                                                                       <label class="custom-control-label build_label" for="sd_box3">Delivery Fees (According to amount of order):</label>
                                                                    </div>
                                                                    <div class="delvry_fee_options del_fee_range">
                                                                        @if(isset($product['product_special_delivery_fees']) && sizeof($product['product_special_delivery_fees'])>0)
                                                                            @foreach($product['product_special_delivery_fees'] as $key => $productSpecialDeliveryFee)
                                                                                @if(!empty($productSpecialDeliveryFee))
                                                                                    <div class="delivery_wrap_option">
                                                                                        <div class="row" part="0">
                                                                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" id="fromDelv0" name="according_to_order_amount_div[0][from_price]" class="form-control delvFeeInpt" rel="from_price" placeholder="" value="{{@$productSpecialDeliveryFee['from_price']}} SR">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                                                                <div class="form-group">
                                                                                                    <input type="text" id="toDelv0" name="according_to_order_amount_div[0][to_price]" class="form-control delvFeeInpt" rel="to_price" placeholder="" value="{{@$productSpecialDeliveryFee['to_price']}} SR">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                                                                <div class="form-group">
                                                                                                    @if($productSpecialDeliveryFee['delivery_type']=='not_available')
                                                                                                        <input type="text" id="amtDelv0" name="according_to_order_amount_div[0][amount]" class="form-control delvFeeAmt" placeholder="" value="Not Available">
                                                                                                    @elseif($productSpecialDeliveryFee['delivery_type']=='free')
                                                                                                        <input type="text" id="amtDelv0" name="according_to_order_amount_div[0][amount]" class="form-control delvFeeAmt" placeholder="" value="Free">
                                                                                                    @else
                                                                                                        <input type="text" id="amtDelv0" name="according_to_order_amount_div[0][amount]" class="form-control delvFeeAmt" placeholder="" value="Payable">
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                            @if($productSpecialDeliveryFee['delivery_type']=='payable')
                                                                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                                                                    <div class="form-group del_amt_div">
                                                                                                        <input type="text" id="amtDelv0" name="according_to_order_amount_div[0][amount]" class="form-control delvFeeAmt" placeholder="{{@$productSpecialDeliveryFee['amount']}} SR">
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif  
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif

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
    <!-- Choose Plan -->
@stop
@section('script')

@stop