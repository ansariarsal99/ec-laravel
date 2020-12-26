@extends('admin.layout.adminLayout')
@section('title','Add Membership Level')
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
                                    <h1>Membership</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Membership</a></li>
                                        <li class="active">Membership Level</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    
    <div class="content">
        <div class="animated fadeIn">
            <!-- <div class="col-md-12"> -->

           <!-- <div class="row">    -->
            <form method="post" id="termForm" action="{{url('admin/membership/add')}}">
              @csrf
                <div class="card">
                    <div class="card-header">
                       <strong class="card-title">Membership Level</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-md-2">
                            <div class="terms_page my-4">
                                <form>
                                   <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control mb-2"  name="title" placeholder="Please enter title" type="text"  value="">
                                    </div>

                                     <div class="form-group">
                                        <label>From (Points)</label>
                                        <input class="form-control mb-2"  name="point_from" placeholder="Please enter point" type="text"  value="">
                                    </div>

                                     <div class="form-group">
                                        <label>To (Points)</label>
                                        <input class="form-control mb-2" name="point_to" placeholder="Please enter point" type="text"  value="">
                                    </div>

                                    <div class="form-group">
                                         <label>Description</label>
                                         <textarea class="form-control text-align:left"  rows="4" name="description" placeholder="Please enter description"></textarea>
                                    </div>

                               
                                    <button type="submit" id="save" class="cstm-azy-btn-red">Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>                 
        </div> 
    </div>                                  
       
      


@stop
@section('script')

<script type="text/javascript">
    $('#termForm').validate({
        ignore:[],
        rules:{
            "title":{

                required:true,
                maxlength:200,
                minlength:5,
            },
             "point_from":{

                required:true,
                digits:true,

                // maxlength:200,
                // minlength:5,
            },
             "point_to":{

                required:true,
                digits:true,
                // maxlength:200,
                // minlength:5,
            },
            "description":{

              required:true,
              minlength:20,
            },
        },
        messages:{

            "title":{

               required:"Please enter title",
               maxlength:"Maximum 200 characters are allowed",
               minlength:"Title must contain 5 characters",
            },
             "point_from":{

               required:"Please enter points",
               // maxlength:"Maximum 200 characters are allowed",
               // minlength:"Title must contain 5 characters",
            },
             "point_to":{

               required:"Please enter points",
               // maxlength:"Maximum 200 characters are allowed",
               // minlength:"Title must contain 5 characters",
            },

            "description":{

            required:"Please enter description ",
            minlength:"Description must contain 20 characters",
            },
        },
    });
</script>
@stop