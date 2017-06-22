$(document).ready(function () {
    $("#suggest_bnt").on('click', function (event) {
        event.preventDefault();
        $('#suggest-lyric').removeClass('none');
        $('.thanks').html('');
    });

    $(document).on('click', '#summit-suggest', function (e) {
        e.preventDefault();
        var route = $('.urlsuggest').data('route');
        var content = $('#suggest-aria').val();
        var songId = $('#target_id').val();
        var userId = $('#user_id').val();
        if (content.length < 200) {
            alert('The lyrics need to bigger than 200 characters');
        } else {
            $.ajax({
                type: 'POST',
                url: route,
                dataType: 'JSON',
                data: {
                    'song_id': songId,
                    'content' : content,
                    'user_id': userId,
                },
                success: function (result) {
                    if (result.success) {
                        $('#suggest-lyric').addClass('none');
                        $('#suggest-aria').val('');
                        $('.thanks').html('Thanks for suggest');
                    } else {
                        alert("Sorry. Comment fail");
                    }
                }
            });
        }
    });
});
