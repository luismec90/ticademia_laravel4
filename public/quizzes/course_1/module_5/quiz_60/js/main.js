var a;

$(function () {
    try {
        API = getAPI();
        API.LMSInitialize("");
    } catch (e) {
        console.log(e);
    }

    a = getRandom(1, 9);
    //console.log(correctAnswer + " " + missConception1);
    var correctAnswer = draw();

    $("#verificar").click(function () {
        var valor = $("input[name=answer]:checked").val().trim();
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
                default:
                    calificacion = 0.0;
                    $("#feedback").html("Calificación: <b>" + calificacion + "</b> <br> ...").removeClass("hide");
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
function getRandom(bottom, top) {
    return Math.floor(Math.random() * (1 + top - bottom)) + bottom;
}
function getRandomFrom(vals) {
    return vals[getRandom(0, vals.length - 1)];
}
function draw() {
    var correct = 0;
    var answers = ['<span class="fraccion"><span>' + (2 * a) + '</span><span>x<sup>2</sup> - ' + (a * a) + '</span></span>',
        '0',
        '<span class="fraccion"><span>' + (2 * a) + '</span><span>(x + ' + a + ')<sup>2</sup></span></span>',
        '<span class="fraccion"><span>' + (2 * a) + '</span><span>x<sup>2</sup> - ' + (-2 * a + a * a) + '</span></span>',
        '<span class="fraccion"><span>' + (2 * a) + '</span><span>' + (a * a) + ' -x<sup>2</sup></span></span>',
        '<span class="fraccion"><span>' + (a) + '</span><span>(x - ' + (a) + ')<sup>2</sup></span></span>',
        '<span class="fraccion"><span>' + (a) + '</span><span>x<sup>2</sup> - ' + (a * a) + '</span></span>',
        'Ninguna de las opciones',
    ];
    var is = [0, 1, 2, 3, 4, 5, 6, 7];
    shuffleArray(is);
    var i = 0;
    while (i < 8) {
        $("#label" + (i + 1)).html(answers[is[i]]);
        if (is[i] == 0)
            correct = i + 1;
        i++;
    }

    $('.mvar[value=a]').html(a);
    return correct;
}

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}