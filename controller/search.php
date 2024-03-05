<?php
// Conexión a la base de datos
include '../config/cn.php'; 
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
$q = $_GET['q'];

//$sql = "SELECT * FROM productos WHERE MATCH(nombre, descripcion) AGAINST ('$q' IN BOOLEAN MODE)";
//$sql="SELECT * FROM productos WHERE nombre LIKE '%$q%' OR descripcion LIKE '%$q%'";
$sql="SELECT * FROM t_especialidad WHERE esp_nombre LIKE '$q%' and sed_id='43' and flg_visible<>1 ";
$result = $conn->query($sql);

$resultados = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultados[] = $row;
    }
}

echo json_encode($resultados);

$conn->close();
?>
