@extends('frontend.layout.providerLayout')
@section('title','Build Mart Fees')
@section('content')
<section class="outer_db_wraper db_seller_items_list view_mart_fees">
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
                        <h3>Build Mart Fees</h3>
                        <nav class="bread_nav_sec">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:;">Build Mart Fees</a></li>
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
                                            <div class="adverts_wrap pad15 text-center">
                                                <i class="fa fa-cart-plus mb-3" aria-hidden="true"></i>
                                                <div class="singl_advrt text-center">
                                                    @if(@$user['build_mart_fees_type']=='any_order_amount')
                                                        <h4 class="mb-3"><strong>Fee Type:</strong> Any Order Amount</h4>
                                                        <div>
                                                            <p>{{@$feeRanges['value']}}<span>@if($feeRanges['type']=='percent')% @else SR @endif</span></p>
                                                        </div>
                                                    @else
                                                        <h4 class="mb-3"><strong>Fee Type:</strong> According to Amount of Order</h4>
                                                        <div class="range_amt">
                                                            @if(isset($feeRanges) && sizeof($feeRanges)>0)
                                                                @foreach($feeRanges as $key => $feeRange)
                                                                    @if(!empty($feeRange) && !empty($feeRange['from_price']) && !empty($feeRange['to_price']) && !empty($feeRange['value']))
                                                                        <p>
                                                                            <span><strong>Order Amount: </strong> {{@$feeRange['from_price']}}-{{@$feeRange['to_price']}}</span>
                                                                            @if($feeRange['type']=='percent')
                                                                                <span><strong>Fee: </strong> {{@$feeRange['value']}}%</span>
                                                                            @else
                                                                                <span><strong>Fee: </strong> {{@$feeRange['value']}} SR</span>
                                                                            @endif
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            <!-- <p>
                                                                <span><strong>Order Amount: </strong> 1-3</span>
                                                                <span><strong>Fee: </strong> 30%</span>
                                                            </p>
                                                            <p>
                                                                <span><strong>Order Amount: </strong> 1-3</span>
                                                                <span><strong>Fee: </strong> 30%</span>
                                                            </p> -->
                                                        </div>
                                                    @endif
                                                    @if($user['is_build_mart_fees_approve_by_user']=='no')
                                                        <button type="button" id="save" class="btn btn_theme aprv_fee_btn">
                                                            <span>Approve</span>
                                                        </button>
                                                    @else
                                                        <button type="button" id="save" class="btn btn_theme">
                                                            <span>Approved</span>
                                                        </button>
                                                    @endif
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
@include('frontend.include.modals.approveBuildMartFees')
@stop
@section('script')
<script type="text/javascript">
    $("body").on('click','.aprv_fee_btn',function(){
        // alert('here');
        $('#approve_build_mart_fees_mod').modal('show');
    });

    $("body").on('click','.aprv_fee_cnfrm',function(e){
        e.preventDefault();
        $('#approveBuildMartFeesForm').submit();
    });
</script>

@stop