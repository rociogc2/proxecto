<div class="modal fade" id="formularioAlojamientos" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo alojamiento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/crear_alojamiento.php" method="POST">
          <input type="hidden" name="viaje_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
          <div class="mb-3">
            <label for="exampleInputText" class="form-label">Día inicio</label>
            <input type="date" class="form-control" id="inicio" name="inicio" aria-describedby="textHelp" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputText" class="form-label">Día fin</label>
            <input type="date" class="form-control" id="fin" name="fin" aria-describedby="textHelp" required>
          </div>
          <div class="mb-3">
            <select class="form-select" name="tipo" aria-label="Default select example" required>
              <option value="" selected disabled>Seleccione alojamiento</option>
              <option value="Hotel">Hotel</option>
              <option value="Albergue">Albergue</option>
              <option value="Apartamento">Apartamento</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
          </div>
          <div class="mb-3 check">
            <div class="check-item">
              <label for="checkin" class="form-label">Check in</label>
              <input type="time" class="form-control" id="checkin" name="checkin">
            </div>
            <div class="check-item">
              <label for="checkout" class="form-label">Check out</label>
              <input type="time" class="form-control" id="checkout" name="checkout">
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
