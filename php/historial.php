<?php

require_once "validar_sesion.php";
require_once "conectar.php";

$sql = "
SELECT
    t.referencia,
    t.fecha,
    t.monto,
    b.nombre_banco
FROM transaccion t
INNER JOIN banco b
    ON t.id_banco = b.id_banco
ORDER BY t.fecha DESC
";

$resultado = mysqli_query(
    $conexion,
    $sql
);

include "layouts/header.php";
include "layouts/sidebar.php";

?>

<main class="content">

    <div class="content-card">

        <h1>
            Historial de Transacciones
        </h1>

        <br>

        <table class="table">

            <thead>

                <tr>

                    <th>Referencia</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Banco</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

            <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

                <tr>

                    <td>
                        <?= $fila['referencia']; ?>
                    </td>

                    <td>
                        <?= $fila['fecha']; ?>
                    </td>

                    <td>
                        $<?= number_format(
                                $fila['monto'],
                                0,
                                ",",
                                "."
                            ); ?>
                    </td>

                    <td>
                        <?= $fila['nombre_banco']; ?>
                    </td>
                    <td>

                    <a
                        href="ver_transaccion.php?referencia=<?= $fila['referencia']; ?>"
                        class="btn-edit"
                    >
                     Ver
                    </a>

                    <a
                         href="editar_transaccion.php?referencia=<?= $fila['referencia']; ?>"
                        class="btn-status"
                    >
                    Editar
                    </a>

                </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</main>

<?php

include "layouts/footer.php";

?>