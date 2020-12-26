@extends('admin.layout.adminLayout')
@section('title','Brand List')
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
                            <li class="active">Brand List</li>
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
                       <strong class="card-title">Brand List</strong>
                       <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#coun_modal" style="float:right;">Add Brand</a>
                       <a href="{{url('admin/productManagement/brand/export')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a>
                    </div>
                    <div class="card-body">
                       <table id="color-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Brand Name</th>
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

<div class="modal fade" id="editCountryModal">
 <form method="post" id="editColorForm" action="{{url('admin/productManagement/brand/edit')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Brand</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="country_div">
                        <input type="hidden" class="brandIdClass" value="" id="coty_id" name="id">
                        <div class="form-group">
                            <label>Brand</label>
                            <input type="text" name="brand_name" placeholder="Enter sub brand name" class="form-control brandNameClass" maxlength="100">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="Submit" id="editCountryBtn" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="coun_modal">
 <form method="post" id="addColorForm" action="{{url('admin/productManagement/brand-add')}}">
    @csrf
    <div class="modal-dialog cout_info">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Brand</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <input type="hidden" class="brandIdClass" value="" id="coty_id" name="id">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" name="brand_name" placeholder="Enter Brand Name" class="form-control brandNameClass" maxlength="100">
                        </div>
                    </div>
                </div>

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
    
    $('#addColorForm').validate({
        ignore:[],
        rules:{
            "brand_name":{
                required:true,
                remote:"{{ url('admin/productManagement/brand/validateAddBrandName')}}",
            }
        },
        messages:{
            "brand_name":{
                required:"Please enter  Brand name",
                remote:"*Brand name already registered",
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
    $(document).on('click','.edit_brand',function(e){
        e.preventDefault();
        var this_url   = $(this);
        var brand_id   = $(this).attr('ral_brand_id');
        var brand_name = $(this).attr('ral_brand_name');

        // var category_id   = $(this).attr('ral_category_id');
        $('.brandIdClass').val(brand_id);
        $('.brandNameClass').val(brand_name);
   
 
    })
    var CountryId=$('.brandIdClass').val();
      // alert(CountryId);
       $('#editColorForm').validate({
        ignore:[],
        rules:{
            "brand_name":{
                required:true,
                maxlength:200,
                remote:{
                    url:"{{ url('admin/productManagement/brand/validatebrandName')  }}",
                    data:{
                        id:function(){
                            return $('.brandIdClass').val();
                        }
                    }
                } 

            },
        },
        messages:{
            "brand_name":{
                required:"Please enter Brand name",
                maxlength:"Maximum 200 characters are allowed",
                remote:"*Brand name already registered",

            },
        },
    });
  
</script>

<script type="text/javascript">
    $(document).on('click','#add_country_name_btn', function(){
        $('#addColorForm').submit();
    })

    $(document).on('click','#editCountryBtn', function(){
        $('#editColorForm').submit();
    })
</script>

<script>
    $(function() {
        var t = $('#color-table').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/productManagement/brand/list/index')}}',
            columns: [
                { data: 'DT_RowIndex', name: 'id', searchable: false,  visible:true}, 
                { data: 'brand_name',  name: 'brand_name' },
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
            url: "{{url('admin/productManagement/brand/changeStatus')}}",
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