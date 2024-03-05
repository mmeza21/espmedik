<?php
// Conexión a la base de datos
include '../config/cn.php'; 

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$registrosPorPagina = 9;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $registrosPorPagina;

// Obtener la lista de especialidades
$query = "SELECT * FROM t_especialidad where sed_id='43' LIMIT $inicio, $registrosPorPagina";
$result = $conn->query($query);
?>

<?php
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo '<div data-id="' . $row['esp_id'] . '"><img src=' . $row['imagen'] . '>' . $row['esp_nombre'] . '</div>';
        ?>

<?php
    }
    ?>

<?php
} else {
    echo "Error al obtener la lista de especialidades.";
}
// Calcular el total de páginas
$totalRegistrosQuery = "SELECT COUNT(*) as total FROM t_especialidad WHERE sed_id='43'";
$totalRegistros = mysqli_fetch_assoc(mysqli_query($conn, $totalRegistrosQuery))['total'];
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>
<!-- Barra de navegación -->
<nav aria-label="Menu de navegación" class="menuPagination">
    <ul class="pagination">
        <?php if ($paginaActual > 1) { ?>
        <li class="pageItem">
            <a class="pageLink pageLinkMove" href="?pagina=<?php echo $paginaActual - 1 ?>" aria-label="Anterior">
                <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            </a>
        </li>
        <?php } ?>
        <?php 
       $rango = 2; // Rango de botones para visualización de flechas < > 

       // Mostrar botones de paginación
       for ($i = max(1, $paginaActual - $rango); $i <= min($paginaActual + $rango, $totalPaginas); $i++) {
       
             ?>
        <li class="pageItem <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
            <a class="pageLink" href="?pagina=<?php echo $i ?>"><?php echo $i ?></a>
        </li>
        <?php } ?>
        <?php if ($paginaActual < $totalPaginas) { ?>
        <li class="pageItem">
            <a class="pageLink pageLinkMove" href="?pagina=<?php echo $paginaActual + 1 ?>" aria-label="Siguiente">
                <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>
<?php
$conn->close();
?>