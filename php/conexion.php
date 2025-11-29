<?php
// Archivo: conexion.php
// Propósito: Establecer conexión a la base de datos MySQL
// BD: viajamos_db

// Credenciales de conexión
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'viajamos_db';

// Crear conexión a base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar que la conexión sea exitosa
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Crear la base de datos si no existe
$sqlCrearBaseDatos = "CREATE DATABASE IF NOT EXISTS $dbname";

// Seleccionar la base de datos
$conn->select_db($dbname);

// Crear la tabla de usuarios si no existe
$sqlCrearTabla = "CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellidos VARCHAR(150) NOT NULL,
  usuario VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
)";
?>
