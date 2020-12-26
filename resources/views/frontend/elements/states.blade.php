<option value="" disabled="" selected>Select State</option>
@if(isset($states) && !empty($states))
	@foreach($states as $state)
		<option value="{{@$state['id']}}">{{@$state['name']}}</option>
	@endforeach
@endif