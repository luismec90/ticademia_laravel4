sublime.load();

$(function () {

    $('#quizzes-div .quiz-launcher').click(function () {
        evaluacionOReto = "evaluacion";

        var name = "Evaluación  " + $(this).attr("data-order");
        var url = $(this).attr("data-url");
        idEvaluacion = $(this).attr("data-evaluacion-id");

        $('#panel-iframe-title').html(name);
        $("#iframe_exam").attr("src", url);
        $('#iframe-container').removeClass('hide');

        $('#iframe-container .panel').addClass('animated bounceInRight');
    });
    $('#btn-close-iframe').click(function () {
        setTimeout(function () {
            $('#iframe-container').addClass('hide');
            $('#iframe-container .panel').removeClass('animated bounceOutRight');
        }, 600);
        $('#iframe-container .panel').removeClass("bounceInRight").addClass('animated bounceOutRight');
    });

    $('#materials-div .video-launcher').click(function () {

        var name = $(this).attr("data-name");
        var url = $(this).attr("data-url");

        $('#panel-video-title').html(name);
        sublime.unprepare('my_video_player');
        $("#my_video_player").attr("data-youtube-id", url);
        sublime.prepare('my_video_player');
        sublime('my_video_player').play();
        $('#video-container').removeClass('hide');
        $('#video-container .panel').addClass('animated bounceInRight');
        setTimeout(function () {
            $('#video-container .panel').removeClass('animated bounceInRight');

        }, 1300);

    });

    $('#btn-close-video').click(function () {

        $('#video-container .panel').addClass('animated bounceOutRight');
        setTimeout(function () {
            $('#video-container').addClass('hide');
            $('#video-container .panel').removeClass('animated bounceOutRight');
            sublime('my_video_player').stop();
        }, 600);

    });

});



