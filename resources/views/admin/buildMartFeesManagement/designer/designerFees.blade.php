@extends('admin.layout.adminLayout')
@section('title','Build Mart Fees')
@section('content')

@include('admin.include.header')
    <!-- Sidebar menu-->
@include('admin.include.sidebar')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Build Mart Fees Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="javascript:;">Build Mart Fees Management</a></li>
                            <li><a href="javascript:;">Designer List</a></li>
                            <li class="active">Build Mart Fees</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <!-- <strong class="card-title">Build Mart Fees</strong> -->
                   <!--     <a href="{{url('admin/subscriptionManagement/addSubscription')}}" class="btn btn-outline-danger" style="float:right;">Add New User</a> -->
                       <!-- <a href="{{url('admin/export/provider-designerList')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a> -->
                    </div>
                    <div class="card-body">
	                    <div class="delvry_terms ordr-addr">
                          	<div class="delv-head">
                              	<h4> Build Mart Fees:</h4>
                          	</div>
                           	<form>
	                            <div class="row">
	                                <div class="col-lg-10 offset-lg-1 col-sm-12">
	                                    <div class="form-group fee_radio_btn radio_perc">
	                                        <div class="custom-control custom-radio mb-3">
	                                            <input type="radio" class="custom-control-input" id="customRadio_new17" name="fees_type" value="percentage">
	                                            <label class="custom-control-label" for="customRadio_new17">
		                                            <div class="form-group mb-0">
	                                                    <div class="discount_wrap price_field d-flex align-items-center">
		                                                    <div class="discount_wrap amt_fields price_field d-flex">
		                                                        <input type="text" name="" class="discount_amt form-control more_prc_inpt">
		                                                        <input type="hidden" class="disc_typ_cls" name="" value="percent" />
		                                                        <div class=" price_percnt text-center">
		                                                            <span class="disc_spv_dv active" type="percent">%</span>
		                                                            <span class="disc_spv_dv" type="amount">SR</span>
		                                                        </div>
		                                            		</div>
		                                            		<p class="m-0  ml-2">Percentage of any order amount</p>	
	                                                    </div>
	                                                </div>
	                                            </label>
	                                        </div>
	                                    </div>
	                                    <div class="form-group fee_radio_btn labl_amt d-flex justify-content-between align-items-center">
	                                       <div class="custom-control custom-radio">
	                                            <input type="radio"  class="custom-control-input" id="customRadio_new18" name="fees_type" value="lum_sum">
	                                            <label class="custom-control-label" for="customRadio_new18">Fee according to amount of order:</label>
	                                        </div>
	                                    </div>
	                                    <div class="add_btn mb-3">
	                                    	<p class="com_red text-right mb-0">
	                                            <span class="aapnd_ins text-center dlv_add">
	                                               <i class="fa fa-plus-circle  mr-1"></i>Add
	                                            </span>
	                                        </p>
	                                    </div>
	                                    <div class="del_fields">
                                            <div class="apnd_sec">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <input type="text" id="from_price_range_0" name="" value="" class="form-control from_price_range commonClass" placeholder="Amount Range From">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                          <input type="text" id="to_price_range_0" name="" value="" class="form-control to_price_range " placeholder="Amount Range To">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group ">
                                                          <!-- <label>Discount</label> -->
                                                            <div class="discount_wrap amt_fields price_field fees_fld d-flex">
                                                                <input type="text" name="" class="discount_amt form-control more_prc_inpt">
                                                                <input type="hidden" class="disc_typ_cls" name="" value="percent" />
                                                                <div class="price_percnt text-center">
                                                                    <span class="disc_spv_dv active" type="percent">%</span>
                                                                    <span class="disc_spv_dv" type="amount">SR</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group text-center"> 
                                                            <span class="apnd_val">Remove</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
	                                    </div>
	                                </div>
	                            </div>
		                        <div class="form-group text-center">
		                            <button type="button" id="save" class="cstm-azy-btn-red">Submit
		                            </button>
		                        </div>
	                      	</form>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script')

@stop