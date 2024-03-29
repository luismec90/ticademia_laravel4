var t;

$(function() {
    try{
        API = getAPI();
        API.LMSInitialize("");
    }catch(e){
        console.log(e);
    }

    t = getRandom(48,100);

    var correctAnswer1 = 50*t;
    draw();

    $("#verificar").click(function() {
        var valor1 = $("#answer1").val().trim(); valor1 = ((valor1.split(",")).length == 2) ? valor1.replace(",", ".") : valor1;
        if (valor1 != "") {
            $("#correcto").addClass("hide");
            $("#feedback").addClass("hide");
            var calificacion = 0;
            var feedback = "";
            valor1 = parseFloat(valor1);
            if (Math.abs(valor1 - correctAnswer1)<0.006) {
                    calificacion = 1.0;
                    $("#correcto").html("Calificación: <b>" + calificacion + "</b>").removeClass("hide");
            }else{
                    calificacion = 0.0;
                    $("#feedback").html("Calificación: <b>" + calificacion + "<br/><br/> ...").removeClass("hide");
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
    $("#aceptar").click(function() {
        window.parent.location.reload();
    });
    $('#modal').on('hide.bs.modal', function(e) {
        window.parent.location.reload();
    });

});
function getRandom(bottom, top) {
    return Math.floor(Math.random() * (1 + top - bottom)) + bottom;
}
function draw(){
    $('.mvar[value=x]').html(9*t);
}
function toRadians(angle) {
    return angle * (Math.PI / 180);
}
