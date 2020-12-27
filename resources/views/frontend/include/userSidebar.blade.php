<div class="col-sm-3">
    <aside class="side_db">
        <div class="card widget_one">
            <div class="card-block">
                <div class="inner">
                    <div class="widget_avatar text-left">
                        @if(Auth::check() && !empty(Auth::user()->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                            <img alt="" src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="img-responsive">
                        @else
                            <img alt="" src="{{asset('public/frontend/img/no_image.png')}}" class="img-responsive">
                        @endif
                        <div class="meta_pro">
                            @if(Auth::user()->user_type_id==2)
                                <h5> {{@ucfirst(Auth::user()->institution_name)}}</h5>
                                <p class="cot_nam m-0"> {{@ucfirst(Auth::user()->first_name)}} {{@ucfirst(Auth::user()->last_name)}}</p>
                            @else
                                <h5> {{@ucfirst(Auth::user()->first_name)}} {{@ucfirst(Auth::user()->last_name)}}</h5>
                            @endif
                            <a href="{{url('/logout')}}" >Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card widget_two">
            <ul class="social_side_opt" type="none">
                <li class="@if($page=='myProfile') active @endif"><a href="{{url('/user/profile')}}"><i class="fa fa-user"></i> My Profile </a></li>
                <li class="@if($page=='myLocations') active @endif"><a href="{{url('/user/locations')}}"><i class="fa fa-map-marker"></i> My Locations </a></li>
                <li class="@if($page=='paymentMethods') active @endif"><a href="{{url('/user/paymentMethods')}}"><i class="fa fa-credit-card"></i> Payment Methods </a></li>
                  <li><a href="{{url('/user/myMembership')}}"><i class="fa fa-id-card"></i> My Membership </a></li>
                <li><a href="javascript:;"><i class="fa fa-gift"></i> My Rewards </a></li>
                <li><a href="{{url('user/advertisemnt/list')}}"><i class="fa fa-bullhorn"></i> My Advertisements </a></li>
                <!-- <li><a href="javascript:;"><i class="fa fa-heart"></i> My Wishlist </a></li>
                <li><a href="javascript:;"><i class="fa fa-shopping-cart"></i> My Cart </a></li>
                <li><a href="javascript:;"><i class="fa fa-list-alt"></i> My Orders </a></li> -->
                <li class="has_child_li">
                    <a href="javascript:;" class="user_drop_ul pos_rel active"> Manage My Orders <i class="fa fa-angle-right arrow"></i>
                    </a>
                    <ul class="child_ul">
                        <li class="inr_has_li">
                            <a href="javascript:;" class="sub_drop_ul pos_rel">Services <i class="fa fa-angle-right new_arrow"></i></a>
                            <ul class="sub_child">
                                <li><a href="{{url('user/myRequests')}}">My Requests</a></li>
                                <li class="border-bottom-0"><a href="javascript:;">My Purchase Orders</a></li>
                            </ul>
                        </li>
                        <li class="inr_has_li border-bottom-0">
                            <a href="javascript:;" class="sub_drop_ul pos_rel">Products <i class="fa fa-angle-right new_arrow"></i></a>
                            <ul class="sub_child">
                                <li><a href="{{url('/user/mycart')}}">My Cart</a></li>
                                <li><a href="{{url('/provider/wishlist/Listing')}}">My Wishlist</a></li>
                                <li class="border-bottom-0"><a href="{{url('/user/product/myOrders')}}">My Orders</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="{{url('/user/messages')}}"><i class="fa fa-comments-o"></i> My Messages </a></li>
                <li class="@if($page=='notifications') active @endif"><a href="{{url('/user/notifications')}}"><i class="fa fa-bell"></i> Notifications </a></li>
                <!-- <li><a href="{{url('user/quotations')}}"><i class="fa fa-file-text-o"></i> My Quotations </a></li> -->
                <li><a href="{{url('/logout')}}"><i class="fa fa-power-off"></i> Sign Out </a></li>
            </ul>
        </div>
    </aside>
</div>