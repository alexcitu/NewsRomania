<?php
    session_start();
    require_once('class.database.php');

    $conexiune = new Conexiune();
    $result = $conexiune->getVotes($_SESSION['username'], $_SESSION['tip']);
    while($row = $result->fetch_assoc())
    {
       $data[] = $row;
    }

    echo json_encode($data);
?>