@extends('frontend.layout.layout')
@section('title','Submitted Offers')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javavscript:;">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Designers</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Submitted Offers</li>
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
                            <div class="fltr_topp d-flex align-items-center">
                                <div class="section-heading">
                                    <h2>Submitted Offers</h2>
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
                                                    <!-- <img src="https://pbs.twimg.com/profile_images/534970730673225728/3nFbT0Mi.jpeg" class="img-fluid"> -->
                                                </div>
                                                <div class="dsgnr_dtl">
                                                    <div class="top_meta_dsgnr d-flex justify-content-between">
                                                        <a href="javascript:;">{{@$reqForProposalAssignToUser['requestForProposalDetail']['request_title']}}</a>
                                                        @if(@$reqForProposalAssignToUser['quotation_price']!=0)
                                                            <h6>Quotation: SR {{@$reqForProposalAssignToUser['quotation_price']}}</h6>
                                                        @endif
                                                    </div>
                                                    <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                        <div class="left_info_dsgnr">
                                                            <p><strong>RFQ ID:</strong> {{@$reqForProposalAssignToUser['project_request_no']}}</p>
                                                            <p><strong>Contact Name:</strong> {{ucfirst(@$reqForProposalAssignToUser['userDetail']['contact_name'])}}</p>
                                                            <p><strong>Contact Number:</strong> {{ucfirst(@$reqForProposalAssignToUser['userDetail']['isd_code'])}} {{ucfirst(@$reqForProposalAssignToUser['userDetail']['mobile_no'])}}</p>
                                                            <p><strong>Email:</strong> {{ucfirst(@$reqForProposalAssignToUser['userDetail']['email'])}}</p>
                                                            <p><strong>Category:</strong> {{@$reqForProposalAssignToUser['userDetail']['userPropertyDetail']['name']}}</p>
                                                            <p><strong>Location:</strong> <a href="" class="cp_loca">{{ucfirst(@$reqForProposalAssignToUser['userDetail']['location'])}}</a></p>
                                                            <p><strong>Experience:</strong> +{{@$reqForProposalAssignToUser['userDetail']['experience']}} (In @if(@$reqForProposalAssignToUser['userDetail']['experience']<=1) Year @else Years @endif)</p>
                                                            <?php //dd($reqForProposalAssignToUser); ?>
                                                            <p><strong>Type of Services:</strong> @foreach($reqForProposalAssignToUser['userDetail']['userSelectedServicesDetail'] as $key1 => $serviceDetail)
                                                                <?php //dd($serviceDetail); ?>
                                                             @if($key1>=1) ,@endif{{$serviceDetail['userServiceDetail']['name']}} @endforeach</p>
                                                        </div>
                                                        <div class="btn_quots d-flex flex-column justify-content-end">
                                                            @if($reqForProposalAssignToUser['provider_status']=='accepted')
                                                                <button class="btn btn_theme acpt_btn">Accepted</button>
                                                            @elseif($reqForProposalAssignToUser['provider_status']=='rejected')
                                                                <button class="btn btn_theme rejc_btn">Rejected</button>
                                                            @endif
                                                            <button data-id="{{base64_encode(@$reqForProposalAssignToUser['id'])}}" class="btn btn_theme delt_btn">Delete</button>
                                                        </div>
                                                    </div>
                                                    <div class="botom_meta_dsgnr text-right">
                                                        <a class="btn btn_theme" href="{{url('/user/reviewProposalRequestDetail/'.base64_encode($reqForProposalAssignToUser['id']))}}"><span>View Document</span></a>
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
                                        <div class="top_meta_dsgnr d-flex justify-content-between">
                                            <a href="designerDetail.php">Alhabtoor Corporates</a>
                                            <h6>Quotation: SR 250,000</h6>
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
                                            <a class="btn btn_theme" href="javascript:;"><span>View Document</span></a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
    $('.dtrange').daterangepicker();
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("body").on('click','.delt_btn',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_req_id = $(this).data('id');
            var ths = $(this);
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
    });
</script>
@stop