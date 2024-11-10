<?php
include '../php/conexion.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Producto no encontrado.";
    exit();
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute(['id' => $id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    echo "Producto no encontrado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha del Producto - <?= htmlspecialchars($producto['nombre']) ?></title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/producto.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/session.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include '../includes/header2.php'; ?>

    <div class="product-container">
    <div class="product-details">
        <div class="product-image">
            <img src="../assets/images/<?= strtolower(str_replace(' ', '', $producto['nombre'])) ?>.jpeg" alt="<?= htmlspecialchars($producto['nombre']) ?>">
        </div>
        <div class="product-info">
            <h1><?= htmlspecialchars($producto['nombre']) ?></h1>
            <h2>$<?= number_format($producto['precio'], 2, ',', '.') ?> ARS</h2>
            <p><?= htmlspecialchars($producto['descripcion']) ?></p>
            <h3>Sabor:</h3>
            <p><?= htmlspecialchars($producto['sabor']) ?></p>
            
            <form id="purchaseForm" action="comprar.php" method="GET">
    <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
    <button type="submit" id="buyButton">Comprar</button>
</form>


            <br>
            <p id="purchaseStatus"></p>
        </div>
    </div>
</div>

    
    <?php include '../includes/footer.php'; ?>

    <script src="../scripts/burguerAnimation.js"></script>
</body>
</html>
