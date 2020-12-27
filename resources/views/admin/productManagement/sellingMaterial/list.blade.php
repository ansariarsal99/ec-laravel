@extends('admin.layout.adminLayout')
@section('title','Product Selling Material List')
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
                        <h1>Product Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#"> Product Management</a></li>
                            <li class="active">Product Selling Material List</li>
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
                       <strong class="card-title">Product Selling Material List</strong>
                       <a href="{{url('admin/sellingMaterial/add')}}" class="btn btn-outline-danger" style="float:right;">Add New </a>
                       <!-- <a href="{{url('admin/exportManagement/subscriptionList')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a> -->
                    </div>
                    <div class="card-body">
                       <table id="rewardPointList" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Selling Material Name</th>
                                    <th>Status</th>
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
                url: "{{ url('admin/sellingMaterial/delete') }}" + '/' + countryId,
                type: 'POST',
                data : {"_token":"{{ csrf_token() }}"},  //pass the CSRF_TOKEN()
             success: function (data) {
                    if (data.status == 'ok') {
                        $(ev).closest('tr').hide();
                        location.reload(true);
                                           
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
        var t = $('#rewardPointList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/sellingMaterial/list/index')}}',
            columns: [
                { data: 'DT_RowIndex', name: 'id', searchable: false,  visible:true},
                { data: 'category_name',      name: 'category_name'},
                { data: 'sub_category_name',  name: 'sub_category_name'},
                { data: 'selling_material_name',    name: 'selling_material_name'},
                { data: 'status',                   name: 'status', orderable: false }, 
                { data: 'action',                   name: 'action', orderable: false },  
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
                            changeStatus('active',attr_ral);
                        },
                        OffCallback: function(val) {
                            changeStatus('inactive',attr_ral);
                        },
                    });
                });
            }
        });
    });
        // alert(status);
    function changeStatus(status, id){
                $.ajax({
                    url: "{{url('admin/sellingMaterial/status')}}",
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