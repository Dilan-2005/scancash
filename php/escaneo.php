<?php

require_once "validar_sesion.php";

include "layouts/header.php";
include "layouts/sidebar.php";

?>

<main class="content">

    <div class="content-card">

        <div class="page-header">

            <h1>
                Escáner de Transacciones
            </h1>

            <p>
                Sube una captura de pantalla de una transacción.
            </p>

        </div>

        <div class="scanner-select">

            <h3>
                Selecciona el tipo de transacción
            </h3>

            <select id="scannerType">
            </select>

        </div>

        <div class="upload-box">

            <input
                type="file"
                id="fileInput"
                accept="image/*"
            >

            <label
                for="fileInput"
                class="upload-btn"
            >
                Subir captura
            </label>

        </div>

        <img id="preview">

        <div
            class="loading"
            id="loading"
        >
            Escaneando información...
        </div>

        <div
            class="result"
            id="result"
        >

            <h2>
                Información Detectada
            </h2>

            <p>
                <strong>Nombre:</strong>
                <span id="nombre"></span>
            </p>

            <p>
                <strong>Monto:</strong>
                <span id="monto"></span>
            </p>

            <p>
                <strong>Número:</strong>
                <span id="numero"></span>
            </p>

            <p>
                <strong>Fecha:</strong>
                <span id="fecha"></span>
            </p>

            <p>
                <strong>Referencia:</strong>
                <span id="referencia"></span>
            </p>

        </div>

    </div>

</main>

<script src="/scancash/js/script.js"></script>

<?php

include "layouts/footer.php";

?>