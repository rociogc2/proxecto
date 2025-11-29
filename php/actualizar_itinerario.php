<?php
// Archivo: actualizar_itinerario.php
// Propósito: Actualizar información de una actividad en el itinerario de un viaje
// Requiere: Usuario autenticado

include 'session.php';

// Procesar formulario POST para actualizar itinerario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $id = intval($_POST['id']);
  $viaje_id = intval($_POST['viaje_id']);
  $dia = $_POST["dia"];
  $hora = $_POST["hora"];
  $actividad = $_POST["actividad"];

  // Ejecutar actualización en base de datos
  $sql = "UPDATE itinerarios SET dia = ?, hora = ?, actividad = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssi", $dia, $hora, $actividad, $id);

  if ($stmt->execute()) {
    // Redirigir a detalle del itinerario actualizado
    header("Location: ../html/detalle_itinerario.php?viaje_id=$viaje_id&dia=$dia&mensaje=actualizado");
    exit();
  } else {
    echo "Error al actualizar el itinerario: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
