
<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$sql = "SELECT * FROM usuario";

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
                Gestión de Usuarios
            </h1>

            <p>
                Administración de usuarios del sistema.
            </p>

        </div>

        <a
            href="crear_usuario.php"
            class="btn-primary"
        >
            + Crear Usuario
        </a>

        <table class="table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Fecha de Creación</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

                <?php
                while(
                    $fila =
                    mysqli_fetch_assoc(
                        $resultado
                    )
                ){
                ?>

                <tr>

                    <td>
                        <?= $fila['id_usuario']; ?>
                    </td>

                    <td>
                        <?= $fila['nombre']; ?>
                    </td>

                    <td>
                        <?= $fila['correo']; ?>
                    </td>

                    <td>
                        <?= $fila['rol']; ?>
                    </td>
                    <td>
                    <?= date(
                        "d/m/Y",
                        strtotime($fila['fecha_creacion'])
                    ); ?>
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

                    <td class="actions">

                        <a
                            href="editar_usuario.php?id=<?= $fila['id_usuario']; ?>"
                            class="btn-edit"
                        >
                        Editar
                        </a>

                        <?php

                            if(
                                $fila['id_usuario'] != $_SESSION['id_usuario']
                            ){

                        ?>

                        <a
                            href="cambiar_estado_usuario.php?id=<?= $fila['id_usuario']; ?>"
                            class="btn-status"
                            onclick="return confirm('¿Desea cambiar el estado de este usuario?')"
                        >
                        <?= $fila['estado']
                            ? 'Desactivar'
                            : 'Activar'; ?>
                        </a>

                        <?php } ?>

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