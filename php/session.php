<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}

include '../php/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  die("Debes iniciar sesión para ver esta página");
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener el nombre del usuario
$sql = "SELECT nombre FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$nombre = $usuario['nombre'] ?? 'Usuario';
$stmt->close();
?>
