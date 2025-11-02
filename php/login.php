<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Iniciar sesión
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Buscar el email en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Comprobar si existe el email
    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();

        // Verificar la contraseña encriptada
        if (password_verify($password, $fila['password'])) {
            // Guardar datos en la sesión
            $_SESSION['email'] = $fila['email'];
            $_SESSION['password'] = $fila['password'];
            $_SESSION['usuario_id'] = $fila['id'];
            // Redirigir a la página de viajes
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
