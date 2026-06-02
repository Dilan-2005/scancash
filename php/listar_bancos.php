<?php

include("conectar.php");

$sql = "
SELECT
    id_banco,
    nombre_banco
FROM banco
WHERE estado = 1
ORDER BY nombre_banco
";

$resultado = mysqli_query($conexion, $sql);

$bancos = [];

while($fila = mysqli_fetch_assoc($resultado)){

    $bancos[] = $fila;

}

header('Content-Type: application/json');

echo json_encode($bancos);