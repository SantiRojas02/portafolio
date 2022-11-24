<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
  <title>ARaynorDesign Template</title>
  <meta name="description" content="free website template" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="./js/modulos/clientes2.js"></script>
</head>

<?php        
  require "../server/consultasOpiniones.php";
?>

<body>
<div class="login-box">
      <h1>Opiniones </h1>
        <center>
          <table width="80%" border="1" id="tabla_listado_personas">
            <table width="80%" border="1">        
              <tr>                
                <th><b><center> Nombre</center></b></th> 
                <th><b><center> Opiniones</center></b></th>  
              </tr>                
              <?php                                           
              //$resultados = mysqli_query($conn, $consultaOpinioness); 
              
              while ($consulta = mysqli_fetch_assoc($consultaOpinioness))
              { ?>                    
                <tr> 
                  <td width="30%"><?php echo $consulta['Nombre']; ?></td>
                  <td width="50%"><?php echo $consulta['opinionesClientes']; ?></td>
                </tr>
                <?php }; ?>                                    
              </table>                                   
            </table>                                      
          </table>   
        </center>   

      </div>    
</body>
</html>
