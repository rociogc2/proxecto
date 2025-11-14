<?php
include '../php/session.php';

// Determinar el ID del viaje actual sin errores
if (isset($datosViaje)) {
  $id = $datosViaje['id'];
} elseif (isset($viaje)) {
  $id = $viaje['id'];
} elseif (isset($nota)) {
  $id = $nota['id'];
} else {
  $id = 0; // Valor por defecto para evitar warnings
}

// Consultar datos del nota del viaje actual
$sql = "SELECT titulo, descripcion
  FROM notas
  WHERE id = ? AND viaje_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $viaje_id);
$stmt->execute();
$resultado = $stmt->get_result();
$datos = $resultado->fetch_assoc();
?>

<div class="modal fade" id="editarNota<?php echo $nota['id']; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar nota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/actualizar_nota.php" method="post">
          <input type="hidden" name="viaje_id" value="<?php echo htmlspecialchars($nota['viaje_id']); ?>">
          <input type="hidden" name="id" value="<?php echo $nota['id']; ?>">
          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="input" class="form-control" name="titulo" value="<?php echo htmlspecialchars($nota['titulo']); ?>">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Descripción</label>
            <textarea class="form-control" rows="3" name="descripcion"><?php echo htmlspecialchars($nota['descripcion']); ?></textarea>
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
