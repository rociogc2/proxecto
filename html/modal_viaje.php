<div class="modal" id="formularioViajes" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo viaje</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../php/crear_viaje.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="exampleInputText" class="form-label">Destino</label>
              <input type="text" class="form-control" id="destino" name="destino" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputDate" class="form-label">Inicio</label>
              <input type="date" class="form-control" id="inicio" name="inicio" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputDate" class="form-label">Fin</label>
              <input type="date" class="form-control" id="fin" name="fin" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Descripción (opcional)</label>
              <textarea class="form-control" id="descripcion" rows="3" name="descripcion"></textarea>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Foto</label>
              <input class="form-control" type="file" id="formFile" name="foto" required>
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
