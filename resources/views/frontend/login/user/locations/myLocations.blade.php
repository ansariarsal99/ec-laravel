@extends('frontend.layout.layout')
@section('title','My Locations')
@section('content')
    <div class="pagntn">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">My Locations</li>
            </ol>
        </nav>
    </div>
    
    <section class="prof_dashboard padd_all_sec">
        <div class="container-fluid">
            <div class="row">                
                @include('frontend.include.userSidebar')
                <div class="col-sm-9">
                    <div class="mainside_wrap">
                        <div class="page_head">
                            <h4>My Locations</h4>
                            <!-- <h6>Lorem ipsum dolor sit amet, consectetur do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6> -->
                        </div>
                        <div class="main_cntnt_dash">
                            <div class="card order_prof_dash">
                                <div class="cont_shd_frm">
                                    <div class="wrap_adrs pad20">
                                        @if(isset($userAddresses) && !empty($userAddresses))
                                            @foreach($userAddresses as $key => $userAddress)
                                                @if(!empty($userAddress))
                                                    <div class="user_adrs pad20">
                                                        <div class="adrs_topp">
                                                            <div class="row">
                                                                <div class="col-sm-9">
                                                                    <div class="sav_adrs">
                                                                        <p class=""><label class="badge badge-primary">{{@ucfirst($userAddress['address_title'])}}</label></p>
                                                                        <p class="nam_numb">{{@ucfirst($userAddress['province_name'])}} &nbsp; &nbsp; &nbsp; {{@ucfirst($userAddress['city_detail']['name'])}}, {{@ucfirst($userAddress['country_detail']['name'])}}</p>
                                                                        <p class="adrs_usr"><i class="fa fa-location-arrow"></i>&ensp;{{@ucfirst($userAddress['location'])}} - {{@ucfirst($userAddress['postal_code'])}}</p>
                                                                        <p class="adrs_usr"><i class="fa fa-address-card-o"></i>&ensp;{{@ucfirst($userAddress['address'])}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="use_new_adres d-flex flex-column align-items-center">
                                                                        @if($userAddress['use_address_as_default']=='yes')
                                                                            <span class="badg_deflt mb-4">Default</span>
                                                                        @endif
                                                                        <span data-id="{{base64_encode($userAddress['id'])}}" class="mb-4">
                                                                            <a class="edt_adrs"><i class="fa fa-edit"></i> Edit</a>
                                                                            <a class="rmv_adrs"><i class="fa fa-times"></i> Remove</a>
                                                                        </span>
                                                                        <button type="button" class="btn btn_theme use_adrs_btn"><span>Use as Default</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        <div class="text-right mb-2">
                                            <a href="javascript:;" class="new_adrs_p"><i class="fa fa-plus"></i> Add New Address</a>
                                        </div>

                                        <div class="user_adrs pad20 user_ad_adrss">
                                            <div class="new_adrs">
                                                <div class="new_locas">
                                                    <h4> Add New Address </h4>
                                                </div>
                                                <form class="addAddressForm" method="POST" action="{{url('/user/address/add')}}">
                                                    @csrf
                                                    <div class="addrs_div">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Address Title/Name</label>
                                                                    <input type="text" name="address_title" class="form-control" placeholder="Home/Office/Store">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Address Detail</label>
                                                                    <input type="text" name="address" class="form-control" placeholder="Builiding Name/Floor No./Office No.">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Province</label>
                                                                    <input type="text" name="province_name" class="form-control" placeholder="Province Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group text-left">
                                                                    <label>Postal Code</label>
                                                                    <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group text-left">
                                                                    <label>Country</label>
                                                                    <select name="country_id" class="form-control custom-select chng_cntry">
                                                                        <option value="" disabled="" selected>Select Country</option>
                                                                        @foreach($countries as $key => $country)
                                                                            @if(!empty($country))
                                                                                <option value="{{@$country['id']}}">{{@$country['name']}}</option>
                                                                            @endif
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
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Location</label>
                                                                    <input type="text" class="form-control" placeholder="Location" name="location">
                                                                </div>
                                                                <div class="form-group text-left">
                                                                    <div class="adrs_map">
                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d231350.7620923537!2d55.1940508!3d25.0389721!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41ea57253d9dc545!2sOkzeela%20Star%20Building%20Materials%20Trading%20llc!5e0!3m2!1sen!2sin!4v1589633056776!5m2!1sen!2sin" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="text-right log_btn">
                                                                    <a href="javascript:;" class="btn btn_theme add_adrs_btn"><span>Add Address</span></a>
                                                                </div>
                                                            </div>
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
    </section>
    @include('frontend.include.modals.useAddressAsDefault')
    @include('frontend.include.modals.userEditAddress')
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.user_ad_adrss').hide();
        $('body').on('click', '.new_adrs_p', function(){
            $('.user_ad_adrss').slideToggle('normal');
        });

        $('.addAddressForm').validate({
            ignore:[],
            rules:{
                address_title:{
                    required:true
                },
                address:{
                    required:true
                },
                province_name:{
                    required:true
                },
                postal_code:{
                    required:true,
                    digits:true
                },
                country_id:{
                    required:true
                },
                // state_id:{
                //     required:true
                // },
                // city:{
                //     required:true
                // },
                city_id:{
                    required:true
                },
                location:{
                    required:true
                }
            },
            messages:{
                address_title:{
                    required:"Please enter address title"
                },
                address:{
                    required:"Please enter address"
                },
                province_name:{
                    required:"Please enter province name",
                },
                postal_code:{
                    required:"Please enter postal code",
                },
                country_id:{
                    required:"Please select country",
                },
                // state_id:{
                //     required:"Please select state",
                // },
                // city:{
                //     required:"Please enter city",
                // },
                city_id:{
                    required:"Please select city",
                },
                location:{
                    required:"Please enter location",
                }
            }
        });

        $("body").on('click','.add_adrs_btn',function(){
            $('.addAddressForm').submit();
        });

        $("body").on('click','.edt_adrs',function(e){
            e.preventDefault();
            // alert($(this).parent().data('id'));
            var enc_address_id = $(this).parent().data('id');
            $.ajax({
                url:"{{url('user/address/editModal')}}"+"/"+enc_address_id,
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
                    url:"{{url('user/address/delete')}}"+"/"+enc_address_id,
                    success:function(resp){
                        $('.loader').hide();
                        if (resp.status=='success') {
                            ths.closest('.user_adrs').remove();
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
            // alert($(this).prev().data('id'));
            $('.adrs_id_cls').val($(this).prev().data('id'));
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