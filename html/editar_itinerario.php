<?php
include '../php/session.php';

// Determinar el ID del viaje actual sin errores
if (isset($datosViaje)) {
  $id = $datosViaje['id'];
} elseif (isset($viaje)) {
  $id = $viaje['id'];
} elseif (isset($itinerario)) {
  $id = $itinerario['id'];
} else {
  $id = 0; // Valor por defecto para evitar warnings
}

// Consultar datos del itinerario del viaje actual
$sql = "SELECT dia, hora, actividad
  FROM itinerarios
  WHERE id = ? AND viaje_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $viaje_id);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();
?>

<div class="modal fade" id="editarItinerario<?php echo $itinerario['id']; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar itinerario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/actualizar_itinerario.php" method="post">
          <input type="hidden" name="viaje_id" value="<?php echo htmlspecialchars($itinerario['viaje_id']); ?>">
          <input type="hidden" name="id" value="<?php echo $itinerario['id']; ?>">
          <div class="mb-3">
            <label class="form-label">Día</label>
            <input type="date" class="form-control" name="dia" value="<?php echo htmlspecialchars($itinerario['dia']); ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Hora</label>
            <input type="time" class="form-control" name="hora" value="<?php echo htmlspecialchars($itinerario['hora']); ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Actividad</label>
            <input type="text" class="form-control" name="actividad" value="<?php echo htmlspecialchars($itinerario['actividad']); ?>">
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
