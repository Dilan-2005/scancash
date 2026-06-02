<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$id =
    $_GET['id'];

$sql = "SELECT estado
        FROM banco
        WHERE id_banco = ?";

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

$banco =
    mysqli_fetch_assoc($resultado);

$nuevoEstado =
    $banco['estado']
    ? 0
    : 1;

$sql = "UPDATE banco
SET estado = ?
WHERE id_banco = ?";

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
    "Location: bancos.php"
);

exit();