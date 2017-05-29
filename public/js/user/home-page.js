$(document).ready(function() {

    $("#click-submit-logout").on('click', function(event) {
        event.preventDefault();
        $("#logout-form").submit();
    });

    $("div.alert").delay(3000).slideUp();

    $(".fixform").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });

    $("#myNavbar ul li ul").on('mouseenter', function(){
        $(this).parent().addClass("open");
    });

    $("#myNavbar ul li ul").on('mouseleave', function(){
        $(this).parent().removeClass("open");
    });

});
