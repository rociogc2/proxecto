<?php
include 'session.php';

// Recoger los datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$password = $_POST['password']; // puede venir vacío

// Si el usuario introdujo nueva contraseña
if (!empty($password)) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $password_hash, $usuario_id);
} else {
    // Si no cambió contraseña
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $apellidos, $email, $usuario_id);
}

if ($stmt->execute()) {
  // Volver al perfil con mensaje de éxito
  header("Location: ../html/perfil.php?ok=1");
  exit;
} else {
  echo "Error al actualizar los datos: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
