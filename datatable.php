<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="horario.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js">
    </script>
    <link rel="stylesheet" href="main.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <table id="example">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
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
where h.sed_id=43 
                
                ";
                $ejecutar = oci_parse($cnx, $query);
                $r = oci_execute($ejecutar);
                while ($row = oci_fetch_array($ejecutar)) { ?>
                <tr>
                    <td>
                        <div class="contenedor_medico">
                            <div class="info_medico">
                                <h1><?php echo $row[1]; ?></h1>
                                <div class="info_medico-detalle">
                                    <span class="sp_especialidad"><?php echo $row[2]; ?></span>
                                    <span class="sp_cmp"><?php echo $row[3]; ?></span>
                                </div>
                                <button class="btn_primario" style="margin-top: 16px;" data-toggle="modal"
                                    data-target="#modalHorario<?php echo $row[6]; ?>">Horario</button>
                                <?php 
                if ($row[8]=='' ){
                    echo "";
                }else{?>
                                <button class="btn_secundario" style="margin-top: 16px;" data-toggle="modal"
                                    data-target="#modalCurriculum<?php echo $row[6]; ?>">curriculum</button>
                                <?php
                }
                ?>
                            </div>
                            <div class="foto_medico text-right">
                                <?php
                        if ($row[0]=='default-med.jpg' || $row[0]==''){
                            echo "";
                        }else{
                            echo "<img class='medico' src='https://qualab.com.pe/public/STAFF02/staff-oracle/upload/$row[0]'>";
                        }
                        ?>
                            </div>
                        </div>
                        <?php include('modal_curriculum.php') ?>
                        <?php include('modal_horario.php') ?>
                        <?php }?>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>
    <script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            pageLength: 3,
            "dom": 'rtip',
            searching: false,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, 'Todos']
            ]
        })
    });
    </script>
</body>

</html>