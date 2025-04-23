<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

$total = 0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago</title>
</head>
<body>
    <h1>Proceso de Pago</h1>
    <p>Total a pagar: <strong>$<?php echo number_format($total, 2); ?></strong></p>
    <?php if ($total > 0): ?>
        <form action="procesar_pago.php" method="POST">
            <button type="submit">Simular Pago</button>
        </form>
    <?php else: ?>
        <p>No hay productos en el carrito.</p>
    <?php endif; ?>
    <a href="carrito.php">← Volver al carrito</a>
</body>
</html>
