<?php
include 'php/conexion.php';

$stmt = $pdo->prepare("SELECT * FROM noticias ORDER BY fecha DESC LIMIT 3");
$stmt->execute();
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt_productos = $pdo->prepare("SELECT * FROM productos WHERE activo = 1");
$stmt_productos->execute();
$productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smoke Society</title>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/carousel.css">
    <link rel="stylesheet" href="assets/css/cards.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <link rel="stylesheet" href="assets/css/popup.css">
    <link rel="stylesheet" href="assets/css/news.css">
    <link rel="stylesheet" href="assets/css/session.css">
    <link rel="stylesheet" href="assets/css/price.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>

        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="assets/images/carousel_imgV2.png" style="width: 100%">
            </div>
            <div class="mySlides fade">
                <img src="assets/images/carousel_imgV4.png" style="width: 100%">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <div style="text-align: center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>

        <h2 class="section-title">Dejar el cigarrillo es fácil y accesible!<br>Gracias a los vapers desechables 👇🏽</h2>
        <h2 class="section-title">Ordenar por:</h2>
        <select id="priceFilter">
            <option value="lowToHigh">Precio: Menor a Mayor</option>
            <option value="highToLow">Precio: Mayor a Menor</option>
        </select>

        <div class="container">
            <?php foreach ($productos as $producto): ?>
                <div class="card" data-price="<?= $producto['precio'] ?>">
                    <div class="product-image">
                            <?php if ($producto['foto_blob']): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['foto_blob']); ?>" alt="Imagen del producto" class="product-thumbnail">
                            <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3><?= $producto['nombre'] ?> - <?= $producto['sabor'] ?></h3>
                        <h4>$<?= number_format($producto['precio'], 2, ',', '.') ?> ARS</h4>
                    </div>
                    <div class="btn">
                        <a href="pages/producto.php?id=<?= $producto['id'] ?>" class="button-link">Comprar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        
        <div class="about-section">
            <img src="assets/images/about.webp" alt="Sobre Nosotros">
            <div class="about-content">
                <h2>¡BIENVENIDOS A SmokeSociety!</h2>
                <p>
                    Si buscás cigarrillos electrónicos, vapes, vapos, vapers, ¡Acabás de encontrar la página número uno en el mercado!
                    ¡Ofrecemos novedad en vapes, liderando el camino de la moda! Vas a encontrar vapes de distintos diseños que combinen con tu estilo,
                    tenemos los vapes más buscados en el mercado nacional e internacional, te garantizamos la mejor calidad, sabor y originalidad en nuestros productos.
                </p>
                <p>
                    ¡Te invitamos a formar parte de #SmokeSociety!
                </p>
            </div>
        </div>
        <h2 class="section-title">Aprende más sobre la nicotina</h2>
        <div class="news-container">
    <?php foreach ($noticias as $noticia): ?>
        <div class="news-item">
            <a href="/paradigmas/pages/noticia.php?id=<?= $noticia['id'] ?>" class="news-image">
                <?php if ($noticia['imagen_blob']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($noticia['imagen_blob']); ?>" alt="<?= $noticia['titulo'] ?>" />
                <?php else: ?>
                    <img src="assets/images/default-news-image.jpg" alt="<?= $noticia['titulo'] ?>" />
                <?php endif; ?>
            </a>
            <div class="news-meta">
                <h3 class="news-title">
                    <a href="/paradigmas/pages/noticia.php?id=<?= $noticia['id'] ?>"><?= $noticia['titulo'] ?></a>
                </h3>
                <p class="news-excerpt"><?= substr($noticia['contenido'], 0, 150) ?>...</p>
                <a href="/paradigmas/pages/noticia.php?id=<?= $noticia['id'] ?>" class="btn1 btn--secondary btn--small">Leer más</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="scripts/carousel.js"></script>
    <script src="scripts/animations.js"></script>
    <script src="scripts/popup.js"></script>
    <script src="scripts/news.js"></script>
    <script src="scripts/burguerAnimation.js"></script>
</body>
</html>
