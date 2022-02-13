$(document).on('ready', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // INITIALIZATION OF GO TO
    // =======================================================
    $('.js-go-to').each(function () {
        var goTo = new HSGoTo($(this)).init();
    });
});
