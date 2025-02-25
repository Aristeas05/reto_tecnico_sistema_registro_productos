<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config/database.php';

$codigo = $_POST['codigo'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$precio = $_POST['precio'] ?? '';
$bodega_id = $_POST['bodega'] ?? '';
$sucursal_id = $_POST['sucursal'] ?? '';
$moneda_id = $_POST['moneda'] ?? '';
$materiales = isset($_POST['material']) ? implode(',', $_POST['material']) : '';
$descripcion = $_POST['descripcion'] ?? '';

// Validación del Código del Producto

if (empty($codigo)) {
    echo json_encode(["success" => false, "message" => "El código del producto no puede estar en blanco."]);
    exit;
}
if (strlen($codigo) < 5 || strlen($codigo) > 15) {
    echo json_encode(["success" => false, "message" => "El código del producto debe tener entre 5 y 15 caracteres."]);
    exit;
}
if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z0-9]{5,15}$/', $codigo)) {
    echo json_encode(["success" => false, "message" => "El código del producto debe contener letras y números."]);
    exit;
}

// Verificar unicidad del código
$query_check = "SELECT id FROM productos WHERE codigo = ?";
$stmt_check = $conn->prepare($query_check);
$stmt_check->bind_param("s", $codigo);
$stmt_check->execute();
$stmt_check->store_result();
if ($stmt_check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "El código del producto ya está registrado."]);
    exit;
}

// Validación del Nombre
if (empty($nombre)) {
    echo json_encode(["success" => false, "message" => "El nombre del producto no puede estar en blanco."]);
    exit;
}
if (strlen($nombre) < 2 || strlen($nombre) > 50) {
    echo json_encode(["success" => false, "message" => "El nombre del producto debe tener entre 2 y 50 caracteres."]);
    exit;
}

// Validación del Precio
if (empty($precio) || !preg_match('/^\d+(\.\d{1,2})?$/', $precio)) {
    echo json_encode(["success" => false, "message" => "El precio del producto debe ser un número positivo con hasta dos decimales."]);
    exit;
}

// Validación de Materiales
if (empty($materiales) || count(explode(',', $materiales)) < 2) {
    echo json_encode(["success" => false, "message" => "Debe seleccionar al menos dos materiales."]);
    exit;
}

// Validación de Bodega
if (empty($bodega_id)) {
    echo json_encode(["success" => false, "message" => "Debe seleccionar una bodega."]);
    exit;
}

// Validación de Sucursal
if (empty($sucursal_id)) {
    echo json_encode(["success" => false, "message" => "Debe seleccionar una sucursal para la bodega seleccionada."]);
    exit;
}

// Validación de Moneda
if (empty($moneda_id)) {
    echo json_encode(["success" => false, "message" => "Debe seleccionar una moneda."]);
    exit;
}

// Validación de Descripción
if (empty($descripcion)) {
    echo json_encode(["success" => false, "message" => "La descripción del producto no puede estar en blanco."]);
    exit;
}
if (strlen($descripcion) < 10 || strlen($descripcion) > 1000) {
    echo json_encode(["success" => false, "message" => "La descripción del producto debe tener entre 10 y 1000 caracteres."]);
    exit;
}

// Insertar en la base de datos
$query = "INSERT INTO productos (codigo, nombre, precio, bodega_id, sucursal_id, moneda_id, materiales, descripcion) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssdiiiss", $codigo, $nombre, $precio, $bodega_id, $sucursal_id, $moneda_id, $materiales, $descripcion);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Producto guardado correctamente."]);
} else {
    echo json_encode(["success" => false, "message" => "Error al guardar el producto."]);
}

$stmt->close();
$conn->close();
