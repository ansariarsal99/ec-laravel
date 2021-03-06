@extends('admin.layout.adminLayout')
@section('title','Provider Consultant List')
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
                        <h1>User Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">User Management</a></li>
                            <li class="active">Provider Consultant List</li>
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
                       <strong class="card-title">Provider Consultant List</strong>
                   <!--     <a href="{{url('admin/subscriptionManagement/addSubscription')}}" class="btn btn-outline-danger" style="float:right;">Add New User</a> -->
                       <a href="{{url('admin/export/provider-consultantList')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a>
                    </div>
                    <div class="card-body">
                       <table id="userList" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User Type</th>
                                    <th>Company Name</th>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <th>Mobile No </th>
                                      <th>Status</th>
                                       <th>Transaction Status</th>
                                        <th>Certified Provider</th>
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
    $(document).on('click','.del_btn',function(){
        var confirmation =  confirm('Are you sure you want to delete this?');
        var countryId = $(this).attr("val");
        var ev        = $(this);
        if(confirmation == true){
            $.ajax({
                 url: "{{ url('admin/generalManagement/countries/delete') }}" + '/' + countryId,
                type: 'POST',
               data : {"_token":"{{ csrf_token() }}"},  //pass the CSRF_TOKEN()
             success: function (data) {
                    if (data.status == 'ok') {
                        $(ev).closest('tr').hide();
                                           
                    }   
                }         
            });
        }else{
            return false;
        }
    });
</script>

<script>
    $(function() {
        var t = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/provider/consultantListIndex')}}',
            columns: [
                { data: 'DT_RowIndex',      name: 'id', searchable: false,  visible:true},
                { data: 'user_type_name',   name: 'user_type_name'},
                { data: 'company_name',     name: 'company_name'},
                { data: 'contact_name',     name: 'contact_name'},
                { data: 'email',            name: 'email'},
                { data: 'mobile_no',        name: 'mobile_no'},
                   { data: 'status',           name: 'status', orderable: false }, 
              { data: 'transaction_status', name: 'transaction_status', orderable: false }, 
              { data: 'certified_provider', name: 'certified_provider', orderable: false }, 
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

                 $('.transaction_button_toggle').each(function(i, e){
                    // console.log($(this).attr('rel'));
                    var attr_rel = $(this).attr('rel');
                    var attr_ral = $(this).attr('ral');
                    var attr_id  = $(this).attr('id');
                    // alert(attr_id);
                    $('#'+attr_id).btnSwitch({
                        Theme: 'Light',
                        ToggleState: attr_rel == 'active' ? true : false,
                        OnCallback: function(val) {
                            changeStatus('active',attr_ral);
                        },
                        OffCallback: function(val) {
                            changeStatus('inactive',attr_ral);
                        },
                    });
                });

                      ///////////////certidied/////////
                $('.certified_provider_button_toggle').each(function(i, e){
                   // alert($(this).attr('rel'));
                    var attr_rel = $(this).attr('rel');

                    var attr_ral = $(this).attr('ral');
                    var attr_id  = $(this).attr('id');
                    // alert(attr_id);
                    $('#'+attr_id).btnSwitch({
                        Theme: 'Light',
                        ToggleState: attr_rel == 'yes' ? true : false,
                        OnCallback: function(val) {
                            changeStatus33('yes',attr_ral);
                        },
                        OffCallback: function(val) {
                            changeStatus33('no',attr_ral);
                        },
                    });
                });
                

            }
        });
    });


///////////////////certified provider Status button///////////

    function changeStatus33(certified_provider, id){
                 $.ajax({
                     url: "{{url('admin/userManagement/certified_provider-status')}}",
                     type:'post',
                     data:{_token: "{{csrf_token()}}",id:id, certified_provider:certified_provider},
                     dataType:'json',
                     success:function(res){

                         if(res.certified_provider == 'success'){
                             toastr.success(res.message);
                         }else{
                             toastr.error(res.message);
                         }
                     },error(){
                         toastr.error('Something went wrong');
                     }
                 })
             }

         //////////////end////////////
        // alert(status);
    function changeStatus(transaction_status, id){
                $.ajax({
                    url: "{{url('admin/provider/consultant/transactionStatus')}}",
                    type:'post',
                    data:{_token: "{{csrf_token()}}",id:id, transaction_status:transaction_status},
                    dataType:'json',
                    success:function(res){
                        if(res.transaction_status == 'success'){
                            toastr.success(res.message);
                        }else{
                            toastr.error(res.message);
                        }
                    },error(){
                        toastr.error('Something went wrong');
                    }
                })
            }

    function changeStatus22(status, id){
                $.ajax({
                    url: "{{url('admin/provider/consultant/status')}}",
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

<!-- <script>
    $(document).on('click','.del_btn',function(){
        var confirmation =  confirm('Are you sure you want to delete this?');
        var contentId = $(this).attr("val");
        var ev        = $(this);
        if(confirmation == true){
            $.ajax({
            url: "{{ url('admin/subscriptionManagement/deleteSubscription') }}" + '/' + contentId,
            type: 'POST',
            success: function (data) {
                    if (data.status == 'ok') {
                        $(ev).closest('tr').hide();
                                           
                    }   
                }         
            });
        }else{
            return false;
        }
    });
</script> -->
@stop