$(document).ready(function()
{
    $('.dropdown-item').hover(function () {
        $(this).find('.dropdown-content').addClass('active-dropdown');
    }, function () {
        $(this).find('.dropdown-content').removeClass('active-dropdown');
    });

});


