<html>
<head><title>Hier können Sie ein Termin eintragen</title>
<link href="test.css" type="text/css" rel="stylesheet">
</head>
</html>
<?php
session_start();



$jahr=$_GET['jahr'];
$monat=$_GET['monat'];
$tag=$_GET['tag'];
$unr=$_SESSION['unr'];
$benutzername=$_SESSION['benutzernameURL'];
$benutzerpassword=$_SESSION['benutzerpasswordURL'];

// Abfrag ob Termine für den Tag,Monat,Jahr existieren
$verbindung=mysql_connect('localhost','root','');
mysql_select_db('TerminplanerDB');
$abfrage_anzahl=mysql_query('SELECT count(*) from termine where (unr = "'.$unr.'" and monat = "'.$monat.'" and jahr = "'.$jahr.'" and tag = "'.$tag.'")');

// WENN KEIN TERMIN EXISTIERT!
if(mysql_result($abfrage_anzahl,0)==0){
	echo "Noch keinen Termin eingetragen?<br><br>";
	echo "Hier können Sie einen neuen Termin eintragen";
// Eingabefelder für ein neuen Termin
echo "<html>";
echo "<head><title>Hier können Sie ein Termin eintragen></title></head>";
echo "<body>";
echo '<form action="termineintrag.php" method="get">';
echo '<input type="hidden" name="jahr" value="'.$jahr.'">';
echo '<input type="hidden" name="monat" value="'.$monat.'">';
echo '<input type="hidden" name="tag" value="'.$tag.'">';
echo 'Betreff:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name=betreff><br>';
echo 'Termininhalt: <textarea name="inhalt" cols="50" rows="5"></textarea><br><br>';
echo '<input type="submit" name="eintragen" value="Jetzt eintragen!">';
echo '</form>';
echo "</body><br><br>";
echo "</html>";	
echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo=0&ub=0">Hier gehts zurück!</a>';


	if (isset($_GET['eintragen'])){ // Eintragung in Tabelle Termine
		$betreff=$_GET['betreff'];
		$inhalt=$_GET['inhalt'];
		mysql_query('INSERT INTO termine (unr,jahr,monat,tag,betreff,inhalt)values ("'.$unr.'","'.$jahr.'","'.$monat.'","'.$tag.'","'.$betreff.'","'.$inhalt.'")');
	}
}
// WENN EIN TERMIN EXISTIERT!
else {
	
	echo "Hier sind ihre Termine für den ".$tag.".".$monat.".".$jahr."<br><br>";
	// Ausgabe aller Termine für den Tag
	$abfrage=mysql_query('SELECT unr,jahr,monat,tag,betreff,inhalt from termine where (unr = "'.$unr.'" and monat = "'.$monat.'" and jahr = "'.$jahr.'" and tag = "'.$tag.'")');
	while ($row=mysql_fetch_row($abfrage)){ 
echo "<table border=1><tr><td><table border=1><tr><td>";			
echo "<html>";
echo "<body>";
echo '<form>';
echo 'Betreff:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" value="'.$row[4].'" readonly><br>';
echo 'Termininhalt: <textarea name="inhalt" cols="50" rows="5"  readonly>'.$row[5].'</textarea><br><br>';
echo '</form></body>';	
echo "</html>";
echo "</td></tr></table></td></tr></table><br>";


	
	}
	
// Eingabefelder für ein neuen Termin
echo "<html>";
echo "<head><title>Hier können Sie ein Termin eintragen></title></head>";
echo "<body>";
echo "Hier können Sie ein neuen Termin eintragen.";
echo '<form action="termineintrag.php" method="get">';
echo '<input type="hidden" name="jahr" value="'.$jahr.'">';
echo '<input type="hidden" name="monat" value="'.$monat.'">';
echo '<input type="hidden" name="tag" value="'.$tag.'">';
echo 'Betreff:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name=betreff><br>';
echo 'Termininhalt: <textarea name="inhalt" cols="50" rows="5"></textarea><br><br>';
echo '<input type="submit" name="eintragen" value="Jetzt eintragen!">';
echo '</form>';
echo "</body><br><br>";
echo "</html>";	

echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo=0&ub=0">Hier gehts zurück!</a>';
	
if (isset($_GET['eintragen'])){ // Eintragung in Tabelle Termine
		$betreff=$_GET['betreff'];
		$inhalt=$_GET['inhalt'];
		mysql_query('INSERT INTO termine (unr,jahr,monat,tag,betreff,inhalt)values ("'.$unr.'","'.$jahr.'","'.$monat.'","'.$tag.'","'.$betreff.'","'.$inhalt.'")');
	}
}


mysql_close($verbindung);

?>