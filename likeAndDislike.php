<?php

    require_once('class.database.php');

	if(isset($_GET['idStireLike']) && !empty($_GET['idStireLike']))
    {
        $conexiune = new Conexiune();
        $conexiune->like($_GET['idStireLike'], $_GET['username'], $_GET['tip']);
        unset($_GET['idStireLike']);
        unset($_GET['username']);
        unset($_GET['tip']);
    }

    if(isset($_GET['idStireDislike']) && !empty($_GET['idStireDislike']))
    {
        $conexiune = new Conexiune();
        $conexiune->disLike($_GET['idStireDislike'], $_GET['username'], $_GET['tip']);
        unset($_GET['idStireDislike']);
        unset($_GET['username']);
        unset($_GET['tip']);
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
?>