$(function () {
    $('#div-comments .reply').click(function () {
        $('#div-comments .div-reply').addClass('hide');
        $(this).parent().parent().parent().parent().find('.div-reply').removeClass('hide').find('textarea').val('').focus();

    });

    $("#div-comments").on("click", '.delete-message', function () {

        var message_id = $(this).attr('data-message-id');
        $('#message_id').val(message_id);
        $('#modal-delete-message').modal();
    });

    $("#div-comments").on("click", '.edit-message', function () {

        var message_id = $(this).attr('data-message-id');
        var message = $(this).attr('data-message');
        $('#edit_message_id').val(message_id)
        $('#textarea_edit_message').val(message);
        $('#modal-edit-message').modal();

    });

    $('#div-comments .btn-cancel-reply').click(function () {
        $('#div-comments .div-reply').addClass('hide');
    });
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            page++;
            $('#loadmoreajaxloader').show();
            $.ajax({
                url: wall_path,
                data: {
                    page: page
                },
                success: function (html) {
                    if (html) {
                        $('#div-append-comments').append(html);
                        $('#loadmoreajaxloader').hide();
                    } else {
                        $('#loadmoreajaxloader').html('<center>No hay más publicaciones por mostrar</center>').delay(5000).fadeOut();
                    }
                }
            });
        }
    });

    $("#div-comments").on("click", '.like:not(.disabled)', function () {
        $(".like-icon").popover('destroy');
        var link = $(this);
        link.removeClass('like').addClass('unlike disabled').html('Ya no me gusta');
        $.ajax({
            url: like_message_path,
            method: 'POST',
            data: {
                wall_message_id: $(this).attr("data-wall-message-id")
            }
        }).done(function (data) {

            link.parent().find('.counter').html(data);
            link.parent().find('.fa-thumbs-o-up').addClass("like-icon");
            link.removeClass('disabled');
        }).fail(function (data) {
            console.log('Error');
        });
    });

    $("#div-comments").on("click", '.unlike:not(.disabled)', function () {
        var link = $(this);
        link.removeClass('unlike disabled').addClass('like').html('Me gusta');
        $.ajax({
            url: unlike_message_path,
            method: 'POST',
            data: {
                wall_message_id: $(this).attr("data-wall-message-id")
            }
        }).done(function (data) {
            if (data == 0) {
                $(".like-icon").popover('destroy');
                link.parent().find('.fa-thumbs-o-up').removeClass("like-icon");
            }
            link.parent().find('.counter').html(data);
            link.removeClass('disabled');
        }).fail(function (data) {
            console.log('Error');
        });
    });

    $("#div-comments").on("click", '.like-icon', function () {
        coverOn();
        var likeIcon = $(this);

        $.ajax({
            url: who_like_message_path,
            method: 'GET',
            dataType: 'json',
            data: {
                wall_message_id: $(this).attr("data-wall-message-id")
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
                title: 'Usuarios ' + genericCloseBtnHtml,
                placement: 'top'
            }).popover('show');

        }).fail(function (data) {
            console.log('Error');
        });
    });

});