<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // inicia sesion solo si no hay una session activa
}

// verificación si el usuario esta logueado
$usuario = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
?>
<header class="header">
    <div class="logo">
        <img src="../assets/icons/Logo.png" alt="Smoke Logo">
    </div>

    <button class="menu-toggle" aria-label="Toggle menu">
        &#9776;
    </button>

    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-links">
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../pages/comprar.php">Carrito</a></li>
                <li><a href="../pages/listado_tabla.php">Productos</a></li>
                
                <!-- enlace hacia el panel de admin (solo visible para admins) -->
                <?php if ($is_admin): ?>
                    <li><a href="admin.php">Panel de Administración</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <div class="user-actions">
        <?php if ($usuario): ?>
            <span class="welcome-message">Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</span>
            <a href="../php/logout.php" class="logout-button">Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php" class="profile-icon-link">
                <img src="../assets/icons/perfil.png" alt="Perfil" class="profile-icon">
            </a>
        <?php endif; ?>
        
        <input type="search" placeholder="Buscar" class="search-icon">
    </div>
</header>

