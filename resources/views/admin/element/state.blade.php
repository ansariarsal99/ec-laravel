
 <option selected disabled>Select State Name</option>
    @if(isset($States) && !empty($States))
        @foreach($States as $state)
          <option value="{{@$state['id']}}" @if($state['id'] == $statesId['id']) selected @endif>{{@$state['name']}}</option>
        @endforeach
    @endif