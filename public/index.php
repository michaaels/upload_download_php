<?php
// Obtener el tamaño desde la URL: download.php/100
$requestUri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $requestUri);
$sizeMB = isset($parts[2]) ? intval($parts[2]) : 0;

//Limite MB
$maxMb = 10240;

if ($sizeMB <= 0 or $sizeMB > $maxMb) {
    http_response_code(400);
    echo "Tamaño inválido.";
    exit;
}

$sizeBytes = $sizeMB * 1024 * 1024;

// Encabezados para forzar descarga
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename={$sizeMB}MB.bin");
header("Content-Length: $sizeBytes");

// Enviar datos vacíos (relleno con ceros)
$chunkSize = 1024 * 1024; // 1 MB
$chunk = str_repeat("\0", $chunkSize);

for ($i = 0; $i < $sizeMB; $i++) {
    echo $chunk;
    flush();
}
?>
