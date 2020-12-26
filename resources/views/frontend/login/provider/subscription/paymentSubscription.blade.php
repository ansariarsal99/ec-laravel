<?php  
    $admin_image = defaultAdminImagePath.'/no_image.png';                                              
?>
@extends('frontend.layout.providerLayout')
@section('title','Subscription Payment')
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
    .filenew_upload {
        position: absolute;
        width: 40px;
        height: 40px;
        background: #cc3f2f;
        color: #fff;
        line-height: 40px;
        text-align: center;
        border-radius: 13px;
        top: 0;
        right: 456px;
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
     .pay_price {
        background-color: #f1f1f1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        margin-bottom: 15px;
    }
    .pay_price h4{
        font-size: 20px;
        color: #cc3f2f;
    }
    /*===============Rohit css 16 sep====*/
    .subctn_choose{
        width: calc(100% - 0px);
    }
    /*===============Rohit css 16 sep====*/
</style>
    <section class="outer_db_wraper db_seller_items_list">
        <div class="combine_side_main_slr_db d-flex">
            <div class="main_seller_db item_list_seller_db subctn_choose">
                <section class="bread_top_sec">
                    <div class="db_container">
                        <div class="d-flex justify-content-between text-white pos_rel">
                            <div class="sid_controlr">
                                <i class="clos_sid fa fa-bars"></i>
                                <i class="opn_sid fa fa-times"></i>
                            </div>
                            <h3> Subscription Payment </h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Subscription Payment</a></li>
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
                                                    <!-- <div class="section-heading">
                                                        <h2>Payment Methods</h2>
                                                    </div> -->
                                                    <div class="wrap_register_white selr_reg_white mt-0">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="pro-paymnt">
                                                                    <!-- <div class="acc-head">
                                                                        <h4> Choose Payment Method </h4>
                                                                    </div> -->
                                                                    <div class="pay_price">
                                                                        <?php 
                                                                        $price =$_GET['payment'];

                                                                         $subscriptionId=$_GET['subscriptionId'];
                                                                        ?>
                                                                        <h4>Total Payment:</h4>
                                                                        <h2> {{base64_decode($price) }} SR </h2>
                                                                    </div>
                                                                    <input type="hidden" name="subscriptionId" value="{{base64_decode($subscriptionId) }}" class="subscriptionId">
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
                                                                                    <li class="nav-item">
                                                                                        <a class="text-center nav-link paydata" data-toggle="tab" paymentType="cash-payment" href="#menu2"><i class="fa fa-money"></i></br> Cash</a>
                                                                                    </li>
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
                                                                                                              
                                                                                    <div class="tab-pane active" id="menu1">
                                                                                        <div class="tab_inr_pay">
                                                                                            <div class="ordr-addr">
                                                                                                <div class="acc-body-addr">
                                                                                                    @if(isset($userCards) && sizeof($userCards)>0)
                                                                                                        <div class="saved_adrss">
                                                                                                            <!-- <small>Is the Card you would like to use displayed below? If so, click the corresponding "Use Card" button. Or You can add a new Card below.</small> -->
                                                                                                            <div class="row">
                                                                                                                @foreach($userCards as $key => $userCard)
                                                                                                                    @if(!empty($userCard))
                                                                                                                        <div class="col-sm-4 card_rmv_div">
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
                                                                                                                                    <button data-id="{{$userCard['id']}}" type="button" class="btn btn_theme use_crd_btn"><span>Use card for payment</span></button>

                                                                                                            <input type="hidden" name="type" value="card" class="cardType">

                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                                <!-- <div class="col-sm-6">
                                                                                                                    <div class="wrap_svd_adrs">
                                                                                                                        <i class="fa fa-credit-card"></i>
                                                                                                                        <h3>xxxx-xxxx-xxxx-6881</h3>
                                                                                                                        <p>William Cage &nbsp;&nbsp; | &nbsp;&nbsp;18/2034</p>
                                                                                                                        <div class="form-group svd_ic d-flex justify-content-between">
                                                                                                                            <button type="button" class="btn btn_theme"><span>Use Card</span></button>
                                                                                                                            <div>
                                                                                                                                <span class="cp text-primary"><i class="fa fa-edit"></i> Edit</span><br>
                                                                                                                                <span class="cp text-danger"><i class="fa fa-times"></i> Remove</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif
<!--                                                                                                     <div class="text-right mb-2">
                                                                                                            <a href="javascript:;" class="new_adrs_p"><i class="fa fa-plus"></i> Add New Card</a>
                                                                                                    </div> -->

                                                                                                

                                                                                                       <!--      <div class="cont_rp_form">
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
                                                                                                                <div class="row justify-content-end">
                                                                                                                    <div class="col-sm-12">
                                                                                                                        <div class="form-group text-right">
                                                                                                                            <div class="custom-control custom-checkbox">
                                                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                                                                                <label class="custom-control-label" for="customCheck">Save Card for later use</label>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="text-right">
                                                                                                                    <button class="btn btn_theme add_card_btn"><span>Add Card</span></button>
                                                                                                                </div>
                                                                                                            </div> -->

                                                                                                        <!-- </form> -->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="tab-pane" id="menu2">
                                                                                        <div class="tab_inr_pay">
                                                                                            <div class="ordr-addr">
                                                                                                <div class="acc-body-addr tabs_ttl_nw">
                                                                                                    <h6>Payment Receipt</h6>
                                                                                                    <div class="form-group imge_uploader">
                                                                                                        <!-- <label>Payment Receipt</label> -->
                                                                                                        <form method="post" action="" class="thirdform-PaymentFORM"  enctype="multipart/form-data">
                                                                                                            @csrf
                                                                                                            <div class="profle_pic text-center">

                                                                                                                <div class="img_prof user-img text-center">
                                                                                                                    <img src="{{@$admin_image}}" id="img-fluid" name="invoice_image" value="" class="img-fluid user-img">

                                                                                                                    <span class="filenew_upload">
                                                                                                                    <i class="fa fa-pencil"></i>
                                                                                                                    <input type="file" id="botonAjax" name="uploader" value="" class="file_type">
                                                                                                                        </span>
                                                                                                                </div>                                          <label id="botonAjax-error" class="error mt-3" for="botonAjax">
                                                                                                                </label><br>
                                                                                                                <button type="button"  class="btn btn_theme cashPayment text-center"><span>Submit</span></button>
                                                                                                            </div>
                                                                                                            <input type="hidden" name="type" value="cash" class="paymentType">
                                                                                                        </form>
                                                                                                        <!-- End -->
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="tab-pane" id="menu3">
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
                                                                                    <div class="tab-pane fade" id="menu4">
                                                                                        <div class="tab_inr_pay wire_pay">
                                                                                            <h6>Wire Transfer Details:</h6>
                                                                                            <div class="addNewCard">
                                                                                                <!-- <form class="" method=""> -->
                                                                                                  
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



                                                                                                        <div class="form-group imge_uploader">
                                                                                                            <form method="post" action="" class="wireTransferForm"  enctype="multipart/form-data">

                                                                                                            <input type="hidden" name="type" value="wiretransfer" class="paymentType">

                                                                                                                <div class="profle_pic text-center">

                                                                                                                    <div class="img_prof wiretransfer-img text-center">
                                                                                                                        <img src="{{@$admin_image}}" id="img-fluid" name="invoice_image" value="" class="img-fluid wiretransfer-img">

                                                                                                                        <span class="filenew_upload">
                                                                                                                           <i class="fa fa-pencil"></i>
                                                                                                                           <input type="file" id="wireTransferButtonAjax" name="uploader" value="" class="file_type">
                                                                                                                        </span>
                                                                                                                    </div>                                            <label id="wireTransferButtonAjax-error" class="error mt-3" for="wireTransferButtonAjax">
                                                                                                                    </label><br>

                                                                                                                    <button type="button"  class="btn btn_theme text-center wireTransferButton"><span>Submit</span></button>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!--  -->
                                                                                                <!-- </form> -->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <?php
                                                                                  
                                                                                    $currentDate = date('Y-m-d H:i:s');
                                                                                     // dd($currentDate);
                                                                                  
                                                                                    $userId = Auth::user()->id;
                                                                                    $userType = Auth::user()->user_type_id;
                                                                                    $userType = App\UserType::where('id',Auth::user()->user_type_id)->value('type');

                                                                                    $userTypename = App\UserType::where('id',Auth::user()->user_type_id)->first();
                                                                                 

                                                                                    $expiryDate= Auth::user()->expiry_subscription_package;


                                                                                     
                                                                                ?>
                                                                                <input type="hidden" name="currentDate" class="todayDate" value="{{@$currentDate}}">

                                                                                <input type="hidden" name="expiryDate" class="expiredDateSubscription" value="{{@$expiryDate}}">

                                                                                <input type="hidden" name="userType" class="userType" value="{{@$userType}}">
                                                                                <input type="hidden" name="userId" class="userId" value="{{@$userId}}">

                                                                                <input type="hidden" name="userTypename" class="userTypename" value="{{@$user['user_type_detail']['id']}}">
                                                                             
                                                                          
                                                                            <div class="text-right logoutButton">
                                                                                <a href="{{ url('/logout') }}">
                                                                                     <button type="button"  class="btn btn_theme"><span>Logout</span></button>
                                                                                </a>
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
    @include('frontend.include.modals.providerUseCardAsDefault')
    @include('frontend.include.modals.providerEditCard')
@stop
@section('script')

<script type="text/javascript">


$(document).ready(function() {
 $(".logoutButton").hide();
     var currentDate = $('.todayDate').val();
     var expiryDate  = $('.expiredDateSubscription').val();
     var usertype    = $('.userType').val();

         if (usertype =='provider') {
              if(expiryDate < currentDate) {
                 $(".logoutButton").show();
              }
      
         }

});
</script>


<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('.wiretransfer-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#wireTransferButtonAjax").change(function() {
      readURL(this);
    });
</script>

<script>
    function readURLCash(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
             $('.user-img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#botonAjax").change(function() {
      readURLCash(this);
    });
</script>



<script type="text/javascript">
    $(document).on('click','.use_crd_btn',function(){
        var cardId = $(this).data('id');
        var subscriptionId = $('.subscriptionId').val();
        var type = $('.cardType').val();
        
        // alert(type);
        
        $.ajax({
            url: "{{url('provider/subscription/payment')}}",
            type:'post',
            data:{type:type,cardId:cardId,subscriptionId:subscriptionId,_token:"{{ csrf_token() }}" },
            success:function(response){
                if(response['status']=="true"){
                      location.href='{{url('/logout')}}';
                   }else{
                      toastr.error('status false');   
                   }
            },error(){
                  toastr.error('Something went wrong ');   
            }
       })
    });

</script>
<script type="text/javascript">

    $(document).on('click','.cashPayment',function(){
      var formData = new FormData($('.thirdform-PaymentFORM')[0]);
      $.ajax({
            url: "{{url('provider/subscription/payment')}}",
            type:'post',
            data:formData,                    
            processData: false,
            contentType: false,
            success:function(response){
                if(response['status']=="true"){
                    toastr.success('Your payment is not approved by admin');   
                    location.href='{{url('/logout')}}';
                 }else{
                        toastr.error('Something went wrong ');    
                    }  
            },
            error(){
                toastr.error('Something went wrong');
            }
        })
     });
    
    $(document).on('click','.wireTransferButton',function(){
        var formData1 = new FormData($('.wireTransferForm')[0]);
        $.ajax({
          url: "{{url('provider/subscription/payment')}}",
          type:'post',
          data:formData1,                    
          processData: false,
          contentType: false,
          success:function(response){
              if(response['status']=="true"){
                  location.href='{{url('/logout')}}';
               }else{
                      toastr.error('Something went wrong ');    
                  }  
          },
          error(){
              toastr.error('Something went wrong');
          }
      })
   });
</script>

<!-- 
<script type="text/javascript">
    $(document).ready(function(){

        $('.user_ad_adrss').hide();
        $('body').on('click', '.new_adrs_p', function(){
            $('.user_ad_adrss').slideToggle('normal');
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
                url:"{{url('provider/card/editModal')}}"+"/"+enc_card_id,
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
                    url:"{{url('provider/card/delete')}}"+"/"+enc_card_id,
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
</script> -->
@stop