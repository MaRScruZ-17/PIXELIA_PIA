
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idPublicacion = $_POST["idPublicacion"] ?? '';

    // Validación estricta
    if (!is_numeric($idPublicacion) || intval($idPublicacion) <= 0) {
        echo "Por favor, introduce un ID de publicación válido (número entero positivo). Este ID es generado automáticamente por el sistema.";
        exit;
    }

    $idPublicacion = intval($idPublicacion);

    $conexion = new mysqli("localhost", "root", "", "pixelia");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("DELETE FROM publicaciones WHERE idPublicacion = ?");
    $stmt->bind_param("i", $idPublicacion);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "✅ Publicación eliminada exitosamente.";
        } else {
            echo "⚠️ No se encontró ninguna publicación con ese ID.";
        }
    } else {
        echo "❌ Error al eliminar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    // Mostrar formulario
    $conexion = new mysqli("localhost", "root", "", "pixelia");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $resultado = $conexion->query("SELECT idPublicacion, Descripcion FROM publicaciones");


    if ($resultado->num_rows > 0) {
        echo '<h2>Eliminar publicación</h2>';
        echo '<form method="POST" action="">';
        echo '<label for="idPublicacion">Selecciona la publicación a eliminar:</label><br>';
        echo '<select name="idPublicacion" required>';
        echo '<option value="">-- Selecciona una publicación --</option>';
        while ($fila = $resultado->fetch_assoc()) {
            echo '<option value="' . $fila["idPublicacion"] . '">' . $fila["idPublicacion"] . ' - ' . htmlspecialchars($fila["titulo"]) . '</option>';
        }
        echo '</select><br><br>';
        echo '<button type="submit">Eliminar</button>';
        echo '</form>';
    } else {
        echo "No hay publicaciones registradas.";
    }

    $conexion->close();
}
?>

