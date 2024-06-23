(function ($) {
    $("#section_id").on("change", function (e) {
        $("#doctor_id").empty();
        let section_id = $(this).val();
        $.ajax({
            url: "/reservations/getDoctors/", //data-id
            method: "post",
            data: {
                section_id: section_id,
                _token: csrf_token,
            },
            success: function (response) {
                console.log(response);
                if (response.length != 0) {
                    $("#doctor_id").append(
                        "<option selected>إفتح القائمة لإختيار الطبيب</option>"
                    );
                    for (let index = 0; index < response.length; index++) {
                        $("#doctor_id").append(
                            "<option value='" +
                                response[index]["id"] +
                                "'>" +
                                response[index]["name"] +
                                "</option>"
                        );
                    }
                } else {
                    $("#doctor_id").append(
                        "<option selected>لا يوجد أطباء في هذا القسم</option>"
                    );
                }
            },
        });
    });

    $(".patient_search").on("input", function (e) {
        let patient = $(this).val();
        let type = $(this).data("id");
        $.ajax({
            url: "/reservations/getPatient/", //data-id
            method: "post",
            data: {
                patient: patient,
                type: type,
                _token: csrf_token,
            },
            success: function (response) {
                $("#table_patient").empty();
                if (response.length != 0) {
                    for (let index = 0; index < response.length; index++) {
                        $("#table_patient").append(
                            "<tr class='patient_select' data-id=" +
                                response[index]["patient_id"] +
                                "><th scope='row'>" +
                                response[index]["patient_id"] +
                                "</th><td>" +
                                response[index]["name"] +
                                "</td><td>" +
                                response[index]["date_of_birth"] +
                                "</td></tr>"
                        );
                    }
                } else {
                    $("#table_patient").append(
                        "<tr><td colspan='3'>يرجى التأكد من صحة البيانات</td></tr>"
                    );
                }
            },
        });
    });

    $(".table-hover").delegate("tr.patient_select", "click", function () {
        let patient_id_select = $(this).data("id");
        $("input[name=patient_id]").val(patient_id_select);
        $("#getPatient").modal("toggle");
    });

})(jQuery);
