const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("preview");
const loading = document.getElementById("loading");
const resultBox = document.getElementById("result");

fileInput.addEventListener("change", async (e) => {

  const file = e.target.files[0];

  if (!file) return;

  // Mostrar vista previa
  preview.src = URL.createObjectURL(file);
  preview.style.display = "block";

  // Mostrar loading
  loading.style.display = "block";
  resultBox.style.display = "none";

  try {

    // OCR
    const {
      data: { text },
    } = await Tesseract.recognize(
      file,
      "spa",
      {
        logger: m => console.log(m)
      }
    );

    console.log(text);

    // Extraer datos
    const nombre =
      text.match(/Para\s+([A-Za-zÁÉÍÓÚáéíóúñÑ\s]+)/i)?.[1]?.trim();

    const monto =
      text.match(/\$\s?[\d\.,]+/)?.[0];

    const numero =
      text.match(/\b3\d{2}\s?\d{3}\s?\d{4}\b/)?.[0];

    const fecha =
      text.match(/\d{1,2}\sde\s\w+\sde\s\d{4}/i)?.[0];

    const referencia =
      text.match(/[A-Z0-9]{8,}/)?.[0];

    // Mostrar resultados
    document.getElementById("nombre").innerText =
      nombre || "No detectado";

    document.getElementById("monto").innerText =
      monto || "No detectado";

    document.getElementById("numero").innerText =
      numero || "No detectado";

    document.getElementById("fecha").innerText =
      fecha || "No detectado";

    document.getElementById("referencia").innerText =
      referencia || "No detectado";

    loading.style.display = "none";
    resultBox.style.display = "block";

  } catch (error) {

    console.error("Error OCR:", error);

    loading.innerText =
      "Error al escanear la imagen";

  }

});