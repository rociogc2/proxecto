<div class="modal" id="formularioNotas" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva nota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/crear_nota.php" method="post">
          <input type="hidden" name="viaje_id" value="<?php echo htmlspecialchars($viaje['id'] ?? ''); ?>">
          <div class="mb-3">
            <label for="tituloNota" class="form-label">Título</label>
            <input type="text" class="form-control" id="tituloNota" name="titulo" required>
          </div>
          <div class="mb-3">
            <label for="descripcionNota" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcionNota" rows="3" name="descripcion" required></textarea>
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
