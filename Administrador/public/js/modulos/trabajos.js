let posicion = null;
let id_trabajo = null;
let registros = new Array();
let accion = 'insertarTrabajo';

$(function() {
    $('#btn_editar').click(function() {
        if (posicion == null) {
            alert('Debe seleccionar un registro de la tabla.')
        }else{
            accion = 'editarTrabajo';
            pasarDatosAlFormulario();
        }
    });

    $('#btn_eliminar').click(function() {
        if (posicion == null) {
            alert('Debe seleccionar un registro de la tabla.')
        }else{
            if (window.confirm("¿Eliminar trabajo?")) {
                eliminarTrabajo();
            }
        }
    });

    $('#btn_limpiar').click(function() {
       limpiarCampos();
    });

    $('#btn_enviar').click(function() {
        enviarTrabajo();
    });

    seleccionarTrabajos();
})

function limpiarCampos(){
    posicion = null;
    $('#servicio').val('');
    $('#precio').val('');
    $('#tiempo').val('0');
    $('#tabla_trabajos tbody tr').removeAttr('style');
    accion = 'insertarTrabajo';
}

function enviarTrabajo(){
    if(accion == 'insertarTrabajo') id_trabajo = null;
    else id_trabajo = registros[posicion].id_trabajo;

    var paramertrosServidor = {
        accion: accion,
        id_trabajo: id_trabajo,
        servicio: $('#servicio').val(),
        precio: $('#precio').val(),
        tiempo: $('#tiempo option:selected').val()
    }

    console.log(paramertrosServidor)
    $.ajax({
        url: '../server/trabajos.php',
        type: 'POST',
        data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
        context: document.body, 
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: true,
        success: function(data) {
            console.log(data);
            data = JSON.parse(data); // que hace json.parse
            seleccionarTrabajos();
        },
        error: function(error, status) {
            console.log(error);
        }
    });
}

function seleccionarTrabajos()
{
    var paramertrosServidor = {
        accion: 'seleccionarTrabajos'
    }

    console.log(paramertrosServidor)
    $.ajax({
        url: '../server/trabajos.php',
        type: 'POST',
        data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
        context: document.body, 
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: true,
        success: function(data) {
            console.log(data);
            data = JSON.parse(data); // que hace json.parse
            cargarTablaTrabajos(data);
        },
        error: function(error, status) {
            console.log(error);
        }
    });
}

function cargarTablaTrabajos(data){
    registros = data;
    $('#tabla_trabajos tbody tr').remove();
    console.log(registros);
    let filas = '';
    for (let i = 0; i < registros.length; i++) {
      filas += `<tr posicion="${i}">
                  <td width="40%">${registros[i].servicio}</td>
                  <td width="15%">${registros[i].precio}</td>
                  <td width="15%">${registros[i].tiempo}</td>
              </tr>`;
    }
    $('#tabla_trabajos').append(filas);

    $('#tabla_trabajos tbody tr').click(function() {
        posicion = $(this).attr('posicion');
        $('#tabla_trabajos tbody tr').removeAttr('style');
        $($(this)).css('background-color', 'rgb(168, 168, 168)');
        $('#servicio').val('');
        $('#precio').val('');
        $('#tiempo').val('0');
        accion = 'insertarTrabajo';
    });
}

function pasarDatosAlFormulario(){
    console.log(registros[posicion]);
    $('#servicio').val(registros[posicion].servicio);
    $('#precio').val(registros[posicion].precio);
    $('#tiempo').val(registros[posicion].tiempo);
}

function eliminarTrabajo()
{
    var paramertrosServidor = {
        accion: 'eliminarTrabajo',
        id_trabajo: registros[posicion].id_trabajo
    }

    console.log(paramertrosServidor)
    $.ajax({
        url: '../server/trabajos.php',
        type: 'POST',
        data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
        context: document.body, 
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: true,
        success: function(data) {
            console.log(data);
            data = JSON.parse(data); // que hace json.parse
            seleccionarTrabajos(data);
        },
        error: function(error, status) {
            console.log(error);
        }
    });
}