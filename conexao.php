<?php
    $servername = "localhost";
    $database = "listatarefa";
    $username = "root";
    $password = "";
    $mysqli = new mysqli($servername, $username, $password, $database);
    if($mysqli->error){
        die("Falha na conexa:".$mysqli->error);

    }

?>