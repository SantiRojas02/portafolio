<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
  <title>Turnos</title>
  <meta name="description" content="free website template" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<?php        
  require "../server/consultasTurnos.php";
?>

<body>
  <div id="main">	
	  <div id="site_content">
      <div id="site_heading">
        <h1>Turnos de clientes</h1>		
      </div>
	    <div id="menubar">
        <ul id="menu">
          <button><li><a href="index.html">Inicio</a></li>
          </button>
        </ul>
      </div>  			  
	    <div id="content">
	    
         </div>
		    <div class="content_item">
            
                <table>
                  <thead>
            
                    <tr>                
                        <th><b> N&deg; turno</b></th> 
                        <th><b> Nombre cliente</b></th>
                        <th><b> Fecha </b></th>
                        <th><b> Hora</b></th>  
                    </tr>
                  </thead>     
                </table>
           
          <?php
            while ($consulta = mysqli_fetch_assoc($consultaTurnoss))
            { ?>
                
                    <table>
                    
                    <tr> 
                        <td width="15%"><?php echo $consulta['id_turnos']; ?></td>
                        <td width="40%"><?php echo $consulta['apellido']. " " .$consulta['nombre']; ?></td>
                        <td width="15%"><?php echo $consulta['fecha']; ?></td>
                        <td width="10%"><?php echo $consulta['hora']; ?></td>
                    </tr>   
                                    
                    </table>   
                              
            <?php } ;?>
            
           
        </div>
      </div>
      

    </div>  
    
  </div>
</body>
</html>
