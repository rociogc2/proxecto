<?php
include '../php/session.php';

// Si viene desde detalle_viaje.php se usa $datosViaje, si no, usa $viaje del foreach
$id = isset($datosViaje) ? $datosViaje['id'] : $viaje['id'];

// Consultar datos del viaje del usuario actual
$sql = "SELECT destino, inicio, fin, descripcion, foto
  FROM viajes
  WHERE id = ? AND usuario_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();
?>


<div class="modal fade" id="editarViaje<?php echo $viaje['id']; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar viaje</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/actualizar_viaje.php" method="post" enctype="multipart/form-data">
          <!-- Campo oculto para el ID del viaje -->
          <input type="hidden" name="id" value="<?php echo $viaje['id']; ?>">
          <!-- Campo oculto para conservar la foto actual -->
          <input type="hidden" name="foto_actual" value="<?php echo htmlspecialchars($datos['foto']); ?>">
          <div class="mb-3">
            <label class="form-label">Destino</label>
            <input type="text" class="form-control" name="destino" value="<?php echo htmlspecialchars($datos['destino']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Inicio</label>
            <input type="date" class="form-control" name="inicio" value="<?php echo htmlspecialchars($datos['inicio']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Fin</label>
            <input type="date" class="form-control" name="fin" value="<?php echo htmlspecialchars($datos['fin']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Descripción (opcional)</label>
            <textarea class="form-control" rows="3" name="descripcion"><?php echo htmlspecialchars($datos['descripcion']); ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Foto</label>
            <input class="form-control" type="file" name="foto">
            <?php if (!empty($datos['foto'])): ?>
              <small class="text-muted">Foto actual:</small><br>
              <img src="<?php echo htmlspecialchars($datos['foto']); ?>" alt="foto actual" style="max-width: 100%; border-radius: 8px; margin-top: 5px;">
            <?php endif; ?>
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
