<?php
// Archivo: session.php
// Propósito: Inicializar sesión de usuario y cargar datos del usuario autenticado
// Requiere: Ser incluido al inicio de páginas protegidas

// Verificar si la sesión aún no ha sido iniciada
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Incluir archivo de conexión a base de datos
include '../php/conexion.php';

// Validar que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
  die("Debes iniciar sesión para ver esta página");
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener nombre del usuario autenticado
$sql = "SELECT nombre FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$nombre = $usuario['nombre'] ?? 'Usuario';
$stmt->close();
?>
