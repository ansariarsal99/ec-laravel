@extends('frontend.layout.layout')
@section('title','My Cart')
@section('content')

<style>
       a.new_card_p {
        color: #cc3f2f;
        text-decoration: underline;
        font-weight: 500;
    }

    .card_wrpr {
        background: #fff;
        box-shadow: 0 0 40px -29px #909090;
        padding: 30px 20px;
        border-radius: 9px;
        margin: 10px 0;
    }
    .card_wrpr.active {
        border: 2px solid #cc3f2f;
    }

</style>
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                    </ol>
                </nav>
            </div>
            <section class="cart_page_sec">
                <div class="container-fluid">
                    <div class="wrap_all_numbrs">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="page_numbers">
                                        <div class="container">
                                            <ul class="numb_pag list-inline d-flex justify-content-around" type="none">
                                                <li class="list-inline-item bsns_dtl_li first_dot active"><span>1</span> My Cart</li>
                                                <li class="list-inline-item stor_subs_li second_dot"><span>2</span> Delivery</li>
                                                <li class="list-inline-item third_dot"><span>3</span> Review Order</li>
                                                <li class="list-inline-item fourth_dot"><span>4</span> Payment</li>
                                                <li class="list-inline-item fifth_dot"><span>5</span> Confirmation</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <section class="register_sec cart_prod_sec table_noWrap">
                                        <div class="new_div_aded">
                                            <div class="section-heading">
                                                <h2>My Cart</h2>
                                            </div>
                                            <div class="wrap_register_white">
                                                <div class="wrp_cart_product">
                                                    <div class="single_suplr_cart">
                                                        <div class="row">  
                                                    @if($seller_product!=null)
                                                        @foreach($seller_product as $key=>$product)

                                                            @foreach($product as $key1=>$prodct)
                                                               
                                                            <div class="col-sm-12">
                                                                <div class="splr_info d-flex justify-content-between">
                                                                    <span>Sold by: <strong>
                                                                        {{ucfirst($prodct['product_name']['seller_name']['company_name'])}}</strong></span>
                                                                    <span>Store Name: <strong>{{ucfirst($prodct['product_name']['store_under_product']['store_name'])}}</strong></span>

                                                                    <span>Store Location: <strong>{{ucfirst($prodct['product_name']['store_under_product']['location'])}}</strong></span>
                                                                    <a href="" class="cp">Store Location on Map</a>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table id="table-basic" class="table_cartt table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th></th>
                                                                                <th>Product</th>
                                                                                <th>Qty.</th>
                                                                                <th>Unit</th>
                                                                                <th>Price/<small>Unit</small></th>
                                                                                <th>Total</th>
                                                                                <th>Coupon</th>
                                                                                <th>Discount</th>
                                                                                <th>Total Discount Price</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr class="main_row">
                                                                                <td class="img_td">
                                                                                    
                                                                                    <?php 
                                                                                        $image = defaultAdminImagePath.'/no_image.png';
                                                                                        if(!empty($prodct['product_name']['product__image_for_cart']['name'])){
                                                                                            $image = asset('public/frontend/images/products/'.$prodct['product_name']['product__image_for_cart']['name']);
                                                                                        }
                                                                                     
                                                                                                               
                                                                                    ?>  
                                                                                    
                                                                                    <img src="{{ $image}}" alt="" class="img-fluid">
                                                                                </td>

                                                                                <td>
                                                                                    <span class="prod_td_name">{{ucfirst(@$prodct['product_name']['item_name'])}}</span>
                                                                                    <input type="hidden" name="product_id" class="prodct_id" value="{{$prodct['product_name']['id']}}">
                                                                                </td>

                                                                                <td>

                                                                                    <select name="available_quantity" class="form-control custom-select change_quantity" cart_id="{{$prodct['id']}}">
                                                                                        <option value="" selected disabled>Quantity</option>
                                                                                        @for($i=$prodct['product_name']['minimum_buying_quantity_number']; $i <=$prodct['product_name']['available_quantity_number'] ; $i++)
                                                                                            <option  @if($prodct['product_name']['minimum_buying_quantity_number']==$i) selected="" @endif value="{{$i}}">{{$i}}</option>
                                                                                        @endfor
                                                                                    </select>
                                                                                </td>

                                                                                <td>
                                                                                    <span class="prod_td_name">{{ucfirst(@$prodct['product_name']['selling_unit_product']['name'])}}</span>
                                                                                </td>

                                                                                <?php 
                                                                                // dd($prodct['product_name']);
                                                                                   $quantity  = $prodct['product_name']['minimum_buying_quantity_number'];
                                                                                   
                                                                                   if($prodct['product_name']['product_price_cart_project']['final_price']!=null ||$prodct['product_name']['product_price_cart_project']['final_price']!=0) {
                                                                                            
                                                                                        $final_price = $prodct['product_name']['product_price_cart_project']['final_price'];
                                                                                        // dd($final_price);
                                                                                    }


                                                                                   $totalPrice = @$final_price*$quantity;
                                                                                   
                                                                                // dd($prodct['product_name']);
                                                                                   $discount_type  = $prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type'];

                                                                                   $discountAmount = $prodct['product_name']['product_discount_code']['seller_discount_code']['discount_value'];

     
                                                                                   
                                                                                     if($discount_type=='percent'){
                                                                                            $balanceAmount =  $discountAmount/$totalPrice*100;
                                                                                     }else if($discount_type=='value'){
                                                                                            $balanceAmount = $totalPrice - $discountAmount;
                                                                                     }
                                                                                        // dd($prodct);
                                                                                ?>    

                                                                                 
                                                              

                                                                                <td class="single_price">
                                                                                    SR  {{ @$prodct['product_single_unit_price'] }}
                                                                                </td>
                                                                                
                                                                                @if($prodct['product_name']['product_price_cart_project']['final_price']!=null) 
                                                                                    <input type="hidden" class="product_price" value="{{$prodct['product_name']['product_price_cart_project']['final_price']}}" name="product_price">
                                                                                @endif

<!--                                                                                 @if($prodct['product_name']['product_price_cart_project']['final_price']==null)

                                                                                    <input type="hidden" class="product_price" value="{{$prodct['product_name']['defualt_selling_unit_price']}}" name="product_price">
                                                                                @endif -->
                                                                               
                                                                                 <td class="tr_price_total_multiply_quantity">
                                                                                    
                                                                                     SR  {{@$prodct['product_quantity_price']}} </td>

                                                                                 <input type="hidden" name="final_prc" value="{{$prodct['product_name']['product_price_cart_project']['final_price']}}" class="final_prc1">

                                                                                 <td>
                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']!=null)
                                                                                        <input type="text" placeholder = "Code" class="form-control" name="" disabled="" value="{{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_code']}}">
                                                                                    @endif

                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']==null)
                                                                                        <input type="text" placeholder = "Code" class="form-control" name="" disabled="" value="-">
                                                                                    @endif
                                                                                 </td>

                                                                                 <td>
                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']!=null)
  
                                                                                        @if($prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type']=='value')SR @endif {{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_value']}} @if($prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type']=='percent') % @endif
                                                                                    @endif
                                                                                    
                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']==null)
                                                                                        -
                                                                                    @endif  
                                                                                  </td>

                                                                                 <input type="hidden" name="discount" value="{{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_value']}}" class="discountAmount">
                                                                                 
                                                                                 @if($prodct['product_name']['product_discount_code']['seller_discount_code']!=null)
                                                                               
                                                                                 <td class="total_discount_prc">SR 
                                                                                    {{@$prodct['product_price_after_discount']}}
                                                                                 </td>
                                                                                 @endif 

                                                                                 @if($prodct['product_name']['product_discount_code']['seller_discount_code']==null)
                                                                                    <td class="total_discount_prc">-
                                                                                    </td>

                                                                                 @endif 


                                                                                 <input type="hidden" name="discount_type" class="discount_type" value="{{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type']}}">

                                                                                 <td class="act_crt">
                                                                                     <a href="javascript:;" class="cp text-danger delete_btn_product" del_id="{{ @$prodct['product_name']['id']}}">Delete</a><br>
                                                                                     <a href="javascript:;" class="cp productIdClass" product_id="{{ @$prodct['product_name']['id']}}">Save for Later</a>
                                                                                 </td>
                                                                      </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endforeach
                                                        @else
                                                         <a href="{{url('user/buildingMaterialServices')}}">
                                                        @endif
                                                            <div class="col-sm-12">
                                                                <div class="cart_overvew">
                                                                    <div class="shoping__continue">
                                                                        <div class="shoping__discount text-right">
                                                                            <h5>Discount Codes</h5>
                                                                            <form class="pos_rel">
                                                                                <input type="text" class="form-control discountCode" placeholder="Enter coupon code" value="">
                                                                                <button type="button" class="btn_cpnn applyCoupon">APPLY</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="shoping__checkout">
                                                                        <?php
                                                                            $sumAllProduct = App\ProductCart::where('user_id',Auth::user()->id)->pluck('product_quantity_price')->sum();
                                                                            $taxOnProduct = App\ProductTax::first();

                                                                            $sumAllProduc =$taxOnProduct['tax_percent']/100*$sumAllProduct;
                                                                        ?>

                                                                        <h5>Cart Total</h5>
                                                                        <ul>
                                                                            <li>Total Price of items <span class="Sum_Product_Price">SR  {{$sumAllProduct}}</span></li>
                                                                            <li>Discount Applied <span class="text-danger DiscountValue"> SR  00.00</span></li>
                                                                            <li>Discounted Price <span class="discountedAmount">SR   {{$sumAllProduct}}</span></li>
                                                                            <li>Shipping to default location <span>SR   00.00</span></li>
                                                                            <li>Estimated Tax <span class="taxAmount">SR  {{$taxOnProduct['tax_percent']/100*$sumAllProduct}}</span></li>
                                                                            <li>Total <span class="grandTotal">SR  {{ $sumAllProduct + $taxOnProduct['tax_percent']/100*$sumAllProduct }}</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <!--  <div class="single_suplr_cart">
                                                        <div class="splr_info d-flex justify-content-between">
                                                            <span>Sold by: <strong>Supplier Name #2</strong></span>
                                                            <span>B 1/425, Near Park Avenue</span>
                                                            <a href="" class="cp">Store Location on Map</a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="table-responsive" >
                                                                    <table id="table-basic" class="table_cartt table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th></th>
                                                                                <th>Product</th>
                                                                                <th>Qty.</th>
                                                                                <th>Unit</th>
                                                                                <th>Price/<small>Unit</small></th>
                                                                                <th>Total</th>
                                                                                <th>Coupon</th>
                                                                                <th>Discount</th>
                                                                                <th>Total Discount Price</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="img_td">
                                                                                    <img src="https://www.pmcstore.net.au/sites/5099/products/282020_insulation_batts_r15_large.jpg?v=ce20ef2085df149817b10a765264613e" alt="" class="img-fluid">
                                                                                </td>
                                                                                <td><span class="prod_td_name">Products Name</span>
                                                                                </td>
                                                                                <td>
                                                                                    <span class="qty_sp">
                                                                                        <select name="prod" class="custom-select">
                                                                                            <option >Qty.</option>
                                                                                            <option value="1">1</option>
                                                                                            <option selected  value="2">2</option>
                                                                                            <option value="3">3</option>
                                                                                        </select>
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="comp_qty custom-select">
                                                                                        <option>2 kg</option>
                                                                                        <option>3 kg</option>
                                                                                        <option>4 kg</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>SR 17.00</td>
                                                                                <td>SR 32.00</td>
                                                                                <td><input type="text" placeholder="Code" class="form-control" name=""></td>
                                                                                <td>$ 12.00</td>
                                                                                <td>SR 36.00</td>
                                                                                <td class="act_crt">
                                                                                    <a class="cp text-danger">Delete</a><br>
                                                                                    <a class="cp">Save for Later</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="cart_overvew">
                                                                    <div class="shoping__continue">
                                                                        <div class="shoping__discount text-right">
                                                                            <h5>Discount Codes</h5>
                                                                            <form action="#" class="pos_rel">
                                                                                <input type="text" class="form-control" placeholder="Enter coupon code">
                                                                                <button type="submit" class="btn_cpnn">APPLY</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="shoping__checkout">
                                                                        <h5>Cart Total</h5>
                                                                        <ul>
                                                                            <li>Total Price of items <span>SR 150.00</span></li>
                                                                            <li>Discount Applied <span class="text-danger">SR -38.00</span></li>
                                                                            <li>Discounted Price <span>SR 112.00</span></li>
                                                                            <li>Shipping to default Lccation <span>SR 20.00</span></li>
                                                                            <li>Estimated Tax <span>SR 5.00</span></li>
                                                                            <li>Total <span>SR 137.98</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="button_nex_prev">
                                                    <div class="">
                                                        <div class="form-group text-right">
                                                            <a class="btn btn_theme btn_nex first_complete" href="javascript:;"><span>Continue <i class="fa fa-arrow-right"></i></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="register_sec delvr_adrs">
                                        <div class="new_div_aded">
                                            <div class="section-heading">
                                                <h2>Delivery Options</h2>
                                            </div>
                                            <div class="wrap_register_white">
                                                <div class="wrp_addrss_product">
                                                    <div class="top_radsss">

                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" checked="" class="custom-control-input supllier_store" id="store_addr" name="delivery_adrress" value="pick_up_from_store">
                                                            <label class="custom-control-label" for="store_addr">Pick Up from Supplier's Store</label>
                                                        </div>

                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input delivery_adrress" id="user_addr" name="delivery_adrress" value="select_user_address">
                                                            <label class="custom-control-label" for="user_addr">Select A Delivery Address</label>
                                                        </div>

                                                    </div>

                                                    

                                                     <div class="ordr-addr addressDeliverUser">
                                                        <div class="acc-body-addr">
                                                            <div class="saved_adrss append_row">
                                                                <div class="row ">
                                                                    @foreach($deliveryAddress as $address)
                                                                    <div class="col-sm-6 remv_div">
                                                                        <div class="wrap_svd_adrs plan_wrpr">
                                                                            <div class="d-flex justify-content-between">
                                                                                <i class="fa fa-map-marker"></i>
                                                                                 @if($address['use_address_as_default']=='yes') <span class="badg_deflt">Default</span>@endif

                                                                            </div>
                                                                            <h3>{{@$address['location']}}</h3>
                                                                            <p>{{$address['address']}} </p>
                                                                            <div class="form-group svd_ic d-flex justify-content-between">
                                                                                <button type="button" class="btn btn_theme chooseDeiveryAddress" data-id="{{($address['id'])}}"><span>Deliver to this Address</span></button>
                                                                                <div>
                                                                                    <span data-id="{{base64_encode($address['id'])}}" class="mb-4">
                                                                                        <a class="edt_adrs"><i class="fa fa-edit"></i> Edit</a>
                                                                                        <a class="rmv_adrs"><i class="fa fa-times"></i> Remove</a>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                 
                                                                 <!--    <div class="col-sm-6">
                                                                        <div class="wrap_svd_adrs">
                                                                            <i class="fa fa-map-marker"></i>
                                                                            <h3>Park Plaza, Chandigarh</h3>
                                                                            <p>B 1/425, Kapoor Niwas, Near Bridge Gateway, Kundanpuri, Ludhiana </p>
                                                                            <div class="form-group svd_ic d-flex justify-content-between">
                                                                                <button type="button" class="btn btn_theme"><span>Deliver to this Address</span></button>
                                                                                <div>
                                                                                    <span class="cp text-primary"><i class="fa fa-edit"></i> Edit</span><br>
                                                                                    <span class="cp text-danger"><i class="fa fa-times"></i> Remove</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                            </div>

                                                             <div class="text-right mb-2">
                                                                <a href="javascript:;" class="new_adrs_p"><i class="fa fa-plus"></i> Add New Address</a>
                                                            </div>
                                                            <div class="add_new_adrs user_ad_adrss">
                                                                <div class="odr-head">
                                                                    <h4> Add New Address </h4>
                                                                </div>
                                                                <?php   
                                                                $countries = App\Country::orderBy('name','asc')->get()->toArray();
                                                                 ?>
                                                                
                                                                <form class="addAddressForm" method="post" name="AddressForm">
                                                                    @csrf
                                                                    <div class="addrs_div">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Address Title/Name</label>
                                                                                    <input type="text" name="address_title" class="form-control" placeholder="Home/Office/Store">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Address Detail</label>
                                                                                    <input type="text" name="address" class="form-control" placeholder="Builiding Name/Floor No./Office No.">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Province</label>
                                                                                    <input type="text" name="province_name" class="form-control" placeholder="Province Name">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Postal Code</label>
                                                                                    <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group text-left">
                                                                                    <label>Country</label>
                                                                                    <select name="country_id" class="form-control custom-select chng_cntry">
                                                                                        <option value="" disabled="" selected>Select Country</option>
                                                                                        @foreach($countries as $key => $country)
                                                                                            @if(!empty($country))
                                                                                                <option value="{{@$country['id']}}">{{@$country['name']}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group text-left">
                                                                                    <label>City</label>
                                                                                    <!-- <input type="text" name="city" class="form-control" placeholder="City"> -->
                                                                                    <select class="form-control custom-select chng_city" name="city_id">
                                                                                        <option value="" disabled="" selected="">Select City</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>Location</label>
                                                                                    <input type="text" class="form-control" placeholder="Location" name="location">
                                                                                </div>
                                                                                <div class="form-group text-left">
                                                                                    <div class="adrs_map">
                                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d231350.7620923537!2d55.1940508!3d25.0389721!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41ea57253d9dc545!2sOkzeela%20Star%20Building%20Materials%20Trading%20llc!5e0!3m2!1sen!2sin!4v1589633056776!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="text-right log_btn">
                                                                                    <a href="javascript:;" class="btn btn_theme add_adrs_btn"><span>Add Address</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                
                                                                    </div>
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="delivery_adrress_id" value="" id="delivery_adrress_id">

                                                <div class="button_nex_prev">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="text-left">
                                                                <a class="btn btn-secondry first_back" href="javascript:;"><i class="fa fa-arrow-left"></i> Previous</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-right">
                                                                <a class="btn btn_theme btn_nex second_complete" href="javascript:;"><span>Continue <i class="fa fa-arrow-right"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="register_sec delv_mthod table_noWrap">
                                        <div class="new_div_aded">
                                            <div class="section-heading">
                                                <h2>Review Order</h2>
                                            </div>
                                            <div class="wrap_register_white">
                                                <div class="wrp_addrss_product">
                                                    <div class="single_suplr_cart">
                                                        <!-- <div class="splr_info d-flex justify-content-between">
                                                            <span>Sold by: <strong>Supplier Name #1</strong></span>
                                                            <span>B 1/425, Near Park Avenue</span>
                                                            <a href="" class="cp">Store Location on Map</a>
                                                        </div> -->
                                                               <div class="row">
                                                                               
                                                       
                                                    @if($seller_product!=null)
                                                        @foreach($seller_product as $key=>$product)

                                                            @foreach($product as $key1=>$prodct)
                                                               
                                                            <div class="col-sm-12">
                                                                <div class="splr_info d-flex justify-content-between">
                                                                   <span>Sold by: <strong>
                                                                        {{ucfirst($prodct['product_name']['seller_name']['company_name'])}}</strong></span>
                                                                    <span>Store Name: <strong>{{ucfirst($prodct['product_name']['store_under_product']['store_name'])}}</strong></span>

                                                                    <span>Store Location: <strong>{{ucfirst($prodct['product_name']['store_under_product']['location'])}}</strong></span>

                                                                   <a href="" class="cp">Store Location on Map</a>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table id="table-basic" class="table_cartt table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th></th>
                                                                                <th>Product</th>
                                                                                <th>Qty.</th>
                                                                                <th>Unit</th>
                                                                                <th>Price/<small>Unit</small></th>
                                                                                <th>Total</th>
                                                                                <th>Coupon</th>
                                                                                <th>Discount</th>
                                                                                <th>Total Discount Price</th>
                                                                                <!-- <th>Action</th> -->
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <tr class="main_row">
                                                                                <td class="img_td">
                                                                                        <?php 
                                                                                        $image = defaultAdminImagePath.'/no_image.png';
                                                                                        if(!empty($prodct['product_name']['product__image_for_cart']['name'])){
                                                                                            $image = asset('public/frontend/images/products/'.$prodct['product_name']['product__image_for_cart']['name']);
                                                                                        }
                                                                                                               
                                                                                    ?>  
                                                                                    
                                                                                    <img src="{{$image}}" alt="" class="img-fluid">
                                                                                </td>

                                                                                <td>
                                                                                    <span class="prod_td_name">{{ucfirst(@$prodct['product_name']['item_name'])}}</span>
                                                                                    <input type="hidden" name="product_id" class="prodct_id" value="{{$prodct['product_name']['id']}}">
                                                                                </td>

                                                                                <td>
                                                                                    <select disabled="" name="available_quantity" class="form-control custom-select change_quantity" cart_id="{{$prodct['id']}}">
                                                                                        <option value="" selected disabled>Quantity</option>
                                                                                        @for($i=$prodct['product_name']['minimum_buying_quantity_number']; $i <=$prodct['product_name']['available_quantity_number'] ; $i++)
                                                                                            <option  @if($prodct['product_name']['minimum_buying_quantity_number']==$i) selected="" @endif value="{{$i}}">{{$i}}</option>
                                                                                        @endfor
                                                                                    </select>
                                                                                </td>

                                                                                <td>
                                                                                    <span class="prod_td_name">{{ucfirst(@$prodct['product_name']['minimum_buying_quality_unit'])}}</span>
                                                                                </td>

                                                                                <?php 
                                                                                   $quantity  = $prodct['product_name']['minimum_buying_quantity_number'];
                                                                                   
                                                                                   if($prodct['product_name']['product_price_cart_project']['final_price']!=null ||$prodct['product_name']['product_price_cart_project']['final_price']!=0){

                                                                                        $final_price = $prodct['product_name']['product_price_cart_project']['final_price'];
                                                                                   }else{
                                                                                    $final_price = $prodct['product_name']['defualt_selling_unit_price'];
                                                                                   }

                                                                                   $totalPrice = $final_price*$quantity;
                                                                                   
                                                                                   $discount_type  = $prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type'];

                                                                                   $discountAmount = $prodct['product_name']['product_discount_code']['seller_discount_code']['discount_value'];


                                                                                     if($discount_type=='percent'){
                                                                                            $balanceAmount =  $discountAmount/$totalPrice*100;
                                                                                     }else if($discount_type=='value'){
                                                                                            $balanceAmount = $totalPrice - $discountAmount;
                                                                                     }
                                                                                ?>  

                                                                                <td class="single_price">
                                                                                    SR {{ @$prodct['product_single_unit_price'] }}
                                                                                </td>
                                                                                
                                                                                @if($prodct['product_name']['product_price_cart_project']['final_price']!=null) 
                                                                                    <input type="hidden" class="product_price" value="{{$prodct['product_name']['product_price_cart_project']['final_price']}}" name="product_price">
                                                                                @endif

                                                                                @if($prodct['product_name']['product_price_cart_project']['final_price']==null)

                                                                                    <input type="hidden" class="product_price" value="{{$prodct['product_name']['defualt_selling_unit_price']}}" name="product_price">
                                                                                @endif
                                                                               
                                                                                 <td class="tr_price_total_multiply_quantity">
                                                                                    
                                                                                     SR {{@$prodct['product_quantity_price']}} </td>

                                                                                 <input type="hidden" name="final_prc" value="{{$prodct['product_name']['product_price_cart_project']['final_price']}}" class="final_prc1">

                                                                                 <td>
                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']!=null)
                                                                                        <input type="text" placeholder = "Code" class="form-control" name="" disabled="" value="{{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_code']}}">
                                                                                    @endif

                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']==null)
                                                                                        <input type="text" placeholder = "Code" class="form-control" name="" disabled="" value="-">
                                                                                    @endif
                                                                                 </td>

                                                                                 <td>
                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']!=null)
  
                                                                                        @if($prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type']=='value')SR @endif {{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_value']}} @if($prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type']=='percent') % @endif
                                                                                    @endif
                                                                                    
                                                                                    @if($prodct['product_name']['product_discount_code']['seller_discount_code']==null)
                                                                                        -
                                                                                    @endif  
                                                                                  </td>

                                                                                 <input type="hidden" name="discount" value="{{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_value']}}" class="discountAmount">
                                                                                 
                                                                                 @if($prodct['product_name']['product_discount_code']['seller_discount_code']!=null)
                                                                               
                                                                                 <td class="total_discount_prc">SR 
                                                                                    {{@$prodct['product_price_after_discount']}}
                                                                                 </td>
                                                                                 @endif 

                                                                                 @if($prodct['product_name']['product_discount_code']['seller_discount_code']==null)
                                                                                    <td class="total_discount_prc">-
                                                                                    </td>

                                                                                 @endif 


                                                                                 <input type="hidden" name="discount_type" class="discount_type" value="{{$prodct['product_name']['product_discount_code']['seller_discount_code']['discount_type']}}">

                                                                                 <!-- <td class="act_crt">
                                                                                     <a href="javascript:;" class="cp text-danger delete_btn_product" del_id="{{ @$prodct['product_name']['id']}}">Delete</a><br>
                                                                                     <a href="javascript:;" class="cp productIdClass" product_id="{{ @$prodct['product_name']['id']}}">Save for Later</a>
                                                                                 </td> -->
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endforeach
                                                        @else
                                                         <a href="{{url('user/buildingMaterialServices')}}">
                                                        @endif
                                                            <div class="col-sm-12">
                                                                <div class="cart_overvew">
                                                                    <div class="shoping__continue">
                                                                        <!-- <div class="shoping__discount text-right">
                                                                            <h5>Discount Codes</h5>
                                                                            <form class="pos_rel">
                                                                                <input type="text" class="form-control discountCode" placeholder="Enter coupon code" value="">
                                                                                <button type="button" class="btn_cpnn applyCoupon">APPLY</button>
                                                                            </form>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="shoping__checkout">
                                                                        <?php
                                                                            $sumAllProduct = App\ProductCart::where('user_id',Auth::user()->id)->pluck('product_quantity_price')->sum();
                                                                            $taxOnProduct = App\ProductTax::first();

                                                                            $sumAllProduc =$taxOnProduct['tax_percent']/100*$sumAllProduct
                                                                            

                                                                        ?>

                                                                        <h5>Cart Total</h5>
                                                                        <ul>
                                                                            <li>Total Price of items <span class="Sum_Product_Price">SR  {{$sumAllProduct}}</span></li>
                                                                            <li>Discount Applied <span class="text-danger DiscountValue">  SR 00.00</span></li>
                                                                            <li>Discounted Price <span class="discountedAmount">SR   {{$sumAllProduct}}</span></li>
                                                                            <li>Shipping to default location <span>SR  00.00</span></li>
                                                                            <li>Estimated Tax <span class="taxAmount">SR   {{$taxOnProduct['tax_percent']/100*$sumAllProduct}}</span></li>
                                                                            <li>Total <span class="grandTotal">SR   {{ $sumAllProduct + $taxOnProduct['tax_percent']/100*$sumAllProduct }}</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                   
                                                </div>
                                                <div class="button_nex_prev">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="text-left">
                                                                <a class="btn btn-secondry second_back" href="javascript:;"><i class="fa fa-arrow-left"></i> Previous</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-right">
                                                                <a class="btn btn_theme third_complete" href="javascript:;"><span>Continue <i class="fa fa-arrow-right"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="register_sec pymnt_type">
                                        <div class="new_div_aded">
                                            <div class="section-heading">
                                                <h2>Payment Method</h2>
                                            </div>
                                            <div class="wrap_register_white">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="pro-paymnt">
                                                            <div class="acc-head">
                                                                <h4> Choose Payment Method </h4>
                                                            </div>
                                                            <div class="acc-pay-detail">
                                                                <div class="form-group ">
                                                                    <div class="tabs_pymnt">
                                                                        <!--  -->
                                                                        <ul class="nav nav-tabs">
                                                                            <li class="nav-item">
                                                                                <a class="text-center nav-link " data-toggle="tab" href="#home"><i class="fa fa-google-wallet"></i><br> Wallet </a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="text-center nav-link active" data-toggle="tab" href="#menu1"><i class="fa fa-credit-card"></i></br> Card</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="text-center nav-link" data-toggle="tab" href="#menu2"><i class="fa fa-exchange"></i><br> Wire Transfer</a>
                                                                            </li>
                                                                        </ul>
                                                                         <input type="hidden" name="card_name" id="card_name" value=" ">
                                                                        <!-- Tab panes -->
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane container fade" id="home">
                                                                                <div class="tab_inr_pay wire_pay">
                                                                                    <h6>Wallet Balance:</h6>
                                                                                    <div class="wlt_balm">
                                                                                        <h2>$ 1456.75</h2>
                                                                                        <p>Current Balance</p>
                                                                                        <div class="button_nex_prev">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-12">
                                                                                                <div class="text-center">
                                                                                                    <a class="btn btn_theme btn_nex" href="myWallet.php"><span>Add Money <i class="fa fa-arrow-right"></i></span></a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane container active" id="menu1">
                                                                                <div class="tab_inr_pay">
                                                                                    <div class="ordr-addr">
                                                                                        <div class="acc-body-addr">
                                                                                            @if(isset($userCards) && sizeof($userCards)>0)
                                                                                                <div class="saved_adrss append_card">
                                                                                                    <!-- <small>Is the Card you would like to use displayed below? If so, click the corresponding "Use Card" button. Or You can add a new Card below.</small> -->
                                                                                                    <div class="row">
                                                                                                        @foreach($userCards as $key => $userCard)
                                                                                                            @if(!empty($userCard))
                                                                                                                <div class="col-sm-6 card_rmv_div">
                                                                                                                    <div class="wrap_svd_adrs mainpaymentdiv card_wrpr">
                                                                                                                           <input type="hidden" name="id_sub" class="sub_id" value="{{$userCard['id']}}">
                                                                                                                        <div class="d-flex justify-content-between">
                                                                                                                            <div class="card_nam">
                                                                                                                                <small> @if($userCard['card_type']=='debit_card') Debit Card @else Credit Card @endif </small><br />
                                                                                                                                <i class="fa fa-credit-card"></i>
                                                                                                                            </div>
                                                                                                                            @if($userCard['use_card_as_default']=='yes')
                                                                                                                                <span class="badg_deflt">Default</span>
                                                                                                                            @endif
                                                                                                                        </div>
                                                                                                                        <h3>xxxx-xxxx-xxxx-{{substr($userCard['card_no'],-4)}}</h3>
                                                                                                                        <p>{{@ucwords($userCard['name_on_card'])}} &nbsp;&nbsp; | &nbsp;&nbsp;{{@sprintf("%02d", $userCard['expiry_month'])}}/{{@$userCard['expiry_year']}}</p>
                                                                                                                        <div class="form-group svd_ic d-flex justify-content-between">
                                                                                                                            <button type="button" class="btn btn_theme use_crd_btn" data-id="{{($userCard['id'])}}"><span>Use Card</span></button>
                                                                                                                            <div data-id="{{base64_encode($userCard['id'])}}">
                                                                                                                                <span class="cp text-primary edt_card"><i class="fa fa-edit"></i> Edit</span><br>
                                                                                                                                <span class="cp text-danger rmv_card"><i class="fa fa-times"></i> Remove</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                            <div class="text-right mb-2">
                                                                                                <a href="javascript:;" class="new_card_p"><i class="fa fa-plus"></i> Add New Card</a>
                                                                                            </div>

                                                                                             <div class="add_new_card">
                                                                                                <div class="odr-head">
                                                                                                    <h4> Add New Card </h4>
                                                                                                </div>
                                                                                               <form class="addCardForm" method="POST">
                                                                                                   @csrf
                                                                                                   <div class="cont_rp_form">
                                                                                                       <div class="row">
                                                                                                           <div class="col-sm-12">
                                                                                                               <div class="form-group text-left">
                                                                                                                   <label>Card Type</label>
                                                                                                                   <select name="card_type" class="form-control custom-select">
                                                                                                                       <option value="" selected>Select Card</option>
                                                                                                                       <option value="debit_card">Debit Card</option>
                                                                                                                       <option value="credit_card">Credit Card</option>
                                                                                                                     </select>
                                                                                                               </div>
                                                                                                           </div>
                                                                                                       </div>
                                                                                                       <div class="row">
                                                                                                           <div class="col-sm-12">
                                                                                                               <div class="form-group text-left">
                                                                                                                   <label>Card Number</label>
                                                                                                                   <input type="text" name="card_no" class="form-control" placeholder="Card Number">
                                                                                                               </div>
                                                                                                           </div>
                                                                                                       </div>
                                                                                                       <div class="row">
                                                                                                           <div class="col-sm-12">
                                                                                                               <div class="form-group text-left">
                                                                                                                   <label>Name on Card</label>
                                                                                                                   <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card">
                                                                                                               </div>
                                                                                                           </div>
                                                                                                       </div>
                                                                                                       <div class="row">
                                                                                                           <div class="col-sm-6">
                                                                                                               <label>Expiry Date</label>
                                                                                                               <div class="row">
                                                                                                                   <div class="col-sm-6">
                                                                                                                       <div class="form-group text-left">
                                                                                                                           <select name="expiry_month" class="form-control custom-select">
                                                                                                                               <option value="" selected>Month</option>
                                                                                                                               <option value="01">01</option>
                                                                                                                               <option value="02">02</option>
                                                                                                                               <option value="03">03</option>
                                                                                                                               <option value="04">04</option>
                                                                                                                               <option value="05">05</option>
                                                                                                                               <option value="06">06</option>
                                                                                                                               <option value="07">07</option>
                                                                                                                               <option value="08">08</option>
                                                                                                                               <option value="09">09</option>
                                                                                                                               <option value="10">10</option>
                                                                                                                               <option value="11">11</option>
                                                                                                                               <option value="12">12</option>
                                                                                                                           </select>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <div class="col-sm-6">
                                                                                                                       <div class="form-group text-left">
                                                                                                                           <select name="expiry_year" class="form-control custom-select">
                                                                                                                               <option value="" selected>Year</option>
                                                                                                                               @for($i=0; $i < 10; $i++)
                                                                                                                                   <option value="{{date('Y')+$i}}">{{date('Y')+$i}}</option>
                                                                                                                               @endfor
                                                                                                                           </select>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                               </div>
                                                                                                           </div>
                                                                                                           <div class="col-sm-6">
                                                                                                               <div class="form-group text-left">
                                                                                                                   <label>CVV Number</label>
                                                                                                                   <input type="password" name="cvv" class="form-control" placeholder="CVV Number">
                                                                                                               </div>
                                                                                                           </div>
                                                                                                       </div>
                                                                                               
                                                                                                       <div class="text-right">

                                                                                                        <a href="javascript:;" class="btn btn_theme add_card_btn"><span>Add Card</span></a>

                                                                                                           <!-- <button class="btn btn_theme add_card_btn"><span>Add Card</span></button> -->
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                   
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane container fade" id="menu2">
                                                                                <div class="tab_inr_pay wire_pay">
                                                                                    <h6>Please enter the following Details:</h6>
                                                                                    <div class="addNewCard">
                                                                                        <form class="" method="">
                                                                                            <!--  -->
                                                                                            <div class="cont_rp_form">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div class="form-group text-left">
                                                                                                            <label>Bank name</label>
                                                                                                            <input type="text" name="" class="form-control" placeholder="Bank name">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div class="form-group text-left">
                                                                                                            <label>Account Name</label>
                                                                                                            <input type="text" name="" class="form-control" placeholder="Account Name">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div class="form-group text-left">
                                                                                                            <label>Account iBAN Number</label>
                                                                                                            <input type="text" name="" class="form-control" placeholder="Account iBAN Number">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <div class="form-group text-left">
                                                                                                            <label>Attach copy of transfer receipt</label>
                                                                                                            <div class="custom-file">
                                                                                                                <input type="file" class="custom-file-input" id="customFile">
                                                                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                                                                              </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--  -->
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--  -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="cart_overvew">
                                                           <!--  <div class="shoping__continue">
                                                                <div class="shoping__discount">
                                                                    <h5>Supplier 1 Total</h5>
                                                                    <form action="javascript:;" class="pos_rel">
                                                                        <input type="text" class="form-control" placeholder="Enter coupon code">
                                                                        <button type="submit" class="btn_cpnn">APPLY</button>
                                                                    </form>
                                                                </div>
                                                            </div> -->
                                                            <div class="shoping__checkout">
                                                                <h5>Cart Total</h5>
                                                                <ul>
                                                                    <li>Total Price of items <span class="Sum_Product_Price">SR {{$sumAllProduct}}</span></li>
                                                                    <li>Discount Applied <span class="text-danger DiscountValue"> SR 00.00</span></li>
                                                                    <li>Discounted Price <span class="discountedAmount">SR {{$sumAllProduct}}</span></li>
                                                                    <li>Shipping to default location <span>SR 00.00</span></li>
                                                                    <li>Estimated Tax <span class="taxAmount">SR {{$taxOnProduct['tax_percent']/100*$sumAllProduct}}</span></li>
                                                                    <li>Total <span class="grandTotal">SR {{ $sumAllProduct + $taxOnProduct['tax_percent']/100*$sumAllProduct }}</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button_nex_prev">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="text-left">
                                                                <a class="btn btn-secondry third_back" href="javascript:;"><i class="fa fa-arrow-left"></i> Previous</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-right">
                                                               <a class="btn btn_theme forth_complete" href="javascript:;"><span>Make payment of SR <span class="grandTotal">{{ $sumAllProduct + $taxOnProduct['tax_percent']/100*$sumAllProduct }}</span> <i class="fa fa-arrow-right"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
   

                                    <?php 
                                        $user_id   = Auth::User()->id;
                                        $user      = App\User::where('id',$user_id)->first(); 
                                        $image     = userProfileImagePath.'/'.$user['profile_image'];

                                    ?>

                                    <section class="register_sec confrmtn_div">
                                        <div class="new_div_aded">
                                            <div class="section-heading">
                                                <h2>Order Alert</h2>
                                            </div>
                                            <div class="wrap_register_white">
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-4">
                                                        <div class="info_ordr text-center">
                                                            <img src="{{asset('public/frontend/img/logo.png')}}" class="img-fluid">
                                                            <h3>Hey! {{$user['first_name']}},</h3>
                                                            <p class="">Your order has been place successfully.</p>
                                                            <p class="ord_id_suc"><i>Your Order ID is:<span class="success_order_id"></span></i></p>
                                                            <p><a href="trackOrder.php" class="cp">Track Order of Supplier 1</a></p>
                                                            <div class="btn_comb">
                                                                <a class="btn btn_theme" href="{{url('user/buildingMaterialServices')}}"><span>Continue Shopping</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="button_nex_prev">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="text-right">
                                                                <a class="btn btn_theme" href="javascript:;"><span>Submit <i class="fa fa-arrow-right"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </section>
                                    <!-- stepper -->
                                </div> 
                            </div>
                        </div>
                         <input type="hidden" name="discountCode" value="" id="discountCode">
                    <input type="hidden" name="" value="{{Auth::user()->id}}" class="userId">
                </div>
            </section>
        </div>

    @include('frontend.include.modals.cartEditAddress')
    
    @include('frontend.include.modals.cartEditCard')    
@stop
@section('script')

        <script>
            $(document).ready(function(){ 
                var ths;
                $( ".productIdClass" ).click(function() {
                  ths = $(this);  
                  var productId  = $(this).attr('product_id');
                  var userId     = $('.userId').val();
                   
                    $.ajax({
                            url: "{{url('provider/wishlist/addCartProduct')}}",
                            type:'post',
                            data:{productId:productId,userId:userId,_token:"{{ csrf_token() }}" },
                            success:function(response){
                                if(response['status']=="true") {                
                                      location.reload(); 
                                      toastr.success('Product successfully added in whislist');
                                      $('.discountCode').val();
                                }else if(response['status']=='vaccantCart'){
                                           location.href='{{url('/login')}}';
                                           toastr.success('Your Cart is empty');     
                                }else{
                                  swal('Oops, Something went wrong');
                                }
                            },error(){
                                toastr.error('Something went wrong');
                            }
                    })
                });
            })
        </script>

    

        <script>
            $(document).ready(function(){
                $('.change_quantity').on('change',function(){
                    var ths = $(this);
                    var quantity_number = $(this).val();
                    var price = $('.final_prc1').val();

                    var discount_type  = $(this).closest('.main_row').find('.discount_type').val();
                    // alert(discount_type);
                    var discountAmount = $(this).closest('.main_row').find('.discountAmount').val();
                    // alert(discountAmount);
                    var productPrice = $(this).closest('.main_row').find('.product_price').val();
                    // alert(productPrice);

                    var cart_id = $(this).attr('cart_id');
                    $.ajax({
                        url  : "{{url('user/update/Cart')}}",
                        type : 'post',
                        data : {quantity_number:quantity_number,cart_id:cart_id,productPrice:productPrice,discount_type:discount_type, discountAmount:discountAmount },
                        success:function(response){
                            if(response['status']=="success") {
                                
                                $('.Sum_Product_Price').html('SR ' + response['Sum_Product_Price'])

                                $('.taxAmount').html('SR ' + response['taxAmount'])
                                 
                                $('.grandTotal').html('SR ' + response['grandTotal'])

                                

                                
                                ths.closest('.main_row').find('.single_price').html('SR ' + response['singleUnitPrice'])
                                ths.closest('.main_row').find('.tr_price_total_multiply_quantity').html('SR ' + response['productPrice'])

                                if(discount_type=='percent'){
                                    balanceAmount =  response['discount_prc'];
                                    ths.closest('.main_row').find('.total_discount_prc').html('SR ' + balanceAmount)

                                }else if(discount_type=='value'){
                                    balanceAmount = response['discount_prc'];
                                    ths.closest('.main_row').find('.total_discount_prc').html('SR ' + balanceAmount)
                                } 
                                // discountedAmount
                                   $('.discountedAmount').html('SR ' + '0.00')
                                   $('.DiscountValue').html('SR ' + '0.00')
                                      // $('.DiscountValue').html('')
                            }
                        },error(){
                            toastr.error('Something went wrong');
                        }   
                    })
                });
            })

        </script>

             <script> 
                $(document).ready(function(){
                    $('.applyCoupon').on('click',function(){
                        var discountCode = $('.discountCode').val();
                         $('#discountCode').val(discountCode);
                        var userId     = $('.userId').val();

                        if(discountCode){
                        // alert(discountCode);

                            $.ajax({
                                    url: "{{url('user/check/CouponInCart')}}",
                                    type:'post',
                                    data:{discountCode:discountCode,userId:userId,_token:"{{ csrf_token() }}" },
                                    success:function(check_coupon){
                                        if(check_coupon['status']=="true") {   
                                            $('.Sum_Product_Price').html('SR ' + check_coupon['Sum_Product_Price'])
                                            $('.DiscountValue').html('SR ' + check_coupon['DiscountValue'])
                                            $('.discountedAmount').html('SR ' + check_coupon['discountedAmount'])
                                            $('.taxAmount').html('SR ' + check_coupon['taxAmount'])    
                                            $('.grandTotal').html('SR ' + check_coupon['grandTotal'])

                                            toastr.success('Discount code is applied');

                                        }else if(check_coupon['status']=="false") {
                                            $('.Sum_Product_Price').html('SR ' + check_coupon['Sum_Product_Price'])
                                            $('.DiscountValue').html('SR ' + '0.00')
                                            $('.discountedAmount').html('SR ' + '0.00')
                                            $('.taxAmount').html('SR ' + check_coupon['taxAmount'])    
                                            $('.grandTotal').html('SR ' + check_coupon['grandTotal'])
                                            
                                            toastr.error('Something went wrong');
                                        }
                                    },error(){
                                        toastr.error('Something went wrong');
                                    }
                            })
                        }else{
                            toastr.error('please add coupon code');
                        }
                    
                    });
                })
        </script>


        <script>
             $('.plan_wrpr').removeClass('active');
             $('.addressDeliverUser').hide();
             $('input[type=radio][name=delivery_adrress]').on('change', function() {
                var deliverySelected = $(this).val();
                    // alert(deliverySelected);
                 if(deliverySelected == 'select_user_address'){
                    $('.addressDeliverUser').show();
                    $('.plan_wrpr').removeClass('active');
                 }else if(deliverySelected == 'pick_up_from_store'){
                    $('.addressDeliverUser').hide();
                 }
             });
        </script>

       <script>
             $(document).on('click','.chooseDeiveryAddress',function(){
                var ths = $(this);
                var delivery_id = ths.attr('data-id');
                
                $('.plan_wrpr').removeClass('active');
                $(this).closest('.plan_wrpr').addClass('active');

                swal('Deliver to this address');
                $('#delivery_adrress_id').val(delivery_id);

            });
        </script>

        <script>
            $('.register_sec').hide();
            $('.register_sec.cart_prod_sec').show();
            
            $('.first_complete').on('click',function(){
                $(this).closest('.register_sec').slideUp();
                $(this).closest('.register_sec').next('.register_sec').slideDown();
                $('.second_dot').addClass('active');
                $('.first_dot').removeClass('active');

            });

            $('.first_back').on('click',function(){
                $(this).closest('.register_sec').slideUp();
                $(this).closest('.register_sec').prev('.register_sec').slideDown();
                $('.first_dot').addClass('active');
                $('.second_dot').removeClass('active');
            });

          $(document).on('click','.second_complete',function(){
                var delivery_id = $('#delivery_adrress_id').val();
                var user_addr   = $('#user_addr').prop('checked');
                if(user_addr == true){
                    if(delivery_id != ''){
                        $(this).closest('.register_sec').slideUp();
                        $(this).closest('.register_sec').next('.register_sec').slideDown();
                        $('.third_dot').addClass('active');
                        $('.second_dot').removeClass('active');
                    }else{
                        swal('Please Select user address');
                        return false;
                    }
                }else{
                    $(this).closest('.register_sec').slideUp();
                    $(this).closest('.register_sec').next('.register_sec').slideDown();
                    $('.third_dot').addClass('active');
                    $('.second_dot').removeClass('active');
                }
            });

            $('.second_back').on('click',function(){
                $(this).closest('.register_sec').slideUp();
                $(this).closest('.register_sec').prev('.register_sec').slideDown();
                $('.second_dot').addClass('active');
                $('.third_dot').removeClass('active');
            });

            $('.third_complete').on('click',function(){
                $(this).closest('.register_sec').slideUp();
                $(this).closest('.register_sec').next('.register_sec').slideDown();
                $('.fourth_dot').addClass('active');
                $('.third_dot').removeClass('active');
            });

            $('.third_back').on('click',function(){
                $(this).closest('.register_sec').slideUp();
                $(this).closest('.register_sec').prev('.register_sec').slideDown();
                $('.third_dot').addClass('active');
                $('.fourth_dot').removeClass('active');
            });

            // $('.forth_complete').on('click',function(){
            //     $(this).closest('.register_sec').slideUp();
            //     $(this).closest('.register_sec').next('.register_sec').slideDown();
            //     $('.fifth_dot').addClass('active');
            //     $('.fourth_dot').removeClass('active');
            // });
            // old code///////////////

            $(document).on('click','.forth_complete',function(){
                    ths = $(this);
                    var user_addr    = $('#user_addr').prop('checked');
                    var delivery_id  = $('#delivery_adrress_id').val();
                    var discountCode = $('#discountCode').val();
                    var userId =  $('.userId').val();
                    if(user_addr == true){
                          var choose_address  = 'user';
                          if(delivery_id != ''){
                              var delivery_id = delivery_id;
                          }
                    }else{
                          var choose_address  = 'store';
                          var delivery_id = '';
                    }
                    var card_name = $('#card_name').val();
                    if(card_name == ' '){
                        swal('Please select card');
                    }else{   

                        $.ajax({
                            type:'post',
                            url: "{{url('user/deliverey/payment')}}",
                            data:{choose_address:choose_address,delivery_id:delivery_id,card_name:card_name,discountCode:discountCode,userId:userId},
                            success:function(resp){
                                if(resp.status == 'true'){
                                    $('.success_order_id').html(resp.order_id);
                                    toastr.success('success',resp.msg);
                                    ths.closest('.register_sec').slideUp();
                                    ths.closest('.register_sec').next('.register_sec').slideDown();
                                    $('.fifth_dot').addClass('active');
                                    $('.fourth_dot').removeClass('active');
                                    $('.cart_count').hide();
                                }
                            }
                        });
                    }
              });



            // $('.forth_back').on('click',function(){
            //  $(this).closest('.register_sec').slideUp();
   //              $(this).closest('.register_sec').prev('.register_sec').slideDown();
   //              $('.third_dot').addClass('active');
   //              $('.fourth_dot').removeClass('active');
   //       });         

        </script>



      

       
        <script type="text/javascript">
               $("#first_complete").click(function(){

               // register_sec_next = $(this).closest('.register_sec').next(".register_sec");
               // register_sec_prev = $(this).closest('.register_sec').prev(".register_sec");
                                    
               $(".first_dot").removeClass('active');
               $(".second_dot").addClass('active');
                                 
            });

        </script>

        <script type="text/javascript">
          $(document).on('click','.add_adrs_btn',function(){
            ths = $(this)
                   memberData = $(".addAddressForm").serialize();
                   var  registered_id =  $('.registered_id').val();
                    if ($('.addAddressForm').valid()) {
                       
                        $.ajax({
                            type:'post',
                            url: "{{url('user/deliverey/address/add')}}",
                            data:memberData,
                            success:function(data){
                               $('.append_row').html(data);
                               $('.user_ad_adrss').slideToggle('normal');
                               $(".addAddressForm")[0].requiredeset();
                               
                            }
                    });
                };
            
          });
        </script>

        <script type="text/javascript">
            $('body').on('click', '.delivery_adrress', function(){
                $('.ordr-addr').show();
            });

            $('body').on('click', '.supplier_address', function(){
                $('.ordr-addr').hide();
            });

        </script>

        <script type="text/javascript">
              $('.user_ad_adrss').hide();
            $('body').on('click', '.new_adrs_p', function(){
                $('.user_ad_adrss').slideToggle('normal');
            });

            $("body").on('change','.chng_cntry',function(){
                var country_id = $(this).val();
                ths = $(this);
                // alert(country_id);
                $.ajax({
                    url:"{{url('getCountryRelatedCities')}}",
                    data:{ country_id:country_id,_token:"{{ csrf_token() }}" },
                    type:'POST',
                    success:function(data){
                        // $('.chng_city').html(data);
                        ths.closest('.addrs_div').find('.chng_city').html(data);
                    } 
                }); 
            });

        </script>



        <script>
            $(document).on('click','.delete_btn_product',function(e){
                e.preventDefault();
                var id =$(this).attr('del_id');
                // alert(id);
                var ths = $(this);
                swal({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                    $.ajax({
                         url: "{{ url('provider/cartItem/delete') }}" + '/' + id,
                        success:function(resp){
                            $('.loader').hide();
                             location.reload(); 
                           if (resp.status=='true') {
                               ths.closest('tr').remove();
                               Swal.fire(
                                 'Deleted!',
                                 'Your product has been deleted.',
                                 'success'
                               )

                            location.reload();
                            $('.discountCode').val(''); 
                           }else if(resp.status=='vaccantCart'){
                                location.href='{{url('/login')}}';
                                toastr.success('Your Cart is empty');     
                           }else{
                               swal('Oops, Something went wrong');
                           }
                        },
                        error:function(){
                            $(".loader").hide();
                            swal('Oops, Something went wrong');
                        }
                    });
                  }
                })            
            });
        </script>

        <script type="text/javascript">
           $('.addAddressForm').validate({
            ignore:[],
            rules:{
                address_title:{
                    required:true
                },
                address:{
                },
                province_name:{
                    required:true
                },
                postal_code:{
                    required:true,
                    digits:true
                },
                country_id:{
                    required:true
                },
                // state_id:{
                //     required:true
                // },
                // city:{
                //     required:true
                // },
                city_id:{
                    required:true
                },
                location:{
                    required:true
                }
            },
            messages:{
                address_title:{
                    required:"Please enter address title"
                },
                address:{
                    required:"Please enter address"
                },
                province_name:{
                    required:"Please enter province name",
                },
                postal_code:{
                    required:"Please enter postal code",
                },
                country_id:{
                    required:"Please select country",
                },
                // state_id:{
                //     required:"Please select state",
                // },
                // city:{
                //     required:"Please enter city",
                // },
                city_id:{
                    required:"Please select city",
                },
                location:{
                    required:"Please enter location",
                }
            }
        });



        // $("body").on('click','.add_adrs_btn',function(){
        //     $('.addAddressForm').submit();
        // });

        $("body").on('click','.edt_adrs',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_address_id = $(this).parent().data('id');
            $.ajax({
                url:"{{url('user/deliverey/address/editModal/')}}"+"/"+enc_address_id,
                type: "post",
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        $('.adrs_div_mod').html(resp.html);
                        $('#edit_cart_addrs_mod').modal('show');
                    }else{
                        toastr.error('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
        });
        
        // $("body").on('click','.edt_adrs_btn',function(e){
        //     e.preventDefault();
        //     $('#editAddressForm').submit();
        // });

       

       $("body").on('click','.edt_adrs_btn',function(e){
                e.preventDefault();
                memberData = $(".editAddressForm").serialize();
            // alert($(this).parent().data('id'));
            // var enc_address_id = $(this).parent().data('id');
            $.ajax({
                url:"{{url('user/deliverey/address/update')}}",
                type: "post",
                data:memberData,
               success:function(data){
                  $('.append_row').html(data);
                    $('#edit_cart_addrs_mod').modal('hide');
               }
            });
        });


        $("body").on('click','.rmv_adrs',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_address_id = $(this).parent().data('id');
            var ths = $(this);
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                    url:"{{url('user/deliverey/address/delete/')}}"+"/"+enc_address_id,
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                          
                            ths.closest('.remv_div').remove();
                             // ths.closest('.user_adrs').remove();
                            Swal.fire(
                              'Deleted!',
                              'Your delivery address has been deleted.',
                              'success'
                            )
                        }else if(resp.status=='false'){

                            Swal.fire('Not Deleted',' Because Only one address is left.')
                        }
                    },
                    error:function(){
                        $(".loader").hide();
                        swal('Oops, Something went wrong');
                    }
                });
              }
            })            
        });

        $("body").on('click','.use_adrs_btn',function(){
            // alert('here');
            // alert($(this).prev().data('id'));
            $('.adrs_id_cls').val($(this).prev().data('id'));
            $('#use_address_as_default_mod').modal('show');
        });

     </script>

    <script>
        $('.add_new_card').hide();
        $('body').on('click', '.new_card_p', function(){
            $('.add_new_card').slideToggle('normal');
        });

        $('.addCardForm').validate({
            ignore:[],
            rules:{
                card_type:{
                    required:true
                },
                card_no:{
                    required:true,
                    digits:true,
                    minlength:16,
                    maxlength:16,
                },
                name_on_card:{
                    required:true,
                    // noSpace:true,
                    regex:regex_user_name,
                },
                expiry_month:{
                    required:true
                },
                expiry_year:{
                    required:true
                },
                cvv:{
                    required:true
                },
            },
            messages:{
                card_type:{
                    required:"Please select card type"
                },
                card_no:{
                    required:"Please enter card number",
                    minlength:"Please enter 16 digit number",
                    maxlength:"Please enter 16 digit number",
                },
                name_on_card:{
                    required:"Please enter name on card",
                },
                expiry_month:{
                    required:"Please select month",
                },
                expiry_year:{
                    required:"Please select year",
                },
                cvv:{
                    required:"Please enter cvv number",
                },
            }
        });
    </script>

    <script type="text/javascript">
        $(".add_card_btn").click(function(){
            ths = $(this);
                memberData = $(".addCardForm").serialize();
                if ($('.addCardForm').valid()) {
                     $.ajax({
                         type:'post',
                         url: "{{url('user/deliverey/card/add')}}",
                         data:memberData,
                         success:function(data){
                            $('.append_card').html(data);
                            $('.add_new_card').slideToggle('normal');
                            // $('.addCardForm')[0].requiredeset();
                            $('.addCardForm').trigger("reset");
                            // $('.addCardForm').reset();
                         }
                 });
             };
         
       });

        $("body").on('click','.edt_card',function(e){
            e.preventDefault();
            // alert('sd');
            // alert($(this).parent().data('id'));
            var enc_card_id = $(this).parent().data('id');
            $.ajax({
                url:"{{url('user/deliverey/card/editModal')}}"+"/"+enc_card_id,
                type: "post",
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        $('.card_div_mod').html(resp.html);
                        $('#edit_card').modal('show');
                    }else{
                        swal('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
        });


        $("body").on('click','.edt_card_btn',function(e){
                 e.preventDefault();
                 memberData = $(".editCardForm").serialize();
             // alert($(this).parent().data('id'));
             // var enc_address_id = $(this).parent().data('id');
             $.ajax({
                 url:"{{url('user/deliverey/card/update')}}",
                 type: "post",
                 data:memberData,
                success:function(data){
                   $('.append_card').html(data);
                     $('#edit_card').modal('hide');
                }
             });
         });


        $("body").on('click','.rmv_card',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_card_id = $(this).parent().data('id');
            var ths = $(this);
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                    url:"{{url('user/deliverey/card/delete')}}"+"/"+enc_card_id,
                    success:function(resp){
                           $('.loader').hide();
                          if (resp.status=='success') {
                            
                              ths.closest('.card_rmv_div').remove();
                               // ths.closest('.user_adrs').remove();
                              Swal.fire(
                                'Deleted!',
                                'Your Card has been deleted.',
                                'success'
                              )
                          }else if(resp.status=='false'){

                              Swal.fire('Not Deleted',' Because Only one address is left.')
                          }
                    },
                    error:function(){
                        $(".loader").hide();
                        swal('Oops, Something went wrong');
                    }
                });
              }
            })            
        });
    </script>   


            <script>
                   $("body").on('click','.use_crd_btn',function(){
                    var ths = $(this);
                    var card_val =  ths.attr('data-id');

                    $('.card_wrpr').removeClass('active');
                    $(this).closest('.card_wrpr').addClass('active');
                    // alert(card_val);
                    $('#card_name').val(card_val);
                    swal('Card is selected for payment');

                });
            </script>


@stop