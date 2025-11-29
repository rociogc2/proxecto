<?php
// Archivo: crear_itinerario.php
// Propósito: Crear múltiples actividades en el itinerario de un viaje
// Requiere: Usuario autenticado y datos de actividades

include 'session.php';
include 'validar_fechas.php';

// Validar que sea solicitud POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../html/vista_itinerarios.php?id=$viaje_id");
  exit();
}

// Obtener y validar datos del formulario
$viaje_id = isset($_POST['viaje_id']) ? intval($_POST['viaje_id']) : 0;
$dia = isset($_POST['dia']) ? $_POST['dia'] : '';
$horas = isset($_POST['hora']) ? $_POST['hora'] : [];
$actividades = isset($_POST['actividad']) ? $_POST['actividad'] : [];

// Validaciones básicas
if ($viaje_id <= 0) {
  die("ID de viaje inválido.");
}

if (empty($dia)) {
  die("Fecha (dia) requerida.");
}

// Verificar que horas y actividades sean arrays del mismo tamaño
if (!is_array($horas) || !is_array($actividades) || count($horas) !== count($actividades)) {
  die("Datos de actividades inválidos.");
}

// Preparar consulta INSERT para itinerarios
$sql = "INSERT INTO itinerarios (viaje_id, dia, hora, actividad) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
  die("Error preparando la consulta: " . $conn->error);
}

// Validar que la fecha del itinerario esté dentro del rango del viaje
$validacion = validarFechasDentroDeViaje($conn, $viaje_id, $dia, $dia);
if ($validacion !== true) {
  echo "Error: $validacion";
  exit();
}

// Iterar e insertar cada actividad del itinerario
for ($i = 0; $i < count($horas); $i++) {
  $h = trim($horas[$i]);
  $a = trim($actividades[$i]);

  // Saltar filas vacías (hora y actividad en blanco)
  if ($h === '' && $a === '') {
    continue;
  }

  $stmt->bind_param("isss", $viaje_id, $dia, $h, $a);
  if (!$stmt->execute()) {
    die("Error al guardar itinerario: " . $stmt->error);
  }
}

$stmt->close();
$conn->close();

// Redirigir a vista de itinerarios
header("Location: ../html/vista_itinerarios.php?id=$viaje_id&mensaje=creado");
exit();
?>
