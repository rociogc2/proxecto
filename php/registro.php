<?php
// Archivo: registro.php
// Propósito: Registrar nuevo usuario con datos personales y credenciales
// Seguridad: Contraseña encriptada con BCRYPT

include 'conexion.php';

// Procesar formulario POST de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener datos del formulario
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $usuario = $_POST["usuario"];
  $email = $_POST["email"];
  // Encriptar la contraseña para almacenarla de forma segura
  $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

  // Ejecutar inserción del nuevo usuario
  $sql = "INSERT INTO usuarios (nombre, apellidos, usuario, email, password) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $nombre, $apellidos, $usuario, $email, $password);

  if ($stmt->execute()) {
    echo "Usuario registrado correctamente";
    // Redirigir a login para que inicie sesión
    header("Location: ../html/login.html");
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}
$conn->close();
?>
