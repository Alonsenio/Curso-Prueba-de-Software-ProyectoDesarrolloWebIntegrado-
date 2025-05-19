<?php
include_once(__DIR__ . '/../config/.env.php');

$server = getenv('DB_HOST');
$user = getenv('DB_USER');
$contra = getenv('DB_PASSWORD');
$bd = getenv('DB_NAME');

$conexion = new mysqli($server, $user, $contra, $bd);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
