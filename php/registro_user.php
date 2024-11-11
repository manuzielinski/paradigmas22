<?php
include 'conexion.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = intval($_POST['age']);
    $password = $_POST['password'];
    $telefono = '';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $is_admin = 0;

    if (empty($name) || empty($email) || empty($password) || $age <= 0) {
        echo "
        <script>
        alert('Todos los campos son obligatorios y deben tener valores válidos.');
        window.location.href='../pages/register.php';
        </script>
        ";
        exit;
    }

    $query = "SELECT COUNT(*) FROM clientes WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $emailExists = $stmt->fetchColumn();

    if ($emailExists) {
        echo "
        <script>
        alert('El correo ya está registrado. Intenta con otro.');
        window.location.href='../pages/register.php';
        </script>
        ";
        exit;
    }

    $query = "INSERT INTO clientes (nombre, email, edad, telefono, contraseña, is_admin) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute([$name, $email, $age, $telefono, $hashed_password, $is_admin]);

        echo "
        <script>
        alert('¡Usuario creado correctamente! Ahora debes iniciar sesión.');
        window.location.href='../pages/login.php';
        </script>
        ";
    } catch (PDOException $e) {
        echo "
        <script>
        alert('Error al registrar el usuario. Inténtalo de nuevo más tarde. Detalles del error: " . $e->getMessage() . "');
        window.location.href='../pages/register.php';
        </script>
        ";
    }
}
?>
