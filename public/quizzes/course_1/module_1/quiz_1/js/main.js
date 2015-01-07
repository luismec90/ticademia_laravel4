var a, b, x, l1;

$(function () {
    API = getAPI();
    API.LMSInitialize("");


    var correctAnswer = 2;
    var missConception1 = 3;


    $("#verificar").click(function () {
        var valor = $("#answer").val().trim();
        valor = ((valor.split(",")).length == 2) ? valor.replace(",", ".") : valor;
        if (valor != "") {
            $("#correcto").addClass("hide");
            $("#feedback").addClass("hide");
            var calificacion = 0;
            var feedback = "";
            valor = parseFloat(valor);
            switch (valor) {
                case correctAnswer:
                    calificacion = 1.0;
                    $("#correcto").html("Calificación: <b>" + calificacion + "</b>").removeClass("hide");
                    break;
                case missConception1:
                    calificacion = 0.5;
                    feedback = "Mensaje de retroalimentacion para el error conceptual 1";
                    $("#feedback").html("Calificación: <b>" + calificacion + "</b> <br> Probablemente no tienes clara la teoria de triangulos").removeClass("hide");
                    break;
                default:
                    calificacion = 0.0;
                    $("#feedback").html("Calificación: <b>" + calificacion + "</b> <br>Te recomendamos este <a href='https://www.youtube.com/watch?v=CA1jtq4luMo' target='_blank'>video</a> acerca de triangulos.").removeClass("hide");
                    break;
            }
            $(this).attr("disabled", true);
            API.closeQuestion();
            if (typeof API.calificar == 'function') {
                API.calificar(calificacion, feedback);
            }
            API.LMSSetValue("cmi.core.score.raw", calificacion);
            API.LMSFinish("feedback", feedback);
            API.notifyDaemon(calificacion);
        }
    });
    $("#aceptar").click(function () {
        window.parent.location.reload();
    });
    $('#modal').on('hide.bs.modal', function (e) {
        window.parent.location.reload();
    });

});
