<option value="" disabled="" selected>Select City</option>
@if(isset($cities) && !empty($cities))
	@foreach($cities as $city)
		@if(!empty($city))
			<option value="{{@$city['id']}}">{{@$city['name']}}</option>
		@endif
	@endforeach
@endif