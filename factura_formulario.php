<?php
session_start();
if (!isset($_SESSION['pagado']) || $_SESSION['pagado'] !== true) {
    header("Location: pago.php");
    exit();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Factura</title>
</head>
<body>
    <h1>Generar Factura</h1>
    <form action="generar_factura.php" method="POST">
        <label>Nombre del Cliente:</label>
        <input type="text" name="cliente" required>
        <br><br>
        <button type="submit">Generar Factura</button>
    </form>
    <a href="carrito.php">← Volver al carrito</a>
</body>
</html>
