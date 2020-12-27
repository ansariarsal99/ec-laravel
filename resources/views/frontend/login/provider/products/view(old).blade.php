@extends('frontend.layout.providerLayout')
@section('title','View Product')
@section('content')
<style>
    .btn_bg{
        background: #cc3f2f40;
    }
    .btn_gray{
        background: #ececec;
    }
    .packing_content{
        padding: 8px 10px;
    }
    .com_red a{
        color: #cc3f2f;
        text-decoration: underline;   
    }
    .com_red a:hover{
        color: #cc3f2f;
        text-decoration: underline;   
    }

    .price_wrap {
        padding: 8px;
    }
    .price_wrap .form-control{
        height: 30px;
    }
    .price_wrap label{
        font-size: 11px;
    }
    .price_wrap select{
        height: 30px !important;
    }

</style>

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
                                            <h3>View Product</h3>
                                        </div>
                                        <div class="add_product_form view_prof_dash">
                                            <form id="add-product-form" action="{{url('provider/products/add')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-10 offset-sm-1">
                                                        <div class="itm_heading mb-2">
                                                            <h4>1-Product Information</h4>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Product Bar Code</label>
                                                            <input type="text" readonly="" name="item_bar_code" class="form-control" value="{{@$product['item_bar_code']}}" placeholder="Enter Product Bar Code">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-7">
                                                                    <label class="build_label">Product Name</label>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class="btn_right text-right mb-1">
                                                                         @if($product['item_name']!=null)
                                                                        <button class="btn btn_inpt item_box_english btn_bg" type="button"><span>English</span></button>
                                                                         @endif 
                                                                          @if($product['item_name_arabic']!=null)
                                                                        <button class="btn btn_inpt item_box_arabic" type="button"><span>عربى</span></button>
                                                                         @endif 

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($product['item_name']!=null)
                                                            <input type="text" name="item_name" readonly="" class=" form-control item_name_english" value="{{@$product['item_name']}}" placeholder="Enter Product Name">
                                                            @endif 
                                                            @if($product['item_name_arabic']!=null)
                                                            <input type="text" name="item_name_arabic" class="form-control item_name_arabic" value="{{@$product['item_name_arabic']}}" placeholder="أدخل اسم المنتج">
                                                            @endif 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Product Seller Code</label>
                                                            <input type="text" name="seller_item_code" class="form-control" readonly="" value="{{@$product['seller_item_code']}}" placeholder="Enter seller item code">
                                                        </div>
                                                        <?php
                                                            $contactName = implode(' ', array(Auth::User()->contact_name,Auth::User()->contact_last_name));
                                                        ?>
                                                        <div class="row ">
                                                            <div class="col-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <label class="build_label">Seller Membership ID</label>
                                                                    <input type="text" name="seller_membership_d" readonly="" class="form-control" value="{{Auth::User()->supplier_code}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <label class="build_label">Seller Name</label>
                                                                    <input type="text" name="seller_membership_d" readonly="" class="form-control" value="{{@$contactName}}">
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="form-group main_description_class">
                                                            <!-- <label class="build_label">Product Description</label> -->
                                                            <div class="row">
                                                                <div class="col-lg-7">
                                                                    <label class="build_label">Product Description</label>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class="btn_right text-right mb-1">
                                                                         @if($product['item_detail']!=null)
                                                                        <button class="btn inpt_desp item_description_box_english btn_bg" type="button"><span>English</span></button>
                                                                          @endif
                                                                            @if($product['item_Arabic_detail']!=null)
 
                                                                        <button class="btn inpt_desp item_description_box_arabic" type="button"><span>عربى</span></button>
                                                                          @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($product['item_detail']!=null)
                                                            <div class="item_description_english">
                                                                <textarea name="item_detail" readonly="" placeholder="english" class="form-control textAreaCommon textareaEnglish">{!!@$product['item_detail']!!}
                                                                </textarea>       
                                                            </div>
                                                            @endif
                                                            @if($product['item_Arabic_detail']!=null)
                                                            <div class="item_description_arabic">
                                                                <textarea name="item_Arabic_detail" placeholder="arabic" readonly="" class="form-control textAreaCommon textareaArabic">{!!@$product['item_Arabic_detail']!!}
                                                                </textarea>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Category</label><br>
                                                                {{$productCategoryImplode}}
                                                            <label id="category_id[]-error" class="error" for="category_id[]"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Sub Category</label><br>
                                                           {{$productSubCategoryImplode}}
                                                            <label id="sub_category_id[]-error" class="error" for="sub_category_id[]"></label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="build_label"> Product Photos </label>
                                                                    <div class="id_imgs">
                                                                        @foreach($dbProductImages as $value)
                                                                            <?php 
                                                                                if (!empty($value['name'])) {
                                                                                    $imgpath= productImgsBasePath.$value['name'];    
                                                                                }             
                                                                                if(!empty($value['name']) && file_exists($imgpath) ) { 
                                                                                    // dd($imgpath);
                                                                                    $admin_image = productImgsPath.'/'.$value['name'];    
                                                                                }else{
                                                                                    $admin_image = defaultImagePath.'/no_image.png';  
                                                                                }                                           
                                                                            ?>
                                                                            <img src="{{$admin_image}}" class="img-fluid">
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <label class="build_label">Product Documents(Technical Specification,Catalogues,Datesheet & etc..)</label>
               
                                                                <?php  
                                                                    if (!empty($value['name'])) {
                                                                      
                                                                        if (file_exists(productDocumentBasePath.'/'.$value['name'])) {
                                                                            $image = 'fa fa-file-pdf-o';
                                                                        }else{
                                                                            $image = defaultImagePath;
                                                                        }
                                                                    }else{
                                                                        $image = defaultImagePath;
                                                                    }
                                                                    ?>
                                                      
                                                                    <div class="id_imgs">
                                                              @foreach($product['product_image'] as $value)

                                                                        <a href="{{asset(productDocumentBasePath.'/'.$value['name'])}}" download>
                                                                            <p class="pdf_txt cp"><span><i class="{{$image}}"></i> Click to view</span></p>
                                                                        </a>

                                                              @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Related Links</label>
                                                            <input readonly="" type="text" name="related_links" class="form-control" value="{{@$product['related_links']}}" placeholder="Enter related links">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Keywords</label>
                                                            <input readonly="" type="text" name="Keywords" class="form-control" value="{{@$keyword}}" placeholder="Enter keywords">
                                                        </div>
                                                        <div class="itm_heading mb-2">
                                                            <h4>2-Product Features & Properties</h4>
                                                        </div>
                                                        <?php
                                                         $brandName = App\ProductBrand::where('id',$product['brand_id'])->first();
                                                         $grade     = App\ProductGrade::where('grade_name',$product['grade'])->first();
                                                         $color     = App\ProductColor::where('id',$product['item_color'])->first();
                                                         $country   = App\Country::where('id',$product['item_origin'])->first();
                                                         // dd($product['item_origin']);
                                                         ?>
                                                        <div class="form-group">
                                                            <label class="build_label"> Brand</label>
                                                             <input type="text" name="brand_id" value="{{$brandName['brand_name']}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="build_label">Color</label>
                                                            <input type="text" name="brand_id" value="{{$color['name']}}" class="form-control">
                                                        </div>
                                                       <div class="form-group">
                                                           <label class="build_label">Country of Origin</label>
                                                            <input type="text" name="brand_id" value="{{$country['name']}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="build_label">Classification / Grade</label>
                                                              <input type="text" name="grade" class="form-control" value="{{@$grade['grade_name']}}">
                                                           <!--  <input type="text" name="grades" class="form-control" value="" placeholder="Enter classification / grade"> -->
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label>Seller Item Code</label>
                                                            <input type="text" name="seller_item_code" class="form-control" value="" placeholder="Enter Seller Item Code">
                                                        </div> -->
<!--                                                          <div class="form-group">
                                                            <label>Item Description</label>
                                                            <textarea class="form-control" rows="5" placeholder="Write Item details here..." name="item_detail"></textarea>
                                                        </div> -->
                                                       <div class="items_size">
                                                          <!--  <div class="itm_heading mb-2">
                                                               <h4>Item Size</h4>
                                                           </div> -->
                                                           <div class="itms_size_quntt">
                                                               <div class="row">
                                                                   <div class="col-lg-6">
                                                                       <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Diameter</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="diameter_number" value="{{@$product['diameter_number']}}" class="form-control" placeholder="Enter Diameter">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                       @if($diameter_unit!=null)
                                                                                       {{@$diameter_unit}}
                                                                                       @endif
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
                                                                                        <!-- <label>Number</label> -->
                                                                                        <input type="text" value="{{@$product['length_number']}}" name="length_number" class="form-control" placeholder="Enter Length">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                    @if($length_unit!=null)
                                                                                      {{@$length_unit}}
                                                                                    @endif
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
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="width_number" class="form-control" value="{{@$product['width_number']}}" placeholder="Enter Width">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                      @if($width_unit!=null)                                 {{@$width_unit}}
                                                                                      @endif
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
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="depth_number" placeholder="Enter Depth" value="{{@$product['depth_number']}}" class="form-control">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                     @if($depth_unit!=null)
                                                                                        {{@$depth_unit}}
                                                                                     @endif
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
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="height_number" class="form-control"  value="{{@$product['height_number']}}" placeholder="Enter Height">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       @if($height_unit!=null)
                                                                                         {{@$height_unit}}
                                                                                       @endif
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
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="thickness_number" class="form-control" value="{{@$product['thickness_number']}}" placeholder="Enter Thickness">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                @if($thickness_unit!=null)
                                                                                    {{@$thickness_unit}}
                                                                                @endif     
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
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" readonly="" name="particle_number" placeholder="Enter Particles" value="{{@$product['particle_number']}}" class="form-control">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       @if($particle_unit!=null)
                                                                                          {{@$particle_unit}}
                                                                                       @endif
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-lg-6">
                                                                       <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Criteria Name</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input readonly="" type="text" name="criteria_name" placeholder="Add List" value="{{@$product['criteria_name']}}" class="form-control">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                     @if($criteria_unit!=null)
                                                                                       {{@$criteria_unit}}
                                                                                     @endif
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                        </div>
                                                        <div class="itm_heading mb-2">
                                                            <h4>3-Quantities / Units / Packing</h4>
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="build_label">Selling Unit</label>
                                                           <select class="form-control selling_unit_item" name="selling_unit">
                                                                <option selected disabled>Select Selling Unit</option>
                                                                @foreach($SellingUnits as $SellingUnit)
                                                                    <option sellingUnits="{{@$SellingUnit->name}}" value="{{$SellingUnit->id}}" <?php if(isset($SellingUnit)){if(@$SellingUnit['id'] == @$product['selling_unit']){ echo 'selected'; }} ?>>{{@$SellingUnit->name}}</option>
                                                                @endforeach
                                                           </select>
                                                        </div>
                                                        <div class="packing_content items_prices">
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <div class="form-group">
                                                                        <label class="build_label">Packing</label>

                                                                        <label class="build_label">In case product packed in different shapes and unit then identify below:</label>
<!--                                                                         <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheckbox_new" name="checkbox" value="normal">
                                                                            <label class="custom-control-label" for="customCheckbox_new">In case product packed in different shapes and unit then identify below:</label>
                                                                        </div> -->
                                                                    </div>
                                                                </div>                                                     
                                                            </div>
                                                            <div class="pack_inr_div appendPacking">
                                                              @foreach($product['productpacking'] as $key=>$value)
                                                                <div class="pack_info">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <h5 class="chart_head mb-2">Each</h5>
                                                                            <div class="form-group">
                                                                                <!-- <label class="build_label">Each</label> -->
                                                                                <!-- <input type="text" name="" class="form-control"> -->
                                                                               <input type="text"  name="packing_append_div[0][each_content_unit]" class="form-control fromUnit each_content_unit" value="{{$value['each_content_unit']}}" readonly="" placeholder="select unit">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <h5 class="chart_head mb-2">Content</h5>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                       <input type="text" name="packing_append_div[0][content_number]" class="form-control content_number" value="{{$value['content_number']}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control content_unit   renderUnit" name="packing_append_div[0][content_unit]" value="{{$value['content_unit']}}">
                                                                                            <option selected disabled>Select Selling Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option sellingUnits="{{@$SellingUnit->name}}" value="{{$SellingUnit->id}}" <?php if(isset($SellingUnit)){if(@$SellingUnit['id'] == @$value['content_unit']){ echo 'selected'; }} ?>>{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                       </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div><br>
                                                        <label class="build_label">Quantity in stock</label>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="size_chart">
                                                                      <label class="build_label" style="opacity: 0;">Number</label>
                                                                     <div class="row">
                                                                          <div class="col-6">
                                                                            <div class="form-group">
                                                                                <!-- <label>Number</label> -->
                                                                                <input type="text" readonly="" name="available_quantity_number" placeholder="Enter Available Quantity "value="{{$product['available_quantity_number']}}" class="form-control available_quantity_count">
                                                                            </div>
                                                                         </div>
                                                                         <div class="col-6">
                                                                            <div class="form-group">
                                                                                <!-- <label>Unit</label> -->
                                                                                  <input type="text" name="available_quantity_unit" readonly="" value="{{$product['available_quantity_unit']}}" class="form-control fromUnit" placeholder="select unit"> 
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="size_chart">
                                                                     <h5 class="chart_head mb-2">Content</h5>
                                                                     <div class="row">
                                                                         <div class="col-6">
                                                                            <div class="form-group">
                                                                                <!-- <label>Number</label> -->
                                                                                <input type="text" readonly="" name="available_quantity_content_number" class="form-control available-price" value="{{$product['available_quantity_content_number']}}" placeholder="Enter Available Quantity Content Count">
                                                                            </div>
                                                                         </div>
                                                                         <div class="col-6">
                                                                            <div class="form-group">
                                                                                <!-- <label>Unit</label> -->
                                                                                <input type="text" readonly="" name="available_quantity_content_unit" placeholder="Select Unit" class="form-control avilable-unit" value="{{$product['available_quantity_content_unit']}}">
                                                                            </div>
                                                                         </div>
                                                                     </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="items_size">   
                                                           <label class="build_label">Minimum Buying quantity</label>
                                                           <div class="size_chart">
                                                                <!-- <h5 class="chart_head mb-2">Each</h5> -->
                                                                <!-- <form> -->
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                           <div class="form-group">
                                                                               <!-- <label class="build_label" style="opacity: 0;">Number</label> -->
                                                                               <input type="text" readonly="" name="minimum_buying_quality_number" class="form-control" value="{{$product['minimum_buying_quality_number']}}">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                           <div class="form-group">
                                                                               <!-- <label class="build_label">Unit</label> -->
                                                                               <input type="text" name="minimum_buying_quality_unit" class="form-control fromUnit" readonly="" value="{{$product['minimum_buying_quality_unit']}}" placeholder="select unit">
                                                                           </div>
                                                                        </div>
                                                                    </div>
                                                               <!-- </form> -->
                                                           </div>
                                                        </div>
                                                       <!--  <div class="items_size">
                                                           <div class="itm_heading mb-2">
                                                               <h4>Content Per Unit</h4>
                                                           </div>
                                                           <div class="contt_unit">
                                                               <div class="row">
                                                                   <div class="col-lg-6">
                                                                       <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Each</h5>
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                   <div class="form-group">
                                                                                         <input type="text" name="each_content_unit" class="form-control fromUnit" readonly="" placeholder="select unit">
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-lg-6">
                                                                       <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Content</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <input type="text" name="content_number" class="form-control content_number">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                      <select class="form-control content_unit" name="content_unit">
                                                                                            <option selected disabled>Select Selling Unit</option>
                                                                                            @foreach($SellingUnits as $SellingUnit)
                                                                                                <option contentUni="{{@$SellingUnit->name}}" value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                                            @endforeach
                                                                                       </select>
                                                                                   </div>
                                                                                </div>
                                                                            </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                        </div> -->

                                                        <div class="items_size items_prices mb-3">
                                                           <div class="itm_heading mb-2">
                                                               <h4 class="build_label">4-Price</h4>
                                                           </div>
                                                          <!--  <div class="row px-1">
                                                               <div class="col-lg-8">
                                                                   <div class="custom-control custom-radio mb-3">
                                                                        <input type="radio" class="custom-control-input" id="customRadio_new18" @if($product['quantity_order']=='quantity_price') checked="" @endif  name="quantity_order" value="quantity_price">
                                                                        <label class="custom-control-label" for="customRadio_new18">Insert price accordingly to ordered quantity:</label>
                                                                    </div>
                                                               </div>
                                                           </div> -->
                                                          <div class="size_chart">
                                                                <!-- <form> -->
                                                                <div class="apnnd_div">
                                                              @if($product['quantity_order']=='quantity_price')
                                                                    <div class="price_wrap main_div">
                                     
                                                                        @foreach($product['productpricerange'] as $key=>$value1)
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-lg-3">
                                                                                    <h5 class="chart_head mb-2">From</h5>
                                                                                       <div class="form-group">
                                                                                           <!-- <label>Number</label> -->
                                                                          
                                                                                           <input type="text" name="price_firsrt_append_div[0][from_number]" class="form-control" value="{{$value1['from_number']}}">
                                                                                       </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <h5 class="chart_head mb-2" style="opacity: 0;">To</h5>
                                                                                        <div class="form-group">
                                                                                        <!-- <label>Unit Price</label> -->
                                                                                        <input type="text" name="price_firsrt_append_div[0][from_unit]" value="{{$value1['from_unit']}}" class="form-control fromUnit" readonly="" placeholder="select unit">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <h5 class="chart_head mb-2">To</h5>
                                                                                        <div class="form-group">
                                                                                           <!-- <label>Number</label> -->
                                                                                           <input type="text" name="price_firsrt_append_div[0][to_number]" class="form-control" value="{{$value1['to_number']}}">
                                                                                       </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <h5 class="chart_head mb-2" style="opacity: 0;">To</h5>
                                                                                        <div class="form-group">
                                                                                           <!-- <label>Unit</label> -->
                                                                                           <input type="text" name="price_firsrt_append_div[0][to_unit]" class="form-control toUnit" readonly=""  placeholder="select unit" value="{{$value1['to_unit']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="row">
                                                                                    <div class="col-lg-2">
                                                                                        <div class="form-group">
                                                                                           <label>Selling Unit Price(Sr)</label>
                                                                                           <input type="text" name="price_firsrt_append_div[0][selling_unit_price]" value="{{$value1['selling_unit_price']}}" class="form-control sellingUnitPrice">
                                                                                       </div>
                                                                                    </div>

                                                                                    <div class="col-lg-2">
                                                                                        <div class="form-group">
                                                                                           <label>Discount Type</label>
                                                                                           <select class="form-control discount_type" name="price_firsrt_append_div[0][discount_type]" type="text" value="">
                                                                                           <option selected disabled>Select Discount Type <body></body></option>  
                                                                                           <option value="value" @if($value1['discount_type'] == 'value') selected @endif}}>Value</option>
                                                                                           <option value="percent" @if($value1['discount_type'] == 'percent') selected @endif}}>Percent</option>
                                                                                        </select>
                                                                                       </div>
                                                                                    </div>



                                                                                    <div class="col-lg-2">                     
                                                                                        <div class="form-group">
                                                                                           <label>Discount Percent(%)</label>
                                                                                           <input type="text" id="" name="price_firsrt_append_div[0][discount_percent]" class="form-control discount_percent" value="{{$value1['discount_percent']}}">
                                                                                       </div>
                                                                                    </div>

                                                                                    <div class="col-lg-2">
                                                                                        <div class="form-group">
                                                                                            <label>Discount Price(SR)</label>
                                                                                            <input type="text" name="price_firsrt_append_div[0][]discount_price" value="{{$value1['discount_price']}}" class="form-control discount_price">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <div class="form-group">
                                                                                            <label>Final Price(SR)</label>
                                                                                            <input type="text" name="price_firsrt_append_div[0][final_price]" value="{{$value1['final_price']}}" class="form-control final_price" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <div class="form-group">
                                                                                            <label>Unit Price(SR)</label>
                                                                                            <input type="text" id="single_unit_price" value="{{$value1['unit_price']}}" name="price_firsrt_append_div[0][unit_price]" class="form-control unit_price">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @endif
                                                              @if($product['quantity_order']=='quantity_order')
                                                                <div class="insert_cus_price px-2">
                                                                    <div class="form-group">
                                                                        <!-- <div class="custom-control custom-radio mb-3">
                                                                            <input type="radio" class="custom-control-input slect_1"  @if($product['quantity_order']=='quantity_order') checked="" @endif  id="customRadio_new19" name="quantity_order" value="quantity_order">
                                                                            <label class="custom-control-label" for="customRadio_new19">Or Insert price for any quantity ordered:</label>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <input type="text" name="defualt_selling_unit_price" class="form-control" value="{{$product['defualt_selling_unit_price']}}" placeholder="Enter default selling unit price">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <input type="text" value="{{$product['defualt_unit_price']}}" name="defualt_unit_price" class="form-control" placeholder="Enter defualt unit price">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                

                                                        <input type="hidden" class="specification-count" value="{{count(@$product['product_specification'])}}">
                                                          <label class="build_label">Add Specification</label>
                                                          <div class="specification_class"></div>
                                                          <div class="sh_pric_tble specification_example">
                                                              <div class="row tab_head m-0">
                                                                  <div class="col-lg-3 br_right p-0">
                                                                      <h4>Title</h4>
                                                                  </div>
                                                                  <div class="col-lg-9 br_right p-0">
                                                                      <h4>Description</h4>
                                                                  </div>
                                                                   <!-- <div class="col-lg-3 br_right p-0">
                                                                      <h4>Action</h4>
                                                                  </div> -->
                                                              </div>
                                                              <div class="row m-0 mb-3">
                                                                  <div class="col-sm-3 inr_datat p-0 product-spec">
                                                                     
                                                                      @foreach($product['product_specification'] as $specification)
                                                                      <p class="title-class-{{$specification['id']}}">{{$specification['title']}}</p>
                                                                      @endforeach
                                                                  </div>
                                                                  <div class="col-sm-9 inr_datat p-0 product-spec">
                                                                      @foreach($product['product_specification'] as $specification)
                                                                      <p class="description-class-{{$specification['id']}}">{{$specification['description']}}</p>
                                                                      @endforeach
                                                                  </div>
                                                              </div>
                                                          </div>

                                                         <!--  <div class="btn_right text-right">
                                                              <button class="btn btn_theme" type="button" data-toggle="modal" data-target="#add_specification"><span>Add New Specification</span></button>
                                                         </div><br> -->

                                                       

                                                       <div class="items_size">
                                                          
                                                          <div class="choose_plan_terms">
                                                              <div class="itm_heading mb-2">
                                                                  <h4>Term of payment</h4>
                                                              </div>

                                                              <div class="view_trms_nw">
                                                                  <!-- <div class="ad_more d-flex justify-content-between align-items-center"> -->
                                                                      <!-- <div class="custom-control custom-radio mb-3">
                                                                          <input type="radio" class="custom-control-input slect_1" id="customRadio_new21" checked="" name="default_plan" value="normal">
                                                                          <label class="custom-control-label" for="customRadio_new21">Choose plans according to order amount:</label>
                                                                      </div> -->
                                                                     <!--  <p class="mb-0 pr-2">
                                                                          <a href="javascript:;" class="ad_more_plans">
                                                                              <i class="fa fa-plus"></i> Add more
                                                                          </a>
                                                                      </p> -->
                                                                  <!-- </div> -->
                                                                  
                                                                    
                                                                  <div class="apnd_plans_div">
                                                                  @foreach($product['notselectedplan_name'] as $key=>$value)
                                                                      <div class="form-group main_cls plan_main_cls">
                                                                          <div class="row">
                                                                              <div class="col-4">
                                                                               
                                                                                  <div class="form-group">
                                                                                      <label>From</label>
                                                                                      <input type="text" name="plan_append_div[$key][from_price]" id="from_price" value="{{$value['from_price']}}" readonly="" placeholder="SR" class="form-control fromPrice"><br />
                                                                                  </div>
                                                                              </div>
                                                                           
                                                                              <div class="col-4">
                                                                                  <div class="form-group">
                                                                                      <label>To</label>
                                                                                      <input type="text" name="plan_append_div[$key][to_price]" id="to_price" value="{{$value['to_price']}}" readonly="" class="form-control toPrice" placeholder="SR">
                                                                                  </div>
                                                                              </div>

                                                                               
                                                                                      
                                                                              <div class="col-sm-4">
                                                                                  <div class="form-group">
                                                                                      <label>Choose Plan</label>
                                                                                      <select disabled="" class="form-control" name="plan_append_div[0][selected_plan_id]">
                                                                                      <option selected disabled>Select Plan</option>
                                                                                      @foreach($term_of_payment as $term)
                                                                                          <option value="{{$term['id']}}"<?php if(isset($term)){if(@$term['id'] == $value['selected_plan_id']){ echo 'selected'; }} ?> >{{@$term['name']}}</option>
                                                                                      @endforeach
                                                                                      </select>
                                                                                 </div>
                                                                              </div>
                                                                          </div>
<!--                                                                               @if(!$key == '0')                           
                                                                                    <p class="text-right mb-0"> <a href="javascript:;" class="rem_plan_apnd"> <i class="fa fa-times"></i> Remove </a> </p>
                                                                              @endif -->

                                                                          <!-- <p class="text-right mb-0"> <a href="javascript:;" class="rem_plan_apnd"> <i class="fa fa-times"></i> Remove </a> </p> -->
                                                                      </div>
                                                                  @endforeach


                                                                  </div>
                                                                    

                                                                   @if($product['default_plan']=='default')

                                                                    <div class="custom-control custom-radio mb-3">
                                                                        
                                                                        <label>No term of payment(100% Full Payment to be paid upon checkout)</label>
                                                                    </div>
                                                                    @endif

                                                              </div> 
                                                          </div>
                                                              <!--   <div class="btn_right text-right">
                                                                    <button class="btn btn_theme product-submit-btn" type="button"><span>Submit</span></button>
                                                                </div> -->
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




     <div class="modal" id="edit_specification">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h4 class="modal-title">Edit Specification</h4>
                     <button type="button" class="close specification-close" data-dismiss="modal">&times;</button>
                 </div>
                   <!-- Modal body -->
                 <div class="modal-body">
                     <div class="add_form">
                         <form id="edit_specification_form">
                             <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" name="title" class="form-control title-class">
                             </div>
                             <input type="hidden" name="productid" value="{{$product['id']}}">
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
                     <button type="button" class="btn btn_theme edit-list-btn"><span>Save</span></button>
                 </div>
             </div>
       </div>
     </div>
    

    <div class="modal" id="add_specification">
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
                         <form id="add_specification_form">
                             <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" name="title" class="form-control title-class">
                             </div>
                             <input type="hidden" name="productid" value="{{$product['id']}}">
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

<!-- @include('frontend.include.modals.chooseplan') -->

<!-- <script src="{{asset('public/frontend/js/jquery.validate.js')}}"></script> -->



<script type="text/javascript">

    $(document).on('click', '.add_pack', function(){
        var lengt = $('.pack_info').length;
       
        var lastSelOptn   = $('.pack_info').last().find('.content_unit option:selected').text();
        var contentnumbers = $('.pack_info').last().find('.content_number').val();  
        var ids=[];
        var packing_unit_Id =$('.content_unit').val();
        var sellingId =$('.selling_unit_item').val();
       
            var selected = [];
            $('.content_unit  option:selected').each(function() {
                var value = $(this).val();
                if(value!=''){
                
                    selected.push(value);
                }
            })

      // alert(selected);

        $.ajax({
            url: "{{url('provider/product/new_packng_unit/add')}}",
            type:'post',
            data: {'selected': selected,'sellingId':sellingId},
            success:function packingUnit(response){
              
                option_html=response;
              
                $('.appendPacking').append(' <div class="pack_info"> <div class="row"> <div class="col-lg-6"> <h5 class="chart_head mb-2">Each</h5> <div class="form-group"> <input type="text"  name="packing_append_div['+lengt+'][each_content_unit]" class="form-control each_content_unit" value="'+lastSelOptn+'" readonly="" placeholder="select unit"> </div></div><div class="col-lg-6"> <h5 class="chart_head mb-2">Content</h5> <div class="row"> <div class="col-lg-6"> <div class="form-group"> <input type="text" name="packing_append_div['+lengt+'][content_number]" class="form-control content_number"> </div></div><div class="col-lg-6"> <div class="form-group"> <select class="form-control packingIdd content_unit" name="packing_append_div['+lengt+'][content_unit]"> '+option_html+' </select> </div></div></div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="rem_pack"> <i class="fa fa-times"></i> Remove </a> </p></div>');

            },error(){
               
            }
        })

        
    });

    
        $(document).on('click', '.rem_pack', function(){
            $(this).parents('.pack_info').remove();
        });


        $( ".content_unit" ).change(function packingUnit() {
            var sellingUnit = $('option:selected', this).text();
            var ids=[];
            var packing_unit_Id =$(this).val();
            var sellingId =$('.selling_unit_item').val();

            $.ajax({
                url: "{{url('provider/product/packng_unit/add')}}",
                type:'post',
                data: {'packing_unit_Id': packing_unit_Id,'sellingId':sellingId},
                success:function packingUnit(response){
                    $('.packingIdd').html(response);

                },error(){
                    toastr.error('Something went wrong');
                }
            })

        });
       

        $(document).on('change','.content_unit',function() {

           contentUnitId = $('option:selected', this).text();
           // alert(contentUnitId);
           $('.avilable-unit').val(contentUnitId);
         
        });  
         

</script>

<script>

    var english = $('.item_name_english').val();
    var arabic  = $('.item_name_arabic').val();
    if (english!='') {

           $('.item_name_english').show();
           $('.item_name_arabic').hide();
        
    }else{
        alert('else');
        $('.btn_inpt').removeClass('btn_bg').addClass('btn_gray');
        $('.btn_inpt').siblings().removeClass('btn_gray').addClass('btn_bg');
        
           $('.item_name_english').show();
           $('.item_name_arabic').hide();
    }

    
    $("body").on('click','.btn_inpt',function(){
            $(this).removeClass('btn_gray').addClass('btn_bg');
            $(this).siblings().removeClass('btn_bg').addClass('btn_gray');
        if ($(this).hasClass('item_box_english')) {
            $('.item_name_english').show();
            $('.item_name_arabic').hide();
        }else{
            $('.item_name_english').hide();
            $('.item_name_arabic').show();
        }
    });



    
    $('.item_description_english').show();
    $('.item_description_arabic').hide();
   // inpt_desp

    $("body").on('click','.inpt_desp',function(){
            $(this).removeClass('btn_gray').addClass('btn_bg');
            $(this).siblings().removeClass('btn_bg').addClass('btn_gray');
        
        if ($(this).hasClass('item_description_box_english')) {
            // alert('if');

            $('.item_description_english').show();
            $('.item_description_arabic').hide();
        }else{
            // alert('else');
            $('.item_description_english').hide();
            $('.item_description_arabic').show();
        }
    });

  

</script>




<script>
    $(document).on('click', '.ad_more_plans', function(){
      var lengt = $('.plan_main_cls').length;
         // alert(lengt);
        $('.apnd_plans_div').append('<div class="form-group plan_main_cls"><div class="row"><div class="col-4"><div class="form-group"> <label>From</label> <input type="text" name="plan_append_div['+lengt+'][from_price]" placeholder="Enter amount in SR" id="fromPrice['+lengt+']" value="" class="form-control fromPrice"> <br/></div></div><div class="col-4"><div class="form-group"> <label>To</label> <input type="text" name="plan_append_div['+lengt+'][to_price]" id="toPrice['+lengt+']" placeholder="Enter amount in SR" value="" class="form-control toPrice"></div></div><div class="col-sm-4"><div class="form-group"> <label>Choose Plan</label> <select class="form-control" id="selectedPlanId['+lengt+']" name="plan_append_div['+lengt+'][selected_plan_id]"><option selected disabled>Select Plan</option> @foreach($term_of_payment as $term)<option value="{{$term['id']}}">{{@$term['name']}}</option> @endforeach </select></div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="rem_plan_apnd"> <i class="fa fa-times"></i> Remove</a></p></div>')

        $("input[id^=toPrice").each(function(){
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "please enter to Price",
                        // min: "Max quantity should be more than min quantity",
                    }
                });   
            });
        $("input[id^=fromPrice").each(function(){
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "please enter from Price",
                        // min: "Max quantity should be more than min quantity",
                    }
                });   
            });
        $("input[id^=selectedPlanId").each(function(){
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "please select plan_",
                        // min: "Max quantity should be more than min quantity",
                    }
                });   
            });
    });
    $(document).on('click', '.rem_plan_apnd', function(){
        $(this).parents('.plan_main_cls').remove();
    });
</script>




<script type="text/javascript">

    $('.default_trm').on('click',function(){
        $('.Slct_plan').attr("disabled","true");
        $('.fromPrice').attr("disabled","true");
        $('.toPrice').attr("disabled","true");
    });
    
    $('.slect_1').on('click',function(){
        $('.Slct_plan').removeAttr("disabled");
        $('.fromPrice').removeAttr("disabled");
        $('.toPrice').removeAttr("disabled");
    });


$(document).ready(function(){
             // var sellingId =$(".selling_unit_item").val();
        $( ".selling_unit_item" ).change(function sellingUnit1() {
            var sellingUnit = $('option:selected', this).attr('sellingUnits');
            var sellingId =$(this).val();
            $('.fromUnit').val(sellingUnit);
            $('.toUnit').val(sellingUnit);

            $.ajax({
                url: "{{url('provider/product/selling_unit/add')}}",
                type:'post',
                data: {'sellingId': sellingId},
                success:function sellingUnit1(response){
                    $('.renderUnit').html(response);

                },error(){
                    toastr.error('Something went wrong');
                }
            })


        });





       

         $(document).on('keyup','.sellingUnitPrice', function(){
                var sellingunitprice  = $(this).val();
                // alert(sellingunitprice);
                var content_number    = $('.content_number').val();
                var final_price       = $('.final_price').val(sellingunitprice);
                var unitPrice         = Math.round(sellingunitprice/content_number);
                $('#single_unit_price').val(unitPrice); 
            
          });
         

        $(document).on('keyup','.discount_percent', function(){

             var discountpercent   = $(this).val();
             var discount_type    = $('.discount_type').val();
        
                if (discount_type=='percent') {
                  // alert('percent');
                   var content_number    = $('.content_number').val();
                   var sellingunitprice  = $('.sellingUnitPrice').val();
                   var discountPriceCalculation = discountpercent*sellingunitprice/100;
                   var discount_price = $('.discount_price').val(discountPriceCalculation);
                   var finalPriceCalculation = Math.round(sellingunitprice-discountPriceCalculation);
                   var final_price = $('.final_price').val(finalPriceCalculation);
                   var final_amount= $('.final_price').val();
                   var unitPrice =final_amount/content_number;
                   $('.unit_price').val(unitPrice);
                }            

        });

         $(document).on('keyup','.discount_price', function(){

             var discountprice   = $(this).val();
             var discount_type    = $('.discount_type').val();
      
               if (discount_type=='value') {
                  // alert('value');
                   var content_number    = $('.content_number').val();
                   var sellingunitprice  = $('.sellingUnitPrice').val();
                   var discountprice     = $(this).val();
                   // var afsellingunitprice-discounttprice;
                   var finalPriceCalculations = Math.round(sellingunitprice-discountprice);
                   var discount_price = $('.final_price').val(finalPriceCalculations);
                   var final_amount= $('.final_price').val();
                   var unitPrice =final_amount/content_number;
                   $('.unit_price').val(unitPrice);
                }              

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
                allproduct = allproduct * allvaluesum;
            }
                // alert(allproduct);

            var unitPrice  = Math.round(availableQualityCount*allproduct);

            $('.available-price').val(unitPrice);

            var contntUnit = $('.content_unit').find('option:selected').attr('contentUni');
            


             // $('.content_unit').closest('pack_info').find('each_content_unit').val(contntUnit);

            // $('.avilable-unit').val(contntUnit);

        }); 

    }); 
</script>
<!-- new price append div 07 sep -->
<script>
  
      $(document).on('click', '.add_more', function(){
        var len = $('.price_wrap').length;
        $('.apnnd_div').append('<div class="price_wrap"><div class="row"><div class="col-12"><div class="row"><div class="col-lg-3"><h5 class="chart_head mb-2">From</h5><div class="form-group"><label>Number</label> <input class="form-control" name="price_firsrt_append_div['+len+'][from_number]" id="fromNumber['+len+']"></div></div><div class="col-lg-3"><h5 class="chart_head mb-2"style=opacity:0>To</h5><div class="form-group"><label>Unit Price</label> <input class="form-control fromUnit" name="price_firsrt_append_div['+len+'][from_unit]" placeholder="select unit" readonly></div></div><div class="col-lg-3"><h5 class="chart_head mb-2">To</h5><div class="form-group"><label>Number</label> <input class="form-control" name="price_firsrt_append_div['+len+'][to_number]" id="toNumber['+len+']"></div></div><div class="col-lg-3"><h5 class="chart_head mb-2" style=opacity:0>To</h5><div class="form-group"><label>Unit</label> <input class="form-control toUnit" name="price_firsrt_append_div['+len+'][to_unit]" placeholder="select unit"readonly></div></div></div></div></div><div class="row second_price"><div class="col-lg-12"><div class="row"><div class="col-lg-2"><div class="form-group"><label>Selling Unit Price(Sr)</label> <input class="form-control beforeDiscountedPrice" name="price_firsrt_append_div['+len+'][selling_unit_price]" id="sellingUnitPrice['+len+']"></div></div><div class="col-lg-2"><div class="form-group"><label>Discount Type</label> <select class="form-control discount_type_append" name="price_firsrt_append_div['+len+'][discount_type]" type="text" value=""><option disabled selected>Select Discount Type<option value="value">Value<option value="percent">Percent</select></div></div><div class="col-lg-2"><div class="form-group"><label>Discount Percent(%)</label> <input class="form-control discountPercent"  name="price_firsrt_append_div['+len+'][discount_percent]" id="discount_percnt['+len+']"></div></div><div class="col-lg-2"><div class="form-group discountPrice"><label>Discount Price(SR)</label> <input class="form-control afterDiscountPrice" name="price_firsrt_append_div['+len+'][discount_price]" id="discount_price['+len+']"></div></div><div class=col-lg-2><div class="form-group"><label>Final Price(SR)</label> <input class="form-control final_prc" name="price_firsrt_append_div['+len+'][final_price]" id="finalPrice['+len+']"></div></div><div class="col-lg-2"><div class="form-group"><label>Unit Price(SR)</label> <input class="form-control unit_prc" name="price_firsrt_append_div['+len+'][unit_price]" id="unit_price['+len+']"></div></div></div></div></div><p class="mb-0 text-right"><a class="remove_apnd" href=javascript:;><i class="fa fa-times"></i> Remove</a></div>')
   
              var sellingUnit = $('.selling_unit_item').find('option:selected').attr('sellingUnits');
              $('.fromUnit').val(sellingUnit);
              $('.toUnit').val(sellingUnit);

            $("input[id^=finalPrice").each(function(){
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "please enter final Price",
                        }
                    });   
                });
              $("input[id^=sellingUnitPrice").each(function(){
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "please enter single unit price",
                        }
                    });   
                });
              $("input[id^=fromNumber").each(function(){
                    $(this).rules("add", {
                        required: true,
                         messages: {
                            required: "please enter from Number",
                        } 
                    });   
                });
              $("input[id^=toNumber").each(function(){
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "please enter to Number",
                        } 
                    });   
                });   
            
    });
 ///////////without discount.///orignal price////////////
      $(document).on('keyup','.beforeDiscountedPrice', function(){

            var sellingunitprice = $(this).val();

            var content_number = $('.content_number').val();
            var ths = $(this).closest('.second_price');
            ths.find('input.final_prc').val(sellingunitprice);
            var finalprice = ths.find('input.final_prc').val();
            var unitPrice  = Math.round(finalprice/content_number);
           
            var unit_prc =ths.find('input.unit_prc').val(unitPrice);

            $("input[id^=single_unit_price_").each(function(){
                $(this).rules("add", {
               required: true,
            });     
        });
    }); 
    ////////////////////end orifnal price//////////
      
       ///////when discount type is percent//////////
     $(document).on('keyup','.discountPercent', function(){

          var discountpercent = $(this).val();
          var ths             = $(this).closest('.second_price');  
          var discount_type   =  ths.find('.discount_type_append').val();
             if (discount_type =='percent') {
                var content_number    = $('.content_number').val();
                var sellingunitprice  = ths.find('input.beforeDiscountedPrice').val();
                var discountPriceCalculation = discountpercent*sellingunitprice/100;
                var discount_price = $('.afterDiscountPrice').val(discountPriceCalculation);
                var finalPriceCalculation = Math.round(sellingunitprice-discountPriceCalculation);
                var final_price = ths.find('input.final_prc').val(finalPriceCalculation);
                var final_amount= ths.find('input.final_prc').val();
                var unitPrice =final_amount/content_number;
                var unit_prc =ths.find('input.unit_prc').val(unitPrice);
             }            

     }); 
       ///////end percent//////////

       ///////when discount type is price//////////

        $(document).on('keyup','.afterDiscountPrice', function(){

            var discountprice   = $(this).val();
            var ths             = $(this).closest('.second_price');  
            var discount_type   =  ths.find('.discount_type_append').val();
       
              if (discount_type=='value') {
                  var content_number    = $('.content_number').val();
                  var sellingunitprice  = ths.find('input.beforeDiscountedPrice').val();
                  var discountprice     = $(this).val();
                  var finalPriceCalculations = Math.round(sellingunitprice-discountprice);
                  var discount_price         = ths.find('input.final_prc').val(finalPriceCalculations);
                  var final_amount           = ths.find('input.final_prc').val();
                  var unitPrice              = final_amount/content_number;
                  ths.find('input.unit_prc').val(unitPrice);
               }              

       });
       ///////end price//////////


    $(document).on('click', '.remove_apnd', function(){
        $(this).parents('.price_wrap').remove();
    });
</script>


<script type="text/javascript">
    $('#add_specification_form').validate({
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
        if($("#add_specification_form").valid()){
           // alert('here');
            $.ajax({
            url:"{{url('provider/products/edit/specification')}}",
            type: "post",
            data:$('#add_specification_form').serialize(),
            success:function(data){
                $('.title-class-'+data.specification.id).text(data.specification.title);
                $('.description-class-'+data.specification.id).text(data.specification.description);
                $('#edit_specification').modal('hide');
               location.reload(); 

            },
            error:function(){
                swal('Oops, Something went wrong');
            }
          });
        }
    })
</script>



<script type="text/javascript">
    $(document).on('click', '.edit-spec', function(){
        var specificationId = $(this).attr('specification_id');
        // alert(specificationId);
        $.ajax({
            url:"{{url('provider/products/specification')}}",
            type:"post",
            data:{specificationId:specificationId},
            success:function(data){
                $('.title-class').val(data.specification.title);
                $('.description-class').val(data.specification.description);
                $('.specification-id-class').val(data.specification.id);
               
                 $('#add_specification').modal('hide');
                 $('#edit_specification').modal('show');
            },
            error:function(){
                swal('Oops', 'Something went wrong');
            }
        })
        
    })
</script>
<script type="text/javascript">
    $('#edit_specification_form').validate({
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

    $(document).on('click', '.edit-list-btn', function(){
        // $('#specification_form').submit();
        if($("#edit_specification_form").valid()){
           // test for validity
            $.ajax({
            url:"{{url('provider/products/update/specification')}}",
            type: "post",
            data:$('#edit_specification_form').serialize(),
            success:function(data){
                $('.title-class-'+data.specification.id).text(data.specification.title);
                $('.description-class-'+data.specification.id).text(data.specification.description);
                $('#edit_specification').modal('hide');
                location.reload(); 
               
            },
            error:function(){
                swal('Oops, Something went wrong');
            }
          });
        }
    })
</script>

  <script type="text/javascript">
    $(document).on('click','.delete-btn',function(e){
        var isDelete = 'no';
        // var text = $(".product-weight").children('p').text();
        var del_url;
        var id =$(this).attr('del_id');
        var productId = "{{$product['id']}}";
        e.preventDefault();
        if($('.specification-count').val() > 1) {
               isDelete = 'yes'; 
         }
        del_url = "{{ url('provider/products/delete/specification') }}" + '/' + id;
        
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
                                   
                                        $('.title-class-'+id).hide();
                                        $('.description-class-'+id).hide();
                                        $('.spec-action-class-'+id).hide();
                                        $('.specification-count').val('');
                                        $('.specification-count').val(resp.count);
                                    
                                    $('.loader').hide();
                                    if (resp.status=='success') {
                                         location.reload();  
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
        } 
    });
</script>


<script type="text/javascript">
    var image_ids = [];
    var productId = "{{$product['id']}}";
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


<script type="text/javascript">
    var image_ids = [];
    var productId = "{{$product['id']}}";
    $('#feed_post_id1').val('');
    
    var myDropzone  = $('.drop_post_').dropzone({ 
        url:"{{url('provider/product/add/productDocument')}}"+'?product_id='+productId,
        // acceptedFiles:"image/*",
        addRemoveLinks:true,
        maxFiles: 5,
        maxFilesize:200,
        init: function() {
            var myDropzone = this;
            var fullurl='<?php echo asset('public/frontend/images/productDocument'); ?>';

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
             $('#document_ids').val(image_ids);
        },
        removedfile:function(file) {
            var file_id = file.stored_id;
                var removename = file.name;
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{url('provider/product/delete/productDocument')}}",
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
        categoryId = $(this).val();
        // alert(categoryId);

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


@stop