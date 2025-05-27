<?php
// Abrir conexión con la base de datos 'pixela'
$con = mysqli_connect("localhost", "root", "", "pixela");

// Validar conexión con la base de datos
if (!$con) {
    die('No se estableció la conexión con el servidor de BD: ' . mysqli_connect_error());
}

echo "<br>";
echo "<h2>Consulta de datos de usuarios</h2>";
echo "<br>";

// Realizar consulta a la tabla 'usuarios'
$resultset = mysqli_query($con, "SELECT * FROM usuarios");

// Enlace para insertar nuevos usuarios
echo '<a href="crear_usuario.php" class="link-insertar">Insertar Nuevo Usuario</a>';
echo "<br><br>\n";

// Crear una tabla con las columnas: ID, Nombre de Usuario, Tipo de Usuario, Correo, Contraseña
echo "<table border='1'>
      <tr>
      <th>ID</th>
      <th>Nombre de Usuario</th>
      <th>Tipo de Usuario</th>
      <th>Correo</th>
      <th>Contraseña</th>
      <th>Acciones</th>
      </tr>";

// Mostrar cada usuario
while ($row = mysqli_fetch_array($resultset)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nombre_usuario'] . "</td>";
    echo "<td>" . $row['tipo_usuario'] . "</td>";
    echo "<td>" . $row['correo'] . "</td>";
    echo "<td>" . $row['contrasena'] . "</td>"; // Si no quieres mostrarla completamente, usa substr($row['contrasena'], 0, 3) . '***'
    echo '<td>
          <a href="leer_usuario.php?id=' . $row['id'] . '">Ver</a> |
          <a href="actualizar_usuario.php?id=' . $row['id'] . '">Actualizar</a> |
          <a href="eliminar_usuario.php?id=' . $row['id'] . '" onclick="return confirm(\'¿Seguro que deseas eliminar este usuario?\')">Borrar</a>
          </td>';
    echo "</tr>";
}

mysqli_close($con);
echo "<br>";
echo '<a href="index.html" class="link-regresar">Regresar al menú principal</a>';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<style>
       body {
           font-family: 'Times New Roman', Times, serif;
           background-image: url('fondo fime.jpg');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;
           background-attachment: fixed;
           margin: 0;
           padding: 20px;
           color: rgb(10, 10, 10);
       }

       h2 {
           text-align: center;
           color: #FFFFFF;
           background-color: rgba(0, 0, 0, 0.6);
           padding: 36px;
           border-radius: 40px;
           display: inline-block;
           margin: 20px auto;
       }

       table {
           width: 100%;
           border-collapse: collapse;
           margin: 20px auto;
           background-color: white;
           box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
       }

       th, td {
           padding: 12px;
           text-align: left;
           border-bottom: 1px solid #ddd;
       }

       th {
           background-color: rgba(183, 208, 179, 0.9);
           color: #000;
       }

       tr:hover {
           background-color: rgba(200, 200, 200, 0.5);
       }

       a {
           text-decoration: none;
           color: #FFFFFF;
           background-color: rgba(0, 0, 0, 0.6);
           padding: 8px 12px;
           border-radius: 10px;
       }

       a:hover {
           text-decoration: underline;
       }
</style>
</head>
</html>
