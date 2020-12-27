@extends('admin.layout.adminLayout')
@section('title','Admin Wire Transfer Details')
@section('content')

 @include('admin.include.header')

 @include('admin.include.sidebar')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Admin Wire Transfer Details</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Admin Wire Transfer Details</a></li>
                                <li class="active">Edit Admin Wire Transfer Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      
    <div class="content">
        <div class="animated fadeIn">
           
            <form method="post" id="wiretransfer" action="{{url('admin/update/WireTransferDetail')}}" enctype="multipart/form-data">

              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Edit Admin Wire Transfer Details</strong>
                    </div>
                  
 
                     <div class="row">
                       <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input class="form-control mb-2"  name="bank_name" placeholder="Please enter bank name" type="text"  value="{{@$wireTrasferDetail->bank_name}}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Account Name</label>
                                        <input class="form-control mb-2"  name="account_name" placeholder="Please enter account name" type="text"  value="{{@$wireTrasferDetail->account_name}}">
                                    </div>
                                  
                                    <div class="form-group">
                                        <label>Account Iban Number</label>
                                        <input class="form-control mb-2" name="account_iban_number" placeholder="Please enter account_iban_number " type="text"  value="{{@$wireTrasferDetail->account_iban_number}}">
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
        $("#wiretransfer").validate({
            rules:{
               bank_name: {
                  required:true,
                    maxlength:50,
               },
               account_name: {
                  required:true,
                   maxlength:300,
               },
               account_iban_number:{
                   required: true,
                   digits: true,
                    min: 7,
               },
           },
           messages: {
            bank_name:{
                required:"Please enter bank_name",
                maxlength:"Maximum 50 characters are allowed",
            },
            account_name:{
                required: 'Please enter Account Name',
            },
            account_iban_number:{
               required:"Please enter Account Iban Number",
            },
         },

       });
    });
</script>


@stop