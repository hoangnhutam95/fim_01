$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#input-2').on('change', function () {
        var route = $('.hide-rate').data('route');
        var point = $('input[name="rate"]').val();
        var targetId = $('#target_id').val();
        var userId = $('#user_id').val();
        console.log(userId);
        $.ajax({
            type: 'POST',
            url: route,
            dataType: "JSON",
            data: {
                'target_id': targetId,
                'point' : point,
                'user_id': userId,
            },
            success: function (result) {
                if (result.success) {
                    $('#rate-point').load(location.href + " #rate-point>*","");
                } else {
                    alert("not");
                }
            }});
    });
    $('.nav-tabs-dropdown').each(function(i, elm) {

        $(elm).text($(elm).next('ul').find('li.active a').text());

    });

    $('.nav-tabs-dropdown').on('click', function(e) {

        e.preventDefault();

        $(e.target).toggleClass('open').next('ul').slideToggle();

    });

    $('#nav-tabs-wrapper a[data-toggle="tab"]').on('click', function(e) {

        e.preventDefault();

        $(e.target).closest('ul').hide().prev('a').removeClass('open').text($(this).text());

    });
});

