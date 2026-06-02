<?php

session_start();

require_once "conectar.php";

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario
        WHERE correo = ?
        AND estado = 1";

$stmt = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $correo
);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($resultado) == 1){

    $usuario = mysqli_fetch_assoc($resultado);

    if($password == $usuario['password']){

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        header("Location: index.php");
        exit();
    }
}

echo "Correo o contraseña incorrectos";
?>