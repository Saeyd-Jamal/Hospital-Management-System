(function($) {

    setInterval(function(){
        $.ajax({
            url : "/doctor/reservation/getReservations/",
            method : "GET",
            data : {
                // _token : csrf_token,
            },
            success : function(data){
                console.log(data);
                if(data.length > 0){
                    index = data;
                    $('li.el').each(function(index, element) {
                        $(element).html([
                            '<a class="nav-link" href="'+ app_link + 'doctor/reservation/' + JSON.stringify(data[index]['id']) +'/edit/">'+
                                '<i class="fe fe-layers fe-16"></i>'+
                                '<span class="ml-3 item-text">'+ data[index]['name'] +'</span>'+
                                '<span class="badge badge-pill badge-infr">'+
                                    '<i class="fe fe-arrow-left"></i>'+
                                '</span>'+
                            '</a>'
                        ]);
                    });
                }
            },
        })
    }, 3000);

})(jQuery);
