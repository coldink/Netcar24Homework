<html>
<head><title>Ihre Termine</title>
<link href="test.css" type="text/css" rel="stylesheet">
</head>
</html>
<?php
session_start();
$unr=$_SESSION['unr'];
$benutzername=$_SESSION['benutzernameURL'];
$benutzerpassword=$_SESSION['benutzerpasswordURL'];
echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo=0&ub=0">Hier gehts zurück!</a><br>';
$verbindung=mysql_connect("localhost","root","");
mysql_select_db('TerminplanerDB');
$abfrage=mysql_query('SELECT * from termine where unr = '.$unr.' ORDER BY jahr ASC, monat ASC, tag ASC');
echo '<title>Ihre Termine</title>';

while ($row=mysql_fetch_row($abfrage)){// Komplette Ausgabe der Termine für den Benutzer

echo "<table border=1><tr><td><table border=1><tr><td>";
echo 'Das ist der Termin für den '.$row[6].'.'.$row[5].'.'.$row[4].'';	
echo "<html>";
echo "<body>";
echo '<form>';
echo 'Betreff:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" value="'.$row[2].'" readonly><br>';
echo 'Termininhalt: <textarea name="inhalt" cols="50" rows="5"  readonly>'.$row[3].'</textarea><br><br>';
echo '</form></body>';	
echo "</html>";
echo "</td></tr></table></td></tr></table>";
}

mysql_close($verbindung);
?>