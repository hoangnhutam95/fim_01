$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('focus', '#home-search-aria', function () {
        $(document).on('submit', '#home-search-form', function (event) {
            var key = $('#home-search-aria').val();
            if (key == '') {
                event.preventDefault();
            }
        });
        $(this).attr('autocomplete', 'off');
        $(document).on('keyup', '#home-search-aria', function (e) {
            e.preventDefault();
            $('#suggest-search-aria').addClass('open');
            var key = $('#home-search-aria').val();
            if (key == '') {
                $('#suggest-search-aria').removeClass('open');
            }
            $.ajax({
                dataType: "json",
                url: "/search-home",
                type : "GET",
                data: {keyword : key},
                success: function (result) {
                    if (result.success) {
                        $('#suggest-search-aria').empty();
                        $('#suggest-search-aria').html(result.search_result);
                    }
                },
            });
        });
    });
});
