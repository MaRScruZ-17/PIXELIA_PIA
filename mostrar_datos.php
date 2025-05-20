<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "pixela");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta SQL
$sql = "SELECT u.idUsuario, p.idPublicacion, c.Nombre AS categoria, 
               p.FechaPublicacion, IF(p.Activo = 1, 'Activo', 'Inactivo') AS estado
        FROM publicaciones p
        INNER JOIN usuarios u ON p.idUsuario = u.idUsuario
        LEFT JOIN publicacionescategorias pc ON p.idPublicacion = pc.idPublicacion
        LEFT JOIN categorias c ON pc.idCategoria = c.idCategoria";

$resultado = $conexion->query($sql);

// Generar filas de tabla
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr class='border-t'>
                <td class='px-4 py-2 text-center'><input type='checkbox' /></td>
                <td class='px-4 py-2'>#" . $fila["idUsuario"] . "</td>
                <td class='px-4 py-2'>" . $fila["idPublicacion"] . "</td>
                <td class='px-4 py-2'>" . ($fila["categoria"] ?? "*") . "</td>
                <td class='px-4 py-2'>" . ($fila["FechaPublicacion"] ?? "-") . "</td>
                <td class='px-4 py-2'>" . $fila["estado"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center p-4'>No hay datos disponibles</td></tr>";
}

$conexion->close();
?>
