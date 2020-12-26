<div class="modal fade modal_fit" id="reviewRating" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Rating & Reviews</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="user_rev_list">
                    <ul type="none" class="rev_ul pl0">
                        <?php
                           // $UserRatings = App\UserRating::with('user_name')->where('product_id',$product['id'])->get();
                           // $UserRatings =$UserRatings->skip(3)->toArray();
                             $UserRatings = App\UserRating::with('user_name')->where('product_id',$product['id'])->orderBy('id', 'desc')->get()->skip(3);
                        ?>

                        @foreach($UserRatings as $key=> $rating)
                            <li>
                                <span class="mod_rev_img">
                                    @if(Auth::check() && !empty($rating['user_name']['profile_image']) && file_exists(public_path('frontend/imgs/userProfile/'.$rating['user_name']['profile_image'])))
                                         <img src="{{asset('public/frontend/imgs/userProfile/'.$rating['user_name']['profile_image'])}}" class="img-fluid" id="prof_ch">
                                     @else
                                         <img src="{{asset('public/frontend/img/no_image.png')}}" class="img-fluid" id="prof_ch">
                                     @endif
                                </span>
                                <div class="mod_rev_person">
                                    <h5 class="rev_nam">{{ucfirst($rating['user_name']['first_name'])}} {{ucfirst($rating['user_name']['last_name'])}} </h5>

                                     <ul class="star_list list-inline pl0">
                                        <li class="list-inline-itemproductRating_{{$rating['product_id']}}" id="prev_rate{{$key}}" data-rating="{{ $rating['rating'] }}"></li>
                                    </ul> 
                                    <?php 
                                        if(!empty($rating['rating'])){
                                            $usr_rate = $rating['rating'];
                                        } else{
                                            $usr_rate = 0;
                                        }
                                    ?>
                                    <p class="rev_text">{{$rating['review']}}.</p>
                                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                 $("#prev_rate{{$key}}").rateYo({
                                                   rating: "{{ $usr_rate }}",
                                                   ratedFill: "#fac219", 
                                                   starWidth: "20px",
                                                   spacing: "5px",
                                                   readOnly: true
                                                  });
                                            });
                                        </script>  
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
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
                    required:"Please select review"
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