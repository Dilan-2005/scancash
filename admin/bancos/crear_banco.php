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

    <h1>Crear Banco</h1>
    

    <div class="form-container">

        <form
            action="guardar_banco.php"
            method="POST"
        >

            <div class="form-group">

                <label>
                    Nombre del Banco
                </label>

                <input
                    type="text"
                    name="nombre_banco"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Número Destino
                </label>

                <input
                    type="text"
                    name="numero_destino"
                >

            </div>

            <div class="form-group">

                <label>
                    Descripción
                </label>

                <input
                    type="text"
                    name="descripcion"
                >

            </div>

            <div class="button-group">

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Guardar Banco
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