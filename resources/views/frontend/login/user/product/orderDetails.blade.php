@extends('frontend.layout.layout')
@section('title','Order Details')
@section('content')
     
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
      
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
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
                                    <h4>Order Details</h4>
                                    <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                                </div>
                                <div class="main_cntnt_dash">
                                    <div class="card order_detail_dash">
                                        <div class="tabs_pymnt">
                                            <!--  -->
                                            <div class="inr_tabs_cntnt">
                                                <!--  -->
                                                <div class="cont_shd_frm">
                                                    <div class="wrap_ords_his">
                                                        <a class="btn btn_theme bck_btn_db" href="{{url('user/product/myOrders')}}"><span><i class="fa fa-long-arrow-left"></i> Back</span></a>
                                                        <div class="order_one_single">
                                                            <div class="wrp_two_selr d-flex justify-content-between align-items-center">
                                                                <div class="ordr_sellr_hedr d-flex flex-row">
                                                                    <span class="text-center">
                                                                        Order Id:  {{@$orderDetail['invoice_id']}} | Order Date: {{@$orderDetail['placed_on']}}
                                                                    </span>
                                                                </div>
                                                                <button class="btn btn_theme printInvoice"><span>Print Invoice</span></button>
                                                            </div>
                                                            <div class="ord_seller_wrap">
                                                                <div class="ord_meta">
                                                                    <div class="ord_hed d-flex justify-content-between align-items-center">
                                                                        <div class="ordr_sellr_hedr d-flex flex-row">
                                                                            <span class="text-center">
                                                                                <small>Order ID</small><br>
                                                                               {{@$orderDetail['invoice_id']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Order Amount </small><br>
                                                                                SR {{@$orderDetail['final_total']}}
                                                                            </span>
                                                                            <span class="text-center">
                                                                                <small>Seller </small><br>
                                                                                {{ucfirst(@$orderItemDelivery['productName']['sellerName']['contact_name'] . @$orderItemDelivery['productName']['sellerName']['contact_last_name'])}}
                                                                                
                                                                            </span>
                                                                        </div>
                                                                        <a href="" class="cp">Store Location on Map</a>
                                                                    </div>
                                                                    <div class="adrs_pymt_top">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <div class="row">
                                                                                    <div class="col-sm-5">
                                                                                        <div class="cart_overvew">
                                                                                            <div class="shoping__continue">
                                                                                                <div class="shoping__discount">
                                                                                                  
                                                                                                    <h5>Shipping Details: </h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="shoping__checkout">
                                                                                                <ul>
                                                                                                    @if($orderItemDelivery['delivery_address']['address_title']!=null)
                                                                                                        <li><b>{{@$orderItemDelivery['delivery_address']['address_title']}}</b><br>{{$orderItemDelivery['delivery_address']['location']}}<br>
                                                                                                        </li>
                                                                                                      
                                                                                                    @endif
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-7">
                                                                                        <div class="cart_overvew">
                                                                                            <div class="shoping__continue">
                                                                                                <div class="shoping__discount">
                                                                                                    <h5>Payment Method: </h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="shoping__checkout">
                                                                                                <ul>
                                                                                                    <li>
                                                                                                        <i class="fa fa-google-wallet"></i> Paid from Card
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Supplier Total: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            <li>Sub Total <span>SR {{@$orderDetail['sub_total']}}</span></li>

                                                                                            <li>Discount Price <span>SR @if($orderDetail['discount_price'] ==null)0.00 @endif {{@$orderDetail['discount_price']}}</span></li>

                                                                                            <li>Tax <span>SR {{@$orderDetail['tax_price']}}</span></li>
                                                                                            <li>Delivery Charges <span>SR 0.00</span></li>
                                                                                            <li>Total <span>SR {{@$orderDetail['final_total']}}</span></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="adrs_pymt_top">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Amount: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            <li>SR {{@$orderDetail['final_total']}}</li>
                                                                                            <li>Total: SR {{@$orderDetail['final_total']}}</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Payment Method: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <i class="fa fa-google-wallet"></i> Paid from Card
                                                                                    <!-- <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            <li>Wallet Balance: SR 5647.75</li>
                                                                                        </ul>
                                                                                    </div> -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="cart_overvew">
                                                                                    <div class="shoping__continue">
                                                                                        <div class="shoping__discount">
                                                                                            <h5>Status: </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="shoping__checkout">
                                                                                        <ul>
                                                                                            <li>Paid on {{@$orderDetail['placed_on']}}</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="table-responsive" >
                                                                        <table id="table-basic" class="table_cartt table">
                                                                            <tbody>
                                                                                @foreach($orderItem as $order)
                                                                             
                                                                                <tr>

                                                                                    <?php 
                                                                                    
                                                                                        $image = defaultAdminImagePath.'/no_image.png';
                                                                                        if(!empty($order['product_name']['product__image_for_order__item']['name'])){
                                                                                            $image = asset('public/frontend/images/products/'.$order['product_name']['product__image_for_order__item']['name']);
                                                                                        }
                                                                                                               
                                                                                    ?>  

                                                                                    <td class="img_td">
                                                                                        <img src="{{ $image}}" alt="" class="img-fluid">
                                                                                    </td>

                                                                                    <td>{{ucfirst(@$order['product_name']['item_name'])}}
                                                                                        <br>Sold By: {{ucfirst($order['product_name']['seller_name']['contact_name'] . $order['product_name']['seller_name']['contact_last_name'])}}
                                                                                        <br>Price: SR {{@$order['item_price']}}
                                                                                        <br>Qty: {{@$order['quantity']}}
                                                                                        <br>Unit: {{ucfirst(@$order['product_unit'])}}
                                                                                    </td>

                                                                                    <td class="text-center">SR {{@$order['quantity_price']}} <br>
                                                                                        <a class="cp rep_ord"><i class="fa fa-refresh"></i> Repeat Order</a>
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach

                                                                                <!-- <tr>
                                                                                    <td class="img_td">
                                                                                        <img src="https://www.plasticsinfo.co.za/wp-content/uploads/2020/04/pipes.jpg" alt="" class="img-fluid">
                                                                                    </td>
                                                                                    <td>Saffola Gold, Pro Healthy Lifestyle Edible Oil Jar 5 L
                                                                                        <br>Sold By: Seller Name
                                                                                        <br>Price: SR 2687
                                                                                        <br>Qty: 5
                                                                                        <br>Unit: 2kg
                                                                                    </td>
                                                                                    <td class="text-center">SR 1100 <br>
                                                                                        <a class="cp rep_ord"><i class="fa fa-refresh"></i> Repeat Order</a>
                                                                                    </td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  -->
                                            </div>
                                            <!--  -->
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

@stop
@section('script')


<script type="text/javascript">
    $(document).on('click','.printInvoice', function(){
        window.location.href= "{{url('user/product/orderDetails/printInvoice'.'?id='.$id)}}"    
    });
</script>

@stop