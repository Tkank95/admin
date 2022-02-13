$(function () {
    $('.checkbox_wrapper').on('click', function (){
        $(this).parents('.card-body').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });
});

