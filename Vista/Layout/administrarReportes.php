<?php include("header.php"); ?>
<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>REPORTES DE VENTAS CONCRETADAS</strong></h4>
</div>
<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <h5><strong>Seleccione el tipo de reporte:</strong></h5>
    <hr style="border: orangered 1px solid;">
    <div id="alert"></div>
    <form name="fm-reporte" class="form-horizontal" method="POST">    
        <div class="form-group">
            <div class="alert"></div>
            <label class="col-sm-4 control-label" for="tipoReporte">Tipo Reporte: </label>
            <div class="col-sm-5">
                <select class="form-control" style="text-align: center" onclick="HabilitarInput()" name="tipoReporte" id="tipoReporte">
                    <option value="-1" >Seleccionar.....</option>
                    <option value="1" >Reporte Diario</option>
                    <option value="2">Reporte Mensual</option>
                    <option value="3">Reporte Anual</option>
                </select>
            </div>
        </div>
        <div class="form-group" id="grupoDiario" style="display: none">
            <label class="col-sm-4 control-label" for="dia">Seleccione el Día: </label>
            <div class="col-sm-5">
                <input class="form-control" type="date" name="dia" id="dia" value="" onchange="generarReporteDiario()" />
            </div>
        </div>
        <div class="form-group" id="grupoAno"  style="display: none">
            <label class="col-sm-4 control-label" for="ano">Ingrese el Año: </label>
            <div class="col-sm-5">
                <input class="form-control" type="number" size="4" maxlength="4" min="2010" id="ano" placeholder="AAAA" name="ano" value="" onchange="generarReporteAnual()"/>
            </div>
        </div>
        <div class="form-group" id="grupoMes"  style="display: none">
            <label class="col-sm-4 control-label" for="mes">Seleccione el Mes: </label>
            <div class="col-sm-5">
                <input class="form-control" type="month" name="mes" id="mes" value="" onchange="generarReporteMensual()"/>
            </div>
        </div>
        <br>
        <div class="form-group" style="text-align: center; display: none" id="botonAno">
            <button type="button" class="btn btn-warning" onclick="generarReporteAnual()">Generar Reporte</button>
        </div>
    </form>
</div>
<script>

    function HabilitarInput() {
        var tipo = document.getElementById('tipoReporte').value;
        if (tipo == 1) {
            document.getElementById('grupoDiario').style.display = "block";
            document.getElementById('grupoAno').style.display = "none";
            document.getElementById('grupoMes').style.display = "none";
            document.getElementById('botonAno').style.display = "none";
        } else if (tipo == 2) {
            document.getElementById('grupoMes').style.display = "block";
            document.getElementById('grupoDiario').style.display = "none";
            document.getElementById('grupoAno').style.display = "none";
            document.getElementById('botonAno').style.display = "none";
        } else if (tipo == 3) {
            document.getElementById('grupoAno').style.display = "block";
            document.getElementById('grupoMes').style.display = "none";
            document.getElementById('grupoDiario').style.display = "none";
            document.getElementById('botonAno').style.display = "block";
        } else {
            document.getElementById('grupoAno').style.display = "none";
            document.getElementById('grupoMes').style.display = "none";
            document.getElementById('grupoDiario').style.display = "none";
            document.getElementById('botonAno').style.display = "none";
        }
    }
    function generarReporteDiario() {
        var fechaReporte = $("#dia").val();
        var f = new Date();
        var mes = (f.getMonth() + 1);
        if (mes < 10) {
            mes = "0" + (f.getMonth() + 1);
        }
        var dia = f.getDate();
        if (dia < 10) {
            dia = "0" + (f.getDate());
        }
        var fechaActual = dia + "/" + mes + "/" + f.getFullYear();
        
        var info = fechaReporte.split('-');
        var fechaOrdenada = info[2] + '/' + info[1] + '/' + info[0];
        window.open("generarReporteDiario.php?" + "&fechaReporte=" + fechaReporte + "&fechaActual=" + fechaActual+"&fechaOrdenada="+fechaOrdenada);
    }
    function generarReporteMensual() {
        var fechaReporte = $("#mes").val();
        var fechaFormateada = convertDateFormat(fechaReporte);
        var f = new Date();
        var mes = (f.getMonth() + 1);
        if (mes < 10) {
            mes = "0" + (f.getMonth() + 1);
        }
        var dia = f.getDate();
        if (dia < 10) {
            dia = "0" + (f.getDate());
        }
        var fechaActual = dia + "/" + mes + "/" + f.getFullYear();
        window.open("generarReporteMensual.php?" + "&fechaReporte=" + fechaReporte + "&fechaActual=" + fechaActual + "&fechaFormateada=" + fechaFormateada);
    }
    function convertDateFormat(fechaReporte) {
        var string = fechaReporte.split('-');
        var meses = new Array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
        var fechaConvertida = meses[string[1] - 1] + ' DE ' + string[0];
        return fechaConvertida;
    }
    function generarReporteAnual() {
        var fechaReporte = $("#ano").val();
        if (fechaReporte != null && fechaReporte != "") {
            var f = new Date();
            var mes = (f.getMonth() + 1);
            if (mes < 10) {
                mes = "0" + (f.getMonth() + 1);
            }
            var dia = f.getDate();
            if (dia < 10) {
                dia = "0" + (f.getDate());
            }
            var fechaActual = dia + "/" + mes + "/" + f.getFullYear();
            window.open("generarReporteAnual.php?" + "&anoReporte=" + fechaReporte + "&fechaActual=" + fechaActual);
        } else {
            notificacion('Debe ingresar un año', 'warning', 'alert');
        }
    }
</script>
<?php include("footer.php"); ?>