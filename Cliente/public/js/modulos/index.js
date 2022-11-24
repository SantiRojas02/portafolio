$(function() {
  $('#btnEnviar').click(function() {
    
  });

  $('#fecha').change(function() {
    obtenerHorarios();
  });

  obtenerTrabajos();
})

function obtenerHorarios(){
  var paramertrosServidor = {
    accion: 'obtenerHorarios',
    fecha: $('#fecha').val()
  }

    $.ajax({
        url: '../server/index.php',
        type: 'POST',
        data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
        context: document.body,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: true,
        success: function(data) { // que hace success 
          console.log(data);
          data = JSON.parse(data);
          cargarSelectHorarios(data); 
        },
        error: function(error, status) {
          console.log(error);
        }
    });
}

function cargarSelectHorarios(data){
  console.log(data);
  var option = '';
  for (var i = 0; i < data.length; i++) {
    option += '<option value="' + data[i]['id_horario'] + '">' + data[i]['hora'] + '</option>';
  }
  $('#selectHorarios').append(option); // buscar que es append 
}

function obtenerTrabajos(){

    var paramertrosServidor = {
      accion: 'obtenerTrabajos'
    }

    $.ajax({
        url: '../server/index.php',
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
  $('#selectTrabajos').append(option);
}