<?php
// Datos de conexión a la base de datos
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'viajamos_db';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
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
