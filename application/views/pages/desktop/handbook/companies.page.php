<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 01.07.2018
 * Time: 10:32
 */
?>
<div class="container-fluid">
    <div class="row padding-left15">
        <div class="col">
            <div class="cards-toolbar">
                <a href="/handbook/" class="btn background-darkred btn-sm">
                    <i class="fa fa-address-book" aria-hidden="true"></i> Справочник</a>
                <a class="btn background-darkred btn-sm">
                    <i class="fa fa-cog" aria-hidden="true"></i> Управление</a>
            </div>
            <div class="cards-workplace">
                <div class="cards-nav-bar">
                    <a href="" onclick="loadContacts(); return false;" class="btn btn-success btn-sm">Контакты AJAX</a>
                    <a href="" onclick="loadCompanies(); return false;" class="btn btn-success btn-sm">Компании AJAX</a>
                </div>
                <div class="cards-content">
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
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/application/views/layouts/desktop/template/js/handbook.js"></script>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content"></div>
    </div>
</div>