<?php
// Archivo: detalle_itinerario.php
// Propósito: Mostrar actividades del itinerario para un día específico
// Requiere: Usuario autenticado, ID de viaje y fecha válidos

include '../php/session.php';

// Obtener datos desde la URL
$viaje_id = isset($_GET['viaje_id']) ? intval($_GET['viaje_id']) : 0;
$dia = isset($_GET['dia']) ? $_GET['dia'] : null;

// Si falta la fecha, no podemos mostrar nada
if ($dia === null || $dia === '') {
  echo "No se indicó la fecha de itinerario.";
  exit;
}

// Obtener itinerarios del mismo viaje y misma fecha
$sql = "SELECT * FROM itinerarios
  WHERE viaje_id = ? AND dia = ?
  ORDER BY dia ASC, hora ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $viaje_id, $dia);
$stmt->execute();
$resultado = $stmt->get_result();

// Agrupar por fecha
$itinerarios_por_fecha = [];

while ($fila = $resultado->fetch_assoc()) {
  $fecha = $fila['dia'];
  if (!isset($itinerarios_por_fecha[$fecha])) {
    $itinerarios_por_fecha[$fecha] = [];
  }
  $itinerarios_por_fecha[$fecha][] = $fila;
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
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">ITINERARIO</h1>
    <div class="botones-superiores d-flex flex-wrap gap-2 mb-4 justify-content-center justify-content-sm-end">
      <a href="vista_itinerarios.php?id=<?php echo $viaje_id; ?>" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    </div>
    <!-- Mostrar itinerarios agrupados -->
    <?php if (!empty($itinerarios_por_fecha)): ?>
      <?php foreach ($itinerarios_por_fecha as $fecha => $actividades): ?>
        <div class="lista">
          <p class="datos">Día: <?php echo date("d/m/Y", strtotime($fecha)); ?></p>
          <?php foreach ($actividades as $itinerario): ?>
            <div class="cabecera">
              <p class="datos"><?php echo htmlspecialchars($itinerario["hora"]); ?> -> <?php echo htmlspecialchars($itinerario["actividad"]); ?></p>
              <div class="iconos">
                <a data-bs-toggle="modal" data-bs-target="#editaritinerario<?php echo $itinerario['id']; ?>">
                  <img src="../imagenes/lapiz.png" alt="editar">
                </a>
                <a data-bs-toggle="modal" data-bs-target="#eliminarItinerario<?php echo $itinerario['id']; ?>" style="cursor: pointer;">
                  <img src="../imagenes/basura.png" alt="borrar">
                </a>
              </div>
            </div>
            <?php include 'editar_itinerario.php'; ?>
            <!-- Modal de confirmación para eliminar itinerario -->
            <?php
            $modal_id = "eliminarItinerario" . $itinerario['id'];
            $titulo_modal = "Eliminar itinerario";
            $mensaje_modal = "¿Estás seguro de que deseas eliminar este itinerario? Esta acción es irreversible.";
            $url_accion = "../php/borrar_itinerario.php?id=" . $itinerario['id'];
            $texto_boton = "Eliminar itinerario";
            include 'modal_eliminar.php';
            ?>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
        <p>No tienes itinerarios creados aún.</p>
    <?php endif; ?>
  </div>
  <!-- Footer -->
  <div id="footer"></div>
  <!-- Scripts -->
  <script src="../js/carga-html.js"></script>
  <script>
      loadHTML("menu", "menu_privado.html");
      loadHTML("footer", "footer_privado.html");
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
