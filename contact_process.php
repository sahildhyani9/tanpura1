<?php

	$to = "rockybd1995@gmail.com";
	// Form fields
	$from_user = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
	$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
	$csubject = isset($_REQUEST['subject']) ? $_REQUEST['subject'] : '';
	$cmessage = isset($_REQUEST['message']) ? $_REQUEST['message'] : '';

	// Mail headers - use a site email as From for better deliverability
	$site_from = 'no-reply@tanpurahouse.com';
	$headers = "From: " . $site_from . "\r\n";
	if (!empty($from_user)) {
		$headers .= "Reply-To: " . $from_user . "\r\n";
	}
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$mail_subject = "You have a message from your website";

	$logo = 'img/logo.png';
	$link = '#';

	$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
	$body .= "<table style='width: 100%;'>";
	$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
	$body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
	$body .= "</td></tr></thead><tbody><tr>";
	$body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
	$body .= "<td style='border:none;'><strong>Email:</strong> {$from_user}</td>";
	$body .= "</tr>";
	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
	$body .= "<tr><td></td></tr>";
	$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
	$body .= "</tbody></table>";
	$body .= "</body></html>";

	$send = mail($to, $mail_subject, $body, $headers);

	if ($send) {
		// Return a simple response for the AJAX caller
		echo "OK";
		http_response_code(200);
	} else {
		echo "ERROR";
		http_response_code(500);
	}

?>