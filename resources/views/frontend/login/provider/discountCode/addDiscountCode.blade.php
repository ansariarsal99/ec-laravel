@extends('frontend.layout.providerLayout')
@section('title','Add Discount Code')
@section('content')

<style>
    .discount_wrap .form-control{
        /*width: 110px;*/
        width: 100%;
    }
    .price_percnt {
        width: 80px;
        border: 1px solid #ced4da;
        border-left: none;
        background: rgba(204, 63, 47, 0.13);
    }
    .price_percnt span{
        color: #cc3f2f;
        font-weight: 500;
        cursor: pointer;
        display: inline-block;
        /*margin: 4px 4px 0;*/
        margin: 11px 4px 0;
    }
    .price_percnt .active {
        background: #cc3f2f;
        color: #fff;
        border-radius: 3px;
        padding: 0px 4px;
    }
</style>


        <link href="{{asset('public/frontend/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" media="all" />
        <div class="wrapper_shala seller_db_inner">
            <section class="outer_db_wraper db_seller_items_list">
                <div class="combine_side_main_slr_db d-flex">
                    <div class="sidenav_seller_db">
                          @include('frontend.include.providerSidebar')
                    </div>
                    <div class="main_seller_db item_list_seller_db">
                        <section class="bread_top_sec">
                            <div class="db_container">
                                <div class="d-flex justify-content-between text-white pos_rel">
                                    <div class="sid_controlr">
                                        <i class="clos_sid fa fa-bars"></i>
                                        <i class="opn_sid fa fa-times"></i>
                                    </div>
                                     <h3>Add Discount Code</h3>
                                    <nav class="bread_nav_sec">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"><a href="#">Add Discount Code</a></li>
                                            <!-- <li class="breadcrumb-item active">Item List</li> -->
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </section>
                        <div class="marg_over_bread">
                            <section class="item_list_sec p-0 ">
                                <div class="db_container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="cont_shd_frm">
                                                        <div class="add_adverts_wrap pad15">
                                                            <div class="col-sm-10 offset-1">
                                                                <form action="{{url('provider/discountCode/add')}}" id="addDiscountform" method="post">

                                                                    <!-- <div class="row">
                                                                        <div class="col-sm-12">
                                                                          
                                                                          <div class="form-group">
                                                                                <label class="build_label"> Select Product Name</label>
                                                                                <select class="form-control mul_category" name="product_id[]" multiple="multiple">
                                                                                     
                                                                                    @foreach($products as $product)
                                                                                        <option value="{{$product['id']}}">{{@$product['item_name']}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <label id="product_id[]-error" class="error" for="product_id[]"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->

                                                                     <div class="row">
                                                                           <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label class="build_label"> Select Product</label>
                                                                                   <select class="form-control mul_category mul_Product" name="product_id[]" multiple="multiple">
                                                                                      @foreach($products as $product)
                                                                                          <option value="{{$product['id']}}">{{@$product['item_name']}}</option>
                                                                                     @endforeach
                                                                                  </select>
                                                                                <label id="product_id[]-error" class="error" for="product_id[]"></label>
                                                                            </div>
                                                                         </div>

                                                                       <!--   <div class="col-sm-4">
                                                                            <div class="form-group text-left">
                                                                                <label class="build_label"> Select Seller Code</label>
                                                                                   <select class="form-control mul_category mul_Seller_code" name="seller_item_code[]" multiple="multiple">
                                                                                      @foreach($products as $product)
                                                                                          <option value="{{$product['id']}}">{{@$product['seller_item_code']}}</option>
                                                                                     @endforeach
                                                                                  </select>
                                                                                <label id="product_id[]-error" class="error" for="product_id[]"></label>
                                                                            </div>
                                                                         </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group text-left">
                                                                                <label class="build_label"> Product Bar Code</label>
                                                                                   <select class="form-control mul_category mul_Bar_Code" name="item_bar_code[]" multiple="multiple">
                                                                                      @foreach($products as $product)
                                                                                          <option value="{{$product['id']}}">{{@$product['item_bar_code']}}</option>
                                                                                     @endforeach
                                                                                  </select>
                                                                                <label id="product_id[]-error" class="error" for="product_id[]"></label>
                                                                            </div>
                                                                         </div>
 -->
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">    
                                                                                <label class="build_label">Discount Code</label>
                                                                                <div class="d-flex align-items-center">
                                                                                    <input type="text" class="form-control pcode-20" name="discount_code" placeholder="Generate Promocode" id="promo-code-inp" value="" maxlength="100" >
                                                                                    <button type="button" id="promo-code-btn" class="ml-2 btn btn_theme"><span>Generate</span></button>
                                                                                </div>
                                                                                <label id="promo-code-inp-error" class="error" for="promo-code-inp"></label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                   <div class="row">
                                                                        <div class="col-sm-6">
                                                                           <div class="form-group text-left">
                                                                                <label class="build_label">Offer Start Date</label>
                                                                                <input type="text" name="offer_start_date" id="start_date" data-provide="datepicker" value=""  class="form-control datepicker" placeholder="Offer Start Date">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                           <div class="form-group text-left">
                                                                                <label class="build_label">Offer End Date</label>
                                                                                <input type="text" name="offer_end_date" id="end_date" data-provide="datepicker" value="" class="form-control datepicker" placeholder="Offer End Date">
                                                                           </div>
                                                                        </div>
                                                                   </div>

                                                                   <div class="row">
                                                                       <div class="col-sm-12">
                                                                           <div class="form-group">
                                                                            <label class="build_label">Minimum Purchase Amount</label>
                                                                            <input type="text" class="form-control" name="minimum_purchase_amount" placeholder="Minimum purchase amount" value="">
                                                                           </div>
                                                                        </div>
                                                                    </div>      

                                                                    
                                                                     

                                                                    <div class="row discount_row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                            <label class="build_label">Discount</label>
                                                                                <div class="discount_wrap d-flex">
                                                                                   <input type="text" name="discount_value" class="form-control getdiscount">
                                                                                    <div class="price_percnt text-center">
                                                                                       <span class="active dicount_percent">%</span>
                                                                                       <span class="dicount_value">SR</span>
                                                                                       <input type="hidden" class="discount_type_class" name="discount_type" value="P">
                                                                                    </div>
                                                                                 </div>
                                                                                    <span id="discount_amount_error" class="text-danger" ></span>
                                                                                    <label id="discount_value-error" class="error" for="discount_value"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="text-right">
                                                                        <button class="btn btn_theme save"><span>Submit</span></button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>

     
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script type="text/javascript" src="{{asset('public/frontend/js/bootstrap-datepicker.min.js')}}"></script>
  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
    $('.dicount_value').on('click',function(){
        var ths = $(this);
        ths.addClass('active');
        ths.closest('div.discount_row').find('.dicount_percent').removeClass('active');
        $('.discount_type_class').val('V');
    });

    $('.dicount_percent').on('click',function(){
        var ths = $(this);
        ths.addClass('active');
        ths.closest('div.discount_row').find('.dicount_value').removeClass('active');
        $('.discount_type_class').val('P');
    });

</script>

<script type="text/javascript">
    $(document).on('click','#promo-code-btn', function(){
        var result           = '';
        var characters       = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var charactersLength = characters.length;
        for ( var i = 0; i < 6; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        $("#promo-code-inp").val(result);
    })
</script>


  <script>
      $(document).ready(function () {
      
          var date = new Date();
          $("#start_date").datepicker({
              autoclose: true,
              todayHighlight: true,
              format: "dd-mm-yyyy",
               startDate: new Date(),
              viewMode: "days",
              minViewMode: "days"
          }).on('changeDate', function (selected) {
              var minDate = new Date(selected.date.valueOf());
              $('#end_date').datepicker('setStartDate', minDate);
          });

          $("#end_date").datepicker({
              autoclose: true,
              todayHighlight: true,
              format: "dd-mm-yyyy",
               startDate: new Date(),
              viewMode: "days",
              minViewMode: "days"
          })
          .on('changeDate', function (selected) {
              var maxDate = new Date(selected.date.valueOf());
              $('#start_date').datepicker('setEndDate', maxDate);
          });
      });
  </script>


<script type="text/javascript">
    $('#addDiscountform').validate({
        ignore:[],
        rules:{
            "product_id[]":{
                required:true,
            },            
            "discount_code":{
                required:true,
                maxlength:50
            },

            "offer_start_date":{
                required:true,
            },

            "offer_end_date":{
                required:true,
            },
            "minimum_purchase_amount":{
              min:1,
              number:true,
            },
            "discount_value":{
                required:true,
                  number:true,
            },
            
        },
        messages:{
            "product_id[]":{
                required:"Please select product",
            },
             "discount_code":{
                required:"Please generate or type discount code",
                maxlength:"Maximum 50 characters are allowed",
            },
            "offer_start_date":{
                required:"Please select offer start date",
            },
            "offer_end_date":{
                required:"Please select offer end date",
            },

            "discount_value":{
                required:"Please enter offer discount",
            },
        },
         
         submitHandler:function(form){

            var discount_type  = $('.discount_type_class').val();
            var discount_amount= $('.getdiscount').val();

            if(discount_type=='P'){
                if(parseInt(discount_amount)>=100){
                    $('#discount_amount_error').text('Discount amount must be less then 100%');
                    return false;
                }
            }

            var productBar    = $('.mul_Product').val();
            // alert(productBar);
            var sellerCodeBar = $('.mul_Seller_code').val();
            var ItemBarCode   = $('.mul_Bar_Code').val();
          
            // if(productBar==null&& sellerCodeBar==null && ItemBarCode==null){
            //    Swal.fire('Please select at least one Select List') 
            //    return false;
            // }

            form.submit();
        },
    });
</script>




@stop