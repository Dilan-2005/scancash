<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

require_once "../../php/conectar.php";

$id = $_GET['id'];

$sql = "SELECT * FROM usuario
        WHERE id_usuario = ?";

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

$usuario =
    mysqli_fetch_assoc($resultado);

include "../../php/layouts/header.php";
include "../../php/layouts/sidebar.php";

?>

<main class="content">

    <div class="content-card">

        <h1>Editar Usuario</h1>

        <div class="form-container">

            <form
                action="actualizar_usuario.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="id_usuario"
                    value="<?= $usuario['id_usuario']; ?>"
                >

                <div class="form-group">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        value="<?= $usuario['nombre']; ?>"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>Correo</label>

                    <input
                        type="email"
                        name="correo"
                        value="<?= $usuario['correo']; ?>"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>Rol</label>

                    <select name="rol">

                        <option
                        value="Administrador"
                        <?= $usuario['rol'] == 'Administrador' ? 'selected' : ''; ?>>
                        Administrador
                        </option>

                        <option
                        value="Lider"
                        <?= $usuario['rol'] == 'Lider' ? 'selected' : ''; ?>>
                        Lider
                        </option>

                        <option
                        value="Auxiliar"
                        <?= $usuario['rol'] == 'Auxiliar' ? 'selected' : ''; ?>>
                        Auxiliar
                        </option>

                    </select>

                </div>

                <div class="button-group">

                    <button
                        type="submit"
                        class="btn-primary"
                    >
                        Actualizar
                    </button>

                    <a
                        href="usuarios.php"
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