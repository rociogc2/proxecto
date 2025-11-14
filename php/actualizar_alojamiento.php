<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Datos del formulario
  $id = intval($_POST['id']);
  $viaje_id = intval($_POST['viaje_id']);
  $inicio = $_POST["inicio"];
  $fin = $_POST["fin"];
  $tipo = $_POST["tipo"];
  $nombre = $_POST["nombre"];
  $direccion = $_POST["direccion"];
  $checkin = $_POST["checkin"];
  $checkout = $_POST["checkout"];

  // Actualizar alojamiento
  $sql = "UPDATE alojamientos
    SET fecha_inicio = ?, fecha_fin = ?, tipo_alojamiento = ?, nombre = ?, direccion = ?, checkin = ?, checkout = ?
    WHERE id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssi", $inicio, $fin, $tipo, $nombre, $direccion, $checkin, $checkout, $id);

  if ($stmt->execute()) {
    // Redirigir de vuelta a la página del alojamiento editado
    header("Location: ../html/detalle_alojamiento.php?id=$id&mensaje=actualizado");
    exit();
  } else {
    echo "Error al actualizar el alojamiento: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
