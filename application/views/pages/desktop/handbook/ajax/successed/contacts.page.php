<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 01.07.2018
 * Time: 10:32
 */
?>
<div class="alert alert-primary alert-dismissible fade show margin-top5 margin-bottom0" role="alert">
    <strong>Holy guacamole!</strong> Здесь отображены последние 5 добавленных контактов. Для поиска нужного контакта
    введите фамилию, имя человека или компанию в которой он работает в поле "Поиск".
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="cards-search-bar">
    <input id="search_contact" class="cards-search-input" type="text" placeholder="Начните поиск">
</div>
<table cellpadding="1" cellspacing="1" border="0" class="table-mine  full-width box-shadow--2dp table-striped">
    <thead>
        <tr class="tr-table-header">
            <th width="25%">Фото</th>
            <th width="25%">ФИО</th>
            <th width="25%">Должность</th>
            <th width="25%">Телефон</th>
            <th width="25%">Email</th>
            <th width="25%">Компания</th>
            <th width="25%">Действия</th>
        </tr>
    </thead>
    <tbody id="table-content">
    <?php foreach ($content as $contact) :?>
        <tr class="tr-table-content">
            <td hidden><input type="text" name="contact_id" value="<?=$contact['id'] ;?>"></td>
            <td><img class="preview-handbook-foto" src="<?='/application/handbook/storage/foto/'.$contact['foto']?>"></td>
            <td><?=$contact['surname'].' '.$contact['firstname'].' '.$contact['secondname'] ;?></td>
            <td><?=$contact['position'] ;?></td>
            <td><?=$contact['phone'] ;?></td>
            <td><?=$contact['email'] ;?></td>
            <?if(isset($contact['company_id'])) :?>
            <td><a href="" onclick="showCompany(<?=$contact['company_id'] ;?>); return false;" class="btn btn-dark btn-sm"><?=$contact['company'] ;?></a></td>
            <?else:?>
                <td>-</td>
            <?endif; ?>
            <td><a href="" onclick="showContact(<?=$contact['id'] ;?>); return false;" class="btn btn-primary btn-sm">Посмотреть</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content"></div>
    </div>
</div>
