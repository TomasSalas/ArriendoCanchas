'use strict';
$(document).ready(function () {
    /* Boton Login */
    $('#btn_iniciar_sesion').click(function (e) {
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
                if(data.status == 'ok')
                {   Swal.fire({
                    icon: 'success',
                    title: 'Bienvenido '+data.result['nombre'],
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location.href = "arriendo.php?usuario="+md5(data.result['nombre']);
                    }
                }); 
                }else{
                    alert("GG")
                } 
            }
        })
    });

    /* Select Fecha --> Mostrar Horas Disponibles */
    $("#list_fecha").change(function() {
        let fecha = $("#list_fecha").val();
        $.ajax({
            url: "cancha.php",
            type: "POST",
            data: {fecha:fecha},
            success: function (data){
                $("#list_cancha").html(data); 
            }
        });
    });

    $("#list_cancha").change(function() {
        let fecha = $("#list_fecha").val();
        let cancha = $("#list_cancha").val();
        $.ajax({
            url: "consulta.php",
            type: "POST",
            data: {fecha:fecha , cancha:cancha},
            success: function (data){
                $("#list_hora").html(data); 
            }
        });
    });


    /* Insertar Registros */
    $('#btn_arriendo').click(function(e){
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
                fecha:fecha,
                hora:hora,
                cancha:cancha,
                id:id,
                nombre:nombre,
            },success: function(data){
                if(data != 2)
                {   Swal.fire({
                    icon: 'success',
                    title: 'Arriendo Ingresado Correctamente',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if(result.isConfirmed){
                       var w_ = window.open("pdf.php"+data, "scrollbars=yes,resizable=yes,left=500,width=400,height=400"); 
                        w_.focus();
                        location.reload();
                    }
                }); 
                }
                else{
                    console.log ( data);
                } 
            }
        });
    });
});
