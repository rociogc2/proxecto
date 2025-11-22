<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener el viaje_id antes de eliminar
  $sql_get = "SELECT viaje_id FROM transportes WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $transporte = $resultado->fetch_assoc();
  $viaje_id = $transporte['viaje_id'] ?? 0;
  $stmt_get->close();

  // Preparar la consulta para eliminar
  $sql = "DELETE FROM transportes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de lista de transportes con el viaje_id correcto
    header("Location: ../html/vista_transportes.php?id=$viaje_id&mensaje=eliminado");
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
