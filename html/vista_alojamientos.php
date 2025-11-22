<?php
include '../php/session.php';

// Obtener el ID del viaje desde la URL
$viaje_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener datos del viaje para las fechas límite
$sql_viaje = "SELECT inicio, fin FROM viajes WHERE id = ?";
$stmt_viaje = $conn->prepare($sql_viaje);
$stmt_viaje->bind_param("i", $viaje_id);
$stmt_viaje->execute();
$viaje_data = $stmt_viaje->get_result()->fetch_assoc();
$inicioViaje = $viaje_data['inicio'] ?? '';
$finViaje = $viaje_data['fin'] ?? '';
$stmt_viaje->close();

// Obtener los alojamientos de este viaje
$sql = "SELECT * FROM alojamientos WHERE viaje_id = ? ORDER BY fecha_inicio DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $viaje_id);
$stmt->execute();
$resultado = $stmt->get_result();

$alojamientos = [];
while ($fila = $resultado->fetch_assoc()) {
  $alojamientos[] = $fila;
}

$stmt->close();
$conn->close();
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alojamientos - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/apartados_viaje_general.css">
  <link rel="stylesheet" href="../css/vista_alojamientos.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">ALOJAMIENTOS</h1>
    <div class="botones-superiores d-flex flex-wrap gap-2 mb-4 justify-content-center justify-content-sm-end">
      <a class="btn btn-custom-blue-crear" data-bs-toggle="modal" data-bs-target="#formularioAlojamientos">Crear alojamiento</a>
      <a href="detalle_viaje.php?id=<?php echo $viaje_id; ?>" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    </div>
    <?php if (!empty($alojamientos)): ?>
      <!-- Aquí se listarían los alojamientos añadidos -->
      <?php foreach ($alojamientos as $alojamiento): ?>
        <div class="lista">
          <div class="cabecera">
            <p class="datos">
              Fecha: <?php echo date("d/m/Y", strtotime($alojamiento["fecha_inicio"])); ?> - <?php echo date("d/m/Y", strtotime($alojamiento["fecha_fin"])); ?>
            </p>
            <p class="datos">Nombre: <?php echo htmlspecialchars($alojamiento["nombre"]); ?></p>
          </div>
          <div class="acciones">
            <a href="detalle_alojamiento.php?id=<?php echo $alojamiento['id']; ?>"><img src="../imagenes/vista.png" alt="ojo"></a>
            <a data-bs-toggle="modal" data-bs-target="#editarAlojamiento<?php echo $alojamiento['id']; ?>"><img src="../imagenes/lapiz.png" alt="editar"></a>
            <a data-bs-toggle="modal" data-bs-target="#eliminarAlojamiento<?php echo $alojamiento['id']; ?>" style="cursor: pointer;">
              <img src="../imagenes/basura.png" alt="borrar">
            </a>
          </div>
        </div>
        <!-- Incluir el modal de edición de este alojamiento -->
        <?php include 'editar_alojamiento.php'; ?>
        <!-- Modal de confirmación para eliminar alojamiento -->
        <?php
        $modal_id = "eliminarAlojamiento" . $alojamiento['id'];
        $titulo_modal = "Eliminar alojamiento";
        $mensaje_modal = "¿Estás seguro de que deseas eliminar este alojamiento? Esta acción es irreversible.";
        $url_accion = "../php/borrar_alojamiento.php?id=" . $alojamiento['id'];
        $texto_boton = "Eliminar alojamiento";
        include 'modal_eliminar.php';
        ?>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No tienes alojamientos creados aún.</p>
    <?php endif; ?>
  </div>
  <!-- Incluir el modal de creación de alojamientos -->
  <?php include 'modal_alojamiento.php'; ?>
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
