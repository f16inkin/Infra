<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 12.11.2018
 * Time: 16:02
 */
?>

<div class="alert alert-primary alert-dismissible fade show margin-top5 margin-bottom0" role="alert">
    <strong>Holy guacamole!</strong> Здесь отображены последние 10 добавленных компаний. Для поиска нужной
    введите название, имя руководителя или инн в поле "Поиск".
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="cards-search-bar">
    <input class="cards-search-input" type="text" placeholder="Начните поиск">
</div>
<table cellpadding="1" cellspacing="1" border="0" class="table-mine  full-width box-shadow--2dp table-striped">
    <thead>
    <tr class="tr-table-header">
        <th width="">Логотип</th>
        <th width="">Название</th>
        <th width="">Руководитель</th>
        <th width="">Телефон</th>
        <th width="">Email</th>
        <th width="">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($content as $company) :?>
        <tr class="tr-table-content">
            <td hidden><input type="text" name="contact_id" value="<?=$company['id'] ;?>"></td>
            <td><img class="preview-handbook-foto" src="<?='/application/handbook/storage/logos/'.$company['logo']?>"></td>
            <td><?=$company['short_name'] ;?></td>
            <td><?=$company['ceo']['surname'].' '.$company['ceo']['firstname'].' '.$company['ceo']['secondname'] ;?></td>
            <td><?=$company['phone'] ;?></td>
            <td><?=$company['email'] ;?></td>
            <td><a href="" onclick="showCompany(<?=$company['id'] ;?>); return false;" class="btn btn-primary btn-sm">Посмотреть</a></td>
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
