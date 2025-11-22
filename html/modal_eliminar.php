<?php
if (!isset($modal_id) || !isset($titulo_modal) || !isset($mensaje_modal) || !isset($url_accion)) {
  return;
}

$texto_boton = isset($texto_boton) ? $texto_boton : "Eliminar";
?>

<div class="modal" id="<?php echo htmlspecialchars($modal_id); ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo htmlspecialchars($titulo_modal); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><?php echo htmlspecialchars($mensaje_modal); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="<?php echo htmlspecialchars($url_accion); ?>" class="btn btn-danger"><?php echo htmlspecialchars($texto_boton); ?></a>
      </div>
    </div>
  </div>
</div>

<?php
// Limpiar variables para no afectar otros includes
unset($modal_id, $titulo_modal, $mensaje_modal, $url_accion, $texto_boton);
?>
