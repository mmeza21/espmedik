<?php
// Conexión a la base de datos
include '../config/cn.php';
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
// Obtener detalles de la especialidad seleccionada
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($conn->connect_error) {
        die('Error de conexión: ' . $conn->connect_error);
    }
// Selecione y valida con el id de especialidad
    $query = "SELECT * FROM t_especialidad WHERE esp_id = $id";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        echo '<img src=' . $row['imagen'] . '>';
        echo '<h2>' . $row['esp_nombre'] . '</h2>';
        echo '<p>' . nl2br($row['esp_descripcion']) . '</p>';
    } else {
        echo "Error al obtener detalles de la especialidad.";
    }
    $conn->close();
}
?>