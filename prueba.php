<?php include("config/conexion.php"); ?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Staff médico MedikCenter">
    <meta name="keywords" content="Staff médico">
    <meta name="author" content="Manu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Médico | MedikCenter</title>
    <!-- icono San Pablo -->
    <link rel="icon" href="https://www.medikcenter.com.pe/wp-content/uploads/2023/06/cropped-ico-gsp-32x32.png"
        sizes="32x32" />
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/detail.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <main class="">
        <h1><i class="fas fa-search"></i> Encuentra a tu doctor</h1>
        <form id="searchForm">
            <div class="contentSearch">
                <div>
                    <label for="nombre" class="lblText">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="input-search boxText" placeholder="Nombre">
                </div>
                <?php
        // Usar el mismo código PHP para obtener la lista de especialidades
        $query = "SELECT esp_id, esp_nombre FROM t_especialidad where sed_id = 1 and NVL(flg_visible, '0') = '0' order by esp_nombre asc";
        $stmt = oci_parse($cnx, $query);
        oci_execute($stmt);
        ?>
                <div>
                    <label for="fetchval" class="lblText">Especialidad:</label>
                    <select name="fetchval" id="fetchval" class="sltOption">
                        <option value="" disabled="" selected="">Seleccionar</option>
                        <?php
                while ($row = oci_fetch_assoc($stmt)) {
                    echo '<option value="' . $row['ESP_ID'] . '">' . $row['ESP_NOMBRE'] . '</option>';
                }
                ?>
                    </select>
                </div>
                <div>
                    <button type="button" class="buttonAccent" onclick="searchMedicos()">Buscar</button>
                </div>
            </div>
        </form>


        <div class="" id="lista_medico">
            <div class="contentCardDoctor">
                <?php
                $query = "
 select  c.med_foto, (m.med_nombre ||' '|| m.med_paterno ||' '|| m.med_materno) n_medico,e.esp_nombre, m.med_cmp,e.esp_id, e.sed_id ,m.med_id, s.sed_nombre,c.med_curriculo, h.hor_lunes_m,h.hor_martes_m,h.hor_miercoles_m,h.hor_jueves_m,h.hor_viernes_m,h.hor_sabado_m,  
                h.hor_lunes_t,h.hor_martes_t,h.hor_miercoles_t,h.hor_jueves_t,h.hor_viernes_t,h.hor_sabado_t,
                h.hor_consultorio_l_m,h.hor_consultorio_m_m,h.hor_consultorio_x_m,h.hor_consultorio_j_m,h.hor_consultorio_v_m,h.hor_consultorio_s_m
from t_horario h
left join t_medico m
on h.med_id = m.med_id
left join tb_curriculum c
on m.med_cmp=c.med_cmp
inner join t_especialidad e
on m.esp_id=e.esp_id
inner join t_sede s
on e.sed_id=s.sed_id
where h.sed_id=1 and rownum < 6
                
                ";
                $ejecutar = oci_parse($cnx, $query);
                $r = oci_execute($ejecutar);
                while ($row = oci_fetch_array($ejecutar)) { ?>

                <div class="cardDoctor">
                    <div class="cardDoctorInfo">
                        <h3><?php echo $row[1]; ?></h3>
                        <div class="doctorInfo">
                            <span><?php echo $row[2]; ?></span>
                            <span>CMP: <?php echo $row[3]; ?></span>
                        </div>
                        <div class="doctorButton">
                            <button type="button" class="buttonPrimary" data-bs-toggle="modal"
                                data-bs-target="#modalDetail<?php echo $row[6]; ?>">Detalle</button>
                        </div>
                    </div>
                    <div class="cardDoctorImg">
                        <?php
                        if ($row[0]=='default-med.jpg' || $row[0]==''){
                            echo "";
                        }else{
                            echo "<img class='medico' src='https://qualab.com.pe/public/STAFF02/staff-oracle/upload/$row[0]'>";
                        }
                        ?>
                    </div>
                </div>

                <?php //include('modal_curriculum.php') ?>
                <?php //include('modal_horario.php') ?>
                <?php include('modal_details.php') ?>
                <?php }?>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    function searchMedicos() {
        var nombre = $('#nombre').val();
        var especialidad = $('#fetchval').val();

        $.ajax({
            type: 'POST',
            url: 'buscar_medicos.php', // Crea este archivo para manejar la búsqueda
            data: {
                nombre: nombre,
                especialidad: especialidad
            },
            success: function(response) {
                $('#lista_medico').html(response);
            }
        });
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('myModal<?php echo $row[6]; ?>');
    var openModalBtn = document.getElementById('openModalBtn');
    var closeBtn = document.getElementsByClassName('close')[0];

    // Abrir modal al hacer clic en el botón
    openModalBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Cerrar modal al hacer clic en la "X"
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Cerrar modal al hacer clic fuera del contenido del modal
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});

</script>
</body>

</html>