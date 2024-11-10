<?php
$pdo = new PDO("mysql:host=localhost;dbname=smokesociety", "root", "");

// insertar nuevo producto
if (isset($_POST['submit']) && isset($_FILES['foto']['tmp_name'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $sabor = $_POST['sabor'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock']; 
    $foto = file_get_contents($_FILES['foto']['tmp_name']);

    $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, sabor, descripcion, foto_blob, stock, activo) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $stmt->execute([$nombre, $precio, $sabor, $descripcion, $foto, $stock]); 
}


// inactivacion de un producto
if (isset($_POST['eliminar_producto'])) {
    $producto_id = $_POST['producto_id'];
    $stmt = $pdo->prepare("UPDATE productos SET activo = 0 WHERE id = ?");
    $stmt->execute([$producto_id]);
}

if (isset($_POST['activar_producto'])) {
    $producto_id = $_POST['producto_id'];
    $stmt = $pdo->prepare("UPDATE productos SET activo = 1 WHERE id = ?");
    $stmt->execute([$producto_id]);
}

// obtener todos los productos activos e inactivos
$stmt_activos = $pdo->prepare("SELECT * FROM productos WHERE activo = 1");
$stmt_activos->execute();
$productos_activos = $stmt_activos->fetchAll(PDO::FETCH_ASSOC);

$stmt_inactivos = $pdo->prepare("SELECT * FROM productos WHERE activo = 0");
$stmt_inactivos->execute();
$productos_inactivos = $stmt_inactivos->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit']) && isset($_FILES['imagen']['tmp_name'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $fecha = $_POST['fecha'];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    $stmt = $pdo->prepare("INSERT INTO noticias (titulo, fecha, contenido, imagen_blob) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titulo, $fecha, $contenido, $imagen]);
}

if (isset($_POST['eliminar_noticia'])) {
    $noticia_id = $_POST['noticia_id'];
    $stmt = $pdo->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->execute([$noticia_id]);
}

$stmt = $pdo->prepare("SELECT * FROM noticias");
$stmt->execute();
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Productos</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/session.css">
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>
<body>
    
    <?php include '../includes/header2.php'; ?>

    <div class="container-login">
    <div class="box form-box">
        <header>Insertar Producto</header>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <div class="field input">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off" required>
            </div>
            <div class="field input">
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" required>
            </div>
            <div class="field input">
                <label for="sabor">Sabor</label>
                <input type="text" name="sabor" id="sabor" required>
            </div>
            <div class="field input">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" required></textarea>
            </div>
            <div class="field input">
                <label for="stock">Stock Disponible</label>
                <input type="number" name="stock" id="stock" min="0" required>
            </div>
            <div class="field input">
                <label for="foto">Imagen</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>
            </div>
            <div class="field">
                <input type="submit" class="btn" name="submit" value="Insertar Producto">
            </div>
        </form>
    </div>
</div>

    <div class="container-login">
        <div class="box form-box">
            <header class="section-title">Productos Activos</header>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Sabor</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos_activos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                            <td><?php echo htmlspecialchars($producto['sabor']); ?></td>
                            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                            <td>
                                <?php if ($producto['foto_blob']): ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['foto_blob']); ?>" alt="Imagen del producto" class="product-thumbnail">
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="admin.php" method="post" style="display:inline;">
                                    <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                    <button type="submit" name="eliminar_producto" class="btn-eliminar">Inactivar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container-login">
        <div class="box form-box">
            <header class="section-title">Productos Inactivos</header>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Sabor</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos_inactivos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                            <td><?php echo htmlspecialchars($producto['sabor']); ?></td>
                            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                            <td>
                                <?php if ($producto['foto_blob']): ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['foto_blob']); ?>" alt="Imagen del producto" class="product-thumbnail">
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="admin.php" method="post" style="display:inline;">
                                    <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                    <button type="submit" name="activar_producto" class="btn-activar">Activar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container-login">
        <div class="box form-box">
            <header>Insertar Noticia</header>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <div class="field input">
                    <label for="titulo">Título de la Noticia</label>
                    <input type="text" name="titulo" id="titulo" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="contenido">Contenido</label>
                    <textarea name="contenido" id="contenido" required></textarea>
                </div>
                <div class="field input">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" required>
                </div>
                <div class="field input">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" accept="image/*" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Insertar Noticia">
                </div>
            </form>
        </div>
    </div>

    <div class="container-login">
        <div class="box form-box">
            <header class="section-title">Noticias Publicadas</header>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Contenido</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($noticias as $noticia): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($noticia['fecha']); ?></td>
                            <td><?php echo htmlspecialchars(substr($noticia['contenido'], 0, 100)) . '...'; ?></td>
                            <td>
                                <?php if ($noticia['imagen_blob']): ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($noticia['imagen_blob']); ?>" alt="Imagen de la noticia" class="product-thumbnail">
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="admin.php" method="post" style="display:inline;">
                                    <input type="hidden" name="noticia_id" value="<?php echo $noticia['id']; ?>">
                                    <button type="submit" name="eliminar_noticia" class="btn-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <script src="../scripts/burguerAnimation.js"></script>

</body>
</html>
