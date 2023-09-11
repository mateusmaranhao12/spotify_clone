<?php

include "access_control.php";

include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

    // Receber dados do formulário de login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o usuário existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $db_conn->query($sql);

    if ($result->num_rows > 0) {

        // Usuário encontrado, retornar nome e uma resposta de sucesso
        $row = $result->fetch_assoc();
        $nomeUsuario = $row['nome'];
        $idUsuario = $row['id'];
        $response = array('status' => 'sucesso', 'id' => $idUsuario , 'nome' => $nomeUsuario, 'mensagem' => 'Login realizado com sucesso!');

    } else {
        
        // Usuário não encontrado, retornar uma resposta de erro
        $response = array('status' => 'erro', 'mensagem' => 'E-mail ou senha incorretos.');
    }

    // Enviar a resposta como JSON
    echo json_encode($response);

}

$db_conn->close();

?>
