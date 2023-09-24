<?php
include "access_control.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //remover musica da playlist do usuario
    $data = json_decode(file_get_contents("php://input"));
    $usuario_id = isset($data->usuario_id) ? intval($data->usuario_id) : 0;
    $musica_id = isset($data->musica_id) ? intval($data->musica_id) : 0;

    if ($usuario_id === 0 || $musica_id === 0) {
        $res = array('status' => 'erro', 'mensagem' => 'Campos "usuario_id" ou "musica_id" ausentes ou inválidos.');
        echo json_encode($res);
    } else {
        // Verifique se o usuário tem permissão para remover a música da playlist (por exemplo, comparando o usuário_id com o proprietário da música)
        // Execute a instrução SQL DELETE para remover a música da playlist do usuário
        $sql = "DELETE FROM playlist_usuarios WHERE usuario_id = $usuario_id AND musica_id = $musica_id";

        if ($db_conn->query($sql) === TRUE) {
            $res = array('status' => 'sucesso', 'mensagem' => 'Música removida da playlist com sucesso!');
        } else {
            $res = array('status' => 'erro', 'mensagem' => 'Erro ao remover música da playlist: ' . $db_conn->error);
        }

        echo json_encode($res);
    }
} else {
    http_response_code(400);
    $res = array('status' => 'erro', 'mensagem' => 'Requisição inválida');
    echo json_encode($res);
    exit;
}

$db_conn->close();
?>