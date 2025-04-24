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
    <title>Proceso de Pago</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #42275a, #734b6d);
            color: white;
            margin: 0;
            padding: 40px;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 2em;
        }

        p {
            font-size: 1.2em;
        }

        strong {
            color: #00ffc8;
            font-size: 1.5em;
        }

        form {
            margin-top: 30px;
        }

        button {
            background-color: #00c9a7;
            color: white;
            padding: 12px 25px;
            font-size: 1em;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #00b393;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            color: #a0f9f5;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

    <h1>🧾 Proceso de Pago</h1>

    <?php if ($total > 0): ?>
        <p>Total a pagar: <strong>$<?php echo number_format($total, 2); ?></strong></p>
        <form action="procesar_pago.php" method="POST">
            <button type="submit">Pagar</button>
        </form>
    <?php else: ?>
        <p>No hay productos en el carrito.</p>
    <?php endif; ?>

    <a href="carrito.php">← Volver al carrito</a>

</body>
</html>