<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sacar Turnos</title>
  <link rel="stylesheet" href="../css/turnos.css">
  <script type="text/javascript" src="./js/jquery.min.js"></script>  
  <script type="text/javascript" src="./js/modulos/clientes2.js"></script>
</head>
<?php        
  require "../server/seleccionarLocalidades.php";
?>
<body>
  <div class="login-box">
    <img src="img/login.png">
    <h2>Sacar turno</h2>
    <form>
      <div class="user-box">
        <input type="text" id="nombre" placeholder="Nombre... ">     
      </div>

      <div class="user-box">
        <input type="text" id="apellido" placeholder="Apellido...">           
      </div>

      <div class="user-box">
        <input type="number" id="telefono" placeholder="Telefono...">
      </div>

      <div class="user-box">
        <input type="email" id="email" placeholder="correo... "> 
      </div>
      <div class="user-box">
        <div class="sidebar-box">
          <select id="selectLocalidades" class="styled-select">
            <option value="">¿En que localidad vive?</option>
            <?php                        
              while($reg = mysqli_fetch_array($registroLocalidaes)){
                echo '<option value="'.$reg['idLocalidad'].'">'.$reg['nombre'].'</option>';
              }
            ?>
          </select>
          
          
            <input id="fecha" type="date" value="">
            <select id="selectTrabajos" class="styled-select">
              <option value="">Selecccionar trabajo...</option>
            </select>
          
              
          <select id="selectHorarios" class="styled-select">
            <option value="">Selecccionar horario...</option>
          </select>

        </div>
        
        <br>
        <br>
        <center><button type="button" id="btnEnviar">Enviar</button></center>
    
        </a>
      </div>
    </form>
  </div>  
</body>
</html>