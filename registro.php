<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "pixelia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario con control de variables indefinidas
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$tipoUsuario = $_POST['tipousuario'] ?? '';
$genero = $_POST['genero'] ?? '';

// Validar campos vacíos
if (empty($username) || empty($email) || empty($password) || empty($tipoUsuario) || empty($genero)) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// Encriptar la contraseña
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Preparar la consulta SQL con parámetros para evitar inyección SQL
$stmt = $conn->prepare("INSERT INTO usuarios (Nombre, Correo, Contrasena, idTipoUsuario, idGenero, Activo) VALUES (?, ?, ?, ?, ?, 1)");

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular parámetros (s = string, i = integer)
$stmt->bind_param("sssii", $username, $email, $passwordHash, $tipoUsuario, $genero);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Registro exitoso, redirigir a login.html
    header("Location: inicio.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la sentencia y conexión
$stmt->close();
$conn->close();
?>
