@extends('frontend.layout.providerLayout')
@section('title','Add Product')
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
                                            <h3>Add New Product</h3>
                                        </div>
                                        <div class="add_product_form">
                                            <form id="add-product-form" action="{{url('provider/products/add')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-10 offset-sm-1">                                                      
                                                        <div class="itm_heading mb-2">
                                                            <h4>1-Product Information</h4>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Product Bar Code</label>
                                                            <input type="text" name="item_bar_code" class="form-control" value="" placeholder="Enter Product Bar Code">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row align-items-end">
                                                                <div class="col-lg-7">
                                                                    <label class="build_label">Product Name</label>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class="btn_right text-right mb-1">
                                                                        <button class="btn btn_inpt item_box_english btn_bg" type="button"><span>English</span></button>
                                                                        <button class="btn btn_inpt item_box_arabic" type="button"><span>عربى</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="item_name" class="form-control itm_nam" value="" placeholder="Enter Product Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Product Seller Code</label>
                                                            <input type="text" name="seller_item_code" class="form-control" value="" placeholder="Enter product seller code">
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <label class="build_label">Seller Membership ID</label>
                                                                    <input type="text" readonly="" class="form-control" value="{{Auth::User()->supplier_code}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <label class="build_label">Seller Name</label>
                                                                    <input type="text" readonly="" class="form-control" value="{{@Auth::User()->contact_name}} {{@Auth::User()->contact_last_name}}">
                                                                </div>
                                                            </div>    
                                                        </div>     
                                                        <div class="form-group main_description_class">
                                                            <div class="row align-items-end">
                                                                <div class="col-lg-7">
                                                                    <label class="build_label">Product Description</label>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class="btn_right text-right mb-1">
                                                                        <button class="btn inpt_desp item_description_box_english btn_bg" type="button"><span>English</span></button>
                                                                        <button class="btn inpt_desp item_description_box_arabic" type="button"><span>عربى</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>      
                                                            <div>
                                                                <textarea name="description" placeholder="english" class="form-control textAreaCommon ">
                                                                </textarea>    
                                                                <input type="hidden" class="hidden_desc_cls" name="description_en" value="" >
                                                            </div>
                                                        </div>
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
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="product_spec specification_class">
                                                                            <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div> 
                                                            </div>
                                                            <div class="btn_right text-right">
                                                                <button class="btn btn_theme" type="button" data-toggle="modal" data-target="#specification"><span>Add an Info Section</span></button>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Select Category</label>
                                                            <select class="form-control category_id_class mul_category" name="category_id[]" multiple="multiple">
                                                                @foreach($productCategories as $category)
                                                                    <option value="{{$category->id}}">{{@$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label id="category_id[]-error" class="error" for="category_id[]"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Select Sub Category</label>
                                                            <select class="form-control mul_category sub_category_class" name="sub_category_id[]" multiple="multiple">
                                                            </select>
                                                            <label id="sub_category_id[]-error" class="error" for="sub_category_id[]"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Select Type of Material</label>
                                                            <select class="form-control mul_category typ_of_material_class" name="type_of_material_id[]" multiple="multiple">
                                                            </select>
                                                            <label id="type_of_material_id[]-error" class="error" for="type_of_material_id[]"></label>
                                                        </div>
                                                        <div class="drop_area">
                                                            <label class="build_label">Product Photos</label>
                                                            <div class="form-group" id="data_section_8">
                                                                <div class="drop_post_files dropzone dz-clickable" id="my-dropzone">
                                                                    <div class="dz-default dz-message">
                                                                        <span>Drop files here to upload or click here</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="media_ids" id="image_ids">
                                                        <div class="form-group">
                                                            <label class="build_label">Related Links</label>
                                                            <input type="text" name="related_links" class="form-control" value="" placeholder="Link1, Link2, Link3 ...">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Select Predefined Keywords</label>
                                                            <select class="form-control mul_category" name="product_keyword_ids[]" multiple="multiple">
                                                                @foreach($productKeywords as $productKeyword)
                                                                    <option value="{{$productKeyword['id']}}">{{@$productKeyword['keyword_name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Keywords</label>
                                                            <input type="text" name="Keywords" class="form-control" value="" placeholder="keyword1, keyword2, keyword3 ...">
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="build_label">Ribbon</label>
                                                            <input type="text" name="ribbon" class="form-control" value="" placeholder="Enter ribbon">
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="build_label">Store</label>
                                                            <select class="form-control" name="user_store_location_id">
                                                                <option selected disabled>Select Store</option>
                                                                @foreach($storeLocations as $storeLocation)
                                                                    <option value="{{$storeLocation['id']}}">{{@$storeLocation['store_name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> 

                                                        <div class="itm_heading mb-2">
                                                            <h4>2-Product Features & Properties</h4>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <label class="build_label"> Brand</label>
                                                                        <a href="javascript:;" class="add_new add_new_brnd">
                                                                            <i class="fa fa-plus"></i> Add New
                                                                        </a>
                                                                    </div>
                                                                    <select class="form-control prod_brnd_cls" name="product_brand_id">
                                                                          <option selected disabled>Select Brand</option>
                                                                        @foreach($brandProducts as $brandProduct)
                                                                            <option value="{{$brandProduct->id}}">{{@$brandProduct->brand_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>    
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <label class="build_label">Color</label>
                                                                        <a href="javascript:;" class="add_new add_new_clr">
                                                                            <i class="fa fa-plus"></i> Add New
                                                                        </a>
                                                                    </div>
                                                                   <select class="form-control prod_clr_cls" name="product_color_id">
                                                                        <option selected disabled>Select Color</option>
                                                                        @foreach($brandColors as $brandColor)
                                                                            <option value="{{$brandColor->id}}">{{@$brandColor->name}}</option>
                                                                        @endforeach
                                                                   </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <label class="build_label">Country of Origin</label>
                                                                        <a href="javascript:;" class="add_new add_new_cntry">
                                                                            <i class="fa fa-plus"></i> Add New
                                                                        </a>
                                                                    </div>
                                                                    <select class="form-control prod_cntry_cls" name="country_id">
                                                                        <option selected disabled>Select Country of Origin</option>
                                                                        @foreach($Origins as $Origin)
                                                                            <option value="{{$Origin->id}}">{{@$Origin->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <label class="build_label">Classification / Grade</label>
                                                                        <a href="javascript:;" class="add_new add_new_grd">
                                                                            <i class="fa fa-plus"></i> Add New
                                                                        </a>
                                                                    </div>
                                                                    <select class="form-control prod_grd_cls" name="product_grade_id">
                                                                         <option selected disabled>Select Grade</option>
                                                                         @foreach($productGrades as $productGrade)
                                                                             <option value="{{$productGrade->id}}">{{@$productGrade->grade_name}}</option>
                                                                         @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="items_size">
                                                            <div class="itms_size_quntt">
                                                                <div class="text-right">
                                                                    <a href="javascript:;" class="add_new add_new_sel_unt">
                                                                        <i class="fa fa-plus"></i> Add New Unit
                                                                    </a>
                                                                </div>
                                                                <div class="row new_opt_cls">
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Diameter</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="diameter_number" class="form-control" placeholder="Enter Diameter">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                        <select class="form-control prod_sel_unt_cls" name="diameter_unit_id">
                                                                                            <option selected disabled>Select Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Length</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="length_number" class="form-control" placeholder="Enter Length">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                        <select class="form-control prod_sel_unt_cls" name="length_unit_id">
                                                                                            <option selected disabled>Select Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Width</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="width_number" class="form-control" placeholder="Enter Width">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control prod_sel_unt_cls" name="width_unit_id">
                                                                                            <option selected disabled>Select Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option value="{{$category->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Depth</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="depth_number" placeholder="Enter Depth" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control prod_sel_unt_cls" name="depth_unit_id">
                                                                                            <option selected disabled>Select Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option value="{{$category->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Height</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="height_number" class="form-control" placeholder="Enter Height">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control prod_sel_unt_cls" name="height_unit_id">
                                                                                            <option selected disabled>Select Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                       </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Thickness</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="thickness_number" class="form-control" placeholder="Enter Thickness">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control prod_sel_unt_cls" name="thickness_unit_id">
                                                                                            <option selected disabled>Select Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Particles</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="particle_number" placeholder="Enter Particles" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                        <select class="form-control prod_sel_unt_cls" name="particle_unit_id">
                                                                                            <option selected disabled>Select Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right mb-3">
                                                            <a href="javascript:;" class="add_new add_new_optn">
                                                                <i class="fa fa-plus"></i> Add New Option
                                                            </a>
                                                        </div>

                                                        <div class="itm_heading mb-2">
                                                            <h4>3-Quantities / Units / Packing</h4>
                                                        </div>
                                                        <div class="form-group opt_choose_unit">
                                                            <label class="build_label">Selling Unit</label>
                                                            <select class="form-control selling_unit_item prod_sel_unt_cls" name="selling_unit_id">
                                                                <option value="" selected disabled>Select Selling Unit</option>
                                                                @foreach($SellingUnits as $SellingUnit)
                                                                    <option value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="packing_content items_prices pck_unit_div">
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <div class="form-group">
                                                                        <label class="build_label">Packing</label>
                                                                        <div class="custom-control custom-checkbox">
                                                                           <input type="checkbox" checked="" class="custom-control-input packing_chck build_label" id="customCheckbox_new51" name="is_packing_unit_checked" value="yes">
                                                                           <label class="custom-control-label" for="customCheckbox_new51">In case product packed in different shapes and unit then identify below:</label>
                                                                       </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <p class="com_red text-right mb-0">
                                                                       <a href="javascript:;" class="add_pack">
                                                                            <i class="fa fa-plus"></i> Add packing unit
                                                                       </a>
                                                                    </p>
                                                                </div>                                                                
                                                            </div>
                                                            <div class="pack_inr_div appendPacking">
                                                                <div class="pack_info">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <h5 class="chart_head mb-2">Each</h5>
                                                                            <div class="form-group">
                                                                               <input type="text"  name="packing_append_div[0][each_content_unit]" class="form-control fromUnit each_content_unit" readonly="" placeholder="select unit">
                                                                               <input type="hidden" name="packing_append_div[0][each_content_unit_id]" class="fromUnitId" value="" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <h5 class="chart_head mb-2">Content</h5>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="packing_append_div[0][content_number]" id="content_number0" class="form-control content_number">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control content_unit renderUnit" name="packing_append_div[0][content_unit_id]" id="content_unit0">
                                                                                            <option value="" selected disabled>Select Unit </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-6 qtty_stock_div">
                                                                <div class="size_chart">
                                                                    <h5 class="chart_head mb-2">Quantity in stock</h5>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <input type="text" name="available_quantity_number" placeholder=" Available Quantity " value="" class="form-control available_quantity_count">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <input type="text" name="available_quantity_unit" readonly="" value="" class="form-control fromUnit" placeholder="select unit"> 
                                                                                <input type="hidden" name="available_quantity_unit_id" class="fromUnitId" value="" />
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
                                                                                <input type="text" readonly="" name="available_quantity_content_number" class="form-control available-price" value="" placeholder="Enter Available Quantity Content Count">
                                                                            </div>
                                                                         </div>
                                                                         <div class="col-6">
                                                                            <div class="form-group">
                                                                                <input type="text" readonly="" name="available_quantity_content_unit" placeholder="Select Unit" class="form-control avilable-unit" value="">
                                                                                <input type="hidden" name="available_quantity_content_unit_id" class="avilable-unit-id" value="" />
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
                                                                           <input type="text" name="minimum_buying_quantity_number" class="form-control min_buying_qtty">
                                                                       </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                       <div class="form-group">
                                                                           <input type="text" name="minimum_buying_quantity_unit" class="form-control fromUnit" readonly="" placeholder="select unit">
                                                                           <input type="hidden" name="minimum_buying_quantity_unit_id" class="fromUnitId" value="" />
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
                                                                <h5>Price entered are inclusive of 15% Tax.</h5>
                                                            </div>
                                                            <div class="row px-1">
                                                                <div class="col-lg-8">
                                                                    <div class="custom-control custom-radio mb-2">
                                                                        <input type="radio" checked="" class="custom-control-input ordrd_qtty" id="customRadio_new18"  name="price_type" value="according_to_ordered_quantity">
                                                                        <label class="custom-control-label build_label" for="customRadio_new18">Insert price according to ordered quantity:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <p class="text-right mb-0">
                                                                        <a href="javascript:;" class="add_more">
                                                                            <i class="fa fa-plus"></i> Add more price
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="size_chart">
                                                                <div class="apnnd_div">
                                                                    <div class="price_wrap main_div mb-2">
                                                                        <div class="row" part="0">
                                                                            <div class="col-lg-3">
                                                                                <label class="chart_head mb-2">From</label>
                                                                                <div class="form-group">
                                                                                    <input type="text" id="fromNumber_0" name="price_firsrt_append_div[0][from_number]" class="form-control choosePriceInpt more_prc_inpt" rel="from_number" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <label class="chart_head mb-2" style="opacity: 0;">To</label>
                                                                                <div class="form-group">
                                                                                <input type="text" name="price_firsrt_append_div[0][from_unit]" value="" class="form-control fromUnit" readonly="" placeholder="select unit">
                                                                                <input type="hidden" name="price_firsrt_append_div[0][from_unit_id]" class="fromUnitId" value="" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <label class="chart_head mb-2">To</label>
                                                                                <div class="form-group">
                                                                                   <input type="text" id="toNumber_0" name="price_firsrt_append_div[0][to_number]" class="form-control choosePriceInpt more_prc_inpt" rel="to_number" value="">
                                                                               </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <label class="chart_head mb-2" style="opacity: 0;">To</label>
                                                                                <div class="form-group">
                                                                                   <input type="text" name="price_firsrt_append_div[0][to_unit]" class="form-control toUnit" readonly="" value=""  placeholder="select unit" value="">
                                                                                   <input type="hidden" name="price_firsrt_append_div[0][to_unit_id]" class="toUnitId" value="" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                   <label>Price</label>
                                                                                   <div class="sell_unit_price d-flex">
                                                                                        <input type="text" id="sellingUnitPrice__0" name="price_firsrt_append_div[0][selling_unit_price]" class="form-control sellingUnitPrice more_prc_inpt">
                                                                                        <div class="sell_fprice text-center">
                                                                                            <span class="" type="amount">SR/<span class="fromUnitTxt">Unit</span></span>
                                                                                        </div>
                                                                                   </div>
                                                                                   <label class="error" for="sellingUnitPrice__0"></label>
                                                                               </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                   <label>Discount</label>
                                                                                    <div class="discount_wrap d-flex">
                                                                                        <input type="text" name="price_firsrt_append_div[0][discount]" class="discount_amt form-control more_prc_inpt">
                                                                                        <input type="hidden" class="disc_typ_cls" name="price_firsrt_append_div[0][discount_type]" value="percent" />
                                                                                        <div class="price_percnt text-center">
                                                                                            <span class="disc_spv_dv active" type="percent">%</span>
                                                                                            <span class="disc_spv_dv" type="amount">SR</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Price After Discount</label>
                                                                                    <div class="sell_unit_price d-flex">
                                                                                        <input type="text" name="price_firsrt_append_div[0][final_price]" readonly="" class="form-control final_price" value="">
                                                                                        <div class="sell_fprice text-center">
                                                                                            <span class="" type="amount">SR/<span class="fromUnitTxt">Unit</span></span>
                                                                                        </div>
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Unit Price</label>
                                                                                    <div class="sell_unit_price d-flex">
                                                                                        <input type="text" name="price_firsrt_append_div[0][unit_price]" readonly="" class="form-control unit_price">
                                                                                        <div class="sell_fprice text-center">
                                                                                            <span class="" type="amount">SR/<span class="avilable-unit-txt">Unit</span></span>
                                                                                        </div>
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="insert_cus_price px-2">
                                                                    <div class="form-group mb-0">
                                                                        <div class="custom-control custom-radio">
                                                                            <input type="radio" class="custom-control-input any_qtty" id="customRadio_new19" name="price_type" value="any_quantity_ordered">
                                                                            <label class="custom-control-label build_label" for="customRadio_new19">Or Insert price for any quantity ordered:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row any_qtty_div">
                                                                        <div class="col-lg-12">
                                                                            <div class="row price_wrap">
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Price</label>
                                                                                        <div class="sell_unit_price d-flex">
                                                                                            <input type="text" name="price_firsrt_append_div[selling_unit_price]" class="form-control sellingUnitPrice">
                                                                                            <div class="sell_fprice text-center">
                                                                                                <span class="" type="amount">SR/<span class="fromUnitTxt">Unit</span></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <label id="price_firsrt_append_div[selling_unit_price]-error" class="error" for="price_firsrt_append_div[selling_unit_price]"></label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Discount</label>
                                                                                        <div class="discount_wrap d-flex">
                                                                                            <input type="text" name="price_firsrt_append_div[discount]" class="discount_amt form-control">
                                                                                            <input type="hidden" class="disc_typ_cls" name="price_firsrt_append_div[discount_type]" value="percent" />
                                                                                            <div class="price_percnt text-center">
                                                                                                <span class="disc_spv_dv active" type="percent">%</span>
                                                                                                <span class="disc_spv_dv" type="amount">SR</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                                                                
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Price After Discount</label>
                                                                                        <div class="sell_unit_price d-flex">
                                                                                            <input type="text" name="price_firsrt_append_div[final_price]" readonly="" class="form-control final_price" value="">
                                                                                            <div class="sell_fprice text-center">
                                                                                                <span class="" type="amount">SR/<span class="fromUnitTxt">Unit</span></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>Unit Price</label>
                                                                                        <div class="sell_unit_price d-flex">
                                                                                            <input type="text" name="price_firsrt_append_div[unit_price]" readonly="" class="form-control unit_price">
                                                                                            <div class="sell_fprice text-center">
                                                                                                <span class="" type="amount">SR/<span class="avilable-unit-txt">Unit</span></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 

                                                        <div class="items_size items_prices mb-3">                                                          
                                                            <div class="choose_plan_terms">
                                                                <div class="itm_heading mb-2">
                                                                    <h4>5-Terms of payment</h4>
                                                                </div>
                                                                <div class="view_trms_nw  px-2">
                                                                    <div class="ad_more d-flex justify-content-between align-items-center">
                                                                        <div class="custom-control custom-radio mb-3">
                                                                            <input type="radio" checked="" class="custom-control-input slect_1" id="customRadio_new21" checked="" name="term_of_payment_type" value="according_to_order_amount">
                                                                            <label class="custom-control-label build_label" for="customRadio_new21">Choose plans according to order amount:</label>
                                                                        </div>
                                                                        <p class="mb-0 pr-2">
                                                                            <a href="javascript:;" class="ad_more_plans">
                                                                                <i class="fa fa-plus"></i> Add more
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                    <div class="apnd_plans_div">
                                                                        <div class="form-group main_cls plan_main_cls">
                                                                            <div class="row" part="0">
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>From(SR)</label>
                                                                                        <input type="text" name="plan_append_div[0][from_price]" id="fromPrice[0]" value="" class="form-control fromPrice choosePlanInpt" rel="from_price" placeholder="Enter order amount">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2">
                                                                                    <div class="form-group">
                                                                                       <label>Range</label>
                                                                                        <div class="discount_wrap">
                                                                                            <div class="price_percnt new_range text-center">
                                                                                                <span class="range_spv_dv active" type="to">To</span>
                                                                                                <span class="range_spv_dv" type="above">Above</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name="plan_append_div[0][range_type]" class="range_typ_cls" value="to">
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label>To(SR)</label>
                                                                                        <input type="text" name="plan_append_div[0][to_price]" id="toPrice[0]" value="" class="form-control toPrice choosePlanInpt" rel="to_price" placeholder="Enter order amount">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label>Choose Plan</label>
                                                                                        <select class="form-control choosePlanDrpd" id="selectedPlanId[0]" name="plan_append_div[0][selected_plan_id]" rel="selected_plan_id">
                                                                                            <option value="" selected disabled>Select Plan</option>
                                                                                            @foreach($term_of_payment as $term)
                                                                                                <option value="{{$term['id']}}">{{@$term['name']}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <label class="error" for="selectedPlanId[0]"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-3">
                                                                        <input type="radio" class="custom-control-input default_trm" id="customRadio_new22" name="term_of_payment_type" value="full_payment">
                                                                        <label class="custom-control-label build_label" for="customRadio_new22">No term of payment(100% Full Payment to be paid upon checkout)</label>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>

                                                        <div class="items_size items_prices mb-3">
                                                            <div class="itm_heading mb-2">
                                                               <h4 class="build_label">6-Special Delivery Conditions</h4>
                                                            </div>
                                                            <div class="check_box_selects px-2">
                                                                <div class="custom-control custom-checkbox mb-2">
                                                                   <input type="checkbox" checked="" class="custom-control-input packing_chck spl_del_chck build_label" id="del_checkbox" name="has_special_delivery_condition" value="yes">
                                                                   <label class="custom-control-label build_label" for="del_checkbox">In case this product has a special delivery case than other products please define below:</label>
                                                                </div>
                                                            </div>
                                                            <div class="special_del_options del_optns">
                                                                <div class="custom-control custom-radio">
                                                                   <input type="radio" checked="" class="custom-control-input packing_chck build_label del_fee_rad" id="sd_box1" name="special_delivery_condition_type" value="free_delivery">
                                                                   <label class="custom-control-label build_label" for="sd_box1">Free Delivery</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                   <input type="radio" class="custom-control-input packing_chck build_label del_fee_rad" id="sd_box2" name="special_delivery_condition_type" value="no_delivery">
                                                                   <label class="custom-control-label build_label" for="sd_box2">No Delivery</label>
                                                                </div>
                                                                <div class="custom-control custom-radio fees_suboptions">
                                                                   <input type="radio" class="custom-control-input packing_chck build_label del_fee_rad delv_fee_inpt_rad" id="sd_box3" name="special_delivery_condition_type" value="according_to_order_amount">
                                                                   <label class="custom-control-label build_label" for="sd_box3">Delivery Fees (According to amount of order):</label>
                                                                </div>
                                                                <p class="text-right"><a href="javascript:;" class="sd_add"> <i class="fa fa-plus"></i> Add More</a></p>
                                                                <div class="delvry_fee_options del_fee_range">
                                                                    <div class="delivery_wrap_option">
                                                                        <div class="row" part="0">
                                                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="fromDelv0" name="according_to_order_amount_div[0][from_price]" class="form-control delvFeeInpt" rel="from_price" placeholder="From(SR)">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <input type="text" id="toDelv0" name="according_to_order_amount_div[0][to_price]" class="form-control delvFeeInpt" rel="to_price" placeholder="To(SR)">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <select class="form-control ordr_amt_del_type delvFeeDrpd" name="according_to_order_amount_div[0][delivery_type]" rel="delivery_type">
                                                                                        <option value="not_available">Not Available</option>
                                                                                        <option value="free">Free</option>
                                                                                        <option selected="" value="payable">Payable</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                                                <div class="form-group del_amt_div">
                                                                                    <input type="text" id="amtDelv0" name="according_to_order_amount_div[0][amount]" class="form-control delvFeeAmt" placeholder="Enter Amount(SR)">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                            <div class="btn_right text-right">
                                                                <button class="btn btn_theme product-submit-btn" type="button"><span>Submit</span></button>
                                                            </div>
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
</section>
<!-- ///////////Predefined product modal start/////// -->
<div class="modal" id="predefineProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Select From Predefined Product</h4>
                <button type="button" class="close specification-close" data-dismiss="modal">&times;</button>
            </div>
              <!-- Modal body -->
            <div class="modal-body">
                <div class="add_form">
                    <form id="predefineProductForm">
                        <div class="form-group">
                            <label>Product</label>
                            <!-- <input type="text" name="title" value="" class="form-control title-class"> -->
                            <select class="form-control" name="product_id">
                                <option>Product One</option>
                                <option>Product Two</option>
                                <option>Product Three</option>
                                <option>Product Four</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn_theme add-list-btn"><span>Add Product</span></button>
            </div>
        </div>
    </div>
</div>      
<!-- ////////////////Predefined product modal end////////////// -->


@include('frontend.include.modals.addSpecification')
@include('frontend.include.modals.chooseplan')
@include('frontend.include.modals.addProductBrand')
@include('frontend.include.modals.addProductColor')
@include('frontend.include.modals.addProductCountry')
@include('frontend.include.modals.addProductGrade')
@include('frontend.include.modals.addProductSellingUnit')
@include('frontend.include.modals.addProductNewOption')
@stop
@section('script')
<!-- Deepak 05 Nov 2020 start -->
<script type="text/javascript">
    $(document).ready(function(){

    // Section 1 script start
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();            
                reader.onload = function(e) {
                    $('.user-img').attr('src', e.target.result);
                }                
                reader.readAsDataURL(input.files[0]);
            }
        }

        var fileTypes = ['jpg', 'jpeg', 'png', 'docx', 'doc', 'pdf'];
        var docImgPath = "{{asset('/public/frontend/img/document_thumbnail.png')}}";
        var pdfImgPath = "{{asset('/public/frontend/img/pdf-thumbnail.jpeg')}}";
        // alert(docImgPath);
        function readURL(input) {
            if (input.files && input.files[0]) {
                var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                    isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
                // alert(extension);
                if (isSuccess) { //yes
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        // alert('image has read completely!');
                        if (extension=='docx' || extension=='doc') {
                            $('.user-img').attr('src', docImgPath);
                        }else if(extension=='pdf') {
                            $('.user-img').attr('src', pdfImgPath);
                        }else{
                            $('.user-img').attr('src', e.target.result);
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                } else { 
                    // alert('else');
                }
            }
        }

        $("#botonAjax").change(function() {
          // readURL1(this);
          readURL(this);
        });
        $("body").on('click', '.add-list-btn', function(){
            $("#specification_form").submit();
        });

        // Add Specification Form Validation start
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
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('provider/product/add/specification')}}",
                    type: "post",
                    data: da,
                    contentType: false,
                    processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        $('.title-class').val('');
                        $('.description-class').val('');
                        $('.img_prof').children('img').attr('src',"{{defaultImagePath.'/no_image.png'}}");
                        $('.file_img').val("");
                        $('#specification').modal('hide');
                        $('.specification_example').hide();
                        $('.specification_class').html(data);
                    },
                    error:function(){
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });
        // Add Specification Form Validation end

        $(document).on('click','.delete-btn',function(e){
            e.preventDefault();
            var id =$(this).attr('del_id');
            var ths = $(this);
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
                     url: "{{ url('provider/product/delete/specification') }}" + '/' + id,
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            ths.closest('tr').remove();
                            // $(ev).closest('tr').hide();
                            // alert($('.specification_class').find('tr').length);
                            if ($('.specification_class').find('tr').length==0) {
                                $('.specification_class').html('<tr><td></td><td></td><td></td><td></td></tr>');
                            }
                            Swal.fire(
                                'Deleted!',
                                'Info section has been deleted.',
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
        });

        $("body").on('change', '.category_id_class', function(){
            categoryId = $(this).val();
            $.ajax({
                url:"{{url('provider/get/subcategory')}}",
                data:{categoryId : categoryId},
                type:'POST',
                success:function(data) {
                    $('.sub_category_class').html(data.view1);
                    $('.typ_of_material_class').html(data.view2);
                }
            });
        });

        $("body").on('change', '.sub_category_class', function(){
            categoryId = $('.category_id_class').val();
            subCategoryId = $(this).val();
            $.ajax({
                url:"{{url('provider/get/typeOfMaterial')}}",
                data:{categoryId:categoryId, subCategoryId:subCategoryId},
                type:'POST',
                success:function(data) {
                    // $('.sub_category_class').html(data.view1);
                    $('.typ_of_material_class').html(data.view2);
                }
            });
        });

        // Add Product Form Validation start
        $('#add-product-form').validate({
            ignore:[],
            rules:{
                "item_bar_code" : {
                    required : true,
                     number:true,                 
                },
                "item_name" : {                  
                    required: {
                        depends: function(element){ 
                            if ($('.item_box_english').hasClass('btn_bg')) {
                                  return true;
                            } else {
                                  return false;                                    
                            }
                        }
                    },
                },
                "item_name_arabic" : {                     
                    required: {
                        depends: function(element){                         
                            if ($('.item_box_arabic').hasClass('btn_bg')) {
                                return true;
                            } else {
                                return false;                                    
                            }
                        }
                    },
                }, 
                "category_id[]":{
                    required:true,    
                },
                "sub_category_id[]" :{
                    required:true,
                },             
                               
                // "related_links" : {
                //     required : true,
                // },
                "description_en" : {
                    required: {
                        depends: function(element){                           
                            if ($('.item_description_box_english').hasClass('btn_bg')) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                },
                "description_ar" : {
                    required: {
                       depends: function(element){
                        if ($('.item_description_box_arabic').hasClass('btn_bg')) {
                                   return true;
                           } else {
                                
                                   return false;
                           }
                       }
                    },
                },
                // "Keywords" : {
                //     required : true,
                // },
                // "ribbon" : {
                //     required : true,
                // },
                // "product_brand_id" : {
                //     required:true,
                // },
                // "product_color_id" : {
                //     required:true,
                // },
                // "country_id" : {
                //     required:true,
                // },
                // "product_grade_id" : {
                //     required : true,
                // },


                // "hight_number" : {
                //     required : true,
                //     number:true,
                // },

                // "hight_unit" : {
                //     required : true,
                // },

                // "criteria_name" : {
                //     required : true,
                // },
                // "criteria_unit" : {
                //     required : true,
                // },
                "from_price[]" : {
                    required:true,
                    number:true,
                },
                "to_price[]" : {
                    required:true,
                    number:true,

                },
                // "selected_plan_id[]":{
                //       required : true,
                //  },  
                
                "seller_item_code" : {
                    required : true,                
                },
                "price_per_unit" :{
                    required:true,
                    number:true,
                },
                "image" :{
                    required:true,
                    extension: "jpeg|jpg|png|bmp",
                },
                
                
                "each_content_unit" : {
                    required:true,
                    // minlength : 20,
                },
                // "content_number" : {
                //     required:true,
                //     // minlength : 20,
                // },
                // "content_unit" : {
                //     required:true,
                //     // minlength : 20,
                // },
                "minimum_buying_quantity_number" : {
                    required:true,
                    // minlength : 20,
                    // max: {
                    //     depends: function(element) {
                    //         if ($('.available_quantity_count').val()) {
                    //             // return $('.available_quantity_count').val();
                    //             return 5;
                    //         }
                    //     }
                    // }
                    // max:$('.available_quantity_count').val()
                    number:true
                },
                // "minimum_buying_quality_unit" : {
                //     required:true,
                // },   
                "selling_unit_id" : {
                    required:true,
                },
                "diameter_number" : {
                    // required:true,
                    number:true,
                },
               // "diameter_unit_id" : {
               //      required:true,
               //  },
               "length_number" : {
                    // required:true,
                    number:true,
                },
               // "length_unit_id" : {
               //      required:true,
               // },
               "width_number" : {
                    // required:true,
                    number:true,
               },
               // "width_unit_id" : {
               //      required:true,
               // },
               "depth_number" : {
                    // required:true,
                    number:true,
               },
               // "depth_unit_id" : {
               //      required:true,
               // },
               "thickness_number" : {
                    // required:true,
                    number:true,
               },
               // "thickness_unit_id" : {
               //      required:true,
               // },
               "particle_number" : {
                    // required:true,
                    number:true,
               },
               // "particle_unit_id" : {
               //      required:true,
               // },   
                "available_quantity_number" : {
                    required:true,
                    number:true,
                },   
               // "available_quantity_unit" : {
               //      required:true,
               // },   
               // "available_quantity_content_number" : {
               //      required:true,
               //       number:true,
               // },   
               // "available_quantity_content_unit" : {
               //      required:true,
               // },  
               "from_number[]" : {
                    required:true,
                     number:true,
               },
                "to_number[]" : {
                    required:true,
                     number:true,
               },
                "selling_unit_price[]" : {
                    required:true,
                     number:true,
               },
                "unit_price[]" : {
                    required:true,
               },

               "price_firsrt_append_div[selling_unit_price]" : {
                    required:true,
                     number:true,
               },
               // "price_firsrt_append_div[discount]" : {
               //      required:true,
               //       number:true,
               // },

               // "price_firsrt_append_div[final_price]" : {
               //      required:true,
               //       number:true,
               // },

               // "price_firsrt_append_div[unit_price]" : {
               //      required:true,
               //       number:true,
               // },

               "user_store_location_id" : {
                    required:true,
                    // minlength : 20,
               },
               "provider_delivery_option_id" : {
                    required:true,
                    // minlength : 20,
               }
            },
            messages:{
                "item_bar_code": {
                    required: "Please enter product bar code",
                },
                "item_name": {
                    required: "Please enter product name",
                },
                "item_name_arabic": {
                     required: "Please enter product name in arabic",
                },
                "category_id[]":{
                    required:"Please select category",
                },
                "from_price[]":{
                    required:"Please enter from price",
                },
                "to_price[]":{
                    required:"Please enter to price",
                },
                "selected_plan_id[]":{
                    required:"Please select plan",
                },
                "sub_category_id[]": {
                    required: "Please select sub category",
                },
                
                "related_links": {
                     required: "Please enter related links",
                },
                "Keywords": {
                     required: "Please enter Keywords",
                },
                "ribbon": {
                     required: "Please enter ribbon",
                },
                "product_grade_id": {
                     required: "Please enter grade",
                },
                // "hight_number": {
                //      required: "Please enter hight",
                // },
                // "hight_unit": {
                //      required: "Please select hight unit",
                // },
                // "criteria_name": {
                //      required: "Please enter criteria name",
                // },
                // "criteria_unit": {
                //      required: "Please enter select unit",
                // },
                "seller_item_code": {
                    required: "Please enter product seller code",
                },
                
                "price_per_unit": {
                    required: "Please enter price per unit",
                },
                "image": {
                    required: "Please select sub category",
                    extension: "Only jpeg, jpg, bmp and png extensions are allowed",
                },
                "description_en" :{
                    required : "Please enter product description",
                },
                "description_ar" :{
                    required : "Please enter product description in arabic",
                },
                "product_color_id": {
                    required: "Please select item color",
                },
                "country_id": {
                    required: "Please select item origin",
                },
                "each_content_unit": {
                    required: "Please select each content unit",
                },
                "content_number": {
                    required: "Please select content number",
                },
                "content_unit": {
                    required: "Please select content unit",
                }, 
                "minimum_buying_quantity_number": {
                    required: "Please enter minimum buying quantity number",
                    max: "Please enter a value less than quantity in stock"
                },
                "minimum_buying_quality_unit": {
                    required: "Please select minimum buying quantity unit",
                },
                "selling_unit_id": {
                    required: "Please select unit",
                },
               //  "diameter_number": {
               //      required: "Please enter diameter",
               //  },
               //  "diameter_unit": {
               //      required: "Please select diameter unit",
               //  },
               //  "length_number": {
               //      required: "Please enter length",
               //  },
               //  "length_unit": {
               //      required: "Please select length unit",
               //  },
               // "width_number": {
               //      required: "Please enter width",
               //  },
               // "width_unit": {
               //      required: "Please select width unit",
               //  },
               // "depth_number": {
               //      required: "Please enter depth",
               //  },
               // "depth_unit": {
               //      required: "Please select depth unit",
               //  },
               // "thickness_number": {
               //      required: "Please enter thickness",
               //  },
               // "thickness_unit": {
               //      required: "Please select thickness unit",
               //  },
               // "particle_number": {
               //      required: "Please enter particle",
               //  },
               // "particle_unit": {
               //      required: "Please select particle unit",
               //  }, 
                "available_quantity_number": {
                    required: "Please enter available quantity number",
                },
                "available_quantity_unit": {
                    required: "Please select available quantity unit",
                },
                "available_quantity_content_number": {
                    required: "Please enter available quantity content number",
                },
                "available_quantity_content_unit": {
                    required: "Please select available quantity content unit",
                }, 
                "from_number[]": {
                    required: "Please select from Number",
                }, 
                "to_number[]": {
                    required: "Please select from Number",
                },
                "selling_unit_price[]": {
                    required: "Please select unit price",
                }, 
                "unit_price[]": {
                    required: "Please select unit price",
                }, 
                "product_brand_id": {
                    required: "Please select brand"
                }, 


                "price_firsrt_append_div[selling_unit_price]": {
                    required: "Please enter price"
                }, 
         

                // "price_firsrt_append_div[selling_unit_price]" : {
                //      required:true,
                //       number:true,
                // },
                // "price_firsrt_append_div[discount]" : {
                //      required:true,
                //       number:true,
                // },

                // "price_firsrt_append_div[final_price]" : {
                //      required:true,
                //       number:true,
                // },

                // "price_firsrt_append_div[unit_price]" : {
                //      required:true,
                //       number:true,
                // },

                "user_store_location_id": {
                    required: "Please select store"
                }, 
                "provider_delivery_option_id": {
                    required: "Please select delivery option"
                }
            },
            submitHandler:function(form){
                form.submit();
            }


        });
        // Add Product Form Validation end

        // show English Arabic start         
        $("body").on('click','.btn_inpt',function(){
                $(this).removeClass('btn_gray').addClass('btn_bg');
                $(this).siblings().removeClass('btn_bg').addClass('btn_gray');
                // alert($(this).closest('.row').next().attr('name'));
            if ($(this).hasClass('item_box_english')) {
                $(this).closest('.row').next().attr('name','item_name');
                $(this).closest('.row').next().attr('placeholder','Enter Product Name');
            }else{
                $(this).closest('.row').next().attr('name','item_name_arabic');
                $(this).closest('.row').next().attr('placeholder','أدخل اسم المنتج');
            }
        });

        $('.item_description_english').show();
        $('.item_description_arabic').hide();

        $("body").on('click','.inpt_desp',function(){
                $(this).removeClass('btn_gray').addClass('btn_bg');
                $(this).siblings().removeClass('btn_bg').addClass('btn_gray');
            if ($(this).hasClass('item_description_box_english')) {
                $(this).closest('.row').next().find('.hidden_desc_cls').attr('name','description_en');
            }else{
                $(this).closest('.row').next().find('.hidden_desc_cls').attr('name','description_ar');
            }
                // alert($(this).closest('.row').next().find('.hidden_desc_cls').attr('name'));
        });
        // show English Arabic end 
    // Section 1 script end

    // Section 2 script start
        // Add New Product Brand start
        $("body").on('click','.add_new_brnd',function(){
            $("#addProductBrandModal").modal('show');
        });
        $('#addProductBrandForm').validate({
            ignore:[],
            rules:{
                "brand_name":{
                    // required:{
                    //     depends:function(){
                    //         $(this).val($.trim($(this).val()));
                    //         return true;
                    //     }
                    // }, 
                    required:true,
                    remote:"{{url('provider/product/add/productBrand/validate')}}",   
                },
            },
            messages:{
                "brand_name":{
                    required:"Please enter brand name",
                    remote:"Brand name already exists"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('provider/product/add/productBrand')}}",
                    type: "post",
                    data: $(form).serialize(),
                    // data: da,
                    // contentType: false,
                    // processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        if (data.status=='success') {
                            $('.prod_brnd_cls').append(data.html);
                            $("#addProductBrandForm")[0].reset();
                            $("#addProductBrandModal").modal('hide');
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });
        // Add New Product Brand end

        // Add New Product Color start
        $("body").on('click','.add_new_clr',function(){
            $("#addProductColorModal").modal('show');
        });
        $('#addProductColorForm').validate({
            ignore:[],
            rules:{
                "name":{
                    // required:{
                    //     depends:function(){
                    //         $(this).val($.trim($(this).val()));
                    //         return true;
                    //     }
                    // }, 
                    required:true,
                    remote:"{{url('provider/product/add/productColor/validate')}}",   
                },
            },
            messages:{
                "name":{
                    required:"Please enter color name",
                    remote:"Color name already exists"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('provider/product/add/productColor')}}",
                    type: "post",
                    data: $(form).serialize(),
                    // data: da,
                    // contentType: false,
                    // processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        if (data.status=='success') {
                            $('.prod_clr_cls').append(data.html);
                            $("#addProductColorForm")[0].reset();
                            $("#addProductColorModal").modal('hide');
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });
        // Add New Product Color end

        // Add New Product Country start
        $("body").on('click','.add_new_cntry',function(){
            $("#addProductCountryModal").modal('show');
        });
        $('#addProductCountryForm').validate({
            ignore:[],
            rules:{
                "name":{
                    // required:{
                    //     depends:function(){
                    //         $(this).val($.trim($(this).val()));
                    //         return true;
                    //     }
                    // }, 
                    required:true,
                    remote:"{{url('provider/product/add/productCountry/validate')}}",   
                },
            },
            messages:{
                "name":{
                    required:"Please enter country name",
                    remote:"Country name already exists"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('provider/product/add/productCountry')}}",
                    type: "post",
                    data: $(form).serialize(),
                    // data: da,
                    // contentType: false,
                    // processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        if (data.status=='success') {
                            $('.prod_cntry_cls').append(data.html);
                            $("#addProductCountryForm")[0].reset();
                            $("#addProductCountryModal").modal('hide');
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });
        // Add New Product Country end

        // Add New Product Grade start
        $("body").on('click','.add_new_grd',function(){
            $("#addProductGradeModal").modal('show');
        });
        $('#addProductGradeForm').validate({
            ignore:[],
            rules:{
                "grade_name":{
                    // required:{
                    //     depends:function(){
                    //         $(this).val($.trim($(this).val()));
                    //         return true;
                    //     }
                    // }, 
                    required:true,
                    remote:"{{url('provider/product/add/productGrade/validate')}}",   
                },
            },
            messages:{
                "grade_name":{
                    required:"Please enter grade name",
                    remote:"Grade name already exists",
                },
            },
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('provider/product/add/productGrade')}}",
                    type: "post",
                    data: $(form).serialize(),
                    // data: da,
                    // contentType: false,
                    // processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        if (data.status=='success') {
                            $('.prod_grd_cls').append(data.html);
                            $("#addProductGradeForm")[0].reset();
                            $("#addProductGradeModal").modal('hide');
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });
        // Add New Product Grade end

        // Add New Product Selling Unit start
        $("body").on('click','.add_new_sel_unt',function(){
            $("#addProductSellingUnitModal").modal('show');
        });
        $('#addProductSellingUnitForm').validate({
            ignore:[],
            rules:{
                "name":{
                    // required:{
                    //     depends:function(){
                    //         $(this).val($.trim($(this).val()));
                    //         return true;
                    //     }
                    // },
                    required:true,
                    remote:"{{url('provider/product/add/productSellingUnit/validate')}}",     
                },
            },
            messages:{
                "name":{
                    required:"Please enter unit name",
                    remote:"Unit name already exists",
                },
            },
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('provider/product/add/productSellingUnit')}}",
                    type: "post",
                    data: $(form).serialize(),
                    // data: da,
                    // contentType: false,
                    // processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        if (data.status=='success') {
                            $('.prod_sel_unt_cls').append(data.html);
                            $("#addProductSellingUnitForm")[0].reset();
                            $("#addProductSellingUnitModal").modal('hide');
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });
        // Add New Product Selling Unit end

        // Add New Product Selling Unit start
        $("body").on('click','.add_new_optn',function(){
            $("#addProductNewOptionModal").modal('show');
        });
        $('#addProductNewOptionForm').validate({
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
                "value":{
                    required:{
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },    
                },
                "option_type":{
                    required:true
                }
            },
            messages:{
                "title":{
                    required:"Please enter title",
                },
                "value":{
                    required:"Please enter value",
                },
                "option_type":{
                    required:"Please select option type",
                },
            },
            submitHandler: function(form) {
                // alert('here');
                $('.new_option_length_cls').val($('.nw_opt_div').length);
                var da=new FormData($(form)[0]);
                $('.loader').show();
                // alert($('.nw_opt_div').length);
                $.ajax({
                    url:"{{url('provider/product/add/productNewOption')}}",
                    type: "post",
                    data: $(form).serialize(),
                    // data: da,
                    // contentType: false,
                    // processData: false, 
                    success:function(data){
                        $('.loader').hide();
                        if (data.status=='success') {
                            $('.new_opt_cls').append(data.view);
                            $("#addProductNewOptionForm")[0].reset();
                            $("#addProductNewOptionModal").modal('hide');
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        swal('Oops, Something went wrong');
                    }
                });
                return false;
            },
        });
        // Add New Product Selling Unit end

        $("body").on('click','.rem_optn',function(){
            $(this).closest('.nw_opt_div').remove();
        });
    // Section 2 script end

    // Section 3 script start
        $("body").on('click','.packing_chck',function(){            
            if ($(this).prop("checked")==true) {
                $('.pack_info').show();
                $('.com_red').show();
                $(".qtty_stock_cntnt_div").show();
                $(".qtty_stock_div").removeClass("col-12").addClass("col-6");
            }else{              
                $('.pack_info').hide();
                $('.com_red').hide();
                $(".qtty_stock_cntnt_div").hide();
                $(".qtty_stock_div").removeClass("col-6").addClass("col-12");
            }
        });

        // $(".qtty_stock_cntnt_div").hide();
        // $(".qtty_stock_div").removeClass("col-6").addClass("col-12");
        $("body").on('change','.selling_unit_item', function() {
            var sellingUnit = $(".selling_unit_item option:selected").text();
            var sellingId =$(this).val();
            $('.fromUnit').val(sellingUnit);
            $('.fromUnitTxt').text(sellingUnit);
            $('.toUnit').val(sellingUnit);
            $('.fromUnitId').val(sellingId);
            $('.toUnitId').val(sellingId);
            $.ajax({
                url: "{{url('provider/product/selling_unit/add')}}",
                type:'post',
                data: {'sellingId': sellingId},
                success:function(response){
                    // if (response.sellingUnitCount==0) {
                    //     $(".qtty_stock_cntnt_div").hide();
                    //     $(".qtty_stock_div").removeClass("col-6").addClass("col-12");
                    //     $('.renderUnit').html(response.view);                        
                    // }else{
                    //     $(".qtty_stock_cntnt_div").show();
                    //     $(".qtty_stock_div").removeClass("col-12").addClass("col-6");
                    //     $('.renderUnit').html(response.view);                        
                    // }
                    $('.renderUnit').html(response.view);                        

                },error(){
                    toastr.error('Something went wrong');
                }
            })
        });

        $("body").on('click', '.add_pack', function(){
            var lengt = $('.pack_info').length;
            // alert(lengt);
            var lastSelOptn    = $('.pack_info').last().find('.content_unit option:selected').text();
            var lastSelOptnVal = $('.pack_info').last().find('.content_unit option:selected').val();
            var contentnumbers = $('.pack_info').last().find('.content_number').val();  
            var ids=[];
            var packing_unit_Id =$('.content_unit').val();
            var sellingId =$('.selling_unit_item').val();

            if($('.packing_chck').prop("checked")==false){
                swal('Please enable product packed in different shapes');
            }else if (contentnumbers!="" && contentnumbers!=null && lastSelOptnVal!="" && lastSelOptnVal!=null) {
                var selected = [];
                $('.content_unit  option:selected').each(function() {
                    var value = $(this).val();
                    if(value!=''){
                        selected.push(value);
                    }
                });

                $.ajax({
                    url: "{{url('provider/product/new_packng_unit/add')}}",
                    type:'post',
                    data: {'selected': selected,'sellingId':sellingId},
                    success:function packingUnit(response){
                      
                        option_html=response.view;
                        if (response.sellingUnitCount==0) {
                            swal('Sorry, no any lower selling unit');
                        }else{
                            $('.rem_pack').hide();
                            $('.content_number').prop('readonly', true);
                            // $('.content_unit').prop('disabled', true);
                            $('.content_unit').attr("style", "pointer-events: none;");
                            $('.appendPacking').append(' <div class="pack_info"> <div class="row"> <div class="col-lg-6"> <h5 class="chart_head mb-2">Each</h5> <div class="form-group"> <input type="text"  name="packing_append_div['+lengt+'][each_content_unit]" class="form-control each_content_unit" value="'+lastSelOptn+'" readonly="" placeholder="select unit"><input type="hidden" name="packing_append_div['+lengt+'][each_content_unit_id]" value="'+lastSelOptnVal+'" /> </div></div><div class="col-lg-6"> <h5 class="chart_head mb-2">Content</h5> <div class="row"> <div class="col-lg-6"> <div class="form-group"> <input type="text" id="content_number'+lengt+'" name="packing_append_div['+lengt+'][content_number]" class="form-control content_number"> </div></div><div class="col-lg-6"> <div class="form-group"> <select class="form-control packingIdd content_unit renderUnit" id="content_unit'+lengt+'" name="packing_append_div['+lengt+'][content_unit_id]"> '+option_html+' </select> </div></div></div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="rem_pack"> <i class="fa fa-times"></i> Remove </a> </p></div>');

                            $("input[id^=content_number").each(function(){
                                $(this).rules("add", {
                                    // required: true,
                                    required: {
                                        depends: function(element) {
                                            if ($(element).closest('.pck_unit_div').find('input[type=checkbox]').is(':checked')) {
                                                return true;
                                            }else{
                                                return false;
                                            }
                                        }
                                    },
                                    number:true,
                                    messages: {
                                        required: "please enter content number",
                                    }
                                });   
                            });

                            $("input[id^=content_unit").each(function(){
                                $(this).rules("add", {
                                    required: true,
                                    messages: {
                                        required: "please select content unit",
                                    }
                                });   
                            });

                        }
                    },error(){
                       
                    }
                });
            
                 
            }else{
                swal('Please fill all the fields');
            }                       
        });

        $("input[id^=content_number").each(function(){
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element) {
                        if ($(element).closest('.pck_unit_div').find('input[type=checkbox]').is(':checked')) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                number:true,
                messages: {
                    required: "please enter content number",
                }
            });   
        });

        $("input[id^=content_unit").each(function(){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "please select content unit",
                }
            });   
        });

        $(document).on('change','.content_unit',function() {
           contentUnitId = $('option:selected', this).text();
           contentUntId = $('option:selected', this).val();
           // alert(contentUnitId);
           $('.avilable-unit').val(contentUnitId);         
           $('.avilable-unit-txt').text(contentUnitId);         
           $('.avilable-unit-id').val(contentUntId);         
        }); 

        // Availble quantity
        $(document).on('keyup','.available_quantity_count', function(){
            var availableQualityCount = $(this).val();
            // alert(availableQualityCount);
            var content_number  = $('.content_number').val();
            // var contentNumber22 = $('.pack_info').last().find('.content_number').val();
            var inputs = $('.content_number');
            var allproduct = 1;
            for(var i = 0; i < inputs.length; i++){
                var allvaluesum = $(inputs[i]).val();
                if (allvaluesum) {
                    allproduct = allproduct * allvaluesum;
                }
            }
            // alert(allproduct);
            var unitPrice  = Math.round(availableQualityCount*allproduct);
            $('.available-price').val(unitPrice);
            var contntUnit = $('.content_unit').find('option:selected').attr('contentUni');
        }); 

        $(document).on('click', '.rem_pack', function(){
            $(this).parents('.pack_info').remove();
            var lengt = $('.pack_info').length;
            // alert(lengt);
            if (lengt>1) {
                $('.pack_info').last().find('.rem_pack').show();
            }
            // $('.pack_info').last().find('.content_unit').prop('disabled', false);
            $('.pack_info').last().find('.content_number').prop('readonly', false);
            $('.pack_info').last().find('.content_unit').attr("style", "pointer-events: auto;");
        });

        $("body").on('keyup','.sellingUnitPrice', function(){
            var sellingUnitPrice  = $(this).val();
            var discount = $(this).closest('.row').find('.discount_amt').val();
            var inputs = $('.content_number');
            var allproduct = 1;
            for(var i = 0; i < inputs.length; i++){
                var allvaluesum = $(inputs[i]).val();
                allproduct = allproduct * allvaluesum;
            }
            // alert(allproduct);
            // alert(discount);
            if (discount!="" && discount!=null) {
                var amtType  = $(this).closest('.row').find('.discount_amt').siblings().find('.active').attr('type');                
                var finalPrice;
                // if (sellingUnitPrice<discount) {
                //     swal('Selling Unit Price should not be less than Discount'); 
                //     $(this).val("");  
                // }else{
                    if (amtType=="percent") {
                        finalPrice = sellingUnitPrice-(sellingUnitPrice*discount/100);
                    }else{
                        finalPrice = sellingUnitPrice-discount;
                    }
                    var content_number    = $('.available-price').val();
                    var unitPrice =finalPrice/allproduct;
                    $(this).closest('.row').find('.final_price').val(finalPrice);
                    $(this).closest('.row').find('.unit_price').val(unitPrice.toFixed(2)); 
                // }
                
            }else{
                var content_number    = $('.available-price').val();
                var unitPrice =sellingUnitPrice/allproduct;
                $(this).closest('.row').find('.final_price').val(sellingUnitPrice);
                $(this).closest('.row').find('.unit_price').val(unitPrice.toFixed(2));                             
            }
            // var content_number    = $('.content_number').val();
            // var unitPrice         = Math.round(sellingunitprice/content_number);
        });
        // Section 3 script end

        // Section 4 script start
        $('.any_qtty').on('click',function(){
            $(".main_div").remove();
            $(".add_more").hide();
            $(".any_qtty_div").show();

            $.ajax({
                url: "{{url('provider/product/termOfPayment/remove')}}",
                type:'post',
                success:function(response){
                    // $('.packingIdd').html(response);

                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });
        
        $(".any_qtty_div").hide();
        $('.ordrd_qtty').on('click',function(){
            $(".add_more").show();
            $(".add_more").trigger('click');
            $(".any_qtty_div").hide();
        });

        $("body").on('click', '.remove_apnd', function(){
            $(this).parents('.main_div').remove();
            var lengt = $('.main_div').length;
            // alert(lengt);
            if (lengt>1) {
                $('.main_div').last().find('.remove_apnd').show();
            }
            // $('.pack_info').last().find('.content_unit').prop('disabled', false);
            $('.main_div').last().find('.more_prc_inpt').prop('readonly', false);
            // $('.main_div').last().find('.content_unit').attr("style", "pointer-events: auto;");
        });

        $("input[id^=fromNumber_").each(function(){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Please enter from number",
                } 
            });   
        });

        $("input[id^=toNumber_").each(function(){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Please enter from number",
                } 
            });   
        });

        $("input[id^=sellingUnitPrice_").each(function(){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Please enter price",
                } 
            });   
        });

        $("body").on('click', '.add_more', function(){
            var len = $('.main_div').length;
            // alert(len);
            // $('.apnnd_div').append('<div class="price_wrap main_div mb-2"> <div class="row" part="'+len+'"> <div class="col-lg-3"> <h5 class="chart_head mb-2">From</h5> <div class="form-group"> <input type="text" id="fromNumber_'+len+'" name="price_firsrt_append_div['+len+'][from_number]" class="form-control choosePriceInpt" rel="from_number" value=""> </div></div><div class="col-lg-3"> <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> <div class="form-group"> <input type="text" name="price_firsrt_append_div['+len+'][from_unit]" value="" class="form-control fromUnit" readonly="" placeholder="select unit"><input type="hidden" name="price_firsrt_append_div['+len+'][from_unit_id]" class="fromUnitId" value="" /> </div></div><div class="col-lg-3"> <h5 class="chart_head mb-2">To</h5> <div class="form-group"> <input type="text" id="toNumber_'+len+'" name="price_firsrt_append_div['+len+'][to_number]" class="form-control choosePriceInpt" rel="to_number" value=""> </div></div><div class="col-lg-3"> <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> <div class="form-group"> <input type="text" name="price_firsrt_append_div['+len+'][to_unit]" class="form-control toUnit" readonly="" value="" placeholder="select unit" value=""><input type="hidden" name="price_firsrt_append_div['+len+'][to_unit_id]" class="fromUnitId" value="" /> </div></div></div><div class="row"> <div class="col-lg-3"> <div class="form-group"> <label>Selling Unit Price(SR)</label> <input type="text" id="sellingUnitPrice__'+len+'" name="price_firsrt_append_div['+len+'][selling_unit_price]" class="form-control sellingUnitPrice"> </div></div><div class="col-lg-3"> <div class="form-group"> <label>Discount</label> <div class="discount_wrap d-flex"> <input type="text" name="" class="discount_amt form-control"> <div class="price_percnt text-center"> <span class="disc_spv_dv active" type="percent">%</span> <span class="disc_spv_dv" type="amount">SR</span> </div></div></div></div><div class="col-lg-3"> <div class="form-group"> <label>Final Price(SR)</label> <input type="text" name="price_firsrt_append_div['+len+'][final_price]" readonly="" class="form-control final_price" id="finalPrice_'+len+'" value=""> </div></div><div class="col-lg-3"> <div class="form-group"> <label>Unit Price(SR)</label> <input type="text" name="price_firsrt_append_div['+len+'][unit_price]" readonly="" class="form-control unit_price"> </div></div></div> <p class="text-right mb-0"> <a href="javascript:;" class="remove_apnd"> <i class="fa fa-times"></i> Remove </a> </p> </div>')
            $('.remove_apnd').hide();
            $('.more_prc_inpt').prop('readonly', true);
            $('.apnnd_div').append('<div class="price_wrap main_div mb-2"> <div class="row" part="'+len+'"> <div class="col-lg-3"> <label class="chart_head mb-2">From</label> <div class="form-group"> <input type="text" id="fromNumber_'+len+'" name="price_firsrt_append_div['+len+'][from_number]" class="form-control choosePriceInpt more_prc_inpt" rel="from_number" value=""> </div></div><div class="col-lg-3"> <label class="chart_head mb-2" style="opacity: 0;">To</label> <div class="form-group"> <input type="text" name="price_firsrt_append_div['+len+'][from_unit]" value="" class="form-control fromUnit" readonly="" placeholder="select unit"><input type="hidden" name="price_firsrt_append_div['+len+'][from_unit_id]" class="fromUnitId" value="" /> </div></div><div class="col-lg-3"> <label class="chart_head mb-2">To</label> <div class="form-group"> <input type="text" id="toNumber_'+len+'" name="price_firsrt_append_div['+len+'][to_number]" class="form-control choosePriceInpt more_prc_inpt" rel="to_number" value=""> </div></div><div class="col-lg-3"> <label class="chart_head mb-2" style="opacity: 0;">To</label> <div class="form-group"> <input type="text" name="price_firsrt_append_div['+len+'][to_unit]" class="form-control toUnit" readonly="" value="" placeholder="select unit" value=""><input type="hidden" name="price_firsrt_append_div['+len+'][to_unit_id]" class="toUnitId" value="" /> </div></div></div><div class="row"> <div class="col-lg-3"> <div class="form-group"> <label>Price</label> <div class="sell_unit_price d-flex"> <input type="text" id="sellingUnitPrice__'+len+'" name="price_firsrt_append_div['+len+'][selling_unit_price]" class="form-control sellingUnitPrice more_prc_inpt"> <div class="sell_fprice text-center"> <span class="" type="amount">SR/<span class="fromUnitTxt">Unit</span></span> </div></div><label class="error" for="sellingUnitPrice__'+len+'"></label> </div></div><div class="col-lg-3"> <div class="form-group"> <label>Discount</label> <div class="discount_wrap d-flex"> <input type="text" name="price_firsrt_append_div['+len+'][discount]" class="discount_amt form-control more_prc_inpt"><input type="hidden" class="disc_typ_cls" name="price_firsrt_append_div['+len+'][discount_type]" value="percent" /> <div class="price_percnt text-center"> <span class="disc_spv_dv active" type="percent">%</span> <span class="disc_spv_dv" type="amount">SR</span> </div></div></div></div><div class="col-lg-3"> <div class="form-group"> <label>Price After Discount</label> <div class="sell_unit_price d-flex"> <input type="text" name="price_firsrt_append_div['+len+'][final_price]" readonly="" class="form-control final_price" value=""> <div class="sell_fprice text-center"> <span class="" type="amount">SR/<span class="fromUnitTxt">Unit</span></span> </div></div></div></div><div class="col-lg-3"> <div class="form-group"> <label>Unit Price</label> <div class="sell_unit_price d-flex"> <input type="text" name="price_firsrt_append_div['+len+'][unit_price]" readonly="" class="form-control unit_price"> <div class="sell_fprice text-center"> <span class="" type="amount">SR/<span class="avilable-unit-txt">Unit</span></span> </div></div></div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="remove_apnd"> <i class="fa fa-times"></i> Remove </a> </p></div>');

            if (len==0) {
                $('.remove_apnd').hide();
            }
       
            // var sellingUnit = $('.selling_unit_item').find('option:selected').attr('sellingUnits');
            var sellingUnit = $(".selling_unit_item option:selected").text();
            var sellingUnitId = $(".selling_unit_item option:selected").val();
            var leastUnit = $(".avilable-unit").val();
            $('.fromUnit').val(sellingUnit);
            $('.toUnit').val(sellingUnit);
            $('.fromUnitId').val(sellingUnitId);
            $('.toUnitId').val(sellingUnitId);
            $('.fromUnitTxt').text(sellingUnit);
            if (leastUnit) {
                $('.avilable-unit-txt').text(leastUnit);
            }else{
                $('.avilable-unit-txt').text(sellingUnit);
            }
            // alert(sellingUnit);

            // $("input[id^=finalPrice_").each(function(){
            //         $(this).rules("add", {
            //             required: true,
            //             messages: {
            //                 required: "please enter final Price",
            //             }
            //         });   
            //     });
            $("input[id^=sellingUnitPrice_").each(function(){
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Please enter price",
                    }
                });   
            });
            $("input[id^=fromNumber_").each(function(){
                var ths = $(this);
                $(this).rules("add", {
                    required: true,
                    remote: {
                        url: "{{url('/provider/product/checkPriceRange/range')}}",
                        data:{
                            range:function(){
                                return ths.val();
                            },
                            part:function(){
                                return ths.closest('.row').attr('part');
                            },
                        },
                    },
                    messages: {
                        required: "Please enter from number",
                        remote: "Range already exists"
                    } 
                });   
            });
            $("input[id^=toNumber_").each(function(){
                var ths = $(this);
                $(this).rules("add", {
                    required: true,
                    remote: {
                        url: "{{url('/provider/product/checkPriceRange/range')}}",
                        data:{
                            range:function(){
                                return ths.val();
                            },
                            part:function(){
                                return ths.closest('.row').attr('part');
                            },
                        },
                    },
                    messages: {
                        required: "Please enter to number",
                        remote: "Range already exists"
                    } 
                });   
            });    
        }); 

        $("body").on('click','.disc_spv_dv',function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            $(this).parent().siblings('.disc_typ_cls').val($(this).attr('type'));
            $(this).closest(".discount_wrap").find(".discount_amt").val("");
            $(this).closest(".discount_wrap").find(".discount_amt").trigger('keyup');
        }); 

        $("body").on('keyup','.discount_amt', function(){
            var sellingUnitPrice       = $(this).closest('.row').find('.sellingUnitPrice').val();
            var amtType  = $(this).siblings().find('.active').attr('type');
            var discount = $(this).val();
            var inputs = $('.content_number');
            var allproduct = 1;
            for(var i = 0; i < inputs.length; i++){
                var allvaluesum = $(inputs[i]).val();
                allproduct = allproduct * allvaluesum;
            }
            if (sellingUnitPrice!="" && sellingUnitPrice!=null) {
                // if (discount>sellingUnitPrice && amtType=="amount") {
                //     swal('Discount should not be greater than Selling Unit Price'); 
                //     $(this).val("");                   
                // }else{
                    var finalPrice;
                    if (amtType=="percent") {
                        finalPrice = sellingUnitPrice-(sellingUnitPrice*discount/100);
                    }else{
                        finalPrice = sellingUnitPrice-discount;
                    }
                    var content_number    = $('.available-price').val();
                    var unitPrice =finalPrice/allproduct;
                    $(this).closest('.row').find('.final_price').val(finalPrice);
                    $(this).closest('.row').find('.unit_price').val(unitPrice.toFixed(2));                                                
                // }
            }
        });

        $("body").on('keyup','.choosePriceInpt',function(){
            var value = $(this).val();
            var part = $(this).closest(".row").attr('part');
            var key = $(this).attr('rel');
            $.ajax({
                url: "{{url('provider/product/priceRange/add')}}",
                type:'post',
                data: {'value': value,'part':part,'key':key},
                success:function(response){
                    // $('.packingIdd').html(response);
                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });  
        // Section 4 script end

        // Section 5 script start
        $("input[id^=toPrice").each(function(){
            var ths = $(this);
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element){ 
                        // alert(ths.closest('.row').find('.active').attr('type'));
                        if (ths.closest('.row').find('.active').attr('type')=='to') {
                              return true;
                        } else {
                              return false;                                    
                        }
                    }
                },
                number:true,
                // remote: "{{url('/provider/product/checkTermOfPayment/range')}}",
                remote: {
                    url: "{{url('/provider/product/checkTermOfPayment/range')}}",
                    data:{
                        range:function(){
                            return ths.val();
                        },
                        part:function(){
                            return ths.closest('.row').attr('part');
                        },
                    },
                },
                messages: {
                    required: "please enter to price",
                    // min: "Max quantity should be more than min quantity",
                }
            });   
        });
        $("input[id^=fromPrice").each(function(){
            var ths = $(this);
            $(this).rules("add", {
                required: true,
                number:true,
                // remote: "{{url('/provider/product/checkTermOfPayment/range')}}",
                remote: {
                    url: "{{url('/provider/product/checkTermOfPayment/range')}}",
                    data:{
                        range:function(){
                            return ths.val();
                        },
                        part:function(){
                            return ths.closest('.row').attr('part');
                        },
                    },
                },
                messages: {
                    required: "please enter from price"
                    // min: "Max quantity should be more than min quantity",
                }
            });   
        });
        $("input[id^=selectedPlanId").each(function(){
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "please select plan",
                    // min: "Max quantity should be more than min quantity",
                }
            });   
        });
        $(document).on('click', '.ad_more_plans', function(){
            var lengt = $('.plan_main_cls').length;
            $('.rem_plan_apnd').hide();      
            $('.fromPrice,.toPrice').prop('readonly', true);
            $('.choosePlanDrpd').attr("style", "pointer-events: none;");          
            $('.apnd_plans_div').append('<div class="form-group plan_main_cls"><div class="row" part="'+lengt+'"><div class="col-lg-3"><div class="form-group"> <label>From</label> <input type="text" name="plan_append_div['+lengt+'][from_price]" placeholder="Enter order amount" id="fromPrice['+lengt+']" value="" class="form-control fromPrice choosePlanInpt" rel="from_price"> </div></div><div class="col-lg-2"><div class="form-group"><label>Range</label><div class="discount_wrap"><div class="price_percnt new_range text-center"><span class="range_spv_dv active" type="to">To</span><span class="range_spv_dv" type="above">Above</span></div></div></div></div><input type="hidden" name="plan_append_div['+lengt+'][range_type]" class="range_typ_cls" value="to" /><div class="col-lg-3"><div class="form-group"> <label>To</label> <input type="text" name="plan_append_div['+lengt+'][to_price]" id="toPrice['+lengt+']" placeholder="Enter order amount" value="" class="form-control toPrice choosePlanInpt" rel="to_price"></div></div><div class="col-lg-4"><div class="form-group"> <label>Choose Plan</label> <select class="form-control choosePlanDrpd" id="selectedPlanId['+lengt+']" name="plan_append_div['+lengt+'][selected_plan_id]" rel="selected_plan_id"><option value="" selected disabled>Select Plan</option> @foreach($term_of_payment as $term)<option value="{{$term['id']}}">{{@$term['name']}}</option> @endforeach </select><label class="error" for="selectedPlanId['+lengt+']"></label></div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="rem_plan_apnd"> <i class="fa fa-times"></i> Remove</a></p></div>');
            if (lengt==0) {
                $('.rem_plan_apnd').hide();
            }
                
                $("input[id^=toPrice").each(function(){
                    var ths = $(this);
                    $(this).rules("add", {
                        // required: true,
                        required: {
                            depends: function(element){ 
                                // alert(ths.closest('.row').find('.active').attr('type'));
                                if (ths.closest('.row').find('.active').attr('type')=='to') {
                                      return true;
                                } else {
                                      return false;                                    
                                }
                            }
                        },
                        number:true,
                        // remote: "{{url('/provider/product/checkTermOfPayment/range')}}",
                        remote: {
                            url: "{{url('/provider/product/checkTermOfPayment/range')}}",
                            data:{
                                range:function(){
                                    return ths.val();
                                },
                                part:function(){
                                    return ths.closest('.row').attr('part');
                                },
                            },
                        },
                        messages: {
                            required: "please enter to price",
                            remote: "Range already exists"
                            // min: "Max quantity should be more than min quantity",
                        }
                    });   
                });
                $("input[id^=fromPrice").each(function(){
                    var ths = $(this);
                    $(this).rules("add", {
                        required: true,
                        number:true,
                        // remote: "{{url('/provider/product/checkTermOfPayment/range')}}",
                        remote: {
                            url: "{{url('/provider/product/checkTermOfPayment/range')}}",
                            data:{
                                range:function(){
                                    return ths.val();
                                },
                                part:function(){
                                    return ths.closest('.row').attr('part');
                                },
                            },
                        },
                        messages: {
                            required: "please enter from price",
                            remote: "Range already exists"
                            // min: "Max quantity should be more than min quantity",
                        }
                    });   
                });
                $("input[id^=selectedPlanId").each(function(){
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "please select plan",
                            // min: "Max quantity should be more than min quantity",
                        }
                    });   
                });
        });

        $(document).on('click', '.rem_plan_apnd', function(){
            $(this).parents('.plan_main_cls').remove();
            var lengt = $('.plan_main_cls').length;
            // alert(lengt);
            if (lengt>1) {
                $('.plan_main_cls').last().find('.rem_plan_apnd').show();
            }
            $('.plan_main_cls').last().find('.fromPrice,.toPrice').prop('readonly', false);
            $('.plan_main_cls').last().find('.choosePlanDrpd').attr("style", "pointer-events: auto;");
        });

        $("body").on('click','.range_spv_dv',function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            // alert($(this).attr('type'));
            if ($(this).attr('type')=='above') {
                $('.ad_more_plans').hide();
                $(this).closest('.row').find('.toPrice').prop('readonly', true);
                $(this).closest('.row').find('.range_typ_cls').val('above');
                $(this).closest('.plan_main_cls').nextAll('.plan_main_cls').remove();
                $('.plan_main_cls').last().find('.rem_plan_apnd').show();
            }else{
                $('.ad_more_plans').show();
                $(this).closest('.row').find('.toPrice').prop('readonly', false);
                $(this).closest('.row').find('.range_typ_cls').val('to');
                // alert('else');
            }
        });

        $('.default_trm').on('click',function(){
            $(".plan_main_cls").remove();
            $(".ad_more_plans").hide();

            $.ajax({
                url: "{{url('provider/product/termOfPayment/remove')}}",
                type:'post',
                success:function(response){
                    // $('.packingIdd').html(response);

                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });
        
        $('.slect_1').on('click',function(){
            $(".ad_more_plans").show();
            $(".ad_more_plans").trigger('click');
        });

        $("body").on('keyup','.choosePlanInpt',function(){
            var value = $(this).val();
            var part = $(this).closest(".row").attr('part');
            var key = $(this).attr('rel');
            $.ajax({
                url: "{{url('provider/product/termOfPayment/add')}}",
                type:'post',
                data: {'value': value,'part':part,'key':key},
                success:function(response){
                    // $('.packingIdd').html(response);
                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });

        $("body").on('change','.choosePlanDrpd',function(){
            var value = $(this).val();
            var part = $(this).closest(".row").attr('part');
            var key = $(this).attr('rel');
            $.ajax({
                url: "{{url('provider/product/termOfPayment/add')}}",
                type:'post',
                data: {'value': value,'part':part,'key':key},
                success:function(response){
                    // $('.packingIdd').html(response);
                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });
        // Section 5 script end

        // Section 6 script start
        $('.sd_add').hide();
        $('.del_fee_range').hide();

        $("body").on('change','.spl_del_chck',function(){
            if ($(this).is(':checked')) {
                $('.del_optns').show();
            }else{
                $('.del_optns').hide();
            }
        });

        $("body").on('change','.del_fee_rad',function(){
            // alert($(this).val());
            if ($(this).val()=='according_to_order_amount') {
                $('.sd_add').show();
                $('.del_fee_range').show();
            }else{
                $('.sd_add').hide();
                $('.del_fee_range').hide();
            }
        });

        $("body").on('change','.ordr_amt_del_type',function(){
            if ($(this).val()=='payable') {
                $(this).closest('.row').find('.del_amt_div').show();
            }else{
                $(this).closest('.row').find('.del_amt_div').hide();
            }
        });

        $("input[id^=fromDelv").each(function(){
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element) {
                        if ($('.delv_fee_inpt_rad').is(':checked')) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                number:true,
                messages: {
                    required: "Please enter From(SR)",
                } 
            });   
        });

        $("input[id^=toDelv").each(function(){
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element) {
                        if ($('.delv_fee_inpt_rad').is(':checked')) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                number:true,
                messages: {
                    required: "Please enter To(SR)",
                } 
            });   
        });

        $("input[id^=amtDelv").each(function(){
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element) {
                        if ($(element).closest('.row').find('.ordr_amt_del_type option:selected').val()=='payable' && $('.delv_fee_inpt_rad').is(':checked')) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                number:true,
                messages: {
                    required: "Please enter Amount(SR)",
                } 
            });   
        });

        $("body").on('keyup','.delvFeeInpt',function(){
            var value = $(this).val();
            var part = $(this).closest(".row").attr('part');
            var key = $(this).attr('rel');
            $.ajax({
                url: "{{url('provider/product/specialDeliveryFee/add')}}",
                type:'post',
                data: {'value': value,'part':part,'key':key},
                success:function(response){
                    // $('.packingIdd').html(response);
                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });

        $("body").on('change','.delvFeeDrpd',function(){
            var value = $(this).val();
            var part = $(this).closest(".row").attr('part');
            var key = $(this).attr('rel');
            $.ajax({
                url: "{{url('provider/product/specialDeliveryFee/add')}}",
                type:'post',
                data: {'value': value,'part':part,'key':key},
                success:function(response){
                    // $('.packingIdd').html(response);
                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });

        $("body").on('click', '.sd_add', function(){
            var lent = $('.delivery_wrap_option').length;
            // alert(lent);
            $('.sd_remove').hide();      
            $('.delvFeeInpt,.delvFeeAmt').prop('readonly', true);
            $('.delvFeeDrpd').attr("style", "pointer-events: none;"); 
            $('.del_fee_range').append('<div class="delivery_wrap_option"> <div class="row" part="'+lent+'"> <div class="col-lg-2 col-md-4 col-sm-12"> <div class="form-group"> <input type="text" id="fromDelv'+lent+'" name="according_to_order_amount_div['+lent+'][from_price]" class="form-control delvFeeInpt" rel="from_price" placeholder="From(SR)"> </div></div><div class="col-lg-2 col-md-4 col-sm-12"> <div class="form-group"> <input type="text" id="toDelv'+lent+'" name="according_to_order_amount_div['+lent+'][to_price]" class="form-control delvFeeInpt" rel="to_price" placeholder="To(SR)"> </div></div><div class="col-lg-3 col-md-4 col-sm-12"> <div class="form-group"> <select class="form-control ordr_amt_del_type delvFeeDrpd" name="according_to_order_amount_div['+lent+'][delivery_type]" rel="delivery_type"> <option value="not_available">Not Available</option> <option value="free">Free</option> <option selected="" value="payable">Payable</option> </select> </div></div><div class="col-lg-3 col-md-4 col-sm-12"> <div class="form-group del_amt_div"> <input type="text" id="amtDelv'+lent+'" name="according_to_order_amount_div['+lent+'][amount]" class="form-control delvFeeAmt" placeholder="Enter Amount(SR)"> </div></div> <div class="col-lg-2 col-md-4 col-sm-12"> <div class="remove_delivery"> <a href="javascript:;" class="sd_remove"> <i class="fa fa-times"></i> Remove </a> </div></div> </div></div>');

            $("input[id^=fromDelv").each(function(){
                var ths = $(this);
                $(this).rules("add", {
                    // required: true,
                    required: {
                        depends: function(element) {
                            if ($('.delv_fee_inpt_rad').is(':checked')) {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    number:true,
                    remote: {
                        url: "{{url('/provider/product/checkSpecialDeliveryFee/range')}}",
                        data:{
                            range:function(){
                                return ths.val();
                            },
                            part:function(){
                                return ths.closest('.row').attr('part');
                            },
                        },
                    },
                    messages: {
                        required: "Please enter From(SR)",
                        remote: "Range already exists"
                    } 
                });   
            });

            $("input[id^=toDelv").each(function(){
                var ths = $(this);
                $(this).rules("add", {
                    // required: true,
                    required: {
                        depends: function(element) {
                            if ($('.delv_fee_inpt_rad').is(':checked')) {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    number:true,
                    remote: {
                        url: "{{url('/provider/product/checkSpecialDeliveryFee/range')}}",
                        data:{
                            range:function(){
                                return ths.val();
                            },
                            part:function(){
                                return ths.closest('.row').attr('part');
                            },
                        },
                    },
                    messages: {
                        required: "Please enter To(SR)",
                        remote: "Range already exists"
                    } 
                });   
            });

            $("input[id^=amtDelv").each(function(){
                $(this).rules("add", {
                    // required: true,
                    required: {
                        depends: function(element) {
                            if ($(element).closest('.row').find('.ordr_amt_del_type option:selected').val()=='payable') {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    number:true,
                    messages: {
                        required: "Please enter Amount(SR)",
                    } 
                });   
            });

        });

        $("body").on('click', '.sd_remove', function(){
            $(this).parents('.delivery_wrap_option').remove();
            var lengt = $('.delivery_wrap_option').length;
            if (lengt>1) {
                $('.delivery_wrap_option').last().find('.sd_remove').show();
            }
            $('.delivery_wrap_option').last().find('.delvFeeInpt,.delvFeeAmt').prop('readonly', false);
            $('.delivery_wrap_option').last().find('.delvFeeDrpd').attr("style", "pointer-events: auto;");

            var part = $(this).closest(".row").attr('part');
            $.ajax({
                url: "{{url('provider/product/specialDeliveryFee/remove')}}",
                type:'post',
                data: {'part':part},
                success:function(response){
                    // $('.packingIdd').html(response);

                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        });
        // Section 6 script end   

        $(document).on('click', '.product-submit-btn', function(){
            // if($('#add-product-form').valid()){
                $('#add-product-form').submit();
            // }
        }); 

        $("body").on('click','.selct_pre_prod_cls',function(){
            $('#predefineProduct').modal('show');
        });

    });
</script>
<!-- Deepak 05 Nov 2020 end -->

<script type="text/javascript">

    $(document).ready(function(){
        // $(".content_unit").change(function packingUnit() {
        //     var sellingUnit = $('option:selected', this).text();
        //     var ids=[];
        //     var packing_unit_Id =$(this).val();
        //     var sellingId =$('.selling_unit_item').val();

        //     $.ajax({
        //         url: "{{url('provider/product/packng_unit/add')}}",
        //         type:'post',
        //         data: {'packing_unit_Id': packing_unit_Id,'sellingId':sellingId},
        //         success:function packingUnit(response){
        //             $('.packingIdd').html(response);
        //         },error(){
        //             toastr.error('Something went wrong');
        //         }
        //     })
        // });

        
    });        

</script>

<script>
    

</script>
<!-- //English Product description  -->
<script type="text/javascript" src="{{asset('public/frontend/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script>
    tinymce.init({
        selector: '.textAreaCommon',
        height: 300,
        plugins: 'searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc lists textcolor contextmenu textpattern',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | link',
        setup: function (editor) {
            editor.on('change', function (e) {
                // alert(editor.getContent());
                // alert(editor.targetElm.name);
                $('textarea[name="'+editor.targetElm.name+'"]').next('input').val($.trim(editor.getContent()));
            });
        },
    });
</script>

<!-- choose plans append div -->
<script>
    
</script>


<script type="text/javascript">

    $(document).ready(function(){

        // $(document).on('keyup','.discount_percent', function(){

        //     var discountpercent   = $(this).val();
        //     var discount_type    = $('.discount_type').val();
        
        //     if (discount_type=='percent') {
        //       // alert('percent');
        //        var content_number    = $('.available-price').val();
        //        var sellingunitprice  = $('.sellingUnitPrice').val();
        //        var discountPriceCalculation = discountpercent*sellingunitprice/100;
        //        var discount_price = $('.discount_price').val(discountPriceCalculation);
        //        var finalPriceCalculation = Math.round(sellingunitprice-discountPriceCalculation);
        //        var final_price = $('.final_price').val(finalPriceCalculation);
        //        var final_amount= $('.final_price').val();
        //        var unitPrice =final_amount/content_number;
        //        $('.unit_price').val(unitPrice);
        //     }   
        // });

        // $(document).on('keyup','.discount_price', function(){
        //     var discountprice   = $(this).val();
        //     var discount_type    = $('.discount_type').val();
      
        //     if (discount_type=='value') {
        //         // alert('value');
        //         var content_number    = $('.available-price').val();
        //         var sellingunitprice  = $('.sellingUnitPrice').val();
        //         var discountprice     = $(this).val();
        //         // var afsellingunitprice-discounttprice;
        //         var finalPriceCalculations = Math.round(sellingunitprice-discountprice);
        //         var discount_price = $('.final_price').val(finalPriceCalculations);
        //         var final_amount= $('.final_price').val();
        //         var unitPrice =final_amount/content_number;
        //         $('.unit_price').val(unitPrice);
        //     } 
        // });

        

    }); 
</script>

<!-- new price append div 07 sep -->
<script>
 ///////////without discount.///orignal price////////////
    // $(document).on('keyup','.beforeDiscountedPrice', function(){

    //     var sellingunitprice = $(this).val();
    //     var content_number = $('.content_number').val();
    //     var ths = $(this).closest('.second_price');
    //     ths.find('input.final_prc').val(sellingunitprice);
    //     var finalprice = ths.find('input.final_prc').val();
    //     var unitPrice  = Math.round(finalprice/content_number);
    //     var unit_prc =ths.find('input.unit_prc').val(unitPrice);
    //     $("input[id^=single_unit_price_").each(function(){
    //         $(this).rules("add", {
    //            required: true,
    //         });     
    //     });
    // }); 
    ////////////////////end orifnal price//////////
      
    ///////when discount type is percent//////////
    // $(document).on('keyup','.discountPercent', function(){

    //     var discountpercent = $(this).val();
    //     var ths             = $(this).closest('.second_price');  
    //     var discount_type   =  ths.find('.discount_type_append').val();
    //     if (discount_type =='percent') {
    //         var content_number    = $('.content_number').val();
    //         var sellingunitprice  = ths.find('input.beforeDiscountedPrice').val();
    //         var discountPriceCalculation = discountpercent*sellingunitprice/100;
    //         var discount_price = $('.afterDiscountPrice').val(discountPriceCalculation);
    //         var finalPriceCalculation = Math.round(sellingunitprice-discountPriceCalculation);
    //         var final_price = ths.find('input.final_prc').val(finalPriceCalculation);
    //         var final_amount= ths.find('input.final_prc').val();
    //         var unitPrice =final_amount/content_number;
    //         var unit_prc =ths.find('input.unit_prc').val(unitPrice);
    //     }            

    // }); 
    ///////end percent//////////

    ///////when discount type is price//////////
    // $(document).on('keyup','.afterDiscountPrice', function(){

    //     var discountprice   = $(this).val();
    //     var ths             = $(this).closest('.second_price');  
    //     var discount_type   =  ths.find('.discount_type_append').val();

    //     if (discount_type=='value') {
    //         var content_number    = $('.content_number').val();
    //         var sellingunitprice  = ths.find('input.beforeDiscountedPrice').val();
    //         var discountprice     = $(this).val();
    //         var finalPriceCalculations = Math.round(sellingunitprice-discountprice);
    //         var discount_price         = ths.find('input.final_prc').val(finalPriceCalculations);
    //         var final_amount           = ths.find('input.final_prc').val();
    //         var unitPrice              = final_amount/content_number;
    //         ths.find('input.unit_prc').val(unitPrice);
    //     } 
    // });
    ///////end price//////////
</script>

<script type="text/javascript">
    

    // $("body").on('click','.cp_rem',function(){
    //     $(this).siblings().children('img').attr('src',"{{defaultImagePath.'/no_image.png'}}"); 
    //     $('.cp_rem').hide();   
    //     attachLogo = ""; 
    //     $('.file_img').val("");   
    // });

    
</script>

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


<script type="text/javascript">
    var image_ids = [];
    $('#feed_post_id1').val('');
    
    var myDropzone  = $('.drop_post_').dropzone({ 
        url:"{{url('provider/product/add/productDocument')}}",
        // acceptedFiles:".doc", 
        addRemoveLinks:true,
        maxFiles: 5,
        maxFilesize:500,
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
            $('#document_ids').val(image_ids);
        },
        removedfile:function(file) {
            var file_id = file.stored_id;
                // var removename = file.name;
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{url('provider/product/delete/productDocument')}}",
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
                $('#document_ids').val(image_ids);
                file.previewElement.remove();
            }

        });
</script>

<script type="text/javascript">

$(document).ready(function(){

    // $("input[id^=finalPrice_").each(function(){
    //     $(this).rules("add", {
    //         required: true,
    //         messages: {
    //             required: "Please enter from number",
    //         } 
    //     });   
    // });

    

    

    // $("input[id^=reward_point_priority_").each(function(){
    //     $(this).rules("add", {
    //         required: {
    //             depends: function(element) {
    //                 if ($(element).closest('.main_cls').find('input[type=checkbox]').is(':checked')) {
    //                     return true;
    //                 }else{
    //                     return false;
    //                 }
    //             }
    //         },
    //         digits:true,
    //         maxlength:10,
    //     });   
    // });

    // $("input[id^=reward_point_point_").each(function(){
    //     $(this).rules("add", {
    //         required: {
    //             depends: function(element) {
    //                 if ($(element).closest('.main_cls').find('input[type=checkbox]').is(':checked')){
    //                     return true;
    //                 }else{
    //                     return false;
    //                 }
    //             }
    //         },
    //         digits:true,
    //         maxlength:10,
    //     });   
    // });

    
});

 
</script>

@stop