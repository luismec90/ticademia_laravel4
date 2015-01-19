<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">


    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<script>
    var courseID = 1;
    var userID = Math.floor((Math.random() * 1000) + 1);

    var conn = new WebSocket('ws://localhost:8080');

    conn.onopen = function (e) {
        console.log("Connection established!");

        var data = {
            'action': 'init',
            'courseID': courseID,
            'userID': userID
        };
        conn.send(JSON.stringify(data));
    };

    conn.onmessage = function (e) {
        console.log(e.data);
    };

    function getDuel() {
        var data = {
            'action': 'getDuel',
            'courseID': courseID,
            'userID': userID
        };
        conn.send(JSON.stringify(data));
    }

</script>
</body>
</html>