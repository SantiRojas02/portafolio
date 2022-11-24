<?php
    function guardarTurnos()
    {
        require("conexion.php");
        // conecta con conexion.php
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            // Si tiene un error entra en el if
        }
        echo "Connected successfully";
        // conexion correcta
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $id_horario = $_POST["selectHorarios"];

        // para sacar el ultimo id primero tengo que enviar los datos del cliente, y en el php de turnos pregunto cual es el ultimo id enviado y guardo en una variable.
        $sql1 = "SELECT MAX(id_cliente) AS id_cliente FROM cliente";
        // Guardo en una variable el ultimo id de cliente

        $registros = mysqli_query($conn, $sql1);
        if ($row = mysqli_fetch_array($registros)) {
            // Pregunto en el if cual es el ultimo id ingresado
            $id_cliente = $row['id_cliente'];
            //Guardo en una variable el ultimo id obtenido
        }
        
        // Mando todos los datos de turno a la base de datos.
        if (($result = mysqli_query($conn, $sql2)) === false) {
            die(mysqli_error($conn));
        }
    }
    function selectHorarios(){
        // Declaro una funcion para separar los datos y tenes codigos mas limpios
        require("conexion.php");
        $sql = "SELECT * FROM $horario";
        // Llamo a todos los datos de la tabla localidades que estan cargados en MySQL
        $registrosHora = mysqli_query($conn, $sql) or
            die("Problemas en el SELECT: ".mysqli_error($conn));        
        mysqli_close($conn);
        // Cierro la conexon
        return $registrosHora;
        // retorno todos los registros traidos de la base de datos
    }
    // Descripción. "mysql_query()" envia una sentencia a la base activa en el servidor asociado al identificador de enlace. Si no es especificado un identificador_de_enlace, se asumira el ultilmo enlace abierto.
?> 