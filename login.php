<?php
	session_start();
	require_once('class.database.php');

	if(isset($_POST) && !empty($_POST))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$conexiune = new Conexiune();
		$row = $conexiune->getUserDetailsByUsername($username);
		
		if($row['username'] == 'admin' && $row['password'] == md5($password))
		{
			$_SESSION['admin'] = 1;
			$_SESSION['reporter'] = 1;
			$_SESSION['username'] = $username;
			echo "<script>
				alert('Te-ai logat cu succes!');
				</script>";
			header("Location:index.php");
			exit();
		}
		elseif($row['username'] != 'admin' && $row['password'] == md5($password))
		{
			$_SESSION['admin'] = 0;
			$_SESSION['reporter'] = 1;
			$_SESSION['username'] = $username;
			echo "<script>
				alert('Te-ai logat cu succes!');
				</script>";
			header("Location:index.php");
			exit();
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

      <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">Please login</h2>
        <label for="inputUser" class="sr-only">Username</label>
        <input name="username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>
