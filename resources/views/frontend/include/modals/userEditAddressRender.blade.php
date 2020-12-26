<input type="hidden" name="address_id" value="{{@$encAddrsId}}">
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Address Title/Name</label>
            <input type="text" value="{{$userAddress['address_title']}}" name="address_title" class="form-control" placeholder="Home/Office/Store">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Address Detail</label>
            <input type="text" value="{{$userAddress['address']}}" name="address" class="form-control" placeholder="Builiding Name/Floor No./Office No.">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Province</label>
            <input type="text" value="{{$userAddress['province_name']}}" name="province_name" class="form-control" placeholder="Province Name">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Postal Code</label>
            <input type="text" value="{{$userAddress['postal_code']}}" name="postal_code" class="form-control" placeholder="Postal Code">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group text-left">
            <label>Country</label>
            <select name="country_id" class="form-control custom-select chng_cntry">
                <option value="" disabled="" selected>Select Country</option>
                @foreach($countries as $key => $country)
                    @if(!empty($country))
                        <option @if($country['id']==$userAddress['country_id']) selected="" @endif value="{{@$country['id']}}">{{@$country['name']}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group text-left">
            <label>City</label>
            <!-- <input type="text" value="{{$userAddress['city']}}" name="city" class="form-control" placeholder="City"> -->
            <select class="form-control custom-select chng_city" name="city_id">
                <option value="" disabled="" selected="">Select City</option>
                @foreach($cities as $key => $city)
                    @if(!empty($city))
                        <option @if($city['id']==$userAddress['city_id']) selected="" @endif value="{{@$city['id']}}">{{@$city['name']}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Location</label>
            <input type="text" value="{{$userAddress['location']}}" class="form-control" placeholder="Location" name="location">
        </div>
        <div class="form-group text-left">
            <div class="adrs_map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d231350.7620923537!2d55.1940508!3d25.0389721!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41ea57253d9dc545!2sOkzeela%20Star%20Building%20Materials%20Trading%20llc!5e0!3m2!1sen!2sin!4v1589633056776!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="text-right log_btn">
            <a href="javascript:;" class="btn btn_theme edt_adrs_btn"><span>Update Address</span></a>
        </div>
    </div>
</div>                                                
    
