<?php
session_start();
$benutzername=$_SESSION['benutzernameURL'];
$benutzerpassword=$_SESSION['benutzerpasswordURL'];
$verbindung=mysql_connect('localhost','root','');
mysql_select_db('TerminplanerDB');
$abfrage=mysql_query('SELECT unr,vorname,nachname,ort,straße,hausnummer,plz,nickname,pw from users where (nickname = "'.$benutzername.'" and pw = "'.$benutzerpassword.'")');
$dbuser_zeile=mysql_fetch_array($abfrage);
$unr=$dbuser_zeile["0"];
$vorn=$dbuser_zeile["1"];
$nachn=$dbuser_zeile["2"];
$ort=$dbuser_zeile["3"];
$str=$dbuser_zeile["4"];
$hausnr=$dbuser_zeile["5"];
$plz=$dbuser_zeile["6"];


?>
<html>
<head>
<title>Hier können Sie ihr Profil bearbeiten</title>
<link href="test.css" type="text/css" rel="stylesheet">
</head>
<body>
<form>
<table border=0>
<tr><td>Vorname:<input type="text" name="vorname" value="<?php echo $vorn; ?>"></td></tr>
<tr><td>Nachname:<input type="text" name="nachname" value="<?php echo $nachn; ?>"></td></tr>
<tr><td>Ort:<input type="text" name="ort" value="<?php echo $ort; ?>"></td></tr>
<tr><td>Straße:<input type="text" name="straße" value="<?php echo $str; ?>"></td></tr>
<tr><td>Hausnummer:<input type="text" name="hausnummer" value="<?php echo $hausnr; ?>"></td></tr>
<tr><td>PLZ:<input type="text" name="plz" value="<?php echo $plz; ?>"></td></tr>
</table><br>
<input type="submit" name="senden" value="Aktualisieren"><br><br>
<input type="submit" name="ent" value="Account entfernen"><br><br>
</form>


<?php 
if (isset($_GET['senden'])){ // Wenn Aktualisieren gedrückt
$vorn=$_GET['vorname'];
$nachn=$_GET['nachname'];
$ort=$_GET['ort'];
$str=$_GET['straße'];
$hausnr=$_GET['hausnummer'];
$plz=$_GET['plz'];

mysql_query("UPDATE users SET vorname = '".$vorn."', nachname = '".$nachn."', ort = '".$ort."', straße = '".$str."', hausnummer = '".$hausnr."', plz = '".$plz."' WHERE unr = '".$unr."'");
echo '<meta http-equiv="refresh" content="0; URL=http://localhost/Terminplaner/profilbearbeiten.php?t=1">'; // Eigenartige Schreibweise laut http://de.selfhtml.org/html/kopfdaten/meta.htm
}
if (isset($_GET['t'])){// Temporär(t) für das Aktualisieren der Seite Profilbearbeiten
	echo "<br>Sie haben Ihr Profil erfolgreich geändert.<br><br>";	
}
echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo=0&ub=0">Hier gehts zurück!</a>';

if (isset($_GET['ent'])){// Wenn Account entfernen gedrückt wurde
	echo "<br>Sie haben Ihr Account erfolgreich gelöscht!";
	mysql_query("DELETE FROM users WHERE unr = '".$unr."'");
	mysql_query("DELETE FROM termine WHERE unr = '".$unr."'");
	session_destroy();
	echo '<meta http-equiv="refresh" content="2; URL=http://localhost/Terminplaner/index.php">';
}
mysql_close($verbindung);
?>
</body>
</html>