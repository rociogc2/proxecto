<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Preparar la consulta
  $sql = "DELETE FROM viajes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de lista de viajes
    header("Location: ../html/viajes.php?mensaje=eliminado");
    exit();
  } else {
    echo "Error al eliminar el viaje.";
  }
} else {
  echo "No se recibió el ID del viaje.";
}

$stmt->close();
$conn->close();
?>
