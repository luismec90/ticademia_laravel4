<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/flick/jquery-ui.css">
    {{ HTML::style('assets/libs/slider-pips/css/jquery-ui-slider-pips.css') }}

    <script src="https://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    {{ HTML::script('assets/libs/slider-pips/js/jquery-ui-slider-pips.js') }}
</head>

<body>
<div class="slider"></div>
<script>

    $("#modules-slider").slider({ max: 50, value: 10 })
            .slider("pips");
</script>
</body>
</html>