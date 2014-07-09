<?php // Übungen für html, php, css, algorithmus erstellung, datenbanken, sessions, dynamische website mit url übergabe
// Funktionenbereich-------------------------------------------------------------------------------------------------
session_start();

echo "Alle Termine anzeigen, bearbeiten und löschen.";

error_reporting(E_ALL);
ini_set("display_errors", "off");
ini_set("display_startip_errors", "off");

function sessionaAbfrage() {
$richtigerbenutzer=false;
if ($dbuser_zeile['0']==$_SESSION['unr'] && $dbuser_zeile['7']==$_SESSION['benutzername'] && $dbuser_zeile['8']==$_SESSION['password']) {
	$richtigerbenutzer=true;
}
return $richtigerbenutzer;
}

function tageDesMonats ($monat,$jahr){
if ($monat<1) {$monat=12;}
if ($monat>12){$monat=1;}
switch ($monat) {
	case 1: 
		$tageMonat = 31;
		break;
	case 2: 
		if (Schaltjahr($jahr)){
			$tageMonat = 29;
		} else {
		$tageMonat = 28;
		}
		break;
	case 3: 
		$tageMonat = 31;
		break;
	case 4: 
		$tageMonat = 30;
		break;
	case 5: 
		$tageMonat = 31;
		break;
	case 6: 
		$tageMonat = 30;
		break;
	case 7: 
		$tageMonat = 31;
		break;
	case 8: 
		$tageMonat = 31;
		break;
	case 9: 
		$tageMonat = 30;
		break;
	case 10: 
		$tageMonat = 31;
		break;
	case 11: 
		$tageMonat = 30;
		break;
	case 12: 
		$tageMonat = 31;
		break;
}
return $tageMonat;
}

function Schaltjahr ($jahr) {// gibt schlatjahr t oder f zurück
	if ($jahr % 400 !=0) {$sj = false;} else {$sj = true;}
		
	
	if ($jahr % 100 !=0) {$sj = false;} else {$sj = true;}
		
	
	if ($jahr % 4 !=0) {$sj = false;} else {$sj = true;}
		
	return $sj;
}

function ersterWTmonat($monat,$jahr){//gibt den ersten WT zurück
	
	$sj=0;
	if ($jahr>2014){
		for ($i=2014;$i<=$jahr;$i++){
			if (Schaltjahr ($i)){$sj=$sj+1;} // Überprüfung auf Schaltjahr bis zum $jahr
		}
		$jahrzhler=$jahr-2014+$sj;		
	}
	if ($jahr<2014){
		for ($i=2014;$i>=$jahr;$i--){
			if (Schaltjahr ($i)){$sj=$sj+1;} // Überprüfung auf Schaltjahr bis zum $jahr
		}

		$jahrzhler=$jahr-2014-$sj;

	}
	if ($jahr==2014){
		$jahrzhler=0;
	}

	switch ($monat) {
		case 1:
			$startWochenTag=3;
		if ($jahr>2014 && Schaltjahr($jahr)){$startWochenTag=3-1;}	//Abfrage und abzug wegen neuem Tageszyklus
			
			break;
		case 2:
			
			$startWochenTag=6;
		if ($jahr>2014 && Schaltjahr($jahr)){$startWochenTag=6-1;}	// " ...
			
			break;
		case 3:
			
			$startWochenTag=6;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=6+1;}	//Abfrage und erhöhung wegen altem Tageszyklus
			break;
		case 4:
			
			$startWochenTag=2;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=2+1;}	// " ...
			break;
		case 5:
		
			$startWochenTag=4;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=4+1;}
			break;
		case 6:
			
			$startWochenTag=7;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=7+1;}
			break;
		case 7:
			
			$startWochenTag=2;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=2+1;}
			break;
		case 8:
			
			$startWochenTag=5;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=5+1;}
			break;
		case 9:
			
			$startWochenTag=1;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=1+1;}
			break;
		case 10:
			
			$startWochenTag=3;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=3+1;}
			break;
		case 11:
			
			$startWochenTag=6;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=6+1;}
			break;
		case 12:
			
			$startWochenTag=1;
		if ($jahr<2014 && Schaltjahr($jahr)){$startWochenTag=1+1;}
			break;
	}
$startWochenTag=rechWT($jahrzhler, $startWochenTag);
return $startWochenTag;
	//erster Tag im Monat
}
function rechWT($jahrzhler,$startWochenTag) { // rechnung zum ersten WT
	if (($startWochenTag+$jahrzhler)>=1 && ($startWochenTag+$jahrzhler)<=7)
	
		{$startWochenTag=$startWochenTag+$jahrzhler; return $startWochenTag;} //Wenn zwischen 1 und 7 ausgabe
		
	if (($startWochenTag+$jahrzhler)<1) {

		$temp=$startWochenTag;
		$ueb=0;
		
		for ($i=0;$i>=$jahrzhler;$i--){
			if (($temp+$jahrzhler)<1){
			$ueb++;
			$temp=$startWochenTag+(7*$ueb);
			}
		}
		$temp=$temp+$jahrzhler;
		$startWochenTag=$temp;
		return $startWochenTag;
	}	
	
	if (($startWochenTag+$jahrzhler)>7){
		
		$temp=$startWochenTag;
		$ueb=0;
		
		for ($i=0;$i<=$jahrzhler;$i++){
			if (($temp+$jahrzhler)>7){
				$ueb++;
				$temp=$startWochenTag-(7*$ueb);
				}
			
		}
		$temp=$temp+$jahrzhler;
		$startWochenTag=$temp;
		return $startWochenTag;
	}

}
function nameDesMonats ($monat){// Gibt name des Monats zurück
	
switch ($monat) {
	case 1: 
		$nameMonat = "Januar";
		break;
	case 2: 
		$nameMonat = "Februar";
		break;
	case 3: 
		$nameMonat = "März";
		break;
	case 4: 
		$nameMonat = "April";
		break;
	case 5: 
		$nameMonat = "Mai";
		break;
	case 6: 
		$nameMonat = "Juni";
		break;
	case 7: 
		$nameMonat = "Juli";
		break;
	case 8: 
		$nameMonat = "August";
		break;
	case 9: 
		$nameMonat = "September";
		break;
	case 10: 
		$nameMonat = "Oktober";
		break;
	case 11: 
		$nameMonat = "November";
		break;
	case 12: 
		$nameMonat = "Dezember";
		break;
}
return $nameMonat;
}
function existDbTerminEintrag ($unr,$jahr,$monat,$tag){ // Gibt Anzahl der Eintrage von der Tabelle Termine für den "Benutzer,...,Tag" zurürck
$abfrage_anzahl=mysql_query('SELECT count(*) from termine where (unr = "'.$unr.'" and monat = "'.$monat.'" and jahr = "'.$jahr.'" and tag = "'.$tag.'")');
if(mysql_result($abfrage_anzahl,0)==0){
	return false;
} else {
	return true;
}
}

//AUSGABE------------------------------------------------------------------------------------------------------------


$_SESSION['benutzernameURL']=$_GET['username'];
$_SESSION['benutzerpasswordURL']=$_GET['userpassword'];
	$benutzername=$_SESSION['benutzernameURL'];
$benutzerpassword=$_SESSION['benutzerpasswordURL'];	//Speichert übergebenen Benutzername und Passwort in Session 

?>
<html>
<head><title>Hallo <?php echo $benutzername; ?></title>
<link href="test.css" type="text/css" rel="stylesheet">
</head>
</html>
<?php
// Abfrage der kompletten Tabelle User und dann Ausgabe des Inhalts
$verbindung=mysql_connect('localhost','root','');
mysql_select_db('TerminplanerDB');
$abfrage=mysql_query('SELECT unr,vorname,nachname,ort,straße,hausnummer,plz,nickname,pw from users where (nickname = "'.$benutzername.'" and pw = "'.$benutzerpassword.'")');
$dbuser_zeile=mysql_fetch_array($abfrage);
$_SESSION['anmo']=0;
$_SESSION['unr']=$dbuser_zeile['0'];	



echo '<table border=0>';

	echo "<tr><td>Vorname:</td><td>{$dbuser_zeile['1']}</tr></td>";
	echo "<tr><td>Nachname:</td><td>{$dbuser_zeile['2']}</tr></td>";
	echo "<tr><td>Ort:</td><td>{$dbuser_zeile['3']}</tr></td>";
	echo "<tr><td>Straße:</td><td>{$dbuser_zeile['4']}</tr></td>";
	echo "<tr><td>Hausnummer:</td><td>{$dbuser_zeile['5']}</tr></td>";
	echo "<tr><td>PLZ:</td><td>{$dbuser_zeile['6']}</tr></td>";
	
echo '</table><br>';
echo '<a href="http://localhost/Terminplaner/profilbearbeiten.php">Profil bearbeiten</a><br><br>';
// Falls gedrückt erhöhen oder erniedrigen von anmo("anderer Monat") [Übung mit URL]
if (isset($_GET['anmo'])){
	$anmo=$_GET['anmo'];	
	$anmo--;
	echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo='.$anmo.'">Letzter Monat</a>'; 
} else {
echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo=0&ub=0">Letzter Monat</a>';  
}


echo ' ';


if (isset($_GET['anmo'])){

	$anmo=$_GET['anmo'];
	$anmo++;
	echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo='.$anmo.'">Naechster Monat</a>';  
} else {
echo '<a href="http://localhost/Terminplaner/user.php?username='.$benutzername.'&userpassword='.$benutzerpassword.'&anmo=0&ub=0">Naechster Monat</a>';  
}

$anmo=$_GET['anmo'];

$jahr=$_SESSION['jahr'];

$unr=$_SESSION['unr'];

// Berechnung bei Wechsel des Jahres ub("überschlag")
	$_SESSION['monat']=((12*$_SESSION['ub'])+date("n"))+$anmo;	// Monatsberechnung
	$monat=$_SESSION['monat'];


if ($monat<1){ // Jahrwechsel
	$jahr=$jahr-1;
	$_SESSION['ub']=$_SESSION['ub']+1;
	$_SESSION['monat']=((12*$_SESSION['ub'])+date("n"))+$anmo; // Für den ersten Monat nach Jahreswechsel

	
	$monat=$_SESSION['monat'];
	$_SESSION['jahr']=$jahr;
} 
if ($monat>12){ // Jahrwechsel
	$jahr=$jahr+1;
	$_SESSION['ub']=$_SESSION['ub']-1;
	$_SESSION['monat']=((12*$_SESSION['ub'])+date("n"))+$anmo;	// Für den ersten Monat nach Jahreswechsel

	
	$monat=$_SESSION['monat'];
	$_SESSION['jahr']=$jahr;
} 


$tageMonat=tageDesMonats($monat, $jahr); // Gibt den Tag des Monats zurück unter Berücksichtigung ob ein Schaltjahr vorliegt

$letzterMonatTage=tageDesMonats($monat-1,$jahr); // Anzahl der Tage des letzten Monats

$spaltenzhler=0;// Für den Zeilenwechsel und zählt alle Einträge mit.


$startWochenTag=ersterWTmonat($monat, $jahr); // Gibt den Anfangswochentag zurück


echo '<basefont face="Courier">';
echo '<table bgcolor="CEF4FF" border=1>';
echo '<tr><th>'.nameDesMonats($_SESSION['monat']).' '.$jahr.'</th></tr>';
echo '<tr><td><table bgcolor="white" border=1>';
echo '<tr bgcolor="FFEAB2"><th>Mo</th><th>Di</th><th>Mi</th><th>Do</th><th>Fr</th><th>Sa</th><th>So</th></tr><tr>';

if ($startWochenTag!=1){ // Wenn der StartWochenTag nicht Montag ist, dekrementieren bis zum Anfang der Zeile
	for ($i=$startWochenTag;$i>1;$i--){
		$spaltenzhler++;
			echo '<td><font color="grey">'.(($letzterMonatTage+2)-$i).'</font></td>';
			
		}
		
} else {// Wenn der StartWochenTag Montag ist, eine neue Zeile befüllen
	for ($i=7;$i>=1;$i--) {
		$spaltenzhler++;
		if ($spaltenzhler%7==0){
			echo '<td><font color="grey">'.(($letzterMonatTage+1)-$i).'</font></td></tr><tr>';
		} else {
			echo '<td><font color="grey">'.(($letzterMonatTage+1)-$i).'</font></td>';
		}
	}
}

for ($i=1;$i<=$tageMonat;$i++){// Inkrementiert bis Anzahl von Tagen in diesem Monat erreicht ist
	$spaltenzhler++;
		if ($spaltenzhler % 7 == 0){// Tag ausgeben und dann Zeilenwechsel
			
			// Speichern von Tag, Monat, Jahr in einem Verweis. Ausgabe von Tag und überprüfung ,ob ein Termin in der Tabelle Termine für diesen Tag existiert oder dieser Tag der heutige Tag ist. Hintergrundfarbe wird dementsprechend geändert. 
			if ($jahr == date("Y") && $monat == date("n") && $i == date("j")) {
			echo '<td bgcolor="CEF4FF">';
			echo '<a href="http://localhost/Terminplaner/termineintrag.php?jahr='.$jahr.'&monat='.$monat.'&tag='.$i.'" style="text-decoration: none">'.$i.'</a>';
			echo '</td></tr><tr>';
			} else {
				if (existDbTerminEintrag($unr, $jahr, $monat, $i)){
				echo '<td bgcolor="FFB9B9">';
				echo '<a href="http://localhost/Terminplaner/termineintrag.php?jahr='.$jahr.'&monat='.$monat.'&tag='.$i.'" style="text-decoration: none">'.$i.'</a>';
				echo '</td></tr><tr>';
				} 
				if (!existDbTerminEintrag($unr, $jahr, $monat, $i)){
				echo '<td>';
				echo '<a href="http://localhost/Terminplaner/termineintrag.php?jahr='.$jahr.'&monat='.$monat.'&tag='.$i.'" style="text-decoration: none">'.$i.'</a>';
				echo '</td></tr><tr>';
				}
			}
		} else {// Wenn kein Zeilenwechsel geschieht
			
			// Speichern von Tag, Monat, Jahr in einem Verweis. Ausgabe von Tag und überprüfung ,ob ein Termin in der Tabelle Termine für diesen Tag existiert oder dieser Tag der heutige Tag ist. Hintergrundfarbe wird dementsprechend geändert.
			if ($jahr == date("Y") && $monat == date("n") && $i == date("j")) {
			echo '<td bgcolor="CEF4FF">';
			echo '<a href="http://localhost/Terminplaner/termineintrag.php?jahr='.$jahr.'&monat='.$monat.'&tag='.$i.'" style="text-decoration: none">'.$i.'</a>';
			echo '</td>';
			} else {
				if (existDbTerminEintrag($unr, $jahr, $monat, $i)){
				echo '<td bgcolor="FFB9B9">';
				echo '<a href="http://localhost/Terminplaner/termineintrag.php?jahr='.$jahr.'&monat='.$monat.'&tag='.$i.'" style="text-decoration: none">'.$i.'</a>';
				echo '</td>';
				} 
				if (!existDbTerminEintrag($unr, $jahr, $monat, $i)){
				echo '<td>';
				echo '<a href="http://localhost/Terminplaner/termineintrag.php?jahr='.$jahr.'&monat='.$monat.'&tag='.$i.'" style="text-decoration: none">'.$i.'</a>';
				echo '</td>';
				}
			}


		}

}
// Ausgabe der letzten Zahlen bis zum Ende des Terminkalenders (42 Zellen)
$temp=0;
for (;$spaltenzhler<42;){
	$spaltenzhler++;
	$temp++;
if ($spaltenzhler % 7 == 0){
			echo '<td><font color="grey">'.$temp.'</font></td></tr><tr>';
		} else {
			echo '<td><font color="grey">'.$temp.'</font></td>';
		}
}

echo '</td></tr>';
echo '</table>';
echo '</tr>';
echo '</table>';
echo '</basefont><br>';
echo '<a href="http://localhost/Terminplaner/terminebearbeiten.php">Termine bearbeiten</a><br><br>';
echo '<a href="http://localhost/Terminplaner/termineall.php">Hier sehen Sie alle Ihre Termine.</a><br><br>';

echo '<a href="http://localhost/Terminplaner/logout.php"><img src="logout.png" alt="Logout" /></a>';
mysql_close($verbindung);



?>