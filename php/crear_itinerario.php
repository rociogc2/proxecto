<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../html/vista_itinerarios.php");
  exit();
}

// Validaciones básicas
$viaje_id = isset($_POST['viaje_id']) ? intval($_POST['viaje_id']) : 0;
$dia = isset($_POST['dia']) ? $_POST['dia'] : '';
$horas = isset($_POST['hora']) ? $_POST['hora'] : [];
$actividades = isset($_POST['actividad']) ? $_POST['actividad'] : [];

if ($viaje_id <= 0) {
  die("ID de viaje inválido.");
}

if (empty($dia)) {
  die("Fecha (dia) requerida.");
}

// Comprueba que horas y actividades sean arrays y tengan mismo tamaño
if (!is_array($horas) || !is_array($actividades) || count($horas) !== count($actividades)) {
  die("Datos de actividades inválidos.");
}

$sql = "INSERT INTO itinerarios (viaje_id, dia, hora, actividad) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
  die("Error preparando la consulta: " . $conn->error);
}

// Iterar e insertar cada actividad
for ($i = 0; $i < count($horas); $i++) {
  $h = trim($horas[$i]);
  $a = trim($actividades[$i]);

  // Saltar filas vacías
  if ($h === '' && $a === '') continue;
  $stmt->bind_param("isss", $viaje_id, $dia, $h, $a);
  if (!$stmt->execute()) {
    die("Error al guardar itinerario: " . $stmt->error);
  }
}

$stmt->close();
$conn->close();

// Redirigir a la vista
header("Location: ../html/vista_itinerarios.php");
exit();
?>
