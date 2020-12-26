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
        										<h3>Products List</h3>
        										<div class="">
        											<a href="sellerdbaddproduct.php" class="card_btn_top">+ Add Product</a>
        											<button class="btn btn-sm btn_theme"><span>Export</span></button>
        										</div>
        									</div>
        									<div class="filter_div_seler">
        										<form class="form-inline">
        											<label class="text_bold">Search:</label>
        											<span class="wd_form">
        												<select class="form-control custom-select">
        													<option>Active</option>
        													<option>Inactive</option>
        												</select>
        											</span>
        											<button class="btn btn_theme"><span>Search</span></button>
        											<button class="btn btn_theme"><span>Reset</span></button>
        										</form>
        									</div>
        									<div class="table-responsive table_seler">
        										<table class="table table-bordered table-striped dt_table">
        											<thead>
        												<tr>
        													<th class="prnt_chk_th">
        														<div class="custom-control custom-checkbox">
        															<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
        															<label class="custom-control-label" for="customCheck"></label>
        														</div>
        													</th>
        													<th>Product Name</th>
        													<th>Category Name</th>
        													<th>Display Order</th>
        													<th>Image</th>
        													<th>Quantity</th>
        													<th>Price</th>
        													<th>Status</th>
        													<th>Action</th>
        												</tr>
        											</thead>
        											<tbody>
        												<tr>
        													<td>
        														<div class="custom-control custom-checkbox">
        															<input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
        															<label class="custom-control-label" for="customCheck1"></label>
        														</div>
        													</td>
        													<td>Cement</td>
        													<td>Construction</td>
        													<td>5</td>
        													<td><img src="https://www.prismcement.com/images/cement-1.jpg" class="item_img"></td>
        													<td>10 KG</td>
        													<td>SR 530</td>
        													<td class="stats_item">
        														<div class="btn-group">
        															<button type="button" class="btn btn-success btn-sm">Active</button>
        															<button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
        															<div class="dropdown-menu dropdown-menu-right">
        																<a class="dropdown-item" href="#">Make Inactive</a>
        															</div>
        														</div> 
        													</td>
        													<td class="stats_item">
        														<a class="text-primary cp">Edit</a><br>
        														<a class="text-danger cp">Delete</a>
        													</td>
        												</tr>
        												<tr>
        													<td>
        														<div class="custom-control custom-checkbox">
        															<input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
        															<label class="custom-control-label" for="customCheck1"></label>
        														</div>
        													</td>
        													<td>Bulb 10 watt</td>
        													<td>Electrical</td>
        													<td>5</td>
        													<td><img src="https://ssgeshop.com/wp-content/uploads/2018/02/Emergency-10-Watt-1.png" class="item_img"></td>
        													<td>5 pcs.</td>
        													<td>SR 145</td>
        													<td class="stats_item">
        														<div class="btn-group">
        															<button type="button" class="btn btn-success btn-sm">Active</button>
        															<button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
        															<div class="dropdown-menu dropdown-menu-right">
        																<a class="dropdown-item" href="#">Make Inactive</a>
        															</div>
        														</div> 
        													</td>
        													<td class="stats_item">
        														<a class="text-primary cp">Edit</a><br>
        														<a class="text-danger cp">Delete</a>
        													</td>
        												</tr>
        												<tr>
        													<td>
        														<div class="custom-control custom-checkbox">
        															<input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
        															<label class="custom-control-label" for="customCheck1"></label>
        														</div>
        													</td>
        													<td>Cement</td>
        													<td>Construction</td>
        													<td>5</td>
        													<td><img src="https://www.prismcement.com/images/cement-1.jpg" class="item_img"></td>
        													<td>10 KG</td>
        													<td>SR 530</td>
        													<td class="stats_item">
        														<div class="btn-group">
        															<button type="button" class="btn btn-success btn-sm">Active</button>
        															<button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
        															<div class="dropdown-menu dropdown-menu-right">
        																<a class="dropdown-item" href="#">Make Inactive</a>
        															</div>
        														</div> 
        													</td>
        													<td class="stats_item">
        														<a class="text-primary cp">Edit</a><br>
        														<a class="text-danger cp">Delete</a>
        													</td>
        												</tr>
        												<tr>
        													<td>
        														<div class="custom-control custom-checkbox">
        															<input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
        															<label class="custom-control-label" for="customCheck1"></label>
        														</div>
        													</td>
        													<td>Cement</td>
        													<td>Construction</td>
        													<td>5</td>
        													<td><img src="https://giecdn.azureedge.net/storage/fileuploads/image/2019/11/01/dreamstime_xxl_18443804%20-steel%20bars.jpg?w=736&h=414&mode=crop" class="item_img"></td>
        													<td>10 KG</td>
        													<td>SR 530</td>
        													<td class="stats_item">
        														<div class="btn-group">
        															<button type="button" class="btn btn-danger btn-sm">Inactive</button>
        															<button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
        															<div class="dropdown-menu dropdown-menu-right">
        																<a class="dropdown-item" href="#">Make Active</a>
        															</div>
        														</div> 
        													</td>
        													<td class="stats_item">
        														<a class="text-primary cp">Edit</a><br>
        														<a class="text-danger cp">Delete</a>
        													</td>
        												</tr>
        												<tr>
        													<td>
        														<div class="custom-control custom-checkbox">
        															<input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
        															<label class="custom-control-label" for="customCheck1"></label>
        														</div>
        													</td>
        													<td>Bulb 10 watt</td>
        													<td>Electrical</td>
        													<td>5</td>
        													<td><img src="https://ssgeshop.com/wp-content/uploads/2018/02/Emergency-10-Watt-1.png" class="item_img"></td>
        													<td>5 pcs.</td>
        													<td>SR 145</td>
        													<td class="stats_item">
        														<div class="btn-group">
        															<button type="button" class="btn btn-danger btn-sm">Inactive</button>
        															<button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
        															<div class="dropdown-menu dropdown-menu-right">
        																<a class="dropdown-item" href="#">Make Aactive</a>
        															</div>
        														</div> 
        													</td>
        													<td class="stats_item">
        														<a class="text-primary cp">Edit</a><br>
        														<a class="text-danger cp">Delete</a>
        													</td>
        												</tr>
        												<tr>
        													<td>
        														<div class="custom-control custom-checkbox">
        															<input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
        															<label class="custom-control-label" for="customCheck1"></label>
        														</div>
        													</td>
        													<td>Cement</td>
        													<td>Construction</td>
        													<td>5</td>
        													<td><img src="https://www.prismcement.com/images/cement-1.jpg" class="item_img"></td>
        													<td>10 KG</td>
        													<td>SR 530</td>
        													<td class="stats_item">
        														<div class="btn-group">
        															<button type="button" class="btn btn-success btn-sm">Active</button>
        															<button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
        															<div class="dropdown-menu dropdown-menu-right">
        																<a class="dropdown-item" href="#">Make Inactive</a>
        															</div>
        														</div> 
        													</td>
        													<td class="stats_item">
        														<a class="text-primary cp">Edit</a><br>
        														<a class="text-danger cp">Delete</a>
        													</td>
        												</tr>
        											</tbody>
        										</table>
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