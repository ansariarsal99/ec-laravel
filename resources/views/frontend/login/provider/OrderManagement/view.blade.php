@extends('frontend.layout.providerLayout')
@section('title','View Product Cancellation Request Details')
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
	                            <h3>View Product Cancellation Request Details</h3>
	                            <nav class="bread_nav_sec">
	                                <ol class="breadcrumb">
	                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
	                                    <li class="breadcrumb-item active"><a href="javascript:;">View Product Cancellation Request Details</a></li>
	                                    <!-- <li class="breadcrumb-item active">Item List</li> -->
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
				            						<!-- <h3>View Product Cancellation Request Details</h3> -->
				            					</div>
				            					<div class="add_product_form vw_product_info">
				            						<form>
				            							<div class="row view_items_info">
                                                            
                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Order id</label>
                                                                    <p>{{@$productDetail['Order']['invoice_id']}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>product Name</label>
                                                                    <p>{{ucfirst(@$productDetail['productName']['item_name'])}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Product Price </label>
                                                                    <p>SR {{@$productDetail['quantity_price']}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Purchased Date</label>
                                                                    <p>{{@$productDetail['Order']['placed_on']}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Product Cancellation Reason</label>
                                                                    <p>{{@$productDetail['cancellationReason']}}</p>
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
	   @stop
@section('script')
@stop