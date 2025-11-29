<?php
// Archivo: crear_nota.php
// Propósito: Crear una nueva nota asociada a un viaje
// Requiere: Usuario autenticado

include 'session.php';

// Procesar formulario POST para crear nota
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $viaje_id = $_POST['viaje_id'];
  $titulo = $_POST["titulo"];
  $descripcion = $_POST["descripcion"];

  // Ejecutar inserción de la nota
  $sql = "INSERT INTO notas (viaje_id, titulo, descripcion) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iss", $viaje_id, $titulo, $descripcion);

  if ($stmt->execute()) {
    // Redirigir a vista de notas del viaje
    header("Location: ../html/vista_notas.php?id=$viaje_id&mensaje=creado");
    exit();
  } else {
    echo "Error al guardar nota: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
