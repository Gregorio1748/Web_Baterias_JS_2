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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #141e30, #243b55);
      color: white;
      padding: 20px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .top-bar h1 {
      margin: 0;
      font-size: 1.8em;
    }

    .cerrar-sesion {
      background-color: #ff4d4d;
      color: white;
      padding: 10px 15px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .cerrar-sesion:hover {
      background-color: #cc0000;
    }

    .carrito-link {
      text-decoration: none;
      color: #00c9a7;
      font-weight: bold;
      float: right;
      margin: 10px;
    }

    .productos {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .producto {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      text-align: center;
    }

    .producto img {
      max-width: 100%;
      height: 150px;
      object-fit: contain;
      margin-bottom: 10px;
      border-radius: 6px;
    }

    .producto h3 {
      margin: 10px 0 5px;
    }

    .producto p {
      margin: 8px 0;
    }

    .producto button {
      background-color: #00c9a7;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .producto button:hover {
      background-color: #00b393;
    }
  </style>
</head>
<body>

  <a href="carrito.php" class="carrito-link">🛒 Ver Carrito</a>

  <div class="top-bar">
    <h1>Hola, <?php echo $_SESSION['usuario']; ?> 👋</h1>
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
      <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
      <p><strong>$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></strong></p>
      <form action="agregar_al_carrito.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
        <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
        <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
        <button type="submit">Agregar al carrito</button>
      </form>
    </div>
  <?php endwhile; ?>
</div>

</body>
</html>