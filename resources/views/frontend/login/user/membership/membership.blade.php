@extends('frontend.layout.providerLayout')
@section('title','Payment Methods')
@section('content')
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Membership</li>
                    </ol>
                </nav>
            </div>
            
            <section class="membership_dashboard padd_all_sec">
				<div class="container-fluid">
					<div class="row">
						
						  @include('frontend.include.userSidebar')

						<div class="col-sm-9">
							<div class="mainside_wrap">
                                <!--  -->
                                <div class="page_head">
                                    <h4>My Membership</h4>
                                   <!--  <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                                </div>
                                <div class="main_cntnt_dash">
                                    <div class="card membr_prof_dash">
                                        <!--  -->
                                        <div class="cont_shd_frm">
                                            <div class="membrship_wrap">
                                                    <h3>{{$membership->title}}</h3>
                                                    <p>{!! @$membership['description'] !!}</p>

                                                        @foreach($membershipLevel as $key => $value) 
                                                        <?php $imgKey = $key+1; ?> 
                                                        <div class="singl_meber_wrp d-flex">
                                                            <div class="lvl_img">
                                                                <img src="{{asset('public/frontend/imgs/membershipLevels/MM-'.$imgKey.'.png')}}" class="img-fluid">
                                                            </div>
                                                            <div class="achve_requr">
                                                                <h6 class="plan_head">
                                                                    {{$value['title']}} ({{$value['point_from']}}-{{$value['point_to']}} points)</h6>
                                                                <p class="text_dull">{{@$value['description']}}</p>
                                                            </div>
                                                        </div>
                                                       @endforeach
                                                </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <!--  -->
                            </div>
						</div>
					</div>
				</div>
			</section>
        </div>
@stop

@section('script')

@stop