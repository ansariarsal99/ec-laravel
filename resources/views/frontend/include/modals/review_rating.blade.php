<div class="modal fade modal_fit" id="reviewRating" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Rating & Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="rate_rev">
                     <form id="ratingReviewForm" action="{{url('/user/product/rating/review')}}" method="POST" role="form">
                        <div class="form-group">
                            <h5>Write a review:</h4>
                                <br>
                            <textarea class="form-control" rows="4" name="review" placeholder="Write a review here..."></textarea>
                        </div>
                        <input type="hidden" name="productId" class="product_id" value="">
                        
                        <div class="rate_div">
                        <h5>Give Ratings:</h4>
                              <input type="hidden" name="rating" value="" id="star_rating">
                            <div class="rate_yo">

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn_theme give_review_rating"><span>Submit</span></button>
            </div>
        </div>
    </div>
</div>
@push('modals-script')

<script type="text/javascript">
    $(document).ready(function(){
        $('#ratingReviewForm').validate({
            ignore:[],
            rules:{
                review:{
                    required:true
                },
            },
            messages:{
                review:{
                    required:"Please enter review"
                },
            }
        });

        $("body").on('click','.give_review_rating',function(e){
            e.preventDefault();
            $('#ratingReviewForm').submit();
        });
    });
</script>

@endpush