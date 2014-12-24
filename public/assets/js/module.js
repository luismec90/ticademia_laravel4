$(function () {
    $('#quizzes-div .quiz-launcher').click(function () {
        $('#panel-iframe-title').html('Pregunta 1');
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

        $('#panel-video-title').html('Video 1');

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
        }, 600);

    });

});
/*
sublime.load();
sublime.ready(function () {
    var player = sublime.player('my_video_player');
    player.on({
        start: function (player) {
            console.log('playback started.')
        },
        end: function (player) {
            console.log('playback ended.')
        }
    });
});
    */