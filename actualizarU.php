<?php
$conexion = new mysqli("localhost", "root", "", "pixelia");
$id = $_GET["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = !empty($_POST["contrasena"]) ? ", Contrasena='" . password_hash($_POST["contrasena"], PASSWORD_DEFAULT) . "'" : "";
    $sql = "UPDATE pixela_usuarios SET Nombre='$nombre', Correo='$correo' $contrasena WHERE idUsuario=$id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conexion->error;
    }
}
$result = $conexion->query("SELECT * FROM pixela_usuarios WHERE idUsuario = $id");
$usuario = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title>Editar Usuario</title></head>
<body>
<h2>Editar Usuario</h2>
<form method="post">
    Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['Nombre']) ?>" required><br>
    Correo: <input type="email" name="correo" value="<?= htmlspecialchars($usuario['Correo']) ?>" required><br>
    Nueva contraseña (opcional): <input type="password" name="contrasena"><br>
    <button type="submit">Actualizar</button>
</form>
<a href="index.php">Volver</a>
</body>
</html>
<?php $conexion->close(); ?>
