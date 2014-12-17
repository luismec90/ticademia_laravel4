$(function () {
    $('#div-comments .reply').click(function () {
        $('#div-comments .div-reply').addClass('hide');
        $(this).parent().parent().parent().parent().find('.div-reply').removeClass('hide').find('textarea').val('').focus();

    });
    $('#div-comments .delete-message').click(function () {

        var message_id = $(this).attr('data-message-id');
        $('#message_id').val(message_id);
        $('#modal-delete-message').modal();
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
});