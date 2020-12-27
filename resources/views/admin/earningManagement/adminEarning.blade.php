@extends('admin.layout.adminLayout')
@section('title','Admin Commission List')
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
                        <h1>Earning Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#"> Earning Management</a></li>
                            <li class="active">Admin Commission List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <strong class="card-title">Admin Commission List</strong>
        <!--                <a href="{{url('admin/rewardPointManagement/reward/addReward/point')}}" class="btn btn-outline-danger" style="float:right;">Add New </a> -->
                       <!-- <a href="{{url('admin/rewardPointManagement/reward/export')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a> -->
                    </div>
                    <div class="card-body">
                       <table id="rewardPointList" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                   <th>#</th>
                                   <th>Order No</th>
                                   <th>Order Date</th>
                                   <th>Buyer Name</th>
                                   <th>Product Name</th>
                                   <th>Product Seller Code</th>
                                   <th>Product Bar Code</th>
                                   <th>Admin Commision</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- //////////////// Change Order Staus//////////////////// -->

        <div class="modal fade edit_div cancl_ordr_modl" id="change_order_status_id" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title " id="exampleModalCenterTitle">Change Order status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('.loader').hide();
                        });
                    </script>

                    <div class="modal-body">
                        <div class="card_info text-center">
                              <p>Are you sure you want to change the status of order ?</p>
                            <form id="acceptRequestForm" method="POST as">
                            
                             <input type="hidden" name="orderId" class="orderIDD" value="">
                             <input type="hidden" name="productId" class="productIDD" value="">
                                <div class="col-sm-6 offset-sm-3">   
                                    <div class="form-group">
                                        <select class="form-control order_status_cls" name="order_status_id">
                                        </select>
                                    </div>
                                      
                                </div>
                            </form> 
                        </div>
                    </div>
                     <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn_theme" data-dismiss="modal" aria-label="Close"><span>cancel</span></button>
                        <button type="submit" class="btn btn_theme change_product_order_request"><span>Confirm</span></button>
                    </div>
                </div>
            </div>
        </div>
<!-- ////////////// -->


@stop
@section('script')

<script>
    $(function() {
        var t = $('#rewardPointList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('admin/adminearning/list/index')}}',
            columns: [
                { data: 'DT_RowIndex',       name: 'id', searchable: false,  visible:true, orderable: false},
                { data: 'OrderInvoiceId',    name: 'OrderInvoiceId'},
                { data: 'placed_on',         name: 'placed_on'},
                { data: 'buyer_name',      name: 'product_name'},
                { data: 'product_name',      name: 'product_name'},
                { data: 'ProductSellerCode', name: 'ProductSellerCode'},
                { data: 'ProductBarCode',    name: 'ProductBarCode'},
                { data: 'admin_commission',  name: 'admin_commission'}, 
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    $('.searchable_table thead').after($('.searchable_table tfoot tr'))
                    var column = this;
                    var input = document.createElement("input");
                    input.className = "tr_tfoot_input"
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            },

            // fnDrawCallback: function(){
            //     $('.status_button_toggle').each(function(i, e){
            //         // console.log($(this).attr('rel'));
            //         var attr_rel = $(this).attr('rel');
            //         var attr_ral = $(this).attr('ral');
            //         var attr_id  = $(this).attr('id');
            //         var refundStatus = $(this).attr('refundStatus');
            //         var product_id  = $(this).attr('product_id');

            //         $('#'+attr_id).btnSwitch({
            //             Theme: 'Light',
            //             ToggleState: attr_rel == 'active' ? true : false,
            //             OnCallback: function(val) {
            //                 changeStatus('active',attr_ral,refundStatus,product_id);
            //             },
            //             OffCallback: function(val) {
            //                 changeStatus('inactive',attr_ral);
            //             },
            //         });
            //     });
            // }
        });
    });
        // alert(id);
    // function changeStatus(status, id){

    //             $.ajax({
    //                 url: "{{url('admin/rewardPointManagement/status')}}",
    //                 type:'post',
    //                 data:{_token: "{{csrf_token()}}",id:id, status:status},
    //                 dataType:'json',
    //                 success:function(res){
    //                     if(res.status == 'success'){
    //                         toastr.success(res.message);
    //                     }else{
    //                         toastr.error(res.message);
    //                     }
    //                 },error(){
    //                     toastr.error('Something went wrong');
    //                 }
    //             })
    //         }
</script>




<script>
    $("body").on('click','.changeOrderStatus',function(){
        var ths = $(this);
        var productOrderId  = $(this).attr("order_item_id");
        var productId       = $(this).attr("product_id");
        var refundStatusId   = $(this).attr("orderStatusId");
        
        $.ajax({
           url:"{{url('admin/refundApproval/updated/RefundProduct/status/ByAdmin')}}",
           data:{productOrderId:productOrderId,productId:productId,refundStatusId:refundStatusId},
           type:'post',
           success:function(response){
            // alert();
                  $('#change_order_status_id').modal('show');
                  $('.order_status_cls').html(response);
                  $('.orderIDD').val(ths.attr("order_item_id"));
                  $('.productIDD').val(ths.attr("product_id"));
           }
        })
    });

</script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('.loader3').hide();
    });
</script> -->

<script>
    $("body").on('click','.change_product_order_request',function(){
        $('.loader').show(); 
        $.ajax({
                url:"{{url('admin/refundApproval/refund/status')}}",
                data:$("#acceptRequestForm").serialize(),
                type:'post',
                success:function(response){
                    if(response['status']=='true'){
                        $('.loader').hide();
                        $('#change_order_status_id').modal('hide');
                        location.reload();      
                    }else{
                        toastr.error('Something went wrong');
                    }
                }
         })
    });
</script>

@stop