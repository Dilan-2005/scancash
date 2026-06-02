<?php

require_once "validar_sesion.php";
require_once "conectar.php";

$referencia = $_GET['referencia'];

$sql = "
SELECT
    t.*,
    b.nombre_banco
FROM transaccion t
INNER JOIN banco b
    ON t.id_banco = b.id_banco
WHERE t.referencia = ?
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

include "layouts/header.php";
include "layouts/sidebar.php";

?>

<main class="content">

<div class="content-card">

<h1>Detalle de Transacción</h1>

<br>

<p>
<strong>Referencia:</strong>
<?= $transaccion['referencia']; ?>
</p>

<p>
<strong>Fecha:</strong>
<?= $transaccion['fecha']; ?>
</p>

<p>
<strong>Monto:</strong>
$<?= number_format(
    $transaccion['monto'],
    0,
    ",",
    "."
); ?>
</p>

<p>
<strong>Banco:</strong>
<?= $transaccion['nombre_banco']; ?>
</p>

<p>
<strong>Número:</strong>
<?= $transaccion['origen']; ?>
</p>

<p>
<strong>Observaciones:</strong>
<?= $transaccion['observaciones']; ?>
</p>

<br>

<a
    href="historial.php"
    class="btn-secondary"
>
    Volver
</a>

</div>

</main>

<?php

include "layouts/footer.php";

?>