@extends('frontend.layout.providerLayout')
@section('title','Track All RFPs Request')
@section('content')
<style type="text/css">
    .tabl_allrfp_botm td:nth-child(4),td:nth-child(5){
        padding: 0;
    }
    .tabl_allrfp_botm td:nth-child(4) > span,td:nth-child(5) > span{
        padding: 9px 10px 0;
        display: block;
        height: 40px;
        color: #fff;
    }
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
                            <h3>All Request For Proposals (All RFPs)</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">All RFPs</a></li>
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
                                            <div class="custom_container">
                                                <div class="wrp_allrfp_req">
                                                    <!-- <div class="fltr_topp d-flex align-items-center">
                                                        <div class="section-heading">
                                                            <span>All RFP Request</span>
                                                            <h2>Track All RFP's Quotations</h2>
                                                        </div>
                                                    </div> -->
                                                    <div class="fltr_topp d-flex justify-content-end align-items-center mb-3">
                                                        <div class="btn_right text-right">
                                                            <a href="{{url('/provider/export/trackRFPRequestListExport')}}">
                                                                <button class="btn btn_theme" type="button"><span>Download Excel</span></button>                                                                
                                                            </a>
                                                        </div>
                                                        <!-- <div class="dropdown">
                                                            <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-sort"></i>&nbsp;Sort
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="javascript:;">User Name Ascending</a>
                                                                <a class="dropdown-item" href="javascript:;">User Name Descending</a>
                                                                <a class="dropdown-item" href="javascript:;">RFQ Name Ascending</a>
                                                                <a class="dropdown-item" href="javascript:;">RFQ Name Descending</a>
                                                                <a class="dropdown-item" href="javascript:;">RFQ Price High to Low</a>
                                                                <a class="dropdown-item" href="javascript:;">RFQ Price Low to High</a>
                                                                <a class="dropdown-item" href="javascript:;">Recent Submission Date</a>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="table_all_rfp_data">
                                                        <div class="table-responsive">
                                                            <table class="table tabl_allrfp_botm table-bordered" id="rfpTable">
                                                                <thead class="non_edtble">
                                                                    <tr>
                                                                        <th colspan="2">Reference</th>
                                                                        <!-- <th rowspan="2">Category</th> -->
                                                                        <th rowspan="2">Type of Services</th>
                                                                        <th colspan="2">Status of RFP</th>
                                                                        <th colspan="2">Date of Invitation</th>
                                                                        <th colspan="2">Quotation Submision Deadline</th>
                                                                        <th colspan="3">From (Client)</th>
                                                                        <!-- <th colspan="3">To (Service Provider)</th> -->
                                                                        <th rowspan="2">Project Name</th>
                                                                        <th rowspan="2">Project No.</th>
                                                                        <th rowspan="2">Project Location</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Request Title</th>
                                                                        <th>RFQ ID</th>
                                                                        <th>Client Side</th>
                                                                        <th>Provider Side</th>
                                                                        <th>Date</th>
                                                                        <th>Days since invitation</th>
                                                                        <th>Date</th>
                                                                        <th>Remaining Days</th>
                                                                        <th>Contact Name</th>
                                                                        <th>Contact Number</th>
                                                                        <th>Email</th>
                                                                        <!-- <th>Contact Name</th>
                                                                        <th>Contact Number</th>
                                                                        <th>Email</th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- <tr>
                                                                        <td>MM-DS-0001</td>
                                                                        <td>2</td>
                                                                        <td>MM-DS-0001-2</td>
                                                                        <td>Consultant</td>
                                                                        <td>Wooden Design</td>
                                                                        <td class="bg-danger">Under Bidding by vendor</td>
                                                                        <td>17/04/2019</td>
                                                                        <td>4</td>
                                                                        <td>12/11/2017</td>
                                                                        <td>7</td>
                                                                        <td>29/09/2018</td>
                                                                        <td>-5</td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                        <td class="dbl_clk_edt">
                                                                            <input type="text" class="form-control" readonly/>
                                                                        </td>
                                                                    </tr> -->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
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
    </section>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $(function() {
            var t = $('#rfpTable').DataTable({
                processing: true,
                serverSide: true,
                order: [ [0, 'desc'] ],
                ajax: '{{url('/provider/trackAllRFPs/index')}}',
                columns: [
                    { data: 'request_title', name: 'request_for_proposals.request_title' },
                    { data: 'rfq_id', name: 'rfq_id' },
                    // { data: 'user_type', name: 'user_types.name' },
                    { data: 'type_of_services', name: 'type_of_services' },
                    { data: 'request_proposal_status', name: 'request_proposal_status' },
                    { data: 'request_status', name: 'request_status' },
                    { data: 'invitation_date', name: 'invitation_date' },
                    { data: 'since_days', name: 'since_days' },
                    { data: 'submission_date', name: 'submission_date' },
                    { data: 'remaining_days', name: 'remaining_days' },
                    { data: 'user_contact_name', name: 'user_contact_name', searchable: false },
                    { data: 'user_contact_number', name: 'user_contact_number', searchable: false },
                    { data: 'user_email', name: 'request_users.email' },
                    // { data: 'provider_contact_name', name: 'provider_contact_name', searchable: false },
                    // { data: 'provider_contact_number', name: 'provider_contact_number', searchable: false },
                    // { data: 'provider_email', name: 'assign_users.email' },
                    { data: 'project_name', name: 'request_for_proposals.project_name' },
                    { data: 'project_no', name: 'request_for_proposals.project_no' },
                    { data: 'project_location', name: 'project_location', searchable: false },
                ],
                // initComplete: function () {
                //     this.api().columns().every(function () {
                //         $('.searchable_table thead').after($('.searchable_table tfoot tr'))
                //         var column = this;
                //         var input = document.createElement("input");
                //         input.className = "tr_tfoot_input"
                //         $(input).appendTo($(column.footer()).empty())
                //         .on('keyup', function () {
                //             column.search($(this).val(), false, false, true).draw();
                //         });
                //     });
                // },
                // fnDrawCallback: function(){
                //     $('.status_button_toggle').each(function(i, e){
                //         // console.log($(this).attr('rel'));
                //         var attr_rel = $(this).attr('rel');
                //         var attr_ral = $(this).attr('ral');
                //         var attr_id = $(this).attr('id');
                //         $('#'+attr_id).btnSwitch({
                //             Theme: 'Light',
                //             ToggleState: attr_rel == 'active' ? true : false,
                //             OnCallback: function(val) {
                //                 changeStatus('active',attr_ral);
                //             },
                //             OffCallback: function(val) {
                //                 changeStatus('inactive',attr_ral);
                //             },
                //         });
                //     });
                // }
            });
        });



    });
</script>
@stop