<?php
require("conexion.php");
    $sql = "SELECT * FROM horario";
    // Llamo a todos los datos de la tabla de localidades
    $registroHorarios= mysqli_query($conn, $sql) or
        die("Problemas en el SELECT: ".mysqli_error($conn));
    
    mysqli_close($conn);    
?>