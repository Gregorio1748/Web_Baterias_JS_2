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
  <title>Productos - BateríasJS</title>
  <link rel="stylesheet" href="productos.css"
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
    }

    .top-bar h1 {
      margin: 0 auto;
      text-align: center;
      flex: 1;
    }

    .cerrar-sesion {
      position: absolute;
      top: 20px;
      right: 20px;
      text-decoration: none;
      background-color: #ff4d4d;
      color: white;
      padding: 8px 12px;
      border-radius: 5px;
      font-weight: bold;
    }

    .cerrar-sesion:hover {
      background-color: #cc0000;
    }
  </style>
</head>
<body>
<a href="carrito.php" style="float: right; margin: 20px;">🛒 Ver Carrito</a>

  <div class="header">
    <h1>Hola, <?php echo $_SESSION['usuario']; ?>!</h1>
    <a class="cerrar-sesion" href="logout.php">Cerrar sesión</a>
  </div>

  <?php
include 'conexion.php';
$stmt = $pdo->query("SELECT * FROM productos");
?>

<div class="productos">
  <?php while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
    <div class="producto">
    <img src="img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
      <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
      <p>Precio: $<?php echo htmlspecialchars($producto['precio']); ?></p>
      <form action="agregar_al_carrito.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
  <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
  <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
  <button type="submit">Agregar al carrito</button>
</form>
    </div>
  <?php endwhile; ?>
</div>


    <!-- Puedes duplicar más productos aquí -->
  </div>

</body>
</html>