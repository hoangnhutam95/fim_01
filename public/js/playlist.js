(function () {
  // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
  // e.g. just plyr.setup(); and leave it at that if you have no need for events
    var instances = plyr.setup({
      // Output to console
        debug: true,
        autoplay: true,
        displayDuration: true,
    });
})();

$(document).ready(function () {
    var firstCover = $('.audio-cover').attr('backgr');
    $('.audio-cover').css({'background-image': 'url("' + firstCover + '")',});
    document.querySelector('.plyr-1').addEventListener('ended', nextSong);
    function nextSong(e)
    {
        e.preventDefault();
        var song = document.getElementById('audio-view');
        var id1 = $('#current-audio').data('key');
        var songId = $('#audio-id' + id1).val();
        alert(songId);
        var timeSong = song.seekable.end(0);
        var timePlayed = song.played.end(0);
        if ((timeSong - timePlayed) < 30) {
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
        var audio = document.getElementById('audio-view');
        var preId = $('#current-audio').data('key');
        var maxKey = $('#current-audio').data('max-key');
        var id = ++preId;
        if (id > maxKey - 1) {
            id = 0;
        }
        var coverUrl = $('#cover-audio' + id).val();
        var src = $('#link-audio' + id).val();
        var audioName = $('#audio-name' + id).val();
        var htmlAudioName = "Song : " + "<span id='audio-name-color'>" + audioName + "</span>";
        var html =
            "<source src='" + src + "' type='audio/mpeg'>" +
            "Your browser does not support the audio element.";
        $('.audio-cover').css({'background-image': 'url("' + coverUrl + '")',
        });
        $('.test-p').html(html);
        $('.admin-audio-name').html(htmlAudioName);
        var curentKey = $('#current-audio').data('key');
        $('#album-detail' + curentKey).removeClass('album-active');
        $('#current-audio').data('key', id);
        $('#album-detail' + id).addClass('album-active');
        audio.load();
        audio.play();
    }
    $(document).on('click', '.play-audio', function (e) {
        e.preventDefault();
        var audio = document.getElementById('audio-view');
        var id = $(this).attr('key');
        var coverUrl = $('#cover-audio' + id).val();
        var src = $('#link-audio' + id).val();
        var audioName = $('#audio-name' +id).val();
        var htmlAudioName = "Song : " + "<span id='audio-name-color'>" + audioName + "</span>";
        var html =
            "<source src='" + src + "' type='audio/mpeg'>" +
            "Your browser does not support the audio element.";
        $('.audio-cover').css({'background-image': 'url("' + coverUrl + '")',
        });
        $('.test-p').html(html);
        $('.admin-audio-name').html(htmlAudioName);
        var curentKey = $('#current-audio').data('key');
        $('#album-detail' + curentKey).removeClass('album-active');
        $('#current-audio').data('key', id);
        $('#album-detail' + id).addClass('album-active');
        audio.load();
        audio.play();
    });
});




