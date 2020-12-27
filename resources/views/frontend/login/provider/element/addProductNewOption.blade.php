<div class="col-lg-6 nw_opt_div">
    <div class="size_chart">
        <div class="d-flex justify-content-between">
            <h5 class="chart_head mb-2">{{@$data['title']}}</h5>
            <div class="text-right">
                <a href="javascript:;" class="add_new rem_optn">
                    <i class="fa fa-times"></i> Remove
                </a>
            </div>
        </div>
        <input type="hidden" name="new_option_div[{{@$data['option_length']}}][title]" value="{{@$data['title']}}" />
        <input type="hidden" name="new_option_div[{{@$data['option_length']}}][option_type]" value="{{@$data['option_type']}}" />
        <div class="row">
            @if($data['option_type']=='without_unit')
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="new_option_div[{{@$data['option_length']}}][value]" value="{{@$data['value']}}" class="form-control" placeholder="Enter value">
                    </div>
                </div>
            @else
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="new_option_div[{{@$data['option_length']}}][value]" value="{{@$data['value']}}" class="form-control" placeholder="Enter value">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control prod_sel_unt_cls" name="new_option_div[{{@$data['option_length']}}][product_selling_unit_id]">
                            <option selected disabled>Select Unit</option>
                            @foreach($SellingUnits as $SellingUnit)
                                <option value="{{$SellingUnit->id}}">{{@$SellingUnit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>