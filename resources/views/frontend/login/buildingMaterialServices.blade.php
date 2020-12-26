@extends('frontend.layout.layout')
@section('title','Building Materials')
@section('content')

    <section class="servc_page_sec">
        <div class="custom_container">
            <div class="page_heading text-center">
                <!-- <span>Quality Products</span> -->
                <h1 class="text-uppercase">Building Materials</h1>
            </div>
            <div class="wrp_servc">
                <div class="row">
                   
                    @foreach($productCategories as $key => $productCategory)
                        <?php 
                            if (!empty($productCategory['category_image'])) {
                                $imgpath= adminBaseProductCategoryImgsPath.'/'.$productCategory['category_image'];    
                                // dd($imgpath);
                            }                                                                                        
                            if(!empty($productCategory['category_image']) && file_exists($imgpath) ) { 
                                // dd($imgpath);
                                $admin_image = adminProductCategoryImgsPath.'/'.$productCategory['category_image'];    
                            }else{
                                $admin_image = defaultAdminImagePath.'/no_image.png';  
                                // dd($admin_image);
                            }                                           
                        ?>
                 
                        @if($key%2==0)
                            <div class="col-12">
                                <div class="services_dtl_img d-flex mb-30">
                                    <div class="img-holder_left pos_rel img_servv">
                                        <a href="javascript:;"><img src="{{$admin_image}}" alt=""></a>
                                    </div>
                                    <div class="text-holderr rgt_txtt">
                                        <h2>{{$productCategory['name']}}</h2>
                                        <p>{!!$productCategory['description']!!}</p>
                                        <a class="btn btn_theme" href="{{url('/building/productList/'.base64_encode($productCategory['id']))}}"><span>View Products &nbsp;<i class="fa fa-long-arrow-right"></i></span></a>

                                  

                                    </div>
                                </div>
                            </div>
                        @else

                        <?php 
                            if (!empty($productCategory['category_image'])) {
                                $imgpath= adminBaseProductCategoryImgsPath.'/'.$productCategory['category_image'];    
                                // dd($imgpath);
                            }                                                                                        
                            if(!empty($productCategory['category_image']) && file_exists($imgpath) ) { 
                                // dd($imgpath);
                                $admin_image = adminProductCategoryImgsPath.'/'.$productCategory['category_image'];    
                            }else{
                                $admin_image = defaultAdminImagePath.'/no_image.png';  
                                // dd($admin_image);
                            }                                           
                        ?>
                            <div class="col-12">                 
                                <div class="services_dtl_img d-flex mb-30">
                                    <div class="text-holderr">
                                        <h2>{{$productCategory['name']}}</h2>
                                        <p>{!!$productCategory['description']!!}.</p>
                                       <a class="btn btn_theme" href="{{url( '/building/productList/'.base64_encode($productCategory['id']))}}"><span>View Products &nbsp;<i class="fa fa-long-arrow-right"></i></span></a>
                                    </div>
                                    <div class="img-holder_right pos_rel img_servv">
                                        <a href="javascript:;"><img src="{{$admin_image}}" alt=""></a>
                                    </div>
                                </div>                                  
                            </div>
                        @endif
                    @endforeach

                  
       
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')

@stop