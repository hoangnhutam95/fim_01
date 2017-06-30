$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#click").click(function () {
        $("#logout-form").submit();
    });

    $("div.alert").delay(2000).slideUp();

    $(".fixform").on("submit", function () {
        return confirm("Do you want to delete this item?");
    });

    $('.nav-tabs-dropdown').each(function (i, elm) {
            $(elm).text($(elm).next('ul').find('li.active a').text());

    });
    $('.nav-tabs-dropdown').on('click', function (e) {
        e.preventDefault();

        $(e.target).toggleClass('open').next('ul').slideToggle();

    });
});
