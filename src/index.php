<?php

if(@$_GET){
	foreach($_GET as $name => $val){
		$$name = $val;
	}
}

if(@!$page)
	{
	$page = "home";
	}
if(@!$lang)
	{
	$lang = "nl";
	}

$hoofd = " ";

include("menu.php");
?>
<html>

<head>
<meta name="keywords" content="eqnomie, eqnomy, manifest, manifeste, manifesto, EQ, emotional intelligence, emotionele intelligentie, paul jansen, paul, jansen">
<meta name="Description" content="Official EQnomy Manifesto website. Efficiële website van het EQnomie Manifest.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<title><?php echo $logos[$lang]; ?></title>
<script language="javascript">
<!--
window.name="mainpage";

function ef(obj)
{
if(obj.value == "your@email.com")
	{
	obj.value = "";
	}
}

function ff(obj)
{
if(obj.value == "")
	{
	obj.value = "your@email.com";
	}
}
//-->
</script>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<div id="languages" style="position: absolute; top: 7px; left: 7px; z-index: 100">&nbsp;</div>

<table border="1" style="border-color:#000000; border-width:0px; border-collapse: collapse" width="100%" cellspacing="0" cellpadding="0" id="table1">
	<tr>
		<td height="75" bgcolor="#FFF6E5" style="border-left-style: none; border-left-width: medium; border-right-style: none; border-right-width: medium; border-top: medium none #D7C1A2; border-bottom-style: none; border-bottom-width: medium">
		&nbsp;</td>
		<td height="75" align="center" bgcolor="#FFF6E5" style="border-left-style: none; border-left-width: medium; border-right-style: none; border-right-width: medium; border-top: medium none #D7C1A2; border-bottom-style: none; border-bottom-width: medium" width="600">
		<font color="#990000" size="5"><b><?php echo $logos[$lang]; ?></font><br>
		
		<?php
		if($lang == "nl")
			{
			echo "<b>Nederlands</b> - \n";
			}
		else
			{
			echo "<a href=\"index.php?page=home&lang=nl\">Nederlands</a> -\n";
			}
		
		if($lang == "eng")
			{
			echo "<b>English</b> - \n";
			}
		else
			{
			echo "<a href=\"index.php?page=home&lang=eng\">English</a> -\n";
			}
		
		if($lang == "fra")
			{
			echo "<b>Français</b> - \n";
			}
		else
			{
			echo "<a href=\"index.php?page=home&lang=fra\">Français</a> -\n";
			}
		
		if($lang == "ger")
			{
			echo "<b>Deutsch</b> - \n";
			}
		else
			{
			echo "<a href=\"index.php?page=home&lang=ger\">Deutsch</a> -\n";
			}
		
		if($lang == "esp")
			{
			echo "<b>Español</b>\n";
			}
		else
			{
			echo "<a href=\"index.php?page=home&lang=esp\">Español</a>\n";
			}
		?>
		</td>
		<td height="75" align="center" bgcolor="#FFF6E5" style="border-left-style: none; border-left-width: medium; border-right-style: none; border-right-width: medium; border-top: medium none #D7C1A2; border-bottom-style: none; border-bottom-width: medium" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td height="20" align="center" bgcolor="#FFF6E5" style="border-left-style: none; border-left-width: medium; border-right-style: none; border-right-width: medium; border-top: medium none #D7C1A2; border-bottom-style: none; border-bottom-width: medium">
		&nbsp;</td>
		<td height="20" align="center" bgcolor="#FFF6E5" style="border-left-style: none; border-left-width: medium; border-right-style: none; border-right-width: medium; border-top: medium none #D7C1A2; border-bottom-style: none; border-bottom-width: medium" width="600">
		<table border="1" style="border-collapse: collapse;" width="100%" cellspacing="0" height="20" id="table3">
			<tr>
				<td style="border-left:1px solid; background-color: #EEE4D6; border-top-width: 1px; border-right-width: 1px; border-top-style:solid; border-right-style:solid;" align="center"><?php echo $hoofd; ?>&nbsp;
				<?php
				for($i=0; $i < count($menu); $i++)
					{
					if($i == (count($menu)-1))
						{
						$space = "";
						}
					else
						{
						$space = " - ";
						}

					$page = str_replace("_", " ", $page);
					$page = strtolower($page);
					if(@$page == $menu[$i])
						{
						global $spage;
						if(@$spage)
							{
							if(@$menu_link[$i])
								{
								$tmp_link = str_replace(" ", "_", $menu[$i]);
								$thelink = $PHP_SELF . "?page=" . $tmp_link . "&lang=" . $lang . "&include=true";
								}
							else
								{
								$thelink = $PHP_SELF . "?page=" . $page . "&lang=" . $lang;
								}
							
							echo "<b><a href=\"". $thelink . "\" style=\"text-transform: capitalize;\">$menu[$i]</a></b>$space";
							}
						else
							{
							echo "<b><font style=\"text-transform: capitalize;\">".$menu[$i]."</font></b>$space";
							}
						}
					else
						{
						if(@$menu_link[$i])
							{
							$tmp_link = str_replace(" ", "_", $menu[$i]);
							$thelink = $PHP_SELF . "?page=" . $tmp_link . "&lang=" . $lang . "&include=true";
							}
						else
							{
							$crnt_page = str_replace(" ", "_", $menu[$i]);
							$thelink = $PHP_SELF . "?page=" . $crnt_page . "&lang=" . $lang;
							}
						
						echo "<a href=\"" . $thelink . "\" style=\"text-transform: capitalize;\">" . $menu[$i] . "</a>$space";
						}
					$page = str_replace(" ", "_", $page);
					}
				?>
				</td>
			</tr>
				<?php
				$selectedroot = 2; //1 is private, 2 is other
				
				if($selectedroot == 1)
					{
					$theroot = "C:/inetpub/websites/elanManager";
					}
				elseif($selectedroot == 2)
					{
					$theroot = $_SERVER['DOCUMENT_ROOT'];
					}
				elseif($selectedroot == 3)
					{
					$theroot = "";
					}
				
				?>
		</table><br>
		</td>
		<td height="20" align="center" bgcolor="#FFF6E5" style="border-left-style: none; border-left-width: medium; border-right-style: none; border-right-width: medium; border-top: medium none #D7C1A2; border-bottom-style: none; border-bottom-width: medium" valign="top">
		&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; " valign="bottom" height="290">&nbsp;</td>
		<td style="border-style:none; border-width:medium; " valign="top" class="ctext" height="290" width="600">
		
		<table border="1" style="border-collapse: collapse" width="100%" cellspacing="0" height="100%" bordercolor="#D7C1A2" id="table2" cellpadding="10">
			<tr>
				<td id="bgscroller" class="ctext" valign="top">
				
				<?php
				if(@!$include)
					{
					if(@$page)
						{
						if(@$spage)
							{
							global $theroot;
							
							$thefile = $theroot . "/content_". $lang ."/" . strtolower($page) . "/" . strtolower($spage) . ".html";
							@$fp = fopen($thefile, "r");
							}
						else
							{
							global $theroot;
	
							$thefile = $theroot . "/content_" . strtolower($lang) . "/" . strtolower($page) . ".html";
							@$fp = fopen($thefile, "r");
							}
						}
					else
						{
						global $theroot;
						$thefile = $theroot . "/content_". $lang ."/intro.html";
						@$fp = fopen($thefile, "r");
						}
						
					if($fp)
						{
							$thepage = fread($fp, filesize($thefile));
							
							$thepage = str_replace("<html>", "", $thepage);
							$thepage = str_replace("</html>", "", $thepage);
							$thepage = str_replace("<head>", "", $thepage);
							$thepage = str_replace("<meta http-equiv=\"Content-Language\" content=\"en-us\">", "", $thepage);
							$thepage = str_replace("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1252\">", "", $thepage);
							$thepage = str_replace("</head>", "", $thepage);
							$thepage = preg_replace("/\\<title>(.*?)\<\/title>/si", "",$thepage);
							$thepage = str_replace("<body>", "", $thepage);
							$thepage = str_replace("</body>", "", $thepage);
							$thepage = str_replace("</html>", "", $thepage);
							$thepage = str_replace("[home]",$PHP_SELF, $thepage);
							$thepage = str_replace("[ext]", "", $thepage);
							$thepage = str_replace("[-]", "<hr noshade size=\"1\">", $thepage);
							$thepage = preg_replace("/\\<a href=\"(.*?)\">/si", "<a href=\"\\1&lang=". $lang ."\">",$thepage);
							
							echo $thepage;
							
						fclose($fp);
						}
					else
						{
						include("content_".$lang."/error.html");
						}
					}
				else
					{
					for($i=0; $i < count($menu); $i++)
						{
						$page = str_replace("_", " ", $page);
						if(@$menu[$i] == strtolower($page))
							{
							include("content_" . $lang."/" . $menu_link[$i] . ".html");
							}
						}
					}				
				?>
				</td>
			</tr>
		</table><br>
		</td>
		<td bgcolor="#FFF6E5" style="border-style:none; border-width:medium; " height="290">
		&nbsp;</td>
	</tr>
</table>

		<form name="subscribe" action="newsletter.php" method="POST">
		<input type="hidden" name="lang" value="<?php echo $lang; ?>">
		<div align="center">
		<table width="600" height="3%" style="border-collapse: collapse" border="1" cellspacing="0" cellpadding="4" id="newsletter_table" bordercolor="#D7C1A2">
		<tr>
			<td class="ctext" width="87">&nbsp;Newsletter:</td>
			<td class="ctext">
			<p align="center">
			<input type="text" name="email" size="20" class="textfield02" value="your@email.com" onclick="ef(this)" onblur="ff(this)"></td>
			<td class="ctext">
			<p align="center">
			<input type="submit" value="Subscribe" name="action" class="button">
			<input type="submit" value="Unsubscribe" name="action" class="button"></td>
		</tr>
	</table>
		</div>

<?php /* het volgende blok produceert reclame popups */
/*
<center>
<!-- Begin Nedstat Basic code -->
<!-- Title: Het EQnomie Manifest -->
<!-- URL: http://www.eqnomie.nl/ -->
<script language="JavaScript" type="text/javascript"
src="http://m1.nedstatbasic.net/basic.js">
</script>
<script language="JavaScript" type="text/javascript" >
<!--
  nedstatbasic("AC40/gxc7Lp2lHF9GDku47wZU+Kw", 1);
// -->
</script>
<noscript>
<a target="_blank"
href="http://www.nedstatbasic.net/stats?AC40/gxc7Lp2lHF9GDku47wZU+Kw"><i
mg
src="http://m1.nedstatbasic.net/n?id=AC40/gxc7Lp2lHF9GDku47wZU+Kw"
border="0" width="18" height="18"
alt="Nedstat Basic - Free web site statistics
Personal homepage website counter"></a><br>
<a target="_blank" href="http://www.nedstatbasic.net/">Free counter</a>
</noscript>
<!-- End Nedstat Basic code -->
</center>
*/ ?>
</body>

</html>