$(function() {
    $('#boton').click(function() {
      guardarDatosCobro();
    });
    obtenerTrabajos();

    nombreCliente();
  })

  function nombreCliente(){

    var paramertrosServidor = {
      accion: 'nombreCliente'
    }

    $.ajax({
        url: '../server/serviciosRealisados.php',
        type: 'POST',
        data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
        context: document.body, // que es esto
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: true,
        success: function(data) {
          console.log(data);
          data = JSON.parse(data); // que hace json.parse
          cargarNombreCliente(data);
        },
        error: function(error, status) {
          console.log(error);
        }
    });
}

  function cargarNombreCliente(data){
    console.log(data);
    var option = '';
    for (var i = 0; i < data.length; i++) {
      option += '<option value="' + data[i]['id_cliente'] + '">' + data[i]['nombre'] + ' ' + data[i]['apellido']  + '</option>';
    }
    $('#id_cliente').append(option);
  }


function obtenerTrabajos(){

    var paramertrosServidor = {
      accion: 'obtenerTrabajos'
    }

    $.ajax({
        url: '../server/serviciosRealisados.php',
        type: 'POST',
        data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
        context: document.body, // que es esto
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: true,
        success: function(data) {
          console.log(data);
          data = JSON.parse(data); // que hace json.parse
          cargarSelectTrabajos(data);
        },
        error: function(error, status) {
          console.log(error);
        }
    });
}

function cargarSelectTrabajos(data){
  console.log(data);
  var option = '';
  for (var i = 0; i < data.length; i++) {
    option += '<option value="' + data[i]['id_trabajo'] + '">' + data[i]['servicio'] + '</option>';
  }
  $('#id_trabajo').append(option);
}

function guardarDatosCobro()
{
  var paramertrosServidor= {
    accion : 'guardarDatosCobro',
    total: $('#total').val(),
    fechaActual: $('#fechaActual').val(),
    id_cliente: $('#id_cliente').val(),
    id_trabajo: $('#id_trabajo').val()
  }
  console.log(paramertrosServidor);
  $.ajax({
    url: '../server/serviciosRealisados.php',
    type: 'POST',
    data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
    context: document.body, // que es esto
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    processData: true,
    success: function(data) {
      console.log(data);
      alert(data);
      //data = JSON.parse(data); // que hace json.parse (convierte de STRING a JSON)
      //cargarSelectTrabajos(data);
    },
    error: function(error, status) {
      console.log(error);
    }
  });
}
