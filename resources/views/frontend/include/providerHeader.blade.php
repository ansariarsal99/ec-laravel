<?php
    if (Auth::check()) {
        if(!empty(Auth::user()->profile_image) && file_exists(userProfileImageBasePath.'/'.Auth::user()->profile_image)){
            $image = userProfileImagePath.'/'.Auth::user()->profile_image;            
        }else{
            $image = defaultImagePath.'/no_image.png';            
        }
    }else{
        $image = defaultImagePath.'/no_image.png';
    }  
?>
<header class="header_home">
    <div class="top-header">
        <div class="custom_container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-sm-3">
                    <div class="top-header-left text-left d-flex">
                        <span>Download App</span>
                        <ul type="none" class="d-flex">
                            <li><a><i class="fa fa-apple"></i></a></li>
                            <li><a><i class="fa fa-android"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-sm-9">
                    <div class="top-header-right text-right">
                        <div class="top-menu-block">
                            <ul type="none" class="d-flex justify-content-end">
                                <li><a href="javascript:;">About us</a></li>
                                <li><a href="{{url('/provider/signUp')}}">Become a Service Provider</a></li>
                                <li><a href="javascript:;">Reviews</a></li>
                                <li><a href="javascript:;">FAQs</a></li>
                                <li><a href="javascript:;">Contact Us</a></li>
                                <li><a href="javascript:;">Language</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout-header2">
        <div class="custom_container">
            <div class="">
                <div class="main-menu-block d-flex align-items-center justify-content-between">
                    <div class="logo-block">
                        <a href="{{url('/')}}"><img src="{{asset('public/frontend/img/logo.png')}}" class="img-fluid  " alt="logo"></a>
                    </div>
                    <div class="input-block">
                        <div class="input-box">
                            <form class="big-deal-form">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="search"><i class="fa fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search a Product">
                                    <div class="input-group-prepend">
                                        <select class="custom-select">
                                            <option>All Category</option>
                                            <option>indurstrial</option>
                                            <option>sports</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="cart-block d-flex">
                        <div class="cart-item">
                            <ul type="none" class="d-flex text-center">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-shopping-cart"></i><br>
                                        <span>Cart</span>                                    
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-heart"></i><br>
                                        <span>Wishlist</span>                                        
                                    </a>
                                </li>
                                @if(Auth::check())
                                    <li class="cstm_menu">
                                        <a href="javascript:;" class="">
                                            @if(Auth::check() && !empty(Auth::user()->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                                                <img src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="img-fluid">
                                            @else
                                                <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                                            @endif
                                            <!-- <i class="fa fa-user"></i><br />
                                            @if(Auth::check())
                                                <span>{{ucfirst(Auth::user()->contact_name)}} {{ucfirst(Auth::user()->contact_last_name)}}</span>
                                            @endif -->
                                        </a>
                                        <!-- <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{url('/user/profile')}}"><i class="fa fa-user"></i> Profile</a>
                                            <a href="{{url('/user/locations')}}" class="dropdown-item"><i class="fa fa-map-marker"></i> My Locations </a>
                                            <a href="{{url('/user/paymentMethods')}}" class="dropdown-item"><i class="fa fa-credit-card"></i> Payment Methods </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-id-card"></i> My Membership </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-gift"></i> My Rewards </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-heart"></i> My Wishlist </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-shopping-cart"></i> My Cart </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-list-alt"></i> My Orders </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-comments-o"></i> My Messages </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-file-text-o"></i> My Quotations </a>
                                            <a href="javascript:;" class="dropdown-item"><i class="fa fa-bullhorn"></i> My Advertisements </a>
                                            <a class="dropdown-item" href="{{url('/logout')}}"><i class="fa fa-power-off"></i> Sign Out</a>
                                        </div> -->
                                    </li>
                                @else
                                    <li>
                                        <a href="{{url('/login')}}">
                                            <i class="fa fa-user"></i><br>
                                            <span>Login</span>                                        
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="category-header-2">
        <div class="custom_container">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="javascript:;">Building Materials</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  data-toggle="dropdown" href="javascript:;">Designers</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{url('/designer/list')}}">Find Designers</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  data-toggle="dropdown" href="javascript:;">Contractors</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{url('/contractor/list')}}">Find Contractors</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  data-toggle="dropdown" href="javascript:;">Consultants</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{url('/consultant/list')}}">Find Consultants</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  data-toggle="dropdown" href="javascript:;">Sellers</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{url('/seller/list')}}">Find Sellers</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/provider/deliverWithUs')}}">Deliver With Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;">Advertise With Us</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>

