<?php
include("../config/database.php");

if (isset($_GET['bodega_id'])) {
    $bodega_id = intval($_GET['bodega_id']);
    $sql = "SELECT id, nombre FROM sucursales WHERE bodega_id = $bodega_id";
    $result = $conn->query($sql);

    $options = "";

    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
    }

    echo $options;
}
?>
