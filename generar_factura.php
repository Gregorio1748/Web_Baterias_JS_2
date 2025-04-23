<?php
session_start();
require_once "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['carrito'])) {
    $cliente = $_POST['cliente'];
    $total = array_sum(array_column($_SESSION['carrito'], 'precio'));

    // Insertar factura
    $stmt = $pdo->prepare("INSERT INTO facturas (cliente, total) VALUES (?, ?)");
    $stmt->execute([$cliente, $total]);
    $factura_id = $pdo->lastInsertId();

    // Insertar detalles
    $stmt_detalle = $pdo->prepare("INSERT INTO detalle_factura (factura_id, producto, precio) VALUES (?, ?, ?)");
    foreach ($_SESSION['carrito'] as $producto) {
        $stmt_detalle->execute([$factura_id, $producto['nombre'], $producto['precio']]);
    }

    // Vaciar carrito
    $_SESSION['carrito'] = [];

    // Redirigir a ver factura
    header("Location: factura.php?id=" . $factura_id);
    exit();
} else {
    echo "Error: No hay productos en el carrito o datos inválidos.";
}
?>
