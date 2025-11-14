<?php
include '../php/session.php';

// Obtener el ID del viaje desde la URL
$viaje_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener los alojameintos de este viaje
$sql = "SELECT * FROM notas ORDER BY titulo DESC";
$stmt = $conn->prepare($sql);

$stmt->execute();
$resultado = $stmt->get_result();

$notas = [];
while ($fila = $resultado->fetch_assoc()) {
  $notas[] = $fila;
}

$stmt->close();
$conn->close();
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notas - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/apartados_viaje_general.css">
  <link rel="stylesheet" href="../css/vista_notas.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">NOTAS</h1>
    <div class="botones-superiores">
      <a class="btn btn-custom-blue-crear" data-bs-toggle="modal" data-bs-target="#formularioNotas">Crear nota</a>
      <a href="detalle_viaje.php?id=<?php echo $viaje_id; ?>" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    </div>
    <?php if (!empty($notas)): ?>
    <!-- Aquí se listarían las notas añadidos -->
    <?php foreach ($notas as $nota): ?>
      <div class="lista">
        <div class="cabecera">
          <p id ="titulo" class="datos"><?php echo htmlspecialchars($nota["titulo"]); ?></p>
          <p class="datos"><?php echo htmlspecialchars($nota["descripcion"]); ?></p>
        </div>
        <div class="acciones">
          <a data-bs-toggle="modal" data-bs-target="#editarNota<?php echo $nota['id']; ?>"><img src="../imagenes/lapiz.png" alt="editar"></a>
          <a href="../php/borrar_nota.php?id=<?php echo $nota['id']; ?>"
            onclick="return confirm('¿Seguro que quieres eliminar este nota?');">
            <img src="../imagenes/basura.png" alt="borrar">
          </a>
        </div>
      </div>
      <!-- Incluir el modal de edición de este nota -->
      <?php include 'editar_nota.php'; ?>
    <?php endforeach; ?>
    <?php else: ?>
      <p>No tienes notas creadas aún.</p>
    <?php endif; ?>
  </div>
    <!-- Incluir el modal de creación de notas -->
  <?php include 'modal_nota.php'; ?>
  <!-- Footer -->
  <div id="footer"></div>
  <!-- Se cargan el menu y el footer -->
  <script src="../js/carga-html.js"></script>
  <script>
    loadHTML("menu", "menu_privado.html");
    loadHTML("footer", "footer_privado.html");
  </script>
  <script src="../js/formulario-modal.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
