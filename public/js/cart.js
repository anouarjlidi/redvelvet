$(document).ready(function()
{
    getProducts();
});


function renderProduct(product) {

    return '<div class="cart-item">\n' +
        '            \n' +
        '            <div class="close">\n' +
        '                \n' +
        '                <i class="material-icons">clear</i>\n' +
        '                \n' +
        '            </div>\n' +
        '\n' +
        '            <div class="photo">\n' +
        '\n' +
        '                <img src="../'+ product['photo'] +'">\n' +
        '\n' +
        '            </div>\n' +
        '\n' +
        '            <div class="description">\n' +
        '\n' +
        '                <h3>'+ product['title'] +'</h3>\n' +
        '\n' +
        '                <p>'+ product['description'] +'</p>\n' +
        '\n' +
        '                <div class="footer">\n' +
        '\n' +
        '                    <label class="price">'+ product['price'] +'<sup>€/vnt.</sup></label>\n' +
        '\n' +
        '                    <span>Kiekis : </span>\n' +
        '\n' +
        '                    <input type="number" class="quantity">\n' +
        '\n' +
        '                </div>\n' +
        '\n' +
        '            </div>\n' +
        '\n' +
        '        </div>';

}

function getProducts()
{
    $.ajax({
        type: 'GET',
        url: 'http://127.0.0.1:8000/api/cart',
        success: function(response)
        {
            var container = $("#products-container");

            $.each(response, function (i, d) {

                container.append(renderProduct(d));

            });
        }
    });
}

function addProduct(productId)
{
    $.ajax({
        type: 'POST',
        data: {productId : productId},
        url: 'http://127.0.0.1:8000/api/cart/add',
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
        url: 'http://localhost:8000/api/cart/delete',
        success: function(response)
        {
            showNotification('Pranešimas', response);
        }
    });
}

