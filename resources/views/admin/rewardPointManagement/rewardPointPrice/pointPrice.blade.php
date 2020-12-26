@extends('admin.layout.adminLayout')
@section('title','Reward Point Prices')
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
                                <li class="active">Reward Point Prices</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="addRewrdForm" action="{{url('admin/rewardPointManagement/priceReward/point')}}">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title">Reward Point Prices</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>
                                    
                                    <div class="form-group">
                                        <label>Reward Point</label>
                                        <input class="form-control mb-2" name="point" placeholder="Please enter reward point" type="text" readonly=""  value="1">
                                    </div>
                                  
                                    <div class="form-group">
                                        <label>Reward Point Amount(SR)</label>
                                        <input class="form-control mb-2" name="point_price" placeholder="Please enter from amount" type="text"  value="{{$rewardPointRecord['point_price']}}">
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
                "point":{
                  required:true,
                  number:true,
                  min: 1,
                },

               "point_price": {
                  required:true,
                  number:true,
                  // min: 1,
               },
           },
           messages: {
            point:{
               required:"Please enter reward price",
               // minlength:"Minimum 1 digit is allowed",
            },
            point_price:{
                required:"Please enter point price",
                // minlength:"Minimum 1 digit is allowed",
            },
         },

       });
    });
</script>

@stop