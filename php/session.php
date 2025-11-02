<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../php/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    die("Debes iniciar sesión para ver esta página");
}

$usuario_id = $_SESSION['usuario_id'];
?>
