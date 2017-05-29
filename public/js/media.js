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
});
