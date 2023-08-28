<?php 


require "access_control.php";
include "connection.php";

$sql = "SELECT * FROM usuarios";
$result = $db_conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table>";
  echo "<tr><th>Nome</th><th>E-mail</th><th>CPF</th></tr>";

  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["nome"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["cpf"] . "</td>";
    echo "</tr>";
  }

  echo "</table>";
  
} else {
  echo "Não há usuários cadastrados.";
}

?>