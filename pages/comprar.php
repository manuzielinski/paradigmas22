<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar - Smoke Society</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/product.css">
    <link rel="stylesheet" href="../assets/css/comprar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/session.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php 
include '../includes/header2.php'; 
include '../php/conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario_logueado = isset($_SESSION['user_name']); 

$mensaje_exito = '';
$producto = null; 

if (!$pdo) {
    die('Error: No se pudo establecer conexión a la base de datos.');
}

$nombre = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuario';

$producto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($producto_id) {

    $stmt_producto = $pdo->prepare("SELECT nombre, descripcion, precio FROM productos WHERE id = ?");
    $stmt_producto->execute([$producto_id]);
    $producto = $stmt_producto->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $usuario_logueado) {
    $tipo_envio = isset($_POST['tipo_envio']) ? $_POST['tipo_envio'] : '';
    $direccion = isset($_POST['address']) ? $_POST['address'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 1; 
    $metodo_pago = isset($_POST['payment']) ? $_POST['payment'] : '';

    if (!$producto_id) {
        $mensaje_exito = "Producto no válido.";
    } else {
        try {
            $pdo->beginTransaction();
            $stmt_pedido = $pdo->prepare("INSERT INTO pedidos (cliente_id, producto_id, cantidad, medio_pago, direccion, tipo_envio) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt_pedido->execute([$_SESSION['user_id'], $producto_id, $cantidad, $metodo_pago, $direccion, $tipo_envio]);
            $pdo->commit();
            $mensaje_exito = "¡Compra realizada con éxito!";
        } catch (Exception $e) {
            $pdo->rollBack();
            $mensaje_exito = "Error al realizar la compra: " . $e->getMessage();
        }
    }
}
?>

<div class="Forms-container">
    <h1>Formulario de Compra</h1>
    <?php if ($mensaje_exito): ?>
        <div class="success-message">
            <p><?php echo $mensaje_exito; ?></p>
        </div>
    <?php endif; ?>

    <?php if ($producto): ?>
        <div class="producto-info">
            <h2>Estás comprando: <?php echo htmlspecialchars($producto['nombre']); ?></h2>
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?></p>
        </div>
    <?php else: ?>
        <p class="error-message">No se encontró el producto seleccionado.</p>
    <?php endif; ?>

    <form action="comprar.php?id=<?php echo $producto_id; ?>" method="post">
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">

        <div class="form-group">
            <label for="tipo_envio">Tipo de Envío:</label>
            <select id="tipo_envio" name="tipo_envio" required>
                <option value="standard">Estándar</option>
                <option value="express">Exprés</option>
                <option value="pickup">Recoger en tienda</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" required>
        </div>
        <div class="form-group">
            <label for="payment">Medio de Pago:</label>
            <select id="payment" name="payment" required>
                <option value="credit_card">Tarjeta de Crédito</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Transferencia Bancaria</option>
            </select>
        </div>
        <button type="submit" class="btn-submit" onclick="return verificarSesion(<?php echo $usuario_logueado ? 'true' : 'false'; ?>)">Enviar Pedido</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
<script src="../scripts/burguerAnimation.js"></script>

<script>
function verificarSesion(usuarioLogueado) {
    if (!usuarioLogueado) {
        alert("Debe iniciar sesión o crear una cuenta para realizar un pedido.");
        return false;
    }
    return true;
}
</script>

</body>
</html>
