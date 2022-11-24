<?php
    require("conexion.php");
    // conecta con conexion.php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        // Si tiene un error entra en el if
    }
    echo "Connected successfully";

    // Conexion correcta 

    $nombre = $_POST ["nombre"];
    $apellido = $_POST ["apellido"];
    $email = $_POST ["email"];
    $telefono = $_POST ["telefono"];
    $idLocalidad = $_POST ["selectLocalidades"];

    $sql = "INSERT INTO cliente (apellido, nombre, email, telefono, idLocalidad) VALUES ('$apellido' , '$nombre' , '$email' , '$telefono', '$idLocalidad')";

    if (($result = mysqli_query($conn, $sql)) === false) {
        die(mysqli_error($conn));
        // si tiene algun error entra en el if
    }
    if ($conn) {
        header ("Location:../public/turnos.php");
        // si cumple coon todos los requisitos redirecciona automaticamente a la pagina de turnos.html (fecha y hora)
    }

    mysqli_close($conn);
?>