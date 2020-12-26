@extends('frontend.layout.providerLayout')
@section('title','My Stores Locations')
@section('content')
<style>
	.upgrade_plans .modal-dialog{
		width: 750px;
	}
	.choose_plan {
		max-height: 420px;
		overflow-y: auto;
		overflow-x: hidden;
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
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>
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
                                                <form>
                                                    <div class="row">
                                                        <div class="col-sm-10 offset-sm-1">
                                                            <div class="form-group">
                                                                <label>Select Category</label>
                                                                <select class="form-control custom-select">
                                                                    <option>Category 1</option>
                                                                    <option>Category 1</option>
                                                                    <option>Category 1</option>
                                                                    <option>Category 1</option>
                                                                    <option>Category 1</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Select Sub-category</label>
                                                                <select class="form-control custom-select">
                                                                    <option>Sub-category 1</option>
                                                                    <option>Sub-category 1</option>
                                                                    <option>Sub-category 1</option>
                                                                    <option>Sub-category 1</option>
                                                                    <option>Sub-category 1</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Enter Product Name</label>
                                                                <input type="text" name="pname" class="form-control" value="Cement">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Enter Price per Unit</label>
                                                                <input type="text" name="punit" class="form-control" value="SR 50">
                                                                <div class="sh_pric_tble">
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
                                                                        <div class="col-sm-4 inr_datat p-0">
                                                                            <p>5 kg</p>
                                                                            <p>5 kg</p>
                                                                            <p>5 kg</p>
                                                                        </div>
                                                                        <div class="col-sm-4 inr_datat p-0">
                                                                            <p>2</p>
                                                                            <p>2</p>
                                                                            <p>2</p>
                                                                        </div>
                                                                        <div class="col-sm-4 inr_datat p-0">
                                                                            <p>SR 200</p>
                                                                            <p>SR 200</p>
                                                                            <p>SR 200</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="btn_right text-right">
                                                                    <button class="btn btn_theme" type="button" data-toggle="modal" data-target="#new_weight"><span>Add New Weight</span></button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Add Specification</label>
                                                                <div class="sh_pric_tble">
                                                                    <div class="row tab_head m-0">
                                                                        <div class="col-lg-3 br_right p-0">
                                                                            <h4>Title</h4>
                                                                        </div>
                                                                        <div class="col-lg-9 br_right p-0">
                                                                            <h4>Description</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-0 mb-3">
                                                                        <div class="col-sm-3 inr_datat p-0">
                                                                            <p>Title 1</p>
                                                                            <p>Title 1</p>
                                                                            <p>Title 1</p>
                                                                        </div>
                                                                        <div class="col-sm-9 inr_datat p-0">
                                                                            <p>lorem ipsum dolor</p>
                                                                            <p>lorem ipsum dolor</p>
                                                                            <p>lorem ipsum dolor</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="btn_right text-right">
                                                                    <button class="btn btn_theme" type="button" data-toggle="modal" data-target="#new_weight"><span>Add New Specification</span></button>
                                                                </div>
                                                            </div>
                                                            <div class="form-group imge_uploader">
                                                                <label>Add Images</label>
                                                                <!-- New image uploader -->
                                                                <div class="uploader__box js-uploader__box l-center-box">
                                                                    <form action="" method="">
                                                                        <div class="uploader__contents">
                                                                            <label class="button button--secondary" for="fileinput">Select Files</label>
                                                                            <input id="fileinput" class="uploader__file-input" type="file" multiple value="Select Files">
                                                                        </div>
                                                                        <input class="button button--big-bottom" type="submit" value="Upload Selected Files">
                                                                    </form>
                                                                </div>
                                                                <!-- End -->
                                                            </div>
                                                            <div class="row view_prof_dash">
                                                                <div class="col-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Mawad mart code</label><br />
                                                                        <span class="code">ABC-00124</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Bar code</label><br />
                                                                        <span class="code">
                                                                            <img src="img/barcode.png" class="img-fluid">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row view_prof_dash">
                                                                <div class="col-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Supplier code</label><br />
                                                                        <span class="code">ABC-00152</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Preparation Time</label><br />
                                                                        <span class="code">2 hour</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="filter_div_seler">
                                                                    <h4 class="chose_terms">Choose Terms of Payment</h4>
                                                                </div>
                                                            </div>
                                                            <div class="row view_prof_dash">
                                                                <div class="col-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                            <label class="custom-control-label" for="customCheck">100% Payment</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 col-xs-12">
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
                                                                </div>
                                                            </div>
                                                            <div class="btn_right text-right">
                                                                <button class="btn btn_theme" type="button"><span>Submit</span></button>
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
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                      <!-- Modal body -->
                    <div class="modal-body">
                        <div class="add_form">
                            <form class="">
                                <div class="form-group">
                                    <label>Select Pcs.</label>
                                    <input type="text" name="pcs" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Select Weight</label>
                                    <input type="text" name="weight" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn_theme" data-dismiss="modal"><span>Add to List</span></button>
                    </div>
                </div>
          </div>
        </div>
        <div class="modal" id="new_specification">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Specification</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                      <!-- Modal body -->
                    <div class="modal-body">
                        <div class="add_form">
                            <form class="">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="pcs" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="weight" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn_theme" data-dismiss="modal"><span>Add to List</span></button>
                    </div>
                </div>
          </div>
        </div>
    </section>
	<!-- Choose Plan -->
@stop
@section('script')
@stop