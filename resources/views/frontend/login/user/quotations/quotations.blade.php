@extends('frontend.layout.layout')
@section('title','Quotation List')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quotation List</li>
            </ol>
        </nav>
    </div>
    <section class="quot_page_sec">
        <div class="custom_container">
            <div class="wrp_quot_lst">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="filtr_left designr_fltrs">
                            <fieldset>
                                <h5>Filter Your Search</h5>
                                <div class="fltrs_accordn">
                                    <div id="accordion">
                                        <div class="card-header">
                                            <a class="collapsed card-link">Search By Name</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="meta_fltr pos_rel">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Search by Name">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                By Service Provider
                                              </a>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="meta_fltr">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                            <label class="custom-control-label" for="customCheck4">Designer</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                            <label class="custom-control-label" for="customCheck5">Contractor</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                            <label class="custom-control-label" for="customCheck5">Consultants</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                            <label class="custom-control-label" for="customCheck5">Sellers</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
                                                By Date
                                              </a>
                                            </div>
                                            <div id="collapse3" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="meta_fltr">
                                                        <label>Choose Date Range</label>
                                                        <input type="text" name="daterange" class="form-control dtrange" value="01/01/2018 - 01/15/2018" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                              <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                By Service Category
                                              </a>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="meta_fltr">
                                                        <div class="prnt_child_chk">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                <label class="custom-control-label" for="customCheck">Design Category</label>
                                                            </div>
                                                            <ul class="child_chk" type="none">
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                        <label class="custom-control-label" for="heck1">Architectural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                        <label class="custom-control-label" for="heck2">Structural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                        <label class="custom-control-label" for="heck3">Electrical Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                        <label class="custom-control-label" for="heck4">Mechanical design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck5" name="example1">
                                                                        <label class="custom-control-label" for="heck5">Interior design</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="prnt_child_chk">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
                                                                <label class="custom-control-label" for="customCheck1">Contractor Category</label>
                                                            </div>
                                                            <ul class="child_chk" type="none">
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                        <label class="custom-control-label" for="heck1">Architectural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                        <label class="custom-control-label" for="heck2">Structural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                        <label class="custom-control-label" for="heck3">Electrical Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                        <label class="custom-control-label" for="heck4">Mechanical design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck5" name="example1">
                                                                        <label class="custom-control-label" for="heck5">Interior design</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="prnt_child_chk">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck2" name="example1">
                                                                <label class="custom-control-label" for="customCheck2">Consultant Category</label>
                                                            </div>
                                                            <ul class="child_chk" type="none">
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                        <label class="custom-control-label" for="heck1">Architectural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                        <label class="custom-control-label" for="heck2">Structural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                        <label class="custom-control-label" for="heck3">Electrical Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                        <label class="custom-control-label" for="heck4">Mechanical design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck5" name="example1">
                                                                        <label class="custom-control-label" for="heck5">Interior design</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="prnt_child_chk">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="example1">
                                                                <label class="custom-control-label" for="customCheck3">Seller Category</label>
                                                            </div>
                                                            <ul class="child_chk" type="none">
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                        <label class="custom-control-label" for="heck1">Architectural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                        <label class="custom-control-label" for="heck2">Structural Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                        <label class="custom-control-label" for="heck3">Electrical Design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                        <label class="custom-control-label" for="heck4">Mechanical design</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="heck5" name="example1">
                                                                        <label class="custom-control-label" for="heck5">Interior design</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="quot_main_rgt">
                            <div class="fltr_topp d-flex align-items-center justify-content-between">
                                <div class="section-heading">
                                    <span>Review Quotation</span>
                                    <h2>My Quotations</h2>
                                </div>
                                <a class="btn btn_theme" href="{{url('/user/trackAllRFP')}}"><span>Track All Quotations</span></a>
                            </div>
                            <div class="fltr_topp d-flex justify-content-end align-items-center">
                                <div class="dropdown">
                                    <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-sort"></i>&nbsp;Sort
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- <a class="dropdown-item" href="#">Suggested</a> -->
                                        <a class="dropdown-item" href="javascript:;">Customer Rating</a>
                                        <a class="dropdown-item" href="javascript:;">Experience</a>
                                        <!-- <a class="dropdown-item" href="#">Location</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="wrap_quot_main">
                                @if(isset($reqForProposalAssignToUsers) && sizeof($reqForProposalAssignToUsers)>0)
                                    @foreach($reqForProposalAssignToUsers as $key => $reqForProposalAssignToUser)
                                        @if(!empty($reqForProposalAssignToUser))
                                            <div class="single_list_desgnr d-flex">
                                                <div class="dsgnr_img">
                                                    @if(!empty($reqForProposalAssignToUser['user_detail']['profile_image']) && file_exists(public_path('frontend/imgs/userProfile/'.$reqForProposalAssignToUser['user_detail']['profile_image'])))
                                                        <img src="{{asset('public/frontend/imgs/userProfile/'.$reqForProposalAssignToUser['user_detail']['profile_image'])}}" class="img-fluid">
                                                    @else
                                                        <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid">
                                                    @endif
                                                    <!-- <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img-fluid"> -->
                                                </div>
                                                <div class="dsgnr_dtl">
                                                    <div class="top_meta_dsgnr d-flex justify-content-between align-items-center">
                                                        <a href="designerDetail.php">{{@$reqForProposalAssignToUser['requestForProposalDetail']['request_title']}}</a>
                                                        <div class="text-right">
                                                            @if(@$reqForProposalAssignToUser['quotation_price']!=0)
                                                                <h6>Quotation: SR {{@$reqForProposalAssignToUser['quotation_price']}}</h6>
                                                            @endif
                                                            <span class="text-success">Proposal Submitted</span>
                                                        </div>
                                                    </div>
                                                    <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                        <div class="left_info_dsgnr">
                                                            <p><strong>RFQ ID:</strong> {{@$reqForProposalAssignToUser['project_request_no']}}</p>
                                                            <p><strong>Contact Name:</strong> {{ucfirst(@$reqForProposalAssignToUser['userDetail']['contact_name'])}}</p>
                                                            <p><strong>Contact Number:</strong> {{ucfirst(@$reqForProposalAssignToUser['userDetail']['isd_code'])}} {{ucfirst(@$reqForProposalAssignToUser['userDetail']['mobile_no'])}}</p>
                                                            <p><strong>Email:</strong> {{ucfirst(@$reqForProposalAssignToUser['userDetail']['email'])}}</p>
                                                            <p><strong>Category:</strong> {{@$reqForProposalAssignToUser['userDetail']['userPropertyDetail']['name']}}</p>
                                                            <p><strong>Location:</strong> <a href="javascript:;" class="cp_loca">{{ucfirst(@$reqForProposalAssignToUser['userDetail']['location'])}}</a></p>
                                                            <p><strong>Experience:</strong> +{{@$reqForProposalAssignToUser['userDetail']['experience']}} (In @if(@$reqForProposalAssignToUser['userDetail']['experience']<=1) Year @else Years @endif)</p>
                                                            <?php //dd($reqForProposalAssignToUser); ?>
                                                            <p><strong>Type of Services:</strong> @foreach($reqForProposalAssignToUser['userDetail']['userSelectedServicesDetail'] as $key1 => $serviceDetail)
                                                                <?php //dd($serviceDetail); ?>
                                                             @if($key1>=1) ,@endif{{$serviceDetail['userServiceDetail']['name']}} @endforeach</p>
                                                        </div>
                                                        <div class="btn_quots d-flex flex-column justify-content-end" data-id="{{base64_encode(@$reqForProposalAssignToUser['id'])}}">
                                                            @if($reqForProposalAssignToUser['provider_status']=='accepted' && $reqForProposalAssignToUser['user_status']=='accepted')
                                                                <button class="btn btn_theme acpt_btn">Accepted</button>
                                                                <button class="btn btn_theme respd_btn">Respond</button>
                                                            @elseif($reqForProposalAssignToUser['user_status']=='rejected') 
                                                                <button class="btn btn_theme rejc_btn">Rejected</button>
                                                            @elseif($reqForProposalAssignToUser['provider_status']=='accepted')
                                                                <button class="btn btn_theme acpt_btn acpt_quot">Accept</button>
                                                                <button class="btn btn_theme rejc_btn rjct_quot">Reject</button>
                                                                <button class="btn btn_theme respd_btn">Respond</button>
                                                            @elseif($reqForProposalAssignToUser['provider_status']=='rejected') 
                                                                <button class="btn btn_theme rejc_btn">Rejected</button>
                                                            @else
                                                                <button class="btn btn_theme respd_btn">Respond</button>
                                                            @endif
                                                            <button class="btn btn_theme delt_btn">Delete</button>
                                                        </div>
                                                    </div>
                                                    <div class="botom_meta_dsgnr text-right">
                                                        <div class="btn-group">
                                                            <a class="btn btn_theme btn-sm" href="{{url('/user/reviewProposalRequestDetail/'.base64_encode($reqForProposalAssignToUser['id']))}}"><span>RFP</span></a>
                                                            <a class="btn btn_theme btn-sm" href="dbMessages.php"><span><i class="fa fa-comments-o"></i></span></a>
                                                            <a class="btn btn_theme btn-sm" href="{{url('/user/proposalHistory/'.base64_encode($reqForProposalAssignToUser['id']))}}"><span>Proposals</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="numbr_pagintn mt-3">
                                    {{ $reqForProposalAssignToUsers->links() }}
                                </div>
                                <!-- <div class="single_list_desgnr d-flex">
                                    <div class="dsgnr_img">
                                        <img src="https://www.habtoor.com/images/AHG-Logo.jpg" class="img-fluid">
                                    </div>
                                    <div class="dsgnr_dtl">
                                        <div class="top_meta_dsgnr d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="designerDetail.php">Alhabtoor Corporates</a><br>
                                                <span class="cntc_nm_compn">Contact Person: Shawn Nelson</span>
                                            </div>
                                            <div class="text-right">
                                                <h6>Quotation: SR 250,000</h6>
                                                <span class="text-success">Proposal Submitted</span>
                                            </div>
                                        </div>
                                        <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                            <div class="left_info_dsgnr">
                                                <p><strong>Contact Number:</strong> +91 95786 65431</p>
                                                <p><strong>Email:</strong> peter_willson@gmail.clm</p>
                                                <p><strong>Category:</strong> Architectural Work</p>
                                                <p><strong>Location:</strong> <a href="" class="cp_loca">13003 Southwest Suite, TX 7747, Dubai</a></p>
                                                <p><strong>Experience:</strong> +4 (In Years)</p>
                                                <p><strong>Service Type:</strong> Wooden Material</p>
                                            </div>
                                            <div class="btn_quots d-flex flex-column justify-content-end">
                                                <button class="btn btn_theme acpt_btn">Accept</button>
                                                <button class="btn btn_theme rejc_btn">Reject</button>
                                                <button class="btn btn_theme delt_btn">Delete</button>
                                            </div>
                                        </div>
                                        <div class="botom_meta_dsgnr text-right">
                                            <div class="btn-group">
                                                <a class="btn btn_theme btn-sm" href="reviewProposalRequest.php"><span>RFP</span></a>
                                                <a class="btn btn_theme btn-sm" href="dbMessages.php"><span><i class="fa fa-comments-o"></i></span></a>
                                                <a class="btn btn_theme btn-sm" href="proposalHistory.php"><span>Proposals</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                            <!-- <div class="pagntns_btm">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                          <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active">
                                          <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                          <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on('click','.delt_btn',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_req_id = $(this).parent().data('id');
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                // alert('here');
                window.location.replace("{{url('/user/requestForProposalDelete')}}"+"/"+enc_req_id);
                // $.ajax({
                //     url:"{{url('user/address/delete')}}"+"/"+enc_address_id,
                //     success:function(resp){
                //         $('.loader').hide();
                //         if (resp.status=='success') {
                //             ths.closest('.user_adrs').remove();
                //             Swal.fire(
                //               'Deleted!',
                //               'Your address has been deleted.',
                //               'success'
                //             )
                //         }else{
                //             swal('Oops, Something went wrong');
                //         }
                //     },
                //     error:function(){
                //         $(".loader").hide();
                //         swal('Oops, Something went wrong');
                //     }
                // });
              }
            })            
        });

        $("body").on('click','.acpt_quot',function(){
            enc_req_id = $(this).parent().data('id');
            // alert(enc_req_id);
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, accept it!'
            }).then((result) => {
              if (result.value) {
                // alert('here');
                window.location.replace("{{url('/user/requestForProposalAccept')}}"+"/"+enc_req_id);
                // $.ajax({
                //     url:"{{url('user/address/delete')}}"+"/"+enc_address_id,
                //     success:function(resp){
                //         $('.loader').hide();
                //         if (resp.status=='success') {
                //             ths.closest('.user_adrs').remove();
                //             Swal.fire(
                //               'Deleted!',
                //               'Your address has been deleted.',
                //               'success'
                //             )
                //         }else{
                //             swal('Oops, Something went wrong');
                //         }
                //     },
                //     error:function(){
                //         $(".loader").hide();
                //         swal('Oops, Something went wrong');
                //     }
                // });
              }
            }) 
        });

        $("body").on('click','.rjct_quot',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            enc_req_id = $(this).parent().data('id');
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, reject it!'
            }).then((result) => {
              if (result.value) {
                // alert('here');
                window.location.replace("{{url('/user/requestForProposalReject')}}"+"/"+enc_req_id);
                // $.ajax({
                //     url:"{{url('user/address/delete')}}"+"/"+enc_address_id,
                //     success:function(resp){
                //         $('.loader').hide();
                //         if (resp.status=='success') {
                //             ths.closest('.user_adrs').remove();
                //             Swal.fire(
                //               'Deleted!',
                //               'Your address has been deleted.',
                //               'success'
                //             )
                //         }else{
                //             swal('Oops, Something went wrong');
                //         }
                //     },
                //     error:function(){
                //         $(".loader").hide();
                //         swal('Oops, Something went wrong');
                //     }
                // });
              }
            })            
        });

    });
</script>
@stop