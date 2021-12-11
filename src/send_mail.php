<?php
if(strtolower($action) == "subscribe")
	{
	$subject = "Newsletter Signup Confirmation";
	
	$message  = "Thank you for signing up to the EQnomy newsletter!\n\n";
	$message .= "Before you can start recieving the newsletter, you need to activate your account.\n";
	$message .= "To do so, click the link below (or copy/paste the full line to your browser) and follow the onscreen insctructions.\n\n";
	$message .= "Note: If this email is send to you by mistake, please ignore this message, your email address will be removed if it is not activated.\n\n";
	$message .= "Your personal activation link:\n";
	$message .= "http://www.eqnomie.nl/newsletter.php?activate=" . bin2hex($email) . "&code=" . $activation_id . "\n\n";
	$message .= "Welcome to the future!\n\n- The EQnomy Team\n\n";
	}
elseif(strtolower($action) == "unsubscribe")
	{
	$subject = "Newsletter Unsubscribe Confirmation";
	
	$message  = "Hello,\n";
	$message .= "You, or somebody else, entered your email address (" . $email . ") to unsubscribe from the EQnomy newsletter.\n";
	$message .= "If you do not wish to unsubsribe, or if this email message is send to you by mistake, you can delete this message.\n";
	$message .= "If you wish to confirm the deactivation of your subscription, click (or copy/paste to your browser) the link below.\n\n";
	$message .= "http://www.eqnomie.nl/newsletter.php?action=unsubscribe&email=" . bin2hex($email) . "&code=" . $deactivation_id . "\n\n";
	$message .= "Thank you for your time,\n\n- The EQnomy Team\n\n";
	}

mail($email, $subject, $message, "From: newsletter@eqnomie.nl\r\nReply-To: no-reply@eqnomie.nl\r\nX-Mailer: PHP/" . phpversion());
?>