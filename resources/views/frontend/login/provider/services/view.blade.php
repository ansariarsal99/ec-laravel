@extends('frontend.layout.providerLayout')
@section('title','Service')
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
	                            <h3>View Service Details</h3>
	                            <nav class="bread_nav_sec">
	                                <ol class="breadcrumb">
	                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
	                                    <li class="breadcrumb-item active"><a href="javascript:;">View Service Details</a></li>
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
				            						<h3>View Service Details</h3>
				            					</div>
				            					<div class="add_product_form vw_product_info">
				            						<form>
				            							<div class="row view_items_info">
                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <p>{{@$product['category']['name']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Sub-category</label>
                                                                    <p>{{@$product['subCategory']['name']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Service Name</label>
                                                                    <p>{{@$product['product_name']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Price</label>
                                                                    <p>SR {{@$product['price_per_unit']}}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- <div class="row">
                                                        	<div class="col-lg-12">
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
	                                                                @if(count($product['productWeight']) > 0)
	                                                                <div class="row m-0 mb-3">
	                                                                    <div class="col-sm-4 inr_datat p-0 product-weight">
	                                                                    	@foreach($product['productWeight'] as $weight)
	                                                                        <p>{{@$weight['quantity']}}</p>
	                                                                        @endforeach
	                                                                    </div>
	                                                                    <div class="col-sm-4 inr_datat p-0 product-weight">
	                                                                    	@foreach($product['productWeight'] as $weight)
	                                                                        <p>{{@$weight['pcs']}}</p>
	                                                                        @endforeach
	                                                                    </div>
	                                                                    <div class="col-sm-4 inr_datat p-0 product-weight">
	                                                                    	@foreach($product['productWeight'] as $weight)
	                                                                        <p>SR {{@$weight['price']}}</p>
	                                                                        @endforeach
	                                                                    </div>
	                                                                </div>
	                                                                @endif
	                                                            </div>
                                                        	</div>
                                                        </div>
                                                         -->
                                                        <div class="row">
                                                        	<div class="col-lg-12">
                                                        		<label>Specification</label>
                                                        		<div class="sh_pric_tble specification_example">
	                                                                <div class="row tab_head m-0">
	                                                                    <div class="col-lg-3 br_right p-0">
	                                                                        <h4>Title</h4>
	                                                                    </div>
	                                                                    <div class="col-lg-9 br_right p-0">
	                                                                        <h4>Description</h4>
	                                                                    </div>
	                                                                </div>
	                                                                @if(count($product['productSpecification']) > 0)
	                                                                <div class="row m-0 mb-3">
	                                                                    <div class="col-sm-3 inr_datat 	p-0 product-spec">
	                                                                    	@foreach($product['productSpecification'] as $spec)
	                                                                        <p>{{@$spec['title']}}</p>
	                                                                        @endforeach
	                                                                    </div>
	                                                                    <div class="col-sm-9 inr_datat p-0 product-spec">
	                                                                    	@foreach($product['productSpecification'] as $spec)
	                                                                        <p>{{@$spec['description']}}</p>
	                                                                        @endforeach
	                                                                    </div>
	                                                                </div>
	                                                                @endif
	                                                            </div>
                                                        	</div>
                                                        </div>
                                                        @if(!empty($product['productImage']))

                                                        <div class="row">
                                                        	<div class="col-sm-12">
                                                        		<label>Product Images</label>
                                                        		<div class="vw_imgs mb-3">
                                                        			@foreach($product['productImage'] as $productImage)
                                                        				<?php
                                                        					$image = null;
                                                        					if($productImage['name'] && file_exists(public_path('frontend/images/products/'.$productImage['name'])))
                                                        					{
                                                        						$image = productImgsPath.'/'.$productImage['name'];
                                                        					}
                                                        				?>

                                                        				@if($image)
                                                        					<img src="{{$image}}" class="img-fluid">
                                                        				@endif
                                                        				
                                                        			@endforeach
                                                        		</div>
                                                        	</div>
                                                        </div>
                                                        @endif

                                                       <!--  <div class="row view_items_info">
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Mawad mart code</label><br />
                                                                    <p>{{@$product['mawad_mart_code']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Bar code</label><br />
                                                                    <span class="b_code">
                                                                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->bar_code, 'C93')}}" class="img-fluid">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Supplier code</label><br />
                                                                    <p>{{@$product['supplier_code']}}</p>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    <!--     @if(!empty($termsOfPayments))
                                                        <div class="row">
                                                        	<div class="col-lg-12">
                                                        		<div class="form-group">
		                                                            <div class="filter_div_seler">
		                                                                <h4 class="chose_terms">Terms of Payment</h4>
		                                                            </div>
		                                                            <div class="perct_info">
		                                                            	 @foreach($termsOfPayments['userTermOfPaymentQuotas'] as $quota)
		                                                            	<p class="">{{$quota->quota_percent}}% {{$quota->title}}</p>
		                                                            	@endforeach
		                                                            </div>
		                                                        </div>
                                                        	</div>
                                                        </div>
                                                        @endif -->
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