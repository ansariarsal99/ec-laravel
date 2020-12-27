@extends('admin.layout.adminLayout')
@section('title','Messages')
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
                            <h1>Permissions</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="javascript:;">Permission</a></li>
                                <li class="active">Permissions</li>
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
                            <strong class="card-title">Permissions List</strong>
                            <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#role_add_modal" style="float:right;">Add New</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered table-responsive"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Role Model Add -->
    <div class="modal" id="role_add_modal">
        <form method="post" id="addCountryForm" action="{{url('admin/permissions/permissions/add')}}">

            @csrf
            <div class="modal-dialog cout_info">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Permisssion</h4>
                        <button type="button" class="close"  data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="country_div">
                            <!-- <form> -->
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Role Name" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role_id" id="role_id" class="form-control">

                                    @if (!empty($roles))
                                        @foreach ( $roles as $role )
                                            <option value="{{$role["id"]}}">{{$role["name"]}} </option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Allowed Urls</label>
                                <select name="urls[]" id="urls[]" class="form-control selectpicker" multiple data-live-search="true">

                                    @if (!empty($filteredArray))
                                        @foreach ( $filteredArray as $url )
                                            <option value[]="{{$url}}">{{$url}} </option>
                                        @endforeach
                                    @endif

                                </select>
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

{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


    <script type="text/javascript">

        function titleCase(string) {
            var sentence = string.toLowerCase().split(" ");
            for(var i = 0; i< sentence.length; i++){
                sentence[i] = sentence[i][0].toUpperCase() + sentence[i].slice(1);
            }
            return sentence.join(" ");
        }

        $(document).ready(function() {

            $('select').selectpicker();

            var columns = @json($columns);
            var data = @json($data);

            if ($.fn.DataTable.isDataTable('#bootstrap-data-table')) {
                $("#bootstrap-data-table").DataTable().clear().destroy();
                $("#bootstrap-data-table").empty();
            }

            if(columns.length == 0){
                console.log(columns.length);
                $('.loading').hide();
                return false;
            }

            columns = columns.map(function(x){
                var title = titleCase(x.toString().replace('_', ' '));
                return {data: x, title: title, width: '200px'}
            })

            columns = [
                ...columns,
                {
                    data: null,
                    className: "center",
                    render: function ( data, type, row ) {
                        console.log('data is')
                        // console.log(data)
                        $values=JSON.stringify(data)
                        @if(isset($actions))
                            $menu =

                            `<div width="5%" class="menu-button">
                            <div style="position: relative">`;

                        @foreach($actions as $action )
                            $link =  '{{ $action['action'] }}';
                        $link = $link.replace(':id', data.id);
                        $menu += `<a href="javascript:void(0)" class="del_btn" val="${data.id}"><i class="fa fa-trash" title="Delete"></i><a>`;
                        @endforeach

                            $menu += `<div>`;
                        @else
                            $menu='';
                        @endif
                            return $menu;

                    }
                }
            ]
            console.log(columns, data);

            $('#bootstrap-data-table').DataTable({
                data: data,
                columns: columns,
                destroy: true,
                search: false,
                language: {
                    infoEmpty: "No records available",
                },
                order: [[1,"asc"]]

            });

            $("#bootstrap-data-table").DataTable()
                .columns.adjust();
        })



    </script>

    <script>
        $(document).on('click','.del_btn',function(){
            var confirmation =  confirm('Are you sure you want to delete this?');
            var itemId = $(this).attr("val");
            var ev     = $(this);
            if(confirmation == true){
                $.ajax({
                    url: "{{ url('admin/permissions/permissions/delete') }}" + '/' + itemId,
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

@stop
