<div class="sh_pric_tble">
    <div class="row tab_head m-0">
        <div class="col-lg-4 br_right p-0">
            <h4>Quantity</h4>
        </div>
        <div class="col-lg-4 br_right p-0">
            <h4>Pcs.</h4>
        </div>
        <div class="col-lg-4 p-0">
            <h4>Price</h4>
        </div>
    </div>
    <div class="row m-0 mb-3">
        <div class="col-sm-4 inr_datat p-0 product-weight">
            @foreach($productWeights as $weight)
            <p>{{$weight->quantity}} kg</p>
            @endforeach
        </div>
        <div class="col-sm-4 inr_datat p-0 product-weight">
            @foreach($productWeights as $weight)
            <p>{{$weight->pcs}}</p>
            @endforeach
           <!--  <p>2</p>
            <p>2</p> -->
        </div>
        <div class="col-sm-4 inr_datat p-0 product-weight">
            @foreach($productWeights as $weight)
            <p>SR {{$weight->price}}</p>
            @endforeach
            <!-- <p>SR 200</p>
            <p>SR 200</p> -->
        </div>
    </div>
</div>