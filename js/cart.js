$(document).ready(function () {
    
    function showLoading()
    {
        $('#modal-container').html("<h3 class='modal-message'>Đang Tải...</h3>");
        $('#modal').modal('show');
    }

    function showCartInfo()
    {
        showLoading();
        $.get(cartInfoUrl, function (data) {
            $('#modal-container').html(data);
        });
    }
    
    $(document).off('click', 'button.btn-buy');
    $(document).on('click', 'button.btn-buy', function (event) {
        showLoading();
        var url = $(this).attr("url");
        $.get(url, function (data)
        {
            $('#modal-container').html(data);
            getTotalQuantityProducts();
        });
    });
    
    $(document).off('click', 'a.cart-info');
    $(document).on('click', 'a.cart-info', function (event) {
        event.preventDefault();
        showLoading();
        showCartInfo();
    });
    
    $(document).off('click', '.cart-popup .delete-product');
    $(document).on('click', '.cart-popup .delete-product', function (event) {
        var url = cartDeleteUrl;
        var params = {product_id: $(this).attr('data-id')};
        showLoading();
        $.post(url, params, function (data) {
            $('#modal-container').html(data);
            getTotalQuantityProducts();
        });
    });

    $(document).on('change', '.cart-popup .product-quantity', function (event) {
        event.preventDefault();
        var url = updateQuantityUrl;
        var params = {product_id: $(this).attr('data-id'), quantity: $(this).val()};
        showLoading();
        $.post(url, params, function (data) {
            $('#modal-container').html(data);
            getTotalQuantityProducts();
        });
    });
    
    Number.prototype.toDecimal = function(decimals, decimal_sep, thousands_sep)
    { 
       var n = this,
       c = isNaN(decimals) ? 2 : Math.abs(decimals), //if decimal is zero we must take it, it means user does not want to show any decimal
       d = decimal_sep || '.', //if no decimal separator is passed we use the dot as default decimal separator (we MUST use a decimal separator)

       t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep, //if you don't want to use a thousands separator you can pass empty string as thousands_sep value

       sign = (n < 0) ? '-' : '',

       i = parseInt(n = Math.abs(n).toFixed(c)) + '', 

       j = ((j = i.length) > 3) ? j % 3 : 0; 
       return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ''); 
    }
});