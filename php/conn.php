<?php
try {

	$dbh = new PDO('mysql:host=db5002726029.hosting-data.io;dbname=dbs2172565; charset=utf8', 'dbu1692362', 'Aqwaze123*');

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (PDOException $e) {
	print "Erreur !: " . $e->getMessage() . "<br/>";
	die();
}
?>