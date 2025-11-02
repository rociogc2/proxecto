<?php
include '../php/session.php';

// Preparar consulta para obtener datos del usuario por ID
$stmt = $conn->prepare("SELECT nombre, apellidos, email FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$datos = $result->fetch_assoc();
$stmt->close();

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu perfil - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/perfil.css">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
</head>
<body>
  <!-- Menú -->
  <div id="menu"></div>
  <div class="container-fluid perfil h-100">
    <div class="col-md-12 d-flex align-items-center justify-content-center">
      <div class="row">
        <div class="perfil-text-center mb-4">
          <!-- Icono -->
          <img class="img-fluid-icono" src="../imagenes/icono.png" alt="icono_viajamos">
          <p class="perfil">Tu perfil</p>
          <p class="perfil">Hola, <?php echo htmlspecialchars($datos['nombre']); ?></p>
        </div>
        <!-- Formulario -->
        <form action="../php/actualizar_perfil.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="nombre" value="<?php echo htmlspecialchars($datos['nombre']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="surname" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="surname" name="apellidos" value="<?php echo htmlspecialchars($datos['apellidos']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($datos['email']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña (dejar vacío si no deseas cambiarla)</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <button type="submit" class="btn btn-custom-blue w-100">Guardar</button>
            </div>
            <div class="col-6">
              <a href="viajes.php" class="btn btn-danger w-100">Cancelar</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <div id="footer"></div>
  <!-- Se cargan el menu y el footer -->
  <script src="../js/carga-html.js"></script>
  <script>
    loadHTML("menu", "menu_privado.html");
    loadHTML("footer", "footer_privado.html");
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
