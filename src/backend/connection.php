<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spotify_clone";

// Cria uma conexão com o banco de dados
$db_conn = new mysqli($servername, $username, $password, $dbname);

if ($db_conn->connect_error) {
    die("DataBase Connection failed: " . $db_conn->connect_error);
}

?>