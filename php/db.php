<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "crud_basico");
mysqli_set_charset($connection,'utf8');

if (!$connection) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>