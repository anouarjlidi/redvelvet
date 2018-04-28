$(document).ready(function()
{
    $(function()
    {
        $('.animated-element').waypoint(function()
            {
                if($(this).hasClass('showfrombottom') == true)
                {
                    return;
                }
                else
                {
                    $(this).addClass('showfrombottom');
                }
            },
            {
                offset: '100%'
            });

    });

});



