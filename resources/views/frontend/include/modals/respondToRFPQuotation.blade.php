<!-- Use Card modal -->
<div class="modal fade edit_div" id="respond_to_rfp_quotation_mod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Respond To RFP Quotation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card_info">
                    <form id="respondToRFPQuotationForm" enctype="multipart/form-data" method="POST" action="{{url('/provider/quotation/respond')}}" >
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <label>Comment</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="document_type" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Attachment</label>
                            </div>
                            <div class="col-lg-8">
                                <!-- <input type="file" name="attachment" class="form-control file_inpt"> -->
                                <div class="form-group file_inpt">
                                    <div class="custom-file">
                                        <input type="file" name="attachment" class="custom-file-input file_img">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <label class="error" for="attachment"></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="enc_req_id" value="" class="encReqIdCls">
                    </form> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_theme sbmt_respond"><span>Submit</span></button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#respondToRFPQuotationForm').validate({
            ignore:[],
            rules:{
                document_type:{
                    required:true,
                },
                attachment:{
                    required:true
                }
            },
            messages:{
                document_type:{
                    required:"Please enter comment"
                },
                attachment:{
                    required:"Please choose attachment"
                }
            }
        });

        $("body").on('click','.sbmt_respond',function(e){
            e.preventDefault();
            $('#respondToRFPQuotationForm').submit();
        });
    });
</script>
@endpush