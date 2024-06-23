(function ($) {

    // search for names
    $("#searchInp").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#medicines_table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    let sumPrice = 0;
    let sumProfit = 0;

    // Total Fields Value
    $(".quantity_required").on("keyup", function () {
        let value = $(this).val();
        let medicineId = $(this).data('id');
        let price_sale = $('#price_sale_'+medicineId).text();
        let profit_sale = $('#profit_'+medicineId).text();
        let checkbox = $('#checkbox_'+medicineId);

        $('#total_price_'+medicineId).text(price_sale * value);
        $('#final_profit_'+medicineId).text(profit_sale * value);

        sumPrice = 0;
        sumProfit = 0;
        // Assuming your fields have a class 'sumField'
        $(".total_price").each(function(){
            sumPrice += parseFloat($(this).text()) || 0;
        });
        console.log(sumPrice);

        // Assuming your fields have a class 'sumField'
        $(".final_profit").each(function(){
            sumProfit += parseFloat($(this).text()) || 0;
        });

        // Auto checked
        if(value != ""){
            checkbox.prop('checked', true);
        }else{
            checkbox.prop('checked', false);
        }
    });

    // send form
    let checkedRows = [];
    $("button#sendButton").on("click", function (e) {
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
        let patient_id = $('#patient_id').val();
        let doctor_id = $('#doctor_id').val();
        let date = $('#date').val();
        let price = $('#price').val();
        let status = $('#status').val();
        $.ajax({
            url: "/reservations/", //data-id
            method: "POST",
            data: {
                checkedRows: checkedRows,
                total_price : sumPrice,
                final_profit : sumProfit,
                patient_id: patient_id,
                doctor_id: doctor_id,
                date: date,
                price: price,
                status: status,
                _token: csrf_token, //
            },
            success: function (data) {
                checkedRows = [];
                console.log(data);
                // window.location.href = app_link + "reservations";
            },
            error: function (error) {
                checkedRows = [];
                window.history.back();
            },
        });

    });
})(jQuery);
