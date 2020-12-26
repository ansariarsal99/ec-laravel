<div class="row">
    @foreach($userCards as $key => $userCard)
        @if(!empty($userCard))
            <div class="col-sm-6 card_rmv_div">
                <div class="wrap_svd_adrs mainpaymentdiv card_wrpr">
                        <input type="hidden" name="id_sub" class="sub_id" value="{{$userCard['id']}}">
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
                       <button type="button" class="btn btn_theme use_crd_btn" data-id="{{($userCard['id'])}}"><span>Use Card</span></button>
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
