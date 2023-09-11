<?php
// Permitir qualquer origem (não recomendado para ambientes de produção)
header("Access-Control-Allow-Origin: *");

// Permitir métodos HTTP específicos (GET, POST, PUT, DELETE, etc.)
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Permitir cabeçalhos personalizados
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Permitir credenciais em solicitações (para solicitações com credenciais, como cookies e autenticação)
header("Access-Control-Allow-Credentials: true");

// Configurar o tempo máximo que os resultados da pré-requisição (preflight) podem ser armazenados em cache (em segundos)
header("Access-Control-Max-Age: 3600");

// Definir cabeçalhos adicionais que são permitidos em solicitações
// Isso pode ser útil para personalizar as configurações de autenticação, por exemplo.
// header("Access-Control-Expose-Headers: X-My-Custom-Header, X-Another-Custom-Header");

// Verificar a origem da solicitação (opcional)
// Isso pode ser útil se você quiser permitir CORS apenas para origens específicas.
// $allowedOrigins = ["https://example.com", "https://anotherdomain.com"];
// if (in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
//     header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
// }

// Lidar com solicitações de opções preflight (para permitir métodos e cabeçalhos personalizados)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Responder com um cabeçalho '200 OK' para confirmar que as opções são permitidas
    http_response_code(200);
    exit;
}
?>