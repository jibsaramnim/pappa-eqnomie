<?php
/* Voer hier alle HOOFDMENU opties in die je wilt
   Gelieve geen hoofdletters gebruiken.
   Spaties mogen wel.
   het nummer dat je opgeeft wordt de locatie van de menu optie, bijv. 0 komt vooraan.
*/

if($lang == "nl")
	{
	$menu["0"] = "home";
	$menu["1"] = "ondertekenen";
	$menu["2"] = "lees ondertekeningen";
	$menu["3"] = "contact";

	$menu_link["1"] = "ondertekenen";
	$menu_link["2"] = "../manifest/manifest";
	
	$sign_error = "<center>U heeft niet alle benodigde velden ingevuld.<br><br><a href=\"javascript:;\" onclick=\"window.close()\">Terug</a></center>";
	$sign_complete = "<center><br><br>Uw bericht is succesvol toegevoegd.<br>Klik <a href=\"index.php?page=lees_ondertekeningen&lang=nl&include=true\" target=\"mainpage\" onclick=\"window.close()\">hier</a> om uw bericht, en die van anderen, te bekijken.</center>\n</body>\n</html>";
	}
elseif($lang == "eng")
	{
	$menu["0"] = "home";
	$menu["1"] = "sign";
	$menu["2"] = "read signatures";
	$menu["3"] = "contact";

	$menu_link["1"] = "sign";
	$menu_link["2"] = "../manifest/manifest";
	
	$sign_error = "<center>You did not enter all required fields.<br><br><a href=\"javascript:;\" onclick=\"window.close()\">Back</a></center>";
	$sign_complete = "<center><br><br>Your messages has been succesfully added.<br>Click <a href=\"index.php?page=read_signatures&lang=eng&include=true\" target=\"mainpage\" onclick=\"window.close()\">here</a> to view your, and all other messages.</center>\n</body>\n</html>";
	}
elseif($lang == "fra")
	{
	$menu["0"] = "home";
	$menu["1"] = "signer";
	$menu["2"] = "liser signatures";
	$menu["3"] = "contacte";

	$menu_link["1"] = "signer";
	$menu_link["2"] = "../manifest/manifest";
	
	$sign_error = "<center>You did not enter all required fields.<br><br><a href=\"javascript:;\" onclick=\"window.close()\">Back</a></center>";
	$sign_complete = "<center><br><br>Your messages has been succesfully added.<br>Click <a href=\"index.php?page=liser_signatures&lang=fra&include=true\" target=\"mainpage\" onclick=\"window.close()\">here</a> to view your, and all other messages.</center>\n</body>\n</html>";
	}
elseif($lang == "ger")
	{
	$menu["0"] = "home";
	$menu["1"] = "unterschreiben";
	$menu["2"] = "unterschriften lesen";
	$menu["3"] = "contact";

	$menu_link["1"] = "unterschreiben";
	$menu_link["2"] = "../manifest/manifest";
	
	$sign_error = "<center>You did not enter all required fields.<br><br><a href=\"javascript:;\" onclick=\"window.close()\">Back</a></center>";
	$sign_complete = "<center><br><br>Your messages has been succesfully added.<br>Click <a href=\"index.php?page=read_signatures&lang=eng&include=true\" target=\"mainpage\" onclick=\"window.close()\">here</a> to view your, and all other messages.</center>\n</body>\n</html>";
	}
elseif($lang == "esp")
	{
	$menu["0"] = "home";
	$menu["1"] = "firmar";
	$menu["2"] = "leer firmas";
	$menu["3"] = "tomar contacto";

	$menu_link["1"] = "firmar";
	$menu_link["2"] = "../manifest/manifest";
	
	$sign_error = "<center>You did not enter all required fields.<br><br><a href=\"javascript:;\" onclick=\"window.close()\">Back</a></center>";
	$sign_complete = "<center><br><br>Your messages has been succesfully added.<br>Click <a href=\"index.php?page=read_signatures&lang=eng&include=true\" target=\"mainpage\" onclick=\"window.close()\">here</a> to view your, and all other messages.</center>\n</body>\n</html>";
	}

$logos['nl']  = "Het EQnomie Manifest";
$logos['eng'] = "The EQnomy Manifesto";
$logos['fra'] = "Manifest d'EQnomie";
$logos['ger'] = "Das EQnomie Manifest";
$logos['esp'] = "Manifesto EQnomico";
?>