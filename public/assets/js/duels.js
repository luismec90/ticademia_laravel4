var conn;
var courseID = 1;
var userID = 5;
var userID = Math.floor((Math.random() * 1000) + 1);
$(function () {
    conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function (e) {
        console.log("Connection established!");
        console.log("Current user: " + userID);

        init();
    };

    conn.onmessage = function (e) {
        data = JSON.parse(e.data);
        console.log(data);

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

    $("#modal-body-ask-duel").html("El usuario " + data.defiantUserID + " te ha retado un duelo, deseas aceptar? ");
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

    var opponentUserID = data.defiantUserID == userID ? data.opponentUserID : data.defiantUserID;
    $("#opponent-id").html(opponentUserID);
    $("#modal-show-duel-quiz").modal({
        keyboard: false,
        backdrop: 'static'
    });
}

function answerQuizDuel() {
    closeAllModals();

    var quizStatus = $("#input-show-duel-quiz").val() == 4 ? "correct" : "wrong";

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
}