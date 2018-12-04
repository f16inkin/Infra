/**
 * Created by Rain on 26.10.2018.
 */

/*
 * --------------------------------------------------------------------------------------------------------------------
 *                                      Public Variables и загрузка страницы
 * --------------------------------------------------------------------------------------------------------------------
 */
var modal_content = $("#contact-modal-content"); //Блок в который подгружается страница с полями для добавления
                                                 //контакта или компании

/**
 * После полной загрузки страницы, определяет State
 */
$(function () {
    var state = localStorage.getItem("handbookState");
    switch (state){
        case "handbook": loadHandbookPage(); break;
        case "management": loadManagementPage(); break;
        default: loadHandbookPage(); break; //Если состояние еще не установлено, будет подгружаться заданная страница
    }
});


/*
 * --------------------------------------------------------------------------------------------------------------------
 *                                          Функции обработчики событий
 * --------------------------------------------------------------------------------------------------------------------
 */
/**
 * Отлавливает событие нажатия на кнопку Справочник. Формирует структуру. Добавляет меню и область вставки таблицы
 * контактов changeable-data. Выполняет метод loadContacts загружая в область вставки данные о контактах.
 */
$("#handbook-button").on('click', function () {
   loadHandbookPage();
   //Загрузка контактов
   //loadContacts();
   //Вернуть отрицание, чтоб небыло перезагрузки страницы
   return false;
});

/**
 *
 */
$("#management-button").on('click', function () {
    $("#title").text("Управление");
    loadManagementPage();
    return false;
});

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
    if(search.length < 5){
        $('div.modal-contact-company-search-result').remove();
        $('div.modal-contact-company-id').data('prop',''); //setter;
        $("input[name='modal-contact-company-id']" ).val('');
    }

    if (search.length >= 5){
        var request = $.ajax({
            type: "POST",
            url: "/handbook/search/company",
            data: {"search": search},
            cache: false
        });
        request.done(function(response){
            //Удаляю варианты поиска, перед выводом новых
            $(".modal-contact-company-search-result").remove();
            var data = JSON.parse(response);
            $.each(data, function (key, value) {
                var string = '<div class="modal-contact-company-search-result">' +
                    '<div class="search-company-logo-wrapper"><img class="search-company-logo" src="/application/handbook/storage/logos/'+value.logo+'"></div>' +
                    '<div id="company_id" data-prop="'+value.id+'" hidden></div>' +
                    '<div class="search-company-name">'+value.short_name+'</div>' +
                    '</div></div>';
                $("#modal-contact-company-search").append(string);
            });
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
    //global = true;
    var id = $(this).children("#company_id").data('prop');
    var text = $(this).text();
    company_id.val(id);
    company_name.val(text);
    company_name.css({"border-color": "green"});
    $('div.modal-contact-company-search-result').remove();
});

/**
 * Слушатель событий
 * Сработает когда в окне контактов, будет производится поиск.
 *
 */
$("#handbook-content").on('keyup', '#search_contact', function () {
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
    var company = $("input[name='modal-contact-company-id']" ).val();
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
                "company": company, "phone_objects": phone_objects, "email_objects": email_objects},
        cache: false,
        success:function (response) {
            var res = JSON.parse(response);
            //Проверяю тип сообщения. Если успешна операция то ставлю зеленый цвет для элемента, иначе красный
            if(res.status === 'successed'){
                $(".handbook-card-info-caption").css({"color": "green"});
            }else {
                $(".handbook-card-info-caption").css({"color": "red"});
            }
            var message = '';
            switch (res.message){
                case 'added' :
                    message = 'Контакт успешно добален';
                    break;
                case 'notAdded' :
                    message = 'Ошибка при добавлении контакта';
                    break;
                case 'noDataGiven' :
                    message = 'Фамилия или имя не заполнены. Контакт не может быть создан';
                    break;
                case 'dbError' :
                    message = 'Ошибка при работе с базой данных';
                    break;
            }
            //Вывоже в элемент содержащееся сообщение из JSON
            $(".handbook-card-info-caption").text(message);
            //Очищаю поля
            $("input[name='modal-contact-surname']").val('');
            $("input[name='modal-contact-firstname']" ).val('');
            $("input[name='modal-contact-secondname']" ).val('');
            $("input[name='modal-contact-position']" ).val('');
            $("input[name='modal-contact-company-id']" ).val('');
            $("input[name='modal-contact-company-name']" ).val('');
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
            //var redirect = '/handbook/contacts/';
            //history.pushState('', '', redirect);
            $("#title").text("Контакты");
            $("#changeable-data").html(response);
        }
    });
    return false;
}

function loadCompanies() {
    $.ajax({
        type: "POST",
        url: "/handbook/get/companies/",
        cache: false,
        success:function (response) {
            //var redirect = '/handbook/companies';
            //history.pushState('', '', redirect);
            $("#title").text('Компании');
            $("#changeable-data").html(response);
        }
    })
}

function loadHandbookPage(){
    //Очищаю блок от предыдущих записей
    $("div#handbook-content").empty();
    //Установка состояния
    localStorage.setItem("handbookState", "handbook");
    //Загрузка структуры для текущей вкладки
    var string = '<div class="cards-nav-bar">' +
        '<div class="handbook-nav-bar">' +
        '<a href="" onclick="loadContacts(); return false;" class="btn btn-success btn-sm">Контакты</a> ' +
        '<a href="" onclick="loadCompanies(); return false;" class="btn btn-success btn-sm">Компании</a> ' +
        '</div></div>' +
        '<div id="changeable-data"></div>';
    $("#handbook-content").prepend(string);
    //Загрузка контактов
    loadContacts();
}

function loadManagementPage() {
    //Очищаю блок от предыдущих значений
    $("div#handbook-content").empty();
    //Установка состояния
    localStorage.setItem("handbookState", "management");
    //Загрузка структуры для текущей вкладки
    var string = '<div class="cards-nav-bar">' +
        '<div class="handbook-nav-bar">' +
        '<a href="" onclick="addContact(); return false;" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addModalCenter">' +
        '<i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить контакт</a> ' +
        '<a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCompanyModalCenter">' +
        '<i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить компанию</a> ' +
        '</div></div>' +
        '<div id="changeable-data"></div>';
    $("#handbook-content").prepend(string);
}



$(function() {
    $("#handbook-content").on('blur', '.cards-search-input', function () {
       $(".cards-search-input").val('');
        $(".cards-search-input").css("border-color", "black");
    });
});
$(function() {
    $("#handbook-content").on('focus', '.cards-search-input', function () {
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