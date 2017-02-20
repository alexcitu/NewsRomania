<?php
	session_start();
	
	require_once('class.database.php');

	$conexiune = new Conexiune();
	
	$row = $conexiune->getUserDetailsByUsername($_SESSION['username']);
	$email = $row['email'];
	$nume = $row['nume'];
	$prenume = $row['prenume'];
	$nrStiri = $conexiune->nrOfNewsByEmail($email);
	
	echo '<p>Nume utilizator: '. $nume .' </p>';
	echo '<p>Prenume utilizator: '. $prenume .' </p>';
	echo '<p>Numar stiri adaugate: '. $nrStiri .' </p>';

?>