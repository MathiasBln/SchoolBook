<?php

    $dbname = 'db_schoolbook';
    $username = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
?>