<!-- Use Card modal -->
<div class="modal fade edit_div cancl_ordr_modl" id="cancelOrderUserRequest" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title " id="exampleModalCenterTitle">Product Cancellation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateDefaultAddressForm" method="post">
              <div class="modal-body">
                  <div class="card_info text-center">
                        <h5>Are you sure you want to cancel this product ?</h5>
                        <div class="form-group">
                           <h5>Reason For Cancellation</h5>
                               <br>
                           <textarea class="form-control reasonCancl" rows="4" name="reason" placeholder="Write a reason here..."></textarea>
                           <label id="reason-error" for="reason" class="error" style="float: left;"></label>
                        </div>
                       <input type="hidden" name="orderId" class="orderIDD" value="">
                       <input type="hidden" name="productId" class="productIDD" value="">
                  </div>
              </div>
               <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn_theme" data-dismiss="modal" aria-label="Close"><span>cancel</span></button>
                  <button type="button" class="btn btn_theme" id="cancel_btn"><span>Confirm</span></button>
              </div>
            </form> 
        </div>
    </div>
</div>
@push('modals-script')


<script type="text/javascript">
    $(document).ready(function(){
        $('#updateDefaultAddressForm').validate({
            ignore:[],
            rules:{
                reason:{
                    required:true,
                }
            },
            messages:{
                reason:{
                    required:"Please enter reason for the cancellation",
                }
            },
        });
    });
</script>

<script type="text/javascript">


    $('#cancel_btn').on('click',function(){
      if ($('#updateDefaultAddressForm').valid()) {
        $('.loader').show(); 
        $.ajax({
            url:"{{url('user/myOrder/cancelOrder')}}",
            data:$("#updateDefaultAddressForm").serialize(),
            type:'post',
            success:function(response){
                if(response['status']=='true'){
                    $('.loader').hide();
                    $('#cancelOrderUserRequest').modal('hide');
                    location.reload();      
                }else{
                    toastr.error('Something went wrong');
                }
     
            }
        })
      }
    });
       

</script>
@endpush