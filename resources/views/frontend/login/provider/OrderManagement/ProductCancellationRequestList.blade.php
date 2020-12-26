@extends('frontend.layout.providerLayout')
@section('title','Product Cancellation Request List')
@section('content')
<style type="text/css">
  .img_td img {
    width: 80px;
    min-width: 80px;
    height: 60px;
    min-height: 60px;
    object-fit: cover;
    border-radius: 5px;
    box-shadow: 0 0 12px -5px #000;
}
</style>    
            <section class="outer_db_wraper db_seller_items_list">
                <div class="combine_side_main_slr_db d-flex">
                    <div class="sidenav_seller_db">
                    @include('frontend.include.providerSidebar')  

                    </div>
                    <div class="main_seller_db item_list_seller_db">
                        <section class="bread_top_sec">
                            <div class="db_container">
                                <div class="d-flex justify-content-between text-white pos_rel">
                                    <div class="sid_controlr">
                                        <i class="clos_sid fa fa-bars"></i>
                                        <i class="opn_sid fa fa-times"></i>
                                    </div>
                                    <h3>Product Cancellation Request List</h3>
                                    <nav class="bread_nav_sec">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                            <li class="breadcrumb-item active"><a href="javascript:;">Product Cancellation Request List</a></li>
                                            <!-- <li class="breadcrumb-item active">Item List</li> -->
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </section>
                        <div class="marg_over_bread">
                            <section class="item_list_sec p-0 ">
                                <div class="db_container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card_ttl d-flex align-items-center justify-content-between">
                                                        <!-- <h3>Product Cancellation Request List</h3> -->
                                                        <div class="">
                                                            <!-- <a href="{{url('provider/services/add')}}" class="card_btn_top">+ Add Services</a> -->
                                                            <!-- <a href="{{url('provider/export/serviceList')}}"><button class="btn btn-sm btn_theme"><span>Export</span></button></a> -->
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="cont_shd_frm">
                                                        <div class="adverts_wrap pad15">
                                                        
                                                            <div class="singl_advrt">
                                                                <!-- <div class="table-responsive"> -->
                                                                <table id="productList" class="table table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Product  Name</th>
                                                                                <th>Product Seller Code</th>
                                                                                <th>Product Bar Code</th>
                                                                                <th>Order Id</th>
                                                                                <th>Order Status</th>
                                                                                <!-- <th>Status</th> -->
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                </table>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>

            <!-- //////////////// Send ACCEPTED Response to user//////////////////// -->

            <div class="modal fade edit_div cancl_ordr_modl" id="AcceptOrderUserRequest" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title " id="exampleModalCenterTitle">Cancellation Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card_info text-center">
                                  <p>Are you sure you want to Accept this request ?</p>
                                <form id="acceptRequestForm" method="POST as">
                                  <div class="form-group">
                                     <!-- <h6>Reason For Acceptance:</h4> -->
                                         <!-- <br> -->
                                     <!-- <textarea class="form-control reasonCancl" rows="4" name="reason" placeholder="Write a reason here..."></textarea> -->
                                  </div>
                                 <input type="hidden" name="orderId" class="orderIDD" value="">
                                 <input type="hidden" name="productId" class="productIDD" value="">
                                </form> 
                            </div>
                        </div>
                         <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn_theme" data-dismiss="modal" aria-label="Close"><span>cancel</span></button>
                            <button type="submit" class="btn btn_theme accept_product_request"><span>Confirm</span></button>
                        </div>
                    </div>
                </div>
            </div>
    <!-- ////////////// -->

            <!-- ///////////// -->
            <!-- Reject Cancellation Request modal -->
            <div class="modal fade edit_div cancl_ordr_modl" id="rejectCancelationRequest" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title " id="exampleModalCenterTitle">Product Cancellation Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card_info text-center">
                                  <p>Are you sure you want to reject this request ?</p>
                                <form id="rejectedRequestForm" method="POST as">
                                  <div class="form-group">
                                     <h6>Reason For Rejection:</h4>
                                         <br>
                                     <textarea class="form-control reasonCancl" rows="4" name="reason" placeholder="Write a reason here..."></textarea>
                                  </div>
                                 <input type="hidden" name="orderId" class="order_id" value="">
                                 <input type="hidden" name="productId" class="product_id" value="">
                                </form> 
                            </div>
                        </div>
                         <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn_theme" data-dismiss="modal" aria-label="Close"><span>cancel</span></button>
                            <button type="submit" class="btn btn_theme cancel_product"><span>Confirm</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /////////// -->


           @stop
@section('script')

<script>
    $(function() {
        var t = $('#productList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('/provider/productCancellationRequest/list/Index')}}',
            columns: [
                { data: 'DT_RowIndex',       name: 'id', searchable: false,  visible:true, orderable: false},
                { data: 'product_name',      name: 'product_name'},
                { data: 'ProductSellerCode', name: 'ProductSellerCode'},
                { data: 'ProductBarCode',    name: 'ProductBarCode'},
                { data: 'OrderInvoiceId',    name: 'OrderInvoiceId'},
                { data: 'orderStatus',       name: 'orderStatus'},
                { data: 'action',            name: 'action', orderable: false },  
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
            //         var attr_id = $(this).attr('id');
            //         $('#'+attr_id).btnSwitch({
            //             Theme: 'Light',
            //             ToggleState: attr_rel == 'active' ? true : false,
            //             OnCallback: function(val) {
            //                 changeStatus('active',attr_ral);
            //             },
            //             OffCallback: function(val) {
            //                 changeStatus('inactive',attr_ral);
            //             },
            //         });
            //     });
            // }
        });
    });
        // alert(status);
    // function changeStatus(status, id){
    //             $.ajax({
    //                 url: "{{url('admin/userManagement/individual/status')}}",
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
$(document).on('click','.delete-btn',function(e){
        e.preventDefault();
        var id =$(this).attr('del_id');
        var ths = $(this);
        swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                 url: "{{ url('provider/services/delete') }}" + '/' + id,
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        ths.closest('tr').remove();
                        Swal.fire(
                          'Deleted!',
                          'Your product has been deleted.',
                          'success'
                        )
                    }else{
                        swal('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
          }
        })            
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.drop-class', function(){
        var status = 'active';
        var currentClass = $(this);
        if($(this).hasClass('inactive-class')) {
            status = 'inactive';
        } 
        var id = $(this).attr('product-id');
        $.ajax({
            data:{status:status, id:id},
            type:'post',
            url: "{{ url('provider/services/change/status') }}",
                success:function(resp){
                    if(resp.product_status == 'active'){
                        currentClass.text('Make Inactive');
                        currentClass.closest('.btn-group').find('.btn-class').text('Active');
                        currentClass.addClass('inactive-class').removeClass('active-class');
                        currentClass.closest('.btn-group').find('.btn-sm').addClass('btn-success').removeClass('btn-danger');
                    } else {
                        currentClass.text('Make Active');
                        currentClass.closest('.btn-group').find('.btn-class').text('Inactive');
                        currentClass.addClass('active-class').removeClass('inactive-class');
                        currentClass.closest('.btn-group').find('.btn-sm').addClass('btn-danger').removeClass('btn-success');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                } 
        })
    })
</script>

<script>
    $("body").on('click','.use_accept_btn',function(){
        var productOrderId = $(this).attr("order_item_id");
        var productId = $(this).attr("product_id");
        
        $('.productIDD').val(productId);
        $('.orderIDD').val(productOrderId);

        $('#rejectCancelationRequest').modal('hide');
        $('#AcceptOrderUserRequest').modal('show');
    });

    
        $('.accept_product_request').on('click',function(){
                $('.loader').show(); 
                $.ajax({
                    url:"{{url('provider/productCancellationRequest/Accepted/BySeller')}}",
                    data:$("#acceptRequestForm").serialize(),
                    type:'post',
                    success:function(response){
                        if(response['status']=='true'){
                            $('.loader').hide();
                            $('#AcceptOrderUserRequest').modal('hide');
                            $('#rejectCancelationRequest').modal('hide');
                            location.reload();      
                        }else{
                            toastr.error('Something went wrong');
                        }
             
                    }
                })
            });

</script>

<script>
    $("body").on('click','.use_reject_btn',function(){
        var productOrderId = $(this).attr("order_item_id");
        var productId = $(this).attr("product_id");

        $('.product_id').val(productId);
        $('.order_id').val(productOrderId);

        $('#AcceptOrderUserRequest').modal('hide');
        $('#rejectCancelationRequest').modal('show');
    });

        
        $('.cancel_product').on('click',function(){
                $('.loader').show(); 
                $.ajax({
                    url:"{{url('provider/productCancellationRequest/Rejected/BySeller')}}",
                    data:$("#rejectedRequestForm").serialize(),
                    type:'post',
                    success:function(response){
                        if(response['status']=='true'){
                            $('.loader').hide();
                            $('#AcceptOrderUserRequest').modal('hide');
                            $('#rejectCancelationRequest').modal('hide');
                            location.reload();      
                        }else{
                            toastr.error('Something went wrong');
                        }
             
                    }
                })
            });

    
</script>
@stop