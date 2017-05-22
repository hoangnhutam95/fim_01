(function () {
  // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
  // e.g. just plyr.setup(); and leave it at that if you have no need for events
    var instances = plyr.setup({
      // Output to console
        debug: true
    });
})();

$(document).ready(function () {
    var firstCover = $('.audio-cover').attr('backgr');
    $('.audio-cover').css({'background-image': 'url("' + firstCover + '")',
        });
    $(document).on('click', '.play-audio', function (e) {
        e.preventDefault();
        var audio = document.getElementById('audio-view');
        var id = $(this).attr('id');
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
        audio.load();
        audio.play();
    });
});




