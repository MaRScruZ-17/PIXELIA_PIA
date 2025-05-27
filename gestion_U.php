<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "pixelia");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener usuarios con su tipo
$sql = "SELECT u.idUsuario, u.Nombre, u.Correo, t.Nombre AS TipoUsuario
        FROM pixelia_usuarios u
        JOIN pixelia_tiposusuario t ON u.idTipoUsuario = t.idTipoUsuario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $contador = 1;
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='px-4 py-2'>" . $contador . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila['Nombre']) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila['Correo']) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($fila['TipoUsuario']) . "</td>";
        echo "<td class='px-4 py-2'>
                <a href='editar_usuario.php?id=" . $fila['idUsuario'] . "'><button class='text-blue-500'>Editar</button></a>
                <a href='eliminar_usuario.php?id=" . $fila['idUsuario'] . "' onclick=\"return confirm('¿Deseas eliminar este usuario?');\"><button class='text-red-500'>Eliminar</button></a>
              </td>";
        echo "</tr>";
        $contador++;
    }
} else {
    echo "<tr><td colspan='5' class='px-4 py-2'>No hay usuarios registrados.</td></tr>";
}

$conexion->close();
?>
