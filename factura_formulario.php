<?php
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Factura</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            color: white;
            padding: 40px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 6px;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.07);
        }

        th, td {
            border: 1px solid #ffffff30;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1abc9c;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background-color: #00c9a7;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #00b393;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #c7f5ff;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
        }

        a:hover {
            color: white;
        }
    </style>
</head>
<body>

    <h1>🧾 Generar Factura</h1>

    <form action="generar_factura.php" method="POST">
        <label>Nombre completo:</label>
        <input type="text" name="cliente" required>

        <label>Número de cédula:</label>
        <input type="text" name="cedula" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" required>

        <label>Correo electrónico:</label>
        <input type="email" name="correo" required>

        <h3>Resumen de la compra:</h3>
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['carrito'] as $item):
                $total += $item['precio'];
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td>$<?php echo number_format($item['precio'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th>Total</th>
                <th>$<?php echo number_format($total, 2); ?></th>
            </tr>
        </table>

        <button type="submit">Confirmar y Generar Factura</button>
    </form>

    <a href="carrito.php">← Volver al carrito</a>

</body>
</html>