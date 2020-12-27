@extends('admin.layout.adminLayout')
@section('title','Country List')
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
                            <li class="active">Country List</li>
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
                       <strong class="card-title">Country List</strong>
                       <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#coun_modal" style="float:right;">Add New</a>
                       <a href="{{url('admin/export/countryList')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a>
                    </div>
                    <div class="card-body">
                       <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <!-- <th>Sort Name</th> -->
                                    <th>Country Name</th>
                                    <!-- <th>Name Arabic</th> -->
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
<div class="modal" id="editCountryModal">
 <form method="post" id="editCountryForm" action="{{url('admin/generalManagement/countries/edit/')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Country</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <input type="hidden" class="countryIdClass" value="" id="coty_id" name="id">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="name" placeholder="Enter Country Name" class="form-control courseNameClass" maxlength="100">
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="editCountryBtn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Edit Country Modal  -->

<!-- Country Modal Add-->
<div class="modal" id="coun_modal">
 <form method="post" id="addCountryForm" action="{{url('admin/generalManagement/countries/add')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Country</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Country Name" maxlength="100">
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="add_country_name_btn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop
@section('script')

<script type="text/javascript">
    
    $('#addCountryForm').validate({
        ignore:[],
        rules:{
            "name":{
                required:true,
                maxlength:200,
                remote:"{{ url('admin/generalManagement/check/name')}}",
            },
        },
        messages:{
            "name":{
                required:"Please enter country name",
                maxlength:"Maximum 200 characters are allowed",
                remote:"*Country name already registered",
            },
        },
    });
</script>

<script type="text/javascript">
    // var CountryId=$('.countryIdClass').val();
    // alert(CountryId);

</script>

<script type="text/javascript">
         var CountryId='';
    $(document).on('click','.edit_course',function(e){
        e.preventDefault();
        var this_url=$(this);
        var country_id=$(this).attr('ral_country_id');
        var country_name=$(this).attr('ral_country_name');
        $('.countryIdClass').val(country_id);
        $('.courseNameClass').val(country_name);

         var CountryId=$('.countryIdClass').val();
          // alert(CountryId);
        // alert(country_name);
        // var c=$('#coty_id').val();
 
    })
    var CountryId=$('.countryIdClass').val();

       $('#editCountryForm').validate({
        ignore:[],
        rules:{
            "name":{
                required:true,
                maxlength:200,
                remote:{
                    url:"{{ url('admin/generalManagement/edit/name')  }}",
                    data:{
                        id:function(){
                            return $('.countryIdClass').val();
                        }
                    }
                } 

            },
        },
        messages:{
            "name":{
                required:"Please enter country name",
                maxlength:"Maximum 200 characters are allowed",
                remote:"*Country name already registered",

            },
        },
    });
</script>

<script type="text/javascript">
    $(document).on('click','#add_country_name_btn', function(){
        $('#addCountryForm').submit();
    })

    $(document).on('click','#editCountryBtn', function(){
        $('#editCountryForm').submit();
    })
</script>

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
        var t = $('#bootstrap-data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/generalManagement/countries/index')}}',
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
                    url: "{{url('admin/generalManagement/countries/status')}}",
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