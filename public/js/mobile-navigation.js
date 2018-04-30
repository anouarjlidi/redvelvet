var isVisible = false;

$(document).ready(function()
{
    $('.mobile-menu-icon').find('i').click(function () {

        if(isVisible === false)
        {
            $(this).html('clear');
            $('.mobile-nav').css('display', 'block');
            isVisible = true;
        }
        else
        {
            $(this).html('menu');
            $('.mobile-nav').css('display', 'none');
            isVisible = false;
        }
    });
});