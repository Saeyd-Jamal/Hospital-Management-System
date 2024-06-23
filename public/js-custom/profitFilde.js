
(function ($) {
    // $("price_sale"),$('#basic_price'),$('#profit')
    $('.priceFildes').on('input',function(e){
        var price_sale = $('#price_sale').val();
        var basic_price = $('#basic_price').val();
        var profit = $('#profit').val();
        if(price_sale!= '' && basic_price!= ''){
            $('#profit').val(price_sale - basic_price);
        }else{
            $('#profit').val('');
        }
    });
})(jQuery);
