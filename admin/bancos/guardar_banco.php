<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$nombre_banco =
    trim($_POST['nombre_banco']);

$numero_destino =
    trim($_POST['numero_destino']);

$descripcion =
    trim($_POST['descripcion']);

$sql = "INSERT INTO banco
(
    nombre_banco,
    numero_destino,
    descripcion
)
VALUES
(
    ?,
    ?,
    ?
)";

$stmt =
    mysqli_prepare(
        $conexion,
        $sql
    );

mysqli_stmt_bind_param(
    $stmt,
    "sss",
    $nombre_banco,
    $numero_destino,
    $descripcion
);

mysqli_stmt_execute($stmt);

header(
    "Location: bancos.php"
);

exit();