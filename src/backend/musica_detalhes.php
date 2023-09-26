<?php
require "access_control.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verifique se o ID da música foi fornecido na solicitação GET
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        // Consulta SQL para buscar os detalhes da música com base no ID
        $sql = "SELECT * FROM musicas WHERE id = $id";
        $result = $db_conn->query($sql);

        if ($result) {
            // Verifique se a música foi encontrada
            if ($result->num_rows > 0) {
                // Recupere os detalhes da música encontrada
                $musica = $result->fetch_assoc();
                echo json_encode($musica); // Retorne os detalhes da música em formato JSON
            } else {
                // Música não encontrada com o ID fornecido
                http_response_code(404);
                $res = array('status' => 'erro', 'mensagem' => 'Música não encontrada.');
                echo json_encode($res);
            }
        } else {
            // Erro na consulta SQL
            $res = array('status' => 'erro', 'mensagem' => 'Erro na consulta SQL: ' . $db_conn->error);
            echo json_encode($res);
        }
    } else {
        // ID da música não foi fornecido na solicitação
        http_response_code(400);
        $res = array('status' => 'erro', 'mensagem' => 'ID da música ausente na solicitação.');
        echo json_encode($res);
    }
} else {
    // Método de solicitação inválido
    http_response_code(400);
    $res = array('status' => 'erro', 'mensagem' => 'Método de solicitação inválido.');
    echo json_encode($res);
}

$db_conn->close();
?>