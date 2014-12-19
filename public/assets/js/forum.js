$(function () {
    $('#div-forum .delete-topic-reply').click(function () {

        var topic_reply_id = $(this).attr('data-topic-reply-id');
        $('#topic_reply_id').val(topic_reply_id);
        $('#modal-delete-topic-reply').modal();
    });

    $('#div-forum .edit-topic-reply').click(function () {

        var topic_reply_id = $(this).attr('data-topic-reply-id');
        var message = $(this).attr('data-message');
        $('#edit_topic_reply_id').val(topic_reply_id)
        $('#textarea_edit_topic_reply').val(message);
        $('#modal-edit-topic-reply').modal();

    });
});