<?php
// Archivo: actualizar_transporte.php
// Propósito: Actualizar información de transporte registrado en un viaje
// Requiere: Usuario autenticado

include 'session.php';

// Procesar formulario POST para actualizar transporte
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $id = intval($_POST['id']);
  $viaje_id = intval($_POST['viaje_id']);
  $tipo_transporte = $_POST["tipo_transporte"];
  $parada = $_POST["parada"];
  $compania = $_POST["compania"];
  $dia = $_POST["dia"];
  $hora = $_POST["hora"];

  // Ejecutar actualización en base de datos
  $sql = "UPDATE transportes SET tipo_transporte = ?, parada = ?, compania = ?, dia = ?, hora = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssi", $tipo_transporte, $parada, $compania, $dia, $hora, $id);

  if ($stmt->execute()) {
    // Redirigir a detalle del transporte actualizado
    header("Location: ../html/detalle_transporte.php?id=$id&mensaje=actualizado");
    exit();
  } else {
    echo "Error al actualizar el transporte: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
