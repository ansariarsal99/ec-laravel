@extends('frontend.layout.layout')
@section('title','Home')
@section('content')
    <section class="her_sldr_don">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-9">
                      <?php
                            $data = App\UserAdvertisement::where('advertisement_appearence_id',1)->get()->toArray();
                            // dd($data);
                            $currentDate = date('Y-m-d H:i:s');
                            $admin_image = '';
                      ?> 

                <div class="hero_img pos_rel">
                    <div class="owl-carousel owl_slide">
                      @foreach ($data as $key => $value)                         
                            <?php 
                                $admin_image  = frontendAdvertImagePath.'/'.$value['image']; 
                             ?> 
    
                            @if ($value['publish_date'] <= $currentDate && $value['expiry_date'] >= $currentDate) 
                               <div class="item pos_rel">
                                    <figure class="pos_rel">
                                        <img src="{{$admin_image}}" class="img-fluid">
                                        <!-- <img src="https://buildmart.net/public/frontend/imgs/advert_image/1597226084_928877767.jpeg" class="img-fluid"> -->
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
            <div class="col-sm-3">
                <div class="feata_secc">
                    <div class="sid_par">
                        <h3><i>YOU DESERVE MORE</i></h3>
                        <!-- <p>We are here to maximize your benefits in saving you money & time . You can use our MAWAD MART platform to obtain the following exclusive features & services :</p> -->
                    </div>
                    <ul type="none" class="d-flex justify-content-start flex-column">
                        <!-- <li class="d-flex align-items-center"><img src="{{asset('public/frontend/img/trk.png')}}" class="img-fluid"></i> Deliver with Us</li> -->
                        <li class="d-flex align-items-center"><img src="{{asset('public/frontend/img/secr.png')}}" class="img-fluid"></i> Protect your  Payment</li>
                        <li class="d-flex align-items-center"><img src="{{asset('public/frontend/img/comp.png')}}" class="img-fluid"></i> Compare and Save</li>
                        <li class="d-flex align-items-center"><img src="{{asset('public/frontend/img/deals.png')}}" class="img-fluid"></i> Exclusive Deals</li>
                         <li class="d-flex align-items-center"><img src="{{asset('public/frontend/img/disc.png')}}" class="img-fluid"></i><a href="{{url('/discountCode')}}"> Discount Codes</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
                 
  <section class="servc_secc">
      <div class="container-fluid">
          <div class="section-heading">
              <!-- <span>Quality Products</span> -->
              <h2>Products Categories</h2>
          </div>
          <div class="wrp_servc">
              <div class="row">
                  @foreach($productCategories as $key => $productCategory)
                      <?php 
                          if (!empty($productCategory['category_image'])) {
                              $imgpath= adminBaseProductCategoryImgsPath.'/'.$productCategory['category_image'];
                          }                                                                                       
                          if(!empty($productCategory['category_image']) && file_exists($imgpath) ) { 
                             $admin_image = adminProductCategoryImgsPath.'/'.$productCategory['category_image'];
                          }else{
                              $admin_image = defaultAdminImagePath.'/no_image.png';  
                          }                                                 
                      ?>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="bu-services-img  mb-30">
                          <div class="img-holder">
                              <figure class="pos_rel">
                                 <a href="{{url('/building/productList/'.base64_encode($productCategory['id']))}}"><img src="{{$admin_image}}" alt=""></a>
                              </figure>
                          </div>
                          <div class="text-holder">
                              <h2>{{$productCategory['name']}}</h2>
                              <p>{!!$productCategory['description']!!}</p>
                             <!--  <a href="{{url('provider/building/productList/'.base64_encode($productCategory['id']))}}" class="bu-color link"><span class="fa fa-arrow-right"></span></a> -->

                              <a class="btn btn_theme" href="{{url('/building/productList/'.base64_encode($productCategory['id']))}}"><span>View Products &nbsp;<i class="fa fa-long-arrow-right"></i></span></a>
                          </div>
                      </div>
                    </div>
                  @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="prodct_view1 new_prodss">
        <div class="custom_container">
            <div class="section-heading">
                <span>Best Selling Products</span>
                <h2>New Products</h2>
            </div>
            <div class="wrp_prod_sldr">
                <div class="newprod_slider owl-carousel owl-theme slid_modf">
                    @foreach($products as $key => $product)
                    <?php  
                         // dd($product);
                        if (!empty($product['product_images'][0]['name'])) {
                           $imgpath= 'public/frontend/images/products'.'/'.$product['product_images'][0]['name'];  
                        }                                                                                        
                        if(!empty($product['product_images'][0]['name']) && file_exists($imgpath) ) { 
                            $admin_image = productImgsPath.'/'.$product['product_images'][0]['name'];    
                        }else{
                            $admin_image = defaultAdminImagePath.'/no_image.png';  
                        }                                           
                    ?>
                    <div class="item">
                        <div class="blog_article_wrap">
                            <a href="javascript:;" class="blog_article_img_container pos_rel">
                                <img src="{{$admin_image}}" class="img-fluid">
                                <span class="pos_abs_wish"><i class="fa fa-heart"></i></span>
                            </a>
                            <div class="blog_article_body">
                                 <a class="article_title" href="{{url('/product/productDetail/'.base64_encode($product['id']))}}">{{$product['item_name']}}</a>

                                <div class="ratng_star align-items-center d-flex justify-content-between">
                                  
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
                                          <span class="qty_sp">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                             {{@$product['minimum_buying_quantity_number']}}
                                             {{@$product['minimum_buying_quantity_unit_detail']['name']}}
                                          </span>
                                           @endif
                                      </div>


                               <!-- <span class="qty_sp">
                                        <select name="prod" class="custom-select">
                                            <option selected>Qty.</option>
                                            <option value="volvo">10kg.</option>
                                            <option value="fiat">20kg.</option>
                                            <option value="audi">50kg.</option>
                                        </select>
                                    </span> -->

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
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                        <label class="custom-control-label" for="customCheck">Compare Product</label>
                                    </div>
                                    <div>
                                        <span class="ad_cart">
                                            <i class="fa fa-shopping-cart" data-toggle="tooltip" title="Add to Cart"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="prodct_view1 hot_deals sec_gray">
        <div class="custom_container">
            <div class="section-heading">
                <span>Best Selling Products</span>
                <h2>Hot Deals</h2>
            </div>
            <div class="wrp_prod_sldr">
                <div class="hot_slider owl-carousel owl-theme slid_modf">
                    <div class="item">
                        <div class="blog_article_wrap">
                            <a href="javascript:;" class="blog_article_img_container pos_rel">
                                <img src="https://3.imimg.com/data3/RL/SQ/MY-12983293/all-type-of-building-material-500x500.jpg" class="img-fluid">
                            </a>
                            <div class="blog_article_body text-center">
                                <a class="article_title">Products Name</a>
                                <div class="rt_qty d-flex justify-content-center">
                                    <span class="rat_prod">upto 6% off</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog_article_wrap">
                            <a href="javascript:;" class="blog_article_img_container pos_rel">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRCPVJ6cRZqM-HdWdm3REMhNcQFruMLevNQznMsQ7fEvLQKJxC1&usqp=CAU" class="img-fluid">
                            </a>
                            <div class="blog_article_body text-center">
                                <a class="article_title">Products Name</a>
                                <div class="rt_qty d-flex justify-content-center">
                                    <span class="rat_prod">upto 50% off</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog_article_wrap">
                            <a href="javascript:;" class="blog_article_img_container pos_rel">
                                <img src="https://www.danielstrading.com/wp-content/uploads/2014/09/lumber.jpg" class="img-fluid">
                            </a>
                            <div class="blog_article_body text-center">
                                <a class="article_title">Products Name</a>
                                <div class="rt_qty d-flex justify-content-center">
                                    <span class="rat_prod">upto 20% off</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog_article_wrap">
                            <a href="javascript:;" class="blog_article_img_container pos_rel">
                                <img src="https://magazineclonerepub.blob.core.windows.net/mcepub/82/152363/image/2dcb6af3-183a-4652-9835-48658d86bcbd.jpg" class="img-fluid">
                            </a>
                            <div class="blog_article_body text-center">
                                <a class="article_title">Products Name</a>
                                <div class="rt_qty d-flex justify-content-center">
                                    <span class="rat_prod">upto 15% off</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prodct_view1 new_prodss">
        <div class="container-fluid">
            <div class="section-heading">
                <span>We work with</span>
                <h2>Brands</h2>
            </div>
            <div class="wrp_prod_sldr">
                <div class="brands_slider owl-carousel owl-theme slid_modf">
                    <div class="item">
                        <div class="brnd_img">
                            <img src="https://webify-13e95.kxcdn.com/demo/webify/wp-content/uploads/2019/03/partner-logo-04.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="brnd_img">
                            <img src="https://t.commonsupport.com/gosearch/images/clients/2.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="brnd_img">
                            <img src="https://t.commonsupport.com/gosearch/images/clients/1.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="brnd_img">
                            <img src="https://webify-13e95.kxcdn.com/demo/webify/wp-content/uploads/2019/03/partner-logo-01.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="brnd_img">
                            <img src="https://webify-13e95.kxcdn.com/demo/webify/wp-content/uploads/2019/03/partner-logo-05.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="brnd_img">
                            <img src="https://webify-13e95.kxcdn.com/demo/webify/wp-content/uploads/2019/03/partner-logo-02.png" class="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="brnd_img">
                            <img src="https://webify-13e95.kxcdn.com/demo/webify/wp-content/uploads/2019/03/partner-logo-05.png" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="app_down_sec">
        <div class="custom_container">
            <div class="wrap_app">
                <div class="row align-items-center">
                    <div class="col-sm-7">
                        <img src="{{asset('public/frontend/img/apsho.png')}}" class="img-fluid" alt="App Shots">
                    </div>
                    <div class="col-sm-5">
                        <div class="aps_right">
                            <div class="sec_heading no_pad">
                                <h1 class="text-left">Available on App Store &amp; Play Store.</h1>
                            </div>
                            <div class="para_app">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                <a href="javascript:;"><img src="{{asset('public/frontend/img/aps.svg')}}" class="img-fluid" alt="store images"></a>
                                <a href="javascript:;"><img src="{{asset('public/frontend/img/pls.svg')}}" class="img-fluid" alt="store images"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop
@section('script')

  <!-- <script type="text/javascript">

            $('.owl_slide').owlCarousel({
              loop: false,
              margin: 0,
              dots: true,
              nav: false,
              autoplay: true,
              autoplayHoverPause: false,
              responsive: {
                0: {
                  items: 1
                },
                600: {
                  items: 1
                },
                1000: {
                  items: 1
                }
              }
            });

            $('.newprod_slider').owlCarousel({
                loop: false,
                nav: true,
                dots: false,
                autoplay: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:4
                    }
                }
            });
            $('.hot_slider').owlCarousel({
                loop: false,
                nav: true,
                dots: false,
                autoplay: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:4
                    }
                }
            });
            $('.brands_slider').owlCarousel({
                loop: false,

                nav: true,
                dots: false,
                autoplay: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:6
                    }
                }
            });
        </script>
 -->

@stop