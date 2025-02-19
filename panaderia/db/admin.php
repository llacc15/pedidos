<?php
session_start();
if (!isset($_SESSION["email"]) || $_SESSION["rol"] != "admin") {
    header("Location: ../login.php");
    exit();
}
echo "Bienvenido, Administrador " . $_SESSION["email"];
?>

<a href="../logout.php">Cerrar sesión</a>
