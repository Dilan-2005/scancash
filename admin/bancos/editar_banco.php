<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$id = $_GET['id'];

$sql = "SELECT *
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

include "../../php/layouts/header.php";
include "../../php/layouts/sidebar.php";

?>

<main class="content">

<div class="content-card">

<h1>Editar Banco</h1>

<div class="form-container">

<form
    action="actualizar_banco.php"
    method="POST"
>

<input
    type="hidden"
    name="id_banco"
    value="<?= $banco['id_banco']; ?>"
>

<div class="form-group">

<label>Nombre del Banco</label>

<input
    type="text"
    name="nombre_banco"
    value="<?= $banco['nombre_banco']; ?>"
    required
>

</div>

<div class="form-group">

<label>Número Destino</label>

<input
    type="text"
    name="numero_destino"
    value="<?= $banco['numero_destino']; ?>"
>

</div>

<div class="form-group">

<label>Descripción</label>

<input
    type="text"
    name="descripcion"
    value="<?= $banco['descripcion']; ?>"
>

</div>

<div class="button-group">

<button
    type="submit"
    class="btn-primary"
>
Actualizar
</button>

<a
    href="bancos.php"
    class="btn-secondary"
>
Volver
</a>

</div>

</form>

</div>

</div>

</main>

<?php

include "../../php/layouts/footer.php";

?>