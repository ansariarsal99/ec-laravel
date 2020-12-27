@extends('frontend.layout.providerLayout')
@section('title','My Locations')
@section('content')
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
                            <h3>My Locations</h3>
                            <nav class="bread_nav_sec">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">My Locations</a></li>
                                    <!-- <li class="breadcrumb-item active">Item List</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </section>
                <div class="marg_over_bread">
                    <section class="item_list_sec p-0">
                        <div class="db_container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="new_div_aded">
                                                <div class="inr_signup left_info">
                                                    <div class="ordr-addr">
                                                        <div class="acc-body-addr">
                                                            <div class="saved_adrss">
                                                                <div class="row">
                                                                    @if(isset($storeLocations) && sizeof($storeLocations)>0)
                                                                        @foreach($storeLocations as $key => $storeLocation)
                                                                            @if(!empty($storeLocation))
                                                                                <div class="prvdr_adrs col-sm-6">
                                                                                    <div class="wrap_svd_adrs">
                                                                                        <div class="d-flex justify-content-between">
                                                                                            <div class="d-flex justify-content-center align-items-center">
                                                                                                <i class="fa fa-map-marker"></i>
                                                                                                <p class="ml-3 mb-0"><label class="badge badge-primary">{{@$storeLocation['store_location_address_type_detail']['name']}}</label></p>
                                                                                            </div>
                                                                                            @if($storeLocation['use_address_as_default']=='yes')
                                                                                                <span class="badg_deflt">Default</span>
                                                                                            @endif
                                                                                        </div>
                                                                                        <h2 class="pt-2">{{@$storeLocation['store_name']}}</h2>
                                                                                        <p class="mb-1">{{@$storeLocation['street']}}</p>
                                                                                        <h5 class="mb-1">{{@$storeLocation['city_detail']['name']}}, {{@$storeLocation['country_detail']['name']}}</h3>
                                                                                        <p class="lc-mark">
                                                                                            <i class="fa fa-location-arrow mr-2" aria-hidden="true"></i>{{@$storeLocation['location']}}
                                                                                        </p>


                                                                                        <div class="form-group svd_ic d-flex justify-content-between align-items-center">
                                                                                            <button type="button" class="btn btn_theme use_adrs_btn">
                                                                                                <span>Use as Default</span>
                                                                                            </button>
                                                                                            <span data-id="{{base64_encode($storeLocation['id'])}}" class="mb-4 text-center">
                                                                                                <a class="edt_adrs"><i class="fa fa-edit"></i> Edit</a><br />
                                                                                                <a class="rmv_adrs"><i class="fa fa-times"></i> Remove</a>
                                                                                            </span>
                                                                                        </div>



                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    <!-- <div class="col-sm-6">
                                                                        <div class="wrap_svd_adrs">
                                                                            <i class="fa fa-map-marker"></i>
                                                                            <h3>Park Plaza, Chandigarh</h3>
                                                                            <p>B 1/425, Kapoor Niwas, Near Bridge Gateway, Kundanpuri, Ludhiana </p>
                                                                            <div class="form-group svd_ic d-flex justify-content-end">
                                                                                <button type="button" class="btn btn_theme"><span>Make Default</span></button>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                                                                </div>
                                                            </div>

                                                             <div class="text-right mb-2">
                                                                <a href="javascript:;" class="new_adrs_p"><i class="fa fa-plus"></i> Add New Address</a>
                                                            </div>

                                                         <div class="user_adrs pad20 user_ad_adrss">
                                                            <div class="new_adrs">
                                                                <div class="new_locas">
                                                                    <h4> Add New Address </h4>
                                                                </div>
                                                                <form class="addStoreLocationForm" method="POST" action="{{url('/provider/storeLocation/add')}}">
                                                                    @csrf
                                                                    <div class="cont_rp_form addrs_div">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Address Name</label>
                                                                                    <input type="text" name="store_name" class="form-control" placeholder="Address Name">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group text-left">
                                                                                    <label>Address Type</label>
                                                                                    <!-- <input type="text" name="store_name" class="form-control" placeholder="Name"> -->
                                                                                    <select name="address_type_id" class="form-control custom-select">
                                                                                        @if(isset($storeLocationAddressTypes) && sizeof($storeLocationAddressTypes)>0 )
                                                                                            @foreach($storeLocationAddressTypes as $key => $storeLocationAddressType)
                                                                                                @if(!empty($storeLocationAddressType))
                                                                                                    <option value="{{@$storeLocationAddressType['id']}}">{{@$storeLocationAddressType['name']}}</option>
                                                                                                @endif
                                                                                            @endforeach                                  
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group text-left">
                                                                                    <label>Street</label>
                                                                                    <input type="text" name="street" class="form-control" placeholder="Street">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Street</label>
                                                                                    <input type="text" name="street" class="form-control" placeholder="Street">
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                                                        <div class="row">
                                                                            <!-- <div class="col-sm-6">
                                                                                <div class="form-group text-left">
                                                                                    <label>State</label>
                                                                                    <select name="state_id" class="form-control custom-select state_id_class">
                                                                                        <option value="" disabled="" selected>Select State</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div> -->
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group text-left">
                                                                                    <label>Country</label>
                                                                                    <select name="country_id" class="form-control custom-select chng_cntry">
                                                                                        <option value="" disabled="" selected>Select Country</option>
                                                                                        @foreach($countries as $key => $country)
                                                                                            <option value="{{$country['id']}}">{{$country['name']}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group text-left">
                                                                                    <label>City</label>
                                                                                    <!-- <input type="text" name="city" class="form-control" placeholder="City"> -->
                                                                                    <select class="form-control custom-select chng_city" name="city_id">
                                                                                        <option value="" disabled="" selected="">Select City</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group text-left">
                                                                                    <label>Location</label>
                                                                                    <input type="text" name="location" class="form-control" placeholder="Location">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28900.22947607954!2d55.117153479588616!3d25.117811021706277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f152a683c0d79%3A0x546802ab643feb7f!2sThe%20Palm%20Jumeirah%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1593162628612!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <button class="btn btn_theme"><span>Add Address</span></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        </div>
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
    @include('frontend.include.modals.useStoreLocationAsDefault')
    @include('frontend.include.modals.providerEditStoreLocation')
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
         $('.user_ad_adrss').hide();
        $('body').on('click', '.new_adrs_p', function(){
            $('.user_ad_adrss').slideToggle('normal');
        });
        
        var userFormValidator = $('.addStoreLocationForm').validate({
            ignore:[],
            rules:{
                title:{
                    required:true,
                },
                store_name:{
                    required:true,
                },
                street:{
                    required:true,
                },
                country_id:{
                    required:true,                  
                },
                state_id:{
                    required:true,                  
                },
                // city:{
                //     required:true,                     
                // },
                city_id:{
                    required:true,                     
                },
                location:{
                    required:true,
                }                
            },
            messages:{
                title:{
                    required:"Please enter title",
                }, 
                store_name:{
                    required:"Please enter name",
                },     
                street:{
                    required:"Please enter street",
                },
                country_id:{
                    required:"Please select country",
                },
                state_id:{
                    required:"Please select state",
                },
                // city:{
                //     required:"Please enter city",                
                // },
                city_id:{
                    required:"Please select city",                
                },
                location:{
                    required:"Please enter location",
                }
            },
        });

        // get states of selected country
        $("body").on('change', '.country_id_class', function(){
            $('.loader').show();
            var countryId = $(this).val();
            ths = $(this);
            // $('.region_request_class').val(regionId);
            $.ajax({
                url: "{{ url('/getStates') }}",
                data: {countryId:countryId},
                type: 'POST',
                success: function (data) {
                    $('.loader').hide();
                    // $('.state_id_class').html(data);
                    // $('.city_id_class').html("<option value='' selected disabled> Select Town </option>");
                    ths.closest('.addrs_div').find('.state_id_class').html(data);
                    ths.closest('.addrs_div').find('.city_id_class').html("<option value='' selected disabled> Select City </option>");
                 }         
            });
        });

        $("body").on('click','.edt_adrs',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_address_id = $(this).parent().data('id');
            $.ajax({
                url:"{{url('provider/storeLocation/editModal')}}"+"/"+enc_address_id,
                type: "post",
                success:function(resp){
                    $('.loader').hide();
                    if (resp.status=='success') {
                        $('.adrs_div_mod').html(resp.html);
                        $('#edit_addrs_mod').modal('show');
                    }else{
                        toastr.error('Oops, Something went wrong');
                    }
                },
                error:function(){
                    $(".loader").hide();
                    swal('Oops, Something went wrong');
                }
            });
        });

        $("body").on('click','.rmv_adrs',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_address_id = $(this).parent().data('id');
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
                    url:"{{url('provider/storeLocation/delete')}}"+"/"+enc_address_id,
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            ths.closest('.prvdr_adrs').remove();
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

        $("body").on('click','.use_adrs_btn',function(){
            // alert('here');
            // alert($(this).next().data('id'));
            $('.adrs_id_cls').val($(this).next().data('id'));
            $('#use_address_as_default_mod').modal('show');
        });

        $("body").on('change','.chng_cntry',function(){
            var country_id = $(this).val();
            ths = $(this);
            // alert(country_id);
            $.ajax({
                url:"{{url('getCountryRelatedCities')}}",
                data:{ country_id:country_id,_token:"{{ csrf_token() }}" },
                type:'POST',
                success:function(data){
                    // $('.chng_city').html(data);
                    ths.closest('.addrs_div').find('.chng_city').html(data);
                } 
            }); 
        });

       
    });
</script>
@stop