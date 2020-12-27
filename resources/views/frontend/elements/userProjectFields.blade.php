@if(isset($userProjectFields) && sizeof($userProjectFields)>0)
	@foreach($userProjectFields as $key => $userProjectField)
		@if(!empty($userProjectField))
			<option value="{{$userProjectField['id']}}">{{$userProjectField['name']}}</option>
		@endif
	@endforeach
@endif