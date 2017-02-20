<?php
	session_start();
	require_once('class.database.php');

	if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1 || isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1)
	{
		$id = $_GET['sterge'];
		
		$conexiune = new Conexiune();	
		$ok = $conexiune->deleteNews($id);
		
		if($ok)
		{
			echo "<script>
				alert('Stire stearsa cu succes!');
				</script>";
		}
		else
		{
			echo "<script>
				alert('Stirea nu exista!');
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
			//echo "<script> window.location.href='". basename($_SERVER['HTTP_REFERER']).PHP_EOL ."';</script>";
			header("Location:" . basename($_SERVER['HTTP_REFERER']).PHP_EOL);
			exit();
		}
	}
?>