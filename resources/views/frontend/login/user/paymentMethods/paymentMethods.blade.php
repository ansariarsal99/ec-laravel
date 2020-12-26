@extends('frontend.layout.layout')
@section('title','Payment Methods')
@section('content')
<style>
    .img_prof {
        position: relative;
    }
    .img_prof img {
        width: 280px;
        height: 190px;
        border-radius: 20px;
        border: 1px dotted #b1b1b1;
        padding: 3px;
        object-fit: cover;
    }
    .file_upload_New {
        position: absolute;
        width: 40px;
        height: 40px;
        background: #cc3f2f;
        color: #fff;
        line-height: 40px;
        text-align: center;
        border-radius: 13px;
        top: 0;
        right: 267px;
    }
    .file_type {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
</style>
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment Methods</li>
            </ol>
        </nav>
    </div>
    
    <section class="prof_dashboard padd_all_sec">
        <div class="container-fluid">
            <div class="row">                
                @include('frontend.include.userSidebar')
                <div class="col-sm-9">
                    <div class="mainside_wrap">
                        <div class="page_head">
                            <h4>Payment Methods</h4>
                            <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                        </div>

                         <div class="wrap_register_white selr_reg_white mt-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="pro-paymnt">
                                        <!-- <div class="acc-head">
                                            <h4> Choose Payment Method </h4>
                                        </div> -->
                                        <div class="acc-pay-detail">
                                            <div class="form-group ">
                                                <div class="tabs_pymnt">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="text-center nav-link " data-toggle="tab" href="#home"><i class="fa fa-google-wallet"></i><br> Wallet </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="text-center nav-link active" data-toggle="tab" href="#menu1"><i class="fa fa-credit-card"></i></br> Card</a>
                                                        </li>
<!--                                                         <li class="nav-item">
                                                            <a class="text-center nav-link paydata" data-toggle="tab" paymentType="cash-payment" href="#menu2"><i class="fa fa-money"></i></br> Cash</a>
                                                        </li> -->
                                                        <li class="nav-item">
                                                            <a class="text-center nav-link paydata" data-toggle="tab" paymentType="sadad-payment" href="#menu3"><i class="fa fa-cc-diners-club"></i></br> Sadad</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="text-center nav-link" data-toggle="tab" href="#menu4"><i class="fa fa-exchange"></i><br> Wire Transfer</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane container fade" id="home">
                                                            <div class="tab_inr_pay wire_pay">
                                                                <h6>Wallet Balance:</h6>
                                                                <div class="wlt_balm">
                                                                    <h2>$ 1456.75</h2>
                                                                    <p>Current Balance</p>
                                                                    <div class="button_nex_prev">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="text-center">
                                                                                <a class="btn btn_theme btn_nex" href="myWallet.php"><span>Add Money <i class="fa fa-arrow-right"></i></span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane container active" id="menu1">
                                                           <div class="main_cntnt_dash">
                                                               <div class="card order_prof_dash">
                                                                   <div class="cont_shd_frm">
                                                                       <div class="wrap_adrs pad20">
                                                                           <div class="ordr-addr">
                                                                               <div class="acc-body-addr">
                                                                                   @if(isset($userCards) && sizeof($userCards)>0)
                                                                                       <div class="saved_adrss">
                                                                                           <!-- <small>Is the Card you would like to use displayed below? If so, click the corresponding "Use Card" button. Or You can add a new Card below.</small> -->
                                                                                           <div class="row">
                                                                                               @foreach($userCards as $key => $userCard)
                                                                                                   @if(!empty($userCard))
                                                                                                       <div class="col-sm-6 card_rmv_div">
                                                                                                           <div class="wrap_svd_adrs">
                                                                                                               <div class="d-flex justify-content-between">
                                                                                                                   <div class="card_nam">
                                                                                                                       <small> @if($userCard['card_type']=='debit_card') Debit Card @else Credit Card @endif </small><br />
                                                                                                                       <i class="fa fa-credit-card"></i>
                                                                                                                   </div>
                                                                                                                   @if($userCard['use_card_as_default']=='yes')
                                                                                                                       <span class="badg_deflt">Default</span>
                                                                                                                   @endif
                                                                                                               </div>
                                                                                                               <h3>xxxx-xxxx-xxxx-{{substr($userCard['card_no'],-4)}}</h3>
                                                                                                               <p>{{@ucwords($userCard['name_on_card'])}} &nbsp;&nbsp; | &nbsp;&nbsp;{{@sprintf("%02d", $userCard['expiry_month'])}}/{{@$userCard['expiry_year']}}</p>
                                                                                                               <div class="form-group svd_ic d-flex justify-content-between">
                                                                                                                   <button type="button" class="btn btn_theme use_crd_btn"><span>Use as Default</span></button>
                                                                                                                   <div data-id="{{base64_encode($userCard['id'])}}">
                                                                                                                       <span class="cp text-primary edt_card"><i class="fa fa-edit"></i> Edit</span><br>
                                                                                                                       <span class="cp text-danger rmv_card"><i class="fa fa-times"></i> Remove</span>
                                                                                                                   </div>
                                                                                                               </div>
                                                                                                           </div>
                                                                                                       </div>
                                                                                                   @endif
                                                                                               @endforeach
                                                                                           </div>
                                                                                       </div>
                                                                                   @endif
                                                                                   <div class="text-right mb-2">
                                                                                       <a href="javascript:;" class="new_adrs_p"><i class="fa fa-plus"></i> Add New Card</a>
                                                                                   </div>
                                                                                   <div class="add_new_adrs">
                                                                                       <div class="odr-head">
                                                                                           <h4> Add New Card </h4>
                                                                                       </div>
                                                                                       <form class="addCardForm" method="POST" action="{{url('/user/card/add')}}" >
                                                                                           @csrf
                                                                                           <div class="cont_rp_form">
                                                                                               <div class="row">
                                                                                                   <div class="col-sm-12">
                                                                                                       <div class="form-group text-left">
                                                                                                           <label>Card Type</label>
                                                                                                           <select name="card_type" class="form-control custom-select">
                                                                                                               <option value="" selected>Select Card</option>
                                                                                                               <option value="debit_card">Debit Card</option>
                                                                                                               <option value="credit_card">Credit Card</option>
                                                                                                             </select>
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </div>
                                                                                               <div class="row">
                                                                                                   <div class="col-sm-12">
                                                                                                       <div class="form-group text-left">
                                                                                                           <label>Card Number</label>
                                                                                                           <input type="text" name="card_no" class="form-control" placeholder="Card Number">
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </div>
                                                                                               <div class="row">
                                                                                                   <div class="col-sm-12">
                                                                                                       <div class="form-group text-left">
                                                                                                           <label>Name on Card</label>
                                                                                                           <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card">
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </div>
                                                                                               <div class="row">
                                                                                                   <div class="col-sm-6">
                                                                                                       <label>Expiry Date</label>
                                                                                                       <div class="row">
                                                                                                           <div class="col-sm-6">
                                                                                                               <div class="form-group text-left">
                                                                                                                   <select name="expiry_month" class="form-control custom-select">
                                                                                                                       <option value="" selected>Month</option>
                                                                                                                       <option value="01">01</option>
                                                                                                                       <option value="02">02</option>
                                                                                                                       <option value="03">03</option>
                                                                                                                       <option value="04">04</option>
                                                                                                                       <option value="05">05</option>
                                                                                                                       <option value="06">06</option>
                                                                                                                       <option value="07">07</option>
                                                                                                                       <option value="08">08</option>
                                                                                                                       <option value="09">09</option>
                                                                                                                       <option value="10">10</option>
                                                                                                                       <option value="11">11</option>
                                                                                                                       <option value="12">12</option>
                                                                                                                   </select>
                                                                                                               </div>
                                                                                                           </div>
                                                                                                           <div class="col-sm-6">
                                                                                                               <div class="form-group text-left">
                                                                                                                   <select name="expiry_year" class="form-control custom-select">
                                                                                                                       <option value="" selected>Year</option>
                                                                                                                       @for($i=0; $i < 10; $i++)
                                                                                                                           <option value="{{date('Y')+$i}}">{{date('Y')+$i}}</option>
                                                                                                                       @endfor
                                                                                                                   </select>
                                                                                                               </div>
                                                                                                           </div>
                                                                                                       </div>
                                                                                                   </div>
                                                                                                   <div class="col-sm-6">
                                                                                                       <div class="form-group text-left">
                                                                                                           <label>CVV Number</label>
                                                                                                           <input type="password" name="cvv" class="form-control" placeholder="CVV Number">
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </div>
                                                                                               <!-- <div class="row justify-content-end">
                                                                                                   <div class="col-sm-12">
                                                                                                       <div class="form-group text-right">
                                                                                                           <div class="custom-control custom-checkbox">
                                                                                                               <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                                                               <label class="custom-control-label" for="customCheck">Save Card for later use</label>
                                                                                                           </div>
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </div> -->
                                                                                               <div class="text-right">
                                                                                                   <button class="btn btn_theme add_card_btn"><span>Add Card</span></button>
                                                                                               </div>
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
                                                        <div class="tab-pane container" id="menu2">
                                                            <div class="tab_inr_pay">
                                                                <div class="ordr-addr">
                                                                    <div class="acc-body-addr tabs_ttl_nw">
                                                                        <h6>Payment Receipt</h6>
                                                                        <div class="form-group imge_uploader">
                                                                            <!-- <label>Payment Receipt</label> -->
                                                                               <form method="post" action="" class="thirdform-PaymentFORM"  enctype="multipart/form-data">
                                                                                <div class="profle_pic text-center">
                                                                                    <input type="hidden" name="registered_id" class="registered_id">
                                                                                    <input type="hidden" name="cash_payment_id" class="cash_payment_id">

                                                                                    <input type="hidden" name="type" value="cash">

                                                                                        <div class="img_prof user-img text-center">
                                                                                           <img src="{{@$admin_image}}" id="img-fluid" name="invoice_image" value="" class="img-fluid user-img">

                                                                                           <span class="file_upload_New">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                            <input type="file" id="botonAjax" name="uploader" value="" class="file_type">
                                                                                           </span>
                                                                                        </div>                                  <label id="botonAjax-error" class="error mt-3" for="botonAjax"></label>
                                                                                </div>
                                                                                </form>
                                                                            <!-- End -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane container" id="menu3">
                                                            <div class="tab_inr_pay">
                                                                <div class="ordr-addr">
                                                                    <div class="acc-body-addr">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         </div>
                                                         <?php
                                                          $wireTransferDetails = App\AdminWireTransferDetail::first();
                                                         ?>
                                                        <div class="tab-pane container fade" id="menu4">
                                                            <div class="tab_inr_pay wire_pay">
                                                                <h6>Wire Transfer Details:</h6>
                                                                <div class="addNewCard">
                                                                    <form class="" method="">
                                                                      
                                                                        <!--  -->
                                                                        <div class="cont_rp_form">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Bank name</label>    
                                                                                        <input type="text" name="bank_name" class="form-control" placeholder="Bank name" value="{{$wireTransferDetails->bank_name}}" disabled="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Account Name</label>
                                                                                        <input type="text" name="account_name" class="form-control" placeholder="Account Name" value="{{$wireTransferDetails['account_name']}}" disabled="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Account iBAN Number</label>
                                                                                        <input type="text" name="account_iban_number" class="form-control" placeholder="Account iBAN Number" value="{{$wireTransferDetails['account_iban_number']}}" disabled="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                          <!--   <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Attach copy of transfer receipt</label>
                                                                                        <div class="custom-file">
                                                                                            <input type="file" class="custom-file-input" id="customFile">
                                                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                                                          </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->
                                                                        </div>
                                                                        <!--  -->
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                </div>
                                            </div>
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
    @include('frontend.include.modals.useCardAsDefault')
    @include('frontend.include.modals.userEditCard')    
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_new_adrs').hide();
        $('body').on('click', '.new_adrs_p', function(){
            $('.add_new_adrs').slideToggle('normal');
        });

        $('.addCardForm').validate({
            ignore:[],
            rules:{
                card_type:{
                    required:true
                },
                card_no:{
                    required:true,
                    digits:true,
                    minlength:16,
                    maxlength:16,
                },
                name_on_card:{
                    required:true,
                    // noSpace:true,
                    regex:regex_user_name,
                },
                expiry_month:{
                    required:true
                },
                expiry_year:{
                    required:true
                },
                cvv:{
                    required:true
                },
            },
            messages:{
                card_type:{
                    required:"Please select card type"
                },
                card_no:{
                    required:"Please enter card number",
                    minlength:"Please enter 16 digit number",
                    maxlength:"Please enter 16 digit number",
                },
                name_on_card:{
                    required:"Please enter name on card",
                },
                expiry_month:{
                    required:"Please select month",
                },
                expiry_year:{
                    required:"Please select year",
                },
                cvv:{
                    required:"Please enter cvv number",
                },
            }
        });

        $("body").on('click','.add_card_btn',function(){
            $('.addCardForm').submit();
        });

        $("body").on('click','.edt_card',function(e){
            e.preventDefault();
            // alert('sd');
            // alert($(this).parent().data('id'));
            var enc_card_id = $(this).parent().data('id');
            $.ajax({
                url:"{{url('user/card/editModal')}}"+"/"+enc_card_id,
                type: "post",
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        $('.card_div_mod').html(resp.html);
                        $('#edit_card').modal('show');
                    }else{
                        swal('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
        });

        $("body").on('click','.rmv_card',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_card_id = $(this).parent().data('id');
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
                    url:"{{url('user/card/delete')}}"+"/"+enc_card_id,
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            // alert($('.card_rmv_div').length);
                            if ($('.card_rmv_div').length==1) {
                                ths.closest('.saved_adrss').remove();                                
                            }else{
                                ths.closest('.card_rmv_div').remove();                                
                            }
                            Swal.fire(
                              'Deleted!',
                              'Your card has been deleted.',
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

        $("body").on('click','.use_crd_btn',function(){
            // alert($(this).next().data('id'));
            $('.card_id_cls').val($(this).next().data('id'));
            $('#use_card_as_default_mod').modal('show');
        });

    });
</script>
@stop