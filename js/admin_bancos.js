cargarBancos();

async function crearBanco(){

    const nombre =
        document.getElementById(
            "nombreBanco"
        ).value;

    const numero =
        document.getElementById(
            "numeroDestino"
        ).value;

    const descripcion =
        document.getElementById(
            "descripcionBanco"
        ).value;

    const respuesta =
        await fetch(
            "php/crear_banco.php",
            {
                method:"POST",

                headers:{
                    "Content-Type":
                    "application/x-www-form-urlencoded"
                },

                body:
                    "nombre=" +
                    encodeURIComponent(nombre)
                    +
                    "&numero=" +
                    encodeURIComponent(numero)
                    +
                    "&descripcion=" +
                    encodeURIComponent(descripcion)
            }
        );

    const resultado =
        await respuesta.text();

    alert(resultado);

    cargarBancos();

}