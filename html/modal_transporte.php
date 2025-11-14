<div class="modal" id="formularioTransportes" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo transporte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/crear_transporte.php" method="POST">
          <input type="hidden" name="viaje_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
          <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name="tipo_transporte">
              <option value="" selected disabled>Seleccione un transporte</option>
              <option value="Autobús">Autobús</option>
              <option value="Taxi/uber">Taxi/Uber</option>
              <option value="Coche">Coche</option>
              <option value="Metro">Metro</option>
              <option value="Tren">Tren</option>
              <option value="Avión">Avión</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputText" class="form-label">Día</label>
            <input type="date" class="form-control" id="dia" aria-describedby="textHelp" name="dia">
          </div>
          <div class="mb-3">
            <label for="exampleInputDate" class="form-label">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estación / Parada</label>
            <input type="text" class="form-control" id="parada" name="parada">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Comapñía</label>
            <input type="text" class="form-control" id="compania" name="compania">
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
