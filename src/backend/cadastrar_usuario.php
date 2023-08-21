<?php

    include "access_control.php";

    include "connection.php";

    if  ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO usuarios (nome, email, cpf, senha) VALUES ('$nome', '$email', '$cpf', '$senha')";

        //verificar se houve erro ou sucesso ao cadastrar o usuario 
        if ($db_conn->query($sql) === TRUE) {
            $res = array('status' => 'sucesso', 'mensagem' => 'Usuário cadastrado com sucesso!');
            echo json_encode($res);
        } else {
            $res = array('status' => 'erro', 'mensagem' => 'Erro ao cadastrar usuário!' . $db_conn->error);
            echo json_encode($res);
        }

    }

?>