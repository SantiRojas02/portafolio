<?php   
    require("conexion.php");
    $sql = "SELECT * FROM opiniones";
    $consultaOpinioness = mysqli_query($conn, $sql) or
        die("Problemas en el SELECT: ".mysqli_error($conn));     
    mysqli_close($conn);        
?>