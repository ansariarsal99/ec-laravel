@if(isset($providers) && sizeof($providers)>0)
    @foreach($providers as $key => $provider)
        @if(!empty($provider))
            <tr>
                <td>{{$key+1}}</td>
                <td>{{@ucwords($provider['user_detail']['contact_name'])}}</td>
                <td class="stats_item del_prvdr" data-id="{{base64_encode(@$provider['id'])}}"><a class="text-danger cp">Delete</a></td>
            </tr>
        @endif
    @endforeach
@endif