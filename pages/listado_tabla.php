<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=smokesociety", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// obtener los productos activos
$stmt = $pdo->prepare("SELECT * FROM productos WHERE activo = 1");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos - Smoke Society</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/listado_tabla.css">
    <link rel="stylesheet" href="../assets/css/session.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <?php include '../includes/header2.php'; ?>  

    <div class="container">
        <h1>Listado de Productos</h1>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><img src="../assets/images/<?= strtolower(str_replace(' ', '', $producto['nombre'])) ?>.jpeg" alt="<?= $producto['nombre'] ?>"></td>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2, ',', '.') ?> ARS</td>
                        <td><a href="../pages/producto.php?id=<?= $producto['id'] ?>">Comprar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script src="../scripts/burguerAnimation.js"></script>

</body>
</html>
