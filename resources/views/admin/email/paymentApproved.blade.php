<?php  
                                                                                        
    $logo = defaultAdminImagePath.'/logo.png'; 
    $admin_image = defaultAdminImagePath.'/mcoll.png';
         // dd($logo);                            
?> 

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
	<body style="font-family:arial">
		<table cellspacing="0" bgcolor="#f7f7f7" cellpadding="0" width="650px" style="padding: 0;border-collapse:collapse; margin: 0 auto;border: 12px groove #cc3f2f;box-shadow: 0px 3px 14px 4px rgba(0,0,0,0.2);">
			<tbody>
				<tr>
					<td bgcolor="#fff">
						<table cellspacing="0" cellpadding="10" border="0" align="center" width="100%">
							<tbody>
								<tr>
									<td align="left">
										<img src="{{asset('public/frontend/img/logo.png')}}" alt="logo" width="150" height="">
									</td>
									<td align="right">
										<span>{{@$email}}</span><br />
										<span style="display: inline-block;padding: 6px 0;">{{@$phone_no}}</span>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellspacing="0" cellpadding="0" width="100%" height="auto">
							<tbody>
								<tr>
									<td style="vertical-align: middle;" align="center">
										<div class="logo-wrap">
		                                	<img src="{{$admin_image}}" alt="logo" width="100%" height="300" style="object-fit: cover">
		                            	</div>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td style="background: #f7f7f7" height="30">
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tbody>
								<tr>
									<td align="center">
										<span style="font-size:24px; color:#cc3f2f; font-weight: 700;">Subscription Package Started</span><br />
										<span></span>
									</td>
								</tr>
								<tr>
									<td align="center">
										<p style="margin-bottom:0px; font-size:18px; font-weight:bold; color: #505050;padding: 9px 30px 0px;text-align: left;">Hi, <span>{{ucfirst($contact_name)}}</span></p>
										<p style="padding: 9px 30px 20px; line-height:22px; font-size:14px; color: #505050; letter-spacing: 1px; margin: 0;text-align: left;">Your account has been approved by the admin and now you can enjoy your subscription with Mawad Mart.</p>

<!-- 										<a href="" style="padding: 8px 30px; color: #cc3f2f; margin-top: 10px;text-decoration: none; letter-spacing: 1px; border: 5px double #9f9f9f; border-radius: 0px;font-size: 18px; display: inline-block;font-weight: 800;outline: none;">
										</a> -->
									</td>
								</tr>
								<tr>
									<td height="30"></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td align="left">
						<h4 style="margin: 14px 30px;color:#505050;">Best Regards</h4>
						<span style="display: block;margin: 0px 30px 20px;color: #505050;">Team, Mawad Mart</span>
					</td>
				</tr>
				<tr>
					<td style="text-align: center; color:#fff; font-size:16px; background-color: #423c3b;">
						<p>Copyright © <?php echo date('Y'); ?> , Mawad Mart. All Rights Reserved. </p>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>