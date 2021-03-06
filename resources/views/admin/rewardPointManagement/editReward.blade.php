@extends('admin.layout.adminLayout')
@section('title','Edit Reward Point')
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
                                <li class="active">Edit Order Reward Point</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="addRewrdForm" action="{{url('admin/rewardPointManagement/reward/editReward/point/'.$rewardPointRecord['id'])}}">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Edit Order Reward Point</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>

                                   <!-- <div class="form-group">
                                      <label>Selling Unit Group</label>
                                         <select class="form-control countryIdClass chng_group" name="selling_unit_group_id" type="text" value="">
                                            <option selected disabled>Select Selling Unit</option>
                                                @if(isset($sellingUnitGroup) && !empty($sellingUnitGroup))
                                                    @foreach($sellingUnitGroup as $sellingGroup)
                                                      <option value="{{@$sellingGroup['id']}}">{{@$sellingGroup['unit']}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div> -->
                                    
                                   <!--  <div class="form-group">
                                        <label>Reward Type</label>
                                        <input class="form-control mb-2 reward_type_order" readonly="" name="reward_type" placeholder="Order Wise" type="text"  value="order">
                                    </div> -->

                                    <div class="form-group">
                                        <label>From Amount(SR)</label>
                                        <input class="form-control mb-2 fromAmt" name="from_amount" placeholder="Please enter from amount" type="text"  value="{{$rewardPointRecord['from_amount']}}">
                                    </div>
                                    
                                    <div class="form-group">
                                         <label>To Amount(SR)</label>
                                         <input class="form-control mb-2 toAmt" name="to_amount" placeholder="Please enter to amount" type="text"  value="{{$rewardPointRecord['to_amount']}}">
                                    </div>

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
               "from_amount": {
                  required:true,
                  number:true,
                  min: 1,
                  remote:{
                      url:"{{ url('admin/rewardPointManagement/check/edit/FromAmount')}}",
                      data:{
                          id:function(){
                              return $('.rewardPointId').val();
                          }
                      }
                  }
               },
               "to_amount": {
                  required:true,
                  number:true,
                  min: 1,
                  remote:{
                      url:"{{ url('admin/rewardPointManagement/check/edit/ToAmount')}}",
                      data:{
                          id:function(){
                              return $('.rewardPointId').val();
                          }
                      }
                  }
               },
               point:{
                   required: true,
                   number:true,
                   min: 1,
                   // remote:"{{ url('admin/generalManagement/check/name')}}",
               },
           },
           messages: {
            from_amount:{
                 required:"Please enter From Amount",
                minlength:"Minimum 1 digit is allowed",
                   remote:"*From Amount should be higher than previous entered amount",
            },
            to_amount:{
                required:"Please enter To Amount",
               minlength:"Minimum 1 digit is allowed",
                 remote:"*To Amount should be higher than previous entered amount",
               // maxlength:"Maximum 200 characters are allowed",
            },
            point:{
                 required: 'Please enter point',
                minlength: "Minimum 1 digit is allowed",
                   // remote: "*This point is already exists",
            },
         },

         submitHandler:function(form){
          
              var FromAmount = $('.fromAmt').val();
              var toAmount   = $('.toAmt').val();

               if(parseInt(toAmount) > parseInt(FromAmount)){
                  if($("#addRewrdForm").valid()){
                     form.submit();
                  }  
              }else if(parseInt(FromAmount) > parseInt(toAmount)){
                Swal.fire('To amount should be greater than From Amount') 
              }
         }

       });
    });
</script>

@stop


