@extends('admin.layout.adminLayout')
@section('title','Product Tax')
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
                            <h1>Tax Management</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Tax Management</a></li>
                                <li class="active">Product Tax</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="termForm" action="{{url('admin/taxManagement/ProductTax/add')}}">
              @csrf
                <div class="card">
                    <div class="card-header">
                       <strong class="card-title">Product Tax</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-md-2">
                            <div class="terms_page my-4">
                                <form>
                                    <label>Tax Percentage</label>
                                    <input class="form-control mb-2" id="tax_percent" name="tax_percent" type="text"  value="{{@$productTax->tax_percent}}">
                                    <input  name="tax_id" type="hidden"  value="{{@$productTax->id}}">
                               
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $('#termForm').validate({
        ignore:[],
        rules:{
            "tax_percent":{
                required:true,
                number:true,
                min:1,
            },
        },
        messages:{
            "tax_percent":{
               required:"Please enter tax percent",
            },
        },
        submitHandler:function(form){
            
            var taxPercent = $('#tax_percent').val();
             
            if(taxPercent >100){
                Swal.fire('Tax Percent should be less than 100%')
            } else if(taxPercent <100){
                if($("#termForm").valid()){
                  form.submit();
                }  
            }

        }
    });
</script>
@stop