<!DOCTYPE html>
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
    <div class="botones-superiores">
      <a class="btn btn-custom-blue-crear" data-bs-toggle="modal" data-bs-target="#formularioAlojamientos">Subir foto</a>
      <a href="detalle_viaje.php?id=<?php echo $viaje_id; ?>" class="btn btn-secondary"><img src="../imagenes/volver.png" alt="flecha"> Atrás</a>
    </div>
    <div class="lista">
      <!-- Aquí se listarían los alojamientos añadidos -->
      <p>No hay fotos añadidas.</p>
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
