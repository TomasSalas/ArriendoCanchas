'use strict';
$(document).ready(function () {
    /* Boton Login */
    $('#btn_iniciar_sesion').click(function (e){
        let usuario = $('#txtusuario').val();
        let clave = md5($('#txtclave').val());
        e.preventDefault();
        $.ajax({
            url: 'login.php',
            type: 'POST',
            dataType: 'json',
            cache: false,
            data: {
                usuario: usuario,
                clave: clave
            },
            success: function (data) {
                if (data.status == 'ok') {
                    if(data.result['tipo_usuario'] == "NORMAL"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Bienvenido ' + data.result['nombre'],
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "arriendo.php?usuario=" + md5(data.result['nombre']);
                            }
                        });
                    }else if(data.result['tipo_usuario'] == "ADMIN"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Bienvenido ' + data.result['nombre'],
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "admin.php?usuario=" + md5(data.result['nombre']);
                            }
                        });
                    }
                } else {
                    alert("GG")
                }
            }
        })
    });
    /* Select Fecha */
    $("#list_fecha").change(function (e){
        let fecha = $("#list_fecha").val();
        $.ajax({
            url: "cancha.php",
            type: "POST",
            data: { fecha: fecha },
            success: function (data) {
                $("#list_cancha").html(data);
            }
        });
    });
    /* Select Cancha --> Mostrar Horas Disponibles */
    $("#list_cancha").change(function (e){
        let fecha = $("#list_fecha").val();
        let cancha = $("#list_cancha").val();
        $.ajax({
            url: "consulta.php",
            type: "POST",
            data: { fecha: fecha, cancha: cancha },
            success: function (data) {
                $("#list_hora").html(data);
            }
        });
    });
    /* Insertar Registros */
    $('#btn_arriendo').click(function (e){
        let fecha = $("#list_fecha").val();
        let hora = $("#list_hora").val();
        let cancha = $("#list_cancha").val();
        let id = $("#txt_id").val();
        let nombre = $("#txt_nombre").val();
        e.preventDefault();
        $.ajax({
            url: "insert.php",
            type: "POST",
            data: {
                fecha: fecha,
                hora: hora,
                cancha: cancha,
                id: id,
                nombre: nombre,
            }, success: function (data) {
                if (data != 2) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Arriendo Ingresado Correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var w_ = window.open("pdf.php" + data, "scrollbars=yes,resizable=yes,left=500,width=400,height=400");
                            w_.focus();
                            location.reload();
                        }
                    });
                }
                else {
                    console.log(data);
                }
            }
        });
    });
    /* Boton Registro */
    $('#btn_registrar').click(function (e){
        let nombre = $('#txtnombre').val();
        let correo = $('#txtcorreo').val();
        let clave = md5($('#txtclave2').val());
        e.preventDefault();
        $.ajax({
            url: "registracion.php",
            type: "POST",
            cache: false,
            data: {
                nombre: nombre,
                correo: correo,
                clave: clave
            }, success: function (data) {
                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrado de manera correcta',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php";
                        }
                    });
                } else {
                    alert("GG")
                }
            }
        })
    });
    /* Keyup -> Keydown Validar Clave*/
    $('#txtclave2').keyup(function (e){
        let clave1 = md5($('#txtclave').val());
        if (clave1 == md5($('#txtclave2').val())) {
            document.getElementById("txtclave2").style.borderColor = "green";

        } else {
            document.getElementById("txtclave2").style.borderColor = "red";
            $("#btn_registrar").prop('disabled', true);
        }
    })
    /* Keyup -> Validar Correo*/
    $("#txtcorreo").keyup(function (e){
        let correo = $('#txtcorreo').val();
        $.ajax({
            url: "validarcorreo.php",
            type: "POST",
            data: { correo: correo },
            success: function (data) {
                if (data == 2) {
                    document.getElementById("txtcorreo").style.borderColor = "red";
                    document.getElementById("txtcorreo").style.focus = "red";
                    $("#btn_registrar").prop('disabled', true);
                } else {
                    document.getElementById("txtcorreo").style.borderColor = "green";
                    $("#btn_registrar").prop('disabled', false);
                }
            }
        });
    });
    /* Nav bar --> Ocultar informaci??n */
    $('#nav_arriendo').click(function (e){
        document.getElementById("div1").style.display = "";
        document.getElementById("div2").style.display = "none";
    });
    $('#nav_usuario').click(function (e){
        document.getElementById("div1").style.display = "none";
        document.getElementById("div2").style.display = "";
        $.ajax({
            url: "canchas_info.php",
            type: "POST",
            dataType: "json",
            cache: false,
            success: function (data) {
                console.log(data[0]["COUNT(A.CANCHA)"]);
                $("#cancha_1").html("TOTAL DE ARRIENDOS: "+data[0]["COUNT(A.CANCHA)"]);
                $("#cancha_2").html("TOTAL DE ARRIENDOS: "+data[1]["COUNT(A.CANCHA)"]);
                $("#cancha_3").html("TOTAL DE ARRIENDOS: "+data[2]["COUNT(A.CANCHA)"]);
            }
            
        })
        
    });
    /* Boton editar registro de cancha */
    $('.btn_editar').click(function (e){
        var id = $(this).data("id");
        $.ajax({
            url: "editar.php",
            type: "POST",
            dataType: "json",
            cache: false,
            data: {
                id:id
            },
            success: function (data) {
                if(data.status == "ok"){
                    $("#txt_idarriendo_modal").val(data.result.ID_ARRIENDO);
                    let cancha = data.result.ID_CANCHA;
                    $("#list_cancha_modal").prop('selectedIndex', cancha-1);
                    $("#list_fecha_modal").val(data.result.FECHA);
                }
            }
        });
    });
    /* Boton Eliminar - Cambiar estado del arriendo  */
    $('.btn_delete').click(function (e){
        var id = $(this).data("id");
        $.ajax({
            url: "eliminar.php",
            type: "POST",
            dataType: "json",
            cache: false,
            data: {
                id:id
            },
            success: function (data) {
                if(data == 1){
                    Swal.fire({
                        icon: 'success',
                        title: "Arriendo Eliminado",
                        type: "success"
                      }).then(function () {
                            location.reload();
                      });
                }
            }
        });
    })
});
