<?php

require_once "validar_sesion.php";
require_once "conectar.php";

$referencia = $_GET['referencia'];

$sql = "
SELECT *
FROM transaccion
WHERE referencia = ?
";

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

$transaccion =
    mysqli_fetch_assoc($resultado);

$bancos =
    mysqli_query(
        $conexion,
        "SELECT * FROM banco
         WHERE estado = 1"
    );

include "layouts/header.php";
include "layouts/sidebar.php";

?>

<main class="content">

<div class="content-card">

<h1>Editar Transacción</h1>

<form
    action="actualizar_transaccion.php"
    method="POST"
>

<input
    type="hidden"
    name="referencia"
    value="<?= $transaccion['referencia']; ?>"
>

<div class="form-group">

<label>Banco</label>

<select name="id_banco">

<?php while($banco = mysqli_fetch_assoc($bancos)){ ?>

<option
value="<?= $banco['id_banco']; ?>"
<?= $banco['id_banco'] == $transaccion['id_banco']
    ? 'selected'
    : ''; ?>
>

<?= $banco['nombre_banco']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Número</label>

<input
    type="text"
    name="origen"
    value="<?= $transaccion['origen']; ?>"
>

</div>

<div class="form-group">

<label>Observaciones</label>

<textarea
    name="observaciones"
    rows="4"
><?= $transaccion['observaciones']; ?></textarea>

</div>

<br>

<button
    type="submit"
    class="btn-primary"
>
    Guardar Cambios
</button>

<a
    href="historial.php"
    class="btn-secondary"
>
    Cancelar
</a>

</form>

</div>

</main>

<?php

include "layouts/footer.php";

?>