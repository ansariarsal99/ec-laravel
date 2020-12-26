@extends('frontend.layout.providerLayout')
@section('title','Discount Code List')
@section('content')

        <div class="wrapper_shala seller_db_inner">
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
                                    <h3>Discount Code List</h3>
                                    <nav class="bread_nav_sec">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"><a href="#">Discount Code List</a></li>
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
                                                    <div class="cont_shd_frm">
                                                        <div class="adverts_wrap pad15">
                                                            <div class="new_adv text-right">
                                                                 <a href="{{url('/provider/discountCode/add')}}" class="btn btn_theme"><span>+ Add New</span></a>
                                                            </div>
                                                            <div class="singl_advrt">
                                                               <table id="discountCodeList" class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Product Name</th>
                                                                            <th>Product Seller Code</th>
                                                                            <th>Product Bar Code</th>
                                                                            <th>Discount Code</th>
                                                                            <th>Offer Start Date</th>
                                                                            <th>Offer End Date</th>
                                                                            <th>Status</th>
                                                                            <th>Action</th>
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
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
           @stop
@section('script')

<script>
    $(function() {
        var t = $('#discountCodeList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('/provider/discountCode/List/Index')}}',
            columns: [
                { data: 'DT_RowIndex',      name: 'id', searchable: false,  visible:true},
                { data: 'new_product',      name: 'new_product'},
                { data: 'sellercode',       name: 'sellercode'},
                { data: 'barCode',          name: 'barCode'},
                { data: 'discount_code',    name: 'discount_code'},
                { data: 'offer_start_date', name: 'offer_start_date'},
                { data: 'offer_end_date',   name: 'offer_end_date'},
                { data: 'status',           name: 'status'},
                { data: 'action',           name: 'action', orderable: false },  
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
            //         console.log($(this).attr('rel'));
            //         dd($(this).attr('id'));
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
    //     alert(status);
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

<script type="text/javascript">
    $(document).on('click', '.drop-class', function(){
        var status = 'active';
        var currentClass = $(this);
        if($(this).hasClass('inactive-class')) {
            status = 'inactive';
        } 
        var id = $(this).attr('discountCodeId');
        $.ajax({
            data:{status:status, id:id},
            type:'post',
            url: "{{ url('provider/discountCode/change/status') }}",
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
     $(document).on('click','.delete-btn',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
             var id =$(this).attr('del_id');
             // var delId =$(this).val(del_id);
              // alert(delId);

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
                     url: "{{ url('provider/discountCode/delete/') }}" + '/' + id,
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            ths.closest('tr').remove();
                            // $(ev).closest('tr').hide();
                            Swal.fire(
                              'Deleted!',
                              'Your address has been deleted.',
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

@stop