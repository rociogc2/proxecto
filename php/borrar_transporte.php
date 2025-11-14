<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Preparar la consulta
  $sql = "DELETE FROM transportes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de lista de transportes
    header("Location: ../html/vista_transportes.php?mensaje=eliminado");
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
