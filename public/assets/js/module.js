var materialID;
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
        materialID = $(this).attr("data-id");
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
        var playbackTime = sublime('my_video_player').playbackTime();

        $.ajax({
            url: material_video_playbacktime_path,
            data: {
                materialID: materialID,
                playbackTime: playbackTime
            },
            method: 'POST'
        }).done(function (data) {
            //console.log(data);
        }).fail(function (data) {
            console.log('Error');
        });


        $('#video-container .panel').addClass('animated bounceOutRight');
        setTimeout(function () {
            $('#video-container').addClass('hide');
            $('#video-container .panel').removeClass('animated bounceOutRight');
            sublime('my_video_player').stop();
        }, 600);

    });

    $('#materials-div .create-review').click(function () {

        var name = $(this).attr("data-name");
        var materialID = $(this).attr("data-material-id");

        var reviewID = $(this).attr("data-material-review-id");
        var reviewRating = $(this).attr("data-material-review-rating");
        var reviewComment = $(this).attr("data-material-review-comment");

        $("#create-review-id").val(reviewID);
        $("#create-review-rating").val(reviewRating);
        $("#create-review-comment").val(reviewComment);

        $("#material-name").html(name);
        $("#material-id").val(materialID);
        $("#modal-create-review").modal();
    });


    $('#materials-div .show-reviews').click(function () {

        var name = $(this).attr("data-name");
        var materialID = $(this).attr("data-material-id");
        $("#modal-show-reviews-material-name").html(name);
        $("#modal-show-reviews").attr("data-material-id", materialID);

        getReviews(1);

        $("#modal-show-reviews").modal();
    });

    $("#modal-show-reviews").on('click', '.pagination a', function (e) {
        getReviews($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
});

function getReviews(page) {
    materialID = $("#modal-show-reviews").attr("data-material-id");
    $("#body-modal-show-reviews").html("");
    $.ajax({
        url: load_material_reviews_path + '/' + materialID + '?page=' + page,
        dataType: 'json'
    }).done(function (data) {
        $("#body-modal-show-reviews").html(data);
    }).fail(function () {
        console.log('Error');
    });
}



