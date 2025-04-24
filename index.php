<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BATERIAS JS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            color: white;
            text-align: center;
            padding: 100px 20px;
            margin: 0;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 0.3em;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 2em;
        }

        a button {
            padding: 12px 24px;
            font-size: 1em;
            background-color: #00c9a7;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        a button:hover {
            background-color: #00b393;
        }
    </style>
</head>
<body>
    <h1>🔋 BATERIAS JS</h1>
    <p>Bienvenido al sistema de ventas</p>
    <a href="productos.php">
        <button>Ver Productos</button>
    </a>
</body>
</html>