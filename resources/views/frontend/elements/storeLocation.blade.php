@foreach($userPaymentCard as  $cardPayment)
<div class="wrap_svd_adrs">
    <div class="d-flex justify-content-between">
        <i class="fa fa-credit-card"></i>
        
        <span class="badg_deflt">{{$cardPayment['use_card_as_default']}}</span>
    </div>
    <h3>{{$cardPayment['card_no']}}</h3>
    <p>{{$cardPayment['name_on_card']}} &nbsp;&nbsp; | &nbsp;&nbsp;{{$cardPayment['expiry_month']}}/ expiry_year {{$cardPayment['expiry_year']}}</p>
    <div class="form-group svd_ic d-flex justify-content-end">
        <button type="button" class="btn btn_theme"><span>Use Card</span></button>
    </div>
</div>
@endforeach