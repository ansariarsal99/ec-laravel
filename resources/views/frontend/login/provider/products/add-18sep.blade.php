@extends('frontend.layout.providerLayout')
@section('title','Add Product')
@section('content')
<style>
    .itm_heading{
        background: #f1f1f1;
        padding: 7px;
    }
    .itm_heading h4{
        font-size: 20px;
    }
    h5.chart_head{
        font-size: 15px;
    }
    .add_more {
        color: #cc3f2f;
        text-decoration: underline;
    }
    .add_more:hover {
        color: #cc3f2f;
        text-decoration: underline;
    }
    .remove_apnd {
        color: #cc3f2f;
        text-decoration: underline;
    }
    .remove_apn:hover {
        color: #cc3f2f;
        text-decoration: underline;
    }
    .items_prices {
        border: 2px solid #cc3f2f;
    }
    .price_wrap {
        padding: 8px;
    }
    .price_wrap .form-control{
        height: 30px;
    }
  /*=========new terms page css 04 sep======*/
    /*.view_trms_nw .form-control{
      display: inline-block;
      width: 40.7%;
    }*/
    .view_trms_nw .tplans_nam {
    font-size: 16px;
    text-transform: capitalize;
    font-weight: 600;
    color: #cc3f2f;
  }
  .view_trms_nw .form-group {
    background: #f9f9f9;
    padding: 5px 10px;
    border-radius: 10px;
    color: #000;
    width: 100%;
  }
  .view_trms_nw .custom-control {
    display: inline-block;
  }
    /*=========new terms page css 04 sep======*/

   /*===================css Rohit 09 sep=============*/
    .plan_choose_btn{
        height: 90%;
    }
    .chse_plns_mod .custom-control label{
        color: #cc3f2f;
        font-size: 15px;
        font-weight: 600;
    }
    /*===================css Rohit 09 sep=============*/
      
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
                                            <h3>Add New Products</h3>
                                        </div>
                                        <div class="add_product_form">
                                            <form id="add-product-form" action="{{url('provider/products/add')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-10 offset-sm-1">
                                                        <div class="form-group">
                                                            <label>Select Category</label>
                                                            <select class="form-control category_id_class mul_category" name="category_id[]" multiple="multiple">
                                                                @foreach($productCategories as $category)
                                                                    <option value="{{$category->id}}">{{@$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label id="category_id[]-error" class="error" for="category_id[]"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Select Sub Category</label>
                                                            <select class="form-control mul_category sub_category_class" name="sub_category_id[]" multiple="multiple">
                                                            </select>
                                                            <label id="sub_category_id[]-error" class="error" for="sub_category_id[]"></label>
                                                        </div>

                                                        <!-- <div class="form-group">
                                                            <label>Seller Item Code</label>
                                                            <input type="text" name="seller_item_code" class="form-control" value="" placeholder="Enter Seller Item Code">
                                                        </div> -->

                                                        <div class="row view_prof_dash">
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Seller Item Code</label><br />
                                                                    <span class="code">{{@$sellerItemCode}}</span>
                                                                    <input type="hidden" name="seller_item_code" value="{{@$sellerItemCode}}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Item Bar Code</label>
                                                            <input type="text" name="item_bar_code" class="form-control" value="" placeholder="Enter Item Bar Code">
                                                        </div>

                                                        <div class="row view_prof_dash">
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Build Mart Code </label><br />
                                                                    <span class="code">{{@$mawadCode}}</span>
                                                                    <input type="hidden" name="mawad_mart_code" value="{{@$mawadCode}}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Item Name</label>
                                                            <input type="text" name="item_name" class="form-control" value="" placeholder="Enter Item Name">
                                                        </div>

                                                         <div class="form-group">
                                                            <label>Item Description</label>
                                                            <textarea class="form-control" rows="5" placeholder="Write Item details here..." name="item_detail"></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label> Brand</label>
                                                            <select class="form-control" name="brand_id">
                                                                  <option selected disabled>Select Brand Name</option>
                                                                @foreach($brandProducts as $brandProduct)
                                                                    <option value="{{$brandProduct->id}}">{{@$brandProduct->brand_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                       <div class="items_size">
                                                           <div class="itm_heading mb-2">
                                                               <h4>Item Size</h4>
                                                           </div>
                                                           <div class="itms_size_quntt">
                                                               <div class="row">
                                                                   <div class="col-lg-6">
                                                                       <div class="size_chart">
                                                                            <h5 class="chart_head mb-2">Diameter</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="diameter_number" class="form-control" placeholder="Enter Diameter">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Unit</label> -->
                                                                                       <select class="form-control" name="diameter_unit">
                                                                                        <option selected disabled>Select Selling Unit</option>
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
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="length_number" class="form-control" placeholder="Enter Length">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Unit</label> -->
                                                                                      <select class="form-control" name="length_unit">
                                                                                      <option selected disabled>Select Selling Unit</option>
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
                                                                            <h5 class="chart_head mb-2">WIDTH</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="width_number" class="form-control" placeholder="Enter Width">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Unit</label> -->
                                                                                       <select class="form-control" name="width_unit">
                                                                                        <option selected disabled>Select Selling Unit</option>
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
                                                                            <h5 class="chart_head mb-2">DEPTH</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="depth_number" class="form-control">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Unit</label> -->
                                                                                      <select class="form-control" name="depth_unit">
                                                                                            <option selected disabled>Select Selling Unit</option>
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
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="hight_number" class="form-control" placeholder="Enter Height">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Unit</label> -->
                                                                                        <select class="form-control" name="hight_unit">
                                                                                            <option selected disabled>Select Selling Unit</option>
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
                                                                            <h5 class="chart_head mb-2">THICKNESS</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="thickness_number" class="form-control" placeholder="Enter Thickness">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Unit</label> -->
                                                                                     <select class="form-control" name="thickness_unit">
                                                                                            <option selected disabled>Select Selling Unit</option>
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
                                                                            <h5 class="chart_head mb-2">PARTICLES</h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Number</label> -->
                                                                                       <input type="text" name="particle_number" class="form-control">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                   <div class="form-group">
                                                                                       <!-- <label>Unit</label> -->
                                                                                     <select class="form-control" name="particle_unit">
                                                                                            <option selected disabled>Select Selling Unit</option>
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

                                                        <div class="form-group">
                                                           <label>Item Color</label>
                                                           <select class="form-control" name="item_color">
                                                                <option selected disabled>Select Brand Color</option>
                                                                @foreach($brandColors as $brandColor)
                                                                    <option value="{{$brandColor->id}}">{{@$brandColor->name}}</option>
                                                                @endforeach
                                                           </select>
                                                        </div>
                                                       <div class="form-group">
                                                           <label>Item Origin</label>
                                                           <select class="form-control" name="item_origin">
                                                                <option selected disabled>Select Origins</option>
                                                                @foreach($Origins as $Origin)
                                                                    <option value="{{$Origin->id}}">{{@$Origin->name}}</option>
                                                                @endforeach
                                                           </select>
                                                        </div>
                                                        <div class="form-group">
                                                           <label>Selling Unit</label>
                                                           <select class="form-control selling_unit_item" name="selling_unit">
                                                                <option selected disabled>Select Selling Unit</option>
                                                                @foreach($SellingUnits as $SellingUnit)
                                                                    <option sellingUnits="{{@$SellingUnit->name}}" value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                                                                @endforeach
                                                           </select>
                                                        </div>

                                                        <div class="items_size">
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
                                                        </div>

                                                        <div class="items_size">
                                                           <div class="itm_heading mb-2">
                                                               <h4>Minimum Buying Quality</h4>
                                                           </div>
                                                           <div class="size_chart">
                                                                <!-- <h5 class="chart_head mb-2">Each</h5> -->
                                                                <!-- <form> -->
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                           <div class="form-group">
                                                                               <label>Number</label>
                                                                               <input type="text" name="minimum_buying_quality_number" class="form-control">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                           <div class="form-group">
                                                                               <label>Unit</label>
                                                                               <input type="text" name="minimum_buying_quality_unit" class="form-control fromUnit" readonly="" placeholder="select unit">
                                                                           </div>
                                                                        </div>
                                                                    </div>
                                                               <!-- </form> -->
                                                           </div>
                                                        </div>

                                                        <div class="items_size items_prices mb-3">
                                                           <div class="itm_heading mb-2">
                                                               <h4>Price</h4>
                                                           </div>
                                                           <p class="text-right mb-0 pr-2">
                                                                <a href="javascript:;" class="add_more">
                                                                    <i class="fa fa-plus"></i> Add more price
                                                                </a>
                                                            </p>
                                                           <div class="size_chart">
                                                                <!-- <form> -->
                                                                <div class="apnnd_div">
                                                                    <div class="price_wrap">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-lg-3">
                                                                                	<h5 class="chart_head mb-2">From</h5>
                                                                                       <div class="form-group">
                                                                                           <!-- <label>Number</label> -->
                                                                                           <input type="text" name="from_number[]" class="form-control" value="">
                                                                                       </div>
                                                                                    </div>
	                                                                                <div class="col-lg-3">
                                                                                       	<h5 class="chart_head mb-2" style="opacity: 0;">To</h5>
	                                                                                    <div class="form-group">
	                                                                                    <!-- <label>Unit Price</label> -->
	                                                                                    <input type="text" name="from_unit[]" value="" class="form-control fromUnit" readonly="" placeholder="select unit">
	                                                                                    </div>
	                                                                                </div>
                                                                                    <div class="col-lg-3">
                                                                                       	<h5 class="chart_head mb-2">To</h5>
                                                                                        <div class="form-group">
                                                                                           <!-- <label>Number</label> -->
                                                                                           <input type="text" name="to_number[]" class="form-control" value="">
                                                                                       </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                       	<h5 class="chart_head mb-2" style="opacity: 0;">To</h5>
                                                                                        <div class="form-group">
                                                                                           <!-- <label>Unit</label> -->
                                                                                           <input type="text" name="to_unit[]" class="form-control toUnit" readonly="" value=""  placeholder="select unit" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                        	<div class="col-lg-5">
                                                                        		<div class="row">
                                                                        			<div class="col-lg-6">
	                                                                                    <!-- <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> -->
	                                                                                    <div class="form-group">
	                                                                                       <label>Selling Unit Price</label>
	                                                                                       <input type="text" name="selling_unit_price[]" class="form-control sellingUnitPrice">
	                                                                                   </div>
                                                                        			</div>
                                                                        			<div class="col-lg-6">
                                                                        				<!-- <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> -->
	                                                                                    <div class="form-group">
	                                                                                       <label>Unit Price</label>
	                                                                                       <input type="text" id="single_unit_price" name="unit_price[]" class="form-control unitPrice" value="">
	                                                                                   </div>
                                                                        			</div>
                                                                        		</div>
                                                                        	</div>
                                                                        	<div class="col-lg-7">
                                                                        		<div class="row">
                                                                        			<div class="col-lg-4">
                                                                        				<div class="form-group">
                                                                        					<label>Discount Price</label>
                                                                        					<input type="text" name="" class="form-control">
                                                                        				</div>
                                                                        			</div>
                                                                        			<div class="col-lg-4">
                                                                        				<div class="form-group">
                                                                        					<label>Single Unit Price</label>
                                                                        					<input type="text" name="" class="form-control">
                                                                        				</div>
                                                                        			</div>
                                                                        			<div class="col-lg-4">
                                                                        				<div class="form-group">
                                                                        					<label>Unit Price</label>
                                                                        					<input type="text" name="" class="form-control">
                                                                        				</div>
                                                                        			</div>
                                                                        		</div>
                                                                        	</div>
                                                                        </div>
                                                                        <!-- <p class="text-right mb-0">
                                                                            <a href="javascript:;" class="add_more">
                                                                                <i class="fa fa-times"></i> Remove
                                                                            </a>
                                                                        </p> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                               <!-- </form> -->
                                                       </div>
                                                        <!-- </div> -->


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

                                                        <div class="drop_area">
                                                            <label>Product Images</label>
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

                                                       <div class="items_size">
                                                           <div class="itm_heading mb-2">
                                                               <h4>Available Quantity in stock </h4>
                                                           </div>
                                                           <div class="row">
                                                               <div class="col-6">
                                                                   <div class="size_chart">
                                                                        <h5 class="chart_head mb-2">Each</h5>
                                                                        <div class="row">
                                                                             <div class="col-6">
                                                                               <div class="form-group">
                                                                                   <!-- <label>Number</label> -->
                                                                                   <input type="text" name="available_quantity_number" placeholder="Enter Available Quantity " value="" class="form-control available_quantity_count">
                                                                               </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                               <div class="form-group">
                                                                                   <!-- <label>Unit</label> -->
                                                                                     <input type="text" name="available_quantity_unit" readonly="" value="" class="form-control fromUnit" placeholder="select unit"> 
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
                                                                                   <input type="text" readonly="" name="available_quantity_content_number" class="form-control available-price" value="" placeholder="Enter Available Quantity Content Count">
                                                                               </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                               <div class="form-group">
                                                                                   <!-- <label>Unit</label> -->
                                                                                   <input type="text" readonly="" name="available_quantity_content_unit" placeholder="Select Unit" class="form-control avilable-unit" value="">
                                                                               </div>
                                                                            </div>
                                                                        </div>
                                                                   </div>
                                                               </div>
                                                           </div>


                                                       <div class="choose_plan_terms">
                                                                <div class="itm_heading mb-2">
                                                                    <h4>Term of payment</h4>
                                                                </div>
                                                                <div class="view_trms_nw">
                                                                    <div class="ad_more d-flex justify-content-between align-items-center">
                                                                        <div class="custom-control custom-radio mb-3">
                                                                            <input type="radio" class="custom-control-input slect_1" id="customRadio_new" checked="" name="default_plan" value="normal">
                                                                            <label class="custom-control-label" for="customRadio_new">Choose plans according to order amount:</label>
                                                                        </div>
                                                                        <p class="mb-0 pr-2">
                                                                            <a href="javascript:;" class="ad_more_plans">
                                                                                <i class="fa fa-plus"></i> Add more
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                    <div class="apnd_plans_div">
                                                                        <div class="form-group main_cls">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <div class="form-group">
                                                                                        <label>From</label>
                                                                                        <input type="text" name="" id="" value="" class="form-control fromPrice"><br />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <div class="form-group">
                                                                                        <label>To</label>
                                                                                        <input type="text" name="" id="" value="" class="form-control toPrice">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                     <div class="plan_choose_btn d-flex align-items-center justify-content-center">
                                                                                        <button class="btn btn_theme product-submit-btn choosePlan" data-id="" data-toggle="modal" type="button"><span>Choose Plan</span></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <p class="text-right mb-0"> <a href="javascript:;" class="rem_plan_apnd"> <i class="fa fa-times"></i> Remove </a> </p> -->
                                                                        </div>
                                                                    </div>

                                                                    <div class="custom-control custom-radio mb-3">
                                                                        <input type="radio" class="custom-control-input default_trm" id="customRadio_new22" name="default_plan" value="default">
                                                                        <label class="custom-control-label" for="customRadio_new22">use default plan</label>
                                                                    </div>
                                                                  </div> 
                                                                </div>
                      
                                                                <div class="btn_right text-right">
                                                                    <button class="btn btn_theme product-submit-btn" type="button"><span>Submit</span></button>
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
    <!-- Choose Plan -->
@stop
@section('script')

    @include('frontend.include.modals.chooseplan')
<!-- choose plans append div -->
<script>
    $(document).on('click', '.ad_more_plans', function(){
        $('.apnd_plans_div').append(' <div class="form-group main_cls"> <div class="row"> <div class="col-4"> <div class="form-group"> <label>From</label> <input type="text" name="" id="" value="" class="form-control fromPrice"><br/> </div></div><div class="col-4"> <div class="form-group"> <label>To</label> <input type="text" name="" id="" value="" class="form-control toPrice"> </div></div><div class="col-sm-4"> <div class="plan_choose_btn d-flex align-items-center justify-content-center"> <button class="btn btn_theme product-submit-btn choosePlan" data-id="" data-toggle="modal" type="button"><span>Choose Plan</span></button> </div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="rem_plan_apnd"> <i class="fa fa-times"></i> Remove </a> </p></div>')
    });
    $(document).on('click', '.rem_plan_apnd', function(){
        $(this).parents('.main_cls').remove();
    });
</script>
<!-- choose plans append div -->

<!-- ////////////// coose plan model-->
<script type="text/javascript">
   $(document).on('click', '.choosePlan', function(){
        $('#termOfPaymentPlan').modal('show');
        // var data  = $(this).closest('div').find('.titleSubscription').text();
        // var pack  = $(".subPack").text(data);
        // $('.subs_pack_cls').val($(this).data('id'));        

        // var subId = $(this).closest('div').find('.sub_id').val();
        //  $('#sub_active').val(subId);
        // var  registered_id =  $('.registered_id').val();
    }); 
</script>
<!-- /////////// -->



<script type="text/javascript">

    $('.default_trm').on('click',function(){
        $('.Slct_plan').attr("disabled","true");
        $('.fromPrice').attr("disabled","true");
        $('.toPrice').attr("disabled","true");

        // alert('hello');fromPrice
    });
    
    $('.slect_1').on('click',function(){
        $('.Slct_plan').removeAttr("disabled");
        $('.fromPrice').removeAttr("disabled");
        $('.toPrice').removeAttr("disabled");
        // alert('hello');
    });


$(document).ready(function(){
        
    $( ".selling_unit_item" ).change(function() {
        var sellingUnit = $('option:selected', this).attr('sellingUnits');
        $('.fromUnit').val(sellingUnit);
        $('.toUnit').val(sellingUnit);
    });        

     $(document).on('keyup','.sellingUnitPrice', function(){
        var sellingunitprice       = $(this).val();
        var content_number = $('.content_number').val();
        var unitPrice = Math.round(sellingunitprice/content_number);
        $('#single_unit_price').val(unitPrice);
      });

// Availble quantity
     $(document).on('keyup','.available_quantity_count', function(){
        var availableQualityCount = $(this).val();
        var content_number        = $('.content_number').val();
        var unitPrice             = Math.round(availableQualityCount*content_number);

        $('.available-price').val(unitPrice);

        var contntUnit = $('.content_unit').find('option:selected').attr('contentUni');
        $('.avilable-unit').val(contntUnit);

    }); 

}); 
     // available_quantity_number

</script>

<!-- new price append div 07 sep -->
<script>
	$(document).on('click', '.add_more', function(){
		$('.apnnd_div').append('<div class="price_wrap"> <div class="row"> <div class="col-12"> <div class="row"> <div class="col-lg-3"> <h5 class="chart_head mb-2">From</h5> <div class="form-group"> <label>Number</label> <input type="text" name="from_number[]" class="form-control" value=""> </div></div><div class="col-lg-3"> <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> <div class="form-group"> <label>Unit Price</label> <input type="text" name="from_unit[]" value="" class="form-control fromUnit" readonly="" placeholder="select unit"> </div></div><div class="col-lg-3"> <h5 class="chart_head mb-2">To</h5> <div class="form-group"> <label>Number</label> <input type="text" name="to_number[]" class="form-control" value=""> </div></div><div class="col-lg-3"> <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> <div class="form-group"> <label>Unit</label> <input type="text" name="to_unit[]" class="form-control toUnit" readonly="" value="" placeholder="select unit" value=""> </div></div></div></div></div><div class="row"> <div class="col-lg-5"> <div class="row"> <div class="col-lg-6"> <div class="form-group"> <label>Selling Unit Price</label> <input type="text" name="selling_unit_price[]" class="form-control sellingUnitPrice"> </div></div><div class="col-lg-6"> <div class="form-group"> <label>Unit Price</label> <input type="text" id="single_unit_price" name="unit_price[]" class="form-control unitPrice" value=""> </div></div></div></div><div class="col-lg-7"> <div class="row"> <div class="col-lg-4"> <div class="form-group"> <label>Discount Price</label> <input type="text" name="" class="form-control"> </div></div><div class="col-lg-4"> <div class="form-group"> <label>Single Unit Price</label> <input type="text" name="" class="form-control"> </div></div><div class="col-lg-4"> <div class="form-group"> <label>Unit Price</label> <input type="text" name="" class="form-control"> </div></div></div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="remove_apnd"> <i class="fa fa-times"></i> Remove </a> </p></div>')
	});
	$(document).on('click', '.remove_apnd', function(){
		$(this).parents('.price_wrap').remove();
	});
</script>
<!-- new price append div 07 sep -->

<!-- Price append script -->
<!-- <script>
    $(document).ready(function(){
        $(document).on('click', '.add_more', function(){

            var len = $('.price_wrap').length;

            $('.apnnd_div').append('<div class="price_wrap"><div class="row"> <div class="col-4"> <h5 class="chart_head mb-2">From</h5> <div class="row"> <div class="col-lg-6"> <div class="form-group"> <label>Number</label> <input type="text" name="from_number['+len+']" class="form-control" id="fromNumber['+len+']" value=""> </div></div><div class="col-lg-6"> <div class="form-group"> <label>Unit</label> <input type="text" readonly="    " name="from_unit['+len+']" class="form-control fromUnit" placeholder="select unit" value="" id="fromUnit['+len+']"> </div></div></div></div><div class="col-4"> <h5 class="chart_head mb-2">To</h5> <div class="row"> <div class="col-lg-6"> <div class="form-group"> <label>Number</label> <input type="text" value="" name="to_number['+len+']" class="form-control" id="toNumber['+len+']"> </div></div><div class="col-lg-6"> <div class="form-group"> <label>Unit</label><input type="text" name="to_unit['+len+']" readonly="" value="" class="form-control toUnit" placeholder="select unit" id="toUnit['+len+']"> </div></div></div></div><div class="col-lg-2"> <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> <div class="form-group selling-unit-price"> <label>Selling Unit Price</label> <input type="text" value="" name="selling_unit_price['+len+']" id="sellingUnitPrice'+len+'" class="form-control keup sellingUnitPrice'+len+'"> </div></div><div class="col-lg-2"> <h5 class="chart_head mb-2" style="opacity: 0;">To</h5> <div class="form-group sigle-unit"> <label>Unit Price</label class="sinle_uni"> <input type="text" value="" readonly="" name="unit_price['+len+']" id="single_unit_price'+len+'" class="form-control single_unit_pri"> </div></div></div><p class="text-right mb-0"> <a href="javascript:;" class="remove_apnd"> <i class="fa fa-times"></i> Remove </a> </p></div>')

              // console.log('------------','selling_unit_price'+len)

            var sellingUnit = $('.selling_unit_item').find('option:selected').attr('sellingUnits');
            // alert(sellingUnit);
            $('.fromUnit').val(sellingUnit);
            $('.toUnit').val(sellingUnit);

             $("input[id^=single_unit_price").each(function(){
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "please enter single unit price",
                            // min: "Max quantity should be more than min quantity",
                        }
                    });   
                });
              $("input[id^=sellingUnitPrice").each(function(){
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "please enter single unit price",
                            // min: "Max quantity should be more than min quantity",
                        }
                    });   
                });
              $("input[id^=fromNumber").each(function(){
                    $(this).rules("add", {
                        required: true,
                         messages: {
                            required: "please enter from Number",
                            // min: "Max quantity should be more than min quantity",
                        } 
                    });   
                });
              $("input[id^=toNumber").each(function(){
                    $(this).rules("add", {
                        required: true,
                        messages: {
                            required: "please enter to Number",
                            // min: "Max quantity should be more than min quantity",
                        } 
                    });   
                });   
            
        });

             
        $(document).on('keyup','.keup', function(){

                    var sellingunitprice       = $(this).val();
                    var content_number = $('.content_number').val();
                    var unitPrice = Math.round(sellingunitprice/content_number);
                    var unit_prc = $(this).closest('div.row').find('input.single_unit_pri').val(unitPrice);

                // $("input[id^=sellingUnitPrice_").each(function(){
                //     $(this).rules("add", {
                //         required: true,
                //     });   
                // });
                

                $("input[id^=single_unit_price_").each(function(){
                    $(this).rules("add", {
                        required: true,
                    });   
                });





           }); 

            $(document).on('click', '.remove_apnd', function(){
                $(this).parents('.price_wrap').remove();
            });
    });
</script> -->
<!-- Price append script -->

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
        if($("#specification_form").valid()){
        
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

<!-- <script type="text/javascript">
  

  $('#add-product-form').validate({

        submitHandler:function(form){
            
            var total=$('.child_checkbox:checked').length;

            if(total=='0'){
                toastr.error('please check a store to add reward points');
                return false;
            }

            form.submit();
        }
    });
</script> -->

<script type="text/javascript">

$(document).ready(function(){
  $('#add-product-form').validate({
            ignore:[],
            rules:{
                "category_id[]":{
                    required:true,    
                },
                "sub_category_id[]" :{
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
                "item_name" : {
                    required : true,
                },
                // "seller_item_code" : {
                //     required : true,
                //     number:true,
                // },



                "selected_plan_id[0]":{
                    // required: 
                     required : true,
                },            
                

                "item_bar_code" : {
                    required : true,
                     number:true,                 
                },
                "price_per_unit" :{
                    required:true,
                    number:true,
                },
                "image" :{
                    required:true,
                    extension: "jpeg|jpg|png|bmp",
                },
                 "item_detail" : {
                    required:true,
                    // minlength : 20,
                },
                "item_color" : {
                    required:true,
                    // minlength : 20,
                },
                "item_origin" : {
                    required:true,
                    // minlength : 20,
                },
                "each_content_unit" : {
                    required:true,
                    // minlength : 20,
                },
                "content_number" : {
                    required:true,
                    // minlength : 20,
                },
                "content_unit" : {
                    required:true,
                    // minlength : 20,
                },
                "minimum_buying_quality_number" : {
                    required:true,
                    // minlength : 20,
                },
                "minimum_buying_quality_unit" : {
                    required:true,
                },   
                "selling_unit" : {
                    required:true,
                },
                "diameter_number" : {
                    required:true,
                    number:true,
                },
               "diameter_unit" : {
                    required:true,
                },
               "length_number" : {
                    required:true,
                     number:true,
                },
               "length_unit" : {
                    required:true,
               },
               "width_number" : {
                    required:true,
                     number:true,
               },
               "width_unit" : {
                    required:true,
               },
               "depth_number" : {
                    required:true,
                     number:true,
               },
               "depth_unit" : {
                    required:true,
               },
               "thickness_number" : {
                    required:true,
                     number:true,
               },
               "thickness_unit" : {
                    required:true,
               },
               "particle_number" : {
                    required:true,
                     number:true,
               },
               "particle_unit" : {
                    required:true,
               },   
               "available_quantity_number" : {
                    required:true,
                     number:true,
               },   
               "available_quantity_unit" : {
                    required:true,
               },   
               "available_quantity_content_number" : {
                    required:true,
                     number:true,
               },   
               "available_quantity_content_unit" : {
                    required:true,
               },  
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
               


               "brand_id" : {
                    required:true,
                    // minlength : 20,
               }


            },
            messages:{
                "category_id[]":{
                    required:"Please select category",
                },
                // "from_price[]":{
                //     required:"Please enter from price",
                // },
                // "selected_plan_id[]":{
                //     required:"Please select plan",
                // },

                "sub_category_id[]": {
                    required: "Please select sub category",
                },
                "item_name": {
                    required: "Please enter item name",
                },
                // "seller_item_code": {
                //     required: "Please enter seller item code",
                // },
                "item_bar_code": {
                    required: "Please enter item bar code",
                },
                "price_per_unit": {
                    required: "Please enter price per unit",
                },
                "image": {
                    required: "Please select sub category",
                    extension: "Only jpeg, jpg, bmp and png extensions are allowed",
                },
                "item_detail" :{
                    required : "Please enter item description",
                    minlength : "Minimum 20 characters are allowed",
                },
                "item_color": {
                    required: "Please select item color",
                },
                "item_origin": {
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
                 "minimum_buying_quality_number": {
                    required: "Please enter minimum buying quality number",
                },
                 "minimum_buying_quality_unit": {
                    required: "Please select minimum buying quality unit",
                },
                "selling_unit": {
                    required: "Please select selling unit",
                },
                "diameter_number": {
                    required: "Please enter diameter",
                },
                "diameter_unit": {
                    required: "Please select diameter unit",
                },
                "length_number": {
                    required: "Please enter length",
                },
                "length_unit": {
                    required: "Please select length unit",
                },
               "width_number": {
                    required: "Please enter width",
                },
               "width_unit": {
                    required: "Please select width unit",
                },
               "depth_number": {
                    required: "Please enter depth",
                },
               "depth_unit": {
                    required: "Please select depth unit",
                },
               "thickness_number": {
                    required: "Please enter thickness",
                },
               "thickness_unit": {
                    required: "Please select thickness unit",
                },
               "particle_number": {
                    required: "Please enter particle",
                },
               "particle_unit": {
                    required: "Please select particle unit",
                }, 
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
                    required: "Please select selling unit price",
                }, 
                "unit_price[]": {
                    required: "Please select unit price",
                }, 
               "brand_id": {
                    required: "Please select brand"
                }
            },

            submitHandler:function(form){
                
                    
              // var default_plan=  $('input[name=default_plan]:checked').val();
              // if(default_plan == 'normal'){

              //   var total=$('.Slct_plan:checked').length;
              //   alert(total);
              //   if(total=='0'){
              //       toastr.error('please check a store to add reward points');
              //       return false;
              //   }
              // }

                form.submit();
            }


        });

        $("input[id^=reward_point_priority_").each(function(){
          // alert('here');
            $(this).rules("add", {
                required: {
                    depends: function(element) {
                        if ($(element).closest('.main_cls').find('input[type=checkbox]').is(':checked')){
                          // alert('herettttttttt');
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                digits:true,
                maxlength:10,
            });   
        });

        $("input[id^=reward_point_point_").each(function(){
            $(this).rules("add", {
                required: {
                    depends: function(element) {
                        if ($(element).closest('.main_cls').find('input[type=checkbox]').is(':checked')){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                digits:true,
                maxlength:10,
            });   
        });
 });


    $(document).on('click', '.product-submit-btn', function(){
         // if($('#add-product-form').valid()){

            $('#add-product-form').submit();
        // }
    })  
</script>






@stop