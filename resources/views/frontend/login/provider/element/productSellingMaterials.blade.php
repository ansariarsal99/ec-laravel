 <!-- <option disabled>Select Type of Material</option> -->
@foreach($typeOfMaterials as $typeOfMaterial)
	<option value="{{$typeOfMaterial->id}}">{{@$typeOfMaterial->selling_material_name}}</option>
@endforeach