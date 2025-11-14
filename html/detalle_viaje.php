<?php
include '../php/session.php';

// Obtener este viaje de este usuario
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM viajes WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$viaje = $stmt->get_result()->fetch_assoc();

// Determinar la ruta de la foto
$foto_db = isset($viaje['foto']) ? trim($viaje['foto']) : '';
if (!empty($foto_db)) {
  $foto = $foto_db;
}
?>


<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($viaje['destino']); ?> - Viajamos!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../imagenes/icono.png">
  <link rel="stylesheet" href="../css/menu_privado.css">
  <link rel="stylesheet" href="../css/footer_privado.css">
  <link rel="stylesheet" href="../css/estilos_generales.css">
  <link rel="stylesheet" href="../css/detalle_viaje.css">
</head>

<body>
  <!-- Menú -->
  <div id="menu"></div>
  <!-- Header del viaje -->
  <header style="background-image: url('<?php echo htmlspecialchars($foto, ENT_QUOTES); ?>');">
    <div class="contenedor">
      <h1><?php echo htmlspecialchars($viaje['destino']); ?></h1>
      <h2>
        <?php
        $fechaInicio = date("d/m/Y", strtotime($viaje['inicio']));
        $fechaFin = date("d/m/Y", strtotime($viaje['fin']));
        echo "Del $fechaInicio al $fechaFin";
        ?>
      </h2>
      <div class="descripcion"><?php echo !empty($viaje['descripcion']) ? htmlspecialchars($viaje['descripcion']) : ''; ?></div>
    </div>
    <div class="acciones">
      <a class="btn btn-custom-blue" data-bs-toggle="modal" data-bs-target="#editarViaje<?php echo $id; ?>">Editar viaje</a>
      <a href="../php/borrar_viaje.php?id=<?php echo $viaje['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este viaje?');">
        Eliminar viaje
      </a>
      <a href="viajes.php" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    </div>
  </header>
  <!-- Cargamos el modal de editar viaje -->
  <?php $datosViaje = $viaje; ?>
  <?php include 'editar_viaje.php'; ?>
  <main>
    <div class="fila-50">
      <section>
        <img class="iconos" src="../imagenes/alojamientos.png" alt="cama">
        <a href="vista_alojamientos.php?id=<?php echo $viaje['id']; ?>">ALOJAMIENTOS</a>
        <img src="../imagenes/anadir.png" alt="mas" class="abrir-modal" data-bs-toggle="modal" data-bs-target="#formularioAlojamientos">
      </section>
      <section>
        <img class="iconos" src="../imagenes/itinerarios.png" alt="ruta">
        <a href="vista_itinerarios.php?id=<?php echo $viaje['id']; ?>">ITINERARIOS</a>
        <img src="../imagenes/anadir.png" alt="mas" class="abrir-modal" data-bs-toggle="modal" data-bs-target="#formularioItinerarios">
      </section>
    </div>
    <div class="fila-33">
      <section>
        <img class="iconos" src="../imagenes/notas.png" alt="libreta">
        <a href="vista_notas.php?id=<?php echo $viaje['id']; ?>">NOTAS</a>
        <img src="../imagenes/anadir.png" alt="mas" class="abrir-modal" data-bs-toggle="modal" data-bs-target="#formularioNotas">
      </section>
      <section>
        <img class="iconos" src="../imagenes/avion.png" alt="avion">
        <a href="vista_transportes.php?id=<?php echo $viaje['id']; ?>">TRANSPORTES</a>
        <img src="../imagenes/anadir.png" alt="mas" class="abrir-modal" data-bs-toggle="modal" data-bs-target="#formularioTransportes">
      </section>
      <section>
        <img class="iconos" src="../imagenes/fotos.png" alt="camara">
        <a href="vista_fotos.php?id=<?php echo $viaje['id']; ?>">FOTOS</a>
        <img src="../imagenes/anadir.png" alt="mas" class="abrir-modal" data-bs-toggle="modal" data-bs-target="#formularioFotos">
      </section>
    </div>
  </main>
  <!-- Modales de los apartados de los viajes -->
  <?php include 'modal_alojamiento.php'; ?>
  <?php include 'modal_itinerario.php'; ?>
  <?php include 'modal_nota.php'; ?>
  <?php include 'modal_transporte.php'; ?>
  <?php include 'modal_foto.php'; ?>
  <!-- Footer -->
  <div id="footer"></div>
  <script src="../js/carga-html.js"></script>
  <script>
    loadHTML("menu", "menu_privado.html");
    loadHTML("footer", "footer_privado.html");
  </script>

  <script src="../js/formulario-modal.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
$stmt->close();
$conn->close();
?>
</html>
