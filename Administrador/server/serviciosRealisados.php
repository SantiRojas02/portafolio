<?php
  $data = str_replace('\\', '', $_POST['data']);
  $data = json_decode(utf8_encode($data), true);

switch($data['accion']){
      case "obtenerTrabajos":
          echo json_encode(obtenerTrabajos( $data ));
      break;
      case "nombreCliente":
        echo json_encode(nombreCliente( $data ));
    break;
      case "guardarDatosCobro":
          echo json_encode(guardarDatosCobro( $data ));
      break;
  }

function nombreCliente($data){    
  require("conexion.php");
  $sql = "SELECT * FROM cliente";

  $registros = mysqli_query($conn, $sql) or
    die("Problemas en el SELECT: ".mysqli_error($conn));
  
  $registros_ar = array();

  while($row = $registros->fetch_assoc()){
    $registros_ar[] = $row;
  }
  mysqli_close($conn);
  return $registros_ar;
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

function guardarDatosCobro($data){
    require("conexion.php");
    // conecta con conexion.php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        // Si tiene un error entra en el if
    }
    //echo "Connected successfully";

    $total = $data["total"];
    $fechaActual = $data["fechaActual"];
    $id_cliente = $data["id_cliente"];
    $id_trabajo = $data["id_trabajo"];
    
    $sql = "INSERT INTO caja (total, fechaActual, id_cliente, id_trabajo) VALUES ('$total' , '$fechaActual' , '$id_cliente' , '$id_trabajo')";

    if (($result = mysqli_query($conn, $sql)) === false) {
        die(mysqli_error($conn));
        // si tiene algun error entra en el if
    }
   // Conexion correcta 
   
    echo "Excelnete! Guardado correctamente.";

    mysqli_close($conn);
  }
?>