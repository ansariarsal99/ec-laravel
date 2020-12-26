@extends('frontend.layout.providerLayout')
@section('title','Edit Profile')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/intlTelInput.css')}}">
<style type="text/css">
   /*.custom-checkbox .custom-control-input:disabled:checked ~ .custom-control-label::before {
        background-color: rgba(225, 64, 47, 0.5);
    }*/
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
                            <h3>Edit Profile</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Edit Profile</a></li>
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
                                <section class="register_sec bsns_dtl">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="sec_heading text-center">
                                                <h2>Edit Profile</h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="edit_side_wrap d-flex flex-column justify-content-center">
                                                        @if($user['user_type_detail']['alias']=='designer')
                                                            @include('frontend.elements.designerScopeOfWork')
                                                        @elseif($user['user_type_detail']['alias']=='contractor')
                                                            @include('frontend.elements.contractorScopeOfWork')
                                                        @elseif($user['user_type_detail']['alias']=='consultant')
                                                            @include('frontend.elements.consultantScopeOfWork')
                                                        @endif
                                                        <!-- <div class="filtr_left seler_fltrs common_list" id="designer">
                                                            <fieldset>
                                                                <h5>Scope of Work</h5>
                                                                <div class="fltrs_accordn">
                                                                    <div id="accordion">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                                                <b>You are</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Establishment</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Freelancer Designer</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Company</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse8">
                                                                                <b>Select Your Services</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse8" class="collapse" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Architectural Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Structural Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Electrical Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Mechanical Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Interior Design</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                                                <b>Project Type</b>
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
                                                                                <b>Customer Rating</b>
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
                                                                                <b>Project Field</b>
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
                                                                                <b>Entity Type</b>
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse7">
                                                                                <b>Location</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse7" class="collapse" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom3" name="example1">
                                                                                            <label class="custom-control-label" for="custom3">Villas</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                                            <label class="custom-control-label" for="custom2">Places</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom4" name="example1">
                                                                                            <label class="custom-control-label" for="custom4">Hotels & Restaurants</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse6">
                                                                                <b>Experience</b>
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
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <div class="filtr_left seler_fltrs common_list contractor" id="contractor">
                                                            <fieldset>
                                                                <h5>Scope of Work</h5>
                                                                <div class="fltrs_accordn">
                                                                    <div id="accordion2">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="card-link" data-toggle="collapse" href="#collapse9">
                                                                                <b>You are</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse9" class="collapse show" data-parent="#accordion2">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Factory</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Workshop</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Individual</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Company</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseTen">
                                                                                <b>Select Your Services</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseTen" class="collapse" data-parent="#accordion2">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Architectural Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Structural Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Electrical Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Mechanical Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Interior Design</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseEleven">
                                                                                <b>Project Type</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseEleven" class="collapse" data-parent="#accordion2">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse12">
                                                                                <b>Customer Rating</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse12" class="collapse" data-parent="#accordion2">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse13">
                                                                                <b>Project Field</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse13" class="collapse" data-parent="#accordion2">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse14">
                                                                                <b>Entity Type</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse14" class="collapse" data-parent="#accordion2">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse15">
                                                                                <b>Location</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse15" class="collapse" data-parent="#accordion2">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom3" name="example1">
                                                                                            <label class="custom-control-label" for="custom3">Villas</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                                            <label class="custom-control-label" for="custom2">Places</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom4" name="example1">
                                                                                            <label class="custom-control-label" for="custom4">Hotels & Restaurants</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapse16">
                                                                                <b>Experience</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapse16" class="collapse" data-parent="#accordion2">
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
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <div class="filtr_left seler_fltrs common_list seller" id="seller">
                                                            <fieldset>
                                                                <h5>Scope of Work</h5>
                                                                <div class="fltrs_accordn">
                                                                    <div id="accordion3">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="card-link" data-toggle="collapse" href="#collapseA">
                                                                                <b>You are</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseA" class="collapse show" data-parent="#accordion3">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Factory</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Workshop</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Individual</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Company</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseB">
                                                                                <b>Select Your Services</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseB" class="collapse" data-parent="#accordion3">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Architectural Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Structural Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Electrical Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Mechanical Design</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Interior Design</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseC">
                                                                                <b>Project Type</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseC" class="collapse" data-parent="#accordion3">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseD">
                                                                                <b>Customer Rating</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseD" class="collapse" data-parent="#accordion3">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseE">
                                                                                <b>Project Field</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseE" class="collapse" data-parent="#accordion3">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseF">
                                                                                <b>Entity Type</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseF" class="collapse" data-parent="#accordion3">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseG">
                                                                                <b>Location</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseG" class="collapse" data-parent="#accordion3">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom3" name="example1">
                                                                                            <label class="custom-control-label" for="custom3">Villas</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                                            <label class="custom-control-label" for="custom2">Places</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom4" name="example1">
                                                                                            <label class="custom-control-label" for="custom4">Hotels & Restaurants</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseH">
                                                                                <b>Experience</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseH" class="collapse" data-parent="#accordion3">
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
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <div class="filtr_left seler_fltrs common_list" id="consultant">
                                                            <fieldset>
                                                                <h5>Scope of Work</h5>
                                                                <div class="fltrs_accordn">
                                                                    <div id="accordion4">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseP">
                                                                                <b>You are</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseP" class="collapse show" data-parent="#accordion4">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Consultant Firm</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Freelancer Firm</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Project Management Firm</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Freelancer Project Management Firm</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseQ">
                                                                                <b>Select Your Services</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseQ" class="collapse" data-parent="#accordion4">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck4">Architectural Work Consultant</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Structural Work Consultant</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Electrical Work Consultant</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="example1">
                                                                                            <label class="custom-control-label" for="customCheck5">Mechanical Work Consultant</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseR">
                                                                                <b>Project Type</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseR" class="collapse" data-parent="#accordion4">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseS">
                                                                                <b>Customer Rating</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseS" class="collapse" data-parent="#accordion4">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseT">
                                                                                <b>Project Field</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseT" class="collapse" data-parent="#accordion4">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseU">
                                                                                <b>Entity Type</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseU" class="collapse" data-parent="#accordion4">
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
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseV">
                                                                                <b>Location</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseV" class="collapse" data-parent="#accordion4">
                                                                                <div class="card-body">
                                                                                    <div class="meta_fltr">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom3" name="example1">
                                                                                            <label class="custom-control-label" for="custom3">Villas</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom2" name="example1">
                                                                                            <label class="custom-control-label" for="custom2">Places</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" id="custom4" name="example1">
                                                                                            <label class="custom-control-label" for="custom4">Hotels & Restaurants</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseW">
                                                                                <b>Experience</b>
                                                                              </a>
                                                                            </div>
                                                                            <div id="collapseW" class="collapse" data-parent="#accordion4">
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
                                                                </div>
                                                            </fieldset>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="main_cntnt_dash">
                                                        <div class="seler_card edit_prof_dash">
                                                            <div class="text-right log_btn">
                                                                <a href="{{url('/provider/changePassword')}}" class="btn btn_theme btn_edit"><span>Change Password</span></a>
                                                            </div>
                                                            <div class="cont_shd_frm">
                                                                <div class="row">
                                                                    <div class="col-sm-10 offset-1">
                                                                        <form class="editProfileForm" enctype="multipart/form-data" method="POST" action="{{url('/provider/editProfile')}}">
                                                                            <div class="text-center img_user">
                                                                                <div class="pos_rel pic_top">
                                                                                    <span class="img_edtt pos_rel">
                                                                                    
                                                                                        @if(Auth::check() && !empty(Auth::user()->profile_image) && file_exists(public_path('frontend/imgs/userProfile/'.Auth::user()->profile_image)))
                                                                                            <img src="{{asset('public/frontend/imgs/userProfile/'.Auth::user()->profile_image)}}" class="img-fluid" id="prof_ch">
                                                                                        @else
                                                                                            <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" id="prof_ch">
                                                                                        @endif
                                                                                        <span class="edt_inpt">
                                                                                            <i class="fa fa-edit"></i>
                                                                                            <input type="file" name="profile_image" class="file_img">
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group text-left">
                                                                                        <label>User Type</label>
                                                                                        <select disabled="" class="form-control custom-select" id="select_value">
                                                                                            @foreach($userTypes as $key => $userType)
                                                                                                <option @if($user['user_type_id']==$userType['id']) selected="" @endif value="{{$userType['id']}}" class="usertype">{{$userType['name']}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group text-left">
                                                                                    <label>Membership ID</label>
                                                                                    <input type="text"
                                                                                     name="membership_id" class="form-control" disabled="" placeholder="Membership ID" value="{{@$user['supplier_code']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                                
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group text-left">
                                                                            <label>Type of Entity</label>
                                                                            <!-- <input type="text" name="" class="form-control properties" value="{{@$user['user_property_detail']['name']}}" propertyId="{{@$user['user_property_detail']['id']}}" disabled=""> -->

                                                                            <!-- <select class="form-control custom-select" name="user_property_id" id="select_value">
                                                                                @foreach($userProperties as $key => $userProperty)
                                                                                    <option @if($user['user_property_id']==$userProperty['id']) selected="" @endif value="{{$userProperty['id']}}" class="userProperty">{{$userProperty['name']}}</option>
                                                                                @endforeach
                                                                            </select> -->
                                                                            <div class="row">
                                                                                @foreach($userProperties as $userProperty)    
                                                                                    <div class="col-sm-6">
                                                                                        <div class="custom-control custom-radio ">
                                                                                             <input type="radio" class="custom-control-input usr_prop" id="pe{{$userProperty['id']}}" @if($user['user_property_id']==$userProperty['id']) checked="" @endif propertyId="{{$userProperty['id']}}" name="user_property_id" value="{{$userProperty['id']}}">
                                                                                             <label class="custom-control-label" for="pe{{$userProperty['id']}}">{{$userProperty['name']}}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                          <!--     <input type="hidden" name="propertyid" class="propertyid" value="@$user['user_property_detail']['id']}}"> -->

                                                                  @if(@$userType['name']!='Seller')
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                            <label>Selected Services</label>
                                                                                @foreach($UserSelectedServices as $val)
                                                                                <?php $val=$val['user_service_detail'];?>
                                                                                    <div class="custom-control custom-checkbox"> 
                                                                                        <input type="checkbox" class="custom-control-input service" name="user_service_id[]" value="{{$val['id']}}" id="se{{$val['id']}}" checked="" disabled="">
                                                                                        <label class="custom-control-label" for="se{{$val['id']}}">{{$val['name']}}</label>
                                                                                    </div>
                                                                                @endforeach   
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                  @endif      

                                                                 @if(@$user['user_selected_other_detail']!=null)
                                                                      <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group text-left">
                                                                                <label>Selected other service</label>
                                                                                <input type="text" name="" class="form-control" value="{{@$user['user_selected_other_detail'][0]['name']}}" disabled="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif

                                                                    <div class="row">
                                                                       @if(@$user['user_type_detail']['name']!='Seller')
                                                                            <div class="col-sm-12">
                                                                                <label>Project Field</label><BR>
                                                                                <select class="form-control custom-select selc_fields" name="project_field_ids[]"  multiple="multiple">
                                                                                    @foreach($projectFields as $projectField) 

                                                                                        <option value="{{@$projectField['id']}}" @if(in_array($projectField['id'], $slcted_project_field_id))selected @endif >{{@$projectField['name']}}</option>
                                                                                
                                                                                    @endforeach
                                                                                </select>
                                                                                <label id="project_field_ids[]-error" class="error" for="project_field_ids[]"></label>
                                                                            </div>
                                                                       @endif
                                                                    </div><br>

                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <label class="experience_not_in_seller">Years of Experience</label><BR>
                                                                               <select name="experience" class="form-control custom-select">
                                                                                    <option value="" selected disabled class="select_list_change">Years of Experience</option>
                                                                                    @for($i=0; $i <=50 ; $i++)
                                                                                        <option @if($user['experience']==$experience) selected="" @endif value="{{$i}}">{{$i}}</option>
                                                                                    @endfor
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <br>


                                                                       @if($user['user_type_detail']['alias'] =='seller')
                                                                       <div class="form-group hideCategory">
                                                                           <label>Category</label>
                                                                           <select class="form-control category_id_class mul_category" name="category_id[]" multiple="multiple">
                                                                               @foreach($productCategories as $category) 
                                                                                   <option value="{{@$category->id}}" @if(in_array($category->id, $slcted_category_id))selected @endif >{{@$category->name}}</option>
                                                                               @endforeach
                                                                           </select>
                                                                           <label id="category_id[]-error" class="error" for="category_id[]"></label>
                                                                       </div>

                                                                       <div class="form-group hideSubCategory">
                                                                           <label>Sub Category</label>
                                                                           <select class="form-control mul_category sub_category_class changeSubCategory" name="sub_category_id[]" multiple="multiple">
                                                                               @foreach($productSubCategories as $subcategory)
                                                                                   <option value="{{@$subcategory->id}}" @if(in_array($subcategory->id, $slcted_Subcategory_id))selected @endif>{{@$subcategory->name}}</option>
                                                                                @endforeach

                                                                           </select>
                                                                           <label id="sub_category_id[]-error" class="error" for="sub_category_id[]"></label>
                                                                       </div>

                                                                       <div class="form-group hideMaterial">
                                                                           <label>Selling Material</label>
                                                                           <select class="form-control mul_category selling_material_class" name="material_id[]" multiple="multiple">
                                                                               @foreach($productSellingMaterial as $material)
                                                                                   <option value="{{@$material->id}}" @if(in_array($material->id, $slcted_material_id))selected @endif>{{@$material->selling_material_name}}</option>
                                                                                @endforeach

                                                                           </select>
                                                                           <label id="material_id[]-error" class="error" for="material_id[]"></label>
                                                                       </div>
                                                                       @endif


                                                                   
                                                                            <div class="row">
                                                                                <div class="col-sm-6 compny_name_hide">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Company Name</label>
                                                                                        <input type="text" name="company_name" class="form-control " placeholder="Company Name" value="{{@$user['company_name']}}">
                                                                                    </div>
                                                                                </div>

                                                                                  <div class="col-sm-3">
                                                                                    <div class="form-group text-left">
                                                                                        <label class="first_name_not_Freelance">Contact Name</label>
                                                                                        <input type="text" name="contact_name" class="form-control" placeholder="First Name" value="{{@$user['contact_name']}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <div class="form-group text-left">
                                                                                        <label class="last_name_not_Freelance" style="opacity: 0px;">last name</label>
                                                                                        <input type="text" name="contact_last_name" class="form-control" placeholder="Last Name" value="{{@$user['contact_last_name']}}">
                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div class="col-sm-6">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Contact Name</label>
                                                                                        <input type="text" name="contact_name" class="form-control" placeholder="Contact Name" value="{{@$user['contact_name']}}">
                                                                                    </div>
                                                                                </div> -->
                                                                            </div>

                                                                            <!-- <div class="row">
                                                                               <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                    <label>Supplier Code</label>
                                                                                    <input type="text"
                                                                                     name="supplier_code" class="form-control" disabled="" placeholder="Supplier Code" value="{{@$user['supplier_code']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->

                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label class="cr_Number_not_Freelance">Cr Number</label>
                                                                                        <input type="text"
                                                                                         name="cr_number" class="form-control cr_placeholder" placeholder="Enter CR number" value="{{@$user['cr_number']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                         
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Contact Number</label>
                                                                                        <input type="text" name="" disabled="true" class="form-control" placeholder="Contact Number" value="{{@$user['isd_code']}} {{@$user['mobile_no']}}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                      <label>Landline</label>
                                                                                        <input type="tel" name="landline" class="form-control" placeholder="Landline" value="{{@$user['landline_isd_code']}} {{@$user['landline']}}" id="phone">
                                                                                        <input type="hidden" class="form-control" name="landline_isd_code" id="isd_code" value="{{ltrim(@$user['landline_isd_code'], @$user['landline_isd_code'][0])}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Email Address</label>
                                                                                        <input type="text" name="email" class="form-control" placeholder="Email Address" value="{{@$user['email']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row indv_dtl">
                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Nationality</label>
                                                                                        <!-- <input type="text" name="" class="form-control" placeholder="Nationality" value="{{@$user['country_detail']['name']}}"> -->
                                                                                        <select class="form-control custom-select" name="country_id">
                                                                                            <option value="" selected disabled>Choose Nationality </option>
                                                                                            @foreach($countries as $countr)
                                                                                                <option @if($countr['id']==$user['country_id']) selected="" @endif value="{{@$countr['id']}}">{{@$countr['name']}}</option>
                                                                                            @endforeach              
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Gender</label>
                                                                                        <!-- <input type="text" name="" class="form-control" placeholder="Gender" value="{{ucfirst(@$user['gender'])}}"> -->
                                                                                        <select class="form-control custom-select" name="gender" type="text" value="">
                                                                                            <option value="" selected disabled>Select Gender </option>
                                                                                            <option @if($user['gender']=='male') selected="" @endif value="male">Male </option>              
                                                                                            <option @if($user['gender']=='female') selected="" @endif value="female">Female </option>              
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Date of Birth</label>
                                                                                        <input type="text" name="date_of_birth" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" class="form-control datetimepicker-inpu" placeholder="Date of Birth">
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                        
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>About Us</label>          
                                                                                        <textarea class="form-control text-align:left" rows="4" name="about_me" placeholder="About me" required="">{{@$user['about_me']}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div> 


                                                                                     

                                                                 <?php  
                                            
                                                                    if (!empty($user['profile_document'])) {
                                                                      
                                                                        if (file_exists(providerDocBasePath.'/'.$user['profile_document'])) {
                                                                            $image = 'fa fa-file-pdf-o';
                                                                        }else{
                                                                            $image = defaultImagePath;
                                                                        }
                                                                    }else{
                                                                        $image = defaultImagePath;
                                                                    }
                                                                ?>
                                                            
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Profile document</label>
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input user-img-first" id="botonAjax_first" name="profile_document" value="{{$user['profile_document']}}">
                                                                                <label class="custom-file-label" for="customFile">{{$user['profile_document']}}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group text-left">
                                                                            <label>Profile Link</label>
                                                                            <input type="text" name="profile_link" class="form-control" placeholder="Profile Link" value="{{$user['profile_link']}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    


                                                                  <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Photos Gallery</label>
                                                                                    <div class="drop_area">
                                                                                        <div class="form-group" id="data_section_8">
                                                                                            <!-- certificate dropzone -->
                                                                                            <div class="drop_post_files dropzone dz-clickable" id="my-dropzone">             
                                                                                                <div class="dz-default dz-message">
                                                                                                    <span>Photos</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- certificate dropzone -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="media_ids" id="image_ids" value="">
                                                                        <input type="hidden" name="imageCount" id="imageCount" value="{{$imageCount}}">

                                                                        
                                                                        <!-- ////////////////Brand Image////////////// -->


                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Add Brands / Trademark</label>
                                                                                    <div class="drop_area">
                                                                                        <div class="form-group" id="data_section_9">
                                                                                            <div class="drop_brand_files dropzone dz-clickable1" id="my-dropzone-brand">             
                                                                                                <div class="dz-default dz-message">
                                                                                                    <span>Photos</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="brand_ids" id="brand_ids" value="">
                                                                        <input type="hidden" name="brandimageCount" id="brandimageCount" value="{{$brandimageCount}}">


                                                                        <!-- $brandimageCount -->
                                                                        <!-- //////////////////////////////////////// --> 
                          
                                                                        <!--                                                                             @if($user['user_type_detail']['alias'] == 'seller')
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Supplier Code</label>
                                                                                        <input type="text" name="supplier_code" class="form-control" placeholder="" value="{{@$user['supplier_code']}}" readonly="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif -->
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Website URL</label>
                                                                                        <div class="input-group mb-3">
                                                                                            <input type="text" name="website_url" class="form-control" placeholder="https://www.example.com" value="{{@$user['website_url']}}">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text"><i class="fa fa-link"></i></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <label id="website_url-error" class="error" for="website_url"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <!-- <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Main Address</label>
                                                                                        <input type="text" name="address_line_1" class="form-control mb-3" placeholder="Address Line 1, Building, Floor" value="{{@$user['address_line_1']}}">
                                                                                        <input type="text" name="address_line_2" class="form-control mb-3" placeholder="Address Line 2, Office Number" value="{{@$user['address_line_2']}}">
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <div class="form-group">
                                                                                                <input type="tel" name="postal_code" class="form-control" placeholder="postal code" value="{{@$user['postal_code']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                         <div class="col-sm-4">
                                                                                            <div class="form-group">
                                                                                              <select class="form-control custom-select" name="country_id" type="text" value="">
                                                                                            <option selected disabled>Select Country Name</option>                          
                                                                                            @foreach($countries as $country)
                                                                                              <option @if($user['country_id']==$country['id']) selected="" @endif value="{{@$country['id']}}">{{@$country['name']}}</option>
                                                                                            @endforeach
                                                                                               
                                                                                         </select>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="col-sm-4">
                                                                                            <div class="form-group">
                                                                                                <input type="text" name="city" class="form-control" placeholder="City" value="{{@$user['city']}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <input type="text" name="location" class="form-control" placeholder="Choose location from Map" value="{{@$user['location']}}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28900.22947607954!2d55.117153479588616!3d25.117811021706277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f152a683c0d79%3A0x546802ab643feb7f!2sThe%20Palm%20Jumeirah%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1593162628612!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->

                                                                            <!-- <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group text-left">
                                                                                        <label>Address</label>
                                                                                        <input type="text" name="address1" class="form-control mb-3" placeholder="Address Line 1, Building, Floor">
                                                                                        <input type="text" name="address2" class="form-control mb-3" placeholder="Address Line 2, Office Number">
                                                                                        <input type="tel" name="number" class="form-control" placeholder="Contact Number">
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->
                                                                            <!-- <div class="form-group text-left">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                                                    <label class="custom-control-label" for="customCheck">I agree to the Terms & Conditions.</label>
                                                                                </div>
                                                                            </div> -->
                                                                            <div class="form-group">
                                                                                <div class="text-right log_btn">
                                                                                    <a href="javascript:;" class="btn btn_theme edt_prof_sbmt_btn"><span>Update Changes</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                         <input type="hidden" class="useridd" name="userid" value="{{@$user['id']}}">
                                                                    </div>
                                                                </div>
                                                                  <input type="hidden" name="profile_document" class="profile_document" value="{{@$user['profile_document']}}">
                                                            </div>
                                                            <input type="hidden" name="userTypename" class="userTypename" value="{{@$user['user_type_detail']['id']}}">

                                                                                                                         
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                </div>
            </div>
        </div>
        <input type="hidden" name="date" value="{{ date('m/d/Y',strtotime($user['date_of_birth'])) }}" id="date_of_birth_new">

        <input type="hidden" name="" class="user_Type_Idd" value="{{$user['user_property_detail']['user_type_id']}}">
    </section>
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


<script>
    $(document).on('change', '.category_id_class', function(){
        categoryId = $(this).val();
        $.ajax({
            url:"{{url('provider/profile/get/subcategoryAndMaterialList')}}",
            data:{categoryId : categoryId},
            type:'POST',
            success:function(data) {
                $('.sub_category_class').html(data[0]);
                $('.selling_material_class').html(data[1]); 
            }
        })
    })

    
    $(document).on('change', '.changeSubCategory', function(){
        subCategoryId = $(this).val();
        $.ajax({
            url:"{{url('provider/get/subcategory/depends/MaterialList')}}",
            data:{subCategoryId : subCategoryId},
            type:'POST',
            success:function(data) {
                $('.selling_material_class').html(data); 
            }
        })
    })


</script>

<script>
    $(document).ready(){
        
    var user_Type_Iddd = $('.user_Type_Idd').val(); 
    // alert(user_Type_Iddd);
        if(user_Type_Iddd=6){
             $('.experience_not_in_seller').text('Years in Buisness');
             $('.select_list_change').text('Years in Buisness');
        }else{
             $('.experience_not_in_seller').text('Experience');
             $('.select_list_change').text('Years of Experience');
        }
    }

    var userTypeId = $('.userTypename').val();
    var userPropertId = $('.usr_prop:checked').val();
    var userProp;
    if (userPropertId==2 || userPropertId==7 || userPropertId==10) {
        $('.indv_dtl').show();
    }else{
        $('.indv_dtl').hide();
        
       

    }

    $("body").on('change','.usr_prop',function(){
        userPropertId = $(this).val();
        if (userPropertId==2 || userPropertId==7 || userPropertId==10) {
            $('.indv_dtl').show();
        }else{
            $('.indv_dtl').hide();
        }

        if(userPropertId==2){
             $('.first_name_not_Freelance').text('Designer Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Identification Number');  
             $('.cr_placeholder').attr('placeholder','Identification Number'); 
             $('.compny_name_hide').hide();
         }else if(userPropertId==7){
             $('.first_name_not_Freelance').text('Contractor Name');
             $('.last_name_not_Freelance').css('opacity', '0');;
             $('.cr_Number_not_Freelance').text('Identification Number');
             $('.cr_placeholder').attr('placeholder','Identification Number'); 
             $('.compny_name_hide').hide();

         }else if(userPropertId==10){
             $('.first_name_not_Freelance').text('Consultant Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Identification Number');
             $('.cr_placeholder').attr('placeholder','Identification Number'); 
             $('.compny_name_hide').hide();

         }else{
              $('.first_name_not_Freelance').text('Contact Name');
              $('.last_name_not_Freelance').css('opacity', '0');
              $('.cr_Number_not_Freelance').text('Cr Number');
              $('.cr_placeholder').attr('placeholder','Cr Number');
              $('.compny_name_hide').show();
         }
    });

        if(userPropertId==2){
             $('.first_name_not_Freelance').text('Designer Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Identification Number');  
             $('.cr_placeholder').attr('placeholder','Identification Number'); 
             $('.compny_name_hide').hide();
         }else if(userPropertId==7){
             $('.first_name_not_Freelance').text('Contractor Name');
             $('.last_name_not_Freelance').css('opacity', '0');;
             $('.cr_Number_not_Freelance').text('Identification Number');
             $('.cr_placeholder').attr('placeholder','Identification Number'); 
             $('.compny_name_hide').hide();

         }else if(userPropertId==10){
             $('.first_name_not_Freelance').text('Consultant Name');
             $('.last_name_not_Freelance').css('opacity', '0');
             $('.cr_Number_not_Freelance').text('Identification Number');
             $('.cr_placeholder').attr('placeholder','Identification Number'); 
             $('.compny_name_hide').hide();

         }else{
              $('.first_name_not_Freelance').text('Contact Name');
              $('.last_name_not_Freelance').css('opacity', '0');
              $('.cr_Number_not_Freelance').text('Cr Number');
              $('.cr_placeholder').attr('placeholder','Cr Number');
              $('.compny_name_hide').show();
         }   

   // alert(userTypeId);
       // if(userTypeId=='3'){
       //      $('.first_name_not_Freelance').text('Designer  Name');
       //      $('.last_name_not_Freelance').css('opacity', '0');
       //      $('.cr_Number_not_Freelance').text('Identification Number');
       //      $('.cr_placeholder').attr('placeholder','Identification Number');

       //  }else if(userTypeId=='4'){
       //      $('.first_name_not_Freelance').text('Contractor Name');
       //      $('.last_name_not_Freelance').css('opacity', '0');
       //      $('.cr_Number_not_Freelance').text('Identification Number');
       //      $('.cr_placeholder').attr('placeholder','Identification Number');

       //  }else if(userTypeId=='5'){
       //      $('.first_name_not_Freelance').text('Consultant Name');
       //      $('.last_name_not_Freelance').css('opacity', '0');
       //      $('.cr_Number_not_Freelance').text('Identification Number');
       //      $('.cr_placeholder').attr('placeholder','Identification Number');

       //  }else{
       //      $('.first_name_not_Freelance').text('Contact Name');
       //      $('.last_name_not_Freelance').css('opacity', '0');
       //      $('.cr_Number_not_Freelance').text('Cr Number');
       //      $('.cr_placeholder').attr('placeholder','Cr Number');

       //  }

     // var productId= $('.properties').attr('propertyId');
     // var productId= $('.usr_prop').attr('propertyId');
     // alert(productId)


     
       // if(userPropertId=='2'){
       //      $('.first_name_not_Freelance').text('Designer Name');
       //      $('.last_name_not_Freelance').css('opacity', '0');
       //      $('.cr_Number_not_Freelance').text('Identification Number');  
       //      $('.cr_placeholder').attr('placeholder','Identification Number'); 
       //      $('.compny_name_hide').hide();
       //  }else if(userPropertId=='7'){
       //      $('.first_name_not_Freelance').text('Contractor Name');
       //      $('.last_name_not_Freelance').css('opacity', '0');;
       //      $('.cr_Number_not_Freelance').text('Identification Number');
       //      $('.cr_placeholder').attr('placeholder','Identification Number'); 
       //      $('.compny_name_hide').hide();

       //  }else if(userPropertId=='10'){
       //      $('.first_name_not_Freelance').text('Consultant Name');
       //      $('.last_name_not_Freelance').css('opacity', '0');
       //      $('.cr_Number_not_Freelance').text('Identification Number');
       //      $('.cr_placeholder').attr('placeholder','Identification Number'); 
       //      $('.compny_name_hide').hide();

       //  }else{
       //       $('.first_name_not_Freelance').text('Contact Name');
       //       $('.last_name_not_Freelance').css('opacity', '0');
       //       $('.cr_Number_not_Freelance').text('Cr Number');
       //       $('.cr_placeholder').attr('placeholder','Cr Number');
       //       $('.compny_name_hide').show();
       //  }

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script type="text/javascript">
    var review_image_ids=[];
    var drop_img_count = $('.dz-image').length;
    var user_id= $('.useridd').val();
  // Dropzone.autoDiscover = false;
    Dropzone.autoDiscover = true;
    var limit_of_image = 5;

    var myDropzone  =   $('#my-dropzone').dropzone({
        // Dropzone.options.myDropzone = {
            autoProcessQueue: true, /*to make it hit url on click of btn or event value='false'*/
            maxFiles: 5,
            maxFilesize: 3,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            parallelUploads: 5,
            params: {
                user_id:user_id,
                // type:'product',
            },
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            type: "POST",
            // url: "{{url('service-provider/image/add/product?user_id=')}}"+user_id,
            renameFile: function (file) {
                var newName = new Date().getTime() + '_' + file.name;
                return newName;
            },

            url:"{{url('provider/add/dropzone/image')}}",
            init: function () {                 /*initialize dropzone on click of btn or any action*/

                var myDropzone = this;
                // Update selector to match your button
                $(this).click(function (e) {
                    e.preventDefault();
                    alert(myDropzone.getQueuedFiles().length);
                    if (myDropzone.getQueuedFiles().length > 0) {    
                        myDropzone.processQueue();
                        // $("#img_section").append(image)
                    } else {
                        $('#my-dropzone').closest('span>label').html('Please upload atleast one image');
                        swal("Error","Please upload a file.","error");
                    }
                });

                // to show previous images
                    var myDropzone = this;        
                    var fullurl='{{ providerImgsPath }}';  
                    $.get('{{url('provider/image/edit/')}}'+'/'+ user_id, function(data) {
                        $.each(data.images, function (key, value) {
                            var file = {name: value.image , size: value.size };  
                            myDropzone.options.addedfile.call(myDropzone, file);
                            myDropzone.options.thumbnail.call(myDropzone, file, fullurl + '/'+value.image);
                            myDropzone.emit("complete", file);
                        });
                    });  
                // end to show previous images

               this.on("removedfile", function(file) {
                    var file_id = file.stored_id;
                    var filename = file.name;
                    $(".preloader").show();
                    $.ajax({
                       url: "{{ url('provider/image/remove') }}",
                        type: "POST",
                        data: {file_id: file_id,filename:filename,user_id:user_id},
                        success:function(resp){
                            drop_img_count--;
                            $(".preloader").hide();
                        }
                    });

                    review_image_ids = jQuery.grep(review_image_ids, function(value) {
                      return value != file_id;
                    });
                            
                    $('#review_image_ids').val(review_image_ids);
                });

                this.on('success',function(file, resp){
                    file.stored_id = resp.img_id;
                    review_image_ids.push(resp.img_id);
                    $('#review_image_ids').val(review_image_ids);
                    drop_img_count++;
                });

                this.on("addedfile", function(file) {
                    // alert(drop_img_count);
                    if(drop_img_count >= limit_of_image){
                        myDropzone.removeFile(file);
                        swal('Maximum 5 files can be uploaded');
                    }                
                });
            }
        // }
      });      
</script>


 <!-- //////////////////////////////////////////////////// -->

 <script type="text/javascript">
     var review_image_ids1=[];
     var drop_img_count1 = $('.dz-image1').length;
     var user_id= $('.useridd').val();

     // Dropzone.autoDiscover = true;
       Dropzone.autoDiscover = false;
     var limit_of_image = 5;
     var myDropzone_brand  =   $('#my-dropzone-brand').dropzone({
     // Dropzone.options.myDropzone_brand = {
         autoProcessQueue: true, /*to make it hit url on click of btn or event value='false'*/
         maxFiles: 5,
         maxFilesize: 3,
         addRemoveLinks: true,
         acceptedFiles: 'image/*',
         parallelUploads: 5,
         params: {
             user_id:user_id,
             // type:'product',
         },
         headers: {
           'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
         type: "POST",
         // url: "{{url('service-provider/image/add/product?user_id=')}}"+user_id,
         renameFile: function (file) {
             var newName = new Date().getTime() + '_' + file.name;
             return newName;
         },

         url:"{{url('provider/add/dropzone/Brand/image')}}",
         init: function () {                 /*initialize dropzone on click of btn or any action*/

             var myDropzone_brand = this;
             // Update selector to match your button
             $(this).click(function (e) {
                 e.preventDefault();
                 // alert(myDropzone_brand.getQueuedFiles().length);
                 if (myDropzone_brand.getQueuedFiles().length > 0) {    
                     myDropzone_brand.processQueue();
                     // $("#img_section").append(image)
                 } else {
                     $('#my-dropzone-brand').closest('span>label').html('Please upload atleast one image');
                     swal("Error","Please upload a file.","error");
                 }
             });

             // to show previous images
                 var myDropzone_brand = this;        
                 var fullurl='{{ providerBrandImgsPath }}';  
                 $.get('{{url('provider/dropzone/Brand/image/edit/')}}'+'/'+ user_id, function(data) {
                     $.each(data.images, function (key, value) {
                         var file = {name: value.image , size: value.size };  
                         myDropzone_brand.options.addedfile.call(myDropzone_brand, file);
                         myDropzone_brand.options.thumbnail.call(myDropzone_brand, file, fullurl + '/'+value.image);
                         myDropzone_brand.emit("complete", file);
                     });
                 });  
             // end to show previous images

            this.on("removedfile", function(file) {
                 var file_id = file.stored_id;
                 var filename = file.name;
                 $(".preloader").show();
                 $.ajax({
                    url: "{{ url('provider/dropzone/Brand/image/remove') }}",
                     type: "POST",
                     data: {file_id: file_id,filename:filename,user_id:user_id},
                     success:function(resp){
                         drop_img_count1--;
                         $(".preloader").hide();
                     }
                 });

                 review_image_ids1 = jQuery.grep(review_image_ids1, function(value) {
                   return value != file_id;
                 });
                         
                 $('#review_image_ids1').val(review_image_ids1);
             });

             this.on('success',function(file, resp){
                 file.stored_id = resp.img_id;
                 review_image_ids1.push(resp.img_id);
                 $('#review_image_ids1').val(review_image_ids1);
                 drop_img_count1++;
             });

             this.on("addedfile", function(file) {
                 // alert(drop_img_count1);
                 if(drop_img_count1 >= limit_of_image){
                     myDropzone_brand.removeFile(file);
                     swal('Maximum 5 files can be uploaded');
                 }                
             });
         }
     // }  
       });    
 </script>


<script type="text/javascript">
    $('.file_img').on('change', function () {
      var input = this;
        var reader = new FileReader();
        reader.onload = function(){
          var dataURL = reader.result;
         var output = document.getElementById('prof_ch');
          output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

      var prop = $('.properties').attr('propertyId');
      // alert(prop);
        
        $('.editProfileForm').validate({
            ignore:[],
            rules:{
                user_type_id:{
                    required:true,
                },
                user_property_id:{
                    required:true,
                    maxlength:50,
                    // regex:name_regex, 
                    noSpace:true,
                },
                user_service_id:{
                    required:true,
                    maxlength:50,
                    noSpace:true,
                },


                experience:{
                    required: {
                        depends: function(element){
                         
                            if (  $('.userTypename').val()=='6') {
                                    return false;
                            } else {
                                    return true;
                            }
                        }
                    },
                },
                "project_field_ids[]":{
                    // required:true
                    required: {
                        depends: function(element){
                            // alert($('.ths_slct').val());
                            if (  $('.userTypename').val()=='6') {
                                    return false;
                            } else {
                                    return true;
                            }
                        }
                    },
                },

                 company_name:{
                      required: {
                            depends: function(element){
                             
                            if (  prop=='2' ||  prop=='7'|| prop=='10') {
                                    return false;
                            } else {
                                    return true;
                            }
                        }
                    },
                },
                contact_name:{
                    required:true,
                    maxlength:100,
                },
                contact_last_name:{
                    required:true,
                    maxlength:100,
                },
                mobile_no:{
                    required:true,
                    number:true,
                    minlength:7,  
                    maxlength:15, 
                    remote: "{{url('/checkUserMobile')}}",
                },
                email:{
                    required:true,
                    maxlength:100,
                    regex: email_regex,
                    remote: "{{url('/checkUserEmail')}}"+"?user_id={{base64_encode($user['id'])}}",
                },

                 about_me:{
                   required:true,
                   maxlength:300,
                },

            //     profile_document: {
            //         required: {
            //             depends: function(element){
                         
            //             if ($('.profile_document').val()== '') {
            //                     return true;
            //             } else {
            //                     return false;
            //             }
            //         }
            //     },

            // },


                // profile_link:{
                //    required:true,
                //    maxlength:300,
                // },

                password:{
                    required:true,
                    minlength:6,
                    maxlength:50,
                },
                confirm_password:{
                    required:true,
                    equalTo:"#password",
                },

                "category_id[]":{
                   required:true,
                },

                "material_id[]":{
                   required:true,
                },

                cr_number:{
                    required:true,
                },
                website_url:{
                    required:true,
                    url: true,
                    normalizer: function( value ) {
                        var url = value;                 
                        // Check if it doesn't start with http:// or https:// or ftp://
                        if ( url && url.substr( 0, 7 ) !== "http://"
                            && url.substr( 0, 8 ) !== "https://"
                            && url.substr( 0, 6 ) !== "ftp://" ) {
                            // then prefix with http://
                            url = "http://" + url;
                        }                 
                        // Return the new url
                        return url;
                    }
                },
               
                address_line_1:{
                    required:true,
                },
                address_line_2:{
                    required:true,
                },
                landline:{
                    required:true,
                    number:true,
                    minlength:7,
                },
                // country_id:{
                //     required:true,
                // },
                country_id:{
                    required: {
                        depends: function(element){
                         
                            if (  $('input[name=user_property_id]:checked').val()=='2' ||  $('input[name=user_property_id]:checked').val()=='7'|| $('input[name=user_property_id]:checked').val()=='10') {
                                    return true;
                            } else {
                                    return false;
                            }
                        }
                    },
                },
                gender:{
                    required: {
                        depends: function(element){
                         
                            if (  $('input[name=user_property_id]:checked').val()=='2' ||  $('input[name=user_property_id]:checked').val()=='7'|| $('input[name=user_property_id]:checked').val()=='10') {
                                    return true;
                            } else {
                                    return false;
                            }
                        }
                    },
                },
                date_of_birth:{
                    required: {
                        depends: function(element){
                         
                            if (  $('input[name=user_property_id]:checked').val()=='2' ||  $('input[name=user_property_id]:checked').val()=='7'|| $('input[name=user_property_id]:checked').val()=='10') {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                },
                postal_code:{
                    required:true,
                    number:true,
                    // minlength:,
                }, 
                city:{
                    required:true,
                },
                location:{
                    required:true,
                },

                terms_conditions:{
                    required:true,
                }
                //   checked:{
                //     required:true
                // }
            },
            messages:{

                user_type_id:{
                    required:"Please select user type",
                },
                user_property_id:{
                    required:"Please select property",
                },
                user_service_id:{
                    required:"Please select service",
                },

                experience:{
                    required:"Please select Years in Business"
                },
                "project_field_ids[]":{
                    required:"Please choose project fields"
                },     

                "category_id[]":{
                   required:"Please select category_id[]",
                },

                "material_id[]":{
                    required:"Please select material_id[]",
                },

                                
                company_name:{
                    required:"Please enter Company name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
                },
                contact_name:{
                    required:"Please enter first name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
                },
               contact_last_name:{
                    required:"Please enter last name",
                    maxlength:"Maximum 50 characters are allowed",
                    regex:"Name can only consist of alphabets",
                }, 
                mobile_no:{
                    required:"Please enter contact number",
                    minlength:"Minimum 7 characters are allowed",
                    maxlength:"Maximum 15 characters are allowed",
                    remote: 'Contact number already registered',
                },
                email:{
                    required:"Please enter email",
                    maxlength:"Maximum 100 characters are allowed",
                    regex: "Please enter valid email address",
                    remote: 'Email-id already registered',
                },
                about_me:{
                  required:"Please enter about yourself",
                   maxlength:"Maximum 200 characters are allowed",
                }, 
                // profile_document:{
                //   required:"Please select profile document",
                // },
                
                // profile_link:{
                //   required:"Please enter profile link",
                // },

                password:{
                    required:"Please enter password",
                    maxlength:"Maximum 50 characters are allowed",
                    minlength:"Password must contain atleast 6 characters",
                },
                confirm_password:{
                    required: "Please re-enter password",
                    equalTo: "Confirm password did not match with password",
                },
                cr_number:{
                    required:"This field is required",
                },
                website_url:{
                    required:"Please enter website url",
                         minlength:"Minimum 7 characters are allowed",
                    maxlength:"Maximum 15 characters are allowed",
                },
                additional_information:{
                    required:"Please enter additional information",
                },
                address_line_1:{
                    required:"Please enter address line 1",
                },
                address_line_2:{
                    required:"Please enter address line 2",
                },
                landline:{
                    required:"Please enter landline number",
                },
                postal_code:{
                    required:"Please enter postal code",
                },
                country_id:{
                    required:"Please select nationality",
                },           
                gender:{
                    required:"Please select gender",
                },            
                date_of_birth:{
                    required:"Please select date of birth",
                },
                city:{
                    required:"Please enter city",
                },
                location:{
                    required:"Please enter location",
                },
                 terms_conditions:{
                    required:"Please agree terms & conditions",
                }
             },

             errorPlacement: function(error, element) {
      
                if (element.attr("name") == "terms_conditions") {
                    error.insertAfter('#terms_conditions_id');
                } else {
                    error.insertAfter(element);
                }                             
            },


        });
        $('.editProfileForm').validate({
            ignore:[],
            rules:{
                first_name:{
                    required:true,
                    maxlength:50,
                    noSpace:true
                },
                last_name:{
                    required:true,
                    maxlength:50,
                    noSpace:true
                },
                email:{
                    required:true,
                    maxlength:100,
                    regex: email_regex,
                    remote: "{{url('/checkUserEmail')}}"+"?user_id={{base64_encode($user['id'])}}",
                },
                institution_name: {
                    // required: {
                    //     depends: function () {
                    //         return $('.usr_type_cls').val() == "2";
                    //     }
                    // },
                    required:true,
                    maxlength:50
                },
            },
            messages:{
                first_name:{
                    required:"Please enter first name",
                    maxlength:"Maximum 50 characters are allowed",
                },
                last_name:{
                    required:"Please enter last name",
                    maxlength:"Maximum 50 characters are allowed",
                },               
                institution_name:{
                    required:"Please enter institution name",
                    maxlength:"Maximum 50 characters are allowed",
                },
                email:{
                    required:"Please enter email",
                    maxlength:"Maximum 100 characters are allowed",
                    regex: "Please enter valid email address",
                    remote: 'Email-id already registered',
                }, 
            }
        });

        $("body").on('click','.edt_prof_sbmt_btn',function(e){
            e.preventDefault();

               $('.editProfileForm').submit();
                // }
        });
    });
</script>
<script type="text/javascript">
    var dateOfBirth = "{{@$user['date_of_birth']}}";
    var selectedDate;
    // alert("{{@$reqForProposal['questions_submission_deadline_date']}}");
    if (dateOfBirth!=null && dateOfBirth!="") {
        selectedDate = "{{date('m/d/Y', strtotime(@$user['date_of_birth']))}}";
    }else{
        selectedDate = "{{date('m/d/Y', strtotime(date('Y-m-d')))}}";
        // alert(quesSub);  
    }
    // alert(selectedDate);
    $('#datetimepicker5').datetimepicker({
        // maxDate: moment(),
        // formatDate:'Y/m/d',
        format: 'L',
        // endDate: '0d'
        defaultDate: selectedDate,
        // options.minDate: true,
        // ignoreReadonly: true
    });
</script>
<!-- Multiple select -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".selc_fields").select2({
            placeholder: "Choose from List"
        });
    });
</script>
@stop