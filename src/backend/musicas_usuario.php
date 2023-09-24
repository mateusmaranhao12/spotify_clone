<?php

include "access_control.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $usuario_id = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : 0;

    if ($usuario_id === 0) {

        $res = array('status' => 'erro', 'mensagem' => 'ID do usuário ausente');
        echo json_encode($res);

    } else {

        $sql = "SELECT * FROM playlist_usuarios pu 
            JOIN musicas m ON pu.musica_id = m.id 
            WHERE pu.usuario_id = $usuario_id"; //query pra exibir as musicas que o usuário autenticado salvou
            
        $result = $db_conn->query($sql);

        if ($result) {

            $musicas = array();
    
            while ($row = $result->fetch_assoc()) {
                $musicas[] = array(
                    'id' => $row['id'],
                    'imagem' => $row['imagem'],
                    'musica' => $row['musica'],
                    'compositor' => $row['compositor']
                );
            }

            $res = array('status' => 'sucesso', 'musicas' => $musicas); //se cair no bloco de sucesso, exibir as musicas que o usuario salvou
            echo json_encode($res);
    
        } else {
            $res = array('status' => 'erro', 'mensagem' => 'Erro na consulta SQL: ' . $db_conn->error);
            echo json_encode($res);
        }

    }

} else {
    http_response_code(400);
    $res = array('status' => 'erro', 'mensagem' => 'Requisição inválida');
    echo json_encode($res);
    exit;
}

$db_conn->close();

?>