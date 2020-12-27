<!DOCTYPE html>
<html>
<head>
	<title>Order Invoice</title>
</head>
	<body style="font-family:arial">
		<table cellspacing="0" bgcolor="#f7f7f7" cellpadding="0" width="500px" style="padding: 0;border-collapse:collapse; margin: 0 auto;border: 12px groove #cc3f2f;box-shadow: 0px 3px 14px 4px rgba(0,0,0,0.2);">
			<tbody>
				<tr>
					<td bgcolor="#fff">
						<table cellspacing="0" cellpadding="10" border="0" align="center" width="100%">
							<tbody>
								<tr>
									<td align="left">
										<img src="{{asset('public/frontend/img/logo.png')}}" alt="logo" width="100" height="">
									</td>
									<td align="left" style="width: 50%; line-height: 1.5">
										<span style="font-size: 24px; font-weight: bold; display: block; text-align: left; padding-bottom: 50px;color:#cc3f2f;">Order</span><br>
										<span style="display: block; padding-bottom: 3px; font-size: 13px;">Order Id: <span style="font-weight: bold;">{{@$orderItem['Order']['invoice_id']}}</span></span><br>
										<span style="font-size: 13px; display: block;">Date: <span style="font-weight: bold;">{{@$orderItem['Order']['placed_on']}}</span></span><br>
										<span style="font-size: 13px;">Amount: <span style="font-weight: bold;">SR {{@$orderItem['quantity_price']}}</span></span>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td height="30" bgcolor="#fff">
					</td>
				</tr>
				<tr>
					<td>
						<table cellspacing="0" cellpadding="7" width="100%">
							<thead>
								<tr>
									<th bgcolor="#cc3f2f" align="left" style="color: #fff; border-right: 2px solid #d5d5d5;width: 50%;">Billing Address</th>
									<th bgcolor="#cc3f2f" align="left" style="color: #fff">Payment Method</th>
								</tr>
							</thead>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="10" cellspacing="0" width="100%" valign="top">
							<tbody>
								<tr>
									<td width="51%" valign="top">
										@if(@$orderItem['delivery_address']!=null)
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['address_title']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['location']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['address']}}, {{@$orderItem['delivery_address']['postal_code']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['province_name']}} </span>
										@else
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['store_address']['store_name']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['store_address']['street']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['store_address']['location']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['store_address']['city']}} </span>
										@endif
									</td>
									<td valign="top">
										<span style="display: block; padding-bottom: 4px; font-size: 14px;">Paid from Card</span>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellspacing="0" cellpadding="7" width="100%">
							<thead>
								<tr>
									<th bgcolor="#cc3f2f" align="left" style="color: #fff; border-right: 2px solid #d5d5d5; width: 50%;">Shipping Address</th>
									<!-- <th bgcolor="#cc3f2f" align="left" style="color: #fff">Shipping Method</th> -->
								</tr>
							</thead>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="10" cellspacing="0" width="100%" valign="top">
							<tbody>
								<tr>
									<td width="51%" valign="top">
										@if(@$orderItem['delivery_address']!=null)
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['address_title']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['location']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['address']}}, {{@$orderItem['delivery_address']['postal_code']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['delivery_address']['province_name']}} </span>
										@else
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@@$orderItem['delivery_address']['store_address']['store_name']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@@$orderItem['delivery_address']['store_address']['street']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@@$orderItem['delivery_address']['store_address']['location']}}</span>
											<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@@$orderItem['delivery_address']['store_address']['city']}} </span>
										@endif
									</td>


									<!-- <td valign="top">
										<span style="display: block; padding-bottom: 4px; font-size: 14px;">Flat Rate-Fixed</span>
									</td> -->
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellspacing="0" cellpadding="7" width="100%">
							<tbody>
								<tr>
									<th bgcolor="#cc3f2f" align="left" style="color: #fff; border-right: 2px solid #d5d5d5; width: 50%;">Items</th>
									<th bgcolor="#cc3f2f" align="right" style="color: #fff;width: 150px">Qty</th>
									<th bgcolor="#cc3f2f" align="right" style="color: #fff;width: 100px">Price</th>
									<!-- <th bgcolor="#cc3f2f" align="right" style="color: #fff">Subtotal</th> -->
								</tr>
								

									
								<tr>
									<td width="51%" valign="top">
										<span style="display: block; padding-bottom: 4px; font-size: 14px;">{{@$orderItem['productName']['item_name']}}</span>
									</td>
									<td valign="top">
										<span style="display: block; padding-bottom: 4px; font-size: 14px; text-align: right;">{{@$orderItem['quantity']}}</span>
									</td>
									<td valign="top">
										<span style="display: block; padding-bottom: 4px; font-size: 14px; text-align: right;">SR {{@$orderItem['quantity_price']}}</span>
									</td>

								</tr>
									
								<tr >
									<th colspan="3" bgcolor="#cc3f2f" align="left" style="color: #fff;">Amount</th>
								</tr>
								<tr>
									<td align="" height="30px">
										<span style="font-weight: bold;">Sub Total</span>
									</td>
									<td align="right" height="35px" colspan="2" >
										<span>SR {{@$subTotal}}</span>
									</td>
								</tr>
								<tr>
									<td align="" height="30px">
										<span style="font-weight: bold">Discount Price </span>
									</td>
									<td align="right" height="30px" colspan="2">
										<span>SR 0.00</span>
									</td>
								</tr>
								<tr>
									<td align="" height="30px">
										<span style="font-weight: bold;">Tax</span>
									</td>
									<td align="right" height="30px"  colspan="2">
										<span>SR {{@$taxProduct}}</span>
									</td>
								</tr>
								<tr>
									<td align="" height="30px">
										<span style="font-weight: bold;">Delivery Charges</span>
									</td>
									<td align="right" height="30px"  colspan="2">
										<span>0.00</span>
									</td>
								</tr>
								<tr>
									<td align="" height="30px">
										<span style="font-weight: bold;">Total</span>
									</td>
									<td align="right" height="30px"  colspan="2">
										<span>SR {{@$orderItem['quantity_price']}}</span>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td style="text-align: center; color:#fff; font-size:16px; background-color: #423c3b;">
						<p>Copyright © <?php echo date('Y'); ?> , MawadMart. All Rights Reserved. </p>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>