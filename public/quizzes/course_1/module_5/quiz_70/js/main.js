var a, b;

$(function () {
    try {
        API = getAPI();
        API.LMSInitialize("");
    } catch (e) {
        console.log(e);
    }

    a = getRandomFrom([9, 25, 49, 81]);
    b = getRandomFrom([9, 25, 49, 81]);
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
    var answers = ['(x<sup>1 / ' + a + '</sup> + y<sup>1 / ' + b + '</sup>)(x<sup>1 / ' + a + '</sup> - y<sup>1 / ' + b + '</sup>)',
        '(x<sup>1 / ' + a + '</sup> - y<sup>1 / ' + b + '</sup>)(x<sup>1 / ' + a + '</sup> - y<sup>1 / ' + b + '</sup>)',
        '(x<sup>1 / ' + a + '</sup> - y<sup>2 / ' + b + '</sup>)(x<sup>1 / ' + a + '</sup> - y<sup>2 / ' + b + '</sup>)',
        '(x<sup>2 / ' + a + '</sup> - y<sup>1 / ' + b + '</sup>)(x<sup>2 / ' + a + '</sup> - y<sup>1 / ' + b + '</sup>)',
        '(x<sup>1 / ' + a + '</sup> - y<sup>1 / ' + b + '</sup>)<sup>2</sup>',
        '(x<sup>1 / ' + Math.sqrt(a) + '</sup> + y<sup>1 / ' + Math.sqrt(b) + '</sup>)(x<sup>1 / ' + Math.sqrt(a) + '</sup> - y<sup>1 / ' + Math.sqrt(b) + '</sup>)',
        '(x<sup>1 / ' + Math.sqrt(a) + '</sup> - y<sup>1 / ' + Math.sqrt(b) + '</sup>)(x<sup>1 / ' + Math.sqrt(a) + '</sup> - y<sup>1 / ' + Math.sqrt(b) + '</sup>)',
        '(x<sup>1 / ' + Math.sqrt(a) + '</sup> - y<sup>2 / ' + Math.sqrt(b) + '</sup>)(x<sup>1 / ' + Math.sqrt(a) + '</sup> - y<sup>2 / ' + Math.sqrt(b) + '</sup>)',
        '(x<sup>2 / ' + Math.sqrt(a) + '</sup> - y<sup>1 / ' + Math.sqrt(b) + '</sup>)(x<sup>2 / ' + Math.sqrt(a) + '</sup> - y<sup>1 / ' + Math.sqrt(b) + '</sup>)',
        'Ninguna de las opciones'
    ];
    var is = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    shuffleArray(is);
    var i = 0;
    while (i < 10) {
        $("#label" + (i + 1)).html(answers[is[i]]);
        if (is[i] == 0)
            correct = i + 1;
        i++;
    }

    $('.mvar[value=a]').html(a);
    $('.mvar[value=b]').html(b);
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