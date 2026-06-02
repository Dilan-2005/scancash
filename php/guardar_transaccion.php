<?php

require_once "conectar.php";

$nombre =
    $_POST["nombre"] ?? "";

$monto =
    $_POST["monto"] ?? 0;

$numero =
    $_POST["numero"] ?? "";

$referencia =
    $_POST["referencia"] ?? "";

$id_banco =
    $_POST["id_banco"] ?? 0;

/*
----------------------------------
VALIDAR REFERENCIA DUPLICADA
----------------------------------
*/

$sql = "SELECT referencia
        FROM transaccion
        WHERE referencia = ?";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $referencia
);

mysqli_stmt_execute($stmt);

$resultado =
    mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($resultado) > 0){

    die("TRANSACCION_EXISTENTE");

}

/*
----------------------------------
INSERTAR TRANSACCION
----------------------------------
*/

$sql = "INSERT INTO transaccion
(
    referencia,
    fecha,
    monto,
    origen,
    observaciones,
    id_banco
)
VALUES
(
    ?,
    NOW(),
    ?,
    ?,
    ?,
    ?
)";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "sdssi",
    $referencia,
    $monto,
    $numero,
    $nombre,
    $id_banco
);

if(mysqli_stmt_execute($stmt)){

    echo "OK";

}else{

    echo mysqli_error($conexion);

}