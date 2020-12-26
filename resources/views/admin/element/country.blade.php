
 <option selected disabled>Select State Name</option>
    @if(isset($states) && !empty($states))
        @foreach($states as $stat)
          <option value="{{@$stat['id']}}">{{@$stat['name']}}</option>
        @endforeach
    @endif