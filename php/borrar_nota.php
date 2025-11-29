<?php
// Archivo: borrar_nota.php
// Propósito: Eliminar una nota asociada a un viaje
// Requiere: ID de la nota válido en parámetro GET

include 'conexion.php';

// Verificar que se ha pasado el ID de la nota
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener viaje_id antes de eliminar para redireccionar correctamente
  $sql_get = "SELECT viaje_id FROM notas WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $nota = $resultado->fetch_assoc();
  $viaje_id = $nota['viaje_id'] ?? 0;
  $stmt_get->close();

  // Preparar consulta para eliminar nota
  $sql = "DELETE FROM notas WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigir a vista de notas del viaje
    header("Location: ../html/vista_notas.php?id=$viaje_id&mensaje=eliminado");
    exit();
  } else {
    echo "Error al eliminar la nota.";
  }
} else {
  echo "No se recibió el ID de la nota.";
}

$stmt->close();
$conn->close();
?>
}

$stmt->close();
$conn->close();
?>
