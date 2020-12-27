<div class="form-group text-left">
    <label class="bold_text build_label">Type of Entity</label>
    <div class="wrap_rad_chk1">
        <div class="row ">
	@foreach($userProperty as $value)
	
	  <div class="col-sm-4">
	    <div class="custom-control custom-radio ">
			 <input type="radio" class="custom-control-input service_select" id="pe{{$value['id']}}" propertyId="{{$value['id']}}" name="user_property_id" value="{{$value['id']}}">
			 <label class="custom-control-label" for="pe{{$value['id']}}">{{$value['name']}}</label>
	    </div>
	 </div>
	@endforeach
	</div>
	<label id="user_property_id-error" class="error" for="user_property_id"></label>
    </div>
</div>




        
        
