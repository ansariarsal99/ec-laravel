@extends('frontend.layout.providerLayout')
@section('title','Subscription')
@section('content')
<style>
    .upgrade_plans .modal-dialog{
        width: 750px;
    }
    .choose_plan {
        max-height: 420px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    /*====Rohit css 12 sep =====*/
    .pns_date > p {
        margin: 5px 0;
        color: #6d6d6d;
    }
    .pns_date > p strong {
        color: #cc3f2f;
        font-weight: 500;
    }
    .vwnew_btn span {
        display: inline-block;
        background: #6a5e95;
        padding: 10px 17px;
        color: #fff;
        border-radius: 6px;
        box-shadow: 0 0 10px -1px #6a5e95;
    }
    .plns_ch_in{
        margin-bottom: 30px;
    }
    /*====Rohit css 12 sep =====*/
</style>

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
                            <h3>My Subscription</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="#">My Subscription</a></li>
                                    <!-- <li class="breadcrumb-item active">Item List</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </section>
                
                <section class="item_list_sec p-0 seler_price_plan">
                    <div class="db_container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="new_div_aded">
                                            <div class="wrap_register_white">
                                                <div class="subsc_plans">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-6">
                                                            <div class="plan_wrpr text-center">
                                                                <h3 class="text-uppercase">{{$subscriptionRecord['title']}}</h3>
                                                                <h4 class="pln_val">SR {{$subscriptionRecord['price']}} <small>/{{$subscriptionRecord['time_limit']}} {{$subscriptionRecord['time_type']}}</small></h4>
                                                                <ul type="none" class="pln_bnfts">
                                                                    <li><i class="fa fa-check"></i> {{$subscriptionRecord['description']}}</li>
                                                                </ul>

                                                                 <?php  
                                                                   
                                                                 $paymentDataSubscription = App\UserSubscriptionPayment::where('user_id',$subscriptionRecord['user_id'])->first();
                                                                    if (!empty($paymentDataSubscription['invoice_image'])) {
                                                                      
                                                                        if (file_exists(invoiceImageBasePath.'/'.$paymentDataSubscription['invoice_image'])) {
                                                                            $image = 'fa fa-file-pdf-o';
                                                                        }else{
                                                                            $image = defaultImagePath;
                                                                        }
                                                                    }else{
                                                                        $image = defaultImagePath;
                                                                    }
                                                                ?>


                                                                <div class="chooseplans_info">
                                                                    <div class="row">
                                                                        <div class="col-12 ">
                                                                            <div class="plns_ch_in d-flex justify-content-between align-items-center">
                                                                                <div class="pns_date text-left">
                                                                                    <p><strong>Start Date:</strong> {{$subscriptionRecord['created_at']}}</p>
                                                                                    <p><strong>End Date:</strong> {{$subscriptionRecord['expiry_subscription_package']}}</p>
                                                                                    <p><strong>Status:</strong> {{$subscriptionRecord['status']}}</p>

                                                                                      @if($paymentDataSubscription['payment_type']=='card')
                                                                                       <p><strong>Transaction Id:</strong> {{$paymentDataSubscription['transaction_id']}}</p>
                                                                                       
                                                                                      @endif
                                                                                </div>

                                                                                @if($paymentDataSubscription['payment_type']!='card')
                                                                                <div class="vwnew_btn">
                                                                                    <a href="{{asset(invoiceImageBasePath.'/'.$paymentDataSubscription['invoice_image'])}}" download><span><i class="fa fa-file-pdf-o {{$image}}"></i> Click to view</span></a>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              
                                                               @if(@updatedSubscriptionRecord!=null)
                                                                <div class="">
                                                                    <button class="btn btn_theme" data-toggle="modal" data-target="#upgrade_plan" type="button"><span>Upgrade Subscription pack</span>
                                                                    </button>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    <input type="hidden"  name="user_id" value="$subscriptionRecord['user_id']">   
                                                    </div>
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
    </section>
    



@include('frontend.include.modals.updateSubscriptionpackRefill')
<!-- @include('frontend.include.modals.updateSubscriptionChoose') -->

@stop
@section('script')



<script type="text/javascript">

    $(".chooseSubscriptionPack").click(function(){            
        $('#updatesubscription').modal('show');
        $('#upgrade_plan').modal('show');
    });

</script>

<!-- <script type="text/javascript">

 $(".chooseSubscriptionPack").click(function(){
            
             $('#updatesubscription').modal('show');
             $('#upgrade_plan').modal('hide');

            var data  = $(this).closest('div').find('.titleSubscription').text();
            var pack  = $(".subPack").text(data);
            $('.subs_pack_cls').val($(this).data('id')); 
            // dd()
            var subscriptionId = $(this).closest('div').find('.sub_id').val();
            userId = $(".userId").val();

                $('#dataSubmit').click(function(){
                    $.ajax({
                        url: "{{url('update_subscription-pack-choosen')}}",
                        type:'post',
                        data:{userId:userId,subscriptionId:subscriptionId,_token:"{{ csrf_token() }}" },
                        success:function(response){
                            if(response['status']='true'){                                
                               location.reload();
                               $('#updatesubscription').modal('hide');
                            }

                        },error(){
                            toastr.error('Something went wrong');
                        }       
                    })
                });
           });

</script> -->

@stop