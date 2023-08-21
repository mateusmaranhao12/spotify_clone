<?php

    include "access_control.php";

    include "connection.php";

    if  ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $email = $_GET['email'];
        $cpf = $_GET['cpf'];

        // Verificar se já existe um usuário com o mesmo e-mail ou CPF
        $sql = "SELECT * FROM usuarios WHERE email='$email' OR cpf='$cpf' LIMIT 1";
        $result = $db_conn->query($sql);

        if ($result->num_rows > 0) {
            // Já existe um usuário com as mesmas informações
            $res = array('status' => 'erro', 'usuario_existente' => true);
            echo json_encode($res);
        } else {
            // Não existe um usuário com as mesmas informações
            $res = array('status' => 'sucesso', 'usuario_existente' => false);
            echo json_encode($res);
        }

    }

?>