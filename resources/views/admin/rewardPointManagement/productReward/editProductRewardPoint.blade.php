@extends('admin.layout.adminLayout')
@section('title','Edit Product Reward Point')
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
                                <li class="active">Edit Product Reward Point</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="addRewrdForm" action="{{url('admin/rewardPointManagement/productReward/editReward/point/'.$rewardPointRecord['id'])}}">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Edit Product Reward Point</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>

                                   <!-- <div class="form-group"> -->
                                        <!-- <label>Point</label> -->
                                        <!-- <input class="form-control mb-2"  name="product_name" readonly="" type="text" placeholder="Please enter point"  value="{{$rewardPointRecord['product_name']}}"> -->
                                    <!-- </div> -->
                                    
                                  <select class="form-control" name="product_name">
                                        <option selected disabled>Select Brand Name</option>
                                        @foreach($products as $brandProduct)
                                           <option  value="{{$brandProduct['id']}}" <?php if(isset($brandProduct)){if(@$brandProduct['id'] == @$rewardPointRecord['product_name']){ echo 'selected'; }} ?> >{{@$brandProduct['item_name']}}</option>
                                        @endforeach
                                  </select>
                                   
                                    <div class="form-group">
                                        <label>Point</label>
                                        <input class="form-control mb-2"  name="point" type="text" placeholder="Please enter point"  value="{{$rewardPointRecord['point']}}">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="save" class="cstm-azy-btn-red">Submit
                                        </button>
                                    </div>

                                    <input type="hidden" class="rewardPointId" name="id"  value="{{$rewardPointRecord['id']}}">
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
                 required:"Please enter product",
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