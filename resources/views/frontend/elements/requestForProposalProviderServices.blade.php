@if(isset($providerServices) && sizeof($providerServices)>0)
    @foreach($providerServices as $key => $providerService)
        @if(!empty($providerService))
            <option @if(in_array($providerService['id'],$reqForProposalServiceIds)) selected="" @endif value="{{@$providerService['id']}}">{{@$providerService['name']}}</option>
        @endif
    @endforeach
@endif