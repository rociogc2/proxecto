<?php
// Archivo: detalle_transporte.php
// Propósito: Mostrar detalles de un transporte específico
// Requiere: Usuario autenticado y ID de transporte válido

include '../php/session.php';

// Verificar si llega el ID por GET
if (!isset($_GET['id'])) {
  die("No se ha proporcionado un ID de transporte");
}

$id = intval($_GET['id']);

// Consulta de datos
$sql = "SELECT id, viaje_id, tipo_transporte, parada, compania, dia, hora
  FROM transportes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$transporte = $resultado->fetch_assoc();

// Validar si se encontró el transporte
if (!$transporte) {
  die("No se encontró el transporte especificado");
}

// Ajustes de compatibilidad por si se incluye desde otros archivos
if (!isset($viaje_id) && isset($transporte['viaje_id'])) {
  $viaje_id = $transporte['viaje_id'];
}
?>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transporte - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/apartados_viaje_general.css">
  <link rel="stylesheet" href="../css/detalle_transporte.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <?php $datosTransporte = $transporte; ?>
  <?php include 'editar_transporte.php'; ?>
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">TRANSPORTE</h1>
    <div class="lista mt-4">
      <div class="contenido">
        <!-- Aquí se muestran todos los datos de un transporte -->
        <p class="transporte">TIPO DE TRANSPORTE: <?php echo htmlspecialchars($transporte['tipo_transporte']) ?></p>
        <p class="transporte">DÍA: <?php echo date("d/m/Y", strtotime($transporte["dia"])) ?></p>
        <p class="transporte">HORA: <?php echo htmlspecialchars($transporte['hora']) ?></p>
        <p class="transporte">PARADA/ESTACIÓN: <?php echo htmlspecialchars($transporte['parada']) ?></p>
        <p class="transporte">COMPAÑÍA: <?php echo htmlspecialchars($transporte['compania']) ?></p>
      </div>
      <div class="acciones">
        <button type="button" class="btn btn-custom-blue" data-bs-toggle="modal" data-bs-target="#editarTransporte<?php echo $transporte['id']; ?>">Modificar</button>
        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarTransporte<?php echo $transporte['id']; ?>" style="cursor: pointer;">
          Eliminar
        </a>
        <a href="vista_transportes.php?id=<?php echo $viaje_id; ?>" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <div id="footer"></div>
  <!-- Modal de confirmación para eliminar transporte -->
  <?php
  $modal_id = "eliminarTransporte" . $transporte['id'];
  $titulo_modal = "Eliminar transporte";
  $mensaje_modal = "¿Estás seguro de que deseas eliminar este transporte? Esta acción es irreversible.";
  $url_accion = "../php/borrar_transporte.php?id=" . $transporte['id'];
  $texto_boton = "Eliminar transporte";
  include 'modal_eliminar.php';
  ?>
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
