@extends('frontend.layout.providerLayout')
@section('title','Terms Of Payment')
@section('content')

<style>
    /*.pay_perc i {
        color: #808080;
        font-size: unset;
        padding-right: 10px;
    }*/
</style>
        
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
                            <h3>Terms Of Payment</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Terms Of Payment</a></li>
                                    <!-- <li class="breadcrumb-item active">Item List</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </section>
                <div class="marg_over_bread">
                    <section class="item_list_sec p-0">
                        <div class="db_container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                <section class="register_sec pymnt_type selr_pymt">
                                    <div class="new_div_aded">
                                        <div class="section-heading">
                                            <h2>Terms Of Payment</h2>
                                        </div>
                                        <div class="wrap_register_white selr_reg_white">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pro-paymnt_new">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-sm-10 offset-sm-1">
                                                                    <div class="row view_prof_dash">

                                                                    @foreach($termPaymentquota as $key=>$value)
                                                                        <div class="col-lg-6 prvdr_adrs">
                                                                            <div class="wrap_svd_adrs svd_ic">
                                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                                    <h4 class="pay_ttle">{{@$value['name']}}</h4>
                                                                                 @if($value['use_term_of_payment_as_default']=='yes')
                                                                                   <span class="badg_deflt">Default</span>
                                                                                 @endif
                                                                                </div>
                                                                                @foreach($value['user_term_of_payment_quotas'] as $key=>$val)
                                                                                    <div class="form-group">
                                                                                        <div class="pay_perc">
                                                                                            <!-- <input type="checkbox" class="custom-control-input" readonly="" id="customCheck" name="example1"> -->
                                                                                            <!-- <label class="custom-control-label" for="customCheck">{{$val['quota_percent']}}% {{$val['title']}}</label> -->
                                                                                            <i class="fa fa-stop" aria-hidden="true"></i>  {{$val['quota_percent']}}% {{$val['title']}}
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach         
                                                                                <div class="svd_ic d-flex justify-content-between align-items-center">
                                                                                    <button value="{{base64_encode($value['id'])}}" type="button" class="btn btn_theme use_payment"><span>USE AS DEFAULT</span></button>                            
                                                                                    <div class="text-right">
                                                                                        <a href="{{url('provider/edit/paymentmethod/')}}/{{base64_encode(@$value['id'])}}">
                                                                                            <span class="cp text-primary mr-2">
                                                                                                <i class="fa fa-edit"></i> Edit
                                                                                            </span>
                                                                                        </a><br />    
                                                                                        
                                                                                          <input type="hidden" class="gg" name="paymentid" value="{{base64_encode($value['id'])}}">

                                                                                        <!-- <a class="" >
                                                                                            <span class="cp text-danger del rmv_adrs" value="{{$value['id']}}" >
                                                                                                <i class="fa fa-times" ></i> Delete
                                                                                            </span>
                                                                                        </a> -->
                                                                                         <span data-id="{{base64_encode($value['id'])}}" class="mb-4 text-center">
                                                                                            <!--     <a class="edt_adrs"><i class="fa fa-edit"></i> Edit</a><br /> -->
                                                                                                <a class="rmv_adrs"><i class="fa fa-times"></i> Remove</a>
                                                                                         </span>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <a href="{{url('/provider/termsPaymentAddNewMethod')}}" class="btn btn_theme" type="submit"><span>Add New Method</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
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


@include('frontend.include.modals.usePaymentMethodAsDefault')
@stop
@section('script')



<script>

        // $(document).on('click','.del_btn',function(){
        //     var paymentId = $('.gg').val();
        //     var confirmation =  confirm('Are you sure you want to delete this?');
        //     var ev        = $(this);
        //     if(confirmation == true){
        //         $.ajax({
        //              url: "{{ url('provider//delete/paymentmethod/') }}" + '/' + paymentId,
        //             type: 'POST',
        //            data : {"_token":"{{ csrf_token() }}"},  //pass the CSRF_TOKEN()
        //          success: function (data) {
        //                 if (data.status == 'ok') {
        //                     $(ev).closest('tr').hide();
                                               
        //                 }   
        //             }         
        //         });
        //     }else{
        //         return false;
        //     }
        // });
 
        $("body").on('click','.use_payment',function(){
             var paymentId =$(this).val();
             var model_id = $('.adrs_id_cls').val(paymentId);
            $('#use_address_as_default_mod').modal('show');
        });

          $(document).on('click','.rmv_adrs',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
             var paymentId =$(this).parent().data('id');
              // alert(paymentId);
            var ths = $(this);
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                     url: "{{ url('provider/delete/paymentmethod/') }}" + '/' + paymentId,
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            ths.closest('.prvdr_adrs').remove();
                            Swal.fire(
                              'Deleted!',
                              'Your address has been deleted.',
                              'success'
                            )
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        $(".loader").hide();
                        swal('Oops, Something went wrong');
                    }
                });
              }
            })            
        });

</script>

@stop