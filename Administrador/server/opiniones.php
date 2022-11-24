<?php
    require("Conexion.php");
    // conecta con conexion.php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        // Si tiene un error entra en el if
    }
    echo "Connected successfully";
   // Conexion correcta  
   
    
    $opiniones = $_POST ["opiniones"];
    $Nombre = $_POST ["Nombre"];
    // Declaro variables para guardar los datos.

    $sql = "INSERT INTO opiniones (opiniones, Nombre) VALUES ('$opiniones', '$Nombre')";
    // Envio los datos de las diferentes variables a la base de datos.
    
    if (($result = mysqli_query($conn, $sql)) === false) {
        die(mysqli_error($conn));
    }
?>


