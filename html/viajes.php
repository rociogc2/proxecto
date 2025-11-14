<?php
include '../php/session.php';

// Obtener los viajes de este usuario
$sql = "SELECT * FROM viajes WHERE usuario_id = ? ORDER BY inicio DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

$viajes = [];
while ($fila = $resultado->fetch_assoc()) {
    $viajes[] = $fila;
}

$stmt->close();
$conn->close();
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Viajes - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/viajes.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <div class="container-fluid-viajes">
    <!-- Botón arriba -->
    <a id="crear" class="btn btn-custom-blue btn-lg mb-4" data-bs-toggle="modal" data-bs-target="#formularioViajes">Crear viaje</a>
    <!-- Contenedor de cartas -->
    <div class="cards-wrapper">
      <!-- Las cartas de los viajes se cargan dinámicamente cuando haya viajes creados -->
      <div class="cards-wrapper d-flex flex-wrap">
        <?php if (!empty($viajes)): ?>
            <?php foreach ($viajes as $viaje): ?>
                <div class="card" style="width: 18rem; margin-right: 20px; margin-bottom: 20px;">
                    <?php if(!empty($viaje['foto'])): ?>
                      <img src="<?php echo htmlspecialchars($viaje['foto']); ?>" class="card-img-top" alt="foto_<?php echo htmlspecialchars($viaje['destino']); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo htmlspecialchars($viaje['destino']); ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <?php
                          $fechaInicio = date("d/m/Y", strtotime($viaje['inicio']));
                          $fechaFin = date("d/m/Y", strtotime($viaje['fin']));
                          echo "Del $fechaInicio al $fechaFin";
                          ?>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="detalle_viaje.php?id=<?php echo $viaje['id']; ?>" class="card-link"><img src="../imagenes/ver.png" alt="ojo"></a>
                        <a data-bs-toggle="modal" data-bs-target="#editarViaje<?php echo $viaje['id']; ?>"><img src="../imagenes/editar.png" alt="editar"></a>
                        <a href="../php/borrar_viaje.php?id=<?php echo $viaje['id']; ?>" class="card-link"
                        onclick="return confirm('¿Seguro que quieres eliminar este viaje?');">
                        <img src="../imagenes/borrar.png" alt="borrar">
                      </a>
                    </div>
                  </div>
                <!-- Cargamos el modal de editar viaje -->
                <?php include 'editar_viaje.php'; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tienes viajes creados aún.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- El formulario de crear viaje es un modal que se abre al pulsar el botón "Crear viaje -->
   <?php include 'modal_viaje.php'; ?>
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
