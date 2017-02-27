$(function() {
    rellenarPuntuacion();
    rellenarCaratula();
    listaCanciones();
    listaNovedades();
    rellenarSecPuntuaciones();
    function rellenarPuntuacion() {
        var filasTabla = "";
        $.post("./inc/rellenaTablaPuntuacion.php", function(datos_devueltos) {
            //console.log(datos_devueltos);
            myObj = JSON.parse(datos_devueltos);
            for (x in myObj) {
                indice = parseInt(x) + 1;
                filasTabla += "<tr><td>" + indice + "</td><td>" + myObj[x].puntuacion + "</td><td>" + myObj[x].nick + "</td></tr>";
            }
            $("#tablaP tbody").html(filasTabla);
            console.log("Tabla puntuaciones actual actualizado");
        });
        setTimeout(rellenarPuntuacion, 2000);
    }

    function rellenarCaratula() {
        //
        $.post("./inc/rellenarPortada.php", function(datos_devueltos) {
            console.log(datos_devueltos);
            myObj = JSON.parse(datos_devueltos);
            caratula = myObj.ruta + "\/caratula.jpg";
            titulo = myObj.titulo;
            console.log(titulo);
            duracion = myObj.duracion;
            $("#musica-seleccionada").find("h2").html(titulo);
            $("#musica-seleccionada").find("img").attr("src", caratula);
            $("#musica-seleccionada").find("b").html(duracion);
        });
        //
    }

    function listaCanciones() {
        //
        envio = "c=listar";
        $.post("./inc/cancionesL.php", envio, function(datos_devueltos) {
            console.log(datos_devueltos);
            myObj = JSON.parse(datos_devueltos);
            for (x in myObj) {
                $("#lCanciones tbody").append(
                    "<tr>" +
                    "<td class='oculto'>" + myObj[x].id + "</td>" +
                    "<td>" + myObj[x].titulo + "</td>" +
                    "<td>" + myObj[x].grupo + "</td>" +
                    "<td>" + myObj[x].duracion + "</td>" +
                    "</tr>"
                );
            }
            $("#lCanciones tbody").find("tr").click(seleccionar);
        });

        function seleccionar() {
            cancion = $(this).find("td").eq(0).html();
            //alert(cancion);
            envio = "c=cambiar&cancion=" + cancion;
            $.post("./inc/cancionesL.php", envio, function(datos_devueltos) {
                //alert(datos_devueltos);
                $("html, body").animate({
                    scrollTop: 0
                }, 10);
                setTimeout(function() {
                    location.reload()
                }, 20);;
            });
        }
        //
    }
    function listaNovedades(){
        $.post("./inc/obtenerNovedades.php",function(data){
            $("#novedades").append(data);
        });
    }
    function rellenarSecPuntuaciones(){
      var filasTabla = "";
      $.post("./inc/puntuacionesL.php", function(datos_devueltos) {
          myObj = JSON.parse(datos_devueltos);
          for (x in myObj) {
              filasTabla +=  "<tr>" +  "<td class='oculto'>" + myObj[x].id + "</td>" +  "<td>" + myObj[x].titulo + "</td>" +  "<td>" + myObj[x].nick + "</td>" +  "<td>" + myObj[x].puntuacion + "</td>" +  "</tr>"
          }
          $("#lPuntuaciones tbody").html(filasTabla);
      });
      setTimeout(rellenarSecPuntuaciones, 2000);
    }
});
