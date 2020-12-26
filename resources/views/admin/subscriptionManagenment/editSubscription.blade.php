@extends('admin.layout.adminLayout')
@section('title','Edit Subscription Package')
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
                                <li class="active">Edit Subscription Package</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      
    <div class="content">
        <div class="animated fadeIn">
            <?php $pid = base64_encode($subscribe['id']); ?>  
            <form method="post" id="termForm" action="{{url('admin/subscriptionManagement/editSubscription/'.$pid)}}" enctype="multipart/form-data">

              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Edit Subscription Package</strong>
                    </div>
                    <input type="hidden" value="{{@$subscribe->id}}" name="id">

                     <div class="row">
                       <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control mb-2" id="title" name="title" placeholder="Please enter title" type="text"  value="{{@$subscribe->title}}">
                                    </div>
                                    
                                    <div class="form-group">
                                         <label>Description</label>
                                         <textarea class="form-control text-align:left" rows="4" name="description" placeholder="Please enter description">{{@$subscribe->description}}</textarea>
                                    </div>

                                <div class="row">
                                       <div class="col-lg-6 col-sm-12">
                                           <div class="form-group">
                                            <label>Time Limit</label>
                                                <input class="form-control mb-2" id="title" name="time_limit" type="text" placeholder="Please enter time limit"  value="{{@$subscribe->time_limit}}">
                                            </div>
                                        </div>    
                                      
                                        <div class="col-lg-6 col-sm-12">
                                           <div class="form-group">
                                              <label>Time Type</label>
                                               <select class="form-control" name="time_type" type="text">
                                                    <option value="" selected disabled >Select Time Type <body></body></option> 

                                                    <option value="hour" 
                                                    @if($subscribe['time_type'] == 'hour') selected @endif}}>Hour</option>

                                                    <option value="week" 
                                                    @if($subscribe['time_type'] ==  'week') selected @endif}}>Week</option>

                                                    <option value="month"
                                                     @if($subscribe['time_type'] == 'month') selected @endif}}>Month</option>

                                                </select>
                                            </div>
                                        </div> 
                                    </div>

                                  


                                    
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input class="form-control mb-2" id="title" name="price" type="text" placeholder="Please enter price"  value="{{@$subscribe->price}}">
                                    </div>
                                
                                    <div class="form-group">
                                        <button type="submit" id="save" class="cstm-azy-btn-red">Update
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