<?php
  $auth_type = Auth::guard('admin')->user()['type'];
  // dd($page);
?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="start"><a href="{{url('admin/dashboard')}}" class="app-menu__item @if($page == 'dashboard') active @endif"><i class="menu-icon fa fa-laptop"></i>Dashboard </a></li>
                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'countries' || $page == 'states' || $page == 'cities') is-expanded active @endif"><a href="#"  data-toggle="dropdown" class=" dropdown-toggle" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-table"></i>General Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- @if($page == 'countries' || $page == 'states' || $page == 'cities') is-expanded active show @endif -->
                            @if($auth_type == 'admin')
                            <li><a href="{{url('admin/generalManagement/countries/list')}}" class="start @if($page == 'countries') active @endif">Countries<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                            @if($auth_type == 'admin')
                            <li><a href="{{url('admin/generalManagement/states/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'states') active @endif">States<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                            @if($auth_type == 'admin')
                            <li><a href="{{url('admin/generalManagement/cities/list')}}"  class="menu-item-has-children dropdown-toggle @if($page == 'cities') active @endif">Cities<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'category'||$page == 'sub_category'||$page == 'sell_Material'||$page == 'color'||$page == 'selling_unit'||$page == 'brand'||$page == 'grade'||$page == 'product-unit') is-expanded active @endif"><a href="#"  data-toggle="dropdown" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-product-hunt"></i>Product Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/category/list')}}" class="start @if($page == 'category') active @endif">Categories<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/subcategory/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'sub_category') active @endif">Sub Categories<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/sellingMaterial/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'sell_Material') active @endif">Selling Material<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/color/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'color') active @endif">Colors<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            <!-- @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/sellingUnitGroupList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'sellingUnitGroup') active @endif">Selling Unit Groups<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/sellingUnit/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'selling_unit') active @endif">Selling Units<i class="icon fa fa-circle-o"></i></a></li>
                            @endif   -->
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/sellingUnitList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'sellingUnit') active @endif">Selling Units<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/brand/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'brand') active @endif">Brands<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/productManagement/grade/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'grade') active @endif">Grades<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            <!-- @if($auth_type == 'admin')
                            <li><a href="{{url('admin/productUnitList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'product-unit') active @endif">Product Unit<i class="icon fa fa-circle-o"></i></a></li>
                            @endif -->
                        </ul>
                    </li>
                @endif
                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'allUser'||$page == 'individual'||$page == 'institution'||$page == 'designer'||$page == 'contractor'||$page == 'consultant'||$page == 'seller') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-building"></i>User Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- @if($page == 'terms') is-expanded active show @endif -->
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/all/userList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'allUser') active @endif">All<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/user/userList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'individual') active @endif">Individual<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/user/Institution/userList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'institution') active @endif">Institution<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/user/designer/designerList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'designer') active @endif">Designers<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/provider/contractorList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'contractor') active @endif">Contractors<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/provider/consultantList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'consultant') active @endif">Consultants<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/provider/sellerList')}}" class="menu-item-has-children dropdown-toggle @if($page == 'seller') active @endif">Sellers<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'reward'||$page == 'categoryReward'||$page == 'productReward'||$page == 'pointPrice') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-trophy"></i>Reward Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- @if($page == 'terms') is-expanded active show @endif -->
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/rewardPointManagement/reward/point/List')}}" class="menu-item-has-children dropdown-toggle @if($page == 'reward') active @endif">Order Reward Points<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/rewardPointManagement/categoryReward/point/List')}}" class="menu-item-has-children dropdown-toggle @if($page == 'categoryReward') active @endif">Category Reward Points<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/rewardPointManagement/productReward/point/List')}}" class="menu-item-has-children dropdown-toggle @if($page == 'productReward') active @endif">Product Reward Points<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/rewardPointManagement/priceReward/point')}}" class="menu-item-has-children dropdown-toggle @if($page == 'pointPrice') active @endif"> Reward Points Prices<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'order-refund') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-cogs"></i>Order Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- @if($page == 'terms') is-expanded active show @endif -->
                            @if($auth_type == 'admin')
                            <li><a href="{{url('admin/refundApproval/List')}}" class="menu-item-has-children dropdown-toggle @if($page == 'order-refund') active @endif">Refund Approval<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                        </ul>
                    </li>
                @endif


                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'membership'||$page == 'membership-level') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-user-plus" aria-hidden="true"></i>Membership</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- @if($page == 'terms') is-expanded active show @endif -->
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/membership/membershipContent')}}" class="menu-item-has-children dropdown-toggle @if($page == 'membership') active @endif">Membership Content<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/membership/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'membership-level') active @endif">Membership Levels<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'footer') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-cogs"></i>Footer Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- @if($page == 'terms') is-expanded active show @endif -->
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/footer/detail')}}" class="menu-item-has-children dropdown-toggle @if($page == 'footer') active @endif">Build Mart Contact Detail<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'terms'||$page == 'deliveryPolicy') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-cogs"></i>Content Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- @if($page == 'terms') is-expanded active show @endif -->
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/contentManagement/termAndCondtion')}}" class="menu-item-has-children dropdown-toggle @if($page == 'terms') active @endif">Terms & Condtions<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/contentManagement/deliveryPolicy')}}" class="menu-item-has-children dropdown-toggle @if($page == 'deliveryPolicy') active @endif">Delivery & Policy<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/contentManagement/Career')}}" class="menu-item-has-children dropdown-toggle @if($page == 'Career') active @endif">Career<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/contentManagement/ReturnAndExchangePolicy')}}" class="menu-item-has-children dropdown-toggle @if($page == 'ReturnAndExchangePolicy') active @endif">Return & Exchange Policy<i class="icon fa fa-circle-o"></i></a></li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if($auth_type == 'admin')
                    <li class="menu-item-has-children"><a href="{{url('admin/subscriptionManagement/subscribeList')}}" class="dropdown-toggle  @if($page == 'subscription') is-expanded active @endif"><i class="menu-icon fa fa-user-circle-o"></i>Subscription Package</a>
                    </li>
                @endif
                @if($auth_type == 'admin')
                    <li class="menu-item-has-children"><a href="{{url('admin/user/cashTransfer/userList')}}" class="dropdown-toggle  @if($page == 'cashTransfer') is-expanded active @endif"><i class="menu-icon fa fa-money"></i>Subscription Payment</a>
                    </li>
                @endif
                @if($auth_type == 'admin')
                   <li class="menu-item-has-children"><a href="{{url('admin/update/WireTransferDetail')}}" class="dropdown-toggle  @if($page == 'wireTransfer') is-expanded active @endif"><i class="menu-icon fa fa-user-circle-o"></i>Wire- Transfer Detail</a>
                   </li>
                @endif
                @if($auth_type == 'admin')
                   <li class="menu-item-has-children"><a href="{{url('admin/taxManagement/ProductTax/add')}}" class="dropdown-toggle  @if($page == 'tax') is-expanded active @endif"><i class="menu-icon fa fa-user-circle-o"></i>Tax Management</a>
                   </li>
                @endif
                @if($auth_type == 'admin')
                   <!-- <li class="menu-item-has-children"><a href="{{url('admin/buildaMart/addBuildMartFees')}}" class="dropdown-toggle  @if($page == 'build_mart_fees') is-expanded active @endif"><i class="menu-icon fa fa-money"></i>Build Mart Fees Section</a>
                   </li> -->
                   <li class="menu-item-has-children dropdown @if($page == 'designers'||$page == 'contractors'||$page == 'consultants'||$page == 'sellers') is-expanded active @endif"><a href="javascript:;" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-credit-card"></i>Build Mart Fees Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/buildMartFees/designers')}}" class="menu-item-has-children dropdown-toggle @if($page == 'designers') active @endif">Designers<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/buildMartFees/contractors')}}" class="menu-item-has-children dropdown-toggle @if($page == 'contractors') active @endif">Contractors<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/buildMartFees/consultants')}}" class="menu-item-has-children dropdown-toggle @if($page == 'consultants') active @endif">Consultants<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/buildMartFees/sellers')}}" class="menu-item-has-children dropdown-toggle @if($page == 'sellers') active @endif">Sellers<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                        </ul>
                    </li>
                @endif


                @if($auth_type == 'admin')
                   <li class="menu-item-has-children dropdown @if($page == 'admin-earning') is-expanded active @endif"><a href="javascript:;" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-credit-card"></i>Earning Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            @if($auth_type == 'admin')
                                <li><a href="{{url('admin/adminearning/list')}}" class="menu-item-has-children dropdown-toggle @if($page == 'admin-earning') active @endif">Admin Earning<i class="icon fa fa-circle-o"></i></a></li>
                            @endif
                        </ul>
                    </li>
                @endif


                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'messages') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-users"></i>Chat Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{url('admin/chatManagement/messages')}}" class="menu-item-has-children dropdown-toggle @if($page == 'messages') active @endif">Messages<i class="icon fa fa-circle-o"></i></a></li>
                        </ul>
                    </li>
                @endif

                @if($auth_type == 'admin')
                    <li class="menu-item-has-children dropdown @if($page == 'permissions') is-expanded active @endif"><a href="#" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="menu-icon fa fa-users"></i>Permissions</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{url('admin/permissions/roles')}}" class="menu-item-has-children dropdown-toggle @if($page == 'roles') active @endif">Roles<i class="icon fa fa-circle-o"></i></a></li>
                            <li><a href="{{url('admin/permissions/permissions')}}" class="menu-item-has-children dropdown-toggle @if($page == 'permissions') active @endif">Permissions<i class="icon fa fa-circle-o"></i></a></li>
                            <li><a href="{{url('admin/permissions/admins')}}" class="menu-item-has-children dropdown-toggle @if($page == 'admins') active @endif">Admins<i class="icon fa fa-circle-o"></i></a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
