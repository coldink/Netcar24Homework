<!-- <meta http-equiv="refresh" content="5; URL=http://de.selfhtml.org/">  -->

<html>
<head>
<title>Hier können Sie sich Registrieren</title>
<link href="test.css" type="text/css" rel="stylesheet">
</head>

<body>
<form action="registry.php" method="get">
<table border=0>
<tr><td>Nickname<input type="text" name="nickname" value="Alex"></td></tr>
<tr><td>Password<input type="password" name="password" value="Alex"></td></tr>
<tr><td>Password wiederholen<input type="password" name="password2" value="Alex"></td></tr>
</table>


<br>
<table border=0>
<tr><td>Vorname<input type="text" name="vorname" value="Alex"></td></tr>
<tr><td>Nachname<input type="text" name="nachname" value="Alex"></td></tr>
<tr><td>Ort<input type="text" name="ort" value="Alex"></td></tr>
<tr><td>Straße<input type="text" name="straße" value="Alex"></td></tr>
<tr><td>Hausnummer<input type="text" name="hausnummer" value="4"></td></tr>
<tr><td>PLZ<input type="text" name="plz" value="4"></td></tr>
</table>
<br><br><br>
<input type="submit" name="senden" value="Registrieren">
</form>
<br>
</body>
</html>
<?php 
if(isset($_GET['senden'])){
	
$nickname=$_GET['nickname'];
$password=$_GET['password'];
$password2=$_GET['password2'];
$vorname=$_GET['vorname'];
$nachname=$_GET['nachname'];
$ort=$_GET['ort'];
$straße=$_GET['straße'];
$hausnummer=$_GET['hausnummer'];
$plz=$_GET['plz'];

$nickright=false;
$pwright=false;
$pwrightwdh=false;
$vorright=false;
$nachright=false;
$ortright=false;
$strright=false;
$hausright=false;
$plzright=false;
$nickrightquery=false;
$eintragright=false;

$verbindung=mysql_connect('localhost','root','');
mysql_select_db('TerminplanerDB');

$abfrage=mysql_query('SELECT Nickname from users where (Nickname = "'.$nickname.'")');
$inhaltDbNickname=mysql_fetch_array($abfrage);


// Abfragen nach String-Länge um leere Einträge zu vermeiden

if (strlen($nickname)<4) { echo 'Bitte tragen Sie ein Nickname ein, der mindestens 4 Zeichen lang ist.<br>'; $nickright=false;} else {$nickright=true;}

if (strlen($password)<4) { echo 'Bitte tragen Sie ein Passwort ein, dass mindestens 4 Zeichen lang ist.<br>'; $pwright=false;}else {$pwright=true;}

if ($password!=$password2){ echo 'Ihr Passwort stimmt nicht überein.<br>';$pwrightwdh=false; }else {$pwrightwdh=true;}

if (strlen($vorname)<1) { echo 'Bitte tragen Sie einen Vornamen ein.<br>'; $vorright=false;}else {$vorright=true;}

if (strlen($nachname)<1) { echo 'Bitte tragen Sie einen Nachnamen ein.<br>'; $nachright=false;}else {$nachright=true;}

if (strlen($ort)<1) { echo 'Bitte tragen Sie einen Ort ein.<br>'; $ortright=false;}else {$ortright=true;}

if (strlen($straße)<1) { echo 'Bitte tragen Sie eine Straße ein.<br>'; $strright=false;}else {$strright=true;}

if (strlen($hausnummer)<1) { echo 'Bitte tragen Sie eine Hausnummer ein.<br>';$hausright=false; }else {$hausright=true;}

if (strlen($plz)<1) { echo 'Bitte tragen Sie eine Postleitzahl ein.<br>'; $plzright=false;}	else {$plzright=true;}

if ($nickname==$inhaltDbNickname[0]) {echo 'Dieser Nickname ist schon vergeben.';$nickrightquery=false;}else{$nickrightquery=true;}


// Wenn alles Korrekt, dann wird eingetragen in die Tabelle users
if ($nickright && $pwright && $vorright && $nachright && $ortright && $strright && $hausright && $plzright && $nickrightquery && $pwrightwdh) {
	


$verbindung=mysql_connect('localhost','root','');
mysql_select_db('TerminplanerDB');
mysql_query("INSERT INTO users (vorname,nachname,ort,straße,hausnummer,plz,nickname,pw)values ('".$vorname."','".$nachname."','".$ort."','".$straße."',".$hausnummer.",".$plz.",'".$nickname."','".$password."')");
$eintragright=true;

}
if ($eintragright) {
echo 'Sie haben sich Erfolgreich registriert.<br>';

}


echo '<a href="index.php">Hier gehts zum Login!</a>';

mysql_close($verbindung);
} else {
	echo '<a href="index.php">Hier gehts zum Login!</a>';
}
?>