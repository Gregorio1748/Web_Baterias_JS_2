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
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #eef2f3, #cfd9df);
            color: #2c3e50;
            padding: 40px;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            max-width: 800px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-left: 8px solid #2980b9;
        }

        h1 {
            color: #2980b9;
            text-align: center;
            margin-bottom: 10px;
        }

        h3 {
            color: #34495e;
            margin-top: 30px;
            text-align: center;
        }

        .info {
            background-color: #f4f7fa;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .info p {
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 6px;
            overflow: hidden;
        }

        th {
            background-color: #3498db;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 12px;
            background-color: #ffffff;
            border-bottom: 1px solid #ecf0f1;
        }

        tr:hover td {
            background-color: #f1f9ff;
        }

        .total {
            text-align: right;
            font-size: 1.4em;
            font-weight: bold;
            margin-top: 20px;
            color: #27ae60;
        }

        .print-btn {
            margin-top: 30px;
            text-align: center;
        }

        button {
            background-color: #27ae60;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #1e8449;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Factura #<?php echo $id; ?></h1>

    <div class="info">
        <p><strong>Cliente:</strong> <?php echo htmlspecialchars($factura['cliente']); ?></p>
        <p><strong>Cédula:</strong> <?php echo htmlspecialchars($factura['cedula']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($factura['telefono']); ?></p>
        <p><strong>Correo:</strong> <?php echo htmlspecialchars($factura['correo']); ?></p>
        <p><strong>Fecha:</strong> <?php echo $factura['fecha']; ?></p>
    </div>

    <h3>Detalle de la Compra</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['producto']); ?></td>
                    <td>$<?php echo number_format($item['precio'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        Total: $<?php echo number_format($factura['total'], 2); ?>
    </div>

    <div class="print-btn">
        <button onclick="window.print()">🖨️ Imprimir</button>
    </div>
</div>
</body>
</html>