@extends('frontend.layout.providerLayout')
@section('title','Notifications')
@section('content')
<style>
    /*.not_persn figure{
        position: absolute;
    }
    .not_persn img{
        width: 70px;
        height: 70px;
        border-radius: 100%;
        border: 1px dotted #b7b7b7;
        padding: 3px;
    }
    .persn_info {
        padding-left: 87px;
    }
    .persn_info h3{
        font-size: 20px;
    }
    .persn_info small{
        color: #a8a8a8;
    }
    .persn_info p{
        color: #5b5959;
        font-size: 14px;
        margin-top: 5px;
    }
    .not_list li{
        border-bottom: 1px dotted #c1c1c1;
        margin-bottom: 16px;
    }*/
    /*============No notification css=======*/
    /*.no_not img{
        width: 210px;
    }
    .no_not_wrap h4{
        text-align: center;
        color: #8e8e8e;
        font-size: 25px;
    }
    .notify_req_title{
        color: #cc3f2f;
        font-weight: 500;
        text-decoration: underline;
    }*/
    /*============No notification css=======*/
</style>
    <section class="outer_db_wraper db_seller_items_list">
        <div class="combine_side_main_slr_db d-flex">
            <div class="sidenav_seller_db">
                @include('frontend.include.providerSidebar')
            </div>
            <div class="main_seller_db item_list_seller_db">
                <section class="bread_top_sec">
                    <div class="db_container">
                        <div class="d-flex justify-content-between text-white pos_rel">
                            <div class="sid_controlr">
                                <i class="clos_sid fa fa-bars"></i>
                                <i class="opn_sid fa fa-times"></i>
                            </div>
                            <h3>Notifications</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Notifications</a></li>
                                    <!-- <li class="breadcrumb-item active">Item List</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </section>
                <div class="marg_over_bread">
                    <section class="item_list_sec p-0">
                        <div class="db_container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
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
                    </section>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')

@stop