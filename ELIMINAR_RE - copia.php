<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idPublicacion = $_POST["idPublicacion"] ?? '';

    if (empty($idPublicacion)) {
        echo "Error: ID de publicación no proporcionado.";
        exit;
    }

    $conexion = new mysqli("localhost", "root", "", "pixelia");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Usar consulta preparada para evitar inyección SQL
    $stmt = $conexion->prepare("DELETE FROM publicaciones WHERE idPublicacion = ?");
    $stmt->bind_param("i", $idPublicacion);

    if ($stmt->execute()) {
        echo "Publicación eliminada exitosamente.";
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Método no permitido.";
}
