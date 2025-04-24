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
    <title>Carrito de Compras</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .volver {
            text-decoration: none;
            color: #00e6e6;
            font-weight: bold;
            display: block;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .eliminar {
            background-color: #ff4d4d;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .eliminar:hover {
            background-color: #cc0000;
        }

        h3 {
            text-align: right;
            font-size: 1.3em;
            margin-top: 30px;
        }

        form {
            text-align: right;
            margin-top: 20px;
        }

        button {
            background-color: #00c9a7;
            color: white;
            padding: 12px 20px;
            font-size: 1em;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #00b393;
        }
    </style>
</head>
<body>

    <h1>🛒 Carrito de Compras</h1>
    <a class="volver" href="productos.php">← Seguir comprando</a>

    <ul>
        <?php
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $index => $item) {
                echo "<li><span>{$item['nombre']} - \$" . number_format($item['precio'], 2) . "</span>
                      <a class='eliminar' href='eliminar_del_carrito.php?index=$index'>Eliminar</a></li>";
                $total += $item['precio'];
            }
        } else {
            echo "<li>El carrito está vacío.</li>";
        }
        ?>
    </ul>

    <h3>Total: $<?php echo number_format($total, 2); ?></h3>

    <?php if (!empty($_SESSION['carrito'])): ?>
    <form action="pago.php" method="GET">
        <button type="submit">Proceder al Pago</button>
    </form>
    <?php endif; ?>

</body>
</html>










