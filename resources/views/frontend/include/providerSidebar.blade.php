<aside class="seller_side_nav">
    <div class="top_selr_info text-center">
        @if(Auth::check())
            @if(!empty(Auth::user()->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                <img src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="img-fluid">
            @else
                <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
            @endif
            <?php $propertyType = App\UserProperty::where('id',Auth::user()->user_property_id)->value('type');
                    // dd($propertyType); ?>
            <div class="com_name text-center">
                <h3 class="wel_txt">Hi,</h3>
                @if($propertyType=='company')
                    <h3 class="com_txt">{{ucfirst(Auth::user()->company_name)}}</h3>
                @else
                    <h3 class="com_txt">{{ucfirst(Auth::user()->contact_name)}} {{ucfirst(Auth::user()->contact_last_name)}}</h3>
                @endif
            </div>
        @endif
        <!-- <img src="{{asset('public/frontend/img/client3.jpg')}}" class="img-fluid"> -->
        <div class="d-flex justify-content-around below_icon">
            <span class="icon_short"><i data-toggle="tooltip" data-placement="top"  title="Settings" class="fa fa-cogs"></i></span>
            <a href="{{url('/provider/notifications')}}">
                <span class="icon_short"><i data-toggle="tooltip" data-placement="top"  title="Notifications" class="fa fa-bell"></i></span>
            </a>
            <a href="{{url('/logout')}}">
                <span class="icon_short"><i data-toggle="tooltip" data-placement="top"  title="Sign Out" class="fa fa-power-off"></i></span>         
            </a>
        </div>
    </div>
    <div class="list_sid_nav">
        <ul type="none">
            <li class="has_child_li">
                <a href="javascript:;" class="drop_ul pos_rel active"><!-- <span><i class="fa fa-user"></i></span> --> My Profile <i class="fa fa-angle-right arrow"></i>
                </a>
                <ul class="child_ul">
                    <li><a href="{{url('/provider/profile')}}">Personal Information</a></li>
                    <!-- <li><a href="{{url('/provider/storeLocations')}}">Address</a></li> -->
                    <li><a href="{{url('/provider/changePassword')}}">Password</a></li>
                </ul>
            </li>
            <li><a href="{{url('/provider/storeLocations')}}" class=""><span><i class="fa fa-map-marker"></i></span> My Locations</a></li>
            <li><a href="{{url('/provider/paymentMethods')}}" class=""><span><i class="fa fa-money"></i></span> Payment Methods</a></li>
           <li>
                <a href="{{url('/provider/myMembership')}}" class=""><span><i class="fa fa-id-card"></i></span> My Membership
                </a>

            </li>
            <li><a href="javascript:;" class=""><span><i class="fa fa-gift"></i></span> My Rewards points</a></li>
             <li><a href="{{url('/provider/subscription-pack')}}" class=""><span><i class="fa fa-user"></i></span> My Subscriptions</a></li>
            <li><a href="{{url('/provider/advertisemnt/list')}}" class=""><span><i class="fa fa-bullhorn"></i></span> My Advertisements</a></li>

            @if(\Auth::user()->user_type_id == '6')
                <li class="has_child_li">
                    <a href="javascript:;" class="drop_ul pos_rel">Products <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child_ul">
                        <li><a href="{{url('provider/products/list')}}">Item List</a></li>
                        <li><a href="{{url('provider/products/add')}}">Add Item</a></li>
                    </ul>
                </li>
            @endif

            @if(\Auth::user()->user_type_id == '6')
                <li class="has_child_li">
                    <a href="javascript:;" class="drop_ul pos_rel">Service <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child_ul">
                        <li><a href="{{url('provider/services/list')}}">Service List</a></li>
                        <li><a href="{{url('provider/services/add')}}">Add Service</a></li>
                    </ul>
                </li>
            @endif
            
            <li>
                <a href="javascript:;" class="drop_ul pos_rel">Terms & Conditions <i class="fa fa-angle-right arrow"></i></a>
                <ul class="child_ul">
                   <li><a href="{{url('/provider/chooseDeliveryOption')}}">Choose Delivery Option</a></li>
                   <li><a href="{{url('/provider/TermsOfPayment')}}">Assign Terms of Payment</a></li>
                   <li><a href="{{url('/provider/delveryterms/list')}}">Delivery Terms & Condtions</a></li>
                </ul>
            </li>
            @if(\Auth::user()->user_type_id == '6')
                <li class="has_child_li">
                    <a href="javascript:;" class="drop_ul pos_rel">Order Management <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child_ul">
                        
                        <li><a href="{{url('/provider/productCancellationRequest/list')}}">Product Cancellation Requests</a></li>
                        <li><a href="{{url('/provider/orderProduct/list')}}">Order List</a></li>

                       <li><a href="{{url('/provider/refund/Order/list')}}">Refund Management</a></li>
                        <li><a href="sellerdbOngoingOrders.php">Tracking Ongoing Orders</a></li>
                        <li><a href="{{url('/provider/closed/Order/list')}}">Closed Orders</a></li>
                        <li><a href="{{url('/provider/complete/refund/Order/list')}}">Refunded Orders</a></li>
                        <li><a href="{{url('/provider/cancelled/Order/list')}}">Cancelled Orders</a></li>
                        <li><a href="sellerdbManageDelivery.php">Manage Delivery</a></li>
                    </ul>
                </li>
            @else
                <li class="has_child_li">
                    <a href="javascript:;" class="drop_ul pos_rel">Order Management <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child_ul">
                        <!-- <li><a href="{{url('/provider/quotations')}}">RFP Management</a></li>
                        <li><a href="{{url('/provider/trackRFPRequest')}}">Track RFP</a></li> -->
                        <li><a href="{{url('/provider/quotations')}}">Request For Proposals (RFP)</a></li>
                        <li><a href="{{url('/provider/trackRFPRequest')}}">Purchase Orders (PO)</a></li>
                    </ul>
                </li>
            @endif
            <li class="has_child_li">
                <a href="javascript:;" class="drop_ul pos_rel">Reports <i class="fa fa-angle-right arrow"></i></a>
                <ul class="child_ul">
                    <li><a href="{{url('/provider/earning/list')}}">Earning Management</a></li>
                    <li><a href="sellerdbEarningManagementPendingFromAdmin.php">Pending from Admin</a></li>
                    <li><a href="sellerdbEarningManagement.php">Pending to Admin</a></li>
                </ul>
            </li>
            <li><a href="{{url('/provider/trackInqueries')}}" class=""><span><i class="fa fa-pencil"></i></span> Inqueries</a></li>

            <li><a href="{{url('/provider/discountCode/list')}}" class=""><span><i class="fa fa-percent" aria-hidden="true"></i></span> Discount Codes</a></li>
            <li><a href="{{url('/provider/deliveryPerson/list')}}" class=""><span><i class="fa fa-list" aria-hidden="true"></i></span> Delivery Person List</a></li>
            <li><a href="{{url('/provider/buildMartFees')}}" class=""><span><i class="fa fa-money" aria-hidden="true"></i></span> Build Mart Fees</a></li>
            
            <li><a href="{{url('/provider/messages')}}" class=""><span><i class="fa fa-commenting"></i></span> Messages</a></li>
            <li><a href="{{url('/logout')}}" class=""><span><i class="fa fa-power-off"></i></span> Sign Out</a></li>
        </ul>
    </div>
</aside>