<?php
// Archivo: crear_viaje.php
// Propósito: Crear un nuevo viaje con foto
// Requiere: Usuario autenticado

include 'session.php';

// Procesar formulario POST para crear nuevo viaje
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $destino = $_POST["destino"];
  $inicio = $_POST["inicio"];
  $fin = $_POST["fin"];
  $descripcion = $_POST["descripcion"];
  $foto = null;
  $usuario_id = $_SESSION['usuario_id'];

  // Procesar carga de foto
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $carpetaDestino = '../imagenes/viajes/';
    if (!file_exists($carpetaDestino)) {
      mkdir($carpetaDestino, 0777, true);
    }
    $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
    $rutaDestino = $carpetaDestino . $nombreArchivo;
    // Mover archivo subido al destino
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
      $foto = '../imagenes/viajes/' . $nombreArchivo;
    }
  } else {
    die("Error al subir la foto.");
  }

  // Ejecutar inserción del nuevo viaje
  $sql = "INSERT INTO viajes (usuario_id, destino, inicio, fin, descripcion, foto) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isssss", $usuario_id, $destino, $inicio, $fin, $descripcion, $foto);

  if ($stmt->execute()) {
    // Redirigir a página de viajes después de crear
    header("Location: ../html/viajes.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}
$conn->close();
?>
