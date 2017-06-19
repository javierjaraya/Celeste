

function notificacion(mensaje, tipo, contenedor) {
    $("#"+contenedor).css("display", "block");
    var class_alert = "alert-info";
    var icon_alert = 'fa-info';
    if (tipo == 'danger') {
        class_alert = "alert-danger";
        icon_alert = 'fa-ban';
    } else if (tipo == 'info') {
        class_alert = "alert-info";
        icon_alert = 'fa-info';
    } else if (tipo == 'success') {
        class_alert = "alert-success";
        icon_alert = 'fa-check';
    } else if (tipo == 'warning') {
        class_alert = "alert-warning";
        icon_alert = 'fa-warning';
    }
    var alert = "<div class='alert "+class_alert+" alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa "+icon_alert+"'></i> Alert!</h4>"+mensaje+"</div>"
    $("#"+contenedor).html(alert);
    $("#"+contenedor).delay(5000).hide(600);
}