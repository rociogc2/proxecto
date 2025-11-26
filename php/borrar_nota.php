<?php
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Obtener el viaje_id antes de eliminar
  $sql_get = "SELECT viaje_id FROM notas WHERE id = ?";
  $stmt_get = $conn->prepare($sql_get);
  $stmt_get->bind_param("i", $id);
  $stmt_get->execute();
  $resultado = $stmt_get->get_result();
  $nota = $resultado->fetch_assoc();
  $viaje_id = $nota['viaje_id'] ?? 0;
  $stmt_get->close();

  // Preparar la consulta
  $sql = "DELETE FROM notas WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirigimos a la página de lista de notas con el viaje_id correcto
    header("Location: ../html/vista_notas.php?id=$viaje_id&mensaje=eliminado");
    exit();
  } else {
    echo "Error al eliminar la nota.";
  }
} else {
  echo "No se recibió el ID de la nota.";
}

$stmt->close();
$conn->close();
?>
