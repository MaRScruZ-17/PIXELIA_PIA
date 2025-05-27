<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pixelia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Verificar campos vacíos
if (empty($username) || empty($password)) {
    echo "Por favor, completa todos los campos.";
    exit;
}

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM usuarios WHERE Nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verificar contraseña (usa password_hash en el registro)
    if (password_verify($password, $usuario['Contrasena'])) {
        // Guardar datos de sesión
        $_SESSION['idUsuario'] = $usuario['idUsuario'];
        $_SESSION['Nombre'] = $usuario['Nombre'];
        $_SESSION['TipoUsuario'] = $usuario['idTipoUsuario'];

        // Redirigir según tipo de usuario
        switch ($usuario['idTipoUsuario']) {
            case 1: // Empleado Administrador
                header("Location: inicio.html");
                break;
            case 2: // Empleado General
                header("Location: inicioG.html");
                break;
            case 3: // Usuario Registrado
                header("Location: inicioR.html");
                break;
            default:
                echo "Tipo de usuario no válido.";
                exit;
        }
        exit;
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}

$conn->close();
?>
