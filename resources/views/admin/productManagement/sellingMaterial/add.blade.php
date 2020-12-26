@extends('admin.layout.adminLayout')
@section('title','Add Product Selling Material')
@section('content')

 @include('admin.include.header')

 @include('admin.include.sidebar')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Product Management</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Product Management</a></li>
                                <li class="active">Add Product Selling Material</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <form method="post" id="addRewrdForm" action="{{url('admin/sellingMaterial/add')}}">
              @csrf
                <div class="card">
                    <div class="card-header text-center">
                       <strong class="card-title"> Add Product Selling Material</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="terms_page my-4">
                                <form>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control category_id_class" name="product_category_id" type="text" value="">
                                            <option selected disabled>Select Category</option>
                                                @if(isset($productCategories) && !empty($productCategories))
                                                    @foreach($productCategories as $Categories)
                                                      <option value="{{@$Categories['id']}}">{{@$Categories['name']}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                     </div>

                                    <div class="form-group">
                                        <label>Sub Category</label>
                                        <select class="form-control sub_category_class" name="product_sub_category_id" type="text" value="">
                                            <option selected disabled>Select Sub Category</option>
                                        </select>
                                    </div>

<!--                                     selling_material_name
                                    product_category_id
                                    product_sub_category_id -->

                                    <!-- <div class="form-group">
                                        <label class="build_label">Select Sub Category</label>
                                        <select class="form-control mul_category sub_category_class" name="sub_category_id[]">
                                        </select>
                                        <label id="sub_category_id[]-error" class="error" for="sub_category_id[]"></label>
                                    </div> -->

                                    <div class="form-group">
                                        <label>Selling Material Name</label>
                                        <input class="form-control mb-2"  name="selling_material_name" type="text" placeholder="Please enter selling material name"  value="">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <script>
    $(document).on('change', '.category_id_class', function(){
        categoryId = $(this).val();
        // alert(categoryId);
        $.ajax({
            url:"{{url('admin/get/all/subcategory')}}",
            data:{categoryId : categoryId,_token:"{{ csrf_token() }}"},
            type:'POST',
            success:function(data) {
                $('.sub_category_class').html(data);
            }
        })
    })
</script>

<script>
    $(function(){
        $("#addRewrdForm").validate({
            rules:{
               category_id:{
                  required: true,
               },
               // sub_category_id:{
               //    required: true,
               // },
               selling_material_name:{
                  required: true,
               },
           },
           messages: {
               category_id:{
                  required: 'Please select category',
               },
               // sub_category_id:{
               //    required: 'Please select sub category',
               // },
               selling_material_name:{
                  required: 'Please enter selling material name',
               },
         },

         // submitHandler:function(form){
             
         //     var FromAmount = $('.fromAmt').val();
         //     var toAmount   = $('.toAmt').val();

         //     if(toAmount >FromAmount){
         //       if($("#addRewrdForm").valid()){
         //          form.submit();
         //       }  
         //     }else if(FromAmount >toAmount){
         //       Swal.fire('To amount should be greater than From Amount') 
         //     }
         // }


       });
    });
</script>

@stop