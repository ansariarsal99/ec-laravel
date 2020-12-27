@extends('admin.layout.adminLayout')
@section('title','Add Category Reward Point')
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
                                <li class="active">Add Category Reward Point</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="addRewrdForm" action="{{url('admin/rewardPointManagement/categoryReward/addReward/point')}}">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Add Category Reward Point</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>

                                   <div class="form-group">
                                      <label>Select Category</label>
                                         <select class="form-control countryIdClass chng_group" name="category_id" type="text" value="">
                                            <option selected disabled>Select Category</option>
                                                @if(isset($productCategories) && !empty($productCategories))
                                                    @foreach($productCategories as $productCategory)
                                                      <option value="{{@$productCategory['id']}}">{{@$productCategory['name']}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                    
                                  <!--   <div class="form-group">
                                        <label>Reward Type</label>
                                        <input class="form-control mb-2 reward_type_order" readonly="" name="reward_type" placeholder="Order Wise" type="text"  value="category">
                                    </div> -->

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
               category_id:{
                   required: true,
                   number:true,
                   min: 1,
               },
               point:{
                   required: true,
                   number:true,
                   min: 1,
               },
           },
           messages: {
            category_id:{
                 required:"Please select category",
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