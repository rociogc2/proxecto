<?php
include 'session.php';

// Preparar consulta para eliminar el usuario
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);

if ($stmt->execute()) {
    $stmt->close();
    // Destruir la sesión
    session_destroy();
    // Redirigir a la página de inicio
    header("Location: ../html/index.php?mensaje=cuenta_eliminada");
    exit;
} else {
    echo "Error al eliminar la cuenta: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
