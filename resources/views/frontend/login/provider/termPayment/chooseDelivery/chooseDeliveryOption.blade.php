@extends('frontend.layout.providerLayout')
@section('title','Delivery Options')
@section('content')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
      
        
       
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
			            			<h3>Delivery Options</h3>
			            			<nav class="bread_nav_sec">
										<ol class="breadcrumb">
										    <li class="breadcrumb-item"><a href="#">Home</a></li>
										    <li class="breadcrumb-item active"><a href="#">Delivery Options</a></li>
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
		            						
				                                    <section class="register_sec delvr_adrs selr_delvr">
				                                        <div class="new_div_aded">
				                                            <!-- <div class="section-heading"> -->
				                                            <!-- </div>         -->
				                                                <!-- <h2>Delivery Options</h2> -->
				                                                             
				                                         <form method="post" id="deliveryTermCondtion" action="{{url('provider/chooseDeliveryOption')}}">
				                                            	 


				                                            <div class="wrap_register_white selr_reg_white text-center">
				                                            	<div class="row">
				                                            		<div class="col-lg-10 offset-lg-1 col-sm-12">
						                                                <div class="wrp_addrss_product">
						                                                    <div class="top_radsss d-flex justify-content-between">
						                                                    @foreach($deliveryOption as $value)	
						                                                        <div class="custom-control custom-radio">
						                                                            <input type="radio" class="custom-control-input" id="pe{{$value['id']}}" value="{{$value['id']}}" name="delivery_option_id"   @if($userRecord['delivery_option_id']==$value['id']) checked="" @endif >
						                                                            <label class="custom-control-label" for="pe{{$value['id']}}">{{$value['delivery_type']}}</label>
						                                                        </div>
						                                                        @endforeach
						                                                    </div>
						                                                    <label id="delivery_option_id-error" class="error" for="delivery_option_id"></label>

						                                                    <div class="text-right mt-3">
		                                                                        <a class="btn btn_theme btn_submit" type="submit"><span>Update</span></a>
		                                                                    </div>
						                                                </div>
				                                            		</div>
				                                            	</div>
				                                            </div>
				                                        </form>
				                                        </div>
				                                    </section>
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

<script>

    $('#deliveryTermCondtion').validate({
        ignore:[],
        rules:{
            "delivery_option_id":{
                required:true,
                 noSpace:true,
            },
        },
        messages:{
            "delivery_option_id":{
                required:"Please select delivery option",
            },
        },
    });

    $(document).on('click','.btn_submit', function(){
        $('#deliveryTermCondtion').submit();
    })
</script>


@stop