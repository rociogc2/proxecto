<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recibir datos del formulario
  $viaje_id = $_POST['viaje_id'];
  $tipo_transporte = $_POST["tipo_transporte"];
  $parada = $_POST["parada"];
  $compania = $_POST["compania"];
  $dia = $_POST["dia"];
  $hora = $_POST["hora"];


  // Preparar y ejecutar la inserción en la BD
  $sql = "INSERT INTO transportes (viaje_id, tipo_transporte, parada, compania, dia, hora) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isssss", $viaje_id, $tipo_transporte, $parada, $compania, $dia, $hora);

  if ($stmt->execute()) {
      // Redirigir a lista de transportes
      header("Location: ../html/vista_transportes.php");
      exit();
  } else {
      echo "Error al guardar transporte: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
