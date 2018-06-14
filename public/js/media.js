(function () {
  // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
  // e.g. just plyr.setup(); and leave it at that if you have no need for events
    var instances = plyr.setup({
      // Output to console
        debug: true,
        autoplay: true,
    });
})();

$(document).ready(function () {
    var firstCover = $('.audio-cover').attr('backgr');
    $('.audio-cover').css({'background-image': 'url("' + firstCover + '")',
    });
    document.querySelector('.plyr-1').addEventListener('ended', setCount);
    function setCount(e)
    {
        e.preventDefault();
        var song = document.getElementById('song-view');
        var songId = $('.plyr-1').attr('song-id');
        song.play();
        var timeSong = song.seekable.end(0);
        var timePlayed = song.played.end(0);
        if ((timeSong - timePlayed) < (0.2 * timeSong)) {
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
