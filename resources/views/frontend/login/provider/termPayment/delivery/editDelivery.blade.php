@extends('frontend.layout.providerLayout')
@section('title','Edit Delivery Terms & Fees')
@section('content')
            
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
                                        <h3>Edit Delivery Terms & Fees(By amount of order)</h3>
                                    <nav class="bread_nav_sec">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"><a href="#">Edit Delivery Terms & Fees</a></li>
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
                                                             <?php 
                                                             $pid = $delivery['id'];
                                                                  
                                                                      ?>  
                                                                <form action="{{url('provider/deliveryTerm/edit/'.$pid)}}" id="addDelivery" method="post">
                                                                    <div class="delv-head">
                                                                        <!-- <h5> Assign Delivery Terms & Fees: (By amount of order)</h5> -->
                                                                        <!-- <h5> Edit Delivery Terms & Fees: (By amount of order)</h5> -->
                                                                        
                                                                    </div>
                                                                    <br>
                                                                    <input type="hidden" name="delivryId" value="{{$delivery['id']}}">

                                                                    <div class="form-group">
                                                                         <label class="build_label">From Order Amount(SR)</label>
                                                                         <input type="text" name="from_price_range" class="form-control" value="{{$delivery['from_price_range']}}"  placeholder="Enter From Order Amount(SR)" >
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                         <label class="build_label">To Order Amount(SR)</label>
                                                                         <input type="text" name="to_price_range" value="{{$delivery['to_price_range']}}" class="form-control"  placeholder="Enter To Order Amount(SR)" >
                                                                     </div>

                                                                    <div class="form-group">
                                                                        <label class="build_label">Delivery Type</label>
                                                                        <select id="price_type" value="" class="paid_selectd form-control" name="price_type">
                                                                             <option selected disabled>Select<body></body></option>       
                                                                             <option value="Not Available"@if($delivery['price_type'] == 'Not Available') selected @endif>Not Available</option>
                                                                             <option value="Free"@if($delivery['price_type'] == 'Free') selected @endif>Free</option>
                                                                             <option value="Payable"@if($delivery['price_type'] == 'Payable') selected @endif>Payable</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group paid_div">
                                                                        <label class="build_label">Delivery Price</label>
                                                                        <input type="text" id="" name="delivery_price" value="{{$delivery['delivery_price']}}" class="form-control" placeholder="Enter Delivery Price(SR)">
                                                                     </div>

                                                                       
                                                                    
                                                                    <div class="text-right">
                                                                        <button type="button" class="btn btn_theme submit"><span>Submit</span></button>
                                                                    </div>
                                                                </form>
                                                                <input type="hidden" name="delivery_id" class="delivery_id" value="{{@$pid}}">
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
<script>

    $("body").on('click','.submit',function(){
        $('#addDelivery').submit();
    });

</script>

    <script>
        $(document).ready(function(){
            var select =$('.paid_selectd').val();
             if (select =="Payable") {
                $(".paid_div").show();
             }else{
                $(".paid_div").hide();
             }
            $(document).on('change', '.paid_selectd', function() {
              if ( this.value == 'Payable')
              {
                $(".paid_div").show();
              }
              else
              {
               $(".paid_div").hide();
               $('input[name=delivery_price').val('');
              }
            });
        });
    </script>

<script type="text/javascript">
    $('#addDelivery').validate({
        ignore:[],
        rules:{
       
            "from_price_range":{
                required:true,
                number:true,
                  min: 1,
                remote:{
                    url:"{{ url('provider/delivery/update/fromOrderedAmount/name')}}",
                    data:{
                        id:function(){
                            return $('.delivery_id').val();
                        }
                    }
                } 
            },
            "to_price_range":{
                required:true,
                number:true,
                  min: 1,

                remote:{
                    url:"{{ url('provider/delivery/update/toOrderedAmount/name')}}",
                    data:{
                        id:function(){
                            return $('.delivery_id').val();
                        }
                    }
                }                 
            },
            "price_type":{
                required:true,
                // maxlength:200,
            },
            "delivery_price":{
                required: {
                     depends: function(element){
                         // alert($('.ths_slct').val());
                         if (  $('.paid_selectd').val()=='Payable') {
                                 return true;
                         } else {
                                 return false;
                         }
                     }
                 },
            }
            
        },
        messages:{
            "from_price_range":{
                required:"Please enter From Price",
                remote:"*This price range is already Exist",
            },
            "to_price_range": {
                required: "Please enter To Price",
              remote:"*This price range is already Exist",
            },
            "price_type": {
                required: "Please select Price Type",
            },
            "delivery_price": {
                required: "Please enter Delivery Price"
            }
            
        },
    });
    </script>
@stop