<?php
session_start();
require_once "conexion.php";

if (!isset($_GET['id'])) {
    echo "Factura no encontrada.";
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM facturas WHERE id = ?");
$stmt->execute([$id]);
$factura = $stmt->fetch();

$stmt_detalle = $pdo->prepare("SELECT * FROM detalle_factura WHERE factura_id = ?");
$stmt_detalle->execute([$id]);
$productos = $stmt_detalle->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #<?php echo $id; ?></title>
</head>
<body>
    <h1>Factura #<?php echo $id; ?></h1>
    <p>Cliente: <?php echo htmlspecialchars($factura['cliente']); ?></p>
    <p>Fecha: <?php echo $factura['fecha']; ?></p>
    <h3>Productos:</h3>
    <ul>
        <?php foreach ($productos as $item): ?>
            <li><?php echo htmlspecialchars($item['producto']); ?> - $<?php echo number_format($item['precio'], 2); ?></li>
        <?php endforeach; ?>
    </ul>
    <h3>Total: $<?php echo number_format($factura['total'], 2); ?></h3>
    <button onclick="window.print()">🖨️ Imprimir</button>
</body>
</html>
