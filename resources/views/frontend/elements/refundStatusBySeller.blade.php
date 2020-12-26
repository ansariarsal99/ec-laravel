
<option value="" disabled="" selected>Make Refund</option>

@foreach($orderRefunds as $orderStatus)
    <option value="{{$orderStatus->id}}"  @if($orderStatus['id'] == $productDetail['product_order_refund_id']) selected @endif >{{@$orderStatus->name}}</option>
@endforeach




