<!-- Edit modal -->
<div class="modal fade edit_div" id="edit_card" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="edit_info">
                    <form class="editCardForm" id="editCardForm" method="POST" action="{{url('/user/card/update')}}">
                        @csrf
                        <div class="ad_cards_div card_div_mod">
                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_theme edt_card_btn"><span>Update</span></button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.editCardForm').validate({
            ignore:[],
            rules:{
                card_type:{
                    required:true
                },
                card_no:{
                    required:true,
                    digits:true,
                    minlength:16,
                    maxlength:16,
                },
                name_on_card:{
                    required:true,
                    noSpace:true
                },
                expiry_month:{
                    required:true
                },
                expiry_year:{
                    required:true
                },
                cvv:{
                    required:true
                },
            },
            messages:{
                card_type:{
                    required:"Please select card type"
                },
                card_no:{
                    required:"Please enter card number",
                    minlength:"Please enter 16 digit number",
                    maxlength:"Please enter 16 digit number",
                },
                name_on_card:{
                    required:"Please enter name on card",
                },
                expiry_month:{
                    required:"Please select month",
                },
                expiry_year:{
                    required:"Please select year",
                },
                cvv:{
                    required:"Please enter cvv number",
                },
            }
        });

        $("body").on('click','.edt_card_btn',function(e){
            e.preventDefault();
            $('.editCardForm').submit();
        });
    });
</script>
@endpush