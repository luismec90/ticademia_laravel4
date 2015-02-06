var conn;
var courseID = 1;
var userID = 5;
var userID = Math.floor((Math.random() * 1000) + 1);
$(function () {
    conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function (e) {
        console.log("Connection established!");
        console.log("Current user: "+userID);

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
    var data = {
        action: 'getDuel',
        courseID: courseID,
        userID: userID
    };

    conn.send(JSON.stringify(data));
}
function showNotification(data) {
    $("#modal-body-duel-notification").html(data.message);
    $("#modal-duel-notification").modal();
}
function setDuel(data) {
    var opponentUserID = data.defiantUserID == userID ? data.opponentUserID : data.defiantUserID;
    $("#modal-body-duel-notification").html("Tu oponente es el usuario " + opponentUserID);
    $("#modal-duel-notification").modal();
}