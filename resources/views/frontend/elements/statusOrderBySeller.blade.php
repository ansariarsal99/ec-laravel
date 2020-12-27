<option value="" disabled="" selected>Select Order Status</option>

	@foreach($orderStatuses as $orderStatus)
	    <option value="{{$orderStatus->id}}"  @if($orderStatus['id'] == $productDetail['product_order_status_id']) selected @endif >{{@$orderStatus->name}}</option>
	@endforeach

