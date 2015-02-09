var conn;

$(function () {
    if (courseID && userID && userIsStudent) {
        conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function (e) {
            init();
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


function getDuel() {
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
function rejectDuel() {
    var data = {
        action: 'rejectDuel',
        courseID: courseID,
        userID: userID
    };

    conn.send(JSON.stringify(data));
}
function acceptDuel() {
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
    // var opponentUserID = data.defiantUserID == userID ? data.opponentUserID : data.defiantUserID;
    var quizPath = data.quizPath;

    $("#iframe-duel-quiz").attr("src", quizPath);
    $('#iframe-duel-container').removeClass('hide');

    $('#iframe-duel-container .panel').addClass('animated bounceInRight');

    /* $("#opponent-id").html(opponentUserID);
     $("#modal-show-duel-quiz").modal({
     keyboard: false,
     backdrop: 'static'
     });
     */
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

