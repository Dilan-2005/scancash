<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$id_usuario = $_POST['id_usuario'];

$nombre = $_POST['nombre'];

$correo = $_POST['correo'];

$rol = $_POST['rol'];

$sql = "UPDATE usuario
SET
    nombre = ?,
    correo = ?,
    rol = ?
WHERE id_usuario = ?";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "sssi",
    $nombre,
    $correo,
    $rol,
    $id_usuario
);

mysqli_stmt_execute($stmt);

header(
    "Location: usuarios.php"
);

exit();