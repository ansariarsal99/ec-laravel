@extends('frontend.layout.providerLayout')
@section('title','Earning Management')
@section('content')

<style type="text/css">
 

</style> 

 		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">

        <link href="{{asset('public/frontend/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" media="all" />

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
        
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
			            			<h3>Earning Management List</h3>
			            			<nav class="bread_nav_sec">
										<ol class="breadcrumb">
										    <li class="breadcrumb-item"><a href="#">Home</a></li>
										    <li class="breadcrumb-item active"><a href="#">Earning Management</a></li>
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
					            					<form class="form-inline actv_class_refnd" id="search_form" action="" method="get">
			            								<div class="card_ttl d-flex align-items-center justify-content-between">
			            									<div class="chng_links">
			            										<ul type="none" class="d-flex align-items-center">
			            											<li class="li_filter_day @if(@$_GET['seachData'] =='today') list-group-item active @endif"><a class="filter_day" seachData="today" href="{{url('/provider/earning/list')}}?seachData=today">Today</a></li>

			            											<li class="li_filter_day @if(@$_GET['seachData'] =='yesterday') list-group-item active @endif"><a class="filter_day" seachData="yesterday" href="{{url('/provider/earning/list')}}?seachData=yesterday">Yesterday</a></li>
                                                           <!-- list-group-item active -->
			            											<li class="li_filter_day @if(@$_GET['seachData'] =='current_week') list-group-item active @endif"><a class="filter_day" seachData="current_week" href="{{url('/provider/earning/list')}}?seachData=current_week">Current Week</a></li>
			            											<li class="li_filter_day @if(@$_GET['seachData'] =='previous_week') list-group-item active @endif"><a class="filter_day" seachData="previous_week" href="{{url('/provider/earning/list')}}?seachData=previous_week">Previous Week</a></li>
			            											<li class="li_filter_day @if(@$_GET['seachData'] =='current_month') list-group-item active @endif"><a class="filter_day" seachData="current_month" href="{{url('/provider/earning/list')}}?seachData=current_month">Current Month</a></li>
			            											<li class="li_filter_day @if(@$_GET['seachData'] =='previous_month') list-group-item active @endif"><a class="filter_day" seachData="previous_month" href="{{url('/provider/earning/list')}}?seachData=previous_month">Previous Month</a></li>
			            											<li class="li_filter_day @if(@$_GET['seachData'] =='current_year') list-group-item active @endif"><a class="filter_day" seachData="current_year" href="{{url('/provider/earning/list')}}?seachData=current_year">Current Year</a></li>
			            											<li class="li_filter_day @if(@$_GET['seachData'] =='previous_year') list-group-item active @endif"><a class="filter_day" seachData="previous_year" href="{{url('/provider/earning/list')}}?seachData=previous_year">Previous Year</a></li>
			            										</ul>
			            									</div>
						            						<div class="">
						            							<!-- <button class="btn btn-sm btn_theme"><span>Export</span></button> -->
						            						</div>
						            					</div>


						            					<div class="filter_div_seler new_div_seler">
				            								<div class="search_width">
							            						<div class="row">
					            									<div class="col-sm-2">
					            										<p class="text_bold">Search:</p>
					            									</div>
							            							<div class="col-sm-3">
							            								<span class="wd_form">
							            									<input type="text" name="offer_start_date" id="start_date" data-provide="datepicker" value="{{@$_GET['offer_start_date']}}"  class="form-control datepicker"  placeholder="From">
							            							    </span>
							            							</div>
							            							<div class="col-sm-3">
							            								<span class="wd_form">
							            									<input type="text" name="offer_end_date" id="end_date" data-provide="datepicker" value="{{@$_GET['offer_end_date']}}" class="form-control datepicker" placeholder="To">
							            								</span>
							            							</div>
							            							<div class="col-sm-3">
							            							
							            							<span class="wd_form">
							            								<select class="form-control custom-select">
							            									<option value="buyer_name">By Buyer Name</option>
							            								</select>
							            							</span>
							            							</div>
							            						</div>
							            						<div class="row">
							            							<div class="col-sm-12">
									            						<div class="searc_btn text-center mt-3">
									            							<button class="btn btn_theme searchSubmitProductSeller"><span>Search</span></button>
									            							<a href="{{ url('provider/earning/list') }}"><button class="btn btn_theme reset"><span>Reset</span></button></a>
									            						</div>
							            							</div>
							            						</div>
					            							</div>
						            					</div>
					            					</form>
					            					
					            					<div class="table-responsive table_seler">
				            							<table class="table table-bordered table-striped dt_table">
				            								<thead>
				            									<tr>
				            										<th>Order No#</th>
				            										<th>Order Date</th>
				            										<th>Buyer Name</th>
				            										<!-- <th>Order Status</th> -->
				            										<th>Total Order Value</th>
				            										<th>Admin Commision</th>
				            										<!-- <th>Admin Commision Sent</th> -->
				            										<th>Action</th>
				            										<!-- <th>Action</th> -->
				            									</tr>
				            								</thead>
				            								<tbody>
				            									@foreach($refundOrderList as $refundOrder)
				            									<tr>
			            										    <td class="stats_item">
			            										        {{@$refundOrder['OrderInvoiceId']}}
			            										    </td>

			            										    <td>{{@$refundOrder['placed_on']}}</td>
			            										    <td>{{@$refundOrder['order']['user']['first_name']}} {{@$refundOrder['order']['user']['last_name']}}</td>
			            										   <!--  <td class="stats_item">
			            										        <div class="btn-group">
			            										            <button type="button" class="btn btn-primary btn-sm">{{@$refundOrder['orderStatus']}}</button>
			            										        </div> 
			            										    </td> -->
			            										   <!--   <td class="stats_item">
			            										        <div class="btn-group">
			            										        	@if($refundOrder['refundStatus']!=null)
			            										            <button type="button" class="btn btn-primary btn-sm">{{@$refundOrder['refundStatus']}}</button>
			            										            @else
			            										            -
			            										            @endif
			            										        </div> 
			            										    </td> -->
			            										    <td>SR {{@$refundOrder['quantity_price']}}</td>
			            										    <td>
															    	


		
	<!-- // if($refundOrder['product_name']['has_special_build_mart_fees']=='yes'){

 //        $productBuildMartFee = App\ProductBuildMartFee::where('product_id',$refundOrder['product_name']['id'])->get()->toArray();

 //        if($refundOrder['product_name']['special_build_mart_fees_type']=='according_to_order_amount'){
         
 //            $orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //                    ->where('from_price','<=',$refundOrder['quantity_price'])
 //                    ->where('to_price','>=',$refundOrder['quantity_price'])
 //                    ->get()
 //                    ->toArray();

 //            if(empty($orderAmountByOrderCheck)){

 //                if($refundOrder['product_name']['default_amount']=='yes'){
                
 //                  	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                      $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                      $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 // 					  // dd('here');
 //                      $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                  	}

 //                }
                
 //            }

 //        }else if($refundOrder['product_name']['special_build_mart_fees_type']=='any_order_amount'){

 //        	$orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //        	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //        	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //        	        ->first();

 //        	if(empty($orderAmountByOrderCheck)){

 //        		if($refundOrder['product_name']['default_amount']=='yes'){
        		
 //        		  	if($refundOrder['product_name']['default_amount_type']=='percent'){

 //        		  		$adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];

 //        		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //        		  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 //        		        $adminCommision = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //        		  	}

 //        		}

 //        	}else{
 //        		$adminCommision = $orderAmountByOrderCheck['value'];
 //        	}

 //        } 
                                                   

 // 	}else if($refundOrder['product_name']['has_special_build_mart_fees']=='no'){
        
 //        if($refundOrder['product_name']['seller_name']['assigned_build_mart_fees']=='yes'){

 //         	if($refundOrder['product_name']['seller_name']['is_build_mart_fees_approve_by_user']=='yes'){

 //        	   if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='according_to_order_amount'){
        		             
	//                 $orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
	//                         ->where('from_price','<=',$refundOrder['quantity_price'])
	//                         ->where('to_price','>=',$refundOrder['quantity_price'])
	//                         ->get()
	//                         ->toArray();

	//                 if(empty($orderAmountByOrderCheck)){
  
 //                        if($refundOrder['product_name']['default_amount']=='yes'){
                        
 //                          	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                                $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                                $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                          	}else if($refundOrder['product_name']['default_amount_type']=='amount'){

 //                                $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                          	}

 //                        }
                        
	//                 }else{ 
	//                 	$adminCommision = $orderAmountByOrderCheck[''];
	//                 }

 //                }else if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='any_order_amount'){

 //                	$orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
 //                	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //                	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //                	        ->first();

 //                	if(empty($orderAmountByOrderCheck)){

 //                		if($refundOrder['product_name']['seller_name']['default_amount']=='yes'){
                		
 //                		  	if($refundOrder['product_name']['seller_name']['default_amount_type']=='percent'){

 //                		  		$adminCommisionPercent = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];

 //                		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                		  	}else if($refundOrder['product_name']['seller_name']['default_amount_type']=='amount'){
 //                		        $adminCommision = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];
 //                		  	}

 //                		}

 //                	}else{
 //                		$adminCommision = $orderAmountByOrderCheck['value'];
 //                	}

 //                } 
 //            }
 //        }
 // 	}
 	// if($refundOrder['product_name']['has_special_build_mart_fees']=='yes'){

 //        $productBuildMartFee = App\ProductBuildMartFee::where('product_id',$refundOrder['product_name']['id'])->get()->toArray();

 //        if($refundOrder['product_name']['special_build_mart_fees_type']=='according_to_order_amount'){
         
 //            $orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //                    ->where('from_price','<=',$refundOrder['quantity_price'])
 //                    ->where('to_price','>=',$refundOrder['quantity_price'])
 //                    ->get()
 //                    ->toArray();

 //            if(empty($orderAmountByOrderCheck)){

 //                if($refundOrder['product_name']['default_amount']=='yes'){
                
 //                  	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                      $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                      $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 // 					  // dd('here');
 //                      $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                  	}

 //                }
                
 //            }

 //        }else if($refundOrder['product_name']['special_build_mart_fees_type']=='any_order_amount'){

 //        	$orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //        	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //        	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //        	        ->first();

 //        	if(empty($orderAmountByOrderCheck)){

 //        		if($refundOrder['product_name']['default_amount']=='yes'){
        		
 //        		  	if($refundOrder['product_name']['default_amount_type']=='percent'){

 //        		  		$adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];

 //        		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //        		  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 //        		        $adminCommision = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //        		  	}

 //        		}

 //        	}else{
 //        		$adminCommision = $orderAmountByOrderCheck['value'];
 //        	}

 //        } 
                                                   

 // 	}else if($refundOrder['product_name']['has_special_build_mart_fees']=='no'){
        
 //        if($refundOrder['product_name']['seller_name']['assigned_build_mart_fees']=='yes'){

 //         	if($refundOrder['product_name']['seller_name']['is_build_mart_fees_approve_by_user']=='yes'){

 //        	   if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='according_to_order_amount'){
        		             
	//                 $orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
	//                         ->where('from_price','<=',$refundOrder['quantity_price'])
	//                         ->where('to_price','>=',$refundOrder['quantity_price'])
	//                         ->get()
	//                         ->toArray();

	//                 if(empty($orderAmountByOrderCheck)){
  
 //                        if($refundOrder['product_name']['default_amount']=='yes'){
                        
 //                          	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                                $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                                $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                          	}else if($refundOrder['product_name']['default_amount_type']=='amount'){

 //                                $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                          	}

 //                        }
                        
	//                 }else{ 
	//                 	$adminCommision = $orderAmountByOrderCheck[''];
	//                 }

 //                }else if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='any_order_amount'){

 //                	$orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
 //                	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //                	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //                	        ->first();

 //                	if(empty($orderAmountByOrderCheck)){

 //                		if($refundOrder['product_name']['seller_name']['default_amount']=='yes'){
                		
 //                		  	if($refundOrder['product_name']['seller_name']['default_amount_type']=='percent'){

 //                		  		$adminCommisionPercent = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];

 //                		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                		  	}else if($refundOrder['product_name']['seller_name']['default_amount_type']=='amount'){
 //                		        $adminCommision = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];
 //                		  	}

 //                		}

 //                	}else{
 //                		$adminCommision = $orderAmountByOrderCheck['value'];
 //                	}

 //                } 
 //            }
 //        }
 // 	}
 	// if($refundOrder['product_name']['has_special_build_mart_fees']=='yes'){

 //        $productBuildMartFee = App\ProductBuildMartFee::where('product_id',$refundOrder['product_name']['id'])->get()->toArray();

 //        if($refundOrder['product_name']['special_build_mart_fees_type']=='according_to_order_amount'){
         
 //            $orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //                    ->where('from_price','<=',$refundOrder['quantity_price'])
 //                    ->where('to_price','>=',$refundOrder['quantity_price'])
 //                    ->get()
 //                    ->toArray();

 //            if(empty($orderAmountByOrderCheck)){

 //                if($refundOrder['product_name']['default_amount']=='yes'){
                
 //                  	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                      $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                      $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 // 					  // dd('here');
 //                      $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                  	}

 //                }
                
 //            }

 //        }else if($refundOrder['product_name']['special_build_mart_fees_type']=='any_order_amount'){

 //        	$orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //        	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //        	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //        	        ->first();

 //        	if(empty($orderAmountByOrderCheck)){

 //        		if($refundOrder['product_name']['default_amount']=='yes'){
        		
 //        		  	if($refundOrder['product_name']['default_amount_type']=='percent'){

 //        		  		$adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];

 //        		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //        		  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 //        		        $adminCommision = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //        		  	}

 //        		}

 //        	}else{
 //        		$adminCommision = $orderAmountByOrderCheck['value'];
 //        	}

 //        } 
                                                   

 // 	}else if($refundOrder['product_name']['has_special_build_mart_fees']=='no'){
        
 //        if($refundOrder['product_name']['seller_name']['assigned_build_mart_fees']=='yes'){

 //         	if($refundOrder['product_name']['seller_name']['is_build_mart_fees_approve_by_user']=='yes'){

 //        	   if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='according_to_order_amount'){
        		             
	//                 $orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
	//                         ->where('from_price','<=',$refundOrder['quantity_price'])
	//                         ->where('to_price','>=',$refundOrder['quantity_price'])
	//                         ->get()
	//                         ->toArray();

	//                 if(empty($orderAmountByOrderCheck)){
  
 //                        if($refundOrder['product_name']['default_amount']=='yes'){
                        
 //                          	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                                $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                                $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                          	}else if($refundOrder['product_name']['default_amount_type']=='amount'){

 //                                $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                          	}

 //                        }
                        
	//                 }else{ 
	//                 	$adminCommision = $orderAmountByOrderCheck[''];
	//                 }

 //                }else if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='any_order_amount'){

 //                	$orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
 //                	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //                	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //                	        ->first();

 //                	if(empty($orderAmountByOrderCheck)){

 //                		if($refundOrder['product_name']['seller_name']['default_amount']=='yes'){
                		
 //                		  	if($refundOrder['product_name']['seller_name']['default_amount_type']=='percent'){

 //                		  		$adminCommisionPercent = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];

 //                		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                		  	}else if($refundOrder['product_name']['seller_name']['default_amount_type']=='amount'){
 //                		        $adminCommision = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];
 //                		  	}

 //                		}

 //                	}else{
 //                		$adminCommision = $orderAmountByOrderCheck['value'];
 //                	}

 //                } 
 //            }
 //        }
 // 	}
 	// if($refundOrder['product_name']['has_special_build_mart_fees']=='yes'){

 //        $productBuildMartFee = App\ProductBuildMartFee::where('product_id',$refundOrder['product_name']['id'])->get()->toArray();

 //        if($refundOrder['product_name']['special_build_mart_fees_type']=='according_to_order_amount'){
         
 //            $orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //                    ->where('from_price','<=',$refundOrder['quantity_price'])
 //                    ->where('to_price','>=',$refundOrder['quantity_price'])
 //                    ->get()
 //                    ->toArray();

 //            if(empty($orderAmountByOrderCheck)){

 //                if($refundOrder['product_name']['default_amount']=='yes'){
                
 //                  	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                      $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                      $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 // 					  // dd('here');
 //                      $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                  	}

 //                }
                
 //            }

 //        }else if($refundOrder['product_name']['special_build_mart_fees_type']=='any_order_amount'){

 //        	$orderAmountByOrderCheck = App\ProductBuildMartFee::where('product_id','=', $refundOrder['product_name']['id']) 
 //        	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //        	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //        	        ->first();

 //        	if(empty($orderAmountByOrderCheck)){

 //        		if($refundOrder['product_name']['default_amount']=='yes'){
        		
 //        		  	if($refundOrder['product_name']['default_amount_type']=='percent'){

 //        		  		$adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];

 //        		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //        		  	}else if($refundOrder['product_name']['default_amount_type']=='amount'){
 //        		        $adminCommision = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //        		  	}

 //        		}

 //        	}else{
 //        		$adminCommision = $orderAmountByOrderCheck['value'];
 //        	}

 //        } 
                                                   

 // 	}else if($refundOrder['product_name']['has_special_build_mart_fees']=='no'){
        
 //        if($refundOrder['product_name']['seller_name']['assigned_build_mart_fees']=='yes'){

 //         	if($refundOrder['product_name']['seller_name']['is_build_mart_fees_approve_by_user']=='yes'){

 //        	   if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='according_to_order_amount'){
        		             
	//                 $orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
	//                         ->where('from_price','<=',$refundOrder['quantity_price'])
	//                         ->where('to_price','>=',$refundOrder['quantity_price'])
	//                         ->get()
	//                         ->toArray();

	//                 if(empty($orderAmountByOrderCheck)){
  
 //                        if($refundOrder['product_name']['default_amount']=='yes'){
                        
 //                          	if($refundOrder['product_name']['default_amount_type']=='percent'){
 //                                $adminCommisionPercent = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                                $adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                          	}else if($refundOrder['product_name']['default_amount_type']=='amount'){

 //                                $adminCommision  = $refundOrder['product_name']['default_amount_build_mart_special_product'];
 //                          	}

 //                        }
                        
	//                 }else{ 
	//                 	$adminCommision = $orderAmountByOrderCheck[''];
	//                 }

 //                }else if($refundOrder['product_name']['seller_name']['build_mart_fees_type']=='any_order_amount'){

 //                	$orderAmountByOrderCheck = App\UserBuildMartFee::where('user_id','=', $refundOrder['product_name']['seller_name']['id']) 
 //                	        ->where('from_price','<=',$refundOrder['quantity_price'])
 //                	        ->where('to_price','>=',$refundOrder['quantity_price'])
 //                	        ->first();

 //                	if(empty($orderAmountByOrderCheck)){

 //                		if($refundOrder['product_name']['seller_name']['default_amount']=='yes'){
                		
 //                		  	if($refundOrder['product_name']['seller_name']['default_amount_type']=='percent'){

 //                		  		$adminCommisionPercent = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];

 //                		  		$adminCommision = $adminCommisionPercent/100*$refundOrder['quantity_price'];

 //                		  	}else if($refundOrder['product_name']['seller_name']['default_amount_type']=='amount'){
 //                		        $adminCommision = $refundOrder['product_name']['seller_name']['default_amount_build_mart'];
 //                		  	}

 //                		}

 //                	}else{
 //                		$adminCommision = $orderAmountByOrderCheck['value'];
 //                	}

 //                } 
 //            }
 //        }
 // 	}
 	 -->

                                                               

			            										    @if(!empty($refundOrder['admin_commission']))	SR {{@$refundOrder['admin_commission']}} @else - @endif
			            										    </td>
                                                                    @if(@$refundOrder['pay_admin_commission']=='no')

                                                                   
			            										    <td class="stats_item">
			            										        <div class="btn-group">
			            										            <a  class="text-success cp changeOrderStatus"
			            										            adminCommission="{{@$refundOrder['admin_commission']}}" order_item_id="{{@$refundOrder['id']}}" productName="{{@$refundOrder['product_name']['item_name']}}" product_id="{{@$refundOrder['product_id']}}" orderStatusId="{{@$refundOrder['product_order_refund_id']}}">Pay
			            										            </a>
			            							
			            										        </div>
			            										    </td>
			            										    @else 
			            										    <td class="stats_item">
			            										        <div class="btn-group">
			            										            <a  class="text-success 
			            										            adminCommission="{{@$refundOrder['admin_commission']}}" order_item_id="{{@$refundOrder['id']}}" productName="{{@$refundOrder['product_name']['item_name']}}" product_id="{{@$refundOrder['product_id']}}" orderStatusId="{{@$refundOrder['product_order_refund_id']}}">Paid
			            										            </a>
			            										    
			            										        </div>
			            										    </td>
			            										    @endif
				            									</tr>
				            									@endforeach
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
        

		<!-- Confirmation modal -->
        <div class="modal confir_mod" id="refund">
  			<div class="modal-dialog">
			    <div class="modal-content">

				    <div class="modal-header">
				        <h4 class="modal-title">Alert</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				    </div>
				      
				    <div class="modal-body">
				    	<div class="add_form text-center">
				    		<p>Are you sure that you want to make no refund of order cancellled?</p>
				    	</div>
				    	<form>
				    		<div class="form-group">
				    			<textarea class="form-control" rows="4" placeholder="Write your reason here..."></textarea>
				    		</div>
				    	</form>
				    </div>
			      	
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn_theme" data-dismiss="modal"><span>No</span></button>
			        	<button type="button" class="btn btn_theme" data-dismiss="modal"><span>Yes</span></button>
			      	</div>
			    </div>
		  </div>
		</div>

		        <!-- //////////////// Change Order Staus//////////////////// -->

		        <div class="modal fade edit_div cancl_ordr_modl" id="change_order_status_id" data-backdrop="static" data-keyboard="false">
		            <div class="modal-dialog modal-dialog-centered" role="document">
		                <div class="modal-content">
		                    <div class="modal-header text-center">
		                        <h5 class="modal-title " id="exampleModalCenterTitle">Build Mart Commission</h5>
		                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                          <span aria-hidden="true">&times;</span>
		                        </button>
		                    </div>
		                    <div class="modal-body">
		                        <div class="card_info text-center">
		                              <p>Are you sure you want to pay Build Mart commission ?</p>
		                            <form id="acceptRequestForm" method="POST as">
		                            The total commision for  <span class="product_name font-weight-bold"></span> will be SR <span class="admin_commision"></span>.

		                             <input type="hidden" name="orderId" class="orderIDD" value="">
		                             <input type="hidden" name="productId" class="productIDD" value="">
		                           
		                             <input type="hidden" name="admin_commision" class="admincommision" value="">
		                                <div class="col-sm-6 offset-sm-3">   
		                                    <div class="form-group">
		                                        
		                                    </div>
		                                      
		                                </div>
		                            </form> 
		                        </div>
		                    </div>
		                     <div class="modal-footer justify-content-center">
		                        <button type="button" class="btn btn_theme" data-dismiss="modal" aria-label="Close"><span>cancel</span></button>
		                        <button type="submit" class="btn btn_theme change_product_order_request"><span>Confirm</span></button>
		                    </div>
		                </div>
		            </div>
		        </div>
		<!-- ////////////// -->


@stop

@section('script')


    <script type="text/javascript" src="{{asset('public/frontend/js/bootstrap-datepicker.min.js')}}"></script>

<!-- 	<script>
	    $(document).ready(function () {
	    
	        var date = new Date();
	        $("#start_date").datepicker({
	            autoclose: true,
	            todayHighlight: true,
	            format: "yyyy-mm-dd",
	            startDate: new Date(),
	            viewMode: "days",
	            minViewMode: "days"
	        }).on('changeDate', function (selected) {
	            var minDate = new Date(selected.date.valueOf());
	            $('#end_date').datepicker('setStartDate', minDate);
	        });

	        $("#end_date").datepicker({
	            autoclose: true,
	            todayHighlight: true,
	            format: "yyyy-mm-dd",
	            startDate: new Date(),
	            viewMode: "days",
	            minViewMode: "days"
	        })
	        .on('changeDate', function (selected) {
	            var maxDate = new Date(selected.date.valueOf());
	            $('#start_date').datepicker('setEndDate', maxDate);
	        });
	    });
	</script> -->

	<script>
	    $(document).ready(function () {

	        var date = new Date();
	        $("#start_date").datepicker({
	            autoclose: true,
	            todayHighlight: true,
	             format: "yyyy-mm-dd",
	            viewMode: "days",
	            minViewMode: "days"
	        }).on('changeDate', function (selected) {
	            var minDate = new Date(selected.date.valueOf());
	            $('#end_date').datepicker('setStartDate', minDate);
	        });

	        $("#end_date").datepicker({
	            autoclose: true,
	            todayHighlight: true,
	            format: "yyyy-mm-dd",
	            viewMode: "days",
	            minViewMode: "days"
	        })
	        .on('changeDate', function (selected) {
	            var maxDate = new Date(selected.date.valueOf());
	            $('#start_date').datepicker('setEndDate', maxDate);
	        });
	    });
	</script>



    <script>
          
        $(document).on('click', '.searchSubmitProductSeller', function(){
	        var start_date  = $('#start_date').val();
	        var end_date    = $('#end_date').val();

            if(start_date != '' || end_date != ''){
                $('#search_form').submit(); 
            }else{
                swal('plesae select Date to filter');
            }
              
        });

 		// $(document).on('click', '.reset', function(){
   //   		window.location.href = "{{ url('provider/refund/Order/list') }}";  
  	// 	});


      //   $(document).on('click', '.filter_day', function(){
	    	// if ($(this).parent('li_filter_day').hasClass("list-group-item active")) {
      // 		    $(this).parent('li_filter_day').removeClass("list-group-item active");
	    	// }
	     //    $(this).parent('li_filter_day').addClass("list-group-item active");
      //   });

    </script>



<script>
    $("body").on('click','.changeOrderStatus',function(){
        var ths = $(this);
        var productOrderId  = $(this).attr("order_item_id");
        var productId       = $(this).attr("product_id");
        var productName     = $(this).attr("productName");
        var adminCommission = $(this).attr("adminCommission");
        // alert(productName);
        $('.admin_commision').html(adminCommission);
        $('.admincommision').val(adminCommission);
        $('.orderIDD').val(productOrderId);
        $('.productIDD').val(productId);
        $('.product_name').html(productName);

        $('#change_order_status_id').modal('show');
       
    });

    $('.change_product_order_request').on('click',function(){
            $('.loader').show(); 
            $.ajax({
                url:"{{url('provider/earning/commission/BuildMartCommision')}}",
                data:$("#acceptRequestForm").serialize(),
                type:'post',
                success:function(response){
                    if(response['status']=='true'){
                        $('.loader').hide();
                        $('#change_order_status_id').modal('hide');
                        location.reload();      
                    }else{
                        toastr.error('Something went wrong');
                    }
         
                }
            })
        });

</script>

@stop
