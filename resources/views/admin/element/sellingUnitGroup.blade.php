@if(count($sellingGroup)>0)
    <option selected disabled>Select Selling Unit</option>
        @if(isset($sellingGroup) && !empty($sellingGroup))
            @foreach($sellingGroup as $productSelling)
              <option value="{{@$productSelling['id']}}">{{@$productSelling['name']}}</option>
            @endforeach
        @endif
@endif        