<?php
// Archivo: crear_alojamiento.php
// Propósito: Crear un nuevo registro de alojamiento para un viaje
// Requiere: Usuario autenticado

include 'session.php';
include 'validar_fechas.php';

// Procesar formulario POST para crear alojamiento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $viaje_id = $_POST['viaje_id'];
  $inicio = $_POST["inicio"];
  $fin = $_POST["fin"];
  $tipo = $_POST["tipo"];
  $nombre = $_POST["nombre"];
  $direccion = $_POST["direccion"];
  $checkin = $_POST["checkin"];
  $checkout = $_POST["checkout"];

  // Validar que las fechas estén dentro del rango del viaje
  $validacion = validarFechasDentroDeViaje($conn, $viaje_id, $inicio, $fin);
  if ($validacion !== true) {
    echo "Error: $validacion";
    exit();
  }

  // Ejecutar inserción del alojamiento
  $sql = "INSERT INTO alojamientos (viaje_id, fecha_inicio, fecha_fin, tipo_alojamiento, nombre, direccion, checkin, checkout) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isssssss", $viaje_id, $inicio, $fin, $tipo, $nombre, $direccion, $checkin, $checkout);

  if ($stmt->execute()) {
    // Redirigir a vista de alojamientos del viaje
    header("Location: ../html/vista_alojamientos.php?id=$viaje_id&mensaje=creado");
    exit();
  } else {
    echo "Error al guardar alojamiento: " . $stmt->error;
  }

  $stmt->close();
}
$conn->close();
?>

  $stmt->close();
}

$conn->close();
?>
