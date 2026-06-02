<?php

require_once "../scancash/php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../scancash/php/index.php");
    exit();
}

require_once "../scancash/php/conectar.php";

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$password = trim($_POST['password']);
$rol = $_POST['rol'];

$verificar = mysqli_prepare(
    $conexion,
    "SELECT id_usuario
     FROM usuario
     WHERE correo = ?"
);

mysqli_stmt_bind_param(
    $verificar,
    "s",
    $correo
);

mysqli_stmt_execute($verificar);

$resultado =
    mysqli_stmt_get_result(
        $verificar
    );

if(mysqli_num_rows($resultado) > 0){

    die("El correo ya existe.");

}

$sql = "INSERT INTO usuario
(
    nombre,
    correo,
    password,
    rol,
    estado
)
VALUES
(
    ?,
    ?,
    ?,
    ?,
    1
)";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $nombre,
    $correo,
    $password,
    $rol
);

mysqli_stmt_execute($stmt);

header(
    "Location: usuarios.php"
);

exit();