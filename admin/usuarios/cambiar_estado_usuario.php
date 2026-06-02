<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$id = $_GET['id'];

$sql = "SELECT estado
        FROM usuario
        WHERE id_usuario = ?";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$resultado =
    mysqli_stmt_get_result($stmt);

$usuario =
    mysqli_fetch_assoc($resultado);

$nuevoEstado =
    $usuario['estado']
    ? 0
    : 1;

$sql = "UPDATE usuario
        SET estado = ?
        WHERE id_usuario = ?";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $nuevoEstado,
    $id
);

mysqli_stmt_execute($stmt);

header(
    "Location: usuarios.php"
);

exit();