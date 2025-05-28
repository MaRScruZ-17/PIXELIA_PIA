<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include('conexion.php');

if (isset($_POST['Guardar'])) {
    $imagen = $_FILES['imagen']['name'];

    if (isset($imagen) && $imagen != "") {
        $tipo = $_FILES['imagen']['type'];
        $temp = $_FILES['imagen']['tmp_name'];

        if (!(strpos($tipo, 'gif') || strpos($tipo, 'jpeg') || strpos($tipo, 'webp') || strpos($tipo, 'png'))) {
            $_SESSION['mensaje'] = 'Solo se permiten archivos JPEG, GIF, PNG y WEBP';
            $_SESSION['tipo'] = 'danger';
            header('Location: ../index.php');
            exit();
        } else {
            // Nombre único
            $nombreUnico = uniqid() . "_" . basename($imagen);

            // Ruta absoluta segura
            $carpetaDestino = realpath(__DIR__ . '/../imagenes');
            if (!$carpetaDestino) {
                $_SESSION['mensaje'] = 'La carpeta destino no existe';
                $_SESSION['tipo'] = 'danger';
                header('Location: ../index.php');
                exit();
            }

            $rutaCompleta = $carpetaDestino . DIRECTORY_SEPARATOR . $nombreUnico;

            // Mover archivo
            if (move_uploaded_file($temp, $rutaCompleta)) {
                $query = "INSERT INTO imagen (URLImagen, idPublicacion) VALUES ('$nombreUnico', NULL)";
                $resultado = mysqli_query($conn, $query);

                if ($resultado) {
                    $_SESSION['mensaje'] = 'Se ha subido correctamente';
                    $_SESSION['tipo'] = 'success';
                } else {
                    $_SESSION['mensaje'] = 'Error al guardar en la base de datos';
                    $_SESSION['tipo'] = 'danger';
                }
            } else {
                $errorInfo = [
                    'error_code' => $_FILES['imagen']['error'],
                    'temp_name' => $temp,
                    'destino' => $rutaCompleta,
                    'file_exists_temp' => file_exists($temp) ? 'Sí' : 'No'
                ];
                $_SESSION['mensaje'] = 'Error al subir el archivo: ' . json_encode($errorInfo);
                $_SESSION['tipo'] = 'danger';
            }

            header('Location: ../index.php');
            exit();
        }
    }
}
?>
