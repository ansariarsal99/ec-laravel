@extends('admin.layout.adminLayout')
@section('title','City List')
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
                            <li class="active">City List</li>
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
                       <strong class="card-title">City List</strong>
                      <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#coun_modal" style="float:right;">Add New</a>
                    </div>
                    <div class="card-body">
                       <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <!-- <th>Sort Name</th> -->
                                    <th>Country Name </th>
                                    <!-- <th>State Name</th> -->
                                    <th>City Name</th>
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
<div class="modal" id="editCityModal">
 <form method="post" id="editCityForm" action="{{url('admin/generalManagement/cities/edit/')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit City</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <input type="hidden" class="cityIdClass" name="id">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control chng_cntry countryIdClass" name="country_id" type="text" value="">
                                <option selected disabled>Select Country Name</option>
                                    @if(isset($countries) && !empty($countries))
                                        @foreach($countries as $countr)
                                          <option value="{{@$countr['id']}}">{{@$countr['name']}}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label>State</label>
                            <select class="form-control state_class stateIdClass state_class_ajax" name="state_id" type="text" value="">
                                <option selected disabled>Select State Name</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="name" class="form-control cityIdNameClass">
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="editCityBtn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Edit Country Modal  -->

<!-- Country Modal Add-->
<div class="modal" id="coun_modal">
 <form method="post" id="addCityForm" action="{{url('admin/generalManagement/cities/add')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add City</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control chng_cntry" name="country_id" type="text" value="">
                                <option selected disabled>Select Country Name</option>
                                    @if(isset($countries) && !empty($countries))
                                        @foreach($countries as $countr)
                                          <option value="{{@$countr['id']}}">{{@$countr['name']}}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label>State</label>
                            <select class="form-control state_class" name="state_id" type="text" value="">
                                <option selected disabled>Select State Name</option>
                                 
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="Submit" id="add_city_name_btn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop
@section('script')
<script type="text/javascript">
    $('#addCityForm').validate({
        ignore:[],
        rules:{
            "country_id":{
                required:true,
            },
            "state_id":{
                required:true,
            },
            "name":{
                required:true,
                remote:"{{ url('admin/generalManagement/checkCity/name')}}",
            },
        },
        messages:{
            "country_id":{
                required:"Please select country",
                // maxlength:"Maximum 200 characters are allowed",
            },
            "state_id":{
                required:"Please select state",
                // maxlength:"Maximum 200 characters are allowed",
            },
            "name":{
                required:"Please enter city name",
                 remote:"*City name already registered",
            },
        },
    });
</script>
<script type="text/javascript"> 
    $(document).on('change','.chng_cntry',function(){
       var country_id = $(this).val();
       // alert(country_id);
       $.ajax({
           url:"{{url('admin/generalManagement/changeCountry')}}",
           data:{ country_id:country_id,_token:"{{ csrf_token() }}" },
           type:'POST',
           success:function(data){
            // alert(data);
            $('.state_class').html(data);
           } 
       }); 
    });
</script>
<script type="text/javascript">
    var CityId='';
    $(document).on('click','.edit_course',function(e){
        e.preventDefault();
        var this_url     = $(this);
        var city_id     = $(this).attr('ral_city_id');
        var city_name   = $(this).attr('ral_city_name');
        var state_id   = $(this).attr('state_id');
        var cntrry_id   = $(this).attr('country_id');


        $('.cityIdClass').val(city_id);
        $('.cityIdNameClass').val(city_name);
        $('.countryIdClass').val(cntrry_id);

        var CityId=$('.cityIdClass').val();
        // $('.stateIdClass').val(state_id);
         // cntryIdd = $(this).val(cntrry_id);
        // alert(state_id);
        // alert(cntrry_id);
     
          
        $.ajax({
            url:"{{url('admin/generalManagement/changeState')}}",
            data:{ cntrry_id:cntrry_id,state_id:state_id,_token:"{{ csrf_token() }}" },
            type:'POST',
            success:function(data){
                // alert(data);
                $('.state_class_ajax').html(data);
            } 
        }); 
          
    })

    var CityId=$('.cityIdClass').val();

     $('#editCityForm').validate({
        ignore:[],
        rules:{
            "country_id":{
                required:true,
            },
            "state_id":{
                required:true,
            },
            "name":{
                required:true,
                remote:{
                    url:"{{ url('admin/generalManagement/editCity/name')  }}",
                    data:{
                        id:function(){
                            return $('.cityIdClass').val();
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

             "state_id":{
                required:"Please select state",
                // maxlength:"Maximum 200 characters are allowed",
            },

            "name":{
                required:"Please enter city name",
                remote:"*City name already registered",
            },
        },
    });
</script>

<script type="text/javascript">
    $(document).on('click','#add_city_name_btn', function(){
        $('#addCityForm').submit();
    })

    $(document).on('click','#editCityBtn', function(){
        $('#editCityForm').submit();
    })
</script>

<script>
    $(document).on('click','.del_btn',function(){
        var confirmation =  confirm('Are you sure you want to delete this?');
        var cityId = $(this).attr("val");
        var ev        = $(this);
        if(confirmation == true){
            $.ajax({
                 url: "{{ url('admin/generalManagement/cities/delete') }}" + '/' + cityId,
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
            ajax: '{{url('admin/generalManagement/cities/index')}}',
            columns: [
                { data: 'DT_RowIndex', name: 'id', searchable: false,  visible:true},               
                { data: 'country_id',  name: 'countries.name' },
                // { data: 'state_id',     name: 'state_id' },
                { data: 'name',         name: 'name'},
                // { data: 'sortname',    name: 'sortname' },
                // { data: 'phonecode',   name: 'phonecode' },
                { data: 'status',       name: 'status', orderable: false }, 
                { data: 'action',       name: 'action', orderable: false },  
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
                    url: "{{url('admin/generalManagement/cities/status')}}",
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