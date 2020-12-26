@extends('admin.layout.adminLayout')
@section('title','Add Subscription Package')
@section('content')

 @include('admin.include.header')

 @include('admin.include.sidebar')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Subscription Management</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Subscription Management</a></li>
                                <li class="active">Add New Subscription Package</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="termForm" action="{{url('admin/subscriptionManagement/addSubscription')}}">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Add New Subscription Package</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control mb-2" id="title" name="title" placeholder="Please enter title" type="text"  value="{{@$terms_condition->title}}">
                                    </div>
                                    <div class="form-group">
                                         <label>Description</label>
                                         <textarea class="form-control text-align:left"  rows="4" name="description" placeholder="Please enter description"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Time Limit</label>
                                                <input class="form-control mb-2" minlength="1"  name="time_limit" type="text" placeholder="Please enter time limit"  value="{{@$terms_condition->title}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Time Type</label>
                                                <select class="form-control" name="time_type" type="text" value="">
                                                    <option selected disabled>Select Time Type <body></body></option>                                            
                                                    <option value="hour">Hour</option>
                                                    <option value="week">Week</option>
                                                    <option value="month">Month</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input class="form-control mb-2"  name="price" type="text" placeholder="Please enter price"  value="{{@$terms_condition->title}}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="save" class="cstm-azy-btn-red">Submit
                                        </button>
                                    </div>
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
   $.validator.addMethod('minStrict', function (value, el, param) {
    return value > param;
  });
</script>

<script>
    $(function(){
        $("#termForm").validate({
            rules:{
               title: {
                  required:true,
                    maxlength:50,
               },
               description: {
                  required:true,
                   maxlength:300,
               },
               time_limit:{
                   required: true,
                   digits: true,
                   min: 1,
               },
               time_type: {
                   required: true,
                   // email:true,
               },
               price: {

                  required:true,
                    digits: true,
                    min: 1,
               },
           },
           messages: {
            title:{
                required:"Please enter title",
                maxlength:"Maximum 50 characters are allowed",
                    // regex: "First name contains characters only"
            },
            description:{
               required:"Please enter description",
               maxlength:"Maximum 200 characters are allowed",
                    // regex: "Last name contains characters only"
            },
            time_limit:{
                required: 'Please enter time limit',
                minlength:"Minimum 1 digit is allowed",
            },
            time_type:{
               required:"Please select time type",
                    // regex: "Please enter valid mobile number"
            },
            price:{
                required: 'Please enter price'
            },
         },

       });
    });
</script>

@stop