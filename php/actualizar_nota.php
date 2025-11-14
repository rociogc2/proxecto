<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Datos del formulario
  $id = intval($_POST['id']);
  $viaje_id = intval($_POST['viaje_id']);
  $titulo = $_POST["titulo"];
  $descripcion = $_POST["descripcion"];

  // Actualizar nota
  $sql = "UPDATE notas
    SET titulo = ?, descripcion = ?
    WHERE id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $titulo, $descripcion, $id);

  if ($stmt->execute()) {
    // Redirigir de vuelta a la página del nota editado
    header("Location: ../html/vista_notas.php?id=$id&mensaje=actualizado");
    exit();
  } else {
    echo "Error al actualizar el nota: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
