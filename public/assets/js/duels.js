var conn;
var isOnQuiz = false;
var lookingForDuelCounter;
var lookingForDuelTimerCount;
var acceptingDuelCounter;
var acceptingDuelTimmerCount;
$(function () {
    if (courseID && userID) {

        conn = new WebSocket('ws://localhost:8000');
        conn = new WebSocket('ws://ticademia.medellin.unal.edu.co:8000');
        //conn.onopen = function (e) {
            if(userIsStudent){
                init();
            }else{
                initTutor();
            }

        };

        conn.onmessage = function (e) {
            data = JSON.parse(e.data);

            switch (data.action) {
                case "updateTotalUsersOnline":
                    document.getElementById("totalUsersOnline").innerHTML = data.totalUsersOnline;
                    break;
                case "showNotification":
                    showNotification(data);
                    break;
                case "askForDuel":
                    askForDuel(data);
                    break;
                case "setDuel":
                    setDuel(data);
                    break;
                case "closeAllModals":
                    closeAllModals();
                    break;
            }
        };
    }
});

function init() {
    var data = {
        action: 'init',
        courseID: courseID,
        userID: userID
    };

    conn.send(JSON.stringify(data));
}

function initTutor() {
    var data = {
        action: 'initTutor',
        courseID: courseID,
        userID: userID
    };
    conn.send(JSON.stringify(data));
}

function getDuel() {


    lookingForDuelTimerCount = 30;
    $("#time-getting-duel").html(lookingForDuelTimerCount);
    clearInterval(lookingForDuelCounter);
    lookingForDuelCounter = setInterval(lookingForDuelTimer, 1000);


    $("#modal-finding-opponent").modal({
        keyboard: false,
        backdrop: 'static'
    });

    var data = {
        action: 'getDuel',
        courseID: courseID,
        userID: userID
    };

    conn.send(JSON.stringify(data));
}
function showNotification(data) {
    closeAllModals();

    $("#modal-body-duel-notification").html(data.message);
    $("#modal-duel-notification").modal({
        keyboard: false,
        backdrop: 'static'
    });
}

function askForDuel(data) {
    closeAllModals();

    if ($("#iframe_exam").is(":visible")) {
        isOnQuiz = true;
        $("#note-ask-for-duel").removeClass("hide");
    } else {
        isOnQuiz = false;
        $("#note-ask-for-duel").addClass("hide");
    }

    acceptingDuelTimmerCount = 29;
    $("#time-accepting-duel").html(acceptingDuelTimmerCount);
    clearInterval(acceptingDuelCounter);
    acceptingDuelCounter = setInterval(acceptingDuelTimer, 1000);

    var askDuelElLa = data.defiantUserGender == 'm' ? 'el' : 'la';
    $("#ask-duel-el-la").html(askDuelElLa);
    $("#avatar-defiant-user").attr("src", data.defiantUserAvatar);
    $("#ask-duel-defiant-name").html(data.defiantUserFullName);
    $("#modal-ask-duel").modal({
        show: true,
        keyboard: false,
        backdrop: 'static'
    });
}
function cancelDuel() {
    closeAllModals();

    var data = {
        action: 'cancelDuel',
        courseID: courseID,
        userID: userID
    };

    conn.send(JSON.stringify(data));
}
function cancelDuelTimeOff() {
    clearInterval(lookingForDuelCounter);
    if ($("#modal-finding-opponent").is(":visible")) {

        closeAllModals();

        var data = {
            action: 'cancelDuelTimeOff',
            courseID: courseID,
            userID: userID
        };

        conn.send(JSON.stringify(data));
    }
}

function rejectDuel() {
    var data = {
        action: 'rejectDuel',
        courseID: courseID,
        userID: userID
    };

    conn.send(JSON.stringify(data));
}
function acceptDuel() {
    if (isOnQuiz) {
        deleteQuizAttempt();
        closeOpenQuiz();
    }

    var data = {
        action: 'acceptDuel',
        courseID: courseID,
        userID: userID
    };

    conn.send(JSON.stringify(data));
}
function setDuel(data) {
    closeAllModals();
    evaluacionOReto = "reto";

    var quizPath = data.quizPath;

    $("#iframe-duel-quiz").attr("src", quizPath);
    $('#iframe-duel-container').removeClass('hide');

    $('#iframe-duel-container .panel').addClass('animated bounceInRight');

}

function answerQuizDuel(quizStatus) {

    closeAllModals();

    var data = {
        action: 'answerQuizDuel',
        courseID: courseID,
        userID: userID,
        quizStatus: quizStatus
    };

    conn.send(JSON.stringify(data));
}

function closeAllModals() {
    $('.modal.in').modal('hide');

    if ($('#iframe-duel-container').is(':visible')) {
        setTimeout(function () {
            $('#iframe-duel-container').addClass('hide');
            $('#iframe-duel-container .panel').removeClass('animated bounceOutRight');
        }, 600);
        $('#iframe-duel-container .panel').removeClass("bounceInRight").addClass('animated bounceOutRight');
    }
}

function closeOpenQuiz() {
    setTimeout(function () {
        $('#iframe-container').addClass('hide');
        $('#iframe-container .panel').removeClass('animated bounceOutRight');
    }, 600);
    $('#iframe-container .panel').removeClass("bounceInRight").addClass('animated bounceOutRight');
}
function deleteQuizAttempt() {
    $.ajax({
        url: base_url + "/SCORM/delete-attempt",
        method: "post",
        data: {
            quiz_id: idEvaluacion
        }, success: function (data) {

        }
    });
}

function lookingForDuelTimer() {
    lookingForDuelTimerCount--;
    if (lookingForDuelTimerCount <= 0) {
        cancelDuelTimeOff();
        return;
    }
    $("#time-getting-duel").html(lookingForDuelTimerCount);
}

function acceptingDuelTimer() {
    acceptingDuelTimmerCount--;
    if (acceptingDuelTimmerCount <= 0) {
        clearInterval(acceptingDuelCounter);
        return;
    }
    $("#time-accepting-duel").html(acceptingDuelTimmerCount);
}