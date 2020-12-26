<!-- Use Card modal -->
<div class="modal fade edit_div" id="use_card_as_default_mod" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Use Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card_info text-center">
                     <p>Are you sure you want to use this card as default ?</p>
                    <form id="updateDefaultCardForm" method="POST" action="{{url('/provider/card/default/update')}}" >
                      <!--   <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="use_card_as_default" class="custom-control-input" id="customRadio1" name="example1" value="yes">
                                <label class="custom-control-label" for="customRadio1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="use_card_as_default" class="custom-control-input" id="customRadio" name="example1" value="no">
                                <label class="custom-control-label" for="customRadio">No</label>
                            </div>                            
                        </div>
                        <label class="error" for="use_card_as_default"></label> -->
                        <input type="hidden" name="card_id" class="card_id_cls">
                    </form> 
                </div>
            </div>
           <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn_theme" data-dismiss="modal" aria-label="Close"><span>Cancel</span></button>
                <button type="button" class="btn btn_theme updt_default_card"><span>Confirm</span></button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#updateDefaultCardForm').validate({
            ignore:[],
            rules:{
                use_card_as_default:{
                    required:true
                },
            },
            messages:{
                use_card_as_default:{
                    required:"Please select option"
                },
            }
        });

        $("body").on('click','.updt_default_card',function(e){
            e.preventDefault();
            $('#updateDefaultCardForm').submit();
        });
    });
</script>
@endpush