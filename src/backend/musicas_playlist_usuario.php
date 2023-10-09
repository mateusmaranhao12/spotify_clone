<?php
include "access_control.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Verificar se o ID do usuário foi fornecido na solicitação GET

    if (isset($_GET['usuario_id'])) {
        $usuario_id = intval($_GET['usuario_id']);

        // Consulta para recuperar a playlist do usuário
        $query = "SELECT * FROM playlist_usuarios WHERE usuario_id = ?";
        $stmt = $db_conn->prepare($query);
        $stmt->bind_param('i', $usuario_id); // 'i' indica um parâmetro inteiro
        $stmt->execute();
        $result = $stmt->get_result();

        // Coleta as músicas da playlist do usuário em um array
        $playlist = array();
        while ($row = $result->fetch_assoc()) {
            $musica_id = $row['musica_id'];

            // Consulte a tabela de músicas para obter detalhes da música
            $query = "SELECT * FROM musicas WHERE id = ?";
            $stmt = $db_conn->prepare($query);
            $stmt->bind_param('i', $musica_id); // 'i' indica um parâmetro inteiro
            $stmt->execute();
            $musica = $stmt->get_result()->fetch_assoc();

            if ($musica) {
                $playlist[] = $musica;
            }
        }

        // Fechar a conexão com o banco de dados
        $db_conn->close();

        // Retorne a playlist como JSON
        header('Content-Type: application/json');
        echo json_encode($playlist);
    } else {
        // ID do usuário não foi fornecido na solicitação
        http_response_code(400);
        $res = array('status' => 'erro', 'mensagem' => 'ID do usuário ausente na solicitação.');
        echo json_encode($res);
    }
} else {
    // Método de solicitação inválido
    http_response_code(400);
    $res = array('status' => 'erro', 'mensagem' => 'Método de solicitação inválido.');
    echo json_encode($res);
}
