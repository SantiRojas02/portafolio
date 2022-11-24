<?php
require("conexion.php");
    // conecta con conexion.php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        // Si tiene un error entra en el if
    }
    echo "Connected successfully";

    // Conexion correcta 
    
    $servicio = $_POST ["servicio"];
    $precio = $_POST ["precio"];
    $tiempo = $_POST ["tiempo"];

    $sql = "INSERT INTO trabajos (servicio, precio, tiempo) VALUES ('$servicio' , '$precio' , '$tiempo')";
    
    if (($result = mysqli_query($conn, $sql)) === false) {
        die(mysqli_error($conn));
    }
    if ($conn) {
        header ("Location:../public/trabajos.php");
        // si cumple coon todos los requisitos redirecciona automaticamente a la pagina de turnos.html (fecha y hora)
    }
?>
