<?php
$data = str_replace('\\', '', $_POST['data']);
$data = json_decode(utf8_encode($data), true);

switch($data['accion']){
    case "consutarOpiniones":
        echo json_encode(consutarOpiniones( $data ));
    break;
    case "guardarOpiniones":
        echo json_encode(guardarOpiniones( $data )); // json_encode = funcion nativa de php >> convierte a json lo que esta dentro del parenteces
    break;
}

    function consutarOpiniones( $data )
    {
        require("conexion.php");
        $sql = "SELECT * FROM opiniones";
        $consultaOpinioness = mysqli_query($conn, $sql) or
            die("Problemas en el SELECT: ".mysqli_error($conn));     
        mysqli_close($conn);    
    }

    function guardarOpiniones( $data )
    {
        require("conexion.php");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            // Si tiene un error entra en el if
        }
        // conecta con conexion.php
        $opinionesClientes = $data ["opinionesClientes"];
        $Nombre = $data ["Nombre"];
        
        
        $sql1 = "INSERT INTO opiniones (opinionesClientes, Nombre) VALUES ('$opinionesClientes', '$Nombre')";
        // Envio los datos de las diferentes variables a la base de datos.
        
        if (($result = mysqli_query($conn, $sql1)) === false) {
            die(mysqli_error($conn));
        }
        echo "Excelnete! Guardado correctamente.";
        mysqli_close($conn);
    }    
?>