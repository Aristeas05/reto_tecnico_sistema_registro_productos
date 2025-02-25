function validarNumero(input) {
    input.value = input.value.replace(/[^0-9.]/g, "");

    if ((input.value.match(/\./g) || []).length > 1) {
        input.value = input.value.slice(0, -1);
    }

    if (input.value.includes(".")) {
        let partes = input.value.split(".");
        if (partes[1].length > 2) {
            input.value = partes[0] + "." + partes[1].slice(0, 2);
        }
    }
}

// Evitar espacios en el input de código en tiempo real
document.getElementById("codigo").addEventListener("input", function () {
    this.value = this.value.replace(/\s/g, "");
});

function validarFormulario() {
    let codigo = document.getElementById("codigo").value.trim();
    let nombre = document.getElementById("nombre").value.trim();
    let precio = document.getElementById("precio").value.trim();
    let bodega = document.getElementById("bodega").value;
    let sucursal = document.getElementById("sucursal").value;
    let moneda = document.getElementById("moneda").value;
    let materiales = Array.from(document.querySelectorAll("input[type='checkbox']:checked"));
    let descripcion = document.getElementById("descripcion").value.trim();

    let errores = [];

    // 1️⃣ Validación del Código del Producto
    if (codigo === "") {
        errores.push("El código del producto no puede estar en blanco.");
    } else if (!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z0-9]{5,15}$/.test(codigo)) {
        errores.push("El código del producto debe contener letras y números.");
    } else if (codigo.length < 5 || codigo.length > 15) {
        errores.push("El código del producto debe tener entre 5 y 15 caracteres.");
    }

    // 2️⃣ Validación del Nombre del Producto
    if (nombre === "") {
        errores.push("El nombre del producto no puede estar en blanco.");
    } else if (nombre.length < 2 || nombre.length > 50) {
        errores.push("El nombre del producto debe tener entre 2 y 50 caracteres.");
    }

    // 3️⃣ Validación del Precio
    if (precio === "") {
        errores.push("El precio del producto no puede estar en blanco.");
    } else if (!/^\d+(\.\d{1,2})?$/.test(precio)) {
        errores.push("El precio del producto debe ser un número positivo con hasta dos decimales.");
    }

    // 4️⃣ Validación de Materiales
    if (materiales.length < 2) {
        errores.push("Debe seleccionar al menos dos materiales para el producto.");
    }

    // 5️⃣ Validación de Bodega
    if (!bodega) {
        errores.push("Debe seleccionar una bodega.");
    }

    // 6️⃣ Validación de Sucursal
    if (!sucursal) {
        errores.push("Debe seleccionar una sucursal para la bodega seleccionada.");
    }

    // 7️⃣ Validación de Moneda
    if (!moneda) {
        errores.push("Debe seleccionar una moneda para el producto.");
    }

    // 8️⃣ Validación de Descripción
    if (descripcion === "") {
        errores.push("La descripción del producto no puede estar en blanco.");
    } else if (descripcion.length < 10 || descripcion.length > 1000) {
        errores.push("La descripción del producto debe tener entre 10 y 1000 caracteres.");
    }

    // Mostrar errores si existen
    if (errores.length > 0) {
        alert("❌ Errores en el formulario:\n- " + errores.join("\n- "));
        return false;
    }

    return true;
}
