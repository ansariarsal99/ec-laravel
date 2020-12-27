
@foreach($materialList as $material)
	<option value="{{$material->id}}">{{@$material->selling_material_name}}</option>
@endforeach

