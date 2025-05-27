<?php
// Datos de conexión, cámbialos por los tuyos
$servername = "localhost";
$username = "root";        // o tu usuario
$password = "";            // o tu contraseña
$dbname = "pixelia";      // nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener y limpiar el dato del formulario
$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';

if (empty($nombreCategoria)) {
    die("El nombre de la categoría es obligatorio.");
}

// Insertar la nueva categoría sin especificar idCategoria (autoincrementable)
$sql = "INSERT INTO categorias (categoriaS) VALUES ('$nombre')";


if ($conn->query($sql) === TRUE) {
    echo "Categoría agregada correctamente.";
} else {
    echo "Error al agregar categoría: " . $conn->error;
}

$conn->close();
?>
