<input type="hidden" name="address_id" value="{{@$encAddrsId}}">
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Address Name</label>
            <input type="text" name="store_name" value="{{@$storeLocation['store_name']}}" class="form-control" placeholder="Address Name">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group text-left">
            <label>Address Type</label>
            <!-- <input type="text" name="store_name" value="{{@$storeLocation['store_name']}}" class="form-control" placeholder="Name"> -->
            <select name="address_type_id" class="form-control custom-select">
                @if(isset($storeLocationAddressTypes) && sizeof($storeLocationAddressTypes)>0 )
                    @foreach($storeLocationAddressTypes as $key => $storeLocationAddressType)
                        @if(!empty($storeLocationAddressType))
                            <option @if($storeLocationAddressType['id']==$storeLocation['address_type_id']) selected="" @endif value="{{@$storeLocationAddressType['id']}}">{{@$storeLocationAddressType['name']}}</option>
                        @endif
                    @endforeach                                  
                @endif
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group text-left">
            <label>Street</label>
            <input type="text" name="street" value="{{@$storeLocation['street']}}" class="form-control" placeholder="Street ">
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
                    <option @if($storeLocation['country_id']==$country['id']) selected="" @endif value="{{$country['id']}}">{{$country['name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group text-left">
            <label>City</label>
            <!-- <input type="text" name="city" value="{{@$storeLocation['city']}}" class="form-control" placeholder="City"> -->
            <select class="form-control custom-select chng_city" name="city_id">
                <option value="" disabled="" selected="">Select City</option>
                @foreach($cities as $key => $city)
                    <option @if($storeLocation['city_id']==$city['id']) selected="" @endif value="{{$city['id']}}">{{$city['name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-left">
            <label>Location</label>
            <input type="text" name="location" value="{{@$storeLocation['location']}}" class="form-control" placeholder="Location">
        </div>
        <div class="form-group">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28900.22947607954!2d55.117153479588616!3d25.117811021706277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f152a683c0d79%3A0x546802ab643feb7f!2sThe%20Palm%20Jumeirah%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1593162628612!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</div>
<div class="text-right">
    <button class="btn btn_theme edt_adrs_btn"><span>Update Address</span></button>
</div>                                              
    
