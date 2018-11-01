/**
 * Created by Rain on 26.10.2018.
 */


/*
 * Показывает модальное окно с данными по выбранному контакту
 *
 */
function showContact(id){

    $.ajax({
        type: "POST",
        url: "/handbook/contact/view/" + id,
        cache: false,
        success:function (response) {
            $(".modal-content").html(response);
            $('#exampleModalCenter').modal('show');

        }
    });
}

function showCompany(id){

    $.ajax({
        type: "POST",
        url: "/handbook/company/view/" + id,
        cache: false,
        success:function (response) {
            $(".modal-content").html(response);
            $('#exampleModalCenter').modal('show');

        }
    });
}