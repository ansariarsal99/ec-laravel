@extends('frontend.layout.layout')
@section('title',"Seller's List")
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Seller's List</li>
            </ol>
        </nav>
    </div>
    <section class="seler_lst_page_sec">
        <div class="custom_container">
            <div class="wrp_dsgnr_lst">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="filtr_left seler_fltrs">
                            <fieldset>
                                <form id="providerFltrsForm" action="{{url('/seller/list')}}" method="GET">
                                    <h5>Narrow Result</h5>
                                    <!-- <div class="fltrs_accordn">
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
                                                  <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                    Design Category
                                                  </a>
                                                </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <div class="prnt_child_chk">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                    <label class="custom-control-label" for="customCheck">Architectural Design</label>
                                                                </div>
                                                                <ul class="child_chk" type="none">
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                            <label class="custom-control-label" for="heck1">Wood & Plastic</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                            <label class="custom-control-label" for="heck2">Doors and Windows</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                            <label class="custom-control-label" for="heck3">Equipments</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                            <label class="custom-control-label" for="heck4">Special Construction</label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="prnt_child_chk">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="example1">
                                                                    <label class="custom-control-label" for="customCheck1">Structural Design</label>
                                                                </div>
                                                                <ul class="child_chk" type="none">
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                            <label class="custom-control-label" for="heck1">Site Work</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                            <label class="custom-control-label" for="heck2">Concrete</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                            <label class="custom-control-label" for="heck3">Block & Masonry</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                            <label class="custom-control-label" for="heck4">Thermal & Moisture</label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="prnt_child_chk">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck2" name="example1">
                                                                    <label class="custom-control-label" for="customCheck2">Electrical Design</label>
                                                                </div>
                                                                <ul class="child_chk" type="none">
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck11" name="example1">
                                                                            <label class="custom-control-label" for="heck11">Lightning</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck22" name="example1">
                                                                            <label class="custom-control-label" for="heck22">Electrical Power</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck33" name="example1">
                                                                            <label class="custom-control-label" for="heck33">Low Current System</label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="prnt_child_chk">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheck3" name="example1">
                                                                    <label class="custom-control-label" for="customCheck3">Mechanical Design</label>
                                                                </div>
                                                                <ul class="child_chk" type="none">
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                            <label class="custom-control-label" for="heck1">Conveying System</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                            <label class="custom-control-label" for="heck2">Escalators</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                            <label class="custom-control-label" for="heck3">Plumbing</label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                            <label class="custom-control-label" for="heck4">Fire Fighting</label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                    Project Type
                                                  </a>
                                                </div>
                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                <label class="custom-control-label" for="customCheck4">Commercial</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                <label class="custom-control-label" for="customCheck5">Residential</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
                                                    Customer Rating
                                                  </a>
                                                </div>
                                                <div id="collapse3" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck6" name="example1">
                                                                <label class="custom-control-label" for="customCheck6">1 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck7" name="example1">
                                                                <label class="custom-control-label" for="customCheck7">2 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck8" name="example1">
                                                                <label class="custom-control-label" for="customCheck8">3 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck9" name="example1">
                                                                <label class="custom-control-label" for="customCheck9">4 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck10" name="example1">
                                                                <label class="custom-control-label" for="customCheck10">5 <i class="fa fa-star"></i></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse4">
                                                    Project Field
                                                  </a>
                                                </div>
                                                <div id="collapse4" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom1" name="example1">
                                                                <label class="custom-control-label" for="custom1">Villas</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                <label class="custom-control-label" for="custom2">Hotels & Restaurants</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom1" name="example1">
                                                                <label class="custom-control-label" for="custom1">Commercial Malls</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                <label class="custom-control-label" for="custom2">Cafe's</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse5">
                                                    Entity Type
                                                  </a>
                                                </div>
                                                <div id="collapse5" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom3" name="example1">
                                                                <label class="custom-control-label" for="custom3">Individual</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                <label class="custom-control-label" for="custom2">Companies</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom4" name="example1">
                                                                <label class="custom-control-label" for="custom4">Office</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                <label class="custom-control-label" for="custom2">Establishment</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse6">
                                                    Experience
                                                  </a>
                                                </div>
                                                <div id="collapse6" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <select class="form-control custom-select">
                                                                <option>0 - 5 Years</option>
                                                                <option>5 - 10 Years</option>
                                                                <option>10 - 20 Years</option>
                                                                <option>20 - 40 Years</option>
                                                                <option>40+ Years</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> -->
                                    <div class="fltrs_accordn">
                                        <div id="accordion">
                                            <!-- <div class="card-header">
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
                                            </div> -->
                                            @if(isset($userServices) && sizeof($userServices)>0)
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                            Type of Services
                                                        </a>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                @foreach($userServices as $key => $userService)
                                                                    @if(!empty($userService))
                                                                        <div class="prnt_child_chk">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" @if(isset($data['services']) && sizeof($data['services'])>0 && in_array(@$userService['id'],$data['services'])) checked="" @endif value="{{$userService['id']}}" class="custom-control-input" id="usrSrvc{{$key}}" name="services[]">
                                                                                <label class="custom-control-label" for="usrSrvc{{$key}}">{{$userService['name']}}</label>
                                                                            </div>
                                                                            <!-- <ul class="child_chk" type="none">
                                                                                <li>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="heck1" name="example1">
                                                                                        <label class="custom-control-label" for="heck1">Wood & Plastic</label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="heck2" name="example1">
                                                                                        <label class="custom-control-label" for="heck2">Doors and Windows</label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="heck3" name="example1">
                                                                                        <label class="custom-control-label" for="heck3">Equipments</label>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" id="heck4" name="example1">
                                                                                        <label class="custom-control-label" for="heck4">Special Construction</label>
                                                                                    </div>
                                                                                </li>
                                                                            </ul> -->
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- <div class="card">
                                                <div class="card-header">
                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                    Project Type
                                                  </a>
                                                </div>
                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                <label class="custom-control-label" for="customCheck4">Commercial</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                <label class="custom-control-label" for="customCheck5">Residential</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                  <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">
                                                    Customer Rating
                                                  </a>
                                                </div>
                                                <div id="collapse3" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck6" name="example1">
                                                                <label class="custom-control-label" for="customCheck6">1 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck7" name="example1">
                                                                <label class="custom-control-label" for="customCheck7">2 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck8" name="example1">
                                                                <label class="custom-control-label" for="customCheck8">3 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck9" name="example1">
                                                                <label class="custom-control-label" for="customCheck9">4 <i class="fa fa-star"></i></label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck10" name="example1">
                                                                <label class="custom-control-label" for="customCheck10">5 <i class="fa fa-star"></i></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            @if(isset($projectFields) && sizeof($projectFields)>0)
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="collapsed card-link" data-toggle="collapse" href="#collapse4">
                                                        Project Fields
                                                      </a>
                                                    </div>
                                                    <div id="collapse4" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                @foreach($projectFields as $key => $projectField)
                                                                    @if(!empty($projectField))
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" @if(isset($data['project_fields']) && sizeof($data['project_fields'])>0 && in_array(@$projectField['id'],$data['project_fields'])) checked="" @endif value="{{@$projectField['id']}}" class="custom-control-input" id="prjFields{{$key}}" name="project_fields[]">
                                                                            <label class="custom-control-label" for="prjFields{{$key}}">{{@$projectField['name']}}</label>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <!-- <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">Hotels & Restaurants</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom1" name="example1">
                                                                    <label class="custom-control-label" for="custom1">Commercial Malls</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">Cafe's</label>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(isset($userProperties) && sizeof($userProperties)>0)
                                                <div class="card">
                                                    <div class="card-header">
                                                      <a class="collapsed card-link" data-toggle="collapse" href="#collapse5">
                                                        Type of Entity
                                                      </a>
                                                    </div>
                                                    <div id="collapse5" class="collapse show" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                @foreach($userProperties as $key => $userProperty)
                                                                    @if(!empty($userProperty))
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" @if(isset($data['entities']) && sizeof($data['entities'])>0 && in_array(@$userProperty['id'],$data['entities'])) checked="" @endif value="{{@$userProperty['id']}}" class="custom-control-input" id="usrproperties{{$key}}" name="entities[]">
                                                                            <label class="custom-control-label" for="usrproperties{{$key}}">{{@$userProperty['name']}}</label>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <!-- <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">Companies</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom4" name="example1">
                                                                    <label class="custom-control-label" for="custom4">Office</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                    <label class="custom-control-label" for="custom2">Establishment</label>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="card">
                                                <div class="card-header">
                                                    <a class="collapsed card-link" data-toggle="collapse" href="#collapse6">
                                                        Experience
                                                    </a>
                                                </div>
                                                <div id="collapse6" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="meta_fltr">
                                                            <select class="form-control custom-select" name="experience">
                                                                <option value="">Select Experience</option>
                                                                @for($i=0; $i <=50 ; $i++)
                                                                    <option @if(isset($data['experience']) && !empty($data['experience']) && $data['experience']==$i) selected="" @endif value="{{$i}}">{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($projectCities) && sizeof($projectCities)>0)
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a class="collapsed card-link" data-toggle="collapse" href="#collapsenew">
                                                            Seller's City
                                                        </a>
                                                    </div>
                                                    <div id="collapsenew" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="meta_fltr">
                                                                <select class="form-control custom-select" name="city">
                                                                    <option value="">Select City</option>
                                                                    @foreach($projectCities as $key => $projectCity)
                                                                        @if(!empty($projectCity))
                                                                            <option @if(isset($data['city']) && !empty($data['city']) && $data['city']==$projectCity['city_detail']['id']) selected="" @endif value="{{$projectCity['city_detail']['id']}}">{{$projectCity['city_detail']['name']}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="botom_meta_dsgnr filtr_btn text-center my-3">
                                        <a class="btn btn_theme providerFltrsCls" href="{{url('/seller/list')}}"><span>Reset</span></a>
                                        <a class="btn btn_theme providerFltrsCls" href="javascript:;"><span>Search</span></a>
                                    </div>   
                                    <input type="hidden" class="sort_data_cls" name="sort_data" value="" />
                                </form>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="seler_main_rgt">
                            <div class="fltr_topp d-flex justify-content-between align-items-center">
                                <div class="section-heading">
                                    <h2>Seller's List</h2>
                                </div>
                            </div>
                            <div class="fltr_topp d-flex justify-content-end align-items-center">
                                @if($sellers->total()>0)
                                    <div class="dropdown">
                                        <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-sort"></i>&nbsp;Sort
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right sort_submenu">
                                            <!-- <a class="dropdown-item provider_fltr_srt_cls" rel="rating_low_to_high" href="javascript:;"><i class="fa fa-circle"></i>&ensp;Customer Rating Low to High</a>
                                            <a class="dropdown-item provider_fltr_srt_cls" rel="rating_high_to_low" href="javascript:;"><i class="fa fa-circle"></i>&ensp;Customer Rating High to Low</a>
                                            <a class="dropdown-item provider_fltr_srt_cls" rel="experience_low_to_high" href="javascript:;"><i class="fa fa-circle"></i>&ensp;Experience Low to High</a>
                                            <a class="dropdown-item provider_fltr_srt_cls" rel="experience_high_to_low" href="javascript:;"><i class="fa fa-circle"></i>&ensp;Experience High to Low</a> -->

                                            <a class="dropdown-item provider_fltr_srt_cls" rel="rating_low_to_high" href="javascript:;">Customer Rating Low to High</a>
                                            <a class="dropdown-item provider_fltr_srt_cls" rel="rating_high_to_low" href="javascript:;">Customer Rating High to Low</a>
                                            <a class="dropdown-item provider_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='experience_low_to_high') is_active @endif" rel="experience_low_to_high" href="javascript:;">Experience Low to High</a>
                                            <a class="dropdown-item provider_fltr_srt_cls @if(isset($data['sort_data']) && !empty($data['sort_data']) && $data['sort_data']=='experience_high_to_low') is_active @endif" rel="experience_high_to_low" href="javascript:;">Experience High to Low</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if($sellers->total()>0)
                                <!-- <div class="wrap_seler_main">
                                    <div class="single_list_desgnr d-flex">
                                        <div class="dsgnr_img">
                                            <img src="https://pbs.twimg.com/profile_images/534970730673225728/3nFbT0Mi.jpeg" class="img-fluid">
                                        </div>
                                        <div class="dsgnr_dtl">
                                            <div class="top_meta_dsgnr">
                                                <a href="{{url('/seller/detail')}}">Seller Name</a>
                                            </div>
                                            <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                <div class="left_info_dsgnr">
                                                    <p><strong>Contact Number:</strong> +91 94786 16633</p>
                                                    <p><strong>Email:</strong> raina_mukesh@gmail.clm</p>
                                                    <p><strong>Seller Type:</strong> Architectural Work</p>
                                                    <p><strong>Location:</strong> <a href="" class="cp_loca">13003 Southwest Suite, TX 7747, Dubai</a></p>
                                                    <p><strong>Type of Selling Material:</strong> Steel Work</p>
                                                </div>
                                                <div class="rgt_ratng">
                                                    <span><small>9.8</small>/10 <br>140 Customer Reviews</span>
                                                </div>
                                            </div>
                                            <div class="botom_meta_dsgnr text-right">
                                                <a class="btn btn_theme" href="{{url('/seller/detail')}}"><span>Read More</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="wrap_designer_main">
                                    <form id="providerListForm">
                                        @foreach($sellers as $key => $seller)
                                            @if(!empty($seller))
                                                <div class="single_list_desgnr d-flex">
                                                    <div class="cert_div d-flex flex-column">
                                                        <div class="dsgnr_img">
                                                            <!-- <img src="https://manofmany.com/wp-content/uploads/2019/06/50-Long-Haircuts-Hairstyle-Tips-for-Men-5.jpg" class="img-fluid"> -->
                                                            @if(!empty($seller->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.$seller->profile_image)))
                                                                <img alt="" src="{{asset('public/frontend/imgs/userProfile/'.$seller->profile_image)}}" class="img-responsive">
                                                            @else
                                                                <img alt="" src="{{asset('public/frontend/img/no_image.png')}}" class="img-responsive">
                                                            @endif
                                                        </div>
                                                        @if(@$seller['certified_provider']=='yes')
                                                            <div class="bd_img text-center mt-3">
                                                                <img src="{{asset('public/frontend/img/badge.png')}}" class="img-fluid">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="dsgnr_dtl">
                                                        <div class="top_meta_dsgnr d-flex justify-content-between">
                                                            @if($seller['userPropertyDetail']['type']=='company')
                                                                <a href="{{url('/seller/detail/'.base64_encode($seller['id']))}}">{{ucfirst(@$seller['company_name'])}}</a>
                                                            @else
                                                                <a href="{{url('/seller/detail/'.base64_encode($seller['id']))}}">{{ucfirst(@$seller['contact_name'])}} {{ucfirst(@$seller['contact_last_name'])}}</a>
                                                            @endif
                                                            @if(Auth::check() && (Auth::user()->user_type_id==1 || Auth::user()->user_type_id==2))
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" @if(in_array($seller['id'],$selectedProviderIds)) checked="" @endif value="{{@$seller['id']}}" data-id="{{@$seller['id']}}" class="custom-control-input cstm_chek" id="customCh{{$key}}" name="provider_ids[]">
                                                                    <label class="custom-control-label" for="customCh{{$key}}"> </label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="middle_meta_dsgnr d-flex justify-content-between align-items-center">
                                                            <div class="left_info_dsgnr">
                                                                <p><strong>Contact Number:</strong> {{@$seller['isd_code']}} {{@$seller['mobile_no']}}</p>
                                                                <p><strong>Email:</strong> {{@$seller['email']}}</p>
                                                                <!-- <p><strong>Location:</strong> <a class="cp_loca"> {{@$seller['location']}}</a></p> -->
                                                                <p><strong>Experience:</strong> +{{@$seller['experience']}} (In @if(@$seller['experience']<=1) Year @else Years @endif)</p>
                                                                <p><strong>Type of Entity:</strong> {{@$seller['userPropertyDetail']['name']}}</p>
                                                                <p><strong>Category:</strong> {{@$seller['userTypeDetail']['name']}}</p>
                                                                <p><strong>City:</strong> {{@$seller['userDefaultStoreLocation']['cityDetail']['name']}}</p>
                                                                <!-- <p><strong>Type of Services :</strong> @foreach($seller['userSelectedServicesDetail'] as $key => $serviceDetail) @if($key>=1) ,@endif{{$serviceDetail['userServiceDetail']['name']}} @endforeach </p>
                                                                <p><strong>Project Fields :</strong> @foreach($seller['userSelectedProjectFieldsDetail'] as $key => $projectFieldDetail) @if($key>=1) ,@endif{{$projectFieldDetail['userProjectFieldDetail']['name']}} @endforeach </p> -->
                                                            </div>
                                                            <div class="rgt_ratng">
                                                                <span><small>9.8</small>/10 <br>140 Customer Reviews</span>
                                                            </div>
                                                        </div>
                                                        <div class="botom_meta_dsgnr text-right">
                                                            <!-- <a class="btn btn_theme" href="javascript:;"><span>Read More</span></a> -->
                                                            <a class="btn btn_theme" href="{{url('/seller/detail/'.base64_encode($seller['id']))}}"><span>Read More</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach                                        
                                    </form>
                                </div>
                                <div class="numbr_pagintn mt-3">
                                    {{ $sellers->appends(request()->except('page'))->links() }}
                                </div>
                            @else
                                <div class="nf_img text-center">
                                    <!-- <h1>Not Found</h1>                                     -->
                                    <img src="{{asset('public/frontend/img/provider_not_found.png')}}" class="img-fluid mt-5">
                                </div>
                            @endif
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
        $("body").on('click','.providerFltrsCls',function(){
            $("#providerFltrsForm").submit();
        });

        $("body").on('click','.provider_fltr_srt_cls',function(){
            // alert($(this).attr('rel'));
            $('.sort_data_cls').val($(this).attr('rel'));
            $("#providerFltrsForm").submit();
        });
    });
</script>
@stop