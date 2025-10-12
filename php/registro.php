<?php
// Incluimos la conexión a la base de datos
include 'conexion.php';

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encriptar la contraseña

    // Preparar y ejecutar la inserción del nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, apellidos, usuario, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellidos, $usuario, $email, $password);

    if ($stmt->execute()) {
        echo "Usuario registrado correctamente";
        // Redirigimos a la página de login para que pueda iniciar sesión
        header("Location: ../html/login.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
  }
  $conn->close();
?>
