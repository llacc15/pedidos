<?php
include "db/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (email, password, rol) VALUES ('$email', '$password', 'usuario')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}
?>

<form method="POST">
    <input type="email" name="email" required placeholder="Correo">
    <input type="password" name="password" required placeholder="Contraseña">
    <button type="submit">Registrarse</button>
</form>
