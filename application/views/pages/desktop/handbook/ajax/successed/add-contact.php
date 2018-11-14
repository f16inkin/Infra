<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 13.11.2018
 * Time: 13:53
 */
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="handbook-card-body">
    <div class="row">
        <div class="col-4">
            <div class="handbook-card-foto">
                <img class="full-handbook-foto" src="/application/handbook/storage/foto/anonimous.jpg">
            </div>
            <div class="handbook-card-buttons-panel">
                <div class="handbook-card-button-wrapper">
                    <a href="" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Загрузить фотографию">
                        <i class="fa fa-upload"></i> Загрузить фотографию</a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="handbook-card-info">
                <div class="handbook-card-info-fullname">
                    <strong>Добавить новый контакт</strong>
                </div>
                <div class="handbook-card-info-content">
                    <!--<form name="add-contact-form" method="POST">-->
                        <!--Фамилия-->
                        <label for="modal-contact-surname"><strong>Фамилия:</strong></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="modal-contact-surname" name="modal-contact-surname" placeholder="Введите фамилию">
                        </div>
                        <!--Имя-->
                        <label for="modal-contact-firstname"><strong>Имя:</strong></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="modal-contact-firstname" name="modal-contact-firstname" placeholder="Введите имя">
                        </div>
                        <!--Отчество-->
                        <label for="modal-contact-secondname"><strong>Отчество:</strong></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="modal-contact-secondname" name="modal-contact-secondname" placeholder="Введите отчество">
                        </div>
                        <!--Должность-->
                        <label for="modal-contact-position"><strong>Должность:</strong></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user-tie" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="modal-contact-position" name="modal-contact-position" placeholder="Введите занимаемую должность">
                        </div>
                        <!--Компания-->
                        <label for="modal-contact-company"><strong>Компания:</strong></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control form-control-sm" id="modal-contact-company" name="modal-contact-company" placeholder="Выберите компанию">
                        </div>
                        <!--Телефон-->
                        <hr>
                        <div class="handbook-card-content-block-wrapper">
                            <label for="modal-contact-phone"><strong>Телефон:</strong></label>
                            <div id="modal-contact-phones-content"></div>
                            <div class="modal-contact-button-input-wrapper">
                                <a href="" onclick="addContactPhone(); return false;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Загрузить фотографию">
                                    <i class="fa fa-plus-circle"></i> Добавить еще</a>
                            </div>
                        </div>
                        <!--Email-->
                        <hr>
                        <div class="handbook-card-content-block-wrapper">
                            <label for="modal-contact-email"><strong>Email:</strong></label>
                            <div id="modal-contact-email-content"></div>
                            <div class="modal-contact-button-input-wrapper">
                                <a href="" onclick="addContactEmail(); return false;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Загрузить фотографию">
                                    <i class="fa fa-plus-circle"></i> Добавить еще</a>
                            </div>
                        </div>
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button"  onclick="saveContact(); return false;" class="btn btn-success">Сохранить</button>
</div>
