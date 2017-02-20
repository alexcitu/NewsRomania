<?php
	session_start();

	if(isset($_POST) && !empty($_POST))
	{
		require_once('uploadFile.php');
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
		
		$resultatVerificare = $conexiune->checkNews($titlu);
		
		if($resultatVerificare < 1)
		{
			$conexiune->addNews($titlu, $continut, $data, $target_file, $link, $tip, $email);
		
			echo "<script>
				alert('Stire adaugata cu succes!');
				</script>";
		}
		else
		{	
			echo "<script>
				alert('Stirea exista deja!');
				</script>";
		}
		
		if($_SERVER['HTTP_REFERER'] == 'http://localhost/paw/')
		{
			echo "<script>
				window.location.href='index.php';
				</script>";
		}
		else
		{
			header("Location:" . basename($_SERVER['HTTP_REFERER']).PHP_EOL);
			exit();
		}
	}
?>