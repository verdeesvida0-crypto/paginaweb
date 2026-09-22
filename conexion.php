<?php
declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_OFF);

$host = getenv('VSV_DB_HOST') ?: 'localhost';
$usuario_db = getenv('VSV_DB_USER') ?: 'root';
$password_db = getenv('VSV_DB_PASS') ?: '';
$nombre_db = getenv('VSV_DB_NAME') ?: 'verde_es_vida';

$conexion = new mysqli($host, $usuario_db, $password_db, $nombre_db);
if ($conexion->connect_errno) {
    die('No fue posible conectar con la base de datos. Verifica XAMPP/MySQL y la base de datos verde_es_vida.');
}
$conexion->set_charset('utf8mb4');
?>