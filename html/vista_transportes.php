<?php
include '../php/session.php';

// Obtener el ID del viaje desde la URL
$viaje_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener los transportes de este viaje
$sql = "SELECT * FROM transportes ORDER BY dia DESC";
$stmt = $conn->prepare($sql);

$stmt->execute();
$resultado = $stmt->get_result();

$transportes = [];
while ($fila = $resultado->fetch_assoc()) {
  $transportes[] = $fila;
}

$stmt->close();
$conn->close();
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transportes - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/apartados_viaje_general.css">
  <link rel="stylesheet" href="../css/vista_transportes.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="mb-4">TRANSPORTES</h1>
     <div class="botones-superiores">
      <a class="btn btn-custom-blue-crear" data-bs-toggle="modal" data-bs-target="#formularioTransportes">Crear transporte</a>
      <a href="detalle_viaje.php?id=<?php echo $viaje_id; ?>" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    </div>
    <?php if (!empty($transportes)): ?>
    <!-- Aquí se listarían los transportes añadidos -->
    <?php foreach ($transportes as $transporte): ?>
      <div class="lista">
        <div class="cabecera">
          <p class="datos">Fecha - Hora</p>
          <p class="datos"><?php echo date("d/m/Y", strtotime($transporte["dia"])); ?> - <?php echo date(($transporte["hora"])); ?></p>
          <p class="datos">Tipo transporte: <?php echo htmlspecialchars($transporte["tipo_transporte"]); ?></p>
          <p class="datos">Parada / Estación: <?php echo htmlspecialchars($transporte["parada"]); ?></p>
        </div>
        <div class="acciones">
          <a href="detalle_transporte.php?id=<?php echo $transporte['id']; ?>"><img src="../imagenes/vista.png" alt="ojo"></a>
          <a data-bs-toggle="modal" data-bs-target="#editartransporte<?php echo $transporte['id']; ?>"><img src="../imagenes/lapiz.png" alt="editar"></a>
          <a href="../php/borrar_transporte.php?id=<?php echo $transporte['id']; ?>"
            onclick="return confirm('¿Seguro que quieres eliminar este transporte?');">
            <img src="../imagenes/basura.png" alt="borrar">
          </a>
        </div>
      </div>
      <!-- Incluir el modal de edición de este transporte -->
      <?php include 'editar_transporte.php'; ?>
    <?php endforeach; ?>
    <?php else: ?>
      <p>No tienes transportes creados aún.</p>
    <?php endif; ?>
  </div>
  <!-- Incluir el modal de creación de transportes -->
  <?php include 'modal_transporte.php'; ?>
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
