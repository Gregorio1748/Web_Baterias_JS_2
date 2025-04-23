<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <a href="productos.php">← Seguir comprando</a>
    <ul>
        <?php
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $index => $item) {
                echo "<li>{$item['nombre']} - \$" . number_format($item['precio'], 2) . 
                     " <a href='eliminar_del_carrito.php?index=$index'>❌ Eliminar</a></li>";
                $total += $item['precio'];
            }
        } else {
            echo "<li>El carrito está vacío.</li>";
        }
        ?>
    </ul>
    <h3>Total: $<?php echo number_format($total, 2); ?></h3>

    <form action="pago.php" method="GET" style="margin-top: 20px;">
        <button type="submit">Proceder al Pago</button>
    </form>
    
</body>
</html>
