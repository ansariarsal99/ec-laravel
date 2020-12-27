@extends('frontend.layout.layout')
@section('title','Product List')
@section('content')

<style>
    .product_list_slider .owl-carousel .owl-item img {
        object-fit: cover;
        height: 450px;
        max-width: 302px;
        max-height: 450px;
    }
    .product_list_slider .pos_abs_hero h2 {
        font-size: 25px;
    }
    .servc_tag {
        background: #cc3f2f;
        color: #fff;
        padding: 1px 7px;
        font-weight: 500;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 5px;
    }
    .cmpr_chk .custom-control-input {
        opacity: 0;
        width: 100%;
        z-index: 0;
    }
</style>
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Building Material</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>
            </div>
            <section class="prods_page_sec">
                <div class="custom_container">
                    <div class="wrp_product_lst">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="filtr_left consul_fltrs">
                                    <fieldset>
                                        <h5>Narrow Result</h5>
                                        <div class="fltrs_accordn">
                                            <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                        Category
                                                      </a>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                    <label class="custom-control-label" for="heck1">Conduit Pipes and Fittings</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                    <label class="custom-control-label" for="heck2">Metal Boxes</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                    <label class="custom-control-label" for="heck3">Wires and Cables</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                    <label class="custom-control-label" for="heck4">Switches and Sockets</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                    <label class="custom-control-label" for="heck2">Switch Gear (DB/MCB/RCCB etc.)</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                    <label class="custom-control-label" for="heck3">Electric Panels</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                    <label class="custom-control-label" for="heck4">Others</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                        Brands
                                                      </a>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                    <label class="custom-control-label" for="customCheck4">Crompton </label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                    <label class="custom-control-label" for="customCheck5">Anhor</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                    <label class="custom-control-label" for="customCheck4">Finecab </label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                    <label class="custom-control-label" for="customCheck5">Finolex</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                    <label class="custom-control-label" for="customCheck4">GM Modular</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                    <label class="custom-control-label" for="customCheck5">Havells</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                    <label class="custom-control-label" for="customCheck4">Hosper</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                    <label class="custom-control-label" for="customCheck5">Orpat Electricals</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
                                                        Customer Rating
                                                      </a>
                                                    </div>
                                                    <div id="collapse3" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck6" name="example1">
                                                                    <label class="custom-control-label" for="customCheck6">1 <i class="fa fa-star"></i></label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck7" name="example1">
                                                                    <label class="custom-control-label" for="customCheck7">2 <i class="fa fa-star"></i></label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck8" name="example1">
                                                                    <label class="custom-control-label" for="customCheck8">3 <i class="fa fa-star"></i></label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck9" name="example1">
                                                                    <label class="custom-control-label" for="customCheck9">4 <i class="fa fa-star"></i></label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck10" name="example1">
                                                                    <label class="custom-control-label" for="customCheck10">5 <i class="fa fa-star"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="collapsed card-link" data-toggle="collapse" href="#collapse4">
                                                        Discount
                                                      </a>
                                                    </div>
                                                    <div id="collapse4" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom1" name="example1">
                                                                    <label class="custom-control-label" for="custom1">10% off or more</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">20% off or more</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom1" name="example1">
                                                                    <label class="custom-control-label" for="custom1">30% off or more</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">50% off or more</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="collapsed card-link" data-toggle="collapse" href="#collapse6">
                                                        Sellers
                                                      </a>
                                                    </div>
                                                    <div id="collapse6" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom1" name="example1">
                                                                    <label class="custom-control-label" for="custom1">Appario</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">Buyfeb</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom1" name="example1">
                                                                    <label class="custom-control-label" for="custom1">Cloudtail</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">Gizmeup</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">TheGiftKart</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="collapsed card-link" data-toggle="collapse" href="#collapse5">
                                                        Price
                                                      </a>
                                                    </div>
                                                    <div id="collapse5" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom3" name="example1">
                                                                    <label class="custom-control-label" for="custom3">SR 750.00 - SR 1000</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">SR 1000.00 - SR 2000</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom4" name="example1">
                                                                    <label class="custom-control-label" for="custom4">SR 2000 - SR 10000</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">SR 10000 - SR 50000</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </fieldset>

                                     <?php
                                        $data = App\UserAdvertisement::where('advertisement_appearence_id',2)->get()->toArray();         
                                        $currentDate = date('Y-m-d H:i:s');
                                        $admin_image = '';
                                     ?> 

                                    <div class="hero_img pos_rel product_list_slider my-3">
                                        <div class="owl-carousel owl_slide">

                                            @foreach ($data as $key => $value)                         
                                                <?php 
                                                    $admin_image  = frontendAdvertImagePath.'/'.$value['image']; 
                                                 ?>         
                                                @if ($value['publish_date'] <= $currentDate && $value['expiry_date'] >= $currentDate) 
                                                    <div class="item pos_rel">
                                                        <figure class="pos_rel">
                                                            <img src="{{$admin_image}}" class="img-fluid">
                                                        </figure>
                                                        <div class="pos_abs_hero d-flex flex-column align-items-center justify-content-center">
                                                           <h2> {{@$value['title']}}</h2>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-9">
                                <div class="prods_main_rgt">
                                    <div class="comare_div mb-4 compareButton" >
                                        <div class="comp_prodcuts">
                                            <h3> <span class="countproducts"></span> products have been added to compare list.</h3>
                                        </div>
                                        <!-- <div class="text-right log_btn"> -->
                                            <a href="{{url('/compare/product/Listing')}}" class="btn btn_theme edt_prof_sbmt_btn"><span>View Comparison</span></a>
                                        <!-- </div> -->
                                    </div>
                                    
                                    <div class="sor_ser_flr d-flex justify-content-end">
                                        <div class="dropdown">
                                              <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                                                Sort
                                              </span>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">New Products</a>
                                                <a class="dropdown-item" href="#">Price High to Low</a>
                                                <a class="dropdown-item" href="#">Price Low to High</a>
                                                <a class="dropdown-item" href="#">By Rating</a>
                                              </div>
                                        </div> 
                                        <div class="dropdown">
                                            <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-filter"></i>&nbsp; Filter By
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-header">Weight</div> 
                                                <a class="dropdown-item" href="#">5 kg</a>
                                                <a class="dropdown-item" href="#">10 kg</a>
                                                <a class="dropdown-item" href="#">20 kg</a>
                                                <a class="dropdown-item" href="#">50 kg</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row ">
                                       
                                        @foreach($products as $key => $product)
                                            
                                        <?php                                               
                                            if (!empty($product['product_images'][0]['name'])) {
                                                $imgpath= 'public/frontend/images/products'.'/'.$product['product_images'][0]['name'];  
                                            }                                                                                        
                                            if(!empty($product['product_images'][0]['name']) && file_exists($imgpath) ) { 
                                                $admin_image = productImgsPath.'/'.$product['product_images'][0]['name'];    
                                            }else{
                                                $admin_image = defaultAdminImagePath.'/no_image.png';  
                                                // dd($admin_image);
                                            }                                           
                                        ?>
                                          
                                        <div class="col-sm-4 productRow">
                                            <div class="blog_article_wrap">
                                                <div class="blog_article_img_container pos_rel">
                                                    <a href="{{url('/view/productDeatil/'.base64_encode($product['id']))}}" class="" >
                                                        <img src="{{$admin_image}}" class="img-fluid">
                                                       
                                                    </a>
                                                    <?php
                                                        if(Auth::check()){
                                                            $userId = Auth::User()->id;

                                                            $wishlisted = App\ProductWishlist::where('user_id',$userId)->where('product_id',$product['id'])->first();

                                                            if(!empty($wishlisted)){
                                                                $icon = 'fa fa-heart';
                                                            }else{
                                                                $icon = 'fa fa-heart-o';
                                                            }
                                                        }else{
                                                             $userId  = $_COOKIE['guestId'];

                                                             $wishlisted = App\ProductWishlist::where('user_id',$userId)->where('product_id',$product['id'])->first();

                                                             if(!empty($wishlisted)){
                                                                 $icon = 'fa fa-heart';
                                                             }else{
                                                                 $icon = 'fa fa-heart-o';
                                                             }
                                                        }
                                                    ?>

                                                   @if($product['type'] !='service')
                                                    <span class="pos_abs_wish"><i class="
                                                    {{$icon}} wishlisted" data-id="{{$product['id']}}"></i>
                                                    </span>
                                                    @endif 
                                                </div>
                                                <div class="blog_article_body">
                                                    <a class="article_title" href="{{url('/view/productDeatil/'.base64_encode($product['id']))}}">{{$product['item_name']}}</a>

                                                  @if($product['type'] =='service')
                                                    <!-- {{$product['type']}} -->
                                                    <span class="servc_tag">Service</span>
                                                  @endif


                                                  <?php
                                                       
                                                          $UserRating = App\UserRating::with('user_name')->where('product_id',$product['id'])->get()->toArray();
                                                          
                                                          $UserRatingSum = App\UserRating::with('user_name')->where('product_id',$product['id'])->get()->sum('rating');
                                                          
                                                          $UserRatingCount = App\UserRating::with('user_name')->where('product_id',$product['id'])->get()->count();

                                                          if($UserRatingCount==0){
                                                              $UserRatingCount =1;
                                                          }

                                                          $Average = $UserRatingSum / $UserRatingCount;
                                                          if($Average<2){
                                                              $Average =0;
                                                          // dd($UserRatingCount);
                                                          }
                                                      
                                                  ?>


                                                    <div class="ratng_star align-items-center d-flex justify-content-between">
                                                        <div class="star_color" data-toggle="tooltip" title="{{number_format(@$Average,1)}} out of 5 stars" id="prev_rate32{{$key}}" data-rating="{{ @$Average }}">
                                                            <span class="star_rev">
                                                              <script type="text/javascript" src="{{asset('public/frontend/js/jquery-2.2.3.min.js')}}"></script>

                                                                <script type="text/javascript">
                                                                   $(document).ready(function(){
                                                                        $("#prev_rate32{{$key}}").rateYo({
                                                                          rating: "{{ @$Average }}",
                                                                          ratedFill: "#fac219", 
                                                                          starWidth: "20px",
                                                                          spacing: "5px",
                                                                          readOnly: true
                                                                         });
                                                                   });
                                                                </script>   
                                                            </span>
                                                            <span class="rev_nmbr"> {{@$Average}}</span>
                                                        </div>

                                                        @if($product['type'] !='service')
                                                        <span class="qty_sp">
                                                           {{@$product['minimum_buying_quantity_number']}}  {{@$product['selling_unit_product']['name']}}
                                                        </span>
                                                         @endif
                                                    </div>

                                                    <div class="rt_qty  d-flex justify-content-between align-items-center">
                                                        @if($product['type'] !='service')
                                                        <div>
                                                          
                                                          @if($product['defualt_selling_unit_price']!='')   
                                                            <p class="rat_prod"> 

                                                            <?php 
                                                               $minQunatity = $product['minimum_buying_quantity_number'];
                                                               $productPrice = $product['defualt_selling_unit_price'];
                                                               $newCalulatedPrice = $productPrice*$minQunatity;
                                                            ?>                   
                                                             SR{{@$newCalulatedPrice}} <del>SR 95.50</del>
                                                            </p>
                                                          @endif

                                                           @if(@$product['productpricerange'][0]['final_price']!='')
                                                                <?php 
                                                                   $minQunatity = $product['minimum_buying_quantity_number'];
                                                                   $productPrice = $product['productpricerange'][0]['final_price'];
                                                                   $newCalulatedPrice = $productPrice*$minQunatity;
                                                                ?>
                                                            <p class="rat_prod finalPrice" product_price="$newCalulatedPrice">
                                                                SR{{$newCalulatedPrice}} <del>SR 95.50</del>
                                                                <input type="hidden" name="" value="{{$newCalulatedPrice}}" class="calculatedPrice" priceId="price_id{{$product['id']}}">
                                                            </p>
                                                          @endif  
                                                            <span>+ SR 20.76 Shipping</span>
                                                        </div>
                                                        <a class="str_numbrs">2 Stores</a>
                                                        @endif
                                                    </div>


                                                    <div class="cmpr_chk d-flex justify-content-between align-items-center">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" @if(in_array($product['id'],$selectedProductIds)) checked="" @endif class="custom-control-input compareCheck" product_id="{{$product['id']}}" id="customCheck{{$key}}" name="compareProduct[]">
                                                            <label class="custom-control-label" for="customCheck{{$key}}">Compare Product</label>
                                                        </div>
                                                      
                                                        @if($product['type'] =='product')
                                                        <div>
                                                            <span class="ad_cart">
                                                                <i class="fa fa-shopping-cart productCart" product="{{$product['id']}}" data-toggle="tooltip" title="Add to Cart"></i>
                                                            </span>
                                                        </div>
                                                        @endif

                                                        @if($product['type'] =='service')
                                                        <div class="compQareButton" >
                                                            <!-- <div class="text-right log_btn"> -->
                                                                <a href="{{url('/compare/product/Listing')}}" class="btn btn_theme "><span>Book</span></a>
                                                            <!-- </div> -->
                                                        </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="pg-sec background-white p-4">
                       <div class="numbr_pagintn mt-3">
                           {{ $product_page->appends(request()->input())->links() }}
                       </div>
                    </section>

                </div>
            </section>
          <input  type="hidden" class="productIdClass" name="subscriptionPackId">
          @if(Auth::check())
              <input  type="hidden" class="userId" name="userId" value="{{Auth::user()->id}}">
          @else
              <input  type="hidden" class="userId" name="userId" value="{{$_COOKIE['guestId']}}">

          @endif
        </div>

@stop

@section('script')

        <script type="text/javascript">
          
            $('.selectQuantity').on('change', function() {

                // var selectNumber = $(this).val();
                // var price = $(this).closest('.productRow').find('.finalPrice').attr('product_price');
                // alert(price);
                // var quantityChangePrice =finalPrice*selectNumber;

               // var selectNumber = $(this).val();
               // var quantityChangePrice = finalPrice*selectNumber;           
               // $('.finalPrice').html(SR+quantityChangePrice);
             });

        </script>

        <script type="text/javascript">

            $(document).ready(function(){ 
                var ths;
                $( ".productCart" ).click(function() {
                  var productId    =  $(this).attr('product');
                  var userId     = $('.userId').val();
                    $.ajax({
                            url: "{{url('cart/add-Product')}}",
                            type:'post',
                            data:{productId:productId,userId:userId,_token:"{{ csrf_token() }}" },
                            success:function(response){
                                if(response['status']=="true") {   
                                    if (window.location.href.indexOf('reload')==-1) {
                                                                       window.location.replace(window.location.href+'?reload');
                                                                  } 
                                    toastr.success(response.msg); 
                                    $('.cart-count').html('<span class="cart-count" style="color: red;">'+response.count+'</span>');
                                     location.reload(); 
                                }else{
                                    toastr.error(response.msg);
                                }
                            }
                        })
                });
            })

             $(document).ready(function(){ 
                var ths;
                $( ".wishlisted" ).click(function() {
                  ths = $(this);
                  var dataid     =  $('.productIdClass').val($(this).data('id'));  
                  var productId  =  $('.productIdClass').val();
                  var userId     =  $('.userId').val();
                     // $(this).addClass('active');
                    $.ajax({
                            url: "{{url('/wishlist/addProduct')}}",
                            type:'post',
                            data:{productId:productId,userId:userId,_token:"{{ csrf_token() }}" },
                            success:function(response){
                                if(response['status']=="true") {   
                                     // alert('added');             
                                    ths.addClass('fa-heart').removeClass('fa-heart-o');
                                    
                                    toastr.success(response['msg']);
                                }else if(response['status']=="false") {
                                    ths.addClass('fa-heart-o').removeClass('fa-heart');
                                    toastr.error('Product successfully removed from whislist');              
                                }else{
                                    toastr.error('Something went wrong');
                                }
                            },error(){
                                toastr.error('Something went wrong');
                            }
                        })

                });
            })

             
        </script>

        <script type="text/javascript">
            $(document).ready(function(){ 

                var produtcount="{{$productscount}}";

                if(produtcount>=2 && produtcount<=5){
                    $(".compareButton").show();
                    $('.countproducts').html(produtcount);   
                }else{
                   $(".compareButton").hide();
                }

                $( ".compareCheck" ).click(function() {
                    var productId  = $(this).attr('product_id');
                    var userId     = $('.userId').val();
                     // alert(id)          
                    $.ajax({
                        url: "{{url('/compare/product')}}",
                        type:'post',
                        data:{productId:productId,userId:userId,_token:"{{ csrf_token() }}" },
                        success:function(response){
                            if(response['status']=="true") {   
                               // alert(response['msg'])
                              if(response['count']>=2 && response['count']<=5){
                                $(".compareButton").show();
                                $('.countproducts').html(response['count']);      
                                // location.reload();
                               } else{
                                $(".compareButton").hide();
                               } 
                
                            }else if(response['status']=="false") {
                                
                               if(response['count']>=2 && response['count']<=5){
                                 $(".compareButton").show();
                                 $('.countproducts').html(response['count']);   
                                 // location.reload();   
                               }else{
                                $(".compareButton").hide();
                               }   
                            }else{
                                toastr.error('Something went wrong');
                            }
                        },error(){
                            toastr.error('Something went wrong');
                        }
                    })

                });
           
          })
        </script>
@stop