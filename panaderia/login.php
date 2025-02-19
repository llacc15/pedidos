<?php
session_start();
include "db/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row["password"])) {
            $_SESSION["email"] = $row["email"];
            $_SESSION["rol"] = $row["rol"];

            if ($email == "yamatoalbear@gmail.com" && $password == "Ningu@ng1.2.3") {
                $_SESSION["rol"] = "admin";
                header("Location: pages/admin.php");
            } else {
                header("Location: pages/usuario.php");
            }
            exit();
        }
    }
    echo "Credenciales incorrectas";
}
?>

<form method="POST">
    <input type="email" name="email" required placeholder="Correo">
    <input type="password" name="password" required placeholder="Contraseña">
    <button type="submit">Iniciar Sesión</button>
</form>
