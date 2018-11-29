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

function addContact() {
    $('#contact-modal-content').load('/application/views/pages/desktop/handbook/ajax/successed/add-contact.php');
}

function saveContact() {
    var surname = $("input[name='modal-contact-surname']" ).val();
    var firstname = $("input[name='modal-contact-firstname']" ).val();
    var secondname = $("input[name='modal-contact-secondname']" ).val();
    var position = $("input[name='modal-contact-position']" ).val();
    var phone_objects = [];
    var email_objects = [];
    $('input[name="modal-contact-phone"]').each(function() {
        var phone_object = {};
        phone_object['name'] = $(this).val();
        var number = $(this).siblings('input[name="modal-contact-phone-number"]');
        phone_object['number'] = number.val();
        phone_objects.push(phone_object);
    });
    $('input[name="modal-contact-email"]').each(function() {
        var email_object = {};
        email_object['name'] = $(this).val();
        var address = $(this).siblings('input[name="modal-contact-email-address"]');
        email_object['address'] = address.val();
        email_objects.push(email_object);
    });
    $.ajax({
        type: "POST",
        url: "/handbook/contact/save/",
        data: {"surname": surname, "firstname": firstname, "secondname": secondname, "position": position,
               "phone_objects": phone_objects, "email_objects": email_objects},
        cache: false,
        success:function (response) {
            var res = JSON.parse(response);
            //Проверяю тип сообщения. Если успешна операция то ставлю зеленый цвет для элемента, иначе красный
            if(res.status === 'successed'){
                $(".handbook-card-info-caption").css({"color": "green"});
            }else {
                $(".handbook-card-info-caption").css({"color": "red"});
            }
            //Вывоже в элемент содержащееся сообщение из JSON
            $(".handbook-card-info-caption").text(res.message);
            //Очищаю поля
            $("input[name='modal-contact-surname']").val('');
            $("input[name='modal-contact-firstname']" ).val('');
            $("input[name='modal-contact-secondname']" ).val('');
            $("input[name='modal-contact-position']" ).val('');
            //Очищаю телефоны
            $(".modal-contact-phone-input-wrapper").remove();
            //Очищаю email
            $(".modal-contact-email-input-wrapper").remove();
        }
    });
}

function addContactPhone() {
    var string = '<div class="modal-contact-phone-input-wrapper">'+
        '<div class="input-group mb-2">'+
        '<div class="input-group-prepend">'+
        '<div class="input-group-text"><i class="fa fa-phone-square" aria-hidden="true"></i></div>'+
        '</div>'+
        '<input type="text" class="form-control form-control-sm" id="modal-contact-phone" name="modal-contact-phone" placeholder="Введите название">'+
        '<input type="text" class="form-control form-control-sm" id="modal-contact-phone-number" name="modal-contact-phone-number" placeholder="Введите номер">'+
        '<button type="button" class="btn btn-danger btn-sm btn-delete">&times;</button>' +
        '</div>'+
        '</div>';
    $("#modal-contact-phones-content").append(string);
}

function addContactEmail() {
    var string = '<div class="modal-contact-email-input-wrapper">'+
        '<div class="input-group mb-2">'+
        '<div class="input-group-prepend">'+
        '<div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>'+
        '</div>'+
        '<input type="text" class="form-control form-control-sm" id="modal-contact-email" name="modal-contact-email" placeholder="Введите название">'+
        '<input type="text" class="form-control form-control-sm" id="modal-contact-email-address" name="modal-contact-email-address" placeholder="Введите адрес">'+
        '<button type="button" class="btn btn-danger btn-sm btn-delete">&times;</button>' +
        '</div>'+
        '</div>';
    $("#modal-contact-email-content").append(string);
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

function loadContacts() {
    $.ajax({
        type: "POST",
        url: "/handbook/get/contacts/",
        cache: false,
        beforeSend: function () {
            $(".cards-content").html('Loading');
        },
        success:function (response) {
            var redirect = '/handbook/contacts/';
            history.pushState('', '', redirect);
            $("#title").text("Контакты");
            $(".cards-content").html(response);
        }
    });
}

function loadCompanies() {
    $.ajax({
        type: "POST",
        url: "/handbook/get/companies/",
        cache: false,
        success:function (response) {
            var redirect = '/handbook/companies';
            history.pushState('', '', redirect);
            $("#title").text('Компании');
            $(".cards-content").html(response);
        }
    })
}

/**
 * Статически загружаемые элементы
 *
 */
var modal_content = $("#contact-modal-content"); //Блок в который подгружается страница с полями для добавления
                                                 //контакта или компании

/**
 * Слушатель событий
 * Сработает когда будет нажата кнопка удаления строки телефона или почты в окне добаления
 * Если телефон или почту передумали добавлять, то можно удалить введеную запис нажав на эту кнопку
 */
modal_content.on('click' , '.btn-delete', function () {
    var string = $(this).parent().parent();
    string.remove();
});

/**
 * Слушатель событий
 * Сработает когда в поле компании будет вводится имя для поиска
 * Отправляет на сервер AJAX запрос, получает JSON ответ
 * Формирует строки и добавляет их
 */
modal_content.on('keyup', '#modal-contact-company-name', function () {
    var search = $('#modal-contact-company-name').val();
    if (search.length > 3){
        var request = $.ajax({
            type: "POST",
            url: "/handbook/search/company",
            data: {"search": search},
            cache: false
        });
        request.done(function(response){
            var res = JSON.parse(response);
            var string = '<div class="modal-contact-company-search-result">' +
                '<i hidden>'+res.id+'</i>' +
                '<i>'+res.name+'</i>' +
                '</div></div>';
            $("#modal-contact-company-search").append(string);
        });
    }
});

/**
 * Слушатель событий
 * Сработает при клике на поле поиска компании
 * Выделит введеный в поле текст
 */
modal_content.on('click', '#modal-contact-company-name', function () {
    $(this).select();
});

/**
 * Слушатель событий
 * Сработает когда я выберу результат поиска из предложенных
 * Выбирает значение и вставляет его в поле поиска, а так же устанавливает id компании в специальное поле для
 * отправки его на сервер
 */
modal_content.on('click', '.modal-contact-company-search-result', function () {
    var company_id = $('#modal-contact-company-id');
    var company_name = $('#modal-contact-company-name');
    global = true;
    var text = $(this).text();
    company_id.val(1);
    company_name.val(text);
    company_name.css({"border-color": "green"});
    $('div.modal-contact-company-search-result').remove();
});

/**
 * Слушатель событий
 * Сработает когда в окне контактов, будет производится поиск.
 *
 */
$(".cards-workplace").on('keyup', '#search_contact', function () {
    var search = $("#search_contact").val();
    if (search.length >= 5){
        var request =  $.ajax({
            type: "POST",
            url: "/handbook/search/contact",
            data: {"search": search},
            cache: false
        });
        request.done(function(response){
            $("#table-content").empty();
            var data = JSON.parse(response);
            $.each(data, function (key, value) {
                var string = '<tr class="tr-table-content">' +
                    '<td><img class="preview-handbook-foto" src="/application/handbook/storage/foto/'+value.foto+'"></td>' +
                    '<td>'+value.surname+" "+value.firstname+" "+value.secondname+'</td>' +
                    '<td>'+value.position+'</td>' +
                    '<td>'+value.phone+'</td>' +
                    '<td>'+value.email+'</td>' +
                    '<td><a class="btn btn-dark btn-sm" href="" onclick="showCompany('+value.company_id+'); return false;">'+value.company_name+'</a></td>' +
                    '<td><a class="btn btn-primary btn-sm" href="" onclick="showContact('+value.id+'); return false;">Посмотреть</a></td>' +
                    '</tr>';
                $("#table-content").append(string);
            })
        });
        return false;
    }
});

$(function() {
    $(".cards-workplace").on('blur', '.cards-search-input', function () {
       $(".cards-search-input").val('');
        $(".cards-search-input").css("border-color", "black");
    });
});
$(function() {
    $(".cards-workplace").on('focus', '.cards-search-input', function () {
        $(".cards-search-input").css("border-color", "green");
    });
});

/*var data = $.parseJSON(response);

$(data).each(function(i,val)
{
    $.each(val,function(key,val)
    {
        console.log(key + " : " + val);
    });
});*/