$(document).ready(function () {
    document.querySelector('.plyr-1').addEventListener('ended', setCount);
    function setCount(e)
    {
        e.preventDefault();
        var song = document.getElementById('audio-view');
        var id = $('#current-audio').data('key');
        var songId = $('#audio-id' + id).val();
        var timeSong = song.seekable.end(0);
        var timePlayed = song.played.end(0);
        if ((timeSong - timePlayed) > 250) {
            $.ajax({
                dataType: "json",
                url: "/view-count",
                type : "POST",
                data: {
                    song_id : songId,
                },
                success: function (result) {
                    if (result.success) {
                    }
                },
            });
        }
    }
});
