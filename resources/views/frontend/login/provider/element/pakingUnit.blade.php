<option value="" selected disabled>Select Unit</option>
@foreach($SelectedSellingUnits as $SelectedSellingUnit)
    <option contentUni="{{@$SelectedSellingUnit['name']}}" value="{{$SelectedSellingUnit['id']}}">{{@$SelectedSellingUnit['name']}}</option>
@endforeach
