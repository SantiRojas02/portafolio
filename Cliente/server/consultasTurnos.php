<?php   
    require("conexion.php");

        $sql = "SELECT
                    t.id_horario,
                    hora,
                    nombre,
                    apellido,
                    t.id_turnos,
                    fecha
                FROM turnos t 
                INNER JOIN horario h ON t.id_horario = h.id_horario
                INNER JOIN cliente c ON t.id_cliente = c.id_cliente";
                // para unir las tablas en donde los id sean iguales 
                // para renombrar las tablas, pongo un espacio y escribo el nuevo nombre

        $consultaTurnoss = mysqli_query($conn, $sql) or
            die("Problemas en el SELECT: ".mysqli_error($conn));     
        

        $sql1 = "SELECT * FROM horario";
        // Llamo a todos los datos de la tabla de localidades
        $registroHorarios= mysqli_query($conn, $sql1) or
            die("Problemas en el SELECT: ".mysqli_error($conn));

        $registros = array();

        while($row = $registroHorarios->fetch_assoc()){
            $registros[] = $row;
        }
            
        mysqli_close($conn);
        $data = json_encode($registros);
        echo $data;
?>