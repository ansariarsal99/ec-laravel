@extends('frontend.layout.layout')
@section('title','Request For Proposal')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/intlTelInput.css')}}">
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Request For Proposal</li>
            </ol>
        </nav>
    </div>
    <section class="req_propos_sec">
        <div class="container">
            <div class="section-heading">
                <span>Enter the required Details.</span>
                <h2>Request For Proposal</h2>
            </div>
            <div class="wrp_req_posal">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="progrs_top">
                            <div class="progress">
                                <div class="progress-bar prgrs_bar_stl" style="width:0%"> <span class="prgrs_bar_cls">0%</span></div>
                            </div>
                        </div>
                        <div class="section_stack">
                            <div class="repeted_div fst_div">
                                <div class="wrap_stck_inr">
                                    <p class="outOff"><strong>Step 1 of 9</strong></p>
                                    <h6>What is the name of the client issuing this RFP ?</h6>
                                    <div class="form-group">
                                        <input type="text" readonly="" class="form-control" placeholder="Client Name" name="" value="{{$clientName}}">
                                    </div>
                                    <div class="btn_sav_next d-flex justify-content-end">
                                        <button class="btn btn_theme btn_stk_nex" step="1"><span>Save & Continue</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <p class="outOff"><strong>Step 2 of 9</strong></p>
                                    <div class="seprt_inr">
                                        <h5 class="bndl_h5">What is the Client's Contact Information?</h5>
                                        <div class="form-group">
                                            <input type="text" readonly="" class="form-control" placeholder="Name of Person Represent Client in this RFP" value="{{@$clientName}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" readonly="" class="form-control" placeholder="Contact Number" value="{{@$user['isd_code']}}-{{@$user['mobile_no']}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" readonly="" class="form-control" placeholder="Client’s Email" value="{{@$user['email']}}">
                                        </div>
                                    </div>
                                    <div class="seprt_inr">
                                        <h5 class="bndl_h5">What is the Client’s Address?</h5>
                                        <div class="form-group">
                                            <input type="text" readonly="" class="form-control" placeholder="Street, Building, Office, Floor" value="{{@$clientAddress['address']}}">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" readonly="" class="form-control" placeholder="Province" value="{{@$clientAddress['province_name']}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" readonly="" class="form-control" placeholder="Postal code" value="{{@$clientAddress['postal_code']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" readonly="" class="form-control" placeholder="City" value="{{@$clientAddress['city']}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" readonly="" class="form-control" placeholder="Country" value="{{@$clientAddress['country_detail']['name']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" readonly="" class="form-control" placeholder="Location" value="{{@$clientAddress['location']}}">
                                        </div>
                                        <div class="form-group">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d231315.11879429023!2d54.91364566917369!3d25.05786214558978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f14d60045b819%3A0xd9b8653e942019a9!2sPalm%20Islands%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1593423529009!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>
                                    </div>
                                    <div class="btn_sav_next d-flex justify-content-between">
                                        <span>
                                            <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                            <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                        </span>
                                        <button class="btn btn_theme btn_stk_nex" step="2"><span>Save & Continue</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <p class="outOff"><strong>Step 3 of 9</strong></p>
                                    <h6>Who is being invited to Bid?</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-2">
                                            <thead>
                                                <tr>
                                                    <th>S.N.</th>
                                                    <th>Name of Bidders</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="prvdr_tabl_cls">
                                                @if(isset($providers) && sizeof($providers)>0)
                                                    @foreach($providers as $key => $provider)
                                                        @if(!empty($provider))
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{@ucwords($provider['user_detail']['contact_name'])}}</td>
                                                                <td class="stats_item del_prvdr" data-id="{{base64_encode(@$provider['id'])}}"><a class="text-danger cp">Delete</a></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <!-- <tr>
                                                    <td>2</td>
                                                    <td>Lorem Ipsum</td>
                                                    <td class="stats_item"><a class="text-danger cp">Delete</a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Lorem Ipsum</td>
                                                    <td class="stats_item"><a class="text-danger cp">Delete</a></td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-right stats_item">
                                        <a href="javascript:;" class="text-primary cp srch_providers"><i class="fa fa-plus-square"></i>&nbsp;Add New Invitee</a>
                                    </div>
                                    <div class="btn_sav_next d-flex justify-content-between">
                                        <span>
                                            <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                            <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                        </span>
                                        <!-- <button class="btn btn_theme btn_stk_nex" step="3"><span>Save & Continue</span></button> -->
                                        <button class="btn btn_theme proceed_srvcs" step="3"><span>Save & Continue</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <p class="outOff"><strong>Step 4 of 9</strong></p>
                                    <h6>What services are being requested?</h6>
                                    <form id="requestForProposalServicesForm">
                                        <div class="form-group">
                                            <label>Service Provider</label>
                                            <input type="text" class="form-control" placeholder="Designer" value="{{$userType['name']}}" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label>Service Category</label>
                                            <!-- <input type="text" class="form-control" placeholder="Structural Design" name="" readonly=""> -->
                                            <select class="mul_category prdr_srvc_cate_cls form-control" name="service_ids[]" multiple="multiple">
                                                @if(isset($providerServices) && sizeof($providerServices)>0)
                                                    @foreach($providerServices as $key => $providerService)
                                                        @if(!empty($providerService))
                                                            <option value="{{@$providerService['id']}}">{{@$providerService['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <!-- <option>Structural Design</option>
                                                <option>Mechanical Design</option>
                                                <option>Electrical Design</option> -->
                                            </select>
                                            <label class="error" for="service_ids[]"></label>
                                        </div>   
                                        <input type="hidden" name="step_no" value="4">                                     
                                    </form>
                                    <div class="btn_sav_next d-flex justify-content-between">
                                        <span>
                                            <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                            <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                        </span>
                                        <button class="btn btn_theme save_srvcs" step="4"><span>Save & Continue</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <form id="requestForProposalProjectForm">
                                        <p class="outOff"><strong>Step 5 of 9</strong></p>
                                        <h6>What is the name of the project for which this RFP is being issues and what is the address of the project worksites?</h6>
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <input type="text" class="form-control" placeholder="Name of the Project" name="project_name">
                                        </div>
                                        <div class="form-group">
                                            <label>Project No.</label>
                                            <input type="text" readonly="" class="form-control" placeholder="Project No." value="{{@$projectNo}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Project Address</label>
                                            <textarea class="form-control" rows="4" placeholder="Complete Address" name="project_address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Project City</label>
                                            <input type="text" class="form-control" placeholder="Project City" name="project_city">
                                            <!-- <select class="form-control custom-select">
                                                <option>Select City</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>San Frencisco</option>
                                            </select> -->
                                        </div>
                                        <div class="form-group">
                                            <label>Project Country</label>
                                            <select class="form-control custom-select" name="project_country_id">
                                                <option value="" disabled="" selected="">Select Country</option>
                                                @foreach($countries as $key => $country)
                                                    @if(!empty($country))
                                                        <option value="{{@$country['id']}}">{{@$country['name']}}</option>
                                                    @endif
                                                @endforeach
                                                <!-- <option>Canada</option>
                                                <option>Dubai</option>
                                                <option>Qatar</option>
                                                <option>Spain</option> -->
                                            </select>
                                        </div>
                                        <input type="hidden" name="step_no" value="5">
                                        <div class="btn_sav_next d-flex justify-content-between">
                                            <span>
                                                <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                                <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                            </span>
                                            <button class="btn btn_theme save_prjct" step="5"><span>Save & Continue</span></button>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <form id="requestForProposalRequestForm">
                                        <p class="outOff"><strong>Step 6 of 9</strong></p>
                                        <h6>Request Title</h6>
                                        <div class="form-group">
                                            <!-- <label>Request Title</label> -->
                                            <input type="text" name="request_title" class="form-control">
                                        </div>
                                        <h6>Request Description</h6>
                                        <div class="form-group">
                                            <textarea class="form-control" name="request_description" rows="7" placeholder="Write here about the Project . . ."></textarea>
                                        </div>
                                        <h6>Remarks/ Terms & Conditions</h6>
                                        <div class="form-group">
                                            <textarea class="form-control" name="request_remarks" rows="7" placeholder="Write here about the Project Remarks. . ."></textarea>
                                        </div>
                                        <input type="hidden" name="step_no" value="6">
                                        <div class="btn_sav_next d-flex justify-content-between">
                                            <span>
                                                <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                                <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                            </span>
                                            <button class="btn btn_theme save_rqst" step="6"><span>Save & Continue</span></button>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <form id="requestForProposalProjectSiteForm">
                                        <p class="outOff"><strong>Step 7 of 9</strong></p>
                                        <div class="seprt_inr">
                                            <h6>What is the timeline for RFP Process?</h6>
                                            <div class="form-group">
                                                <label>Question Submission Deadline:</label>
                                                <input type="text" onkeydown="return false" name="questions_submission_deadline_date" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Proposal Submission Deadline</label>
                                                <input type="text" onkeydown="return false" name="proposal_submission_deadline_date" class="form-control datetimepicker-input" id="datetimepicker6" data-toggle="datetimepicker" data-target="#datetimepicker6"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Proposal Submission Deadline Time</label>
                                                <input type="text" onkeydown="return false" name="proposal_submission_deadline_time" class="form-control datetimepicker-input tmpckr" id="datetimepicker7" data-toggle="datetimepicker" data-target="#datetimepicker7"/>
                                            </div>
                                        </div>
                                        <div class="seprt_inr">
                                            <h6>Does the client requires that interested bid invitees visit the project site ?</h6>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customRadio" name="project_site_visitable" value="yes">
                                                            <label class="custom-control-label" for="customRadio">Yes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" checked="" class="custom-control-input" id="customRadio4" name="project_site_visitable" value="no">
                                                            <label class="custom-control-label" checked="" for="customRadio4">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="step_no" value="7">
                                        <div class="btn_sav_next d-flex justify-content-between">
                                            <span>
                                                <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                                <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                            </span>
                                            <button class="btn btn_theme save_prjct_site" step="7"><span>Save & Continue</span></button>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <form id="requestForProposalRepresentativeForm">
                                        <p class="outOff"><strong>Step 8 of 9</strong></p>
                                        <h6>To whom should question pretaining to this RFP be Submitted?</h6>
                                        <div class="form-group">
                                            <input type="text" name="client_representative_name" class="form-control" placeholder="Name of client’s representative">
                                        </div>
                                        <div class="form-group intl_input">
                                            <input type="text" name="client_representative_mobile_no" class="form-control" placeholder="Contact number of client’s representative" value="+966" id="phone">
                                            <input type="hidden" class="form-control" name="isd_code" id="isd_code" value="93">
                                        </div>
                                        <!-- <div class="form-group intl_input">
                                            <input type="text" name="client_representative_mobile_no" class="form-control" placeholder="Contact number of client’s representative">
                                        </div> -->
                                        <div class="form-group">
                                            <input type="text" name="client_representative_email" class="form-control" placeholder="Email of client’s representative">
                                        </div>
                                        <input type="hidden" name="step_no" value="8">
                                        <div class="btn_sav_next d-flex justify-content-between">
                                            <span>
                                                <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                                <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                            </span>
                                            <button class="btn btn_theme save_rprsnttv" step="8"><span>Save & Continue</span></button>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                            <div class="repeted_div">
                                <div class="wrap_stck_inr">
                                    <form id="requestForProposalAttachFileForm">
                                        <p class="outOff"><strong>Step 9 of 9</strong></p>
                                        <h6>Attach Files:</h6>
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" name="attach_file" class="custom-file-input file_img" >
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <h6>Attach Logo:</h6>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" name="use_profile_photo" class="custom-control-input" id="customCheckpic">
                                            <label class="custom-control-label" for="customCheckpic">Use Profile Photo</label>
                                          </div>
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" name="attach_logo" class="custom-file-input">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="step_no" value="9">
                                        <div class="btn_sav_next d-flex justify-content-between">
                                            <span>
                                                <button class="btn btn_theme btn_stk_bck"><span>Back</span></button>
                                                <button class="btn btn_theme btn_sav_ltr"><span>Save for Later</span></button>
                                            </span>
                                            <!-- <a class="btn btn_theme save_attch_file" href="{{url('/user/reviewProposalRequest')}}"><span>Review & Submit</span></a> -->
                                            <a class="btn btn_theme save_attch_file" step="9" href="javascript:;"><span>Review & Submit</span></a>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="cover_page text-center">
                            <div class="wrap_User_info" style="background-image: url('../public/frontend/img/prop.png');">
                                <div class="inner_usr_inf">
                                    <h2>{{$clientName}}</h2>
                                    <h4>Request For Proposal</h4>
                                    <p>{{$userType['name']}}</p>
                                    <p class="req_ttl"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.include.modals.requestForProposalSearchProviders')
@stop
@section('script')
<script src="{{ url('public/frontend/js/intlTelInput.js')}}"  type="text/javascript"></script>
<script src="{{ url('public/frontend/js/intlTelInput-jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // IntlTelInput Plugin Initialization
    var inputIntl=$("#phone").intlTelInput({             
      allowDropdown: true,
      autoHideDialCode: true,
      autoPlaceholder: "",
      dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          var countryCode = (resp && resp.country) ? resp.country : "";
          callback(countryCode);
        });
      },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      preferredCountries: [],
      separateDialCode: true,
      utilsScript: "public``/frontend/js/utils.js",
    });
</script>
<script type="text/javascript">    
    $("#phone").on("countrychange", function(e, countryData) {
        var dial_code = $("#phone").intlTelInput("getSelectedCountryData").dialCode;
        $('#isd_code').val(dial_code);
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.repeted_div').hide();
        $('.repeted_div.fst_div').show();
        // $('.btn_stk_nex').click(function(){
        //     $(this).closest('.repeted_div').hide();
        //     $(this).closest('.repeted_div').next().show();
        // });
        $('.btn_stk_bck').click(function(){
            $(this).closest('.repeted_div').hide();
            $(this).closest('.repeted_div').prev().show();
        });

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var searchContent;
        var stepNo;
        var createRquestForProposalId = "{{base64_encode($createRquestForProposalId)}}";
        var ths;
        var barPercent;
        // alert(createRquestForProposalId);
        $("body").on('click','.btn_stk_nex',function(){
            // alert($(this).attr('step'));
            $('.loader').show();
            ths = $(this);
            stepNo = $(this).attr('step');
            $.ajax({
                url:"{{url('user/requestForProposal/updateStep')}}",
                type: "post",
                data:{ stepNo:stepNo, createRquestForProposalId:createRquestForProposalId },
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        ths.closest('.repeted_div').hide();
                        ths.closest('.repeted_div').next().show();
                        barPercent = (100/9)*stepNo;
                        $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                        $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                        // alert((100/9)*1);
                    }else{
                        swal('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
        });

        $("body").on('click','.proceed_srvcs',function(){
            // alert($(this).attr('step'));
            $('.loader').show();
            ths = $(this);
            stepNo = $(this).attr('step');
            // alert(stepNo);
            $.ajax({
                url:"{{url('user/requestForProposal/selectServiceCategories')}}",
                type: "post",
                data:{ stepNo:stepNo, createRquestForProposalId:createRquestForProposalId },
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        // alert('success');
                        $('.prdr_srvc_cate_cls').html(resp.view);
                        ths.closest('.repeted_div').hide();
                        ths.closest('.repeted_div').next().show();
                        barPercent = (100/9)*stepNo;
                        $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                        $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                    }else{
                        swal('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
        });

        $("body").on('click','.save_srvcs',function(){
            // alert('submit');
            ths = $(this);
            stepNo = $(this).attr('step');
            $('#requestForProposalServicesForm').submit();
        });

        $('#requestForProposalServicesForm').validate({
            rules:{
                "service_ids[]":{
                    required:true
                }
            },
            messages:{
                "service_ids[]":{
                    required:"Please select service category"
                }
            },
            submitHandler: function(form) {
                // alert('here');
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/updateServiceCategories')}}"+"/"+createRquestForProposalId,
                    type: "post",             
                    data: $('#requestForProposalServicesForm').serialize(),
                    // cache: false,             
                    // processData: false,      
                    success: function(resp) {
                        $('.loader').hide();
                        if (resp.status=='success') {
                            $('.save_srvcs').closest('.repeted_div').hide();
                            $('.save_srvcs').closest('.repeted_div').next().show();
                            barPercent = (100/9)*stepNo;
                            $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                            $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    }
                });
                return false;
            },
        });

        $("body").on('click','.save_prjct',function(e){
            e.preventDefault();
            // alert('submit');
            ths = $(this);
            stepNo = $(this).attr('step');
            $('#requestForProposalProjectForm').submit();
        });

        $('#requestForProposalProjectForm').validate({
            rules:{
                project_name:{
                    required:true,
                    regex:regex_user_name,
                },
                project_no:{
                    required:true
                },
                project_address:{
                    required:true,
                    maxlength:5000,
                    regex:regex_user_name,
                },
                project_city:{
                    required:true
                },
                project_country_id:{
                    required:true
                },
            },
            messages:{
                project_name:{
                    required:"Please enter project name"
                },
                project_no:{
                    required:"Please enter project number"
                },
                project_address:{
                    required:"Please enter project address"
                },
                project_city:{
                    required:"Please enter project city"
                },
                project_country_id:{
                    required:"Please select project country"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/updateProjectDetail')}}"+"/"+createRquestForProposalId,
                    type: "post",             
                    data: $('#requestForProposalProjectForm').serialize(),
                    // cache: false,             
                    // processData: false,      
                    success: function(resp) {
                        $('.loader').hide();
                        if (resp.status=='success') {
                            $('.save_prjct').closest('.repeted_div').hide();
                            $('.save_prjct').closest('.repeted_div').next().show();
                            barPercent = (100/9)*stepNo;
                            $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                            $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    }
                });
                return false;
            },
        });

        $("body").on('click','.save_rqst',function(e){
            e.preventDefault();
            // alert('submit');
            ths = $(this);
            stepNo = $(this).attr('step');
            $('#requestForProposalRequestForm').submit();
        });

        $('#requestForProposalRequestForm').validate({
            rules:{
                request_title:{
                    required:true,
                    regex:regex_user_name,
                },
                request_description:{
                    required:true,
                    regex:regex_user_name,
                },
                request_remarks:{
                    required:true,
                    maxlength:5000,
                    regex:regex_user_name,
                },
            },
            messages:{
                request_title:{
                    required:"Please enter request title"
                },
                request_description:{
                    required:"Please enter request description"
                },
                request_remarks:{
                    required:"Please enter request remarks / terms & conditions"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/updateRequestDetail')}}"+"/"+createRquestForProposalId,
                    type: "post",             
                    data: $('#requestForProposalRequestForm').serialize(),
                    // cache: false,             
                    // processData: false,      
                    success: function(resp) {
                        $('.loader').hide();
                        if (resp.status=='success') {
                            $('.req_ttl').text(resp.request_title);
                            $('.save_rqst').closest('.repeted_div').hide();
                            $('.save_rqst').closest('.repeted_div').next().show();
                            barPercent = (100/9)*stepNo;
                            $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                            $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    }
                });
                return false;
            },
        });

        $("body").on('click','.save_prjct_site',function(e){
            e.preventDefault();
            // alert('submit');
            ths = $(this);
            stepNo = $(this).attr('step');
            $('#requestForProposalProjectSiteForm').submit();
        });

        $('#requestForProposalProjectSiteForm').validate({
            rules:{
                questions_submission_deadline_date:{
                    required:true
                },
                proposal_submission_deadline_date:{
                    required:true
                },
                proposal_submission_deadline_time:{
                    required:true,
                    maxlength:5000
                },
            },
            messages:{
                questions_submission_deadline_date:{
                    required:"Please select question submission deadline date"
                },
                proposal_submission_deadline_date:{
                    required:"Please select proposal submission deadline date"
                },
                proposal_submission_deadline_time:{
                    required:"Please select proposal submission deadline time"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/updateProjectSite')}}"+"/"+createRquestForProposalId,
                    type: "post",             
                    data: $('#requestForProposalProjectSiteForm').serialize(),
                    // cache: false,             
                    // processData: false,      
                    success: function(resp) {
                        $('.loader').hide();
                        if (resp.status=='success') {
                            $('.save_prjct_site').closest('.repeted_div').hide();
                            $('.save_prjct_site').closest('.repeted_div').next().show();
                            barPercent = (100/9)*stepNo;
                            $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                            $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    }
                });
                return false;
            },
        });

        $("body").on('click','.save_rprsnttv',function(e){
            e.preventDefault();
            // alert('submit');
            ths = $(this);
            stepNo = $(this).attr('step');
            $('#requestForProposalRepresentativeForm').submit();
        });

        $('#requestForProposalRepresentativeForm').validate({
            rules:{
                client_representative_name:{
                    required:true,
                    regex:regex_user_name,
                },
                client_representative_mobile_no:{
                    required:true,
                    number:true,
                    minlength:7,  
                    maxlength:15, 
                },
                client_representative_email:{
                    required:true,
                    regex: email_regex,
                },
            },
            messages:{
                client_representative_name:{
                    required:"Please enter name of client’s representative"
                },
                client_representative_mobile_no:{
                    required:"Please enter contact number of client’s representative",
                    minlength:"Minimum 7 characters are allowed",
                    maxlength:"Maximum 15 characters are allowed",
                },
                client_representative_email:{
                    required:"Please enter email of client’s representative",
                    regex: "Please enter valid email address",
                },
            },
            submitHandler: function(form) {
                // alert('here');
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/updateRepresentative')}}"+"/"+createRquestForProposalId,
                    type: "post",             
                    data: $('#requestForProposalRepresentativeForm').serialize(),
                    // cache: false,             
                    // processData: false,      
                    success: function(resp) {
                        $('.loader').hide();
                        if (resp.status=='success') {
                            $('.save_rprsnttv').closest('.repeted_div').hide();
                            $('.save_rprsnttv').closest('.repeted_div').next().show();
                            barPercent = (100/9)*stepNo;
                            $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                            $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    }
                });
                return false;
            },
        });

        $("body").on('click','.save_attch_file',function(e){
            e.preventDefault();
            // alert('submit');
            ths = $(this);
            stepNo = $(this).attr('step');
            $('#requestForProposalAttachFileForm').submit();
        });

        $('#requestForProposalAttachFileForm').validate({
            rules:{
                // attach_file:{
                //     required:true
                // },
                // attach_logo:{
                //     required:true
                // },
                attach_logo: {
                    required: {
                        depends: function(element) {
                          // return $("#customCheckpic:checked")
                            if ($('#customCheckpic').is(':checked')) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                }
            },
            messages:{
                attach_file:{
                    required:"Please attach file"
                },
                attach_logo:{
                    required:"Please attach logo"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/updateAttachFile')}}"+"/"+createRquestForProposalId,
                    type: "post",             
                    data: da,
                    contentType: false,
                    processData: false,    
                    success: function(resp) {
                        $('.loader').hide();
                        if (resp.status=='success') {
                            // alert('success');
                            barPercent = (100/9)*stepNo;
                            $('.prgrs_bar_cls').text(parseInt(barPercent)+"%");
                            $('.prgrs_bar_stl').css("width",parseInt(barPercent)+"%");
                            window.location.replace("{{url('/user/reviewProposalRequest/'.base64_encode($createRquestForProposalId))}}");
                            // $('.save_prjct_site').closest('.repeted_div').hide();
                            // $('.save_prjct_site').closest('.repeted_div').next().show();
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    }
                });
                return false;
            },
        });

        $("body").on('click','.del_prvdr',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_provider_id = $(this).data('id');
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
                    // alert(result.value);
                    $.ajax({
                        url:"{{url('user/requestForProposal/inviteeDelete')}}",
                        data:{enc_provider_id:enc_provider_id, createRquestForProposalId:createRquestForProposalId},
                        success:function(resp){
                            $('.loader').hide();
                            if (resp.status=='success') {
                                // ths.closest('.user_adrs').remove();
                                $('.prvdr_tabl_cls').html(resp.view);
                                Swal.fire(
                                  'Deleted!',
                                  'Your invitee has been deleted.',
                                  'success'
                                )
                            }else if(resp.status=='cannotDelete'){
                                swal('Sorry, Cannot be deleted');
                            }else{
                                swal('Oops, Something went wrong');
                            }
                        },
                        error:function(){
                            $(".loader").hide();
                            swal('Oops, Something went wrong');
                        }
                    });
                }
            }) 
        });

        $("body").on('keyup','.srch_prvdr',function(){
            // e.preventDefault();
            // alert($(this).val());
            searchContent = $(this).val();
            if (searchContent!=null && searchContent!="") {
                $.ajax({
                    url:"{{url('user/requestForProposal/searchProviders')}}",
                    type: "post",
                    data:{ searchContent:searchContent, createRquestForProposalId:createRquestForProposalId },
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            $('.prvdr_list_cls').html(resp.view);
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    },
                    error:function(){
                        $(".loader").hide();
                        swal('Oops, Something went wrong');
                    }
                });                
            }else{
                $('.prvdr_list_cls').html("");
            }
        });

        $("body").on('click','.add_invitee_btn',function(e){
            e.preventDefault();
            // alert('submit');
            ths = $(this);
            // alert(searchContent);
            if (searchContent!=null && searchContent!="") {
                $('#addInviteeForm').submit();                
            }
        });

        $('#addInviteeForm').validate({
            rules:{
                "provider_ids[]":{
                    required:true
                },
            },
            messages:{
                "provider_ids[]":{
                    required:"Please enter request description"
                },
            },
            submitHandler: function(form) {
                // alert('here');
                var da=new FormData($(form)[0]);
                $('.loader').show();
                $.ajax({
                    url:"{{url('user/requestForProposal/inviteeAdd')}}"+"/"+createRquestForProposalId,
                    type: "post",             
                    data: da,
                    contentType: false,
                    processData: false,    
                    success: function(resp) {
                        $('.loader').hide();
                        if (resp.status=='success') {
                            // alert('success');
                            $('.prvdr_tabl_cls').html(resp.view);
                            $('#srch_providers_mod').modal('hide');
                            $('.prvdr_list_cls').html("");
                            $('.srch_prvdr').val("");
                        }else if (resp.status=='cannotAdd') {
                            swal('Sorry, Maximum 5 invitees can be added');
                        }else{
                            swal('Oops, Something went wrong');
                        }
                    }
                });
                return false;
            },
        });

        $("body").on('click','.btn_sav_ltr',function(){
            window.location.replace("{{url('/user/requestForProposal/saveForLater/'.base64_encode(@$createRquestForProposalId))}}");
        });


    });
</script>
<script type="text/javascript">
    $("body").on('click','.srch_providers',function(){
        $('#srch_providers_mod').modal('show');
    });
</script>
<!-- <script type="text/javascript">
    $('.file_img').on('change', function () {
        var input = this;
        // alert(input);
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('prof_ch');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    });
</script> -->
<!-- <script type="text/javascript">
    // alert('here');
    var searchContent;
    $("body").on('keyup','.srch_prvdr',function(){
        // e.preventDefault();
        alert($(this).val());
        searchContent = $(this).val();
        $.ajax({
            url:"{{url('user/requestForProposal/searchProviders')}}",
            type: "post",
            data:{ searchContent:searchContent, createRquestForProposalId:createRquestForProposalId },
            success:function(resp){
                $('.loader').hide();
                if (resp.status=='success') {
                    // ths.closest('.repeted_div').hide();
                    // ths.closest('.repeted_div').next().show();
                }else{
                    swal('Oops, Something went wrong');
                }
            },
            error:function(){
                $(".loader").hide();
                swal('Oops, Something went wrong');
            }
        });
    });
</script> -->
@stop