$(window).on( "load", function() {
    $("#content-loader").fadeOut();
});

$( document ).ready(function() {
    $(document).on("keyup", ".form-control.is-invalid", function() {
        $(this).removeClass('is-invalid');
        $(this).next().remove("span");
    });

    $('[data-bs-toggle="tooltip"]').tooltip({
        animated: 'fade',
        trigger: 'click'
    });

    $(':not([data-bs-toggle="tooltip"])').click(function() {
        $('[data-bs-toggle="tooltip"]').tooltip('hide');
    });
});