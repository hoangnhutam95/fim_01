$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('keyup', '#search-input-1', function (e) {
        e.preventDefault();
        var key = $('#search-input-1').val();
        var route = $('.hide').data('route');
        $.ajax({
            dataType: "json",
            url: route,
            type : "GET",
            data: {keyword : key},
            success: function (result) {
                if (result.success) {
                    $('.search-view-song').empty();
                    $('.view-song').hide();
                    $('.search-view-song').html(result.search_result);
                    var h = document.getElementsByTagName("head")[0];
                    var script = document.createElement("script");
                    script.src = '/js/show-more.js';
                    h.appendChild(script);
                }
            },
        });
    });

    $(document).on('click', '.search-page .pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getSearchPage(page, $('#search-input-1').val());

        function getSearchPage(page, keyword)
        {
            var route = $('.hide').data('route');
            $.ajax({
                dataType: "json",
                url: route + '?page=' + page,
                type : "GET",
                data: {keyword : keyword},
                success: function (result) {
                    if (result.success) {
                        $('.search-view-song').html(result.search_result);
                        var h = document.getElementsByTagName("head")[0];
                        var script = document.createElement("script");
                        script.src = '/js/show-more.js';
                        h.appendChild(script);
                    }
                }
            });
        };
    });
});
