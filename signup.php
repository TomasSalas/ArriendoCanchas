<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
   
    <!-- BOOTSTRAP JS  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
   
    
    <!-- ARCHIVOS LOCALES -->
    <link rel="stylesheet" href="css.css">
    <script src="js.js"></script>

    <title>Arriendo De Canchas</title>
</head>

<body>
    <div class="d-flex justify-content-center p-5">
    <div class="card p-4" align="center">
        <div class="card-body">
            <img class="mb-4" src="img/registration.png" alt="" width="72" height="72">
            <h5 class="card-title">Registración</h5>
            <p class="card-text">Ingrese los datos solicitados</p>
            <form>
                <div class="form-group has-validation">
                    <input type="text" class="form-control" id="txtnombre" name="txtnombre" placeholder="Nombre Usuario">
                </div>
                <div class="form-group has-validation">
                    <input type="email" class="form-control" id="txtcorreo" name="txtcorreo" placeholder="Correo Electronico">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="txtclave" name="txtclave" autocomplete="on" placeholder="Contraseña" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="txtclave2" name="txtclave2" autocomplete="on" placeholder="Confirme Contraseña" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" id="btn_registrar" name="btn_registrar">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    
</body>

</html>