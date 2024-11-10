<?php
include '../php/conexion.php';
// id de la noticia a mostrar
$noticia_id = 1;

$query = "SELECT titulo, fecha, contenido, imagen_blob FROM noticias WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $noticia_id, PDO::PARAM_INT);
$stmt->execute();

$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if ($noticia) {
    $titulo = $noticia['titulo'];
    $fecha = $noticia['fecha'];
    $contenido = $noticia['contenido'];
    $imagen_blob = $noticia['imagen_blob'];
} else {
    echo "Noticia no encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smoke Society</title>
    <link rel="stylesheet" href="../assets/css/adds.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/popup.css">
    <link rel="stylesheet" href="../assets/css/session.css">


    
</head>
<body>
    <?php include '../includes/header2.php'; ?>

<main>
    <div class="article-section">
        <h1 class="article-title"><?php echo htmlspecialchars($titulo); ?></h1>
        <div class="article-image">
            <?php
            // una imagen en formato blob se puede mostar como base64
            if ($imagen_blob) {
                $image_data = base64_encode($imagen_blob);
                echo '<img src="data:image/jpeg;base64,' . $image_data . '" alt="Historia de la Nicotina" />';
            } else {
                echo '<img src="//indyargentina.com/cdn/shop/articles/historia-de-la-nicotina-712794.webp?v=1727191943" alt="Historia de la Nicotina" />';
            }
            ?>
        </div>
        <div class="article-content">
            <?php echo nl2br(htmlspecialchars($contenido)); ?>
        </div>
    </div>

</main>

<?php include '../includes/footer.php'; ?>

<script src="../scripts/burguerAnimation.js"></script>

</body>
</html>