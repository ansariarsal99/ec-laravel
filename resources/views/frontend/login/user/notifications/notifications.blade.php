@extends('frontend.layout.layout')
@section('title','Notifications')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
            </ol>
        </nav>
    </div>
    
    <section class="prof_dashboard padd_all_sec notfn_list_usr">
        <div class="container-fluid">
            <div class="row">                
                @include('frontend.include.userSidebar')
                <div class="col-sm-9">
                    <div class="mainside_wrap">
                        <div class="page_head">
                            <h4>Notifications</h4>
                            <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                        </div>
                        <div class="main_cntnt_dash">
                            <div class="card">
                                @if(!empty($notifications->total()))
                                    <ul type="none" class="not_list">
                                        @foreach($notifications as $key => $notification)
                                            @if(!empty($notification))                                            
                                                <li>
                                                    <div class="not_persn">
                                                        <figure class="">
                                                            @if(!empty($notification['senderDetail']['profile_image']) && file_exists(public_path('frontend/imgs/userProfile/'.$notification['senderDetail']['profile_image'])))
                                                                <img alt="" src="{{asset('public/frontend/imgs/userProfile/'.$notification['senderDetail']['profile_image'])}}" class="img-fluid">
                                                            @else
                                                                <img alt="" src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                                                            @endif
                                                            <!-- <img src="{{asset('public/frontend/img/client1.jpg')}}" class="img-fluid"> -->
                                                        </figure>
                                                        <div class="persn_info">
                                                            @if($notification['senderDetail']['user_type_id']==1 || $notification['senderDetail']['user_type_id']==2)
                                                                <h3>{{ucfirst($notification['senderDetail']['first_name'])}} {{ucfirst($notification['senderDetail']['last_name'])}}</h3>
                                                            @else
                                                                <h3>{{ucfirst($notification['senderDetail']['contact_name'])}}</h3>
                                                            @endif
                                                            <small><i>{{\Carbon\Carbon::createFromTimeStamp(strtotime(@$notification['created_at']))->diffForHumans()}}</i></small>
                                                            @if($notification['type']=='rfp_sent')
                                                                <p>Sent you Request For Proposal <a class="notify_req_title" href="javascript:;">{{@$notification['requestForProposalDetail']['request_title']}}</a></p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                        <!-- <li>
                                            <div class="not_persn">
                                                <figure>
                                                    <img src="{{asset('public/frontend/img/client1.jpg')}}" class="img-fluid">
                                                </figure>
                                                <div class="persn_info pos_rel">
                                                    <h3>Christina James</h3>
                                                    <small><i>25 min ago</i></small>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="not_persn">
                                                <figure>
                                                    <img src="{{asset('public/frontend/img/client1.jpg')}}" class="img-fluid">
                                                </figure>
                                                <div class="persn_info pos_rel">
                                                    <h3>Christina James</h3>
                                                    <small><i>25 min ago</i></small>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="not_persn">
                                                <figure>
                                                    <img src="{{asset('public/frontend/img/client1.jpg')}}" class="img-fluid">
                                                </figure>
                                                <div class="persn_info pos_rel">
                                                    <h3>Christina James</h3>
                                                    <small><i>25 min ago</i></small>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </li> -->
                                    </ul>
                                    <div class="numbr_pagintn mt-3">
                                        {{ $notifications->links() }}
                                    </div>
                                @else
                                    <div class="no_not_wrap">
                                        <figure class="no_not text-center">
                                            <img src="{{asset('public/frontend/img/no-notification.png')}}" class="img-fluid">
                                        </figure>
                                        <h4>No Notification Yet!</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@stop