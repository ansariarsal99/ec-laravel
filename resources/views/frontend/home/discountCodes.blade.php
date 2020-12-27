
@extends('frontend.layout.layout')
@section('title','Discount Codes')
@section('content')


        <title></title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">

        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Discount Codes</li>
                    </ol>
                </nav>
            </div>
            <section class="discunt_page_sec">
                <div class="custom_container">
                    <div class="wrp_dis_cods">
                        <div class="row">
                            <div class="col-sm-10 offset-sm-1">
                                <div class="prods_main_rgt">
                                     <form class="sellerStoreForm" id="search_form" action="{{url('/discountCode')}}" method="get">
                                    <div class="fltr_topp d-flex">
                                        <div class="section-heading">
                                            <h2>Discount Codes</h2>
                                        </div>
                                    </div>


                                    <div class="tabs_coupon">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active products_active" data-toggle="tab" href="#prod_copn">Products</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link store_active" href="{{url('/discountCode/products')}}">Seller</a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane container active" id="prod_copn">
                                                <div class="wrap_code_prods">
                                                    <div class="sor_ser_flr d-flex justify-content-between">
                                                        <div class="serch_bar d-flex">
                                                            <input type="text" class="form-control inputProductName" placeholder="Search by Product Name" name="product_name" value="">
                                                            <div class="ml-4">
                                                                <button class="btn btn_theme searchSubmitProductSeller"><span>Search</span>
                                                                </button>
                                                                <button   class="btn btn_theme resetProductSeller"><span>Reset</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wrap_code_inr">
                                                        <ul type="none" class="flex-wrap d-flex">
                                                                
                                                       @foreach($allStoresOfProducts as $stores)
                                                              <?php 
                                                                 $user = App\User::where('id',$stores['user_id'])->first();
                                                                 // dd($stores);  
                                                              ?>
                                                                            
                                                           <li class="coupn_li">
                                                                <div class="wrp_upr_cpn d-flex">
                                                                    <div class="imgc_div">

                                                                      @if($stores['product_image']!=null)
                                                                          <img src="{{asset('public/frontend/images/products/'.$stores['product_image']['name'])}}" class="img-fluid" id="prof_ch">
                                                                      @endif

                                                                      @if($stores['product_image']=='')
                                                                          <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" id="prof_ch">
                                                                      @endif

                                                                    </div>
                                                                    <div class="meta_coupn">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                        <h3>{{@$stores['store_under_product']['store_name']}}</h3>

                                                                            

                                                                            <h6 class="discount">   
                                                                              Discount:
                                                                             @if($stores['product_discount_code']['discounted_products']['discount_type'] =='value')                                                                                             SR {{$stores['product_discount_code']['discounted_products']['discount_value']}} 
                                                                             @endif

                                                                            @if($stores['product_discount_code']['discounted_products']['discount_type']=='percent')
                                                                               {{$stores['product_discount_code']['discounted_products']['discount_value']}} % 
                                                                            @endif 
                                                                          </h6>
                                                                        </div>
                                                                        <h6>{{$stores['item_name']}}</h6>
                                                                     
                                                                        <input type="hidden" name="" value="" class="">


                                                                        <div class="coupn_cod">
                                                                            <span class="cpn_btn productCodeButton" minAmount ="{{$stores['product_discount_code']['discounted_products']['minimum_purchase_amount']}}"  viewProductCode="{{$stores['product_discount_code']['discounted_products']['discount_code']}}" data-toggle="modal" data-target="#product_view_code">Show Code</span>
                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <?php 
                                                                
                                                                   $stores['product_discount_code']['offer_start_date'] = date("d/m/Y", strtotime($stores['product_discount_code']['discounted_products']['offer_start_date']));

                                                                   $stores['product_discount_code']['discounted_products']['offer_end_date'] = date("d/m/Y", strtotime($stores['product_discount_code']['discounted_products']['offer_end_date']));

                                                                ?> 

                                                                <p class="dat_copn"><strong>Offer Validity:</strong> {{@$stores['product_discount_code']['discounted_products']['offer_start_date']}} - {{@$stores['product_discount_code']['discounted_products']['offer_end_date']}}
                                                                </p>

                                                               
                                                            </li>

                                                              @endforeach      
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="pg-sec background-white p-4 store_paginate">
                           <div class="numbr_pagintn mt-3">
                               {{ $storesPaginate->appends(request()->input())->links() }}
                           </div>
                    </section>

                </div>
            </section>

            <!-- //////////////////////// View More - Model////////////////////// -->

        <div class="modal fade" id="view_code">
            <div class="modal-dialog modal-dialog-centered coupan_code">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header pos_rel">
                        <h4 class="text-center modal-title">thank you!</h4>
                        <button type="button" class="close"  data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="coupan_details text-center">
                            <small> Use the code</small>
                            <h4 class="store_code"></h4>
                            <!-- <p>For free shipping on your next order of any Build Mart product. </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- //////////////////////// View More - Model////////////////////// -->

        <div class="modal fade" id="product_view_code">
            <div class="modal-dialog modal-dialog-centered coupan_code">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header pos_rel">
                        <h4 class="text-center modal-title">thank you!</h4>
                        <button type="button" class="close"  data-dismiss="modal">&times;</button>
                    </div>
      
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="coupan_details text-center">
                            <p class="minimum_PurchaseAmount"></p>
                            <small> Use the code</small>
                            <h4 class="product_code"></h4>
                            <!-- <p>For free shipping on your next order of any Build Mart product. </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop
@section('script')


<script>
    var input1  = $('.inputProductName').val();
    $(document).on('click', '.searchSubmitProductSeller', function(){
      if(input1) {
         $('#search_form').submit(); 
       }
        
    });

 $(document).on('click', '.resetProductSeller', function(){
      var form = $('#search_form'); 
      form.reset();
});
</script>

<script>
    $(document).on('click','.storeCodeButton',function() {
         var Code = $(this).attr('viewCode');
         $('.store_code').html(Code)
    })

    $(document).on('click','.productCodeButton',function() {
         var Code = $(this).attr('viewProductCode');
          $('.minimum_PurchaseAmount').html('')
         var minimumPurchaseAmt = $(this).attr('minimumPurchaseAmount');
           // alert(minimumPurchaseAmt);
         if(minimumPurchaseAmt){
             $('.minimum_PurchaseAmount').html('Minimum Puchase amount To Get Discount is SR' + minimumPurchaseAmt)
         }
         $('.product_code').html(Code)
    })
    
</script>
@stop