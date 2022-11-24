<?php
        $servername = "localhost";
        $database = "Estetica";
        $username = "root";
        $password = "";

        
        $conn = mysqli_connect($servername, $username, $password, $database, 3306);
        mysqli_set_charset($conn, "utf8");
        //Conecta con la base de datos 
?>