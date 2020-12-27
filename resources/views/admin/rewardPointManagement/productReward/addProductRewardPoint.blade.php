@extends('admin.layout.adminLayout')
@section('title','Add Product Reward Point')
@section('content')

 @include('admin.include.header')

 @include('admin.include.sidebar')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Reward Point Management</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Reward Point Management</a></li>
                                <li class="active">Add Product Reward Point</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="addRewrdForm" action="{{url('admin/rewardPointManagement/productReward/addReward/point')}}">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Add Product Reward Point</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>
                               
                                   <div class="form-group">
                                      <label>Select Product</label>
                                         <select class="form-control countryIdClass chng_group" name="product_name">
                                            <option selected disabled>Select Product</option>
                                                @if(isset($productProduct) && !empty($productProduct))
                                                    @foreach($productProduct as $product)
                                                      <option value="{{@$product['id']}}">{{@$product['item_name']}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>

                                   


                                    <div class="form-group">
                                        <label>Point</label>
                                        <input class="form-control mb-2"  name="point" type="text" placeholder="Please enter point"  value="">
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
    <!-- <input type="hidden" class="" name="" value=""> -->
    

@stop
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- <script type="text/javascript">
   $.validator.addMethod('minStrict', function (value, el, param) {
    return value > param;
  });
</script> -->
 

<script>
    $(function(){
        $("#addRewrdForm").validate({
            rules:{
               product_name:{
                   required: true,
               },
               point:{
                   required: true,
                   number:true,
                   min: 1,
               },
           },
           messages: {
            product_name:{
                 required:"Please select product",
            },
            point:{
                 required: 'Please enter point',
                minlength: "Minimum 1 digit is allowed",
            },
         },

       });
    });
</script>

@stop