<?php
// The default language (use the short name, ie. "nl" or "eng") and the default page (ie. "home")
$default_lang = "nl";
$default_page = "home";

// Set language to the default if it's not set
if(@!$lang)
	{
	$lang = $default_lang;
	}

// Set the page to the default if it's not set
if(@!$page)
	{
	$page = $default_page;
	}

// Available languages (please define in order of appearance)
// Usage: "short_name" => "Long name"
// Make sure that the short name is not capitalized and is the same as the flag's filename!
$languages = array("nl" => "nederlands", 
					"eng" => "english", 
					"fra" => "français", 
					"ger" => "deutsch", 
					"esp" => "Español");

// Now check if the provided language is found in the list.
// If not, use the default language (as stated above)
if(!isset($languages[$lang]))
	{
	$lang = $default_lang;
	}

// Available pages (please define in order of appearance)
// Usage: $pages['language'] = array("option 1", "option 2", "etc.");
// You can keep everything lowercase. In fact, you must keep 'language' lowercase ;)
$pages['nl']  = array("home", 
					  "ondertekenen", 
					  "lees ondertekeningen", 
					  "contact");

$pages['eng'] = array("home", 
					  "sign", 
					  "read signatures", 
					  "contact");

$pages['fra'] = array("home", 
					  "signer", 
					  "liser signatures", 
					  "contacte");

$pages['ger'] = array("home", 
					  "unterschreiben", 
					  "unterschriften lesen", 
					  "contact");

$pages['esp'] = array("home", 
					  "firmar", 
					  "leer firmas", 
					  "tomar contacto");

// To put a special link on a menu item, enter it here.
// If you want to use the default system, enter "[default]" or keep it empty ("")
$links		  = array("[default]", "[default]", "index.php?lang=[lang]&page=manifest", "[default]");
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>EQnomie - <?php echo ucfirst($languages[$lang]); ?></title>
<link rel="stylesheet" media="all" href="style.css" type="text/css">
<script language="Javascript" type="text/javascript" src="jscript.js"></script>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

<div align="center">
	<table border="0" width="404" cellspacing="0" cellpadding="0" id="table1">
		<tr>
			<td width="269">
			<img border="0" src="images/dutch/logo_1.jpg" width="269" height="75"></td>
			<td>
			<img border="0" src="images/dutch/logo_2.jpg" width="135" height="75"></td>
		</tr>
		<tr>
			<td>
			<img border="0" src="images/dutch/blank.jpg" width="35" height="27"><?php
			// This will generate the Language flags, and highlight the current selected language
			// To add a language, add one in the $languages array defined in the top part of this page
			
			foreach($languages as $short_name => $long_name)
				{
				echo "<a href=\"index.php?lang=" . $short_name . "\">";
				
				if($short_name == $lang)
					{
					echo "<img border=\"0\" width=\"44\" height=\"27\" src=\"images/flags/" . $short_name . "_o.jpg\">";
					}
				else
					{
					echo "<img border=\"0\" width=\"44\" height=\"27\" src=\"images/flags/" . $short_name . "_n.jpg\" onmouseover=\"changeImg(this, '" . $short_name . "', 'o')\" onmouseout=\"changeImg(this, '" . $short_name . "', 'n')\">";
					}
				
				echo "</a>";
				}
			?></td>
			<td>
			<img border="0" src="images/dutch/logo_3.jpg" width="135" height="27"></td>
		</tr>
		<tr>
			<td height="10" valign="top">
			<img border="0" src="images/dutch/blank.jpg" width="269" height="10"></td>
			<td height="10" valign="top">
			<img border="0" src="images/dutch/logo_4.jpg" width="135" height="10"></td>
		</tr>
		<tr>
			<td colspan="2" height="33" background="images/dutch/menu_bg.jpg" align="center"><?php
			for($i=0; $i < count($pages[$lang]); $i++)
				{
				// link creation; First check if the $links array gives us permission to use the default setting
				if($links[$i] == "[default]")
					{
					$tmp = str_replace(" ", "_", $pages[$lang][$i]);
					$tmp = ereg_replace("[^A-Za-z0-9]", "", $tmp);
					
					$url = "index.php?lang=" . $lang . "&page=" . $tmp;
					
					$small_url = $pages[$lang][$i];
					}
				else
					{
					$url = $links[$i];
					$url = str_replace("[lang]", $lang, $url);
					
					$small_url = str_replace("page=", "", substr($url, strpos($url, "page="), strlen($url)));
					}
				
				if($page == $small_url)
					{
					echo $start . "<b>" . ucwords($pages[$lang][$i]) . "</b>";
					}
				else
					{
					echo $start . "<a href=\"" . $url . "\">" . ucwords($pages[$lang][$i]) . "</a>";
					}
				
				if(@!$start)
					{
					$start = " - ";
					}
				}
			?></td>
		</tr>
		<tr>
			<td colspan="2" background="images/dutch/bg.jpg" valign="top">
			<table border="0" width="100%" cellspacing="0" cellpadding="10" background="images/dutch/bg_fadeout.jpg" height="100%" style="background-position: bottom left; background-repeat: no-repeat;">
				<tr>
					<td valign="top">
					
					<?php
					// Load the content
					$file = "content_" . $lang . "/" . $page . ".html";
					
					$fs = fopen($file, "r");
					$content = fread($fs, filesize($file));
					
					echo $content;
					
					fclose($fs);
					?>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" height="30" background="images/dutch/bottom_bg.jpg">&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>
