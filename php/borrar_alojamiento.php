<?php
// Archivo: borrar_alojamiento.php
// Propósito: Eliminar un alojamiento registrado en un viaje
// Requiere: ID del alojamiento válido en parámetro GET

include 'conexion.php';

// Verificar que se ha pasado el ID del alojamiento
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener viaje_id antes de eliminar para redireccionar correctamente
  $sql_get = "SELECT viaje_id FROM alojamientos WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $alojamiento = $resultado->fetch_assoc();
  $viaje_id = $alojamiento['viaje_id'] ?? 0;
  $stmt_get->close();

  // Preparar consulta para eliminar alojamiento
  $sql = "DELETE FROM alojamientos WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigir a vista de alojamientos del viaje
    header("Location: ../html/vista_alojamientos.php?id=$viaje_id&mensaje=eliminado");
    exit();
  } else {
    echo "Error al eliminar el alojamiento.";
  }
} else {
  echo "No se recibió el ID del alojamiento.";
}

$stmt->close();
$conn->close();
?>
}

$stmt->close();
$conn->close();
?>
