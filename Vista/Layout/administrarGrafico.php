<?php include("header.php"); ?>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>Productos mas vendidos</strong></h4>
</div>

<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <canvas id="myChart" width="400" height="150"></canvas>
</div>


<script>
    $(function () {
        //cargarCompras();
    });

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
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



    function cargarDatos() {
        $("#comprasRecientes").empty();
        var url_json = '../Servlet/administrarCompra.php?accion=LISTADO';
        $.getJSON(
                url_json,
                function (datos) {
                    $.each(datos, function (k, v) {
                        var contenido = "<tr>";
                        contenido += "<td>" + v.idCompra + "</td>";
                        contenido += "<td>" + v.fechaCompra + "</td>";
                        contenido += "<td>" + v.estado + "</td>";
                        contenido += "<td>";
                        if (v.estado == "Procesando") {
                            contenido += "<a class='btn btn-danger btn-xs glyphicon glyphicon-trash'  onclick='borrar(" + v.idCompra + ")'><strong>Anular Compra</strong></a>&nbsp;";
                        } else {
                            contenido += "<a class='btn btn-info btn-xs glyphicon glyphicon-edit'  onclick='editar(" + v.idCompra + ")'><strong>Cambiar Estado</strong></a>&nbsp;";
                        }
                        contenido += "<a class='btn btn-warning btn-xs glyphicon glyphicon-search'  onclick='ver(" + v.idCompra + ")'><strong>Ver detalles</strong></a>";

                        contenido += "</td>";
                        contenido += "</tr>";
                        $("#comprasRecientes").append(contenido);
                    });
                    
                }
        );
    }
    
</script>

<?php include("footer.php"); ?>