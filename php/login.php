<?php
// Archivo: login.php
// Propósito: Autenticar usuario mediante email y contraseña
// Requisitos: Datos de usuario registrado en base de datos

include 'conexion.php';
session_start();

// Procesar formulario POST de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener credenciales del formulario
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Buscar usuario por email
  $sql = "SELECT * FROM usuarios WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $resultado = $stmt->get_result();

  // Validar que el email exista
  if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();

    // Verificar que la contraseña sea correcta
    if (password_verify($password, $fila['password'])) {
      // Guardar datos del usuario en sesión
      $_SESSION['email'] = $fila['email'];
      $_SESSION['password'] = $fila['password'];
      $_SESSION['usuario_id'] = $fila['id'];
      // Redirigir a página de viajes
      header("Location: ../html/viajes.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>
