var modal = $('.modal');
var modalBackground = $('.modal-background');
var quantityInput = $('input#quantity');
var product;

$(document).ready(function()
{

    quantityInput.keydown(function () {

        if($(this).val() <= 0)
        {
            $(this).val('1');
            return;
        }

        if($(this).val() > 10000)
        {
            $(this).val('9999');
            return;
        }

        refresh();
    });

    quantityInput.change(function () {

        if($(this).val() <= 0)
        {
            $(this).val('1');
            return;
        }

        if($(this).val() > 10000)
        {
            $(this).val('9999');
            return;
        }

        refresh();
    });
});

function openModal(productId)
{
    $('.loader').removeClass('hide-loader');
    $('input#quantity').val('1');
    modalBackground.addClass('show-modal-background');
    modal.addClass('show-modal');
    getProduct(productId);
}

function closeModal()
{
    $('.modal button').attr('disabled', true);
    $('.modal .content').css('visibility', 'hidden');
    $('.loader').addClass('hide-loader');
    modal.removeClass('show-modal');
    modalBackground.removeClass('show-modal-background');
}


function getProduct(productId) {

    $.ajax({
        type: 'POST',
        data: {productId : productId},
        url: '/api/product',
        success: function(data)
        {
            modal.attr('productId', productId);
            product = data;
            $('.product-name').html(data['title']);
            $('.product-price').html("<span>"+data['price']+"</span> €/"+data['units']);
            $('#sum').html(data['price'] + ' €');
            $('.modal .content').css('visibility', 'visible');
            $('.loader').addClass('hide-loader');
            $('.modal button').attr('disabled', false);
        }
    });

}

function addProduct()
{
    var productId = modal.attr('productId');
    var quantity = $('input#quantity').val();

    $.ajax({
        type: 'POST',
        data: {productId : productId, quantity: quantity},
        url: '/api/cart/add',
        success: function(response)
        {
            closeModal();
            showNotification('Pranešimas', response);
        }
    });
}

function refresh()
{
    var price = modal.find('.product-price span').html();
    var quantity = $('input#quantity').val();
    sum = price * quantity;
    $('#sum').html(sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + ' €');
}