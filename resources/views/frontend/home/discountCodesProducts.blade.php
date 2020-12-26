@extends('frontend.layout.layout')
@section('title','Discount Codes')
@section('content')
<style type="text/css">
    .tab-content > .tab-pane{
        display: unset;
    }
</style>

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
                                     <form class="sellerStoreForm" id="search_form" action="{{url('/discountCode/products')}}" method="get">
                                    <div class="fltr_topp d-flex">
                                        <div class="section-heading">
                                            <h2>Discount Codes</h2>
                                        </div>
                                    </div>


                                    <div class="tabs_coupon">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{url('/discountCode')}}">Products</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link store_active  active" data-toggle="tab" href="#store_copn">Seller</a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="container" id="store_copn">
                                                <div class="wrap_code_stor">
                                                    <div class="sor_ser_flr d-flex justify-content-between">
                                                       <div class="serch_bar d-flex">
                                                           <input type="text" class="form-control inputStoreName" placeholder="Search by seller" name="product_store" value="">
                                                           <div class="ml-4">
                                                               <button class="btn btn_theme searchSubmitProductstore"><span>Search</span>
                                                               </button>
                                                               <button   class="btn btn_theme resetProductstore"><span>Reset</span>
                                                               </button>
                                                           </div>
                                                       </div>
                                                       
                                                    </div>
                                                    <div class="wrap_code_inr">
                                                        <ul type="none" class="flex-wrap d-flex">
                                                           @foreach($allProductsUnderStores as $allProducts)
                                                             
                                                           <?php 
                                                               $user = App\User::where('id',$allProducts['user_id'])->first();
                                                              // dd($allProducts);
                                                              
                                                            ?>

                                                            <li class="coupn_li">
                                                                <div class="wrp_upr_cpn d-flex">
                                                                    <div class="imgc_div">

                                                                      @if(@$user['profile_image']!=null)
                                                                          <img src="{{asset('public/frontend/imgs/userProfile/'.$user['profile_image'])}}" class="img-fluid" id="prof_ch">
                                                                      @endif

                                                                      @if(@$user['profile_image']=='')
                                                                          <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" id="prof_ch">
                                                                      @endif

                                                                        
                                                                    </div>
                                                                    <div class="meta_coupn">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <?php ?>

                                                                            <h3>{{$user['contact_name']. " " . $user['contact_last_name']}}</h3>
                                                                           
                                                                            <h6 class="discount"> 
                                                                              Discount:
                                                                             @if($allProducts['product_discount_code']['discounted_products']['discount_type'] =='value')                                                                                    SR {{$allProducts['product_discount_code']['discounted_products']['discount_value']}} 

                                                                             @endif

                                                                            @if($allProducts['product_discount_code']['discounted_products']['discount_type']=='percent')
                                                                               {{$allProducts['product_discount_code']['discounted_products']['discount_value']}} % 
                                                                            @endif 
                                                                           </h6>
                                                                        </div>
                                                                       
                                                                        <h6 class="copn_catg">{{$allProducts['item_name']}}
                                                                        </h6>
                                                                        <div class="coupn_cod">
                                                                            <span class="cpn_btn storeCodeButton" viewCode="{{$allProducts['product_discount_code']['discounted_products']['discount_code']}}" data-toggle="modal" data-target="#view_code">Show Code</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             
                                                               <?php 
                                                            
                                                                  $allProducts['product_discount_code']['discounted_products']['offer_start_date'] = date("d/m/Y", strtotime($allProducts['product_discount_code']['discounted_products']['offer_start_date']));

                                                                  @$allProducts['product_discount_code']['discounted_products']['offer_end_date'] = date("d/m/Y", strtotime(@$allProducts['product_discount_code']['discounted_products']['offer_end_date']));

                                                               ?> 
                                                                <p class="dat_copn"><strong>Offer Validity:</strong> {{@$allProducts['product_discount_code']['discounted_products']['offer_start_date']}} - {{@$allProducts['product_discount_code']['discounted_products']['offer_end_date']}}
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
                               {{ $productUnderStorePaginate->appends(request()->input())->links() }}
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



 <!--  <script>
       $('.product_paginate').hide();

      $(document).on('click', '.products_active', function(){
        $('.product_paginate').hide();
        $('.store_paginate').show();
      });

      $(document).on('click', '.store_active', function(){
        $('.product_paginate').show();
        $('.store_paginate').hide();
      });

  </script>
 -->

<script>
      
    // var input1  = $('.inputProductName').val();
    var input2  = $('.inputStoreName').val();
  
    $(document).on('click', '.searchSubmitProductSeller', function(){
     
  // alert(user_name_order);
          // if(input1)    {
          //  $('#search_form').submit(); 
          // }else{
          //   swal('plesae Enter product name to filter');
          // }

          if(input2)    {
           $('#search_form').submit(); 
          }else{
            swal('plesae Enter store name to filter');
          }
        

    });

$('.resetProductstore').on('click',function(){

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