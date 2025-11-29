<?php
// Archivo: eliminar_cuenta.php
// Propósito: Eliminar permanentemente la cuenta y datos del usuario
// Requiere: Usuario autenticado
// Aviso: Esta operación es irreversible

include 'session.php';

// Preparar consulta para eliminar usuario
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);

if ($stmt->execute()) {
  $stmt->close();
  // Destruir sesión del usuario
  session_destroy();
  // Redirigir a página de inicio con mensaje
  header("Location: ../html/index.php?mensaje=cuenta_eliminada");
  exit;
} else {
  echo "Error al eliminar la cuenta: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
