<?php
// Mostrar errores para depuración (temporal)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Datos de conexión a la base de datos en InfinityFree
$servername = 'sql100.infinityfree.com';
$username   = 'if0_40433999';
$password   = 'contrasinalftp';
$dbname     = 'if0_40433999_viajamos';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
