<?php

require_once "php/validar_sesion.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
</head>

<body>

<h1>
Bienvenido
<?php echo $_SESSION['nombre']; ?>
</h1>

<p>
Rol:
<?php echo $_SESSION['rol']; ?>
</p>

<a href="../admin/usuarios/usuarios.php">
Administrar Usuarios
</a>

<br><br>

<a href="logout.php">
Cerrar Sesión
</a>

</body>
</html>