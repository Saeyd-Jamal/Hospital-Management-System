(function ($) {

    // search for names
    $("#searchInp").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#medicines_table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Total Fields Value
    $(".quantity_required").on("keyup", function () {
        let value = $(this).val();
        let medicineId = $(this).data('id');
        let price_sale = $('#price_sale_'+medicineId).text();
        let profit_sale = $('#profit_'+medicineId).text();
        let checkbox = $('#checkbox_'+medicineId);

        $('#total_price_'+medicineId).text(price_sale * value);
        $('#final_profit_'+medicineId).text(profit_sale * value);

        var sumPrice = 0;
        // Assuming your fields have a class 'sumField'
        $(".total_price").each(function(){
            sumPrice += parseFloat($(this).text()) || 0;
        });
        $('#total_price').val(sumPrice);

        var sumProfit = 0;
        // Assuming your fields have a class 'sumField'
        $(".final_profit").each(function(){
            sumProfit += parseFloat($(this).text()) || 0;
        });
        $('#final_profit').val(sumProfit);

        // Auto checked
        if(value != ""){
            checkbox.prop('checked', true);
        }else{
            checkbox.prop('checked', false);
        }
    });

    // send Rows Checked
    let checkedRows = [];
    $("button#sendButton").on("click", function () {
        $('input[name="medicines_id[]"]:checked').each(function () {
            let rowId = $(this).val();
            let inputValue = $('input[name="quantity_required_' + rowId + '"]').val();
            let total_price = $('#total_price_' + rowId + '').text();
            let final_profit = $('#final_profit_' + rowId + '').text();
            checkedRows.push({
                medicine_id: rowId,
                quantity: inputValue,
                price: total_price,
                profit: final_profit
            });
        });
        let buy_date = $('#buy_date').val();
        let total_price = $('#total_price').val();
        let final_profit = $('#final_profit').val();
        let reservation_id = $('#reservation_id').val();
        let payment_method = $('#payment_method').val();
        $.ajax({
            url: "/pharmacy/", //data-id
            method: "POST",
            data: {
                checkedRows: checkedRows,
                buy_date : buy_date,
                total_price : total_price,
                final_profit : final_profit,
                reservation_id : reservation_id,
                payment_method : payment_method,
                _token: csrf_token, //
            },
            success: function (data) {
                checkedRows = [];
                var form = $('<form>', {
                    'method': 'post',
                    'action': app_link + '/pharmacy/'
                });
                // Append input elements with values if needed
                form.append($('<input>', {
                    'name': '_token',
                    'value': csrf_token,
                    'type': 'hidden'
                }));
                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();
            },
            error: function (error) {
                checkedRows = [];
                window.history.back();
            },
        });
    });
})(jQuery);
