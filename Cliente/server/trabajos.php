<?php
$data = str_replace('\\', '', $_POST['data']);
$data = json_decode(utf8_encode($data), true);

    switch($data['accion']){
		case "seleccionarTrabajos":
			echo json_encode(seleccionarTrabajos( $data ));
		break;
		case "insertarTrabajo":
			echo json_encode(insertarTrabajo( $data ));
		break;
		case "editarTrabajo":
			echo json_encode(editarTrabajo( $data ));
		break;
		case "eliminarTrabajo":
			echo json_encode(eliminarTrabajo( $data ));
		break;
	}

    function seleccionarTrabajos($data){    
        require("conexion.php");
        $sql = "SELECT *
                FROM trabajos
                WHERE fechaEliminacion IS NULL";
        $registros = mysqli_query($conn, $sql) or
        die("Problemas en el SELECT: ".mysqli_error($conn));        
        $registros_ar = array();

        while($row = $registros->fetch_assoc()){
            $registros_ar[] = $row;
        }
        mysqli_close($conn);
        return $registros_ar;
    }    

    function insertarTrabajo($data){    
        require("conexion.php");
        $servicio = $data["servicio"];
        $precio = $data["precio"];
        $tiempo = $data["tiempo"];

        $sql = "INSERT INTO trabajos (servicio, precio, tiempo) VALUES ('$servicio' , '$precio' , '$tiempo')";
        
        if (($result = mysqli_query($conn, $sql)) === false) {
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $result;
    }    

    function editarTrabajo($data){
        require("conexion.php");

        $sql = "UPDATE
					trabajos
				SET
					servicio  = '".$data['servicio']."',
					precio     = '".$data['precio']."',
					tiempo     = '".$data['tiempo']."'
				WHERE
					id_trabajo = '".$data['id_trabajo']."'";

        $registros = mysqli_query($conn, $sql) or
        die("Problemas en editar trabajo: ".mysqli_error($conn));        
        
        mysqli_close($conn);
        return $registros;
    }

    function eliminarTrabajo($data){
        require("conexion.php");

        $sql = "UPDATE
                    trabajos
                SET
                    fechaEliminacion = NOW()
                WHERE
                    id_trabajo = '".$data['id_trabajo']."'";

        $registros = mysqli_query($conn, $sql) or
        die("Problemas en eliminar trabajo: ".mysqli_error($conn));        
        
        mysqli_close($conn);
        return $registros;
    }
?>
