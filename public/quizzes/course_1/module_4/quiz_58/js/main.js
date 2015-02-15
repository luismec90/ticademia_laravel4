var a, b, ab, axb;

$(function () {
    try {
        API = getAPI();
        API.LMSInitialize("");
    } catch (e) {
        console.log(e);
    }

    a = getRandomFrom([-11,-7,-5,5,7,11]);
    b = getRandomFrom([-11,-7,-5,5,7,11]);
    c = getRandom(2,4);
    d = getRandom(6,9);

   // console.log(a + " " + b + " " + c + " " + d);
    //var missConception1 = n;
    //console.log(correctAnswer + " " + missConception1);
    draw();

    $("#verificar").click(function () {
        var valor1 = $("#answer1").val().trim();
        var valor2 = $("#answer2").val().trim();
        var valor3 = $("#answer3").val().trim();
        var valor4 = $("#answer4").val().trim();
        if (valor1 != "" && valor2 != "") {
            $("#correcto").addClass("hide");
            $("#feedback").addClass("hide");
            var calificacion = 0;
            var feedback = "";
            valor1 = parseFloat(valor1);
            valor2 = parseFloat(valor2);

            if ((valor1 == c && valor2 == a && valor3 == d && valor4 == b) || (valor1 == d && valor2 == b && valor3 == c && valor4 == a)) {
                calificacion = 1.0;
                $("#correcto").html("Calificación: <b>" + calificacion + "</b>").removeClass("hide");
            } else {
                calificacion = 0.0;
                $("#feedback").html("Calificación: <b>" + calificacion + "</b> <br> ...").removeClass("hide");
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
function getRandom(bottom, top) {
    return Math.floor(Math.random() * (1 + top - bottom)) + bottom;
}
function getRandomFrom(vals) {
    return vals[getRandom(0, vals.length - 1)];
}
function draw() {
    $('.mvar[value=cd]').html(c * d);
    var cxbaxd = c * b + a * d;
    if (cxbaxd > 0)
        $('.mvar[value=cxbaxd]').html("+ " + cxbaxd);
    else
        $('.mvar[value=cxbaxd]').html("- " + (cxbaxd*-1));

    var axb = a * b;
    if (axb > 0)
        $('.mvar[value=axb]').html("+ " + axb);
    else
        $('.mvar[value=axb]').html("- " + (axb*-1));


}
function getRandomUnion(bottom, top, avoidLeft, avoidRight) {
    while (true) {
        var r = Math.floor(Math.random() * (1 + top - bottom)) + bottom;
        if (r <= avoidLeft || r >= avoidRight)
            return r;
    }
}