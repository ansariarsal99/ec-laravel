@extends('admin.layout.adminLayout')
@section('title','State List')
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
                        <h1>General Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">General Management</a></li>
                            <li class="active">State List</li>
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
                       <strong class="card-title">State List</strong>
                        <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#coun_modal" style="float:right;">Add New</a>
                    </div>
                    <div class="card-body">
                       <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <!-- <th>Sort Name</th> -->
                                    <th>State Name</th>
                                    <th>Country Name </th>
                                    <!-- <th>Phone Code</th> -->
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
<div class="modal" id="editStateModal">
 <form method="post" id="editStateForm" action="{{url('admin/generalManagement/states/edit/')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit State</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <input type="hidden" class="stateIdClass" value="" name="id">
                        <!-- <form> -->
                               
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control countryIdClass" name="country_id" type="text" value="">
                                <option selected disabled>Select Country Name</option>
                                    @if(isset($countries) && !empty($countries))
                                        @foreach($countries as $countri)
                                          <option value="{{@$countri['id']}}">{{@$countri['name']}}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="name" class="form-control stateIdNameClass">
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="editStateBtn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Edit Country Modal  -->

<!-- Country Modal Add-->
<div class="modal" id="coun_modal">
 <form method="post" id="addStateForm" action="{{url('admin/generalManagement/states/add')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add State</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <!-- <form> -->
                      
                       
                                  
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" name="country_id" type="text" value="">
                                <option selected disabled>Select Country Name</option>
                                    @if(isset($countries) && !empty($countries))
                                        @foreach($countries as $countri)
                                          <option value="{{@$countri['id']}}">{{@$countri['name']}}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>


                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="add_state_name_btn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop
@section('script')
<script type="text/javascript">
    $('#addStateForm').validate({
        ignore:[],
        rules:{
            "country_id":{
                required:true,
            },
            "name":{
                required:true,
                 remote:"{{ url('admin/generalManagement/checkState/name')}}",
                // maxlength:200,
            },
        },
        messages:{
            "country_id":{
                required:"Please select country",
                // maxlength:"Maximum 200 characters are allowed",
            },
            "name":{
                required:"Please enter state name",
                 remote:"*State name already registered",
                // maxlength:"Maximum 200 characters are allowed",
            },
        },
    });
</script>


<script type="text/javascript">
    var StateId='';
    $(document).on('click','.edit_course',function(e){
        e.preventDefault();
        var this_url     = $(this);
        var state_id     = $(this).attr('ral_state_id');
        var state_name   = $(this).attr('ral_state_name');
        var country_id   = $(this).attr('ral_country_id');
        // alert(country_id);

        $('.stateIdClass').val(state_id);
        $('.stateIdNameClass').val(state_name);
        $('.countryIdClass').val(country_id);

         var StateId=$('.stateIdClass').val();

    })
     var StateId=$('.stateIdClass').val();

     $('#editStateForm').validate({
        ignore:[],
        rules:{
            "country_id":{
                required:true,
            },
            "name":{
                required:true,
                 remote:{
                    url:"{{ url('admin/generalManagement/editState/name')  }}",
                    data:{
                        id:function(){
                            return $('.stateIdClass').val();
                        }
                    }
                } 
               
            },
        },
        messages:{
            "country_id":{
                required:"Please select country",
                // maxlength:"Maximum 200 characters are allowed",
            },
            "name":{
                required:"Please enter state name",
                  remote:"*State name already registered",
            },
        },
    });
</script>

<script type="text/javascript">
    $(document).on('click','#add_state_name_btn', function(){
        $('#addStateForm').submit();
    })

    $(document).on('click','#editStateBtn', function(){
        $('#editStateForm').submit();
    })
</script>

<script>
    $(document).on('click','.del_btn',function(){
        var confirmation =  confirm('Are you sure you want to delete this?');
        var stateId = $(this).attr("val");
        var ev        = $(this);
        if(confirmation == true){
            $.ajax({
                 url: "{{ url('admin/generalManagement/states/delete') }}" + '/' + stateId,
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
        var t = $('#bootstrap-data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/generalManagement/states/index')}}',
            columns: [
                { data: 'DT_RowIndex', name: 'id', searchable: false,  visible:true},               
                // { data: 'sortname',    name: 'sortname' },
                { data: 'name',        name: 'name' },
                { data: 'country_id',  name: 'country_id' },
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
                    url: "{{url('admin/generalManagement/states/status')}}",
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