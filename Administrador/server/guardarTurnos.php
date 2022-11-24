<?php
    require("conexion.php");
    // conecta con conexion.php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        // Si tiene un error entra en el if
    }
    //echo "Connected successfully";

    $horario_libre = true;
    $fecha = $_POST["fecha"];
    $id_horario = $_POST["selectHorarios"];

    $sql3 = "SELECT * FROM turnos";
    $sql5 = "SELECT
                DATE_FORMAT(DATE_ADD(STR_TO_DATE('23:00:00', '%H:%i:%s'), INTERVAL 2 MINUTE), '%H:%i:%s') hora";

    $sql6 = "INSERT INTO turnos (id_cliente, fecha, id_horario) VALUES ('$id_cliente' , '$fecha' , '$id_horario')
             WHERE NOT EXISTS (
                SELECT fecha, t,id_horario
                FROM turnos t
                INNER JOIN horario h ON h.id_horario = t.id_horario
                WHERE fecha = '$fecha' AND
                    DATE_FORMAT(DATE_ADD(STR_TO_DATE('23:00:00', '%H:%i:%s'), INTERVAL 2 MINUTE), '%H:%i:%s')
            )";

    $registros3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_array($registros3)) {
        if($row3['fecha'] == $fecha && $row3['id_horario'] == $id_horario){
            $horario_libre = false;
        }
    }

    if($horario_libre == true){
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
        $sql2 = "INSERT INTO turnos (id_cliente, fecha, id_horario) VALUES ('$id_cliente' , '$fecha' , '$id_horario')";

        if (($result = mysqli_query($conn, $sql2)) === false) {
            die(mysqli_error($conn));
            // si tiene algun error entra en el if
        }
        echo "Excelnete! Turno registrado correctamente.";
    }else{
        echo '<H1 style="color: red;">El horario elegido esta ocupado, por favor vuelva a elegir otro.</H1>';
    }

    mysqli_close($conn);
?>