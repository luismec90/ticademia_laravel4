$(function () {
    $('#div-forum').on('click','.delete-topic-reply',function () {

        var topic_reply_id = $(this).attr('data-topic-reply-id');
        $('#topic_reply_id').val(topic_reply_id);
        $('#modal-delete-topic-reply').modal();
    });

    $('#div-forum').on('click','.edit-topic-reply',function () {

        var topic_reply_id = $(this).attr('data-topic-reply-id');
        var message = $(this).attr('data-message');
        $('#edit_topic_reply_id').val(topic_reply_id)
        $('#textarea_edit_topic_reply').val(message);
        $('#modal-edit-topic-reply').modal();
    });


    $("#table-comments").on("click", '.like:not(.disabled)', function () {
        $(".like-icon").popover('destroy');
        var link = $(this);
        link.removeClass('like').addClass('unlike disabled').html('Ya no me gusta');
        $.ajax({
            url: like_topic_reply_path,
            method: 'POST',
            data: {
                topic_reply_id: $(this).attr("data-topic-reply-id")
            }
        }).done(function (data) {

            link.parent().find('.counter').html(data);
            link.parent().find('.fa-thumbs-o-up').addClass("like-icon");
            link.removeClass('disabled');
        }).fail(function (data) {
            console.log('Error');
        });
    });

    $("#table-comments").on("click", '.unlike:not(.disabled)', function () {
        var link = $(this);
        link.removeClass('unlike disabled').addClass('like').html('Me gusta');
        $.ajax({
            url: unlike_topic_reply_path,
            method: 'POST',
            data: {
                topic_reply_id: $(this).attr("data-topic-reply-id")
            }
        }).done(function (data) {
            console.log(data.length);
            if(data==0){
                $(".like-icon").popover('destroy');
                link.parent().find('.fa-thumbs-o-up').removeClass("like-icon");
            }
            link.parent().find('.counter').html(data);
            link.removeClass('disabled');
        }).fail(function (data) {
            console.log('Error');
        });
    });

    $("#table-comments").on("click", '.like-icon', function () {
        coverOn();
        var likeIcon = $(this);

        $.ajax({
            url: who_like_topic_reply_path,
            method: 'GET',
            dataType: 'json',
            data: {
                topic_reply_id: $(this).attr("data-topic-reply-id")
            }
        }).done(function (data) {
            coverOff();
            var userList = "<ul class='user-list'>";
            $.each(data, function (index, like) {
                userList += "<li>" + like.user.first_name + " " + like.user.last_name + "</li>"
            });
            userList += "</ul>";

            $(".like-icon").popover('destroy');

            var genericCloseBtnHtml = '<button onclick="$(this).closest(\'div.popover\').popover(\'hide\');" type="button" class="close" aria-hidden="true">&times;</button>';
            likeIcon.popover({
                html: true,
                content: userList,
                title :'Usuarios '+ genericCloseBtnHtml,
                placement: 'top'
            }).popover('show');

        }).fail(function (data) {
            console.log('Error');
        });
    });
});