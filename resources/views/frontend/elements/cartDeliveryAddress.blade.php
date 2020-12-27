 <div class="row">
    @foreach($deliveryAddress as $address)
    <div class="col-sm-6">
        <div class="wrap_svd_adrs  plan_wrpr">
            <div class="d-flex justify-content-between">
                <i class="fa fa-map-marker"></i>
                  @if($address['use_address_as_default']=='yes') <span class="badg_deflt">Default</span>@endif
           
            </div>
            <h3>{{@$address['location']}}</h3>
            <p>{{$address['address']}} </p>
            <div class="form-group svd_ic d-flex justify-content-between">
                <button type="button" class="btn btn_theme chooseDeiveryAddress" data-id="{{($address['id'])}}"><span>Deliver to this Address</span></button>
                <div>
                    <span data-id="{{base64_encode($address['id'])}}" class="mb-4">
                        <a class="edt_adrs"><i class="fa fa-edit"></i> Edit</a>
                        <a class="rmv_adrs"><i class="fa fa-times"></i> Remove</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>