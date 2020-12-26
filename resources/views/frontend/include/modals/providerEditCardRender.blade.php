<input type="hidden" name="card_id" value="{{@$encCardId}}">
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Card Type</label>
            <select name="card_type" class="form-control custom-select">
                <option value="" selected>Select Card</option>
                <option @if(@$userCard['card_type']=='debit_card') selected="" @endif value="debit_card">Debit Card</option>
                <option @if(@$userCard['card_type']=='credit_card') selected="" @endif value="credit_card">Credit Card</option>
              </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Card Number</label>
            <input type="text" value="{{$userCard['card_no']}}" name="card_no" class="form-control" placeholder="Card Number">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Name on Card</label>
            <input type="text" value="{{$userCard['name_on_card']}}" name="name_on_card" class="form-control" placeholder="Name on Card">
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
                        <option @if(@$userCard['expiry_month']=='1') selected="" @endif value="01">01</option>
                        <option @if(@$userCard['expiry_month']=='2') selected="" @endif value="02">02</option>
                        <option @if(@$userCard['expiry_month']=='3') selected="" @endif value="03">03</option>
                        <option @if(@$userCard['expiry_month']=='4') selected="" @endif value="04">04</option>
                        <option @if(@$userCard['expiry_month']=='5') selected="" @endif value="05">05</option>
                        <option @if(@$userCard['expiry_month']=='6') selected="" @endif value="06">06</option>
                        <option @if(@$userCard['expiry_month']=='7') selected="" @endif value="07">07</option>
                        <option @if(@$userCard['expiry_month']=='8') selected="" @endif value="08">08</option>
                        <option @if(@$userCard['expiry_month']=='9') selected="" @endif value="09">09</option>
                        <option @if(@$userCard['expiry_month']=='10') selected="" @endif value="10">10</option>
                        <option @if(@$userCard['expiry_month']=='11') selected="" @endif value="11">11</option>
                        <option @if(@$userCard['expiry_month']=='12') selected="" @endif value="12">12</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group text-left">
                    <select name="expiry_year" class="form-control custom-select">
                        <option value="" selected>Year</option>
                        @for($i=0; $i < 10; $i++)
                            <option @if(@$userCard['expiry_year']==(date('Y')+$i)) selected="" @endif value="{{date('Y')+$i}}">{{date('Y')+$i}}</option>
                        @endfor
                        <!-- <option @if(@$userCard['expiry_year']=='2020') selected="" @endif value="2020">2020</option>
                        <option @if(@$userCard['expiry_year']=='2021') selected="" @endif value="2021">2021</option>
                        <option @if(@$userCard['expiry_year']=='2022') selected="" @endif value="2022">2022</option>
                        <option @if(@$userCard['expiry_year']=='2023') selected="" @endif value="2023">2023</option>
                        <option @if(@$userCard['expiry_year']=='2024') selected="" @endif value="2024">2024</option>
                        <option @if(@$userCard['expiry_year']=='2025') selected="" @endif value="2025">2025</option>
                        <option @if(@$userCard['expiry_year']=='2026') selected="" @endif value="2026">2026</option>
                        <option @if(@$userCard['expiry_year']=='2027') selected="" @endif value="2027">2027</option>
                        <option @if(@$userCard['expiry_year']=='2028') selected="" @endif value="2028">2028</option>
                        <option @if(@$userCard['expiry_year']=='2029') selected="" @endif value="2029">2029</option>
                        <option @if(@$userCard['expiry_year']=='2030') selected="" @endif value="2030">2030</option>
                        <option @if(@$userCard['expiry_year']=='2031') selected="" @endif value="2031">2031</option>
                        <option @if(@$userCard['expiry_year']=='2032') selected="" @endif value="2032">2032</option> -->
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group text-left">
            <label>CVV Number</label>
            <input type="password" value="{{$userCard['cvv']}}" name="cvv" class="form-control" placeholder="CVV Number">
        </div>
    </div>
</div>