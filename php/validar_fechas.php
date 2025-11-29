<?php
// Archivo: validar_fechas.php
// Propósito: Validar que las fechas de eventos estén dentro del rango del viaje

include 'session.php';

/**
 * Validar que las fechas de inicio y fin estén dentro del rango del viaje
 * @param mysqli $conn Conexión a la base de datos
 * @param int $viaje_id ID del viaje
 * @param string $inicio Fecha de inicio del evento
 * @param string $fin Fecha de fin del evento
 * @return bool|string true si es válido, o mensaje de error
 */
function validarFechasDentroDeViaje($conn, $viaje_id, $inicio, $fin)
{
  // Obtener fechas del viaje
  $sql = "SELECT inicio, fin FROM viajes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $viaje_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $viaje = $result->fetch_assoc();

  // Validar que el viaje exista
  if (!$viaje) {
    return "El viaje no existe.";
  }

  // Convertir fechas a objetos DateTime para comparación
  $inicioViaje = new DateTime($viaje['inicio']);
  $finViaje = new DateTime($viaje['fin']);
  $fechaInicio = new DateTime($inicio);
  $fechaFin = new DateTime($fin);

  // Realizar validaciones de rango de fechas
  if ($fechaInicio > $fechaFin) {
    return "La fecha de inicio no puede ser mayor que la fecha de fin.";
  }
  if ($fechaInicio < $inicioViaje) {
    return "La fecha de inicio está fuera del rango del viaje.";
  }
  if ($fechaFin > $finViaje) {
    return "La fecha de fin está fuera del rango del viaje.";
  }

  return true; // Todas las validaciones pasaron
}
?>
