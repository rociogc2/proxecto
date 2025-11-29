<?php
// Archivo: borrar_itinerario.php
// Propósito: Eliminar una actividad del itinerario de un viaje
// Requiere: ID de la actividad válido en parámetro GET

include 'conexion.php';

// Verificar que se ha pasado el ID de la actividad
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener viaje_id y dia antes de eliminar para redireccionar correctamente
  $sql_get = "SELECT viaje_id, dia FROM itinerarios WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $itinerario = $resultado->fetch_assoc();
  $viaje_id = $itinerario['viaje_id'] ?? 0;
  $dia = $itinerario['dia'] ?? '';
  $stmt_get->close();

  // Preparar consulta para eliminar actividad
  $sql = "DELETE FROM itinerarios WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Verificar si aún hay actividades para ese día
    $sql_check = "SELECT COUNT(*) as count FROM itinerarios WHERE viaje_id = ? AND dia = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("is", $viaje_id, $dia);
    $stmt_check->execute();
    $resultado_check = $stmt_check->get_result();
    $row = $resultado_check->fetch_assoc();
    $stmt_check->close();

    if ($row['count'] > 0) {
      // Si aún hay itinerarios ese día, volvemos a detalle_itinerario.php
      header("Location: ../html/detalle_itinerario.php?viaje_id=$viaje_id&dia=$dia&mensaje=eliminado");
    } else {
      // Si no quedan itinerarios ese día, volvemos a vista_itinerarios.php
      header("Location: ../html/vista_itinerarios.php?id=$viaje_id&mensaje=eliminado");
    }
    exit();
  } else {
    echo "Error al eliminar el itinerario.";
  }
} else {
  echo "No se recibió el ID del itinerario.";
}

$stmt->close();
$conn->close();
?>
