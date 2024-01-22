<?php
/***
	*
	*  Process Contact Form 
	*  Send email and add data to database
	*
***/

global $wpdb; 

if(isset($_POST['high_submit'])){

	$contact_name =  $_POST['high_name'];   
	$contact_email =  $_POST['high_email'];
	$contact_reason =  $_POST['high_reason'];
	$contact_subject =  $_POST['high_subject'];
	$contact_message =  $_POST['high_message'];
	$high_human = $_POST['high_human'];
	
	  
	$to = "erniehightower@gmail.com";  //recipient email address
	$subject = 'A request from Ernies High  "' . $contact_subject . ' "';  //Subject of the email
	
	//Message content to send in an email
	$message = '<!DOCTYPE html>
		<html lang="en" xmlns="https://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
		<head> 
			<meta http-equiv="Content-Type" content="text/html charset=UTF-8">
			<meta name="viewport" content="width=device-width,initial-scale=1">
			<meta name="x-apple-disable-message-reformatting">
			
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

			 
			
			<!-- Microfsoft BS -->
			<!--[if mso]>
			<style>
				table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
				div, td {padding:0;}
				div {margin:0 !important;}
			</style>
			<noscript>
				<xml>
					<o:OfficeDocumentSettings>
					<o:PixelsPerInch>96</o:PixelsPerInch>
					</o:OfficeDocumentSettings>
				</xml>
			</noscript>
			<![endif]-->
		</head>
		<body style="padding: 0; color: #58A445; font-family: "Open Sans", sans-serif; font-size: 18px; line-height: 1.5; -webkit-font-smoothing: antialiased; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; width: 100%; margin: 0; word-spacing: normal;" class="ExternalClass"> 
			<style>
				@media (max-width: 620px) {
					  h1 {
						font-size: 32px;
						line-height: 1.2;
					  }

					  h2 {
						font-size: 24px;
					  }
					 
					table.card tr,
					table.card tr {
						display: table-row;
					  }
					td,
					p {
						color: #222; 
						font-size: 14px;
					  }
				}
			</style>
			<table role="presentation" style="max-width: 1080px; margin: 0 auto; padding: 0; border: 0; border-collapse: collapse;">
			<tr><th><img src="https://ernieshigh.dev/img/Basic%20High.webp" width="125" height="125" alt="Ernies High"></th></tr><tr><th  style="color: #58A445; font-weight: 400; line-height: 100%;">';
	$message .= '<h2 style="font-weight: 400;"> A contact request from Ernies High </h2>';
	$message .= '</th></tr><tr><td  style="color: #222; ">';
	$message .= '<p> Hey there ' . $contact_name . ' has reached out and has requested you contact them concerning " ' .  $contact_reason . ' ".</p>';
	$message .= '<p>Their message is:</p>';
	$message .= '<p>"' . $contact_message . '"</p>';
	$message .= '</td></tr></table>';
	$message .= '</body></html>';
	
	
	 
	
	//Email headers
	$headers = array('Content-Type: text/html; charset=UTF-8', 'From: Ernies High <ernie@ernieshigh.dev>', 'Reply-To: <' . $contact_email . ' >' );
	
	//Send email  
	wp_mail( $to, $subject, $message, $headers );
	
	
	
	
	 
}