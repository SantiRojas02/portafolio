<?php
require("conexion.php");
    $sql = "SELECT * FROM localidades";
    // Llamo a todos los datos de la tabla de localidades
    $registroLocalidaes = mysqli_query($conn, $sql) or
        die("Problemas en el SELECT: ".mysqli_error($conn));
    
    mysqli_close($conn);    
?>