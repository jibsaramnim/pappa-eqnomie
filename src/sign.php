<?php
if(@$_GET){
	foreach($_GET as $gt_name => $gt_val){
		if(@!$$gt_name){
			$$gt_name = $gt_val;
		}
	}
}

if(@$_POST){
	foreach($_POST as $pst_name => $pst_val){
		if(@!$$pst_name){
			$$pst_name = $pst_val;
		}
	}
}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="Stylesheet" type="text/css" href="manifest.css">
<title>EQNomie Manifest</title>

<script language="Javascript">
<!--
function resizethis()
{
windowW   = 450;
windowH   = 300;
thewidth  = (screen.width/2)-(windowW/2);
theheight = (screen.height/2)-(windowH/2);

window.resizeTo(windowW,windowH);
window.moveTo(thewidth, theheight);
}
//-->
</script>

</head>

<?php
include("menu.php");

if(@$mode == "add")
	{
	if(@!$name || @!$message)
		{
		$error = 1;
		}
	}

if(@$error == 1)
	{
	$themessage = $sign_error;
	}

if($error == "" && $mode == "add")
	{
	$doc = $_SERVER['DOCUMENT_ROOT'] . "/manifest/manifest.html";
	@$thefile = fopen($doc, "r");
	
	if(@!$thefile)
		{
		$thefile = fopen("manifest_design.html", "r");
		$file_size = filesize("manifest_design.html");
		}
	else
		{
		$file_size = filesize("manifest/manifest.html");
		}
	
	if(@$email)
		{
		$email = str_replace("mailto:", "", $email);
		$email = "mailto:" . $email;
		$email_link = "<a href=\"" . $email . "\">" . $name . "</a>";
		}
	else
		{
		$email_link = "<b>" . $name . "</b>";
		}
	
	if(@!$company && @$website)
		{
		$company = "Homepage";
		}
	elseif(@!$company)
		{
		$company = "";
		}
	
	if(@$website)
		{
		$website = str_replace("http://", "", $website);
		$website = "http://" . $website;
		$website_link = "<a href=\"" . $website . "\" target=\"_blank\">" . $company . "</a>";
		}
	else
		{
		$website_link = $company;
		}
	
	$crntstring = fread($thefile, $file_size);
	$checkforthis = "<insert_tag>";
	$replacewith  = $checkforthis . "\n<p><font class=\"message\">" . $email_link . $chk_function . ", " . $website_link;
	$replacewith .= " - &quot;" . $message . "&quot;</font></p>";
	
	$crntstring = str_replace($checkforthis, $replacewith, $crntstring);
	$towrite = $crntstring;
	
	if(!$wrtfile = fopen($doc, "w"))
		{
		$themessage = "ERROR while trying to open file!<br>Please try again later.";
		}
	if(!fwrite($wrtfile, $towrite))
		{
		$themessage = "ERROR while trying to write to file.<br>Please try again later.";
		}
	fclose($wrtfile);
	
	$themessage = $sign_complete;
	}
?>

<body onload="resizethis()">

<div align="center">
	<table border="1" width="400" cellspacing="0" cellpadding="2" id="table1" style="border-width: 0px">
	<tr><td colspan="2"><?php echo $themessage; ?>&nbsp;</td></tr>
	</table>
</div>

</body>

</html>