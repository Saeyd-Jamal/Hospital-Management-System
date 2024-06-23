(function($) {

    setInterval(function(){
        $.ajax({
            url : "/pharmacy/reservations/DataAjax/",
            method : "GET",
            data : {
                // _token : csrf_token,
            },
            success : function(data){
                if(data.length > 0){
                    index = data;
                    $('tr.el').each(function(index, element) {
                        $(element).html([
                            '<td>'+ '<a href="http://127.0.0.1:8000/pharmacy/'+ JSON.stringify(data[index]['id']) + '/edit" class="nav-item">'+ JSON.stringify(data[index]['id']) +'</a>' +'</td>' +
                            '<td>'+'</td>' +
                            '<td>'+JSON.stringify(data[index]['buy_date'])+'</td>' +
                            '<td>'+JSON.stringify(data[index]['payment_method'])+'</td>' +
                            '<td>'+JSON.stringify(data[index]['total_price'])+'</td>' +
                            '<td>'+JSON.stringify(data[index]['final_profit'])+'</td>' +
                            '<td>'+
                            '<a href="http://127.0.0.1:8000/pharmacy/'+ JSON.stringify(data[index]['id']) + '/edit" class="btn btn-secondary" >'+ "تعديل" + '</a>' +
                            '</td>'
                        ]);
                    });
                }
            },
        })
    }, 5000);

})(jQuery);
