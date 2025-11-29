<?php
// Archivo: borrar_transporte.php
// Propósito: Eliminar un registro de transporte de un viaje
// Requiere: ID del transporte válido en parámetro GET

include 'conexion.php';

// Verificar que se ha pasado el ID del transporte
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener viaje_id antes de eliminar para redireccionar correctamente
  $sql_get = "SELECT viaje_id FROM transportes WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $transporte = $resultado->fetch_assoc();
  $viaje_id = $transporte['viaje_id'] ?? 0;
  $stmt_get->close();

  // Preparar consulta para eliminar transporte
  $sql = "DELETE FROM transportes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigir a vista de transportes del viaje
    header("Location: ../html/vista_transportes.php?id=$viaje_id&mensaje=eliminado");
    exit();
  } else {
    echo "Error al eliminar el transporte.";
  }
} else {
  echo "No se recibió el ID del transporte.";
}

$stmt->close();
$conn->close();
?>
}

$stmt->close();
$conn->close();
?>
