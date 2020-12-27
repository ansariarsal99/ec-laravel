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


@extends('frontend.layout.providerLayout')
@section('title','Advertisement')
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
                                    <h3>My Advertisements</h3>
                                    <nav class="bread_nav_sec">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active"><a href="#">My Advertisements</a></li>
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
                                                                 <a href="{{url('/provider/advertisemnt/add')}}" class="btn btn_theme"><span>+ Add New</span></a>
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
                                                                            <tbody></tbody>
                                                                       <!--  <tbody>
                                                                            <tr>
                                                                                <td>1.</td>
                                                                                <td class="img_td">
                                                                                    <img src="https://www.worldsteel.org/.imaging/mte/worldsteel-internet-2016/social-large/dam/internetDocumentList/Images/2017/Media-section/About-steel/About-Steel.jpg/jcr:content/steel%20tubes.jpg" class="img-fluid">
                                                                                </td>
                                                                                <td>12/12/2019</td>
                                                                                <td>11/01/2020</td>
                                                                                <td class="act_crt">
                                                                                    <a class="cp text-primary">Edit</a></br>
                                                                                    <a class="cp text-danger">Delete</a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1.</td>
                                                                                <td class="img_td">
                                                                                    <img src="https://netstorage-legit.akamaized.net/images/eb7a53c66bc4b66a.jpg" class="img-fluid">
                                                                                </td>
                                                                                <td>17/09/2019</td>
                                                                                <td>16/10/2019</td>
                                                                                <td class="act_crt">
                                                                                    <a class="cp text-primary">Edit</a></br>
                                                                                    <a class="cp text-danger">Delete</a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1.</td>
                                                                                <td class="img_td">
                                                                                    <img src="https://www.worldsteel.org/.imaging/mte/worldsteel-internet-2016/social-large/dam/internetDocumentList/Images/2017/Media-section/About-steel/About-Steel.jpg/jcr:content/steel%20tubes.jpg" class="img-fluid">
                                                                                </td>
                                                                                <td>12/12/2019</td>
                                                                                <td>11/01/2020</td>
                                                                                <td class="act_crt">
                                                                                    <a class="cp text-primary">Edit</a></br>
                                                                                    <a class="cp text-danger">Delete</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody> -->
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
           @stop
@section('script')

<script>
    $(function() {
        var t = $('#advertisemntList').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            ajax: '{{url('/provider/advertisemnt/index')}}',
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
                     url: "{{ url('provider/advertisemnt/delete/') }}" + '/' + id,
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