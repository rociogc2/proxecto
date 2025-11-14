<?php
include '../php/session.php';

// Obtener el ID del viaje desde la URL
$viaje_id = isset($_GET['viaje_id']) ? intval($_GET['viaje_id']) : 0;

// Obtener los itinerarios de este viaje
$sql = "SELECT * FROM itinerarios ORDER BY dia DESC";
$stmt = $conn->prepare($sql);

$stmt->execute();
$resultado = $stmt->get_result();

$itinerarios = [];
while ($fila = $resultado->fetch_assoc()) {
  $itinerarios[] = $fila;
}

// Agrupar itinerarios por fecha
$itinerarios_por_fecha = [];
foreach ($itinerarios as $itinerario) {
  $fecha = $itinerario['dia'];
  if (!isset($itinerarios_por_fecha[$fecha])) {
    $itinerarios_por_fecha[$fecha] = [];
  }
  $itinerarios_por_fecha[$fecha][] = $itinerario;
}

$stmt->close();
$conn->close();
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Itinerario - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/apartados_viaje_general.css">
  <link rel="stylesheet" href="../css/detalle_itinerario.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <!-- Cargamos el modal de editar itinerario -->
  <?php $datosItinerario = $itinerario; ?>
  <?php include 'editar_itinerario.php'; ?>
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">ITINERARIO</h1>
    <a href="vista_itinerarios.php" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    <?php if (!empty($itinerarios_por_fecha)): ?>
      <?php foreach ($itinerarios_por_fecha as $fecha => $actividades): ?>
        <div class="lista">
          <p class="datos">Día: <?php echo date("d/m/Y", strtotime($fecha)); ?></p>
          <?php foreach ($actividades as $itinerario): ?>
            <div class="cabecera">
              <p class="datos">
                <?php echo htmlspecialchars($itinerario["hora"]); ?> -> <?php echo htmlspecialchars($itinerario["actividad"]); ?>
              </p>
              <div class="iconos">
                <a data-bs-toggle="modal" data-bs-target="#editaritinerario<?php echo $itinerario['id']; ?>">
                  <img src="../imagenes/lapiz.png" alt="editar">
                </a>
                <a href="../php/borrar_itinerario.php?id=<?php echo $itinerario['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar este itinerario?');">
                  <img src="../imagenes/basura.png" alt="borrar">
                </a>
              </div>
            </div>
            <?php include 'editar_itinerario.php'; ?>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
        <p>No tienes itinerarios creados aún.</p>
    <?php endif; ?>
  </div>
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
