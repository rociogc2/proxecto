<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Datos del formulario
  $id = intval($_POST['id']);
  $destino = $_POST['destino'];
  $inicio = $_POST['inicio'];
  $fin = $_POST['fin'];
  $descripcion = $_POST['descripcion'] ?? '';

  // Foto actual (por si no se sube una nueva)
  $foto_actual = $_POST['foto_actual'] ?? null;
  $foto = $foto_actual;

  // Obtener el usuario actual (para asegurar que solo edita sus viajes)
  $usuario_id = $_SESSION['usuario_id'];

  // Si se sube una nueva foto
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

  // Actualizar el viaje (aseguramos que pertenece al usuario logueado)
  $sql = "UPDATE viajes
    SET destino = ?, inicio = ?, fin = ?, descripcion = ?, foto = ?
    WHERE id = ? AND usuario_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssii", $destino, $inicio, $fin, $descripcion, $foto, $id, $usuario_id);
  // Obtener la URL de referencia para redirigir después de la actualización
  $referer = $_SERVER['HTTP_REFERER'] ?? '';

  if ($stmt->execute()) {
    // Redirigir de vuelta a la página de detalle o viajes según el origen
    if (strpos($referer, 'detalle_viaje.php') !== false) {
        header("Location: $referer&mensaje=actualizado");
    } else {
        header("Location: ../html/viajes.php?mensaje=actualizado");
    }
    exit();
  }else {
    echo "Error al actualizar: " . $stmt->error;
  }
  $stmt->close();
}

$conn->close();
?>
