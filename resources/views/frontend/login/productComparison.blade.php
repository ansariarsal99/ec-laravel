@extends('frontend.layout.layout')
@section('title','Product Detail')
@section('content')
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Compare Products</li>
                    </ol>
                </nav>
            </div>
            <section class="compr_page_sec">
                <div class="container">
                    <div class="section-heading">
                        <span>Comparison List</span>
                        <h2>Compare Products</h2>
                    </div>
                    <div class="wrp_comp_product">
                        <div class="table-responsive" >
                            <table cellspacing="0" id="table-basic" class="table_compare table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($compareProductRecords as  $productRecord)
                                            <?php                                     
                                                if (!empty($productRecord['product']['product_images'][0]['name'])) {
                                                    $imgpath= 'public/frontend/images/products'.'/'.$productRecord['product']['product_images'][0]['name'];  
                                                }                                                                                        
                                                if(!empty($productRecord['product']['product_images'][0]['name']) && file_exists($imgpath) ) { 
                                                    $admin_image = productImgsPath.'/'.$productRecord['product']['product_images'][0]['name'];    
                                                }else{
                                                    $admin_image = defaultAdminImagePath.'/no_image.png';  
                                                }                        
                                            ?>  
                                            <td>
                                                <img class="img_copm" src="{{$admin_image}}"> 
                                            </td>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                         <th>Name</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                             <td>{{@$productRecord['product']['item_name']}}</td>
                                         @endforeach
                                    </tr>

                                   <!--  <tr>
                                        <th>Size</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>12'11"</td>
                                         @endforeach
                                    </tr> -->

                                  <!--   <tr>
                                        <th>Company</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>Jaguar</td>
                                         @endforeach
                                    </tr> -->
                                    <tr>
                                        <th>Material</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                                <?php
                                                    // $allSelectedMateial = App\ProductSelectedSellingMaterial::with('productSellingMaterialDetail')->where('product_id',$productRecord['product_id'])->get()->toArray();

                                                    // $allPluckedIds =App\ProductSelectedSellingMaterial::with('productSellingMaterialDetail')->where('product_id',$productRecord['product_id'])->pluck('product_selling_material_id')->toArray();


                                                    // $material = App\productSellingMaterial::whereIn('id',$allPluckedIds)->get()->toArray();

                                                    // dd($productRecord['product']['product_selected_selling_materials']);

                                                    // $slcted_material_id = [];
                                                    //  if(!empty($productRecord)){
                                                    //      $slcted_material_id = array_map(function($v){ return $v['product_selling_material_id']; }, $productRecord['user_multiple_categories']);
                                                    //  }

                                                    //  $prdctCategory =  ProductCategory::whereIn('id',$slcted_material_id)->pluck('name')->toArray();

                                                    //  $productCategoryImplode = implode(", ",$prdctCategory);


                                                    // $allMaterial = implode(", ",$material['selling_material_name']);
                                                 ?>

                                   <td>
                                            @foreach($productRecord['product']['product_selected_selling_materials'] as $productMaterial )
                                                {{ ucfirst($productMaterial['product_selling_material_detail']['selling_material_name']) }}
                                            @if(!$loop->last)
                                                ,
                                            @endif
                                            @endforeach
                                        </td>
                                         @endforeach
                                    </tr>

                                    <tr>
                                        <th>Brand</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>                                                             {{@$productRecord['product']['product_brand_detail']['brand_name']}} </td>
                                        
                                         @endforeach
                                    </tr>

                                    <tr>
                                        <th>Color</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                       
                                        <td>                                                            {{@$productRecord['product']['product_color_detail']['name']}} </td>
                                        
                                         @endforeach
                                    </tr>
                                    
                                        
                                    <tr>
                                        <th>Length</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>                                                            {{@$productRecord['product']['length_number']}} {{@$productRecord['product']['diameter_unit_detail']['name']}} </td>
                                        
                                         @endforeach
                                    </tr>

                                    <tr>
                                        <th>Width</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>                                                            {{@$productRecord['product']['width_number']}} {{@$productRecord['product']['width_unit_detail']['name']}}</td>
                                        
                                         @endforeach
                                    </tr>

                                    <tr>
                                        <th>Height</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>                                                            {{@$productRecord['product']['height_number']}} {{@$productRecord['product']['height_unit_detail']['name']}}</td>
                                        
                                         @endforeach
                                    </tr>


                                    <tr>
                                        <th>Depth</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>                                                            {{@$productRecord['product']['depth_number']}} {{@$productRecord['product']['depth_unit_detail']['name']}}</td>
                                        
                                         @endforeach
                                    </tr>

                                    <tr>
                                        <th>Thickness</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                           <td>                                                        {{@$productRecord['product']['thickness_number']}}            {{@$productRecord['product']['thickness_unit_detail']['name']}}
                                           </td>
                                         @endforeach
                                    <tr>

                                    <tr>
                                        <th>Particle</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                           <td>                                                        {{@$productRecord['product']['particle_number']}}  {{@$productRecord['product']['particle_unit_detail']['name']}}
                                           </td>
                                         @endforeach
                                    <tr>    

                                    <th>Qty.</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                            <td>{{$productRecord['product']['minimum_buying_quantity_number']}}</td>    
                                         @endforeach
                                    </tr>

                                    <tr>
                                        <th>Unit</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td>
                                         {{@$productRecord['product']['selling_unit_product']['name']}}

                                         {{$productRecord['product']['diameter_unit_detail']['name']}} 
                                    
                                        </td>
                                         @endforeach
                                    </tr>
                                    <tr>
                                        <th>Price/Unit</th>
                                         @foreach($compareProductRecords as  $productRecords)
                                            <td>SR 
                                            {{@$productRecords['product']['productpricerange'][0]['final_price']}} / {{@$productRecords['product']['selling_unit_product']['name']}}</td>
                                         @endforeach
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                         @foreach($compareProductRecords as  $productRecord)
                                         <td>SR 
                                            {{@$productRecord['product']['productpricerange'][0]['final_price']}}</td>
                                         @endforeach
                                    </tr>
                               <!--      <tr>
                                        <th></th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td><a class="cp comop_a">Add to cart</a></td>
                                         @endforeach
                                    </tr>
                                    <tr>
                                        <th></th>
                                         @foreach($compareProductRecords as  $productRecord)
                                        <td><button class="btn btn_theme"><span>Buy Now</span></button></td>
                                         @endforeach
                                    </tr> -->
                                </tbody>
                            </table>
                          </div>
                    </div>
                </div>
            </section>

        </div>

   
@stop

@section('script')

   
@stop