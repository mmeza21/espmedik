<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Especialidades Medik Center">
    <meta name="keywords" content="Cardiología, cirugía cardiovascular, cirugía general, cirugía pediátrica, cirugía plástica, dermatología">
    <meta name="author" content="Manu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidades | Medik Center San Pablo</title>
    <!-- icono San Pablo -->
    <link rel="icon" href="https://www.medikcenter.com.pe/wp-content/uploads/2023/06/cropped-ico-gsp-32x32.png" sizes="32x32" />
    <!--Font Awesome y CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!--Jquery y JS-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <main>
        <div class="contentSearch">
            <h1><i class="fas fa-stethoscope"></i> Encuentra la especialidad que buscas</h1>
            <input type="text" id="searchSpecialty" class="boxText" placeholder="Escribe tu especialidad deseada" maxlength="30"  autocomplete="off" oninput="buscarTextoPredictivo()" />
            <p class="errorMessage" id="errorMessage"></p>
            <ul id="resultSpecialty" class="specialty"></ul>
        </div>

        <div id="contentListSpecialty" class="contentListSpecialty">
            <!-- Aquí se cargarán dinámicamente las especialidades -->
        </div>
        <!-- Botón oculto para volver al inicio -->
        <button id="buttonReturn" class="buttonPrimary" style="display:none">
            <i class="fas fa-arrow-left"></i> Volver</button>
        <div id="detailSpeciality" class="detailSpeciality">
            <!-- Aquí se mostrará el detalle al hacer clic en una especialidad -->
        </div>
    </main>
    <script src="assets/js/main.js"></script>
</body>

</html>