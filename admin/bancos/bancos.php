<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$sql = "SELECT *
        FROM banco
        ORDER BY nombre_banco";

$resultado = mysqli_query(
    $conexion,
    $sql
);

include "../../php/layouts/header.php";
include "../../php/layouts/sidebar.php";

?>

<main class="content">

    <div class="content-card">

        <div class="page-header">

            <h1>
                Gestión de Bancos
            </h1>

            <p>
                Administración de bancos disponibles para el sistema.
            </p>

        </div>

        <br>

        <a
            href="crear_banco.php"
            class="btn-primary"
        >
            + Crear Banco
        </a>

        <br><br>

        <table class="table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Banco</th>

                    <th>Número Destino</th>

                    <th>Descripción</th>

                    <th>Estado</th>

                    <th>Fecha Creación</th>

                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

            <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

                <tr>

                    <td>
                        <?= $fila['id_banco']; ?>
                    </td>

                    <td>
                        <?= $fila['nombre_banco']; ?>
                    </td>

                    <td>
                        <?= $fila['numero_destino']; ?>
                    </td>

                    <td>
                        <?= $fila['descripcion']; ?>
                    </td>

                    <td>

                        <?php if($fila['estado']){ ?>

                            <span class="badge badge-success">
                                Activo
                            </span>

                        <?php }else{ ?>

                            <span class="badge badge-danger">
                                Inactivo
                            </span>

                        <?php } ?>

                    </td>

                    <td>

                        <?= date(
                            "d/m/Y",
                            strtotime(
                                $fila['fecha_creacion']
                            )
                        ); ?>

                    </td>

                    <td class="actions">

                        <a
                            href="editar_banco.php?id=<?= $fila['id_banco']; ?>"
                            class="btn-edit"
                        >
                            Editar
                        </a>

                        <a
                            href="cambiar_estado_banco.php?id=<?= $fila['id_banco']; ?>"
                            class="btn-status"
                            onclick="return confirm('¿Desea cambiar el estado de este banco?')"
                        >
                            <?= $fila['estado']
                                ? 'Desactivar'
                                : 'Activar'; ?>
                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</main>

<?php

include "../../php/layouts/footer.php";

?>