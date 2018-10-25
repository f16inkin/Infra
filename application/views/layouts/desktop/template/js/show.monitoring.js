/**
 * Created by Rain on 30.06.2018.
 */


/*
 * Добавляет данные необходимые к заполнению по топливу на текущий день
 *
 * Возвращает в ответ HTML страницу динамически сгенерированную PHP
 */
function addFuelRecords() {
    var subdivision = $("input[name='subdivision']" ).val();
    $.ajax({
        type: "POST",
        url: "/fuel/add/" + subdivision,
        cache: false,
        success:function (response) {
            $("#pills-fuel").html(response);
        }
    });
}

/*
 * Сохраняет/Обновляет записи по топливу за текущий день
 *
 * Возвращает окно с информацией об успешном сохранении
 */
function saveFuelRecords() {
    var id = [];
    var received = [];
    var sold = [];
    var remain = [];
    $('input[name="fuel_id"]').each(function() {
        id.push($(this).val());
    });
    $('input[name="received"]').each(function() {
        received.push($(this).val());
    });
    $('input[name="sold"]').each(function() {
        sold.push($(this).val());
    });
    $('input[name="remain"]').each(function() {
        remain.push($(this).val());
    });
    $.ajax({
        type: "POST",
        url: "/fuel/save",
        data: {"id": id, "received": received, "sold": sold, "remain": remain},
        cache: false,
        success:function (response) {
            //Парсинг пришедшего из контроллера сообщения.
            //В нем два значения: имя окна сообщения и само сообщение.
            var res = JSON.parse(response);
            //Создаю всплывающее окно "Типа все сохранено"
            $('#wrapper').prepend('<div id="'+res.window+'">'+res.message+'</div>');
            //Плавно его убираю с глаз и! И! Удаляю его колбэк функцией
            $("#success_window").delay(1000).fadeOut(1000, function () {
                $(this).remove()
            });
            //Подсветка таблицы
            $('#fuel_table').css(
                {
                "border": "1px solid #69e269",
                "color": "#69e269"
                });
        }
    });
}

/*
 * Добавляет строки в таблицу необходимые к заполнению по выручке на текущий день
 *
 * Возвращает в ответ HTML страницу динамически сгенерированную PHP
 */
function addGainRecords() {
    var subdivision = $("input[name='subdivision']" ).val();
    $.ajax({
        type: "POST",
        url: "/gain/add/" + subdivision,
        cache: false,
        success:function (response) {
            $("#pills-gain").html(response);
        }
    });
}

/*
 * Сохраняет/Обновляет записи по прибыли за текущий день
 *
 * Возвращает окно с информацией об успешном сохранении
 */
function saveGainRecords() {
    var id = [];
    var quantity = [];
    $('input[name="gain_id"]').each(function() {
        id.push($(this).val());
    });
    $('input[name="quantity"]').each(function() {
        quantity.push($(this).val());
    });
    $.ajax({
        type: "POST",
        url: "/gain/save",
        data: {"id": id, "quantity": quantity},
        cache: false,
        success:function (response) {
            //Парсинг пришедшего из контроллера сообщения.
            //В нем два значения: имя окна сообщения и само сообщение.
            var res = JSON.parse(response);
            //Создаю всплывающее окно "Типа все сохранено"
            $('#wrapper').prepend('<div id="'+res.window+'">'+res.message+'</div>');
            //Плавно его убираю с глаз и! И! Удаляю его колбэк функцией
            $("#success_window").delay(1000).fadeOut(1000, function () {
                $(this).remove()
            });
        }
    });
}

/*
 * Добавляет строки необходимые к заполнению по ценам на АЗС и АЗС конкурентов на текущий день
 *
 * Возвращает в ответ HTML страницу динамически сгенерированную PHP
 */
function addPricesRecords() {
    var subdivision = $("input[name='subdivision']" ).val();
    $.ajax({
        type: "POST",
        url: "/prices/add/" + subdivision,
        cache: false,
        success:function (response) {
            $("#pills-price").html(response);
        }
    });
}

/*
 * Сохраняет/Обновляет записи по ценам на АЗС за текущий день
 *
 * Возвращает окно с информацией об успешном сохранении
 */
function savePricesRecords() {
    fuel_name = $("#form-price").serialize();
    $.ajax({
       type: "POST",
        url: "/prices/save",
        data: fuel_name,
        cache: false,
        success:function (response) {
            //Парсинг пришедшего из контроллера сообщения.
            //В нем два значения: имя окна сообщения и само сообщение.
            var res = JSON.parse(response);
            //Создаю всплывающее окно "Типа все сохранено"
            $('#wrapper').prepend('<div id="'+res.window+'">'+res.message+'</div>');
            //Плавно его убираю с глаз и! И! Удаляю его колбэк функцией
            $("#success_window").delay(1000).fadeOut(1000, function () {
                $(this).remove()
            });
        }
    });
}

//Счетчик
var counter = 0;
function addOverflowsRecords() {
    //Это значение имени пользователя, достается из скрытого div'a
    var user = $('div.hidden').data('user');
    //Счетчик инкремиентируемый на единицу, при каждом вызове функции.
    counter++;
    $('<tr class="tr-table-content">')
        .attr('id','tr_'+counter)
        .append (
            $('<td class="hidden">')
                .append(
                    $('<input class="transparent-inputs" name="overflow_id" autocomplete="off">')
                )
        )
        .append (
            $('<td>')
                .append(
                    $('<input class="transparent-inputs" name="overflow-size" value="0" autocomplete="off">')
                )
        )
        .append (
            $('<td>')
                .append(
                    $('<select name="overflow-fuel-type">')
                        .append(
                            $('<option value="1">123</option>')
                        )
                        .append(
                            $('<option value="2">456</option>')
                        )
                )
        )
        .append (
            $('<td>')
                .append(
                    $('<input class="transparent-inputs" type="time" name="overflow-time" autocomplete="off">')
                )
        )
        .append (
            $('<td>'+user+'</td>')
        )
        .append (
            $('<td>')
                .append (
                    $('<span id="progress_'+counter+'" class="padding5px"><a  href="#" onclick="delete_line(\'#tr_'+counter+'\')" class="btn btn-danger btn-sm">Удалить</a></span>')
                )
        )
        .appendTo('#overflow-content');
}

/*
 * Сохраняет/Обновляет записи по переливам на АЗС за текущий день
 *
 * Возвращает окно с информацией об успешном сохранении
 */
function saveOverflowsRecords() {
    var subdivision = $("input[name='subdivision']" ).val();
    var arrId = [];
    var arrSize = [];
    var arrTime = [];
    var arrFuelTypes = [];
    //Запоняю массив идентификаторов зарегестрированных переливов
    $('input[name="overflow_id"]').each(function() {
        arrId.push($(this).val());
    });
    //Заполняю массив размеров зарегестрированных переливов
    $('input[name="overflow-size"]').each(function() {
        arrSize.push($(this).val());
    });
    $('input[name="overflow-time"]').each(function() {
        arrTime.push($(this).val());
    });
    //Заполняю массив типами топлива для которых зарегистрированны переливы
    $('select[name="overflow-fuel-type"]').each(function() {
        arrFuelTypes.push($(this).val());
    });
    $.ajax({
        type: "POST",
        url: "/overflows/save/" + subdivision,
        data: {"arrId": arrId, "arrSize": arrSize, "arrTime": arrTime, "arrFuelTypes": arrFuelTypes},
        cache: false,
        success:function () {
            //Создаю всплывающее окно "Типа все сохранено"
            $('#wrapper').prepend('<div id="success_window">Сохранено</div>');
            //Плавно его убираю с глаз и! И! Удаляю его колбэк функцией
            $("#success_window").delay(1000).fadeOut(1000, function () {
                $(this).remove()
            });
        }
    });
}

/*
 * Добавляет записи с плотнотью в систему на текущий день
 *
 * Возвращает в ответ HTML страницу динамически сгенерированную PHP
 */
function addDensityRecords() {
    var subdivision = $("input[name='subdivision']" ).val();
    $.ajax({
        type: "POST",
        url: "/density/add/" + subdivision,
        cache: false,
        success:function (response) {
            $("#pills-density").html(response);
        }
    });
}

/*
 * Сохраняет/Обновляет записи с плотностью для всех видов топлива на текущий день
 *
 * Возвращает окно с информацией об успешном сохранении
 */
function saveDensityRecords() {
    density = $("#form-density").serialize();
    $.ajax({
        type: "POST",
        url: "/density/save",
        data: density,
        cache: false,
        success:function (response) {
            //Парсинг пришедшего из контроллера сообщения.
            //В нем два значения: имя окна сообщения и само сообщение.
            var res = JSON.parse(response);
            //Создаю всплывающее окно "Типа все сохранено"
            $('#wrapper').prepend('<div id="'+res.window+'">'+res.message+'</div>');
            //Плавно его убираю с глаз и! И! Удаляю его колбэк функцией
            $("#success_window").delay(1000).fadeOut(1000, function () {
                $(this).remove()
            });
        }
    });
}

/*
 * Функция выделение динамически добавленных и статичных инпутов в таблицах
 */
$('.tab-pane').on('focus', ".transparent-inputs", function () {
    this.select();
});

/*
 * Функция которая суммирует значения на вкладке "Двиежение денег" и выводит его в "Итого"
 */
$("#pills-gain").on('keyup', '.transparent-inputs', function () {
    var sum=0;
    $(".gain-sum").each(function () {
        sum += parseFloat($(this).val());
    });
    $("#gain-sum").text((sum).toFixed(2));
});