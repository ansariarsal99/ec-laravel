<?php  
    if (!empty(Auth::guard('admin')->user()['image'])) {
        $imgpath= frontendAdvertImageBasePath.'/'.Auth::guard('admin')->user()['image'];    
    }                                                                                        
    if(!empty(Auth::guard('admin')->user()['image']) && file_exists($imgpath) ) { 
        // dd($imgpath);
        $admin_image = frontendAdvertImagePath.'/'.Auth::guard('admin')->user()['image'];    
    }else{
        $admin_image = defaultAdminImagePath.'/no_image.png';  
        // dd($admin_image);
    }                                           
?> 

@extends('frontend.layout.layout')
@section('title','My Advertisements')
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
        
        <div class="wrapper_shala innerPages">
            <div class="pagntn">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Advertisements</li>
                    </ol>
                </nav>
            </div>
            
            <section class="prof_dashboard padd_all_sec">
                <div class="container-fluid">
                    <div class="row">
                        
                            @include('frontend.include.userSidebar')

                        <div class="col-sm-9">
                            <div class="mainside_wrap">
                                <!--  -->
                              <!--   <div class="page_head">
                                   <div class="new_adv text-right">
                                        <a href="{{url('/provider/advertisemnt/add')}}" class="btn btn_theme"><span>+ Add New</span></a>
                                    </div>
                                </div> -->
                                <div class="main_cntnt_dash">
                                    <div class="card advert_dash">
                                        <!--  -->
                                        <div class="cont_shd_frm">
                                            <div class="adverts_wrap pad15">
                                                <div class="new_adv text-right">
                                                     <a href="{{url('/user/advertisemnt/user/add')}}" class="btn btn_theme"><span>+ Add New</span></a>
                                                </div>
                                                <div class="singl_advrt">
                                                    <!-- <div class="table-responsive"> -->
                                                        <table id="advertisemntList" class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Image</th>
                                                                    <th>Title</th>
                                                                    <th>Publish Date</th>
                                                                    <th>Exp. Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>  
                                                        </table>
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
           @stop
@section('script')

<script>
    $(function() {
        var t = $('#advertisemntList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('user/advertisemnt/index')}}',
            columns: [
                { data: 'DT_RowIndex',      name: 'id', searchable: false,  visible:true},
                { data: 'image',            name: 'image'},
                { data: 'title',            name: 'title'},
                { data: 'publish_date',     name: 'publish_date'},
                { data: 'expiry_date',      name: 'expiry_date'},
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

            
        });
    });
    
</script>

<script>
     $(document).on('click','.delete-btn',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
             var id =$(this).attr('del_idd');
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
                     url: "{{ url('user/advertisemnt/user/delete/') }}" + '/' + id,
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