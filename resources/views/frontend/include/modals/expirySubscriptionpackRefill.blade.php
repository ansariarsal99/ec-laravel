 <div class="modal fade upgrade_plans" id="upgrade_plan">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Choose Subscription Plan</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <?php
                    $subscriptionRecord = App\Subscription::get()->toArray();
                    $userId = Auth::user()->id;
                     // dd($userId);
                 ?>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="choose_plan">
                        <div class="subsc_plans">
                            <div class="row">
                             @foreach($subscriptionRecord as $value)
                                <div class="col-sm-6">
                                    <div class="plan_wrpr text-center">
                                        <input type="hidden" name="id_sub" class="sub_id" value="{{$value['id']}}">
                                        <h3 class="text-uppercase titleSubscription">{{ucfirst($value['title'])}}</h3>
                                        <h4 class="pln_val">SR {{$value['price']}} <small>/{{$value['time_limit']}} {{$value['time_type']}}</small></h4>
                                        <ul type="none" class="pln_bnfts">
                                            <li><i class="fa fa-check"></i> {{$value['description']}}</li>
                                        </ul>
                                        <a href="{{url('provider/payment_subscription_pack_choosen'.'?payment='.base64_encode($value['price']).'&subscriptionId='.base64_encode($value['id']))}}"> <button class="btn btn_theme chooseSubscriptionPack" data-id="{{base64_encode($value['id'])}}" data-toggle="modal"><span>Choose</span></button></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <a href="{{ url('/logout') }}">
                        <button type="button" class="btn btn-danger" >Logout</button>
                    </a>
                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                </div>
            </div>
          </div>
       
    </div>

@push('modals-script')

@endpush