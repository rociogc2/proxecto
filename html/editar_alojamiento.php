<?php
include '../php/session.php';

// Determinar el ID del viaje actual sin errores
if (isset($datosViaje)) {
  $id = $datosViaje['id'];
} elseif (isset($viaje)) {
  $id = $viaje['id'];
} elseif (isset($alojamiento)) {
  $id = $alojamiento['id'];
} else {
  $id = 0; // Valor por defecto para evitar warnings
}

// Consultar datos del alojamiento del viaje actual
$sql = "SELECT fecha_inicio, fecha_fin, tipo_alojamiento, nombre, direccion, checkin, checkout
  FROM alojamientos
  WHERE id = ? AND viaje_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $viaje_id);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();
?>

<div class="modal fade" id="editarAlojamiento<?php echo $alojamiento['id']; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar alojamiento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/actualizar_alojamiento.php" method="post">
          <input type="hidden" name="viaje_id" value="<?php echo htmlspecialchars($alojamiento['viaje_id']); ?>">
          <input type="hidden" name="id" value="<?php echo $alojamiento['id']; ?>">
          <div class="mb-3">
            <label class="form-label">Día inicio</label>
            <input type="date" class="form-control" name="inicio"
              value="<?php echo htmlspecialchars($alojamiento['fecha_inicio']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Día fin</label>
            <input type="date" class="form-control" name="fin"
              value="<?php echo htmlspecialchars($alojamiento['fecha_fin']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select class="form-select" name="tipo" required>
              <option disabled>Seleccione alojamiento</option>
              <option value="Hotel" <?= $alojamiento['tipo_alojamiento'] == 'Hotel' ? 'selected' : '' ?>>Hotel</option>
              <option value="Albergue" <?= $alojamiento['tipo_alojamiento'] == 'Albergue' ? 'selected' : '' ?>>Albergue</option>
              <option value="Apartamento" <?= $alojamiento['tipo_alojamiento'] == 'Apartamento' ? 'selected' : '' ?>>Apartamento</option>
              <option value="Otro" <?= $alojamiento['tipo_alojamiento'] == 'Otro' ? 'selected' : '' ?>>Otro</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($alojamiento['nombre']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion"
              value="<?php echo htmlspecialchars($alojamiento['direccion']); ?>" required>
          </div>
          <div class="mb-3 check">
            <div class="check-item">
              <label class="form-label">Check in</label>
              <input type="time" class="form-control" name="checkin"
                value="<?php echo htmlspecialchars($alojamiento['checkin']); ?>">
            </div>
            <div class="check-item">
              <label class="form-label">Check out</label>
              <input type="time" class="form-control" name="checkout"
                value="<?php echo htmlspecialchars($alojamiento['checkout']); ?>">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <button type="submit" class="btn btn-custom-blue w-100">Guardar</button>
            </div>
            <div class="col-6">
              <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
