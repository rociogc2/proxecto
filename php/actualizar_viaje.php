<?php
// Archivo: actualizar_viaje.php
// Propósito: Actualizar datos de un viaje existente (destino, fechas, descripción, foto)
// Requiere: Usuario autenticado

include 'session.php';

// Procesar formulario POST para actualizar viaje
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $id = intval($_POST['id']);
  $destino = $_POST['destino'];
  $inicio = $_POST['inicio'];
  $fin = $_POST['fin'];
  $descripcion = $_POST['descripcion'] ?? '';

  // Mantener foto actual si no se sube una nueva
  $foto_actual = $_POST['foto_actual'] ?? null;
  $foto = $foto_actual;
  $usuario_id = $_SESSION['usuario_id'];

  // Procesar nueva foto si se sube
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $carpetaDestino = '../imagenes/viajes/';
    if (!file_exists($carpetaDestino)) {
      mkdir($carpetaDestino, 0777, true);
    }
    $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
    $rutaDestino = $carpetaDestino . $nombreArchivo;
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
      $foto = $rutaDestino;
    }
  }

  // Ejecutar actualización en base de datos
  $sql = "UPDATE viajes SET destino = ?, inicio = ?, fin = ?, descripcion = ?, foto = ? WHERE id = ? AND usuario_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssii", $destino, $inicio, $fin, $descripcion, $foto, $id, $usuario_id);

  // Obtener página de origen para redirección correcta
  $referer = $_SERVER['HTTP_REFERER'] ?? '';

  if ($stmt->execute()) {
    // Redirigir según la página de origen
    if (strpos($referer, 'detalle_viaje.php') !== false) {
      header("Location: $referer&mensaje=actualizado");
    } else {
      header("Location: ../html/viajes.php?mensaje=actualizado");
    }
    exit();
  } else {
    echo "Error al actualizar: " . $stmt->error;
  }
  $stmt->close();
}

$conn->close();
?>
