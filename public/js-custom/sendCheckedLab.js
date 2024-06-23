(function ($) {

    // search for names
    $("#searchInp").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tests_table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // send Rows Checked
    let checkedRows = [];
    $("button#sendButton").on("click", function () {
        $('input[name="medicines_id[]"]:checked').each(function () {
            let rowId = $(this).val();
            let inputValue = $('input[name="price_' + rowId + '"]').val();
            checkedRows.push({
                medicine_id: rowId,
                price: inputValue,

            });
        });
        let test_date = $('#test_date').val();
        $.ajax({
            url: "/laboratory/", //data-id
            method: "POST",
            data: {
                checkedRows: checkedRows,
                test_date : test_date,
                payment_method : payment_method,
                _token: csrf_token, //
            },
            success: function (data) {
                checkedRows = [];
                var form = $('<form>', {
                    'method': 'post',
                    'action': app_link + '/laboratory/'
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
