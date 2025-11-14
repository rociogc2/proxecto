<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recibir datos del formulario
  $viaje_id = $_POST['viaje_id'];
  $inicio = $_POST["inicio"];
  $fin = $_POST["fin"];
  $tipo = $_POST["tipo"];
  $nombre = $_POST["nombre"];
  $direccion = $_POST["direccion"];
  $checkin = $_POST["checkin"];
  $checkout = $_POST["checkout"];

  // Preparar y ejecutar la inserción en la BD
  $sql = "INSERT INTO alojamientos (viaje_id, fecha_inicio, fecha_fin, tipo_alojamiento, nombre, direccion, checkin, checkout) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isssssss", $viaje_id, $inicio, $fin, $tipo, $nombre, $direccion, $checkin, $checkout);

  if ($stmt->execute()) {
      // Redirigir a lista de alojamientos
      header("Location: ../html/vista_alojamientos.php");
      exit();
  } else {
      echo "Error al guardar alojamiento: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
