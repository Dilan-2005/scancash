<?php

$host = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "scancashbd";

$conexion = mysqli_connect(
    $host,
    $usuario,
    $password,
    $baseDatos
);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>