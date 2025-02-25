document.addEventListener("DOMContentLoaded", function () {
    fetch("../controllers/get_bodegas.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("bodega").innerHTML = "<option value=''></option>" + data;
        });

    document.getElementById("bodega").addEventListener("change", function () {
        let bodegaId = this.value;
        if (bodegaId) {
            fetch(`../controllers/get_sucursales.php?bodega_id=${bodegaId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("sucursal").innerHTML = "<option value=''></option>" + data;
                });
        } else {
            document.getElementById("sucursal").innerHTML = "<option value=''></option>";
        }
    });

    fetch("../controllers/get_monedas.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("moneda").innerHTML = "<option value=''></option>" + data;
        });

    document.getElementById("productoForm").addEventListener("submit", function (e) {
        e.preventDefault();

        if (!validarFormulario()) {
            return;
        }

        let formData = new FormData(this);
        fetch("../controllers/guardar_producto.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("Respuesta del servidor:", data);
            try {
                let jsonData = JSON.parse(data);
                if (jsonData.success) {
                    alert("✅ " + jsonData.message);
                    document.getElementById("productoForm").reset();
                    resetearSelect("bodega", "../controllers/get_bodegas.php");
                    resetearSelect("sucursal");
                    resetearSelect("moneda", "../controllers/get_monedas.php");
                } else {
                    alert(jsonData.message);
                }
            } catch (error) {
                console.error("Error al procesar JSON:", error);
                alert("Error inesperado en la respuesta del servidor.");
            }
        })
        .catch(error => {
            console.error("Error en la petición:", error);
            alert("Error al guardar el producto. Intente nuevamente.");
        });
    });

    function resetearSelect(id, url = null) {
        let select = document.getElementById(id);
        select.innerHTML = "<option value=''></option>";

        if (url) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    select.innerHTML += data;
                });
        }
    }
});
