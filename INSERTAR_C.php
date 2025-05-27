<?php
$conexion = new mysqli("localhost", "root", "", "pixelia");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "
    SELECT
        u.idUsuario,
        COALESCE(GROUP_CONCAT(DISTINCT c.Nombre SEPARATOR ', '), 'Sin categoría') AS nombreCategoria,
        COUNT(DISTINCT f.idFavorito) AS cantidadGuardadas,
        COUNT(DISTINCT r.idReporte) AS cantidadReportes
    FROM usuarios u
    LEFT JOIN publicaciones p ON p.idUsuario = u.idUsuario
    LEFT JOIN publicacionescategorias pc ON p.idPublicacion = pc.idPublicacion
    LEFT JOIN categorias c ON pc.idCategoria = c.idCategoria
    LEFT JOIN favoritos f ON u.idUsuario = f.idUsuario
    LEFT JOIN reportes r ON u.idUsuario = r.idusuarioReportado
    GROUP BY u.idUsuario
    ORDER BY u.idUsuario
";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $contador = 1;
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr class='border-t'>";
        echo "<td class='px-4 py-2'>" . $contador . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila["idUsuario"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila["nombreCategoria"]) . "</td>";
        echo "<td class='px-4 py-2'>" . intval($fila["cantidadGuardadas"]) . "</td>";
        echo "<td class='px-4 py-2'>" . intval($fila["cantidadReportes"]) . "</td>";
        echo "</tr>";
        $contador++;
    }
} else
    echo "<tr><td colspan='6' class='text-center py-4'>No hay datos.</td></tr>";


$conexion->close();
?>


