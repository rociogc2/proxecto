<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Preparar la consulta
  $sql = "DELETE FROM alojamientos WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de lista de alojamientos
    header("Location: ../html/vista_alojamientos.php?mensaje=eliminado");
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
