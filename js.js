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
/*         const dias = [
            'lunes',
            'martes',
            'miércoles',
            'jueves',
            'viernes',
            'sábado',
            'domingo',
          ];
          const numeroDia = new Date(fecha).getDay();
        const nombreDia = dias[numeroDia];
        alert(nombreDia); */
        $.ajax({
            url: "consulta.php",
            type: "POST",
            data: {fecha:fecha},
            success: function (data){
                $("#list_hora").html(data); 
            }
        });
    });

    /* Insertar Registros */
    $('#btn_arriendo').click(function(e){
        let fecha = $("#list_fecha").val();
        let hora = $("#list_hora").val();
        let id = $("#txt_id").val();
        e.preventDefault();
        $.ajax({
            url: "insert.php",
            type: "POST",
            data: {
                fecha:fecha,
                hora:hora,
                id:id
            },success: function(data){
                if(data == 1)
                {   Swal.fire({
                    icon: 'success',
                    title: 'Arriendo Ingresado Correctamente',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if(result.isConfirmed){
                        location.reload();
                        window.open('pdf.php', '_blank')   
                    }
                }); 
                }else{
                    alert(data);
                } 
            }
        });
    });
});
