const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("preview");
const loading = document.getElementById("loading");
const resultBox = document.getElementById("result");
const scannerType = document.getElementById("scannerType");

// =========================
// CARGAR BANCOS
// =========================

cargarBancos();

async function cargarBancos() {

    try {

        const respuesta =
            await fetch("../php/listar_bancos.php");

        const bancos =
            await respuesta.json();

        scannerType.innerHTML = "";

        bancos.forEach(banco => {

            const option =
                document.createElement("option");

            option.value =
                banco.id_banco;

            option.textContent =
                banco.nombre_banco;

            scannerType.appendChild(option);

        });

    }
    catch (error) {

        console.error(
            "Error cargando bancos:",
            error
        );

    }

}

// =========================
// OCR NEQUI
// =========================

function extraerNequi(text) {

    return {

        nombre:
            text.match(
                /Para\s+([A-Za-zÁÉÍÓÚáéíóúñÑ\s]+)/i
            )?.[1]?.trim(),

        monto:
            text.match(
                /\$\s?[\d\.,]+/
            )?.[0],

        numero:
            text.match(
                /\b3\d{2}\s?\d{3}\s?\d{4}\b/
            )?.[0],

        fecha:
            text.match(
                /\d{1,2}\sde\s\w+\sde\s\d{4}/i
            )?.[0],

        referencia:
            text.match(
                /[A-Z0-9]{8,}/
            )?.[0]

    };

}

// =========================
// OCR DAVIPLATA
// =========================

function extraerDaviplata(text) {

    const cleanText = text
        .replace(/\n/g, " ")
        .replace(/\s+/g, " ");

    return {

        nombre:
            cleanText.match(
                /de:\s*([A-ZÁÉÍÓÚÑ\s]+)/i
            )?.[1]?.trim(),

        monto:
            cleanText.match(
                /\$\s?[\d\.]+/
            )?.[0],

        numero:
            cleanText.match(
                /\b3\d{9}\b/
            )?.[0],

        fecha:
            cleanText.match(
                /\d{2}\/\d{2}\/\d{2}\s*-\s*\d{1,2}:\d{2}\s*[ap]\s*m/i
            )?.[0],

        referencia:
            cleanText.match(
                /Número de autorización\s*(\d+)/i
            )?.[1]

    };

}

function extraerGenerico(text) {

    return {

        nombre:
            text.match(
                /([A-ZÁÉÍÓÚÑ][A-Za-zÁÉÍÓÚáéíóúñÑ\s]{5,40})/
            )?.[0],

        monto:
            text.match(
                /\$\s?[\d\.,]+/
            )?.[0],

        numero:
            text.match(
                /\b\d{7,15}\b/
            )?.[0],

        fecha:
            text.match(
                /\d{1,2}[\/\-]\d{1,2}[\/\-]\d{2,4}/
            )?.[0],

        referencia:
            text.match(
                /[A-Z0-9]{6,20}/
            )?.[0]

    };

}

// =========================
// NORMALIZAR MONTO
// =========================

function normalizarMonto(monto) {

    if (!monto) return 0;

    return parseFloat(
        monto
            .replace("$", "")
            .replace(/\s/g, "")
            .replace(/\./g, "")
            .replace(",", ".")
    );

}

// =========================
// ESCANEAR IMAGEN
// =========================

fileInput.addEventListener("change", async (e) => {

    const file = e.target.files[0];

    if (!file) return;

    preview.src =
        URL.createObjectURL(file);

    preview.style.display =
        "block";

    loading.style.display =
        "block";

    loading.innerText =
        "Escaneando información...";

    resultBox.style.display =
        "none";

    try {

        const {
            data: { text },
        } = await Tesseract.recognize(
            file,
            "spa",
            {
                logger: m => console.log(m)
            }
        );

        console.log("=== TEXTO OCR ===");
        console.log(text);

        let datos;

        const bancoSeleccionado =
            parseInt(scannerType.value);

        const nombreBanco =
            scannerType.options[
                scannerType.selectedIndex
            ].text;

        if (nombreBanco === "Nequi") {

            datos = extraerNequi(text);

        }
        else if (nombreBanco === "Daviplata") {

            datos = extraerDaviplata(text);

        }
        else {

            datos = extraerGenerico(text);

        }

        console.log("=== DATOS DETECTADOS ===");
        alert("ESCANEO EXITOSO");
        console.log(datos);

        document.getElementById("nombre").innerText =
            datos.nombre || "No detectado";

        document.getElementById("monto").innerText =
            datos.monto || "No detectado";

        document.getElementById("numero").innerText =
            datos.numero || "No detectado";

        document.getElementById("fecha").innerText =
            datos.fecha || "No detectado";

        document.getElementById("referencia").innerText =
            datos.referencia || "No detectado";

        const montoNormalizado =
            normalizarMonto(
                datos.monto
            );

        console.log(
            "Guardando transacción..."
        );
        console.log({
            nombre: datos.nombre,
            monto: montoNormalizado,
            numero: datos.numero,
            fecha: datos.fecha,
            referencia: datos.referencia,
            id_banco: bancoSeleccionado
        });
        const respuesta =
            await fetch(
                "../php/guardar_transaccion.php",
                {
                    method: "POST",

                    headers: {
                        "Content-Type":
                            "application/x-www-form-urlencoded"
                    },

                    body:
                        "nombre=" + encodeURIComponent(datos.nombre || "") +
                        "&monto=" + encodeURIComponent(montoNormalizado) +
                        "&numero=" + encodeURIComponent(datos.numero || "") +
                        "&fecha=" + encodeURIComponent(datos.fecha || "") +
                        "&referencia=" + encodeURIComponent(datos.referencia || "") +
                        "&id_banco=" + encodeURIComponent(bancoSeleccionado)
                }
            );

        const resultado =
    await respuesta.text();

console.log(
    "RESPUESTA PHP:",
    resultado
);

if(resultado === "OK"){

    alert("Transacción guardada correctamente");

}
else if(resultado === "TRANSACCION_EXISTENTE"){

    alert("La transacción ya existe");

}
else{

    alert("Error: " + resultado);

}
        loading.style.display =
            "none";

        resultBox.style.display =
            "block";

    }
    catch (error) {

        console.error(
            "Error OCR:",
            error
        );

        loading.style.display =
            "block";

        loading.innerText =
            "Error al escanear la imagen";

    }

});