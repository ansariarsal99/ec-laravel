@extends('frontend.layout.providerLayout')
@section('title','Payment Methods')
@section('content')
        
        <div class="wrapper_shala seller_db_inner">
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
			            			<h3>My Membership</h3>
			            			<nav class="bread_nav_sec">
										<ol class="breadcrumb">
										    <li class="breadcrumb-item"><a href="#">Home</a></li>
										    <li class="breadcrumb-item active"><a href="#">My Membership</a></li>
										    <!-- <li class="breadcrumb-item active">Item List</li> -->
										</ol>
									</nav>
			            		</div>
			            	</div>
	            		</section>
	            		<section class="item_list_sec p-0 seler_price_plan">
	            			<div class="db_container">
	            				<div class="row">
	            					<div class="col-sm-12">
	            						<div class="card">
	            							<div class="card-body">
	            								<div class="membrship_wrap">
	                                                <h3>{{$membership->title}}</h3>
	                                                <p>{!! @$membership['description'] !!}</p>

		                                                @foreach($membershipLevel as $key => $value) 
		                                                <div class="singl_meber_wrp d-flex">
		                                                    <div class="lvl_img">
		                                                        <img src="https://www.climbstrong.com/wp-content/uploads/2020/01/level-1-membership.png" class="img-fluid">
		                                                    </div>
		                                                    <div class="achve_requr">
		                                                        <h6 class="plan_head">
		                                                        	{{$value['title']}} ({{$value['point_from']}}-{{$value['point_to']}} points)</h6>
		                                                        <p class="text_dull">{{@$value['description']}}</p>
		                                                    </div>
		                                                </div>
		                                               @endforeach
                                            	</div>
	            							</div>
	            						</div>
	            					</div>
	            				</div>
	            			</div>
	            		</section>
	            	</div>
	            </div>
            </section>
        </div>

@stop

@section('script')

@stop