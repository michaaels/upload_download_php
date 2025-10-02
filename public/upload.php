<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    // Opcional: puedes registrar el tamaño o nombre si necesitas estadísticas
    $size = $_FILES['file']['size'];
    $name = $_FILES['file']['name'];


// Límite en MB (ejemplo: 1024 MB)
    $maxMb = 10240;

    $maxBytes = $maxMb * 1024 * 1024;
    if ($size > $maxBytes) {
        http_response_code(413);
        echo json_encode([
            'error' => 'El archivo excede el tamaño máximo permitido',
            'limit_mb' => $maxMb
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Respuesta simple
    echo json_encode([
        'status' => 'Archivo recibido',
        'filename' => $name,
        'size_bytes' => $size
    ]);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No se recibió ningún archivo'], JSON_UNESCAPED_UNICODE);
}
?>
