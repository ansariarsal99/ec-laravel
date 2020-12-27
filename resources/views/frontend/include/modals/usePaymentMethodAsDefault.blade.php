<!-- Use Card modal -->
<div class="modal fade edit_div" id="use_address_as_default_mod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Use Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card_info text-center">
                    <p>Are you sure you want to use this term of payment as default ?</p>
                    <!-- <p>Do you want to use this address as default ?</p> -->
                    <form id="updateDefaultAddressForm" method="POST" action="{{url('/provider/paymentmethod/default/update')}}" >
                      <!--   <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="use_term_of_payment_as_default" class="custom-control-input" id="customRadio1" name="example1" value="yes">
                                <label class="custom-control-label" for="customRadio1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="use_term_of_payment_as_default" class="custom-control-input" id="customRadio" name="example1" value="no">
                                <label class="custom-control-label" for="customRadio">No</label>
                            </div>                            
                        </div>
                        <label class="error" for="use_term_of_payment_as_default"></label> -->
                        <input type="hidden" name="user_term_of_payments_id" class="adrs_id_cls">
                    </form> 
                </div>
            </div>
             <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn_theme" data-dismiss="modal" aria-label="Close"><span>cancel</span></button>
                <button type="button" class="btn btn_theme updt_default_card"><span>Confirm</span></button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#updateDefaultAddressForm').validate({
            ignore:[],
            rules:{
                use_term_of_payment_as_default:{
                    required:true
                },
            },
            messages:{
                use_term_of_payment_as_default:{
                    required:"Please select option"
                },
            }
        });

        $("body").on('click','.updt_default_card',function(e){
            e.preventDefault();
            $('#updateDefaultAddressForm').submit();
        });
    });
</script>
@endpush