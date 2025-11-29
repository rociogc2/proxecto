<?php
// Archivo: actualizar_nota.php
// Propósito: Actualizar notas asociadas a un viaje
// Requiere: Usuario autenticado

include 'session.php';

// Procesar formulario POST para actualizar nota
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $id = intval($_POST['id']);
  $viaje_id = intval($_POST['viaje_id']);
  $titulo = $_POST["titulo"];
  $descripcion = $_POST["descripcion"];

  // Ejecutar actualización en base de datos
  $sql = "UPDATE notas SET titulo = ?, descripcion = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $titulo, $descripcion, $id);

  if ($stmt->execute()) {
    // Redirigir a vista de notas del viaje actualizado
    header("Location: ../html/vista_notas.php?id=$viaje_id&mensaje=actualizado");
    exit();
  } else {
    echo "Error al actualizar la nota: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
