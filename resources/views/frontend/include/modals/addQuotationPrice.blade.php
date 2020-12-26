<!-- Use Card modal -->
<div class="modal fade edit_div" id="add_quotation_price_mod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Quotation Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card_info">
                    <form id="addQuotationPriceForm" method="POST" action="{{url('/provider/quotation/accept')}}" >
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Enter Quotation Price</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="quotation_price" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="enc_req_id" value="" class="encReqIdCls">
                    </form> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_theme sbmt_quotation"><span>Submit</span></button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#addQuotationPriceForm').validate({
            ignore:[],
            rules:{
                quotation_price:{
                    required:true,
                    min:1
                },
            },
            messages:{
                quotation_price:{
                    required:"Please enter quotation price"
                },
            }
        });

        $("body").on('click','.sbmt_quotation',function(e){
            e.preventDefault();
            $('#addQuotationPriceForm').submit();
        });
    });
</script>
@endpush