<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$id_banco =
    $_POST['id_banco'];

$nombre_banco =
    trim($_POST['nombre_banco']);

$numero_destino =
    trim($_POST['numero_destino']);

$descripcion =
    trim($_POST['descripcion']);

$sql = "UPDATE banco
SET
    nombre_banco = ?,
    numero_destino = ?,
    descripcion = ?
WHERE id_banco = ?";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "sssi",
    $nombre_banco,
    $numero_destino,
    $descripcion,
    $id_banco
);

mysqli_stmt_execute($stmt);

header(
    "Location: bancos.php"
);

exit();