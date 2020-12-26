<div class="modal fade modal_fit" id="termOfPaymentPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <form id="subscription"> 
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Choose plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="chse_plns_mod">
                   <form role="form">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customRadio_ch1" name="example1" value="">
                                <label class="custom-control-label" for="customRadio_ch1">Choose plan 1</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customRadio_ch2" name="example1" value="">
                                <label class="custom-control-label" for="customRadio_ch2">Choose plan 1</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customRadio_ch3" name="example1" value="">
                                <label class="custom-control-label" for="customRadio_ch3">Choose plan 1</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn_theme" id=dataSubmit><span>ok</span></button>
            </div> -->
        </div>
    </div>
    </form>
</div>
@push('modals-script')
<!-- <script type="text/javascript">
    $(document).ready(function(){

        $('#dataSubmit').click(function(){
          gg=$('.subs_pack_cls').val();
          // alert(gg);

          $('#fffffsubscription').modal('hide');

        });
       
    });
</script> -->
@endpush