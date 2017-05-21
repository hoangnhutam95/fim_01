(function () {
  // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
  // e.g. just plyr.setup(); and leave it at that if you have no need for events
    var instances = plyr.setup({
      // Output to console
        debug: true
    });
})();

$(document).ready(function () {
    $(document).on('click', '.play-video', function (e) {
        e.preventDefault();
        var video = document.getElementById('video-view');
        var id = $(this).attr('id');
        var coverUrl = $('#cover-video' + id).val();
        var src = $('#link-video' + id).val();
        var videoName = $('#video-name' +id).val();
        var singerName = $('#singer-name' +id).val();
        var htmlVideoName = "Song : " + "<span id='video-name-color'>" + videoName + "</span>" +
        "<span> - " + singerName + "</span>" ;
        var html =
            "<source src='" + src + "' type='video/mp4'>" +
            "Your browser does not support the video element.";
        $('#video-view').attr('poster', coverUrl);
        $('#video-view').html(html);
        $('.admin-video-name').html(htmlVideoName);
        video.load();
        video.play();
    });
});
