@extends('frontend.layout.layout')
@section('title','My Wishlist')
@section('content')
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
                    </ol>
                </nav>
            </div>
            
            <section class="prof_dashboard padd_all_sec">
                <div class="container-fluid">
                    <div class="row">
                        
                            @include('frontend.include.userSidebar')

                        <div class="col-sm-9">
                            <div class="mainside_wrap">
                                <!--  -->
                                <div class="page_head">
                                    <h4>My Wishlist</h4>
                                    <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                                </div>
                                <div class="main_cntnt_dash">
                                    <div class="card wishlst_dash">
                                        <!--  -->
                                        <div class="cont_shd_frm">
                                            <div class="wissLst_wrap">
                                                <div class="row">
                                                     @foreach($productWishlistRecord as $key => $product)
                                                    

                                                        <?php  
                                                                
                                                            if (!empty($product['product']['product_image'][0]['name'])) {
                                                                $imgpath= productImgsBasePath.'/'.$product['product']['product_image'][0]['name'];    
                                                            }                                                                                        
                                                            if(!empty($product['product']['product_image'][0]['name']) && file_exists($imgpath) ) { 
                                                                $admin_image = productImgsPath.'/'.$product['product']['product_image'][0]['name'];    
                                                            }else{
                                                                $admin_image = defaultAdminImagePath.'/no_image.png';  
                                                                // dd($admin_image);
                                                            }                                           
                                                        ?>

                                                    <div class="col-sm-4">
                                                        <div class="blog_article_wrap">
                                                            <a href="javascript:;" class="blog_article_img_container pos_rel">
                                                                <img src="{{$admin_image}}" class="img-fluid">
                                                                <span class="pos_abs_wish"><i class="fa fa-heart"></i></span>
                                                            </a>
                                                            <div class="blog_article_body">
                                                                <a class="article_title">{{$product['product']['item_name']}}</a>
                                                                <div class="ratng_star d-flex justify-content-between">
                                                                    <div class="star_color">
                                                                        <span class="star_rev">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-half-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        </span>
                                                                        <span class="rev_nmbr"> (3.5)</span>
                                                                        <a class="str_numbrs">2 Stores</a>
                                                                    </div>
                                                                    <div>
                                                                        <span class="ad_cart">
                                                                            <i class="fa fa-shopping-cart" data-toggle="tooltip" title="Add to Cart"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="rt_qty  d-flex justify-content-between align-items-center">
                                                                 @foreach($product['product']['productpricerange'] as $key2 => $price )
                                                                    <div>
                                                                        <p class="rat_prod">$ {{$price['unit_price']}}  <del>$95.50</del></p>
                                                                        <span>+ SR 20.76 Shipping</span>
                                                                    </div>
                                                                    <span class="qty_sp">
                                                                        <select name="prod" class="custom-select">
                                                                            <option selected>Qty.</option>
                                                                            <option value="volvo">10kg.</option>
                                                                            <option value="fiat">20kg.</option>
                                                                            <option value="audi">50kg.</option>
                                                                        </select>
                                                                    </span>
                                                              @endforeach
                                                                </div>
                                                                 
                                                                <div class="cmpr_chk">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                        <label class="custom-control-label" for="customCheck">Compare Product</label>
                                                                      </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     @endforeach
                                                    <!-- <div class="col-sm-4">
                                                        <div class="blog_article_wrap">
                                                            <a href="javascript:;" class="blog_article_img_container pos_rel">
                                                                <img src="https://i.pinimg.com/originals/e1/70/09/e170099a7932ed60dd39d746c224c576.jpg" class="img-fluid">
                                                                <span class="pos_abs_wish"><i class="fa fa-heart"></i></span>
                                                            </a>
                                                            <div class="blog_article_body">
                                                                <a class="article_title">Products Name</a>
                                                                <div class="ratng_star d-flex justify-content-between">
                                                                    <div class="star_color">
                                                                        <span class="star_rev">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </span>
                                                                        <span class="rev_nmbr"> (5)</span>
                                                                        <a class="str_numbrs">5 Stores</a>
                                                                    </div>
                                                                    <div>
                                                                        <span class="ad_cart">
                                                                            <i class="fa fa-shopping-cart" data-toggle="tooltip" title="Add to Cart"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="rt_qty  d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <p class="rat_prod">$ 45.50 <del>$95.50</del></p>
                                                                        <span>+ SR 20.76 Shipping</span>
                                                                    </div>
                                                                    <span class="qty_sp">
                                                                        <select name="prod" class="custom-select">
                                                                            <option selected>Qty.</option>
                                                                            <option value="volvo">10kg.</option>
                                                                            <option value="fiat">20kg.</option>
                                                                            <option value="audi">50kg.</option>
                                                                        </select>
                                                                    </span>
                                                                </div>
                                                                <div class="cmpr_chk">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                        <label class="custom-control-label" for="customCheck">Compare Product</label>
                                                                      </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

           
        </div>
     
@stop
@section('script')

@stop
