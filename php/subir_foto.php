<?php
include 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recibir el ID del viaje (asegúrate de enviarlo desde el formulario)
  $viaje_id = isset($_POST["viaje_id"]) ? intval($_POST["viaje_id"]) : 0;

  // Comprobar si se subió una foto
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $carpetaDestino = '../imagenes/viajes/';
    if (!file_exists($carpetaDestino)) {
      mkdir($carpetaDestino, 0777, true);
    }

    // Crear un nombre único para evitar duplicados
    $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
    $rutaDestino = $carpetaDestino . $nombreArchivo;

    // Mover la foto subida a la carpeta destino
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
      $foto = '../imagenes/viajes/' . $nombreArchivo;

      // Insertar en la base de datos
      $sql = "INSERT INTO fotos (viaje_id, url_foto) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("is", $viaje_id, $foto);

      if ($stmt->execute()) {
          header("Location: ../html/vista_fotos.php");
          exit();
      } else {
          echo "Error al guardar en la base de datos: " . $stmt->error;
      }
      $stmt->close();
    } else {
      echo "Error al mover la foto a la carpeta destino.";
    }
  } else {
    echo "No se subió ninguna foto o hubo un error al subirla.";
  }
}

$conn->close();
?>
