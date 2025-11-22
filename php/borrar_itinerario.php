<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener el viaje_id y dia antes de eliminar
  $sql_get = "SELECT viaje_id, dia FROM itinerarios WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $itinerario = $resultado->fetch_assoc();
  $viaje_id = $itinerario['viaje_id'] ?? 0;
  $dia = $itinerario['dia'] ?? '';
  $stmt_get->close();

  // Preparar la consulta para eliminar
  $sql = "DELETE FROM itinerarios WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de detalle del itinerario con los parámetros correctos
    header("Location: ../html/detalle_itinerario.php?viaje_id=$viaje_id&dia=$dia&mensaje=eliminado");
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
