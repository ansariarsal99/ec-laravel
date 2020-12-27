@extends('admin.layout.adminLayout')
@section('title','Sub Categories List')
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
                            <li><a href="#">Product Management</a></li>
                            <li class="active">Sub Categories List</li>
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
                       <strong class="card-title">Sub Categories List</strong>
                       <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#coun_modal" style="float:right;">Add New SubCategory</a>
                       <a href="{{url('admin/productManagement/subcategory/export')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a>
                    </div>
                    <div class="card-body">
                       <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
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
<div class="modal fade" id="editCountryModal">
 <form method="post" id="editCountryForm" action="{{url('admin/productManagement/subcategory/edit/')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Sub Category</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                 	<div class="form-group">
                    	<label>Product Category</label>
                    	<select class="form-control categoryIdClass" name="category_id" type="text" value="">
                        <option selected disabled>Select Category Name</option>
	                        @if(isset($categories) && !empty($categories))
	                        @foreach($categories as $category)
	                        <option value="{{@$category['id']}}">{{@$category['name']}}</option>
	                        @endforeach
	                        @endif
                    	</select>
                	</div>
                    <div class="country_div">
                        <input type="hidden" class="countryIdClass" value="" id="coty_id" name="id">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Sub Category</label>
                            <input type="text" name="name" placeholder="Enter Sub Category Name" class="form-control courseNameClass" maxlength="100">
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
<div class="modal fade" id="coun_modal">
 <form method="post" id="addCountryForm" action="{{url('admin/productManagement/subcategory/add')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Sub Category</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
	                <div class="form-group">
	                    <label>Product Category</label>
	                    <select class="form-control" name="category_id" type="text" value="">
	                        <option selected disabled>Select Category Name</option>
	                        @if(isset($categories) && !empty($categories))
	                        @foreach($categories as $category)
	                        <option value="{{@$category['id']}}">{{@$category['name']}}</option>
	                        @endforeach
	                        @endif
	                    </select>
	                </div>
                    <div class="country_div">
                        <input type="hidden" class="countryIdClass" value="" id="coty_id" name="id">
                        <!-- <form> -->
                        <div class="form-group">
                            <label>Sub Category</label>
                            <input type="text" name="name" placeholder="Enter Sub Category Name" class="form-control courseNameClass" maxlength="100">
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
            },
            "category_id" : {
                required:true
            }
        },
        messages:{
            "name":{
                required:"Please enter sub category name",
            },
            "category_id" : {
                required:"Please select category",
            }
        },
    });
</script>

<script type="text/javascript">
    // var CountryId=$('.countryIdClass').val();
    // alert(CountryId);

</script>

<script type="text/javascript">
         var CountryId='';
    $(document).on('click','.edit_sub_category',function(e){
        e.preventDefault();
        var this_url=$(this);
        var country_id=$(this).attr('ral_country_id');
        var country_name=$(this).attr('ral_country_name');
        var category_id   = $(this).attr('ral_category_id');
        $('.countryIdClass').val(country_id);
        $('.courseNameClass').val(country_name);
        $('.categoryIdClass').val(category_id);

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
    $(function() {
        var t = $('#bootstrap-data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/productManagement/subcategory/list/index')}}',
            columns: [
                { data: 'DT_RowIndex', name: 'id', searchable: false,  visible:true}, 
                { data: 'category.name', name:'category.name'},              
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
            url: "{{url('admin/productManagement/subcategory/changeStatus')}}",
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