    <div class="modal fade upgrade_plans" id="upgrade_plan">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upgrade Plans</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="choose_plan">
                        <div class="subsc_plans">
                            <div class="row">
                                @foreach($updatedSubscriptionRecord as $val)
                                <div class="col-sm-6">
                                    <div class="plan_wrpr text-center">
                                        <input type="hidden" name="id_sub" class="sub_id" value="{{$val
                                        ['id']}}">
                                        <h3 class="text-uppercase titleSubscription">{{$val['title']}}</h3>
                                        <h4 class="pln_val">SR {{$val['price']}}  <small>/{{$val['time_limit']}} {{$val['time_type']}}</small></h4>
                                        <ul type="none" class="pln_bnfts">
                                            <li><i class="fa fa-check"></i>{{$val['description']}}</li>
                                        </ul>
                                         <a href="{{url('provider/payment_subscription_pack_choosen'.'?payment='.base64_encode($val['price']).'&subscriptionId='.base64_encode($val['id']))}}"><button class="btn btn_theme chooseSubscriptionPack" data-id="{{base64_encode($val['id'])}}" data-toggle="modal"><span>Choose</span></button></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
    </div>


    @push('modals-script')

   @endpush
