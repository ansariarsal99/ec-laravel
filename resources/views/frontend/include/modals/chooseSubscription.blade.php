<div class="modal fade modal_fit" id="modelSubscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <form id="subscription"> 
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">
                <!-- <img src="{{asset('public/frontend/img/forpwd.png')}}" class="img-fluid for_img pb-4" /> -->
                    <p class="text-center emmob"></p>
                    <h3>Congratulation,You have choosen</h3>
                     <h3 class="subPack"></h3> 
                    <div class="from_reset">
<!--                         <form id="forgotPassForm" action="{{url('/subscription-pack-choosen')}}" method="POST" role="form"> -->
                       <form role="form">
                            @csrf
                            <div class="col-sm-12">
                                <div class="clearfix text-left">
                                   <input  type="hidden" name="registeredUserId" class="registered_id" value="">
                                   <input  type="hidden" class="subs_pack_cls" name="subscriptionPackId">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn_theme" id=dataSubmit><span>ok</span></button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    </form>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){

        $('#dataSubmit').click(function(){
          gg=$('.subs_pack_cls').val();
          // alert(gg);

          $('#modelSubscription').modal('hide');

        });
       
    });
</script>
@endpush