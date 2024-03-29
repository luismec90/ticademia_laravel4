var materialID;
sublime.load();

$(function () {

    $("#body-module").on('click', '.quiz-launcher:not(.disabled)', function () {
        evaluacionOReto = "evaluacion";

        var name = "Ejercicio  " + $(this).attr("data-order");
        var url = $(this).attr("data-url");
        idEvaluacion = $(this).attr("data-evaluacion-id");

        $('#panel-iframe-title').html(name);
        $("#iframe_exam").attr("src", url);
        $('#iframe-container').removeClass('hide');

        $('#iframe-container .panel').addClass('animated bounceInRight');
    });
    $('#btn-close-iframe').click(function () {

        reloadModule();

        setTimeout(function () {
            $('#iframe-container').addClass('hide');
            $('#iframe-container .panel').removeClass('animated bounceOutRight');
        }, 600);
        $('#iframe-container .panel').removeClass("bounceInRight").addClass('animated bounceOutRight');
    });

    $("#body-module").on('click', '.video-launcher', function () {
        materialID = $(this).attr("data-id");
        launchVideo($(this).attr("data-name"), $(this).attr("data-url"));
    });

    $("#modal-quiz-attempt-feedback").on('click', '.video-launcher', function () {
        $("#modal-quiz-attempt-feedback").modal('hide');
        materialID = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var url = $(this).attr("data-url");
        setTimeout(function () {
            launchVideo(name, url);
        }, 500);
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
            var loadNotification = true;
            reloadModule(loadNotification);
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

    $("#body-module").on('click', '.create-review', function () {

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


    $("#body-module").on('click', '.show-reviews', function () {

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

    $("#body-module").on('click', '.skip-quiz', function () {
        var evaluacionID = $(this).attr("data-evaluacion-id");
        $("#skip-quiz-id").val(evaluacionID);
        $("#modal-skip-quiz").modal();
    })

    $("#body-module").on('click', '.edit-quiz', function () {
        var quizID = $(this).attr("data-quiz-id");
        var quizType = $(this).attr("data-quiz-type");
        var materials = $(this).attr("data-materials");
        $(".checkbox-materials").attr('checked', false);
        if (materials != '') {
            materials = materials.split(',');
            for (var i = 0; i < materials.length; i++) {
                var materialID = materials[i];
                $("#material-checkbox-" + materialID).attr('checked', true);
            }
        }
        $("#edit-quiz-id").val(quizID);
        $("#quizTypeID").val(quizType);
        $("#modal-edit-quiz").modal();
    });

    $("#body-module").on('mouseover', '.row-material', function () {
        var quizzes = $(this).attr('data-quizzes');
        if (quizzes != '') {
            quizzes = quizzes.split(',');
            for (var i = 0; i < quizzes.length; i++) {
                var quizID = quizzes[i];
                $("#quiz-id-" + quizID).addClass('rubberBand animated highlight-quiz');
            }
        }
    });
    $("#body-module").on('mouseleave', '.row-material', function () {
        var quizzes = $(this).attr('data-quizzes');
        if (quizzes != '') {
            quizzes = quizzes.split(',');
            for (var i = 0; i < quizzes.length; i++) {
                var quizID = quizzes[i];
                $("#quiz-id-" + quizID).removeClass('rubberBand animated highlight-quiz');
            }
        }
    });

    loadSlider();
    loadStarts();
    loadPopover();


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

function reloadModule(loadNotification) {
    $.ajax({
        dataType: 'json',
        method: 'post'
    }).done(function (data) {
        $("#body-module").html(data);
        if (loadNotification) {
            loadNotificaction();
        }
        loadStarts();
        loadPopover();
    }).fail(function () {
        console.log('Error');
    });
}
function loadSlider() {
    var saliderStpes = [];

    $.each(courseJSON['modules'], function (index, value) {
        saliderStpes.push(index + 1);
    });

    $("#modules-slider")

        // activate the slider with options
        .slider({
            min: 0,
            max: saliderStpes.length - 1,
            value: current_module - 1
        })

        // add pips with the labels set to "months"
        .slider("pips", {
            rest: "label",
            labels: saliderStpes
        }).slider("float", {
            handle: false,
            pips: true,
            prefix: 'Módulo ',
            labels: saliderStpes
        })

        // and whenever the slider changes, lets echo out the month
        .on("slidechange", function (e, ui) {
            $step = ui.value;
            var stateObj = {foo: "bar"};
            history.pushState(stateObj, "Módulo " + $step, courseJSON['modules'][$step]['id']);
            coverOn();
            window.location.href = courseJSON['modules'][$step]['id'];
        });
}
function loadStarts() {
    $('.estrellas').raty({
        path: raty_path + '/images',
        half: true,
        hints: ['Muy malo', 'Malo', 'Regular', 'Bueno', 'Excelente'],
        score: function () {
            return $(this).attr('data-score');
        },
        click: function (score, evt) {
            console.log(score);
            var name = $(this).attr("data-name");
            var materialID = $(this).attr("data-material-id");

            var reviewID = $(this).attr("data-material-review-id");
            var reviewRating = $(this).attr("data-material-review-rating");
            var reviewComment = $(this).attr("data-material-review-comment");
            var reviewAnonymous = $(this).attr("data-material-review-anonymous");

            $("#create-review-id").val(reviewID);
            $("#create-review-rating").val(reviewRating);
            $("#create-review-comment").val(reviewComment);

            if (reviewAnonymous == 1) {
                $("#anonymous-comment").attr("checked", "true");
            } else {
                $("#anonymous-comment").removeAttr("checked");
            }

            $("#material-name").html(name);
            $("#material-id").val(materialID);


            $("#rate_material_id").val(materialID);
            $("#rate_comment").val(reviewComment);

            $('#preview-stars').raty({
                path: raty_path + '/images',
                half: true,
                hints: ['Muy malo', 'Malo', 'Regular', 'Bueno', 'Excelente'],
                score: score
            });
            $("#modal-create-review").modal("show");
        }
    });
}

function loadPopover() {
    $(".quiz-best-time-ever").popover({
        trigger: 'hover',
        placement: 'top',
        container: 'body',
        html: 'true'
    });
}
function launchVideo(name, url) {

    var name = name;
    var url = url;

    $('#panel-video-title').html(name);
    sublime.unprepare('my_video_player');
    $("#my_video_player").attr("data-youtube-id", url);

    var windowWidth = $(window).width();

    if (windowWidth > 991) {
        var panelWidth = 868;
    } else {
        var panelWidth = windowWidth - 62;
    }

    $("#my_video_player").attr("width", panelWidth);
    $("#my_video_player").attr("height", panelWidth * 9 / 16);

    sublime.prepare('my_video_player');
    sublime('my_video_player').play();
    $('#video-container').removeClass('hide');
    $('#video-container .panel').addClass('animated bounceInRight');
    setTimeout(function () {
        $('#video-container .panel').removeClass('animated bounceInRight');

    }, 1300);
}