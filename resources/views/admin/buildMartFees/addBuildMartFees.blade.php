@extends('admin.layout.adminLayout')
@section('title','Add Build Mart Fees')
@section('content')


        <!-- <title>Assign Delivery Terms</title> -->
        
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
        <style>
        
        </style>
    </head>
    <body>
        <!-- Header -->
        
        <!-- Header ends -->
        
        <div class="wrapper_shala seller_db_inner">
            <section class="outer_db_wraper db_seller_items_list">
              <div class="combine_side_main_slr_db">
                <div class="sidenav_seller_db">
                  @include('admin.include.header')
                 @include('admin.include.sidebar')
                </div>
                <div class="main_seller_db item_list_seller_db">
                  <div class="marg_over_bread">
                    <section class="item_list_sec p-0">
                      <div class="db_container">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="delvry_terms ordr-addr">
                                      <div class="delv-head">
                                          <h4> Build Mart Fees:</h4>
                                      </div>
                                        <form method="post" id="deliveryTermCondtion" action="{{url('admin/buildaMart/addBuildMartFees')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-10 offset-lg-1 col-sm-12">
                                                <div class="form-group ">
                                                    <div class="custom-control custom-radio mb-3">
                                                        <input type="radio" class="custom-control-input" id="customRadio_new17" @if($BuildMartFeesAndCondtion['fees_type']=='percentage') checked="" @endif  name="fees_type" value="percentage">
                                                        <label class="custom-control-label" for="customRadio_new17">
                                                        Percentage of order amount</label>
                                                        <input type="text" name="percentage" class="form-control mt-2 inputPercentage" value="{{$BuildMartFeesAndCondtion['percentage']}}" placeholder="Enter Percentage">
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex justify-content-between align-items-center">
                                                   <div class="custom-control custom-radio">
                                                        <input type="radio"  class="custom-control-input" id="customRadio_new18" @if($BuildMartFeesAndCondtion['fees_type']=='lum_sum') checked="" @endif   name="fees_type" value="lum_sum">
                                                        <label class="custom-control-label" for="customRadio_new18">Lum Sum Amount(accoding to amount of order):</label>
                                                    </div>
                                                    <p class="com_red text-right mb-0">
                                                        <span class="aapnd_ins text-center dlv_add">
                                                           <i class="fa fa-plus-circle  mr-1"></i>Add
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="del_fields">
                                                      @foreach($BuildMartFeesAndCondtionAmounts as $key=>$value)
                                                        <div class="apnd_sec">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                      <input type="text" id="from_price_range_0" name="term_append_div[{{$key}}][from_price_range]" value="{{$value['from_price_range']}}" class="form-control from_price_range commonClass" placeholder="Amount Range From">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                      <input type="text" id="to_price_range_0" name="term_append_div[{{$key}}][to_price_range]" value="{{$value['to_price_range']}}" class="form-control to_price_range " placeholder="Amount Range To">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group paid_div">
                                                                      <input type="text" id="fee_0" name="term_append_div[{{$key}}][fees]" value="{{$value['fees']}}" class="form-control " placeholder="Price">
                                                                    </div>
                                                                </div>

                                                                    <!-- <span class="apnd_val">Remove</span> -->
                                                                
                                                                @if(!$key == '0')
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group text-center"> 
                                                                            <span class="apnd_val">Remove</span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                      @endforeach
                                                </div>
                                            </div>
                                        </div>

                                         <!--  <div class="col-lg-3">
                                            <div class="form-group">
                                                <span class="aapnd_ins text-center">
                                                  <i class="fa fa-plus-circle dlv_add">Add</i>
                                                </span>
                                            </div>
                                          </div> -->

                                    
                                    <div class="form-group text-center">
                                        <button type="button" id="save" class="cstm-azy-btn-red">Submit
                                        </button>
                                    </div>
                                  </form>
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
            <input type="hidden" name="count" value="{{$BuildMartFeesAndCondtionAmountsCount}}" class="count">
        </div>

 @stop
@section('script')    

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script type="text/javascript">
      $(document).on('click', '#save', function(){

        if ($('#deliveryTermCondtion').valid()) {
           if ( $('#customRadio_new17').is(':checked')) {
                $('#deliveryTermCondtion').submit();
           }
        }
        
         if ($('#customRadio_new18').is(':checked')) {
            var price_range = $('#from_price_range_0').val();
            if(price_range==null || price_range==''){
               Swal.fire(
                    'Please select Lum Sum Amount'
                  )
            }else{
               $('#deliveryTermCondtion').submit();
            }

         }
        
        

      });
   </script>
<script type="text/javascript">
      
    $(document).on('keyup', '.from_price_range',function(){
     
      var fromPrice = $(this).val();
      var from_price_range = $('.apnd_sec').last().prev().find('.to_price_range').val();  
      
         $(this).rules("add", {
                required: true,
                min: from_price_range,
                messages: {
                    required: "please select fees",
                }
          });  

    });

    $(document).on('keyup', '.to_price_range',function(){
     
      var toPrice = $(this).val();
      // var contentnumbers = $('.apnd_sec').last().find('.to_price_range').val();  
      // alert(contentnumbers);
      var from_price_range = $(this).closest('.apnd_sec').find('.from_price_range').val();  
      // alert(from_price_range);
      
         $(this).rules("add", {
                required: true,
                min: from_price_range,
                messages: {
                    required: "please select fees",
                }
          });  
    });
    
</script>
 
  <script>
   

      $(document).on('click', '.dlv_add', function(){
            var lengt = $('.commonClass').length;
                // alert(slengt);
            
        $('.del_fields').append('<div class="apnd_sec"> <div class="row">  <div class="col-lg-3"> <div class="form-group"> <input type="text" id="from_price_range_'+lengt+'" name="term_append_div['+lengt+'][from_price_range]" value="" class="form-control commonClass from_price_range" placeholder="Amount Range From"> </div></div><div class="col-lg-3"> <div class="form-group"> <input type="text" name="term_append_div['+lengt+'][to_price_range]" id="to_price_range_'+lengt+'" value class="form-control to_price_range" placeholder="Amount Range To"> </div></div><div class="col-lg-3"> <div class="form-group"> <input type="text" id="fees_'+lengt+'" name="term_append_div['+lengt+'][fees]" value="" class="form-control" placeholder="Price"> </div></div><div class="col-lg-3"> <div class="form-group text-center"> <span class="apnd_val">Remove</span> </div></div></div></div>');
               
      
        $("input[id^=from_price_range_").each(function(){
              $(this).rules("add", {
                  required: true,
                  // min: 1,
                  messages: {
                      required: "Please enter Amount Range From ",
                  }
              });     
          });

        $("input[id^=to_price_range_").each(function(){
              $(this).rules("add", {
                  required: true,
                  // min: 1,
                  messages: {
                      required: "Please enter Amount Range To",
                  }
              });   
          });

        $("input[id^=fees_").each(function(){
              $(this).rules("add", {
                  required: true,
                  min: 1,
                  messages: {
                      required: "please select fees",
                  }
              });   
          });

      });

      $(document).on('click', '.apnd_val', function(){
        $(this).parents('.apnd_sec').remove();
      });




  </script>
  <!-- Append div -->
<!--Rohit script 21 sep  -->


<script type="text/javascript">

   $(document).ready(function(){
      $('#deliveryTermCondtion').validate({
        ignore:[],
        rules:{
            "percentage":{
              required: {
                    depends: function(element){
                        if ( $('#customRadio_new17').is(':checked')) {
                                return true;
                        } else {
                                return false;

                        }
                    }
                },
            }
           

        },
        messages:{
            "percentage":{
                required:"Please enter Percentage",
            }
          
        },
        submitHandler:function(form){
            
            form.submit();
        }
    });


        $("input[id^=from_price_range_").each(function(){
              $(this).rules("add", {
                  required: true,
                  // min: 1,
                   messages: {
                      required: "Please enter Amount Range From",
                  } 
              });   
          });

        $("input[id^=to_price_range_").each(function(){
              $(this).rules("add", {
                  required: true,
                  // min: 1,
                   messages: {
                      required: "Please enter Amount Range To",
                  } 
              });   
          });

        $("input[id^=fee_").each(function(){
              $(this).rules("add", {
                  required: true,
                  min: 1,
                   messages: {
                      required: "Please enter Fee",
                  } 
              });   
          });

});
</script>



        

 @stop


