@extends('admin.layout.adminLayout')
@section('title',"Contractor's List")
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
                            <li class="active">Contractor's List</li>
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
                       <strong class="card-title">Contractor's List</strong>
                   <!--     <a href="{{url('admin/subscriptionManagement/addSubscription')}}" class="btn btn-outline-danger" style="float:right;">Add New User</a> -->
                       <!-- <a href="{{url('admin/export/provider/contractorList')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a> -->
                    </div>
                    <div class="card-body">
                       <table id="userList" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <!-- <th>User Type</th> -->
                                    <th>Company Name</th>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Assign Build Mart Fee</th>
                                    <th>Build Mart Fees Approve By Seller</th>
                                    <!-- <th>Status</th>
                                    <th>Transaction Status</th>
                                    <th>Certified Provider</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script')
<script>
    $(function() {
        var t = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/buildMartFees/contractorListIndex')}}',
            columns: [
                { data: 'DT_RowIndex',      name: 'id', searchable: false,  visible:true},
                // { data: 'user_type_name',   name: 'user_type_name'},
                { data: 'company_name',     name: 'company_name'},
                // { data: 'contact_name',     name: 'contact_name'},
                { data: 'contact_full_name',     name: 'contact_full_name'},
                { data: 'email',            name: 'email'},
                { data: 'mobile_no',        name: 'mobile_no'},
                { data: 'assigned_fees',        name: 'assigned_fees'},
                { data: 'build_mart_fees_approval',        name: 'build_mart_fees_approval'},
                // { data: 'status',           name: 'status', orderable: false }, 
                // { data: 'transaction_status', name: 'transaction_status', orderable: false }, 
                // { data: 'certified_provider', name: 'certified_provider', orderable: false }, 
                { data: 'action',           name: 'action', orderable: false },  
            ],

            initComplete: function () {
                this.api().columns().every(function () {
                    $('.searchable_table thead').after($('.searchable_table tfoot tr'))
                    var column = this;
                    var input = document.createElement("input");
                    input.className = "tr_tfoot_input"
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            },

            fnDrawCallback: function(){
                $('.status_button_toggle').each(function(i, e){
                    // console.log($(this).attr('rel'));
                    var attr_rel = $(this).attr('rel');
                    var attr_ral = $(this).attr('ral');
                    var attr_id = $(this).attr('id');
                    $('#'+attr_id).btnSwitch({
                        Theme: 'Light',
                        ToggleState: attr_rel == 'active' ? true : false,
                        OnCallback: function(val) {
                            changeStatus22('active',attr_ral);
                        },
                        OffCallback: function(val) {
                            changeStatus22('inactive',attr_ral);
                        },
                    });
                });   
            }
        });
    });
    ///////////////////certified provider Status button///////////               
    function changeStatus22(status, id){
        $.ajax({
            url: "{{url('admin/provider/contractor/status')}}",
            type:'post',
            data:{_token: "{{csrf_token()}}",id:id, status:status},
            dataType:'json',
            success:function(res){
                if(res.status == 'success'){
                    toastr.success(res.message);
                }else{
                    toastr.error(res.message);
                }
            },error(){
                toastr.error('Something went wrong');
            }
        })
    }
</script>
@stop