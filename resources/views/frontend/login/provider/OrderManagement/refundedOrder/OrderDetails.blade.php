@extends('frontend.layout.providerLayout')
@section('title','Order Details')
@section('content')

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
        <!-- Header -->
         
        <!-- Header ends -->
        

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
			            			<h3>Order Details</h3>
			            			<nav class="bread_nav_sec">
										<ol class="breadcrumb">
										    <li class="breadcrumb-item"><a href="#">Home</a></li>
										    <li class="breadcrumb-item active"><a href="#">Order Details</a></li>
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
		            								
					            					<div class="order_detail_wrap">
					            						<div class="order_one_single">
                                                            <div class="wrp_two_selr d-flex justify-content-between align-items-center">
                                                                <div class="ordr_sellr_hedr d-flex flex-row">
                                                                    <span class="text-center">
                                                                        Order ID: {{$orderItemDetail['Order']['invoice_id']}} | Order Date: {{$orderItemDetail['Order']['placed_on']}}
                                                                    </span>
                                                                </div>
                                                                <button class="btn btn_theme printInvoice"><span>Print Invoice</span></button>
                                                            </div>
                                                            <div class="ord_seller_wrap">
                                                                <div class="ord_meta">

                                                            
                                                                    <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                        <div class="ordr_sellr_hedr d-flex flex-row">
                                                                            <span class="text-center">
                                                                                <small>Order ID</small><br>
                                                                                {{$orderItemDetail['Order']['invoice_id']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Order Amount</small><br>
                                                                                SR {{$orderItemDetail['quantity_price']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Seller Info </small><br>
                                                                                {{$orderItemDetail['productName']['sellerName']['contact_name']}} {{$orderItemDetail['productName']['sellerName']['contact_last_name']}}
                                                                            </span>
                                                                        </div>
                                                                        <!-- <a href="" class="cp">Store Location on Map</a> -->
                                                                    </div>
                                                                    <div class="adrs_pymt_top">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <div class="row">
                                                                                    <div class="col-sm-5">
                                                                                        <div class="cart_overvew">
                                                                                            <div class="shoping__continue">
                                                                                                <div class="shoping__discount">
                                                                                                    <h5>Shipping Details: </h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="shoping__checkout">
                                                                                                <ul>
                                                                                                    <li>{{$orderItemDetail['delivery_address']['address_title']}},{{$orderItemDetail['delivery_address']['address']}},{{$orderItemDetail['delivery_address']['province_name']}},{{$orderItemDetail['delivery_address']['postal_code']}},{{$orderItemDetail['delivery_address']['location']}} 
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-7">
                                                                                        <div class="cart_overvew">
                                                                                            <div class="shoping__continue">
                                                                                                <div class="shoping__discount">
                                                                                                    <h5>Payment Method: </h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="shoping__checkout">
                                                                                                <ul>
                                                                                                    <li>
                                                                                                        <i class="fa fa-google-wallet"></i> Paid from Card
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Order Summary: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            <?php
                                                                                                $taxProduct =$orderItemDetail['quantity_price']/100*$taxOnEveryProduct['tax_percent'];

                                                                                                $subTotal = $orderItemDetail['quantity_price']-$taxProduct;


                                                                                                

                                                                                            ?>

                                                                                            <li>Subtotal <span>SR {{@$subTotal}}</span></li>
                                                                                            <li>Tax <span>SR {{@$taxProduct}}</span></li>
                                                                                            <li>Delivery Charges <span>SR 0.00</span></li>
                                                                                            <li>Total <span>SR {{@$orderItemDetail['quantity_price']}}</span></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="adrs_pymt_top">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Amount: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            <li>SR {{$orderItemDetail['quantity_price']}}</li>
                                                                                            <li>Total: SR {{$orderItemDetail['quantity_price']}}</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Payment Method: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            Paid from Card
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Status: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            <li>Paid on {{$orderItemDetail['Order']['placed_on']}}</li>
                                                                                        </ul>
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
		            						</div>
		            					</div>
		            				</div>
		            			</div>
		            		</section>
						</div>
	            	</div>
	            </div>
            </section>
         
        </div>

     @stop

@section('script')

<script type="text/javascript">
    $(document).on('click','.printInvoice', function(){
        window.location.href= "{{url('provider/product/refundOrder/invoice'.'?id='.base64_encode($orderItemDetail['id']))}}"    
    });
</script>

@stop
