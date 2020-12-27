@extends('frontend.layout.layout')
@section('title','My Orders')
@section('content')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
        <!-- Header -->
        
        <!-- Header ends -->
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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
                                    <h4>My Orders</h4>
                                    <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                                </div>
                                <div class="main_cntnt_dash">
                                    <div class="card order_prof_dash">
                                        <div class="tabs_pymnt">
                                            <!--  -->
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="text-center nav-link active" data-toggle="tab" href="#delvrd"> Delivered </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="text-center nav-link" data-toggle="tab" href="#progrs"> In Progress</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="text-center nav-link" data-toggle="tab" href="#canceled"> Order Cancelled</a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane container active" id="delvrd">
                                                    <div class="inr_tabs_cntnt">
                                                        <div class="cont_shd_frm">
                                                            <div class="wrap_ords_his">

                                                                @foreach($deliveredOrderItems as $key=>$order)
                                                                <div class="order_one_single">
                                                                    <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                        <div class="ordr_sellr_hedr d-flex flex-row">
                                                                            <span class="text-center">
                                                                                <small>Order ID</small><br>
                                                                              {{@$order['invoice_id']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Order Amount</small><br>
                                                                                  SR {{@$order['final_total']}}
                                                                            </span>
                                                                            @if(@$order['order_items'][0]['address_type'] == 'DeliveryAddress')
                                                                                <span class="text-center">
                                                                                    <small>Ship To</small><br>
                                                                                    {{@$order['order_items'][0]['delivery_address']['location']}} 
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <span class="text-center mr-0">
                                                                            <small>Order Place on: {{@$order['placed_on']}}</small><br>
                                                                            <a  href="{{url('/user/product/orderDetails/'.base64_encode($order['invoice_id']))}}" class="cp "> View Detail </a>
                                                                        </span>
                                                                    </div>
                                                                    <div class="ord_seller_wrap">
                                                                        <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                            <div class="ordr_sellr_hedr d-flex flex-row">
                                                                                <span class="text-center">
                                                                                    <small>Order ID</small><br>
                                                                                    {{@$order['invoice_id']}}
                                                                                </span>
                                                                                <span class="text-center">
                                                                                    <small>Order Amount</small><br>
                                                                                    SR {{@$order['final_total']}}
                                                                                </span>
                                                                                <span class="text-center">
                                                                                    <small>Seller</small><br>
                                                                                    {{ ucfirst(@$order['order_items'][0]['product_name']['seller_name']['contact_name']) }}
                                                                                </span>
                                                                            </div>
                                                                             <a href="#" class="ord_track yourlinkDelivered " key="{{$key}}"> View Detail </a>
                                                                        </div>
                                                                        <div class="ord_meta">
                                                                            <div class="table_responsive">
                                                                                <table class="table">
                                                                                    <tbody>
                                                                                    @foreach($order['order_items'] as $order_items)
                                                                                        <tr>
                                                                                            <?php 
                                                                                                $image = defaultAdminImagePath.'/no_image.png';
                                                                                                if(!empty(@$order_items['product_name']['product__image_for_order__item']['name'])){
                                                                                                    @$image = asset('public/frontend/images/products/'.$order_items['product_name']['product__image_for_order__item']['name']);
                                                                                                }                      
                                                                                            ?>  

                                                                                            <td>
                                                                                                 <img src="{{ $image}}" alt="" class="img-fluid itm_ord">
                                                                                            </td>
                                                                                           <td>
                                                                                                <p class="ord_nam productDeliveredId{{$key}}" productDeliveredId="{{base64_encode($order_items['product_name']['id'])}}">{{@$order_items['product_name']['item_name']}}</p>
                                                                                                <p class="col_meta"><small>Unit: {{@$order_items['product_unit']}}.</small></p>
                                                                                                <p class="siz_met"><small>Quantity: {{@$order_items['quantity']}}</small></p>
                                                                                                 <a class="cp ratingREview"  data-id="{{@$order_items['product_name']['id']}}">Write a Review</a>
                                                                                            </td>
                                                                                            <td class="pr_meta">SR {{@$order_items['quantity_price']}} </td>
                                                                                            <td>
                                                                                                <p class="ord_nam text-success">Delivered</p>
                                                                                                <p class="col_meta"><small>Payment via Card.</small></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                       
                                                                                    @endforeach 
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                </div>  <!-- lk -->
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane container fade" id="progrs">
                                                    <div class="inr_tabs_cntnt">
                                                        <div class="cont_shd_frm">
                                                            <div class="wrap_ords_his">
                                                            @foreach($orders as $key=>$order)
                                                                @if($order['order_status']!='Order Cancelled')
                                                                @if($order['order_status']!='delivered')
                                                                <div class="order_one_single">
                                                                    <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                        <div class="ordr_sellr_hedr d-flex flex-row">
                                                                            <span class="text-center">
                                                                                <small>Order ID</small><br>
                                                                                {{@$order['invoice_id']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Order Amount</small><br>
                                                                                SR {{@$order['final_total']}}
                                                                            </span>
                                                                            @if(@$order['order_items'][0]['address_type'] == 'DeliveryAddress')
                                                                                <span class="text-center">
                                                                                    <small>Ship To</small><br>
                                                                                    {{@$order['order_items'][0]['delivery_address']['location']}} 
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <span class="text-center mr-0">
                                                                            <small>Order Place on: {{@$order['placed_on']}}</small><br>
                                                                           <a  href="{{url('/user/product/orderDetails/'.base64_encode($order['invoice_id']))}}" class="cp "> View Detail </a>
                                                                        </span>
                                                                    </div>
                                                                    <div class="btn_acttt text-right">
                                                                        <a class="btn btn-primary">Track Order</a>
                                                                    </div>
                                                                    
                                                                    <div class="ord_seller_wrap">
                                                                        <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                            <div class="ordr_sellr_hedr d-flex flex-row">
                                                                                <span class="text-center">
                                                                                    <small>Order ID</small><br>
                                                                                   {{@$order['invoice_id']}}
                                                                                </span>
                                                                                <span class="text-center">
                                                                                    <small>Order Amount</small><br>
                                                                                    SR {{@$order['final_total']}}
                                                                                </span>
                                                                                <span class="text-center">
                                                                                    <small>Seller</small><br>
                                                                                    {{ ucfirst(@$order['order_items'][0]['product_name']['seller_name']['contact_name']) }}
                                                                                          
                                                                                </span>
                                                                            </div>
                                                                          <a href="#" class="ord_track yourlink " key="{{$key}}"> View Detail </a>
                                                                        </div>
                                                                        <div class="ord_meta">
                                                                            <div class="table_responsive">
                                                                                <table class="table">
                                                                                    <tbody>
                                                                                    @foreach($order['order_items'] as $order_items)
                                                                                        @if(@$order_items['product_order_status_id']!=5)
                                                                                        @if(@$order_items['product_order_status_id']!=8)
                                                                                        <tr>
                                                                                            <?php 
                                                                                             
                                                                                              $image = defaultAdminImagePath.'/no_image.png';
                                                                                               if(!empty(@$order_items['product_name']['product__image_for_order__item']['name'])){
                                                                                                    @$image = asset('public/frontend/images/products/'.$order_items['product_name']['product__image_for_order__item']['name']);
                                                                                               }                      
                                                                                            ?>  
                                                                                            <td>
                                                                                                <a href="{{url('https://pro.promaticstechnologies.com/build_mart/view/productDeatil/'.$order_items['id'])}}">
                                                                                                <img src="{{ $image}}" alt="" class="img-fluid itm_ord">
                                                                                                </a>
                                                                                            </td>

                                                                                        <!--     ('https://pro.promaticstechnologies.com/build_mart/view/productDeatil/'+idProduct) -->

                                                                                            <td>
                                                                                                <p class="ord_nam productId{{$key}}" productIdd="{{base64_encode($order_items['product_name']['id'])}}">{{@$order_items['product_name']['item_name']}}</p>
                                                                                                <p class="col_meta"><small>Unit: {{@$order_items['product_unit']}}.</small></p>
                                                                                                <p class="siz_met"><small>Quantity: {{@$order_items['quantity']}}</small></p>
                                                                                                <!--   <a class="cp ratingREview"  data-id="{{@$order_items['product_name']['id']}}">Write a Review</a> -->
                                                                                            </td>

                                                                                            <td class="pr_meta">SR {{@$order_items['quantity_price']}} </td>
                                                                                          
                                                                                            <td>
                                                                                                <p class="ord_nam text-success">{{@$order_items['product_order_status']['name']}}</p>

                                                                                                <p class="col_meta"><small>Payment via Card.</small></p>

                                                                                            </td>
                                                                                            
                                                                                              @if(@$order_items['product_order_status']['id']==1)
                                                                                            <td class="cancl_ordr text-center">
                                                                                               <a class="btn btn-danger cancelOrder"  orderId="{{$order['id']}}" productId="{{@$order_items['product_name']['id']}}" >Cancel Order</a>
                                                                                            </td>
                                                                                            @endif
                                                                                        </tr>
                                                                                        @endif
                                                                                        @endif

                                                                                    @endforeach 
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane container fade" id="canceled">
                                                    <div class="inr_tabs_cntnt">
                                                        <!--  -->
                                                     <div class="cont_shd_frm">
                                                        <div class="wrap_ords_his">
                                                              @foreach($ordersItemStatus as $key=>$ordersItemStatusProduct)
                                                             

                                                           <div class="order_one_single">
                                                                <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                    <div class="ordr_sellr_hedr d-flex flex-row">
                                                                        <span class="text-center">
                                                                            <small>Order ID</small><br>
                                                                            {{@$ordersItemStatusProduct['invoice_id']}}
                                                                        </span>
                                                                        <span class="text-center">
                                                                            <small>Order Amount</small><br>
                                                                            SR {{@$ordersItemStatusProduct['final_total']}}
                                                                        </span>
                                                                        @if($ordersItemStatusProduct['order_items'][0]['address_type'] == 'DeliveryAddress')
                                                                            <span class="text-center">
                                                                                <small>Ship To</small><br>
                                                                                {{$ordersItemStatusProduct['order_items'][0]['delivery_address']['location']}} 
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <span class="text-center mr-0">
                                                                        <small>Order Place on: {{@$ordersItemStatusProduct['placed_on']}}</small><br>
                                                                       <a  href="{{url('/user/product/orderDetails/'.base64_encode($ordersItemStatusProduct['invoice_id']))}}" class="cp "> View Detail </a>
                                                                    </span>
                                                                </div>
                                                                <div class="btn_acttt text-right">
                                                                    <!-- <a class="btn btn-danger">Cancel Order</a> -->
                                                                    <a class="btn btn-primary">Track Order</a>
                                                                </div>
                                                                
                                                                <div class="ord_seller_wrap">
                                                                    <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                        <div class="ordr_sellr_hedr d-flex flex-row">
                                                                            <span class="text-center">
                                                                                <small>Order ID</small><br>
                                                                               {{@$ordersItemStatusProduct['invoice_id']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Order Amount</small><br>
                                                                                SR {{@$ordersItemStatusProduct['final_total']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Seller</small><br>

                                                                                {{ ucfirst($ordersItemStatusProduct['order_items'][0]['product_name']['seller_name']['contact_name']) }}
                                                                            </span>
                                                                        </div>
                                                                      <a href="#" class="ord_track yourlinkCancelled " key="{{$key}}"> View Detail </a>
                                                                    </div>
                                                                    <div class="ord_meta">
                                                                        <div class="table_responsive">
                                                                            <table class="table">
                                                                                <tbody>
                                                                                @foreach($ordersItemStatusProduct['order_items'] as $order_item)
                                                                                    
                                                                                    <tr>
                                                                                        <?php 
                                                                                         
                                                                                            $image = defaultAdminImagePath.'/no_image.png';
                                                                                            if(!empty($order_item['product_name']['product__image_for_order__item']['name'])){
                                                                                               $image = asset('public/frontend/images/products/'.$order_item['product_name']['product__image_for_order__item']['name']);
                                                                                            }
                                                                                                                   
                                                                                        ?>  
                                                                                        <td>
                                                                                            <img src="{{ $image}}" alt="" class="img-fluid itm_ord">

                                                                                           
                                                                                        </td>

                                                                                       <td>
                                                                                            <p class="ord_nam productCancelledId{{$key}}" productCancelledId="{{base64_encode($order_item['product_name']['id'])}}">{{@$order_item['product_name']['item_name']}}</p>
                                                                                            <p class="col_meta"><small>Unit: {{@$order_item['product_unit']}}.</small></p>
                                                                                            <p class="siz_met"><small>Quantity: {{@$order_item['quantity']}}</small></p>
                                                                                            
                                                                                        </td>

                                                                                        <td class="pr_meta">SR {{@$order_item['quantity_price']}} </td>
                                                                                      
                                                                                        <td>
                                                                                           
                                                                                          <p class="ord_nam text-success">{{@$order_item['product_order_status']['name']}}</p>
                                                                                            <p class="col_meta"><small>Payment via Card.</small></p>
                                                                                            <!-- <a href="" class="cp ch_rmv">Change/Remove Order</a> -->
                                                                                        </td>
                                                                                        
                                                                                        

                                                                                    </tr>
                                                                                @endforeach 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                        <!--  -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>     
        </div>

@include('frontend.include.modals.review_rating')
@include('frontend.include.modals.cancelOrderRequestByUser')
@stop
@section('script')


<script>
    $('body').ready(function(){
        $('.yourlink').click(function(e) {
             e.preventDefault();
             
                var keyId = $(this).attr('key');

                $(".productId"+keyId).each(function() {
                   var idProduct = $(this).attr('productIdd');
                   // alert(idProduct);
                   window.open('https://pro.promaticstechnologies.com/build_mart/view/productDeatil/'+idProduct);
                              

                }); 

        });
    })

    /////////cancelled//page///////
    $('body').ready(function(){
        $('.yourlinkCancelled').click(function(e) {
             e.preventDefault();         
                var keyId = $(this).attr('key');
                $(".productCancelledId"+keyId).each(function() {
                   var idProduct = $(this).attr('productCancelledId');
                   // alert(idProduct);
                   window.open('https://pro.promaticstechnologies.com/build_mart/view/productDeatil/'+idProduct);
                }); 
        });
    })    

    /////////delivered//page///////
    $('body').ready(function(){
        $('.yourlinkDelivered').click(function(e) {
             e.preventDefault();         
                var keyId = $(this).attr('key');
                $(".productDeliveredId"+keyId).each(function() {
                   var idProduct = $(this).attr('productDeliveredId');
                   // alert(idProduct);
                   window.open('https://pro.promaticstechnologies.com/build_mart/view/productDeatil/'+idProduct);
                }); 
        });
    }) 



</script>

<script>
    $("body").on('click','.cancelOrder',function(e){
        e.preventDefault();
         var productId = $(this).attr('productId');
         var orderId = $(this).attr('orderId');

         $('.productIDD').val(productId)
         $('.orderIDD').val(orderId)
         $('#cancelOrderUserRequest').modal('show');
         // alert(orderId);
    });
     
</script>

<script type="text/javascript">
    $(".rate_yo").rateYo({starWidth: "30px",rating:'1',fullStar: true}).on("rateyo.change", function (e, data) {
        var rating = data.rating;
        // alert(rating);
        $('#star_rating').val(rating);
    });
</script>

<script>
     $(document).ready(function(){
        $('.ratingREview').on('click',function(){
           var productId = $(this).attr('data-id');
          
           $('.product_id').val(productId);
           $('#reviewRating').modal('show');

        }) 
     })
</script>


@stop