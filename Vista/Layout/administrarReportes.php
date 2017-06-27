<?php include("header.php"); ?>
<div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
    <h4 class="TextoTituloFormulario"><strong>REPORTES DE VENTAS</strong></h4>
</div>
<div class="col-md-12" id="subContenedor" style=" padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
    <h5><strong>Seleccione el tipo de reporte:</strong></h5>
    <hr style="border: orangered 1px solid;">
    <div id="alert"></div>
    <form name="fm-reporte" class="form-horizontal" method="POST">    
        <div class="form-group">
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
                <input class="form-control" type="number" size="4" maxlength="4" min="2010" id="ano" name="ano" value="" onchange="generarReporteAnual()"/>
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
        <!--        <div class="form-group">
                    <label class="col-sm-2 control-label" for="runUsuario">Desde: </label>
                    <div class="col-sm-4">
                        <input class="form-control" type="date" name="fecha" value="" />
                    </div>
                    <label class="col-sm-2 control-label" for="runUsuario">Hasta: </label>
                    <div class="col-sm-4">
                        <input class="form-control" type="date" name="fecha" value="" />
                    </div>
                </div>-->
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
        var fechaActual = f.getFullYear() + "-" + mes + "-" + dia;
        //console.log('fechaActual'+fechaActual+'fechaReporte'+fechaReporte);
        window.open("generarReporteDiario.php?" + "&fechaReporte=" + fechaReporte + "&fechaActual=" + fechaActual);
    }
    function generarReporteMensual() {
        var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
       
        var fechaReporte = $("#mes").val();
         var mesReporte ;
        var f = new Date();
        var mes = (f.getMonth() + 1);
        if (mes < 10) {
            mes = "0" + (f.getMonth() + 1);
        }
        var dia = f.getDate();
        if (dia < 10) {
            dia = "0" + (f.getDate());
        }
        var fechaActual = f.getFullYear() + "-" + mes + "-" + dia;
       console.log('mesReporte' + mesReporte + 'fechaReporte' + fechaReporte);
        //window.open("generarReporteMensual.php?" + "&fechaReporte=" + fechaReporte + "&fechaActual=" + fechaActual);
    }
    function generarReporteAnual() {
        var fechaReporte = $("#ano").val();
        var f = new Date();
        var mes = (f.getMonth() + 1);
        if (mes < 10) {
            mes = "0" + (f.getMonth() + 1);
        }
        var dia = f.getDate();
        if (dia < 10) {
            dia = "0" + (f.getDate());
        }
        var fechaActual = f.getFullYear() + "-" + mes + "-" + dia;
        window.open("generarReporteAnual.php?" + "&anoReporte=" + fechaReporte + "&fechaActual=" + fechaActual);
    }
</script>
<?php include("footer.php"); ?>