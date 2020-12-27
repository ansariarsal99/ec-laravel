@extends('frontend.layout.layout')
@section('title','Product Detail')
@section('content')
 <!--  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
 <link rel="stylesheet" type="text/css" href="css/magiczoomplus.css"> -->
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">

  <link rel="stylesheet" type="text/css" href="css/magiczoomplus.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  


    <?php 
        $length_unit    = App\ProductUnit::where('id',$productsFrstDetail['length_unit'])->value('unit');
        
        $diameter_unit  = App\ProductUnit::where('id',$productsFrstDetail['diameter_unit'])->value('unit');

        $width_unit     = App\ProductUnit::where('id',$productsFrstDetail['width_unit'])->value('unit');

        $depth_unit     = App\ProductUnit::where('id',$productsFrstDetail['depth_unit'])->value('unit');

        $thickness_unit = App\ProductUnit::where('id',$productsFrstDetail['thickness_unit'])->value('unit');

        $particle_unit  = App\ProductUnit::where('id',$productsFrstDetail['particle_unit'])->value('unit');

        $height_unit    = App\ProductUnit::where('id',$productsFrstDetail['height_unit'])->value('unit');
        
        $criteria_unit  = App\ProductUnit::where('id',$productsFrstDetail['criteria_unit'])->value('unit');
     ?>
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Building Material</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products Details</li>
                    </ol>
                </nav>
            </div>
            <section class="prods_dtl_page_sec">
                <div class="container">
                    <div class="wrp_product_dtl">
                        <!--  -->
                    	<div class="row">
    
                        
                    		
							<div class="col-sm-5 pos_sticky">
			                    <div class="product-details-images">
			                        <div class="sldr_detil">
									    <div class="app-figure" id="zoom-fig">
									    	<?php  
						                                           
									    	    if (!empty($product['product_images'][0]['name'])) {
			                                        $imgpath= productImgsBasePath.'/'.$product['product_images'][0]['name'];    
			                                    }                                                                                        
			                                    if(!empty($product['product_images'][0]['name']) && file_exists($imgpath) ) { 
			                                        $admin_image = productImgsPath.'/'.$product['product_images'][0]['name'];    
			                                    }else{
			                                        $admin_image = defaultAdminImagePath.'/no_image.png';  
			                                    }

			                                    // dd($product);
			                                ?>
									        <a id="Zoom-1" class="MagicZoom" title="Show your product in stunning detail with Magic Zoom Plus." href="{{$admin_image}}" data-zoom-image-2x="{{$admin_image}}" data-image-2x="{{$admin_image}}"> <img src="{{$admin_image}}" alt=""/>
									        </a>
									        <div class="selectors">
									  	@foreach($product['product_images'] as $productImage)
			                                      
			                        		<?php  
			                                    if (!empty($productImage['name'])) {
			                                        $imgpath= productImgsBasePath.'/'.$productImage['name'];    
			                                    }                                                                                        
			                                    if(!empty($productImage['name']) && file_exists($imgpath) ) { 
			                                        $admin_image = productImgsPath.'/'.$productImage['name'];    
			                                        // dd($admin_image);
			                                    }else{
			                                        $admin_image = defaultAdminImagePath.'/no_image.png';  
			                                    }                                           
			                                ?>

									            <a  data-zoom-id="Zoom-1" href="{{$admin_image}}" data-image="{{$admin_image}}"><img srcset="{{$admin_image}}" src="{{$admin_image}}" /></a>
									     @endforeach
									        </div>
									    </div>
			                        </div>
			                    </div>
			                </div>
                                       

			                <div class="col-sm-7">
			                    <!-- product_details_info start -->
			                    <div class="product_details_info">
				                    	<div class="fieldset_border">
					                        <span class="cart_heart"><i class="fa fa-heart-o"></i></span>
				                        	<span class="spn-width-ribbon"><h3>{{@$product['item_name']}}</h3></span>
				                        	@if(!empty($product['product_brand_id']) && $product['product_brand_detail']!=null && !empty($product['product_brand_detail']['brand_name']))
				                        		<span class="spn-width-ribbon text-success"><h4>{{@$product['product_brand_detail']['brand_name']}}</h4></span>
				                        	@endif
				                        	@if(@$product['ribbon'])
				                        	<span class="badge badge-danger badge_view_prdct">{{@$product['ribbon']}}</span>
				                        	@endif
					                        <!-- pro_rating start -->

		    									<?php
		    										 
		                                          	$UserRating = App\UserRating::with('user_name')->where('product_id',$product['id'])->orderBy('id', 'desc')->take(3)->get();
		                                            
		                                            $UserRatingContt = App\UserRating::with('user_name')->where('product_id',$product['id'])->get()->count();
		                                          	
		                                          	$UserRatingSum = App\UserRating::with('user_name')->where('product_id',$product['id'])->get()->sum('rating');
		                                          	
		                                          	$UserRatingCount = App\UserRating::with('user_name')->where('product_id',$product['id'])->get()->count();

		                                          	if($UserRatingCount==0){
		                                          	    $UserRatingCount =1;
		                                          	}
		                                          	$Average = $UserRatingSum / $UserRatingCount;

		                                          	if($Average<2){
		                                          	    $Average =0;
		                                          	}

                                                  
		                                          	$productCategories      = App\ProductCategory::where('status', 'active')
		                                          	                                               ->orderBy('name', 'asc')
		                                          	                                               ->get();
		                                          	           
		                                          	                                              

		                                          	$slcted_category_id = [];
		                                          	 if(!empty($product)){
		                                          	     $slcted_category_id = array_map(function($v){ return $v['category_id']; }, $product['product_selected_categories']);
		                                          	 }

		                                          	 $prdctCategory =  App\ProductCategory::whereIn('id',$slcted_category_id)->pluck('name')->toArray();

		                                          	 $productCategoryImplode = implode(", ",$prdctCategory);     


		                                          	$productSubCategories   = App\ProductSubCategory::where('status', 'active')
		                                          	                            ->orderBy('name', 'asc')
		                                          	                            ->get();

		                                          	 $slcted_Subcategory_id = [];
		                                          	  if(!empty($product)){
		                                          	      $slcted_Subcategory_id = array_map(function($v){ return $v['subcategory_id']; }, $product['product_selected_sub_categories']);
		                                          	  }

		                                          	  $prdctSubCategory =  App\ProductSubCategory::whereIn('id',$slcted_Subcategory_id)->pluck('name')->toArray();

		                                          	  $productSubCategoryImplode = implode(", ",$prdctSubCategory);  
		                                          	                                            

                                                    $productKeyword  = App\ProductKeyword::where('product_id',$product['id'])
                                                                                ->orderBy('keyword_name', 'asc')
                                                                                ->get()
                                                                                ->pluck('keyword_name')->toArray();

		                                          	$productKeywordImplode = implode(", ",$productKeyword);  

                                                    // product_selected_keywords

		    									?>

		    								
		    								<div class="prdt_catgry">
    									
    											<span>{{@$productCategoryImplode}} /</span>
    									         
                     							<span> {{@$productSubCategoryImplode}} /</span>					
    									
                                                
                                                @if(isset($product['product_selected_selling_materials']) && sizeof($product['product_selected_selling_materials'])>0)
                                                	@foreach($product['product_selected_selling_materials'] as $key => $productSellingMaterial)
                                                        @if(!empty($productSellingMaterial))
		    												<span> {{@$productSellingMaterial['product_selling_material_detail']['selling_material_name']}}</span>
                                                        @endif
                                                    @endforeach       
                                                @endif              

		    								</div>
		    							

					                        <div class="pro_rating d-flex">
					                            <ul class="star_list list-inline">
   								    				<span id="prev_rate32" data-rating="{{ $Average }}"> 
   								    			</ul> 
   								    			<script type="text/javascript" src="{{asset('public/frontend/js/jquery-2.2.3.min.js')}}"></script>

   								    			<script type="text/javascript">
   								    			   $(document).ready(function(){
   								    			        $("#prev_rate32").rateYo({
   								    			          rating: "{{ $Average }}",
   								    			          ratedFill: "#fac219", 
   								    			          starWidth: "20px",
   								    			          spacing: "5px",
   								    			          readOnly: true
   								    			         });
   								    			   });
   								    			</script>	
                                                           
   								    			<ul class="list-inline ml10">
   								    				@if($Average>1)
   								    				<li class="list-inline-item">
   					                            		<span class="rat_qun">   (Based on {{number_format($Average,1)}} Ratings) </span>
   					                            	</li>
   					                            	@endif
   					                            </ul>
					                        </div>
					                        <!-- pro_rating end -->
					                        <div class="pro_details">
					                            <p>
					                            	<!-- <i class="fa fa-check"></i>  -->
					                            @if($product['item_detail']!=null)
					                            {!!@$product['item_detail']!!}
					                            @endif

					                            @if($product['item_Arabic_detail']!=null)
					                            {{@$product['item_Arabic_detail']}}
					                            @endif
					                            </p>
					                            <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. -->
					                            <!-- <p><i class="fa fa-check"></i> Lorem ipsum dolor sit amet adipisicing elit.</p> -->
					                            <!-- <p><i class="fa fa-check"></i> Ipsum Lorem dolor consectetur adipisicing elit.</p> -->
					                            <!-- <p><i class="fa fa-check"></i> Dolor sit amet  adipisicing elit.</p> -->
					                        </div>

					                        <div class="wrap_divison">
					                        	<div class="desc_bor">
					                        		<h3>Product Details</h3>

					                        		@if(!empty($product['description_en']))
					                        		    {!!@$product['description_en']!!}
					                        		@else
					                        		    {!!@$product['description_en']!!}
					                        		@endif 
					                        	</div>
					                        </div>
                                           

					                        <ul class="pro_dtl_prize">
					                            <li class="old_prize"></li>
					                            @if($product['defualt_selling_unit_price']!='')
					                               <li>SR {{@$product['defualt_selling_unit_price']}}
					                               </li>
					                            @endif

					                            @if(@$product['product_price_ranges'][0]['final_price']!='')
					                               <li class="finalPrice" value="{{@$product['product_price_ranges'][0]['final_price']}}">SR {{@$product['product_price_ranges'][0]['final_price']}}
					                               </li>
					                            @endif
					                        </ul>
					                        <?php 
					                              

					                         ?>
						                    <div class="finl_rslt">
						                    	<p class=""><strong>Total:</strong> Each </p>
						                    </div>
							                        	    <?php ?> 
					                        <div class="prod_quant bordr_sectn">
					                        	<div class="row">
							                        <div class="col-sm-2">

							                        	<label>Quantity:</label>
							                        	<!-- <input type="number" placeholder="3" class="form-control" name="" min="0"> -->
							                        	<select name="experience" class="form-control custom-select">
							                        	     <option value="" selected disabled>Select Quantity</option>
							                        	     @for($i=$product['minimum_buying_quantity_number']; $i <=$product['available_quantity_number'] ; $i++)
							                        	         <option class="minQuantity" @if($product['minimum_buying_quantity_number']==$i) selected="" @endif value="{{$i}}">{{$i}}</option>

							                        	     @endfor
							                        	 </select>
							                        </div>
							                        <div class="col-sm-5">
							                        	<label>Unit:</label>
							                        	<input type="text" placeholder="3" class="form-control" name="" readonly="" value="{{$product['minimum_buying_quantity_unit_detail']['name']}}">
							                        </div>

							                        @if(!empty($product['product_color_id']) && $product['product_color_detail']!=null && !empty($product['product_color_detail']['name']))
							                        <div class="col-sm-2">
							                        	<label>Color:</label>
							                        	<p>{{@$product['product_color_detail']['name']}}</p>
							                        </div>
							                        @endif
							                    </div>
					                        </div>
					                        <div class="prdt_dtlls my-3">
					                        	<div class="spn-width-prdct bordr_sectn">
					                        		<h6 class="mb-2 text-danger">Product Information:</h6>
						                        	<span>Product Bar Code: <strong class="fnt-weigh-paramtr">{{@$product['item_bar_code']}}</strong></span>
						                        	<span>Product Seller Code: <strong class="fnt-weigh-paramtr">{{@$product['seller_item_code']}}</strong></span>
						                        	<span>Seller Memebership ID: <strong class="fnt-weigh-paramtr">{{@$product['user_detail']['supplier_code']}}</strong></span>
						                        	<span>Seller Name: <strong class="fnt-weigh-paramtr">{{ucfirst(@$product['user_detail']['contact_name'])}} {{ucfirst(@$product['user_detail']['contact_last_name'])}}</strong></span>
                                                    
                                                    @if(!empty(@$productKeywordImplode))
						                        		<span>Keywords: <strong class="fnt-weigh-paramtr">{{@$productKeywordImplode}}</strong></span>
                                                    @endif
						                        	@if(!empty($product['user_store_location_id']) && $product['user_store_location_detail']!=null && !empty($product['user_store_location_detail']['store_name']))
						                        		<span>Store Name: <strong class="fnt-weigh-paramtr">{{@$product['user_store_location_detail']['store_name']}}</strong></span>
						                        	@endif

						                        	@if(!empty($product['country_id']) && $product['country_detail']!=null && !empty($product['country_detail']['name']))
						                        		<span>Country of Origin: <strong class="fnt-weigh-paramtr">{{@$product['country_detail']['name']}}</strong></span>
						                        	@endif
                                                     
                                                    @if(!empty($product['product_grade_id']) && $product['product_grade_detail']!=null && !empty($product['product_grade_detail']['grade_name']))
						                        		<span>Classification: <strong class="fnt-weigh-paramtr">{{@$product['product_grade_detail']['grade_name']}}</strong></span>
						                        	@endif

						                        </div>
						                        <div class="spn-width-parameters bordr_sectn">
					                        		<h6 class="mb-2 text-danger">Product Parameters:</h6>
					                        		
					                        		@if(!empty($product['diameter_number']) && !empty($product['diameter_unit_id']) && $product['diameter_unit_detail']!=null && !empty($product['diameter_unit_detail']['name']))
						                        		<span>Diameter: <strong class="fnt-weigh-paramtr">{{@$product['diameter_number']}} {{@$product['diameter_unit_detail']['name']}}</strong></span>
						                        	@endif
                                                    
                                                    @if(!empty($product['length_number']) && !empty($product['length_unit_id']) && $product['length_unit_detail']!=null && !empty($product['length_unit_detail']['name']))
						                        		<span>Length: <strong class="fnt-weigh-paramtr">{{@$product['length_number']}} {{@$product['length_unit_detail']['name']}}</strong></span>
						                        	@endif	

						                        	@if(!empty($product['width_number']) && !empty($product['width_unit_id']) && $product['width_unit_detail']!=null && !empty($product['width_unit_detail']['name']))
						                        		<span>Width: <strong class="fnt-weigh-paramtr">{{@$product['width_number']}} {{@$product['width_unit_detail']['name']}}</strong></span>
						                        	@endif	
                                                    
                                                    @if(!empty($product['depth_number']) && !empty($product['depth_unit_id']) && $product['depth_unit_detail']!=null && !empty($product['depth_unit_detail']['name']))
						                        		<span>Depth: <strong class="fnt-weigh-paramtr">{{@$product['depth_number']}} {{@$product['depth_unit_detail']['name']}}</strong></span>
						                        	@endif
                                                    
                                                    @if(!empty($product['height_number']) && !empty($product['height_unit_id']) && $product['height_unit_detail']!=null && !empty($product['height_unit_detail']['name']))
						                        		<span>Height: <strong class="fnt-weigh-paramtr">{{@$product['height_number']}} {{@$product['height_unit_detail']['name']}}</strong></span>
						                        	@endif
                                                    
                                                    @if(!empty($product['thickness_number']) && !empty($product['thickness_unit_id']) && $product['thickness_unit_detail']!=null && !empty($product['thickness_unit_detail']['name']))
						                        		<span>Thickness: <strong class="fnt-weigh-paramtr">{{@$product['thickness_number']}} {{@$product['thickness_unit_detail']['name']}}</strong></span>
						                        	@endif

                                                    @if(!empty($product['particle_number']) && !empty($product['particle_unit_id']) && $product['particle_unit_detail']!=null && !empty($product['particle_unit_detail']['name']))
						                        		<span>Particles: <strong class="fnt-weigh-paramtr">{{@$product['particle_number']}} {{@$product['particle_unit_detail']['name']}}</strong></span>
						                        	@endif
						                        </div>
						                        @if(isset($product['product_specifications']) && sizeof($product['product_specifications'])>0)
                                                <div class="table-responsive table_seler price_table mt-3">
					                        		<h6 class="mb-2 text-danger">Additional Info Sections:</h6>
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Description</th>
                                                                <th>Attachment</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="product_spec specification_class">
                                                    	@foreach($product['product_specifications'] as $key => $specification)
                                                    	    @if(!empty($specification))
                                                            <tr>
                                                               <td>{{@$specification['title']}}</td>
                                                               <td><pre>{{@$specification['description']}}</pre></td>
                                                               <td>
                                                                    @if(!empty($specification['image']) && file_exists(productSpecificationImgsBasePath.'/'.$specification['image']))
                                                                        <?php 
                                                                            $array = explode('.', $specification['image']);
                                                                            $extension = end($array);
                                                                        ?>
                                                                        @if($extension=='docx' || $extension=='doc')
                                                                            <a href="{{productSpecificationImgsPath.'/'.$specification['image']}}" target="_blank"><img src="{{asset('/public/frontend/img/document_thumbnail.png')}}" class="img-fluid"></a>
                                                                        @elseif($extension=='pdf')
                                                                            <a href="{{productSpecificationImgsPath.'/'.$specification['image']}}" target="_blank"><img src="{{asset('/public/frontend/img/pdf-thumbnail.jpeg')}}" class="img-fluid"></a>
                                                                        @else
                                                                            <img src="{{productSpecificationImgsPath.'/'.$specification['image']}}" class="img-fluid">
                                                                        @endif
                                                                    @else
                                                                        --
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                           <!--  <tr>
                                                                <td>Lorem ipsum</td>
                                                                <td>Lorem ipsum Lorem ipsum</td>
                                                                <td><img src="https://pro.promaticstechnologies.com/build_mart/public/frontend/img/document_thumbnail.png"></td>
                                                            </tr> -->
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @endif 
					                        </div>
					                        <ul class="pro_dtl_btn">
					                        	<div class="min_buy">
					                        		<p class="mb-0">
					                        			<strong>Minimum buying quantity:</strong> {{@$product['minimum_buying_quantity_number']}}
					                        		</p>
					                        	</div>
					                        	<br>
					             
					                        	<button class="btn btn_theme productCart" product="{{$product['id']}}"><span><i class="fa fa-shopping-cart"></i></span></button>
					                        	<button class="btn btn_theme"><span>Buy Now</span></button>
					                        	<a><button class="btn btn_theme" data-toggle="modal" data-target="#askQuote"><span>Ask for Quote</span></button></a>
					                        </ul>
					                    </div>


				                    <!--     <div class="wrap_divison">
				                        	<div class="desc_bor">
				                        		<h3>Product Details</h3>

				                        		@if(!empty($product['description_en']))
				                        		    {!!@$product['description_en']!!}
				                        		@else
				                        		    {!!@$product['description_en']!!}
				                        		@endif 
				                        	</div>
				                        </div>
			                          -->
                                   @if(empty($UserRating!=null))
			                        <div class="desc_bor">
										<h3>Rating and Reviews <a class="float-right smal">{{$UserRatingCount}} Review</a></h3>
										<ul type="none" class="rev_ul pl0">
																				
	                                         @foreach($UserRating as $key=> $rating)

												<li>
													<span class="rev_img">
													  	@if(Auth::check() && !empty($rating['user_name']['profile_image']) && file_exists(public_path('frontend/imgs/userProfile/'.$rating['user_name']['profile_image'])))
	                                                        <img src="{{asset('public/frontend/imgs/userProfile/'.$rating['user_name']['profile_image'])}}" class="img-fluid" id="prof_ch">
	                                                    @else
	                                                        <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" id="prof_ch">
	                                                    @endif
													</span>

													<div class="rev_person">
														<h5 class="rev_nam">{{ucfirst($rating['user_name']['first_name'])}} {{ucfirst($rating['user_name']['last_name'])}} </h5>

	                                                    <ul class="star_list list-inline pl0">
															<span class="str_rev productRating_{{$rating['product_id']}}" id="prev_rate{{$key}}" data-rating="{{ $rating['rating'] }}">
										    			</ul> 

										    			<?php
										    			       
										    			    if(!empty($rating['rating'])){
										    			        $usr_rate = $rating['rating'];
										    			    } else{
										    			        $usr_rate = 0;
										    			    }
										    			?>

										    			<p class="rev_text">{{$rating['review']}}.</p>
														<script type="text/javascript" src="{{asset('public/frontend/js/jquery-2.2.3.min.js')}}"></script>

														<script type="text/javascript">
														    $(document).ready(function(){
														         $("#prev_rate{{$key}}").rateYo({
														           rating: "{{ $usr_rate }}",
														           ratedFill: "#fac219", 
														           starWidth: "20px",
														           spacing: "5px",
														           readOnly: true
														          });
														    });
														</script>	

													</div>


												</li>
											@endforeach

												@if($UserRatingContt >3)
													<p class="vm_rev view_more_rating">View More +</p>
												@endif
											</ul>
									</div>
									@endif
			                    </div>
			                    <!-- product_details_info end -->
			                </div>
			            
						</div>
                        <!--  -->
                    </div>
                </div>
            </section>
          @if($sellerList!=null)
            <section class="prods_dtl_page_sec sec_gray">
                <div class="container">
                	<div class="page_heading text-center">
                        <!-- <span>Quality Products</span> -->
                        <h1 class="text-uppercase">Price from other Sellers for same Product</h1>
                    </div>
                	<div class="wrap_oth_sellr">
                		<div class="latst_pap_pdf">
                        	<ul type="none">

                        		@foreach($sellerList as $list)
                        		<li class="sing_li_pdf d-flex align-items-center">

	                        		<?php 
	                        	       $sellerData = App\User::where('id',$list['user_id'])->first();
	                        	       $result= $product['productpricerange'][0]['final_price']-$list['productpricerange'][0]['final_price'];
	                        	       // dd($result);
	                        		?>
                        			<div class="img_top col_img">
						    			<img src="https://cdn.clipart.email/79acc8b305d99c059ca8c94de64e2409_logo-construction-logo-vector-png-transparent-png-559x451-_820-441.jpeg" class="img-fluid" alt="seller logo">
						    		</div>
						    		
						    		<div class="meta_Buk col_mid">
						    			<h5>{{$sellerData['company_name']}}</h5>

						    			<p class="bokos_desc">{{$sellerData['about_me']}}</p>
						    			<a class="btn btn_theme" href="{{url('user/productseller/detail/'.base64_encode($list['user_id']))}}"><span>View Seller</span></a>
						    		</div>
						    		<div class="col_lst text-right">
						    			<span class="">Price: SR 20 - SR {{$list['productpricerange'][0]['final_price']}}</span>
						    			<span class="">Difference: SR {{$result}}</span>
						    		</div>
                        		</li>
                        		@endforeach

                        	</ul>
                        </div>
                	</div>
                </div>
            </section>
            @endif
        </div>
        @if(Auth::check()) 
           <input  type="hidden" class="userId" name="userId" value="{{Auth::user()->id}}">
        @else 
    	    <input  type="hidden" class="userId" name="userId" value="{{$_COOKIE['guestId']}}">
        @endif

           

        <div class="modal" id="askQuestion">
             <form method="post" id="questionform" action="{{url('provider/ask/question/seller')}}">
                @csrf
                <div class="modal-dialog cout_info">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Question</h4>
                            <button type="button" class="close closeAskQuestion"  data-dismiss="modal">&times;</button>
                        </div>
                         <!-- Modal body -->
                        <input type="hidden" name="seller_id" value="{{base64_encode(@$product['user_id'])}}">
                        
                       
                            @if(Auth::check()) 
                               <input type="hidden" name="user_id" value="{{base64_encode(Auth::user()->id)}}">
                            @else 
                        	    <input type="hidden" name="user_id" value="{{$_COOKIE['guestId']}}">
                            @endif

                        <div class="modal-body">
                            <div class="country_div">
                               <div class="form-group">
                                    <label>Question</label>
                                    <textarea class="form-control text-align:left"  rows="4" name="description" placeholder="Please enter question"></textarea>
                               </div>
                            </div>
                        </div>
                            <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="Submit" id="send_btn" class="btn btn-danger">Send</button>
                        </div>
                    </div>
                </div>
            </form>    
        </div>

		<!-- Use Card modal -->
		<div class="modal fade edit_div" id="askQuote">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title" id="exampleModalCenterTitle">Ask For Quote</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body">
		                <div class="quote_ask d-flex justify-content-center pb-4">
		                	<!-- <a href="javascript:;">Chat</a>
		                	<a href="javascript:;">Write a Question</a> -->
			                <a class="btn btn_theme updt_default_card ml-1" data-dismiss="modal" data-toggle="modal" data-target="#askQuestion" >
			                	<span>Write a Question</span>
			                </a>
			                <a href="{{url('/user/messages?to_user='.base64_encode(@$product['user_id']))}}" class="btn btn_theme updt_default_card ml-1">
			                	<span>Chat</span>
			                </a>
		                </div>
		            </div>
		           <!--  <div class="modal-footer justify-content-center">
		            </div> -->
		        </div>
		    </div>
		</div>

@include('frontend.include.modals.view_review_rating')
@stop

@section('script')
        
        <script>
         	$(document).on('click', '.view_more_rating', function(){
          	    $('#reviewRating').modal('show');
           })
        </script>


		<script>
		   $(document).on('click','#send_btn', function(){
		       $('#questionform').submit();
		   })
		</script>

		<script type="text/javascript">
		    $('#questionform').validate({
		        ignore:[],
		        rules:{
		            "description":{
		                required:true,
		                maxlength:5000,
		            },
		        },
		        messages:{
		            "description":{
		                required:"Please enter question",
		                maxlength:"Maximum 5000 characters are allowed",
		            },
		        },
		    });
		</script>
			

		<script type="text/javascript">
           
           $(document).ready(function(){ 
               var ths;
               $( ".productCart" ).click(function() {
                
                 var productId    =  $(this).attr('product');
                 var userId     = $('.userId').val();
                   $.ajax({
                           url: "{{url('/cart/add-Product')}}",
                           type:'post',
                           data:{productId:productId,userId:userId,_token:"{{ csrf_token() }}" },
                           success:function(response){
                               if(response['status']=="true") {   
	                              if (window.location.href.indexOf('reload')==-1) {
	                                   window.location.replace(window.location.href+'?reload');
	                              } 
                                   toastr.success(response.msg); 
                                   $('.cart-count').html('<span class="cart-count" style="color: red;">'+response.count+'</span>');
                               }else{
                                   toastr.error(response.msg);
                               }
                           }
                       })
               });
           })

		</script>

	    <script type="text/javascript">
	    var minimumQuantiy = $('.minQuantity').val();
        var finalPrice = $('.finalPrice').val();
        var Newprice = minimumQuantiy *finalPrice;

        var SR ='SR'
        $('.finalPrice').html(SR+Newprice);
           // alert(selectNumber);
        $('select').on('change', function() {
           var selectNumber = $(this).val();
           var quantityChangePrice = finalPrice*selectNumber;           
           $('.finalPrice').html(SR+quantityChangePrice);
         });
	    </script>

        <script type="text/javascript">
			$(document).ready(function() {
			    var sync1 = $("#sync1");
			    var sync2 = $("#sync2");
			    var slidesPerPage = 4; //globaly define number of elements per page
			    var syncedSecondary = true;

			    sync1.owlCarousel({
			        items: 1,
			        slideSpeed: 2000,
			        nav: true,
			        autoplay: false, 
			        dots: false,
			        loop: true,
			        responsiveRefreshRate: 200,
			    }).on('changed.owl.carousel', syncPosition);

			    sync2
			        .on('initialized.owl.carousel', function() {
			            sync2.find(".owl-item").eq(0).addClass("current");
			        })
			        .owlCarousel({
			            items: slidesPerPage,
			            dots: false,
			            nav: false,
			            smartSpeed: 200,
			            slideSpeed: 500,
			            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
			            responsiveRefreshRate: 100
			        }).on('changed.owl.carousel', syncPosition2);

			    function syncPosition(el) {
			        //if you set loop to false, you have to restore this next line
			        //var current = el.item.index;

			        //if you disable loop you have to comment this block
			        var count = el.item.count - 1;
			        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

			        if (current < 0) {
			            current = count;
			        }
			        if (current > count) {
			            current = 0;
			        }

			        //end block

			        sync2
			            .find(".owl-item")
			            .removeClass("current")
			            .eq(current)
			            .addClass("current");
					        var onscreen = sync2.find('.owl-item.active').length - 1;
					        var start = sync2.find('.owl-item.active').first().index();
					        var end = sync2.find('.owl-item.active').last().index();

					        if (current > end) {
					            sync2.data('owl.carousel').to(current, 100, true);
					        }
					        if (current < start) {
					            sync2.data('owl.carousel').to(current - onscreen, 100, true);
					        }
					    }

					    function syncPosition2(el) {
					        if (syncedSecondary) {
					            var number = el.item.index;
					            sync1.data('owl.carousel').to(number, 100, true);
					        }
					    }

					    sync2.on("click", ".owl-item", function(e) {
					        e.preventDefault();
					        var number = $(this).index();
					        sync1.data('owl.carousel').to(number, 300, true);
					    });
					});
		</script>

@stop
