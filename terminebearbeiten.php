<html>
<head><title>Hier k�nnen Sie Ihre Termine bearbeiten</title>
<link href="test.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
session_start();
$unr=$_SESSION['unr'];
$benutzername=$_SESSION['benutzernameURL'];
$benutzerpassword=$_SESSION['benutzerpasswordURL'];
echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo=0&ub=0">Hier gehts zur�ck!</a><br>';
$verbindung=mysql_connect("localhost","root","");
mysql_select_db('TerminplanerDB');
$abfrage=mysql_query('SELECT * from termine where unr = '.$unr.' ORDER BY jahr ASC, monat ASC, tag ASC');
echo '<title>Ihre Termine</title>';


while ($row=mysql_fetch_row($abfrage)){// Komplette Ausgabe der Termine f�r den Benutzer
	
echo "<table border=1><tr><td><table border=1><tr><td>";
echo 'Das ist der Termin f�r den '.$row[6].'.'.$row[5].'.'.$row[4].'';	
echo '<form action="delbea.php">';
echo 'Betreff:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="betreff" value="'.$row[2].'" ><br>';
echo 'Termininhalt: <textarea name="inhalt" cols="50" rows="5"  >'.$row[3].'</textarea><br><br>';
echo '<input type="submit" name="bea" value="Bearbeiten">&nbsp&nbsp';
echo '<input type="submit" name="del" value="L�schen"><br><br>';
echo '<input type="hidden" name="tnr" value="'.$row[0].'">';
echo '<input type="hidden" name="unr" value="'.$row[1].'">';
echo '</form>';
echo "</td></tr></table></td></tr></table>";
}

/*
echo '<a href="http://localhost/Terminplaner/delbea.php?bea=1&tnr='.$row[0].'&unr='.$row[1].'&betreff=&inhalt=">Bearbeiten</a>';
echo '<a href="http://localhost/Terminplaner/delbea.php?del=1&tnr='.$row[0].'&unr='.$row[1].'">L�schen</a>';

$zhler=0;
$arr=array();
$arr[$zhler]=array(".$row[2].", ".$row[3].", $row[4], $row[5], $row[6], $row[0]);
$zhler++;
echo $arr[0][4];
*/



mysql_close($verbindung);
?>
</body>
</html>