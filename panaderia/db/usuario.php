<?php
session_start();
include "../db/conexion.php";

if (!isset($_SESSION["email"])) {
    header("Location: ../login.php");
    exit();
}

$cliente = $_SESSION["email"];

// Procesar pedido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"];

    $sql = "INSERT INTO pedidos (cliente, producto, cantidad, estado) VALUES ('$cliente', '$producto', '$cantidad', 'Pendiente')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pedido realizado con éxito.'); window.location.href='usuario.php';</script>";
    } else {
        echo "<script>alert('Error al hacer el pedido.');</script>";
    }
}

// Obtener pedidos del usuario
$sqlPedidos = "SELECT * FROM pedidos WHERE cliente='$cliente' ORDER BY id DESC";
$resultPedidos = $conn->query($sqlPedidos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
        button { background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #218838; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <h1>Realizar Pedido</h1>
    <div class="container">
        <form method="POST">
            <input type="text" name="producto" required placeholder="Producto">
            <input type="number" name="cantidad" required placeholder="Cantidad">
            <button type="submit">Hacer Pedido</button>
        </form>
        <a href="../logout.php">Cerrar sesión</a>
    </div>

    <h2>Mis Pedidos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pedido = $resultPedidos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $pedido["id"]; ?></td>
                <td><?php echo $pedido["producto"]; ?></td>
                <td><?php echo $pedido["cantidad"]; ?></td>
                <td><?php echo $pedido["estado"]; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
