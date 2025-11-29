<?php
// Archivo: vista_fotos.php
// Propósito: Mostrar galería de fotos del viaje
// Requiere: Usuario autenticado y ID de viaje válido

include '../php/session.php';
$viaje_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT url_foto FROM fotos WHERE viaje_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $viaje_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fotos - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/apartados_viaje_general.css">
  <link rel="stylesheet" href="../css/vista_fotos.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">FOTOS</h1>
    <div class="botones-superiores d-flex flex-wrap gap-2 mb-4 justify-content-center justify-content-sm-end">
      <a class="btn btn-custom-blue-crear" data-bs-toggle="modal" data-bs-target="#formularioFotos">Subir foto</a>
      <a href="detalle_viaje.php?id=<?php echo $viaje_id; ?>" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    </div>
    <div class="lista">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($fila = $result->fetch_assoc()): ?>
          <div class="foto-container">
            <img src="<?php echo $fila['url_foto']; ?>" alt="foto">
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No hay fotos añadidas.</p>
      <?php endif; ?>
    </div>
  </div>
  <!-- Footer -->
  <div id="footer"></div>
  <!-- Modal para subir foto -->
  <?php include 'modal_foto.php'; ?>
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
