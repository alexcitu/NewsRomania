<?php
    session_start();
	require_once('class.database.php');

    $username = $_SESSION['username'];

    $conexiune = new Conexiune();
	
    $row = $conexiune->getUserDetailsByUsername($username);

    $email = $row['email'];
    $titlu = $_POST['titlu'];
    $continut = $_POST['continut'];
    $data = date("Y-m-d");
    $link = $_POST['link'];
    $tip = $_POST['tip'];
	
    if(isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name']))
    {
        require_once('uploadFile.php');
        $conexiune->updateNews($titlu, $continut, $data, $target_file, $link, $tip, $email, $_SESSION['idToEdit']);
    }
    else
    {
		$target_file = 1;
        $conexiune->updateNews($titlu, $continut, $data, $target_file, $link, $tip, $email, $_SESSION['idToEdit']);
    }
       
    unset($_SESSION['idToEdit']);
    
    if($_SESSION['referinta'] == "http://localhost/paw/")
    {
        unset($_SESSION['referinta']);
        header("Location:index.php");
        exit();
    }
    else
    {
        $var = $_SESSION['referinta'];
        unset($_SESSION['referinta']);
        header("Location:" . basename($var).PHP_EOL);
		exit();
    }
?>