<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recibir datos del formulario
  $viaje_id = $_POST['viaje_id'];
  $titulo = $_POST["titulo"];
  $descripcion = $_POST["descripcion"];

  // Preparar y ejecutar la inserción en la BD
  $sql = "INSERT INTO notas (viaje_id, titulo, descripcion) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iss", $viaje_id, $titulo, $descripcion);

  if ($stmt->execute()) {
      // Redirigir a lista de notas
      header("Location: ../html/vista_notas.php");
      exit();
  } else {
      echo "Error al guardar nota: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
