<?php
// Archivo: borrar_viaje.php
// Propósito: Eliminar un viaje de la base de datos
// Requiere: ID del viaje válido en parámetro GET

include 'conexion.php';

// Verificar que se ha pasado el ID del viaje
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Preparar consulta para eliminar viaje
  $sql = "DELETE FROM viajes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigir a página de viajes con mensaje de éxito
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
