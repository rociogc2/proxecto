<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener el viaje_id antes de eliminar
  $sql_get = "SELECT viaje_id FROM alojamientos WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $alojamiento = $resultado->fetch_assoc();
  $viaje_id = $alojamiento['viaje_id'] ?? 0;
  $stmt_get->close();

  // Preparar la consulta para eliminar
  $sql = "DELETE FROM alojamientos WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de lista de alojamientos con el viaje_id correcto
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
