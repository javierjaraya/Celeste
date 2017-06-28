<?php include("header.php"); ?>

<div id="alert"></div> 

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>Productos mas vendidos</strong></h4>
</div>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <form id="fm-fechas" class="form-inline">
        <div class="form-group">
            <label class="" style="width: 150px; padding-top: 6px;">Fecha desde</label>
            <input type="date" id="fecha_desde" name="fecha_desde" class="form-control">
        </div>
        <div class="form-group">
            <label class="" style="width: 150px; padding-top: 6px;">Fecha hasta</label>
            <input type="date" id="fecha_hasta" name="fecha_hasta" class="form-control">
        </div>
        <div class="form-group">
            <a class="btn btn-warning" onclick="cargarDatos()">Generar Grafico</a>
        </div>
    </form>
</div>

<div id="graf" class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <canvas id="grafico" width="400" height="150"></canvas>
</div>


<script>
    $(function () {
        cargarDatos();
    });

    function cargarDatos() {
        if (validar()) {
            var desde = document.getElementById("fecha_desde").value;
            var hasta = document.getElementById("fecha_hasta").value;
            var url_json = '../Servlet/administrarProducto.php?accion=OBTENER_N_PRODUCTOS_MAS_VENDIDOS_ENTRE_FECHAS&cantidad=10&fecha_desde=' + desde + '&fecha_hasta=' + hasta;
            
            $.getJSON(
                    url_json,
                    function (datos) {
                        document.getElementById("graf").style.display = 'block';
                        var ctx = document.getElementById("grafico").getContext('2d');
                        var grafico = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: datos.labels,
                                datasets: [{
                                        label: 'Productos',
                                        data: datos.data,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                }
                            }
                        });

                    }
            );
        }else{
            document.getElementById("graf").style.display = 'none';
        }
    }

    function validar() {
        var desde = document.getElementById("fecha_desde").value;
        var hasta = document.getElementById("fecha_hasta").value;

        if (desde == "" || desde == null) {
            document.getElementById("fecha_desde").focus();
            notificacion("Debe ingresar una fecha desde", 'warning', 'alert');
            return false;
        } else if (hasta == "" || hasta == null) {
            document.getElementById("fecha_hasta").focus();
            notificacion("Debe ingresar una fecha hasta", 'warning', 'alert');
            return false;
        } else if (desde > hasta) {
            document.getElementById("fecha_desde").focus();
            notificacion("La 'fecha desde' no puede ser mayor a la 'fecha hasta'", 'warning', 'alert');
            return false;
        }
        return true;
    }

</script>

<?php include("footer.php"); ?>