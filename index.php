<html>
<head>
<title>Terminplaner</title>
<link href="test.css" type="text/css" rel="stylesheet">
</head>
<body>
<h1>Loginseite zum Terminplaner</h1>
<br>
<img src="nc24-logo.png" alt="Bild" />
<form action="user.php" method="get">
<input type="hidden" name="anmo" value="0">
Benutzername<input type="text" name="username" value="Alex"><br><br>
Passwort<input type="password" name="userpassword" value="Alex"><br><br>
<input type="submit" name="login" value="Login"><br><br>
</form>
<A href="registry.php">Hier registrieren!</A>
</body>
</html>
<?php session_start();
	// Initalisierung für "user.php" Kalender
	$_SESSION['ub']=0;
	$_SESSION['jahr']=date("Y");
	$_SESSION['monat']=date("n");
	

?>