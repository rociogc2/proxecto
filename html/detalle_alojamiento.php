<?php
include "../php/session.php";

// Verificar si llega el ID por GET
if (!isset($_GET['id'])) {
  die("No se ha proporcionado un ID de alojamiento");
}

$id = intval($_GET['id']);

// Consulta de datos
$sql = "SELECT id, viaje_id, fecha_inicio, fecha_fin, tipo_alojamiento, nombre, direccion, checkin, checkout
  FROM alojamientos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$alojamiento = $resultado->fetch_assoc();

// Validar si se encontró el alojamiento
if (!$alojamiento) {
  die("No se encontró el alojamiento especificado");
}

// Ajustes de compatibilidad por si se incluye desde otros archivos
if (!isset($viaje_id) && isset($alojamiento['viaje_id'])) {
  $viaje_id = $alojamiento['viaje_id'];
}
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alojamiento - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/apartados_viaje_general.css">
  <link rel="stylesheet" href="../css/detalle_alojamiento.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <!-- Cargamos el modal de editar alojamiento -->
  <?php $datosAlojamiento = $alojamiento; ?>
  <?php include 'editar_alojamiento.php'; ?>
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">ALOJAMIENTO</h1>
    <div class="lista mt-4">
      <div class="contenido">
        <!-- Aquí se muestran todos los datos de un alojamiento -->
        <p class="alojamiento">DÍA INICIO: <?php echo date("d/m/Y", strtotime($alojamiento["fecha_inicio"])) ?></p>
        <p class="alojamiento">DÍA FIN: <?php echo date("d/m/Y", strtotime($alojamiento["fecha_fin"])) ?></p>
        <p class="alojamiento">TIPO DE ALOJAMIENTO: <?php echo htmlspecialchars($alojamiento['tipo_alojamiento']) ?></p>
        <p class="alojamiento">NOMBRE: <?php echo htmlspecialchars($alojamiento['nombre']) ?></p>
        <p class="alojamiento">DIRECCIÓN: <?php echo htmlspecialchars($alojamiento['direccion']) ?></p>
        <p class="alojamiento">CHECK IN: <?php echo htmlspecialchars($alojamiento['checkin']) ?></p>
        <p class="alojamiento">CHECK OUT: <?php echo htmlspecialchars($alojamiento['checkout']) ?></p>
      </div>
      <div class="acciones">
        <button type="button" class="btn btn-custom-blue" data-bs-toggle="modal" data-bs-target="#editarAlojamiento<?php echo $alojamiento['id']; ?>">Modificar</button>
        <a class="btn btn-danger" href="../php/borrar_alojamiento.php?id=<?= $id ?>"
          onclick="return confirm('¿Seguro que quieres eliminar este alojamiento?');">
          Eliminar
        </a>
        <a href="vista_alojamientos.php" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
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
  <script src="../js/formulario-modal.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
