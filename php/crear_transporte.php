<?php
// Archivo: crear_transporte.php
// Propósito: Crear un nuevo registro de transporte para un viaje
// Requiere: Usuario autenticado

include 'session.php';
include 'validar_fechas.php';

// Procesar formulario POST para crear transporte
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $viaje_id = $_POST['viaje_id'];
  $tipo_transporte = $_POST["tipo_transporte"];
  $parada = $_POST["parada"];
  $compania = $_POST["compania"];
  $dia = $_POST["dia"];
  $hora = $_POST["hora"];

  // Validar que la fecha esté dentro del rango del viaje
  $validacion = validarFechasDentroDeViaje($conn, $viaje_id, $dia, $dia);
  if ($validacion !== true) {
    echo "Error: $validacion";
    exit();
  }

  // Ejecutar inserción del transporte
  $sql = "INSERT INTO transportes (viaje_id, tipo_transporte, parada, compania, dia, hora) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isssss", $viaje_id, $tipo_transporte, $parada, $compania, $dia, $hora);

  if ($stmt->execute()) {
    // Redirigir a vista de transportes del viaje
    header("Location: ../html/vista_transportes.php?id=$viaje_id&mensaje=creado");
    exit();
  } else {
    echo "Error al guardar transporte: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>

$conn->close();
?>
