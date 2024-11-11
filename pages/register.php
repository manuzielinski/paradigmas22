<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/session.css">
    <title>Registro</title>
</head>
<body>
    
    <?php 
    include '../php/conexion.php';
    include '../includes/loginToggle.php'; 
    ?>
    
    <div class="container-login">
        <div class="box form-box">

            <header>Crea Una Cuenta Ahora!</header>
            <form action="../php/registro_user.php" method="post">
                <div class="field input">
                    <label for="name">Usuario</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Edad</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Registrarse" required>
                </div>
                <div class="links">
                    Ya eres miembro? <a href="login.php">Ingresa!</a>
                </div>
            </form>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <script src="../scripts/burguerAnimation.js"></script>

</body>
</html>
