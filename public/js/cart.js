var sum;

$(document).ready(function()
{
    refresh();

    $('input.quantity').change(function () {
       refresh();
    });
});

function addProduct(productId)
{
    $.ajax({
        type: 'POST',
        data: {productId : productId},
        url: '/api/cart/add',
        success: function(response)
        {
            showNotification('Pranešimas', response);
        }
    });
}

function deleteProduct(productId)
{
    $.ajax({
        type: 'POST',
        data: {productId : productId},
        url: '/api/cart/delete',
        success: function()
        {
            window.location.reload();
        }
    });
}

function refresh()
{
    sum = 0;

    $('.cart-item').each(function(i, obj) {

        var price = $(this).find('.price span').html();
        var quantity = $(this).find('.quantity').val();
        var itemSum = price*quantity;
        sum += itemSum;
        $(this).find('.sum').html(itemSum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
    });

    $('#sum').html(sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
}