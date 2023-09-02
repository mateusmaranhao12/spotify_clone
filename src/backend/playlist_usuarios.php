<?php

include "access_control.php";

include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuarioId = $_POST['usuario_id']; // Obtém o ID do usuário a partir do frontend
    $musicaId = $_POST['musica_id']; // Obtém o ID da música a partir do frontend

    // Verificar se a relação já existe na tabela (para evitar duplicações)
    $queryVerificar = "SELECT * FROM playlist_usuarios WHERE usuario_id = ? AND musica_id = ?";
    $stmtVerificar = $db_conn->prepare($queryVerificar);
    $stmtVerificar->bind_param('ii', $usuarioId, $musicaId);
    $stmtVerificar->execute();
    $resultadoVerificar = $stmtVerificar->get_result();

    if ($resultadoVerificar->num_rows === 0) { // Se a relação não existe, insira-a

        $queryInserir = "INSERT INTO playlist_usuarios (usuario_id, musica_id) VALUES (?, ?)";
        $stmtInserir = $db_conn->prepare($queryInserir);
        $stmtInserir->bind_param('ii', $usuarioId, $musicaId);

        if ($stmtInserir->execute()) {

            $res = array('status' => 'sucesso', 'mensagem' => 'Música adicionada à playlist com sucesso!');
            echo json_encode($res);

        } else {

            $res = array('status' => 'erro', 'mensagem' => 'Erro ao adicionar música à playlist!');
            echo json_encode($res);

        }

    } else {

        $res = array('status' => 'sucesso', 'mensagem' => 'Música já está na playlist do usuário!');
        echo json_encode($res);

    }

    $stmtVerificar->close();
    $stmtInserir->close();

} else {

    http_response_code(400); // Bad Request
    $res = array('status' => 'erro', 'mensagem' => 'Requisição inválida');
    echo json_encode($res);

}

$db_conn->close();

?>