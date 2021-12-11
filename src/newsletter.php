<?php
if(@!$lang)
	{
	$lang = "nl";
	}

// Script om random value met letters/cijfers te maken
function randomstring($len, $num)
{
srand(date("s")+$num);

while($i<$len)
	{
	$str.=rand(0,150);
	$i++;
	}

$str=$str.substr(uniqid (""),0,22);

$str = substr($str, 0, $len);
return $str;
}
	
function hex2bin($data)
{
$len = strlen($data);
return pack("H" . $len, $data);
}

// Verbind met database
$db = mysql_connect("localhost", "pjansen", "FFGZHT64");
mysql_select_db("eqnomie");

if(@!$activate && strtolower(@$action) == "subscribe")
	{
	// Zet fatal op nul
	$fatal = 0;
	
	// Start email check
	if(@$email && @$email != "your@email.com")
		{
		$email_lst  = explode("@", $email);
		$email_lst2 = explode(".", $email);
		$email_usr  = $email_lst[0];
		$email_dmn  = $email_lst[1];
		$email_ext  = $email_lst2[count($email_lst2)-1];
		
		// Controleer 'gebruikersnaam' gedeelte van email op lengte en of hij bestaat
		if($email_usr == "" || strlen($email_usr) < 1)
			{
			$fatal = 1;
			}
		
		// Controleer 'domein naam' gedeelte van email op lengte en of hij bestaat
		if($email_dmn == "" || strlen($email_dmn) < 1)
			{
			$fatal = 1;
			}
		
		// Controleer 'extensie' gedeelte van email op lengte en of hij bestaat
		if($email_ext == "" || strlen($email_ext) < 1 || strlen($email_ext) > 3)
			{
			$fatal = 1;
			}
		
		if($fatal == 1)
			{
			$error_message = "Your email address seems to be invalid, please recheck the entered address and try again.";
			}
		else
			{
			$check_query  = "SELECT email,activated FROM newsletter WHERE email='" . $email . "'";
			$check_result = mysql_query($check_query);
			$check_count  = mysql_num_rows($check_result);
			$check        = mysql_fetch_array($check_result);
			
			if($check_count > 0)
				{
				$fatal = 1;
				$error_message = "Your email address is already found in our database.<br>";
				
				if($check['activated'] == '0')
					{
					$error_message .= "If you wish to activate your registration and lost your original activation email, click <a href=\"newsletter.php?action=lost&e=" . bin2hex($email) . "\">here</a>. A new email message wil be send to you to confirm your registration.";
					}
				if($check['activated'] == '2')
					{
					$error_message .= "If you wish to re-activate your registration, click <a href=\"newsletter.php?action=reactivate&e=" . bin2hex($email) . "\">here</a>. An email message wil be send to you to confirm your registration.";
					}
				}
			else
				{
				$activation_id = randomstring(50, 1);
				$deactivation_id = randomstring(50, 200);
				
				$post_query = "INSERT INTO newsletter VALUES('', '', '" . $email . "', '0', '" . $activation_id . "', '" . $deactivation_id . "', '" . $REMOTE_ADDR . "')";
				$post_result= mysql_query($post_query);
				
				include("send_mail.php");
				
				$final_message  = "Before your email address is activated you will need to confirm your address.<br>";
				$final_message .= "Please check your mailbox for the confirmation email message.";
				}
			}
		}
	else
		{
		$fatal = 1;
		$error_message = "You have not entered an email address, please try again.";
		}
	}
elseif(strtolower(@$action) == "unsubscribe")
	{
	if(@!$code)
		{
		$check_query  = "SELECT email,activated,deactivation_id FROM newsletter WHERE email='" . $email . "'";
		$check_result = mysql_query($check_query);
		$check_count  = mysql_num_rows($check_result);
		$check        = mysql_fetch_array($check_result);
		
		if($check_count > 0)
			{
			if($check['activated'] == "1")
				{
				$email = $check['email'];
				$deactivation_id = $check['deactivation_id'];
				include("send_mail.php");
				
				$final_message  = "Before your subscription is deactivated you will need to confirm your action.<br>";
				$final_message .= "Please check your mailbox for the confirmation email message.";
				}
			else
				{
				$fatal = 1;
				$error_message = "Your account already has been deactivated or you have never activated it.";
				}
			}
		else
			{
			$fatal = 1;
			$error_message = "Your email address is not found in our database.<br>";
			}
		}
	else
		{
		$conv_email = hex2bin($email);
		$unsub_query  = "SELECT email,activated,deactivation_id FROM newsletter WHERE email='" . $conv_email . "' AND deactivation_id='" . $code . "'";
		$unsub_result = mysql_query($unsub_query);
		$unsub_count  = mysql_num_rows($unsub_result);
		$unsub        = mysql_fetch_array($unsub_result);
		
		if($unsub_count < 1)
			{
			$fatal = 1;
			$error_message = "Your email address and/or deactivation code are not found in our database.";
			}
		else
			{
			if($unsub['activated'] != '2')
				{	
				$runsub_query  = "UPDATE newsletter SET activated='2' WHERE email='" . $conv_email . "' AND deactivation_id='" . $code . "' LIMIT 1";
				$runsub_result = mysql_query($runsub_query);
				
				if($runsub_result)
					{
					$final_message  = "You have been succesfully unsubscribed from the EQnomy Newsletter.<br>";
					$final_message .= "Thank you for your interest in the EQnomy Manifesto.";
					
					mail("info@eqnomie.nl", "EQnomie: Unsubscribe Action", $conv_email . " has entered his or her email address to Unsubscribe the EQnomy newsletter.", "From: newsletter@eqnomie.nl\r\nReply-To: no-reply@eqnomie.nl\r\nX-Mailer: PHP/" . phpversion());
					}
				else
					{
					$fatal = 1;
					$error_message = "There was an error while removing your subscribtion, please make sure that you have used the right link.";
					}
				}
			else
				{
				$fatal = 1;
				$error_message = "Your account already has been deactivated.";
				}
			}
		}
	}
elseif(@$action == "lost" || @$action == "reactivate")
	{
	$email       = hex2bin($e);
	$find_query  = "SELECT email,activated,activation_id FROM newsletter WHERE email='" . $email . "' LIMIT 1";
	$find_result = mysql_query($find_query);
	$find_count  = mysql_num_rows($find_result);
	$find        = mysql_fetch_array($find_result);
	
	if($find_count < 1)
		{
		$fatal = 1;
		$error_message = "Your Email Address is not found in our database.<br>Please sign up using the sign up box located at the bottom of our index page.";
		}
	else
		{
		$action = "subscribe";
		$activation_id = $find['activation_id'];
		include("send_mail.php");
		
		$final_message  = "An email message has been send to your address.<br>";
		$final_message .= "Please click on the link to confirm your subscription.";
		}
	}
elseif(@!$action)
	{
	$action = "Activate your registration";
	$email  = hex2bin($activate);
	
	$find_query  = "SELECT name,email,activated,activation_id FROM newsletter WHERE email='" . $email . "' AND activation_id='" . $code . "'";
	$find_result = mysql_query($find_query);
	$find_count  = mysql_num_rows($find_result);
	
	if($find_count < 1)
		{
		$fatal = 1;
		$error_message = "The selected Activation Code and/or Email Address are not found in our database.<br>Please sign up using the sign up box located at the bottom of our index page.";
		}
	else
		{
		$row = mysql_fetch_array($find_result);
		if($row['activated'] == 1)
			{
			$fatal = 1;
			$error_message = "You have already completed the sign up process.";
			}
		else
			{
			$final_message  = "To personalize the newsletter, please enter your name in the text box below.<br>Your personal information will not be shared with 3rd parties.<br>";
			$final_message .= "<p align=\"center\"><form method=\"POST\" action=\"newsletter.php\">\n";
			$final_message .= "<input type=\"hidden\" name=\"activation_id\" value=\"" . $code . "\"><input type=\"hidden\" name=\"email\" value=\"" . $email . "\"><input type=\"hidden\" name=\"action\" value=\"Finalize\">";
			$final_message .= "<input type=\"text\" name=\"name\" size=\"20\" class=\"textfield02\" value=\"" . $row['name'] . "\"><br>\n";
			$final_message .= "<input type=\"submit\" value=\"Finalize\" name=\"action\" class=\"button\"></form></p>";
			}
		}
	}
else
	{
	if(@!$name || @$name == "")
		{
		$fatal = 1;
		$error_message = "You have not entered a name, please try again.";
		}
	else
		{		
		$final_query  = "UPDATE newsletter SET name='" . $name . "', activated='1' WHERE activation_id='" . $activation_id . "' AND email='" . $email . "' LIMIT 1";
		$final_result = mysql_query($final_query);
		
		$final_message = "Your registration now is complete, " . $name . ".<br>Thank you for signing up for our newsletter.<br><br>- The EQnomy Team";
		
		mail("info@eqnomie.nl", "EQnomie: Subscribe Action", $email . " has entered his or her email address to Subscribe the EQnomy newsletter.", "From: newsletter@eqnomie.nl\r\nReply-To: no-reply@eqnomie.nl\r\nX-Mailer: PHP/" . phpversion());
		}
	}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<title>Newsletter :: <?php echo @$action; ?></title>
</head>

<body>

<table border="1" style="border-color:#000000; border-width:0px; border-collapse: collapse" width="100%" cellspacing="0" cellpadding="0" id="table3" height="100%">
	<tr>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; " valign="bottom">&nbsp;</td>
		<td style="border-style:none; border-width:medium; " valign="top" width="600">
		
		&nbsp;</td>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; ">
		&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; " valign="bottom" height="150">&nbsp;</td>
		<td style="border-style:none; border-width:medium; " valign="top" class="ctext" height="150" width="600">
		
		<table border="1" style="border-collapse: collapse" width="100%" cellspacing="0" height="100%" bordercolor="#D7C1A2" id="table4" cellpadding="10">
			<tr>
				<td id="bgscroller" class="ctext">
				
				<?php
				if(@$fatal == 1)
					{
					echo $error_message;
					}
				else
					{
					echo $final_message;
					}
				?>
				
				<p align="right">.: <a href="index.php?page=home&lang=<?php echo $lang; ?>">Index</a></p></td>
			</tr>
		</table><br>
		</td>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; " height="150">
		&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; " valign="bottom">&nbsp;</td>
		<td style="border-style:none; border-width:medium; " valign="top" width="600">
		
		&nbsp;</td>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; ">
		&nbsp;</td>
	</tr>
</table>

		</body>

</html>