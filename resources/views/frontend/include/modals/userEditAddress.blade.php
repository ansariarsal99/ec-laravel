<div class="modal fade edit_div" id="edit_addrs_mod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="edit_info">
                    <form class="editAddressForm" id="editAddressForm" method="POST" action="{{url('/user/address/update')}}">
                        @csrf
                        <div class="addrs_div adrs_div_mod">

                        </div>
                    </form>                    
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn_theme edt_adrs_btn"><span>Submit</span></button>
            </div> -->
        </div>
    </div>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#editAddressForm').validate({
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

        $("body").on('click','.edt_adrs_btn',function(e){
            e.preventDefault();
            $('#editAddressForm').submit();
        });
    });
</script>
@endpush