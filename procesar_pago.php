<?php
session_start();
if (!empty($_SESSION['carrito'])) {
    $_SESSION['pagado'] = true;
    header("Location: factura_formulario.php");
    exit();
} else {
    echo "Error: No hay productos en el carrito.";
}
?>
