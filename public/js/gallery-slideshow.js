var index;
var modal = $('.modal');
var modalBackground = $('.modal-background');

function openModal(galleryElement)
{
    index = $( "div.gallery" ).index( galleryElement );
    var src = $(galleryElement).find('img').attr('src');
    modal.find('img').attr('src', src);
    modalBackground.addClass('show-modal-background');
    modal.addClass('show-modal');
}

function closeModal()
{
    index = null;
    modal.removeClass('show-modal');
    modalBackground.removeClass('show-modal-background');
}

function nextPhoto()
{
    if(index < $('.gallery').length-1)
    {
        var galleryElement = $('.gallery:eq('+(index+1)+')');
        index = index + 1;
        var src = galleryElement.find('img').attr('src');
        modal.find('img').attr('src', src);
    }

}

function previousPhoto()
{

    if(index > 0)
    {
        var galleryElement = $('.gallery:eq('+(index-1)+')');
        index = index - 1;
        var src = galleryElement.find('img').attr('src');
        modal.find('img').attr('src', src);
    }
}