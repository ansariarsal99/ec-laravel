<!DOCTYPE html>
<html>
<head>
	<title>Registration Confirmation - Build Mart</title>
</head>
	<body style="font-family:arial">
		<table cellspacing="0" bgcolor="#f7f7f7" cellpadding="0" width="650px" style="padding: 0;border-collapse:collapse; margin: 0 auto;border: 12px groove #cc3f2f;box-shadow: 0px 3px 14px 4px rgba(0,0,0,0.2);">
			<tbody>
				@include('frontend.include.emailHeader')
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tbody>
								<tr>
									<td align="center">
										<span style="font-size:24px; color:#cc3f2f; font-weight: 700;">Registration Successful</span><br />
										<span></span>
									</td>
								</tr>
								<tr>
									<td align="left">
										<p style="margin-bottom:0px; font-size:18px; font-weight:bold; color: #505050;padding: 9px 30px 0px;">Hi, <span>{{@ucwords($data['company_name'])}}</span></p>
										<p style="padding: 9px 30px 40px; line-height:22px; font-size:14px; color: #505050; letter-spacing: 1px; margin: 0;">
										Your Membership Id is {{$data['supplier_code']}}.<br>
                                             <br>
											Thank you for registering with Build Mart.<br>
										</p>

									</td>
								</tr>
								<tr>
									<td height="30"></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				@include('frontend.include.emailFooter')
			</tbody>
		</table>
	</body>
</html>