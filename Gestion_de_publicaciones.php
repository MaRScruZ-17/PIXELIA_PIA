<?php
    // Abrir conexión con nueva BD 'pixelia'
    $con = mysqli_connect("localhost", "root", "", "pixelia");

    // Validar conexión
    if (!$con) {
        die('No se estableció la conexión con el servidor de BD:' . mysqli_connect_error());
    }

    echo "<br>";
    echo "<h2>CONSULTA DE IMÁGENES SUBIDAS</h2>";
    echo "<br>";

    // Consulta a la tabla imagenes_subidas
    $resultset = mysqli_query($con, "SELECT * FROM imagenes_subidas");

    // Link para insertar nuevos registros
    echo '<a href="subir_imagen.html">Subir nueva imagen</a>';
    echo "<br><br>\n";

    // Crear tabla
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Descripción</th>
            <th>Ruta de Imagen</th>
            <th>Fecha de Publicación</th>
            <th>Acciones</th>
        </tr>";

    while($row = mysqli_fetch_array($resultset)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['usuario'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td>" . $row['ruta_imagen'] . "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo '<td><a href="form_editar_imagen.php?id=' . $row['id'] . '">Actualizar</a></td>';
        echo "</tr>";
    }

    mysqli_close($con);
    echo '<br><a href="index.html">Regresar al menú principal</a>';
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
        padding: 12px;
        border-radius: 10px;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
</html>
