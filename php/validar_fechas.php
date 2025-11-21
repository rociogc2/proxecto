<?php
include 'session.php';

function validarFechasDentroDeViaje($conn, $viaje_id, $inicio, $fin)
{
  // Obtener fechas del viaje
  $sql = "SELECT inicio, fin FROM viajes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $viaje_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $viaje = $result->fetch_assoc();

  if (!$viaje) {
    return "El viaje no existe.";
  }

  $inicioViaje = new DateTime($viaje['inicio']);
  $finViaje = new DateTime($viaje['fin']);
  $fechaInicio = new DateTime($inicio);
  $fechaFin = new DateTime($fin);

  // Validaciones
  if ($fechaInicio > $fechaFin) {
    return "La fecha de inicio no puede ser mayor que la fecha de fin.";
  }
  if ($fechaInicio < $inicioViaje) {
    return "La fecha de inicio está fuera del rango del viaje.";
  }
  if ($fechaFin > $finViaje) {
    return "La fecha de fin está fuera del rango del viaje.";
  }

  return true; // todo correcto
}
