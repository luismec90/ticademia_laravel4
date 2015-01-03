API = new Object();
API.LMSInitialize = function (a) {

    if (evaluacionOReto == "evaluacion" && rolGlobal == 1) {
        $.ajax({
            url: base_url + "/SCORM/LMSInitialize",
            method: "post",
            data: {
                param1: a,
                quiz_id: idEvaluacion
            },
            success: function (data) {
                console.log(data)
            }
        });
    }
}
API.LMSFinish = function (a) {
    if (evaluacionOReto == "evaluacion" && rolGlobal == 1) {
        $.ajax({
            url: base_url + "/SCORM/LMSFinish",
            method: "post",
            data: {
                param1: a
            },
            success: function (data) {
            }
        });
    }
}
API.calificar = function (calificacion, feedback) {
    if (evaluacionOReto == "evaluacion") {
        coverOn();
        $.ajax({
            url: base_url + "/SCORM/grade",
            method: "post",
            data: {
                quiz_id: idEvaluacion,
                grade: calificacion,
                feedback: feedback
            },
            success: function (data) {
                coverOff();
                if (evaluacionOReto == "evaluacion") {
                    $('#btn-close-iframe').trigger('click');
                }
                setTimeout(function () {
                    $("#modal-body-quiz-attempt-feedback").html(data);
                    $("#modal-quiz-attempt-feedback").modal();
                }, 700);

            }
        });
    }

}
API.LMSSetValue = function (a, b) {
    if (evaluacionOReto == "evaluacion" && rolGlobal == 1) {
        $.ajax({
            url: base_url + "/SCORM/LMSSetValue",
            method: "post",
            data: {
                param1: a,
                param2: b
            },
            success: function (data) {
            }
        });
    }
}
API.notifyDaemon = function (calificacion) {

    if (evaluacionOReto == "reto") {
        if (calificacion == 1) {
            var status = "correcto";
        } else {
            var status = "incorrecto";
        }
        var data = {
            tipo: 'enviar_respuesta',
            id_curso: idCursoGlobal,
            posible_ganador: idUsuarioGlobal,
            nombre_usuario: nombreUsuarioGlobal,
            estatus: status,
            fecha_inicio_reto: fechaInicioReto,
            fecha_fin_reto: date_to_server_date(new Date())
        };
        conn.send(JSON.stringify(data));
    }
}
API.closeQuestion = function () {
    /*if (evaluacionOReto == "evaluacion") {
     $('#btn-close-iframe').trigger('click');
     }*/
}
 