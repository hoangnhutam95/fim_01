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
});

