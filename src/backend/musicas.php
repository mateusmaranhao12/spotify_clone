<?php 

require "access_control.php";
include "connection.php";

$sql = "SELECT * FROM musicas";
$result = $db_conn->query($sql);

if ($result->num_rows > 0) {

    echo json_encode($result->fetch_all(MYSQLI_ASSOC)); //exibir músicas no front

} else {

    echo "Não há músicas a exibir.";
    
}
