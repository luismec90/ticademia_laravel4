$(function () {
    $("#div-comments .reply").click(function () {
        $("#div-comments .div-reply").addClass('hide');
        $(this).parent().parent().parent().parent().find('.div-reply').removeClass('hide').find('textarea').val("").focus();

    });

    $("#div-comments .btn-cancel-reply").click(function () {
        $("#div-comments .div-reply").addClass('hide');
    });


});

