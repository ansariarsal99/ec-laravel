@if(isset($providers) && sizeof($providers)>0)
    @foreach($providers as $key => $provider)
        @if(!empty($provider))
            <li>
                <div class="user_list d-flex justify-content-between align-items-center">
                    <div class="list_info d-flex align-items-center">
                        <figure class="m-0">
                            <!-- <img src="{{asset('public/frontend/img/client3.jpg')}}" class="img-fluid"> -->
                            @if(!empty($provider->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.$provider->profile_image)))
                                <img alt="" src="{{asset('public/frontend/imgs/userProfile/'.$provider->profile_image)}}" class="img-fluid">
                            @else
                                <img alt="" src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                            @endif
                        </figure>
                        <h3 class="ml-3">{{ucfirst(@$provider['contact_name'])}}</h3>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="{{@$provider['id']}}" class="custom-control-input" id="customCheck{{$key}}" name="provider_ids[]">
                        <label class="custom-control-label" for="customCheck{{$key}}"></label>
                      </div>
                </div>
            </li>
        @endif
    @endforeach
@endif