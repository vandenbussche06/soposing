<?php
	$dsn = "mysql:host=mysql;dbname=dbs2172565;charset=utf8";
	$options = [
		PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
	];
	try {
		$dbh = new PDO($dsn, "root", ".sweetpwd.", $options);
	} catch (Exception $e) {
		error_log($e->getMessage());
		exit('Oups !'); //something a user can understand
	}
?>