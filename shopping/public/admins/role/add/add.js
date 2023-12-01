$(function () {
    $('.checkbox_wrapper').on('click', function (){
        $(this).parents('.card').find('.checkox_childrent').prop('checked', $(this).prop('checked'));
    });
    $('.checkall').on('click', function (){
        $(this).parents().find('.checkox_childrent').prop('checked',$(this).prop('checked') );
        $(this).parents().find('.checkbox_wrapper').prop('checked',$(this).prop('checked') );
    });

})
