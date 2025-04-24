<?php
session_start();
require_once "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['carrito'])) {
    $cliente = $_POST['cliente'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $total = array_sum(array_column($_SESSION['carrito'], 'precio'));

    // Insertar en la tabla de facturas con más información
    $stmt = $pdo->prepare("INSERT INTO facturas (cliente, cedula, telefono, correo, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$cliente, $cedula, $telefono, $correo, $total]);
    $factura_id = $pdo->lastInsertId();

    // Insertar los productos en detalle_factura
    $stmt_detalle = $pdo->prepare("INSERT INTO detalle_factura (factura_id, producto, precio) VALUES (?, ?, ?)");
    foreach ($_SESSION['carrito'] as $producto) {
        $stmt_detalle->execute([$factura_id, $producto['nombre'], $producto['precio']]);
    }

    // Vaciar el carrito
    $_SESSION['carrito'] = [];

    // Redirigir a factura final
    header("Location: factura.php?id=" . $factura_id);
    exit();
} else {
    echo "Error: No hay productos en el carrito o los datos están incompletos.";
}
?>