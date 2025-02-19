<?php
$host = "localhost";
$user = "root"; // Usuario de phpMyAdmin
$pass = ""; // Contraseña de phpMyAdmin
$dbname = "panaderia";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
echo "Conexión exitosa a la base de datos.";

?>
