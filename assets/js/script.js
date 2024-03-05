
$(document).ready(function () {
    // Cargar la lista de especialidades al cargar la página
    $.ajax({
        url: './controller/pagination.php',
        type: 'GET',
        success: function (data) {
            $('#contentListSpecialty').html(data);
        }
    });

    // Manejar clic en una especialidad para obtener detalles
    $('#contentListSpecialty').on('click', 'div', function () {
        var idEspecialidad = $(this).data('id');

        $.ajax({
            url: './controller/detail.php',
            type: 'GET',
            data: { id: idEspecialidad },
            success: function (data) {
                $('#detailSpeciality').html(data);
                $('#buttonReturn').show(); // Mostrar el botón de volver
                $('#contentListSpecialty').hide(); // Ocultar la lista de especialidades
            }
        });
    });

    // Manejar clic en el botón de volver
    $('#buttonReturn').on('click', function () {
        $('#detailSpeciality').html(''); // Limpiar el detalle
        $('#buttonReturn').hide(); // Ocultar el botón de volver
        $('#contentListSpecialty').show(); // Mostrar la lista de especialidades
    });
});

// Cargar la lista completa al cargar la página
$(document).ready(function () {
    cargarListaCompleta();
});

function cargarListaCompleta() {
    $.ajax({
        url: './controller/pagination.php',
        type: 'GET',
        success: function (response) {
            $('#contentListSpecialty').html(response);
        }
    });
}
// Cargar la lista completa al cargar la página
function buscarTextoPredictivo() {
    var input = $('#searchSpecialty').val();
    if (input.length > 0) {
        $.ajax({
            url: './controller/search.php',
            type: 'GET',
            data: {
                q: input
            },
            dataType: 'json',
            success: function (response) {
                mostrarResultados(response);
            }
        });
    } else {
        cargarListaCompleta();
        $('#resultSpecialty').html('');
        $('#detailSpeciality').show(); // Mostrar el listado completo
    }
}

function mostrarResultados(resultados) {
    var lista = $('#resultSpecialty');
    lista.html('');

    for (var i = 0; i < resultados.length; i++) {
        (function (index) {
            var item = $('<li>' + resultados[index].esp_nombre + '</li>');
            item.click(function () {
                mostrarListadoCompleto(resultados[index].esp_id);
                lista.html(''); // Limpiar la lista de resultados después de hacer clic
            });
            lista.append(item);
        })(i);
    }
}
function mostrarListadoCompleto(id) {
    $.ajax({
        url: './controller/detail.php',
        type: 'GET',
        data: {
            id: id
        },
        success: function (response) {
            $('#contentListSpecialty').hide(); // Ocultar la lista de especialidades
            $('#buttonReturn').show(); // Mostrar el botón de volver
            $('#detailSpeciality').html(response);
        }
    });
}

function cargarPagina(pagina) {
    $.ajax({
        url: './controller/pagination.php',
        type: 'GET',
        data: {
            pagina: pagina
        },
        success: function (response) {
            $('#contentListSpecialty').html(response);
        }
    });
}

$(document).ready(function () {
    cargarPagina(1); // Cargar la primera página al cargar la página principal

    // Manejar clics en los enlaces de paginación
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var pagina = $(this).attr('href').split('=')[1];
        cargarPagina(pagina);
    });
});






