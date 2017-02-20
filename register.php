<?php
	session_start();
	require_once('class.database.php');

	if(isset($_POST) && !empty($_POST))
	{
		$nume = $_POST['nume'];
		$prenume = $_POST['prenume'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		
		$conexiune = new Conexiune();
		$con = $conexiune->getCon();
		
		$row = $conexiune->getUserDetailsByEmail($email);
		
		if(isset($row['email']) && $row['email'] == $email || isset($row['username']) && $row['username'] == $username)
		{
			echo "<script>
					alert('Username sau Email utilizat!');
					window.location.href='register.php';
					</script>";
		}
			
		$rez = $conexiune->registerUser($username, $password, $nume, $prenume, $email);
		
		if ($rez) 
		{
			$_SESSION['reporter'] = 1;
			$_SESSION['username'] = $username;
			echo "<script>
					alert('Inregistrare cu succes!');
					window.location.href='index.php';
					</script>";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Online news</title>

	    <link href="css/bootstrap.css" rel="stylesheet">
        
		<link rel="stylesheet" href="css/custom.css" type="text/css" />
        
        <script src="js/jquery.js"></script>
        
        <script src="js/bootstrap.js"></script>
	</head>

  <body>

    <div class="container">

      <form class="form-signin" action="register.php" method="post">
        <h2 class="form-signin-heading">Register form</h2>
		
		
        <input name="nume" class="form-control" placeholder="Nume utilizator" required>
		
		<input name="prenume" class="form-control" placeholder="Prenume utilizator" required>
		
		<input name="username" class="form-control" placeholder="Username" required>
		
		<input name="password" type="password" class="form-control" placeholder="Password" required>
      
        <input  name="email" type="email" class="form-control" placeholder="Email address" required>
		
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>