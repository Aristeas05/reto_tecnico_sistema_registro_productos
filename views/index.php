<?php include("../config/database.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <script defer src="../public/js/validation.js"></script>
    <script defer src="../public/js/script.js"></script>
</head>
<body>
    <form id="productoForm">
        <div class="title">
            <h1>Formulario de Producto</h1>
        </div>
        <div class="inputGroup">
            <div>
                <label>Código</label>
                <input type="text" id="codigo" name="codigo">
            </div>
            <div>
                <label>Nombre</label>
                <input type="text" id="nombre" name="nombre">
            </div>
        </div>
        <div class="inputGroup">
            <div>
                <label>Bodega</label>
                <select id="bodega" name="bodega">
                </select>
            </div>
            <div>
                <label>Sucursal</label>
                <select id="sucursal" name="sucursal">
                </select>
            </div>
        </div>
        <div class="inputGroup">
            <div>
                <label>Moneda</label>
                <select id="moneda" name="moneda">
                </select>
            </div>
            <div>
            <label for="precio">Precio</label>
            <input type="text" id="precio" name="precio" oninput="validarNumero(this)">
            </div>
        </div>

        <label>Materiales del Producto</label>
        <div class="checkGroup">
            <div>
                <input type="checkbox" name="material[]" value="Plástico"> Plástico
            </div>
            <div>
                <input type="checkbox" name="material[]" value="Metal"> Metal
            </div>
            <div>
                <input type="checkbox" name="material[]" value="Madera"> Madera
            </div>
            <div>
                <input type="checkbox" name="material[]" value="Vidrio"> Vidrio
            </div>
            <div>
                <input type="checkbox" name="material[]" value="Textil"> Textil
            </div>
        </div>
        <label>Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>
        <div class="buttonGroup">
            <button type="submit">Guardar Producto</button>
        </div>
    </form>
</body>
</html>
