<?php
    include('conexion.php');
    $usuario = $_GET['usuario'];
    $sql = ("SELECT * FROM usuario AS U WHERE md5(nombre) = '$usuario'");
    $query = $conn->query($sql);


    $sql2 =
        "SELECT A.ID_ARRIENDO, A.FECHA AS FECHA, H.HORA_DESC , U.NOMBRE , C.CANCHA_DESC FROM ARRIENDO A 
    JOIN USUARIO U ON U.ID = A.ID_USUARIO 
    JOIN HORA_ARRIENDO H ON H.ID_HORA = A.HORA
    JOIN CANCHA C ON C.ID_CANCHA = A.CANCHA 
    WHERE A.ESTADO = 1;";
    $query2 = $conn->query($sql2);

    $sql3 = "SELECT * FROM CANCHA";
    $query3 = $conn->query($sql3);

    if ($query->num_rows > 0) {
        foreach ($query as $row) {
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
    <nav class="navbar navbar-expand-lg fixed-top sticky-navigation navbar-light bg-light">
        <a class="navbar-brand" href="#">Aconcagua Sport</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" id="nav_arriendo" href="#">Arriendos</a>
                </li>
                <li>
                    <a class="nav-link page-scroll" id="nav_usuario" href="#">Usuarios</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a href="cerrar.php"><button type="button" class="btn btn-primary" id="btn_cerrar_sesion" name="btn_cerrar_sesion"> Cerrar Sesión</button></a>
            </form>
        </div>
    </nav>
    <!-- Contenido -->
    <div class="d-flex justify-content-center p-5">
        <div class="p-5" id="div1" style="display:''">
            <h1> Tabla de Arriendos Generales</h1>
            <table class="table table-striped table">
                <thead>
                    <tr>
                        <th>ID Arriendo</th>
                        <th>Usuario</th>
                        <th>Cancha</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($query2 as $row) : ?>
                        <tr>
                            <td> <?php echo $row["ID_ARRIENDO"] ?> </td>
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
                            <td> <button type="button" class="btn btn-warning btn_editar" data-id='<?php echo $row["ID_ARRIENDO"] ?>' data-toggle="modal" data-target="#exampleModalCenter">Editar </button></td>
                            <td> <button type="button" class="btn btn-danger btn_delete" data-id='<?php echo $row["ID_ARRIENDO"] ?>'>Eliminar </button></td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Editar Arriendo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-group">ID Arriendo</label>
                                <input class="form-control" type="text" id="txt_idarriendo_modal" disabled>
                            </div>
                            <div class="form-group">
                                <label class="form-group">Cancha</label>
                                <select class="custom-select" id="list_cancha_modal" name="list_cancha_modal">
                                    <?php foreach ($query3 as $row) : ?>
                                        <option value="<?php echo $row["id_cancha"]; ?>"><?php echo $row["cancha_desc"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-group">Fecha Arriendo</label>
                                <input type="date" class="form-control list_fecha" id="list_fecha_modal" name="list_fecha_modal">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="p-5" id="div2" style="display:none">
            <div class="row">
                <div class="card-deck">
                    <div class="col-sm-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Cancha 1</h5>
                                <p class="card-text" id="p_cancha1">
                                <div id="cancha_1" name="cancha_1"> </div>
                                </p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body w-100">
                                <h5 class="card-title">Cancha 2</h5>
                                <p class="card-text" id="p_cancha1">
                                <div id="cancha_2" name="cancha_2"> </div>
                                </p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title">Cancha 3</h5>
                                <p class="card-text" id="p_cancha1">
                                <div id="cancha_3" name="cancha_3"> </div>
                                </p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>