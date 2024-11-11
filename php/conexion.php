<?php
try {
    $dsn = 'mysql:host=autorack.proxy.rlwy.net;port=40929;dbname=railway;charset=utf8';
    $username = 'root';
    $password = 'NuHLiDBfiTqXVUpInsUoswhBDgghuKcs';

    // config de PDO
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
?>
