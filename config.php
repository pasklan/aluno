<?php
    //DSN - Data Source Name
    $prefixo = "mysql:";
    $hostname = "localhost";
    $dbname = "dbsenai";
    $dsn = $prefixo . "dbname=" . $dbname . ";" . "hostname=" . $hostname;
    $user = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $user, $password);

    } catch ( PDOException $erro ) {
        echo $erro->getMessage();
    }
   
?>