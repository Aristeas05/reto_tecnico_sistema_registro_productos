<?php
include("../config/database.php");

$sql = "SELECT id, nombre FROM bodegas";
$result = $conn->query($sql);

$options = "";

while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
}

echo $options;
?>
