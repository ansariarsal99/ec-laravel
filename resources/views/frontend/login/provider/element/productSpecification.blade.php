<!-- <div class="sh_pric_tble specification_example">
    <div class="row tab_head m-0">
        <div class="col-lg-3 br_right p-0">
            <h4>Title</h4>
        </div>
        <div class="col-lg-9 br_right p-0">
            <h4>Description</h4>
        </div>
    </div>
    <div class="row m-0 mb-3">
        <div class="col-sm-3 inr_datat p-0 product-spec">
            @foreach($specifications as $specification)
            <p>{{@$specification->title}}</p>
            @endforeach
        </div>
        <div class="col-sm-9 inr_datat p-0 product-spec">
            @foreach($specifications as $specification)
            <p>{{@$specification->description}}</p>
            @endforeach
        </div>
    </div>
</div> -->

@if(isset($specifications) && sizeof($specifications)>0)
    @foreach($specifications as $key => $specification)
        @if(!empty($specification))
            <tr>
                <td>{{@$specification->title}}</td>
                <td><pre>{{@$specification->description}}</pre></td>
                <td>
                    @if(!empty($specification->image) && file_exists(productSpecificationImgsBasePath.'/'.$specification->image))
                        <?php 
                            $array = explode('.', $specification->image);
                            $extension = end($array);
                        ?>
                        @if($extension=='docx' || $extension=='doc')
                            <a href="{{productSpecificationImgsPath.'/'.$specification->image}}" target="_blank"><img src="{{asset('/public/frontend/img/document_thumbnail.png')}}" class="img-fluid"></a>
                        @elseif($extension=='pdf')
                            <a href="{{productSpecificationImgsPath.'/'.$specification->image}}" target="_blank"><img src="{{asset('/public/frontend/img/pdf-thumbnail.jpeg')}}" class="img-fluid"></a>
                        @else
                            <img src="{{productSpecificationImgsPath.'/'.$specification->image}}" class="img-fluid">
                        @endif
                    @else
                        --
                    @endif
                </td>
                <td>
                    <a href="javascript:;" class="delete-btn cp text-danger" del_id="{{base64_encode($specification['id'])}}"><i class="fa fa-trash" title="Delete"></i></a>
                </td>
            </tr>
        @endif
    @endforeach
@endif