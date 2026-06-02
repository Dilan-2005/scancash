<?php
session_start();

if(isset($_SESSION['id_usuario'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Login ScanCash</title>

<link rel="stylesheet" href="../css/login.css">

</head>

<body>

<div class="login">

<h2>Iniciar Sesión</h2>

<form action="verificar_login.php" method="POST">

<input
type="email"
name="correo"
placeholder="Correo"
required
>

<input
type="password"
name="password"
placeholder="Contraseña"
required
>

<button type="submit">
Ingresar
</button>

</form>

</div>

</body>
</html>