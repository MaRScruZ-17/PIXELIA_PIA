<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['usuarios_a_eliminar']) && is_array($_POST['usuarios_a_eliminar'])) {
        $ids = $_POST['usuarios_a_eliminar'];

        // Validar y limpiar los IDs
        $ids = array_map('intval', $ids); // convertir a enteros para seguridad
        $ids_list = implode(',', $ids);

        // Conexión
        $conexion = new mysqli("localhost", "root", "", "pixelia");
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Consulta para eliminar
        $sql = "DELETE FROM usuarios WHERE idUsuario IN ($ids_list)";
        if ($conexion->query($sql) === TRUE) {
            echo "Usuarios eliminados correctamente.";
        } else {
            echo "Error al eliminar usuarios: " . $conexion->error;
        }

        $conexion->close();

    } else {
        echo "No se seleccionaron usuarios para eliminar.";
    }
} else {
    echo "Método no permitido.";
}
?>

