var conn;
var courseID=1;
var userID = 5; //Math.floor((Math.random() * 1000) + 1);
$(function () {
    conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function (e) {
        console.log("Connection established!");

        init();
    };


    conn.onmessage = function (e) {
        data = JSON.parse(e.data);
        console.log(data);

        switch (data.action) {
            case "updateTotalUsersOnline":
                document.getElementById("totalUsersOnline").innerHTML = data.totalUsersOnline;
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