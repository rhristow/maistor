<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <table style="width: 100% !important; background: #f8f8f8;">
        	<tr>
        		<td style="display: block !important; margin: 0 auto !important; max-width: 640px !important;">
        			<br><br><br>
        			<table style="width: 100% !important; border-collapse: collapse;">
        				<tr>
        					<td style="padding: 0; background: #2787D8;">
        						<img style="max-width: 100%; margin: 0 auto; display: block;" src="https://www.sitewab.com/images/logo-white-big.png" alt="Logo" width="180">
        					</td>
        				</tr>
        				<tr>
        					<td style="background: white; padding: 30px 35px;">
        						<h2 style="margin-bottom: 20px; line-height: 1.25; font-size: 22px;"> @yield('headerMessage') </h2>
        						<p style="font-size: 18px;">
        							@yield('content')
        						</p>
        					</td>
        				</tr>
        				<tr>
        					<td style="color: #888; font-size: 14px; text-align: center; background: white; padding: 30px 35px; background: none;">
        						<p style="font-weight: normal;"> This e-mail has been sent by <a style="color: #888; text-decoration: none; font-weight: bold;" href="https://www.sitewab.bg/" target="_blank">Sitewab Ltd.</a>, Sofia, Bulgaria </p>
        						<p> Contact us: <a style="color: #888; text-decoration: none; font-weight: bold;" href="mailto:office@sitewab.com"> office@sitewab.com </a> </p>
        					</td>
        				</tr>
        			</table>
        		</td>
        	</tr>
        </table>
    </body>
</html>
