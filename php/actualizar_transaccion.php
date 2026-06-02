<?php

require_once "validar_sesion.php";
require_once "conectar.php";

$referencia =
    $_POST['referencia'];

$origen =
    $_POST['origen'];

$observaciones =
    $_POST['observaciones'];

$id_banco =
    $_POST['id_banco'];

$sql = "
UPDATE transaccion
SET
    origen = ?,
    observaciones = ?,
    id_banco = ?
WHERE referencia = ?
";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "ssis",
    $origen,
    $observaciones,
    $id_banco,
    $referencia
);

mysqli_stmt_execute($stmt);

header(
    "Location: historial.php"
);

exit();