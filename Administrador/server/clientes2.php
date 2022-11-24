<?php
  $data = str_replace('\\', '', $_POST['data']);
	$data = json_decode(utf8_encode($data), true);

  switch($data['accion']){
		case "obtenerTrabajos":
			echo json_encode(obtenerTrabajos( $data ));
		break;
		case "obtenerHorarios":
			echo json_encode(obtenerHorarios( $data )); // json_encode = funcion nativa de php >> convierte a json lo que esta dentro del parenteces
		break;
		case "guardarTurnos":
			echo json_encode(guardarTurnos( $data ));
		break;
	}

  function obtenerTrabajos($data){    
    require("conexion.php");
    $sql = "SELECT * FROM trabajos";

    $registros = mysqli_query($conn, $sql) or
      die("Problemas en el SELECT: ".mysqli_error($conn));
    
    $registros_ar = array();

    while($row = $registros->fetch_assoc()){
      $registros_ar[] = $row;
    }

    mysqli_close($conn);
    return $registros_ar;
  }

  function obtenerHorarios($data){    
    require("conexion.php");
    $sql1 = "SELECT *,
              ADDDATE(h.hora, INTERVAL tr.tiempo * - 1 MINUTE) AS horaInicio,
              ADDDATE(h.hora, INTERVAL tr.tiempo MINUTE) AS horaFin   
            FROM turnos t 
            INNER JOIN horario h ON t.id_horario = h.id_horario
            INNER JOIN trabajos tr ON tr.id_trabajo = t.id_trabajo
            WHERE t.fecha = '".$data['fecha']."'";
            // que funcnio cumple el primer inner join 
    $registros1 = mysqli_query($conn, $sql1) or
    die("Problemas en el SELECT: ".mysqli_error($conn));
    
    $registros_ar1 = array();  // pregutar como se cargan los array 
    while($row1 = $registros1->fetch_assoc()){
      $registros_ar1[] = $row1;
    }

    $sql2 = "SELECT * FROM horario";

    $registros2 = mysqli_query($conn, $sql2) or
      die("Problemas en el SELECT: ".mysqli_error($conn));
    
    $registros_ar2 = array();
    while($row2 = $registros2->fetch_assoc()){
      $registros_ar2[] = $row2;
    }
      
    $registros_ar = array();  // por que s e declara dos veces estee array 
    $bandera = false;

    for ($i=0; $i < count($registros_ar2); $i++) {
      $bandera = false;
      for ($j=0; $j < count($registros_ar1); $j++) { 
        $hora = (int)str_replace(":", "", $registros_ar2[$i]['hora']);  // que funcion cunmple los ":" , ""        
        $horaInicio = (int)str_replace(":", "", $registros_ar1[$j]['horaInicio']);
        $horaFin = (int)str_replace(":", "", $registros_ar1[$j]['horaFin']);

        if($hora >= $horaInicio && $hora < $horaFin){
          $bandera = true;
        }
      }
      if($bandera == false){
        $registros_ar[] = $registros_ar2[$i];
      }
    }

    mysqli_close($conn);
    return $registros_ar;
  }

  function guardarTurnos($data){
    require("conexion.php");
    // conecta con conexion.php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        // Si tiene un error entra en el if
    }
    //echo "Connected successfully";

    $nombre = $data["nombre"];
    $apellido = $data["apellido"];
    $email = $data["email"];
    $telefono = $data["telefono"];
    $idLocalidad = $data["localidad"];
    $idTrabajo = $data["trabajo"];
    $idHorario = $data["horario"];
    $fecha = $data["fecha"];

    $sql = "INSERT INTO cliente (apellido, nombre, email, telefono, idLocalidad) VALUES ('$apellido' , '$nombre' , '$email' , '$telefono', '$idLocalidad')";

    if (($result = mysqli_query($conn, $sql)) === false) {
        die(mysqli_error($conn));
        // si tiene algun error entra en el if
    }

        // Conexion correcta 
    $sql1 = "SELECT MAX(id_cliente) AS id_cliente FROM cliente";
    // Guardo en una variable el ultimo id de cliente

    $registros = mysqli_query($conn, $sql1);
    if ($row = mysqli_fetch_array($registros)) {
        // Pregunto en el if cual es el ultimo id ingresado
        $id_cliente = $row['id_cliente'];
        //Guardo en una variable el ultimo id obtenido
    }

    // para sacar el ultimo id primero tengo que enviar los datos del cliente, y en el php de turnos pregunto cual es el ultimo id enviado y guardo en una variable.
    $sql2 = "INSERT INTO turnos (id_cliente, id_trabajo, fecha, id_horario) VALUES ('$id_cliente' , '$idTrabajo' , '$fecha' , '$idHorario')";

    if (($result = mysqli_query($conn, $sql2)) === false) {
        die(mysqli_error($conn));
        // si tiene algun error entra en el if
    }
    echo "Excelnete! Turno registrado correctamente.";

    mysqli_close($conn);
  }
?>