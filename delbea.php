<html>
<head>
<link href="test.css" type="text/css" rel="stylesheet">
</head>
</html>
<?php
session_start();
$verbindung=mysql_connect('localhost','root','');
mysql_select_db('TerminplanerDB');
if (isset($_GET['bea'])){
	$inhalt=$_GET['inhalt'];
	$betreff=$_GET['betreff'];
	$tnr=$_GET['tnr'];
	$unr=$_SESSION['unr'];
	
	mysql_query("UPDATE termine SET betreff = '".$betreff."' , inhalt = '".$inhalt."' WHERE unr = '".$unr."' AND tnr = '".$tnr."' ");
	echo "<br>Termin bearbeitet.";
	echo '<meta http-equiv="refresh" content="2; URL=http://localhost/Terminplaner/terminebearbeiten.php">';
}
if (isset($_GET['del'])){
		$tnr=$_GET['tnr'];
	$unr=$_SESSION['unr'];
	
	mysql_query("DELETE FROM termine WHERE unr = '".$unr."' AND tnr = '".$tnr."' ");
	echo "<br>Termin gelöscht.";
	echo '<meta http-equiv="refresh" content="2; URL=http://localhost/Terminplaner/terminebearbeiten.php">';
}
mysql_close($verbindung);
?>
