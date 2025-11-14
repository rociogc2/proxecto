<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Datos del formulario
  $id = intval($_POST['id']);
  $viaje_id = intval($_POST['viaje_id']);
  $dia = $_POST["dia"];
  $hora = $_POST["hora"];
  $actividad = $_POST["actividad"];

  // Actualizar itinerario
  $sql = "UPDATE itinerarios
    SET dia = ?, hora = ?, actividad = ?
    WHERE id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssi", $dia, $hora, $actividad, $id);

  if ($stmt->execute()) {
    // Redirigir de vuelta a la página del itinerario editado
    header("Location: ../html/detalle_itinerario.php?id=$id&mensaje=actualizado");
    exit();
  } else {
    echo "Error al actualizar el itinerario: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
