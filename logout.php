<?php
	session_start();

	session_unset(); 

	session_destroy(); 

	echo "<script>
	alert('Te-ai delogat cu succes!');
	window.location.href='login.php';
	</script>";
?>