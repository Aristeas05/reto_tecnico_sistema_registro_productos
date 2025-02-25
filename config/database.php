<?php
$host = "localhost";
$user = "root";
$password = "admin";
$dbname = "producto_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
