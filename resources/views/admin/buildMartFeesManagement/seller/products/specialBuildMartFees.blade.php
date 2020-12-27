@extends('admin.layout.adminLayout')
@section('title','Special Build Mart Fees')
@section('content')

@include('admin.include.header')
    <!-- Sidebar menu-->
@include('admin.include.sidebar')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Build Mart Fees Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="javascript:;">Build Mart Fees Management</a></li>
                            <li><a href="javascript:;">Product List</a></li>
                            <li class="active">Special Build Mart Fees</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <!-- <strong class="card-title">Build Mart Fees</strong> -->
                   <!--     <a href="{{url('admin/subscriptionManagement/addSubscription')}}" class="btn btn-outline-danger" style="float:right;">Add New User</a> -->
                       <!-- <a href="{{url('admin/export/provider-designerList')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a> -->
                    </div>
                    <div class="card-body">
                        <div class="delvry_terms ordr-addr">
                            <div class="delv-head">
                                <h4>Special Build Mart Fees:</h4>
                            </div>
                            <form id="buildMartFeeForm" method="POST" action="{{url('/admin/buildMartFees/seller/product/fees/'.$encProductId)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1 col-sm-12">
                                        <div class="form-group fee_radio_btn radio_perc">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" @if((!empty($product) && $product['has_special_build_mart_fees']=='yes' && $product['special_build_mart_fees_type']=='any_order_amount') || (!empty($product) && $product['has_special_build_mart_fees']=='no')) checked="" @endif class="custom-control-input fees_typ_rad" id="customRadio_new17" name="build_mart_fees_type" value="any_order_amount">
                                                <label class="custom-control-label" for="customRadio_new17">
                                                    <div class="form-group mb-0">
                                                        <div class="discount_wrap price_field mt-1 d-flex align-items-center">
                                                            <div class="discount_wrap amt_fields price_field d-flex">
                                                                @if(!empty($product) && $product['has_special_build_mart_fees']=='yes' && $product['special_build_mart_fees_type']=='any_order_amount')
                                                                    <input type="text" name="value" placeholder="% or SR" value="{{@$feeRanges['value']}}" class="discount_amt form-control more_prc_inpt">
                                                                    <div class=" price_percnt text-center">
                                                                        <span class="disc_spv_dv @if(@$feeRanges['type']=='percent') active @endif" type="percent">%</span>
                                                                        <span class="disc_spv_dv @if(@$feeRanges['type']=='amount') active @endif" type="amount">SR</span>
                                                                    </div>
                                                                    <input type="hidden" class="disc_typ_cls" name="type" value="{{@$feeRanges['type']}}" />
                                                                @else
                                                                    <input type="text" name="value" placeholder="% or SR" class="discount_amt form-control more_prc_inpt">
                                                                    <div class=" price_percnt text-center">
                                                                        <span class="disc_spv_dv active" type="percent">%</span>
                                                                        <span class="disc_spv_dv" type="amount">SR</span>
                                                                    </div>
                                                                    <input type="hidden" class="disc_typ_cls" name="type" value="percent" />
                                                                @endif
                                                            </div>
                                                            <p class="m-0  ml-2">of any order amount</p>    
                                                        </div>
                                                        <label class="error mb-0" for="value"></label>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1 fee_radio_btn labl_amt d-flex justify-content-between align-items-center">
                                           <div class="custom-control custom-radio">
                                                <input type="radio" @if(!empty($product) && $product['has_special_build_mart_fees']=='yes' && $product['special_build_mart_fees_type']=='according_to_order_amount') checked="" @endif  class="custom-control-input fees_typ_rad acc_to_ordr_amt_cls" id="customRadio_new18" name="build_mart_fees_type" value="according_to_order_amount">
                                                <label class="custom-control-label" for="customRadio_new18">Fee according to amount of order:</label>
                                            </div>
                                        </div>
                                        <div class="add_btn mb-1">
                                            <p class="com_red text-right mb-0">
                                                <span class="aapnd_ins text-center dlv_add add_range">
                                                   <i class="fa fa-plus-circle  mr-1"></i>Add
                                                </span>
                                            </p>
                                        </div>
                                        <div class="del_fields fee_ranges">
                                            @if(!empty($product) && $product['has_special_build_mart_fees']=='yes' && $product['special_build_mart_fees_type']=='according_to_order_amount' && isset($feeRanges) && sizeof($feeRanges)>0)
                                                @foreach($feeRanges as $key => $range)
                                                    @if(!empty($range))
                                                        <div class="apnd_sec">
                                                            <div class="row" part="{{$key}}">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($key<sizeof($feeRanges)-1) readonly="" @endif id="from_price_range_{{$key}}" name="add_range_div[{{$key}}][from_price]" value="{{@$range['from_price']}}" class="form-control from_price_range commonClass range_cls inpt_txt" rel="from_price" placeholder="Range From">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($key<sizeof($feeRanges)-1) readonly="" @endif id="to_price_range_{{$key}}" name="add_range_div[{{$key}}][to_price]" value="{{@$range['to_price']}}" class="form-control to_price_range range_cls inpt_txt" rel="to_price" placeholder="Range To">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group ">
                                                                        <!-- <label>Discount</label> -->
                                                                        <div class="discount_wrap amt_fields price_field fees_fld d-flex">
                                                                            <input type="text" @if($key<sizeof($feeRanges)-1) readonly="" @endif id="range_value_{{$key}}" name="add_range_div[{{$key}}][value]" value="{{@$range['value']}}" placeholder="% or SR" class="discount_amt form-control more_prc_inpt inpt_txt">
                                                                            <div class="price_percnt text-center">
                                                                                <span class=" @if($key<sizeof($feeRanges)-1) @else disc_spv_dv @endif amt_typ_spn @if(@$range['type']=='percent') active @endif" type="percent">%</span>
                                                                                <span class="@if($key<sizeof($feeRanges)-1) @else disc_spv_dv @endif amt_typ_spn @if(@$range['type']=='amount') active @endif" type="amount">SR</span>
                                                                            </div>
                                                                            <input type="hidden" class="disc_typ_cls" name="add_range_div[{{$key}}][type]" value="percent" />
                                                                        </div>
                                                                        <label class="error" for="range_value_{{$key}}"></label>
                                                                    </div>
                                                                </div>
                                                                @if($key>0)
                                                                    <div class="col-lg-3 rmv_range_div">
                                                                        <div class="form-group text-center"> 
                                                                            <span class="apnd_val rmv_range">Remove</span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="apnd_sec">
                                                    <div class="row" part="0">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                              <input type="text" id="from_price_range_0" name="add_range_div[0][from_price]" value="" class="form-control from_price_range commonClass inpt_txt range_cls" rel="from_price" placeholder="Range From">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                              <input type="text" id="to_price_range_0" name="add_range_div[0][to_price]" value="" class="form-control to_price_range inpt_txt range_cls" rel="to_price" placeholder="Range To">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group ">
                                                              <!-- <label>Discount</label> -->
                                                                <div class="discount_wrap amt_fields price_field fees_fld d-flex">
                                                                    <input type="text" id="range_value_0" name="add_range_div[0][value]" placeholder="% or SR" class="discount_amt form-control more_prc_inpt inpt_txt">
                                                                    <div class="price_percnt text-center">
                                                                        <span class="disc_spv_dv amt_typ_spn active" type="percent">%</span>
                                                                        <span class="disc_spv_dv amt_typ_spn" type="amount">SR</span>
                                                                    </div>
                                                                    <input type="hidden" class="disc_typ_cls" name="add_range_div[0][type]" value="percent" />
                                                                </div>
                                                                <label class="error" for="range_value_0"></label>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-3 rmv_range_div">
                                                            <div class="form-group text-center"> 
                                                                <span class="apnd_val rmv_range">Remove</span>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            @endif
                                           <!--  <div class="col-md-6">
                                                <input type="text" name="default_amount_build_mart_special_product" class="form-control" value="{{$product['default_amount_build_mart_special_product']}}" placeholder="Enter default amount">
                                            </div><br> -->

                                            <div class="dafalt_feld">
                                               <label>Default Amount: </label>
                                               <div class="form-group ">
                                                   <!-- <label>Discount</label> -->
                                                   <div class="discount_wrap amt_fields price_field fees_fld d-flex">
                                                       <input type="text"  id="defaultAmount" name="default_amount_build_mart_special_product" value="{{$product['default_amount_build_mart_special_product']}}" placeholder="% or SR" class="discount_amt form-control more_prc_inpt inpt_txt">
                                                       <div class="price_percnt text-center default_amount__value_type">
                                                           <span  class=" default_type @if(@$product['default_amount_type']=='percent') active @endif" type="percent" value="">%</span>
                                                           <span  class=" default_type @if(@$product['default_amount_type']=='amount') active @endif" type="amount" value="">SR</span>
                                                       </div>
                                                       <input type="hidden" class="disc_typ_cls" name="default_amount_type" value="percent" />
                                                   </div>
                                                   <label class="error" for="defaultAmount"></label>
                                               </div>
                                           </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="Submit" id="save" class="cstm-azy-btn-red">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">

    $("body").on('click','.default_type',function(){
       // alert($(this));
       $(this).addClass('active');
       $(this).siblings().removeClass('active');

       $(this).parent().next().val($(this).attr('type'));

     });

    $(document).ready(function(){
        <?php if(!empty($product) && $product['has_special_build_mart_fees']=='yes' && $product['special_build_mart_fees_type']=='according_to_order_amount' && isset($feeRanges) && sizeof($feeRanges)>0){ ?>
            // alert('if');
            $('.add_btn,.del_fields').show();
        <?php }else{ ?>
            // alert('else');
            $('.add_btn,.del_fields').hide();
        <?php } ?>
        var productId = "{{$product['id']}}";

        $("body").on('click','.disc_spv_dv',function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            // alert($(this).attr('type'));
            $(this).parent().next().val($(this).attr('type'));
        });

        $("body").on('change','.fees_typ_rad',function(){
            // alert($(this).val());
            if ($(this).val()=='according_to_order_amount') {
                $('.add_btn,.del_fields').show();
            }else{
                $('.add_btn,.del_fields').hide();
            }
        });

        $("body").on('click','.add_range',function(){
            var lent = $('.apnd_sec').length;
            // alert(lent);
            $('.inpt_txt').prop('readonly', true);
            $('.amt_typ_spn').removeClass('disc_spv_dv');
            $('.rmv_range').hide();
            $('.fee_ranges').append('<div class="apnd_sec"> <div class="row" part="'+lent+'"> <div class="col-lg-3"> <div class="form-group"> <input type="text" id="from_price_range_'+lent+'" name="add_range_div['+lent+'][from_price]" value="" class="form-control from_price_range commonClass inpt_txt range_cls" rel="from_price" placeholder="Range From"> </div></div><div class="col-lg-3"> <div class="form-group"> <input type="text" id="to_price_range_'+lent+'" name="add_range_div['+lent+'][to_price]" value="" class="form-control to_price_range inpt_txt range_cls" rel="to_price" placeholder="Range To"> </div></div><div class="col-lg-3"> <div class="form-group "> <div class="discount_wrap amt_fields price_field fees_fld d-flex"> <input type="text" id="range_value_'+lent+'" name="add_range_div['+lent+'][value]" placeholder="% or SR" class="discount_amt form-control more_prc_inpt inpt_txt"> <div class="price_percnt text-center"> <span class="disc_spv_dv amt_typ_spn active" type="percent">%</span> <span class="disc_spv_dv amt_typ_spn" type="amount">SR</span> </div><input type="hidden" class="disc_typ_cls" name="add_range_div['+lent+'][type]" value="percent"/> </div><label class="error" for="range_value_'+lent+'"></label> </div></div><div class="col-lg-3 rmv_range_div"> <div class="form-group text-center"> <span class="apnd_val rmv_range">Remove</span> </div></div></div></div>');

            $("input[id^=from_price_range_").each(function(){
                var ths = $(this);
                $(this).rules("add", {
                    // required: true,
                    required: {
                        depends: function(element) {
                            if ($('.acc_to_ordr_amt_cls').is(':checked')) {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    remote: {
                        url: "{{url('/admin/specialBuildMartFees/range/check')}}",
                        data:{
                            range:function(){
                                return ths.val();
                            },
                            part:function(){
                                return ths.closest('.row').attr('part');
                            },
                            productId:function(){
                                return productId;
                            },
                        },
                    },
                    number:true,
                    messages: {
                        required: "Please enter range from",
                        remote:"Range already exists"
                    }
                });   
            });

            $("input[id^=to_price_range_").each(function(){
                var ths = $(this);
                $(this).rules("add", {
                    // required: true,
                    required: {
                        depends: function(element) {
                            if ($('.acc_to_ordr_amt_cls').is(':checked')) {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    remote: {
                        url: "{{url('/admin/specialBuildMartFees/range/check')}}",
                        data:{
                            range:function(){
                                return ths.val();
                            },
                            part:function(){
                                return ths.closest('.row').attr('part');
                            },
                            productId:function(){
                                return productId;
                            },
                        },
                    },
                    number:true,
                    messages: {
                        required: "Please enter range to",
                        remote:"Range already exists"
                    }
                });   
            });

            $("input[id^=range_value_").each(function(){
                $(this).rules("add", {
                    // required: true,
                    required: {
                        depends: function(element) {
                            if ($('.acc_to_ordr_amt_cls').is(':checked')) {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    number:true,
                    messages: {
                        required: "Please enter value",
                    }
                });   
            });
        });

        $("body").on('keyup','.range_cls',function(){
            var value = $(this).val();
            var part = $(this).closest(".row").attr('part');
            var key = $(this).attr('rel');
            // alert(part);
            $.ajax({
                url: "{{url('/admin/specialBuildMartFees/range/add')}}",
                type:'post',
                data: {'value': value,'part':part,'key':key, productId:productId},
                success:function(response){
                    // $('.packingIdd').html(response);
                },error(){
                    // toastr.error('Something went wrong');
                }
            });
        }); 

        $("body").on('click','.rmv_range',function() {
            $(this).closest('.apnd_sec').remove();
            $('.apnd_sec').last().find('.inpt_txt').prop('readonly', false);
            $('.apnd_sec').last().find('.amt_typ_spn').addClass('disc_spv_dv');
            $('.apnd_sec').last().find('.rmv_range').show();
        });

        $("#buildMartFeeForm").validate({
            ignore:[],
            rules:{
                value:{
                    // required:true
                    required: {
                        depends: function(element) {
                            if ($(element).closest('.fee_radio_btn').find('input[type=radio]').is(':checked')) {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    number:true,
                },
            },
            messages:{
                value:{
                    required:"Please enter value"
                }
            }
        });

        $("input[id^=from_price_range_").each(function(){
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element) {
                        if ($('.acc_to_ordr_amt_cls').is(':checked')) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                number:true,
                messages: {
                    required: "please enter range from",
                }
            });   
        });

        $("input[id^=to_price_range_").each(function(){
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element) {
                        if ($('.acc_to_ordr_amt_cls').is(':checked')) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                number:true,
                messages: {
                    required: "please enter range to",
                }
            });   
        });

        $("input[id^=range_value_").each(function(){
            $(this).rules("add", {
                // required: true,
                required: {
                    depends: function(element) {
                        if ($('.acc_to_ordr_amt_cls').is(':checked')) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                number:true,
                messages: {
                    required: "please enter value",
                }
            });   
        });
    });
</script>

@stop