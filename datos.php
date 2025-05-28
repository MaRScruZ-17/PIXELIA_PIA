<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "pixelia";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener cantidad de usuarios por género (nombre real desde la tabla genero)
$sql = "
    SELECT g.Nombre AS sexo, COUNT(*) AS total
    FROM usuarios u
    JOIN genero g ON u.idGenero = g.idGenero
    GROUP BY g.Nombre
";

$result = $conn->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = [
            'sexo' => $row['sexo'],
            'total' => $row['total']
        ];
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
