<?php
include "access_control.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $usuario_id = isset($data->usuario_id) ? intval($data->usuario_id) : 0;
    $musica_id = isset($data->musica_id) ? intval($data->musica_id) : 0;

    if ($usuario_id === 0 || $musica_id === 0) {
        $res = array('status' => 'erro', 'mensagem' => 'Campos "usuario_id" ou "musica_id" ausentes ou inválidos.');
        echo json_encode($res);
    } else {
        // Verifique se já existe uma relação na tabela playlist_usuarios
        $sql = "SELECT * FROM playlist_usuarios WHERE usuario_id = $usuario_id AND musica_id = $musica_id";
        $result = $db_conn->query($sql);

        if ($result) {

            if ($result->num_rows === 0) {
                // A relação não existe, então podemos adicioná-la
                $sql = "INSERT INTO playlist_usuarios (usuario_id, musica_id) VALUES ($usuario_id, $musica_id)";
                if ($db_conn->query($sql) === TRUE) {
                    $res = array('status' => 'sucesso', 'mensagem' => 'Música adicionada à playlist com sucesso!');
                } else {
                    $res = array('status' => 'erro', 'mensagem' => 'Erro ao adicionar música à playlist: ' . $db_conn->error);
                }
                
            } else {
                // A relação já existe - você pode retornar um erro aqui
                $res = array('status' => 'erro', 'mensagem' => 'Música já está na playlist do usuário!');
            }
        } else {
            $res = array('status' => 'erro', 'mensagem' => 'Erro na consulta SQL: ' . $db_conn->error);
        }
        echo json_encode($res); // Apenas envie a resposta JSON aqui
    }
} else {
    http_response_code(400);
    $res = array('status' => 'erro', 'mensagem' => 'Requisição inválida');
    echo json_encode($res);
    exit;
}

$db_conn->close();
