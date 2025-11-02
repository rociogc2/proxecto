<?php
// Incluír la conexión a la BD
include 'conexion.php';

// Iniciar sesión
session_start();

// Comprobar que el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
  die("Debes iniciar sesión para crear un viaje");
}

// Obtener el ID del usuario logueado
$usuario_id = $_SESSION['usuario_id'];

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $destino = $_POST["destino"];
  $inicio = $_POST["inicio"];
  $fin = $_POST["fin"];
  $descripcion = $_POST["descripcion"];
  // Valor de foto por defecto (null)
  $foto = null;

  // Comprobar si se subió una foto
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $carpetaDestino = '../imagenes/viajes/';
    if (!file_exists($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }
    $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
    $rutaDestino = $carpetaDestino . $nombreArchivo;
    // Mover la foto subida a la carpeta destino
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
      $foto = '../imagenes/viajes/' . $nombreArchivo;
    }
  } else {
      die("Error al subir la foto.");
  }

  // Preparar y ejecutar la inserción del nuevo viaje
  $sql = "INSERT INTO viajes (usuario_id, destino, inicio, fin, descripcion, foto) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isssss", $usuario_id, $destino, $inicio, $fin, $descripcion, $foto);

  if ($stmt->execute()) {
    // Redirigir a la página de viajes para que pudea ver el nuevo viaje
    header("Location: ../html/viajes.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  // Cerrar la conexión
  $stmt->close();
}
// Cerrar conexión con BD
$conn->close();
?>
