<?php
$conexion = new mysqli("localhost", "root", "", "pixelia");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta solo a la tabla publicaciones

$sql = "SELECT idUsuario, idPublicacion, Descripcion, FechaPublicacion, activo FROM publicaciones";

$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

if ($resultado->num_rows > 0) {
    $contador = 1; // Contador para ID incremental
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr class='border-t'>";
        echo "<td class='px-4 py-2'><input type='checkbox' value='" . htmlspecialchars($fila["idPublicacion"]) . "' /></td>";
        echo "<td class='px-4 py-2'>#" . $contador . "</td>"; // ID incremental
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila["idUsuario"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila["Descripcion"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila["FechaPublicacion"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila["activo"]) . "</td>";
        echo "</tr>";
        $contador++;
    }
} else {
    echo "<tr><td colspan='6' class='text-center py-4'>No hay datos.</td></tr>";
}

$conexion->close();
?>
