<?php

require_once "../../php/validar_sesion.php";

if($_SESSION['rol'] != 'Administrador'){
    header("Location: ../../php/index.php");
    exit();
}

include "../../php/layouts/header.php";
include "../../php/layouts/sidebar.php";

?>

<main class="content">

    <div class="content-card">

        <h1>Crear Usuario</h1>

        <div class="form-container">

<form action="guardar_usuario.php"
      method="POST">

    <div class="form-group">

        <label>
            Nombre
        </label>

        <input
            type="text"
            name="nombre"
            required
        >

    </div>

    <div class="form-group">

        <label>
            Correo
        </label>

        <input
            type="email"
            name="correo"
            required
        >

    </div>

    <div class="form-group">

        <label>
            Contraseña
        </label>

        <input
            type="password"
            name="password"
            required
        >

    </div>

    <div class="form-group">

        <label>
            Rol
        </label>

        <select name="rol">

            <option value="Administrador">
                Administrador
            </option>

            <option value="Lider">
                Líder
            </option>

            <option value="Auxiliar">
                Auxiliar
            </option>

        </select>

    </div>

    <div class="button-group">

        <button
            type="submit"
            class="btn-primary"
        >
            Guardar Usuario
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