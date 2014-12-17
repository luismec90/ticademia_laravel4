$(function () {
    $("#div-comments .reply").click(function () {
        $("#div-comments .div-reply").addClass('hide');
        $(this).parent().parent().parent().parent().find('.div-reply').removeClass('hide').find('textarea').val("").focus();

    });
    $("#div-comments .delete-message").click(function () {

        var message_id = $(this).attr("data-message-id");
        $("#message_id").val(message_id);
        $("#modal-delete-message").modal();
    });

    $("#div-comments .btn-cancel-reply").click(function () {
        $("#div-comments .div-reply").addClass('hide');
    });

});