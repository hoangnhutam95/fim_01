$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.edit-comment', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var content = $('#content-comment' + id).text();
        var html ="<li class='media'>" + "<textarea class='form-control aria-edit-comment' data-id=" + id + " id='textaria-edit" + id + "'></textarea>" + "</li>" +
        "<button class='btn btn-primary submit-edit-comment' id='" + id + "'>Send" + "</button>";
        $('#edit-comment-aria').html(html);
        $('.aria-edit-comment').focus().val(content);
    });

    $(document).on('click', '#post-comment-1', function (e) {
        e.preventDefault();
        var route2 = $('.urlcomment').data('route');
        var typeComment = $('.comment-type').data('type-comment');
        var content = $('#comment1').val();
        var targetId = $('#target_id').val();
        var userId = $('#user_id').val();
        $.ajax({
            type: 'POST',
            url: route2,
            dataType: 'JSON',
            data: {
                'target_id': targetId,
                'content' : content,
                'user_id': userId,
                'type' : typeComment,
            },
            success: function (result) {
                if (result.success) {
                    $('#comment1').val('');
                    $('#post-comment').load(location.href + " #post-comment>*","");
                } else {
                    alert("Sorry. Comment fail");
                }
            }
        });
    });

    $(document).on('keydown', '#comment1', function (e) {
        if (e.keyCode == 13) {
            var route2 = $('.urlcomment').data('route');
            var typeComment = $('.comment-type').data('type-comment');
            var content = $('#comment1').val();
            var targetId = $('#target_id').val();
            var userId = $('#user_id').val();
            $.ajax({
                type: 'POST',
                url: route2,
                dataType: 'JSON',
                data: {
                    'target_id': targetId,
                    'content' : content,
                    'user_id': userId,
                    'type' : typeComment,
                },
                success: function (result) {
                    if (result.success) {
                        $('#comment1').val('');
                        $('#post-comment').load(location.href + " #post-comment>*","");
                    } else {
                        alert("Sorry. Comment fail");
                    }
                }
            });
        }
    });

    $(document).on('keydown', '.aria-edit-comment', function (e) {
        if (e.keyCode == 13) {
            var id = $(this).data('id');
            var content = $(this).val();
            $.ajax({
                type: 'POST',
                url: '/editComment',
                dataType: 'JSON',
                data: {
                    'id': id,
                    'content' : content,
                },
                success: function (result) {
                    if (result.success) {
                        $('#post-comment').load(location.href + " #post-comment>*","");
                        $('.aria-edit-comment').remove();
                    } else {
                        alert("Sorry. Comment fail");
                    }
                }
            });
        }
    });

    $(document).on('click', '.submit-edit-comment', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var content = $('#textaria-edit' + id).val();
        $.ajax({
            type: 'POST',
            url: '/editComment',
            dataType: 'JSON',
            data: {
                'id': id,
                'content' : content,
            },
            success: function (result) {
                if (result.success) {
                    $('#post-comment').load(location.href + " #post-comment>*","");
                    $('.aria-edit-comment').remove();
                } else {
                    alert("Sorry. Comment fail");
                }
            }
        });
    });

    $(document).on('click', '.delete-comment1', function (e) {
        e.preventDefault();
        var conf = confirm("Do you want to delete this comment?");
        if (conf) {
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: '/deleteComment',
                dataType: 'JSON',
                data: {
                    'id': id,
                },
                success: function (result) {
                    if (result.success) {
                        $('#post-comment').load(location.href + " #post-comment>*","");
                    } else {
                        alert("Sorry. Comment fail");
                    }
                }
            });
        }
    });
});
