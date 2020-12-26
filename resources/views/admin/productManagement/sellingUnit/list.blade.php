@extends('admin.layout.adminLayout')
@section('title','Selling Unit List')
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
                        <h1>Selling Unit Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="javascript:;">Selling Unit Management</a></li>
                            <li class="active">Selling Unit List</li>
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
                       <strong class="card-title">Selling Unit List</strong>
                       <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#product_modal" style="float:right;">Add New</a>
                       <a href="{{url('admin/productManagement/sellingUnitList/export')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a>
                    </div>
                    <div class="card-body">
                       <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Selling Unit</th>
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
<!-- Country Modal Edit-->
<div class="modal" id="editSellingUnitModal">
 <form method="post" id="editSellingUnitForm" action="{{url('admin/productManagement/sellingUnit/edit')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Selling Unit</h4> 
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <input type="hidden" class="groupIdClass" value="" name="id">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Selling Unit</label>
                            <input type="text" name="name" placeholder="Enter Selling Unit" class="form-control groupNameClass" maxlength="100">
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="editSellUnitBtn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Edit Country Modal -->

<!-- Country Modal Add-->
<div class="modal" id="product_modal">
 <form method="post" id="addSellingUnitForm" action="{{url('admin/productManagement/sellingUnit/add')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Selling Unit</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Selling Unit</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Selling Unit" maxlength="100">
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="addSellUnitBtn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop
@section('script')

<script type="text/javascript">
    
    $('#addSellingUnitForm').validate({
        ignore:[],
        rules:{
            "name":{
                required:true,
                maxlength:200,
                remote:"{{ url('admin/productManagement/sellingUnit/check/name')}}",
            },
        },
        messages:{
            "name":{
                required:"Please enter selling unit",
                maxlength:"Maximum 200 characters are allowed",
                remote:"Selling unit already exist",
            },
        },
    });
</script>

<script type="text/javascript">
    var groupId='';
    $(document).on('click','.editSellUnitGp',function(e){
        e.preventDefault();
        var this_url=$(this);
        var group_id=$(this).attr('ral_group_id');
        var group_name=$(this).attr('ral_group_name');
        $('.groupIdClass').val(group_id);
        $('.groupNameClass').val(group_name);
        var groupId=$('.groupIdClass').val();
          // alert(groupId);
        // alert(country_name);
        // var c=$('#coty_id').val(); 
    });

    var groupId=$('.groupIdClass').val();

    $('#editSellingUnitForm').validate({
        ignore:[],
        rules:{
            "name":{
                required:true,
                maxlength:200,
                remote:{
                    url:"{{ url('admin/productManagement/sellingUnit/edit/name')  }}",
                    data:{
                        id:function(){
                            return $('.groupIdClass').val();
                        }
                    }
                }
            },
        },
        messages:{
            "name":{
                required:"Please enter selling unit",
                maxlength:"Maximum 200 characters are allowed",
                remote:"Selling unit already exist",
            },
        },
    });
</script>

<script type="text/javascript">
    $(document).on('click','#addSellUnitBtn', function(){
        $('#addSellingUnitForm').submit();
    })

    $(document).on('click','#editSellUnitBtn', function(){
        $('#editSellingUnitForm').submit();
    })
</script>

<script>
    $(document).on('click','.del_btn',function(){
        var confirmation =  confirm('Are you sure you want to delete this?');
        var sellingUnitId = $(this).attr("val");
        var ev        = $(this);
        if(confirmation == true){
            $.ajax({
                 url: "{{ url('admin/productManagement/sellingUnit/delete') }}" + '/' + sellingUnitId,
                type: 'POST',
               data : {"_token":"{{ csrf_token() }}"},  //pass the CSRF_TOKEN()
             success: function (data) {
                    if (data.status == 'ok') {
                        // $(ev).closest('tr').hide();
                        // alert('here');
                        // swal('Selling unit is deleted successfully')
                        window.location.replace("{{url('/admin/productManagement/sellingUnitList')}}");
                                           
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
        var t = $('#bootstrap-data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/productManagement/sellingUnitList/index')}}',
            columns: [
                { data: 'DT_RowIndex', name: 'id', searchable: false,  visible:true},               
                // { data: 'sortname',    name: 'sortname' },
                { data: 'name',        name: 'name' },
                // { data: 'name_arabic', name: 'name_arabic' },
                // { data: 'phonecode',   name: 'phonecode' },
                { data: 'status',      name: 'status', orderable: false }, 
                { data: 'action',      name: 'action', orderable: false },  
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
                    url: "{{url('admin/productManagement/sellingUnit/status')}}",
                    type:'post',
                    data:{_token: "{{csrf_token()}}",id:id, status:status},
                    dataType:'json',
                    success:function(res){
                        if(res.status == 'success'){
                            toastr.success(res.message);
                              location.reload(true);
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