
    <option selected disabled>Select Selling Unit</option>
        @if(isset($allsellingUnitlist) && !empty($allsellingUnitlist))
            @foreach($allsellingUnitlist as $productSelling)
              <option value="{{@$productSelling['id']}}"  @if($productSelling['id'] == $id) selected @endif>{{@$productSelling['name']}}</option>
            @endforeach
        @endif