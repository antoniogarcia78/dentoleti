/**
 * Javscript for managing tabs
 */

$('a').click(function () {
    $('li').removeClass('active');
    $('.active').removeClass('active');
    $(this).closest('li').toggleClass('active');
    $(($(this).attr('href'))).addClass('active');
})
