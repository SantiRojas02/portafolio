$(function() {
  $('#btnEnviar').click(function() {
    guardarTurnos();
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
        url: '../server/clientes2.php',
        type: 'POST',
        data: 'data=' + JSON.stringify(paramertrosServidor), // JSON.stringify convierte de JSON a String
        context: document.body,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: true,
        success: function(data) { // que hace success 
          console.log(data);
          data = JSON.parse(data);
          limpiarSelect('#selectHorarios');
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
        url: '../server/clientes2.php',
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

function guardarTurnos(){
  
  var paramertrosServidor = {
    accion: 'guardarTurnos',
    nombre: $('#nombre').val(),
    apellido: $('#apellido').val(),
    email: $('#email').val(),
    telefono: $('#telefono').val(),
    localidad: $('#selectLocalidades').val(),
    trabajo: $('#selectTrabajos').val(),
    horario: $('#selectHorarios').val(),
    fecha: $('#fecha').val()
  }

  if (paramertrosServidor.nombre == "") alert('INGRESE EL NOMBRE');  
  if (paramertrosServidor.apellido == "") alert('INGRESE EL APELLIDO');
  if (paramertrosServidor.email == "") alert('INGRESE EL EMAIL');  
  if (paramertrosServidor.telefono == "") alert('INGRESE EL TELEFONO');
  if (paramertrosServidor.fecha == "") alert('INGRESE EL FECHA');
  if (paramertrosServidor.trabajo == "") alert('INGRESE EL TRABAJO');
  if (paramertrosServidor.localidad == "") alert('INGRESE EL LOCALIDAD');
  if (paramertrosServidor.horario == "") alert('INGRESE EL HORARIO');
  $.ajax({
      url: '../server/clientes2.php',
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

function limpiarSelect(_id){
  $(_id + ' option').each(function(){
    $(_id + ' option').eq(1).remove();
  });
}