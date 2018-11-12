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

function loadContacts() {
    $.ajax({
        type: "POST",
        url: "/handbook/get/contacts/",
        cache: false,
        success:function (response) {
            var redirect = '/handbook/contacts/';
            history.pushState('', '', redirect);
            $("#title").text("Контакты");
            $(".cards-content").html(response);
        }
    });
}

$(function() {
    $("#search_contact").keyup(function(){
        var search = $("#search_contact").val();
        if (search.length >= 5){
            $.ajax({
                type: "POST",
                url: "/handbook/search/contact",
                data: {"search": search},
                cache: false,
                success: function(response){
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
                }
            });
            return false;
        }
    });
});
$(function() {
    $("#search_contact").focusout(function(){
       $("#search_contact").val('');
        $(".cards-search-input").css("border-color", "black");
        /*$.ajax({
         type: "POST",
         url: "/handbook/search/contact",
         data: {"search": search},
         cache: false,
         success: function(response){
         $("#table-content").html(response);
         }
         });
         return false;*/
    });
});
$(function() {
    $(".cards-search-input").focusin(function(){
        $(".cards-search-input").css("border-color", "green");
        /*$.ajax({
         type: "POST",
         url: "/handbook/search/contact",
         data: {"search": search},
         cache: false,
         success: function(response){
         $("#table-content").html(response);
         }
         });
         return false;*/
    });
});

var data = $.parseJSON(response);

$(data).each(function(i,val)
{
    $.each(val,function(key,val)
    {
        console.log(key + " : " + val);
    });
});