<?php
// Archivo: actualizar_perfil.php
// Propósito: Actualizar datos de perfil del usuario (nombre, apellidos, email, contraseña)
// Requiere: Usuario autenticado

include 'session.php';

// Obtener datos del formulario de actualización
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$password = $_POST['password']; // Puede venir vacío si no quiere cambiar

// Si el usuario introdujo nueva contraseña, encriptarla
if (!empty($password)) {
  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  // Actualizar con nueva contraseña
  $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, password = ? WHERE id = ?");
  $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $password_hash, $usuario_id);
} else {
  // Actualizar sin cambiar contraseña
  $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id = ?");
  $stmt->bind_param("sssi", $nombre, $apellidos, $email, $usuario_id);
}

if ($stmt->execute()) {
  // Redirigir a página de viajes con mensaje de éxito
  header("Location: ../html/viajes.php?mensaje=perfil_actualizado");
  exit;
} else {
  echo "Error al actualizar los datos: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
?>
