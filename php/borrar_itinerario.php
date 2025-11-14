<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Preparar la consulta
  $sql = "DELETE FROM itinerarios WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de lista de itinerarios
    header("Location: ../html/vista_itinerarios.php?mensaje=eliminado");
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
