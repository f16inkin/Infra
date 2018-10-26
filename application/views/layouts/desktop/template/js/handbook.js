/**
 * Created by Rain on 26.10.2018.
 */


/*
 * Добавляет данные необходимые к заполнению по топливу на текущий день
 *
 * Возвращает в ответ HTML страницу динамически сгенерированную PHP
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