<div class="modal fade" id="formularioItinerarios" tabindex="-1" aria-labelledby="tituloItinerario" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloItinerario">Nuevo itinerario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form action="/proxecto/php/crear_itinerario.php" method="POST">
          <input type="hidden" name="viaje_id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
          <div class="mb-3">
            <label for="diaItinerario" class="form-label">Día</label>
            <input type="date" class="form-control" id="diaItinerario" name="dia" required>
          </div>
          <!-- Contenedor de actividades -->
          <div id="actividadesContainer">
            <label class="form-label">Actividades</label>
            <div class="actividad mb-2 d-flex gap-2">
              <input type="time" class="form-control" name="hora[]" required>
              <input type="text" class="form-control" placeholder="Actividad" name="actividad[]" required>
              <button type="button" class="btn btn-success btn-add-actividad">+</button>
            </div>
          </div>
          <div class="row mt-4">
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

<!-- Script para añadir/eliminar actividades -->
<script>
  document.addEventListener('click', function (e) {
    // Añadir una nueva actividad
    if (e.target && e.target.classList.contains('btn-add-actividad')) {
      const container = document.getElementById('actividadesContainer');
      const nuevaActividad = document.createElement('div');
      nuevaActividad.classList.add('actividad', 'mb-2', 'd-flex', 'gap-2');
      nuevaActividad.innerHTML = `
        <input type="time" class="form-control" name="hora[]">
        <input type="text" class="form-control" placeholder="Actividad" name="actividad[]">
        <button type="button" class="btn btn-danger btn-remove-actividad">-</button>
      `;
      container.appendChild(nuevaActividad);
    }
    // Eliminar una actividad
    if (e.target && e.target.classList.contains('btn-remove-actividad')) {
      const parent = e.target.closest('.actividad');
      if (parent) parent.remove();
    }
  });
</script>
