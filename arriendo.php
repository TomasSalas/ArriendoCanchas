<?php
  include('conexion.php');
  $usuario = $_GET['usuario'];
  $sql = ("SELECT * FROM usuario AS U WHERE md5(nombre) = '$usuario'");
  $query = $conn->query($sql);


  $sql2 = 
  "SELECT A.FECHA AS FECHA, H.HORA_DESC , U.NOMBRE , C.CANCHA_DESC FROM ARRIENDO A 
  JOIN USUARIO U ON U.ID = A.ID_USUARIO 
  JOIN HORA_ARRIENDO H ON H.ID_HORA = A.HORA
  JOIN CANCHA C ON C.ID_CANCHA = A.CANCHA  
  WHERE A.FECHA = CURDATE();";
  $query2 = $conn->query($sql2);

  if ($query->num_rows > 0) {
    foreach ($query as $row){
      $var = $row['correo'];
      $var2 = $row['id'];
      $var3 = $row['nombre'];
    }
    session_start();
  } else {
    session_destroy();
    header('Location: index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <!-- BOOTSTRAP JS  -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  <!-- CDN JQUERY -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
  <!-- ARCHIVOS LOCALES -->
  <script src="js.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Proyecto</title>
</head>

<body>

</body>
<nav class="navbar navbar-expand-lg fixed-top sticky-navigation navbar-light bg-light">
  <a class="navbar-brand" href="#">Aconcagua Sport</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link page-scroll" href="#arriendo">Arriendo</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a href="cerrar.php"><button type="button" class="btn btn-primary" id="btn_cerrar_sesion" name="btn_cerrar_sesion"> Cerrar Sesión</button></a>
    </form>
  </div>
</nav>

<div class="container justify-content-center p-4" id="arriendo">
  <form class="p-5">
    <div class="form-group">
      <label class="form-group">Ingrese Fecha Arriendo</label>
      <input type="date" class="form-control list_fecha" id="list_fecha" name="list_fecha">
    </div>
    <div class="form-group">
      <label class="form-group">Ingrese Cancha</label>
      <select class="custom-select" id="list_cancha" name="list_cancha"></select>
    </div>
    <div class="form-group">
      <label class="form-group">Ingrese Hora Arriendo</label>
      <select class="custom-select" id="list_hora" name="list_hora"></select>
    </div>
    <div class="form-group">
      <label class="form-group">Correo Usuario</label>
      <input type="text" class="form-control" id="txt_correo" name="txt_correo" autocomplete="on" placeholder="" disabled value="<?php echo $var ?>">
      <input type="text" class="form-control" id="txt_id" name="txt_id" autocomplete="on" placeholder="" disabled value="<?php echo $var2 ?>" style="display: none;">
      
    </div>
    <div class="form-group">
      <label class="form-group">Nombre Usuario</label>
      <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" autocomplete="on" placeholder="" disabled value="<?php echo $var3 ?>">
    </div>
    <div class="form-group">
      <button type="button" class="btn btn-primary btn_arriendo" id="btn_arriendo" name="btn_arriendo" >Realizar Arriendo</button>
  </div>
  </form>
</div>

<div class="container justify-content-center p-4">
  <table class="table table-striped table">
    <thead>
      <tr>
      <th>Usuario</th>
        <th>Cancha</th>
        <th>Fecha</th>
        <th>Hora</th>
        
      </tr>
    </thead>
    <tbody>
      <?php
         foreach ($query2 as $row) {
      ?>
      <tr>
          <td> <?php echo $row["NOMBRE"] ?> </td>
          <td> <?php echo $row["CANCHA_DESC"] ?> </td>
          <td> 
          <?php
            $fecha = $row["FECHA"];
            setlocale(LC_TIME, "spanish");
            $mi_fecha = str_replace("/", "-", $fecha);			
            $Nueva_Fecha = date("d-m-Y", strtotime($mi_fecha));				
            $Mes_Anyo = strftime("%A, %d de %B de %Y", strtotime($Nueva_Fecha));
            //devuelve: lunes, 16 de abril de 2018 
            echo utf8_encode($Mes_Anyo);
          ?> 
          </td>
          <td> <?php echo $row["HORA_DESC"] ?> </td>
          <?php 
        } 
      ?>
      </tr>

    </tbody>
  </table>
</div>


</html>