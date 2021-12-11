<?php
$db = mysql_connect("localhost", "pjansen", "FFGZHT64");
mysql_select_db("eqnomie");

$query   = "SELECT name,email,activated FROM newsletter WHERE activated='1'";
$results = mysql_query($query);
$count   = mysql_num_rows($results);

if($count > 0)
	{
	for($i=0; $i < $count; $i++)
		{
		if($i == ($count-1))
			{
			$end = "";
			}
		else
			{
			$end = ", ";
			}
		
		$row = mysql_fetch_array($results);
		
		echo $row['name'] . " &lt;". $row['email'] . "&gt;" . $end;
		} 
	}
else
	{
	echo "<center><i>Geen actieve aanmeldingen gevonden.</i></center>";
	}

?>
