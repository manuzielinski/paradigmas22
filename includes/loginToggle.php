<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // inicia sesion solo si no hay una session activa
}

// verificación si el usuario esta logueado
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
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
                <li><a href="comprar.php">Carrito</a></li>
                <li><a href="listado_tabla.php">Productos</a></li>
            </ul>
        </nav>
    </div>

    <div class="user-actions">
        <li class="profile">
            <div class="dropdown">
                
                <button class="dropbtn">
                    <img src="../assets/icons/perfil.png" alt="Perfil" class="profile-icon">
                </button>
                <div class="dropdown-content">
                    <?php if ($usuario): ?>
                        <div class="profile-image-container">
                            <img src="../assets/icons/perfil.png" alt="Imagen de Perfil" class="profile-image">
                            <h2 class="profile-name">Bienvenido <?php echo htmlspecialchars($usuario); ?>!</h2>
                        </div>
                        <a class="logout" href="php/logout.php">Cerrar Sesión</a>
                    <?php else: ?>
                        <h2 class="profile-name">Accede a tu cuenta!</h2>
                        <a class="login" href="../pages/login.php">Iniciar Sesión</a>
                        <a class="register" href="../pages/register.php">Registrarse</a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
        <input type="search" placeholder="Buscar" class="search-icon">
    </div>
</header>
