<?php
include '../php/session.php';

// Determinar el ID del viaje actual sin errores
if (isset($datosViaje)) {
  $id = $datosViaje['id'];
} elseif (isset($viaje)) {
  $id = $viaje['id'];
} elseif (isset($transporte)) {
  $id = $transporte['id'];
} else {
  $id = 0; // Valor por defecto para evitar warnings
}

// Consultar datos del transporte del viaje actual
$sql = "SELECT tipo_transporte, parada, compania, dia, hora
  FROM transportes
  WHERE id = ? AND viaje_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $viaje_id);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();
?>

<div class="modal fade" id="editarTransporte<?php echo $transporte['id']; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar transporte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/actualizar_transporte.php" method="post">
          <input type="hidden" name="viaje_id" value="<?php echo htmlspecialchars($transporte['viaje_id']); ?>">
          <input type="hidden" name="id" value="<?php echo $transporte['id']; ?>">
           <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name="tipo_transporte">
              <option value="" selected disabled>Seleccione un transporte</option>
              <option value="Autobús" <?= $transporte['tipo_transporte'] == 'Autobús' ? 'selected' : '' ?>>Autobús</option>
              <option value="Taxi/uber" <?= $transporte['tipo_transporte'] == 'Taxi/uber' ? 'selected' : '' ?>>Taxi/Uber</option>
              <option value="Coche" <?= $transporte['tipo_transporte'] == 'Coche' ? 'selected' : '' ?>>Coche</option>
              <option value="Metro" <?= $transporte['tipo_transporte'] == 'Metro' ? 'selected' : '' ?>>Metro</option>
              <option value="Tren" <?= $transporte['tipo_transporte'] == 'Tren' ? 'selected' : '' ?>>Tren</option>
              <option value="Avión" <?= $transporte['tipo_transporte'] == 'Avión' ? 'selected' : '' ?>>Avión</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputText" class="form-label">Día</label>
            <input type="date" class="form-control" id="dia" aria-describedby="textHelp" name="dia" value="<?php echo htmlspecialchars($transporte['dia']); ?>">
          </div>
          <div class="mb-3">
            <label for="exampleInputDate" class="form-label">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora" value="<?php echo htmlspecialchars($transporte['hora']); ?>">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estación / Parada</label>
            <input type="text" class="form-control" id="parada" name="parada" value="<?php echo htmlspecialchars($transporte['parada']); ?>">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Comapñía</label>
            <input type="text" class="form-control" id="compania" name="compania" value="<?php echo htmlspecialchars($transporte['compania']); ?>">
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
