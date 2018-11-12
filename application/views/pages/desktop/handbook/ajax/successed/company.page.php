<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 26.10.2018
 * Time: 17:02
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
                <img class="full-handbook-foto" src="<?='/application/handbook/storage/logos/'.$content['logo']?>">
            </div>
            <div class="handbook-card-buttons-panel">
                <div class="handbook-card-button-wrapper">
                    <a href="" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Редактировать">
                        <i class="fa fa-edit"></i></a>
                    <a href="" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Сохранить">
                        <i class="fa fa-save"></i></a>
                    <a href="" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Удалить">
                        <i class="fa fa-trash"></i></a>
                    <a href="" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Выгрузить">
                        <i class="fa fa-file-export"></i></a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="handbook-card-info">
                <div class="handbook-card-info-fullname">
                    <strong><?=$content['full_name'] ;?></strong>
                </div>
                <div class="handbook-card-info-content">
                    <?php if (isset($content['short_name'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <strong>Краткое название:</strong> <?=$content['short_name']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['phone'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                            <strong>Телефон:</strong> <?=$content['phone']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['email'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <strong>Email:</strong> <?=$content['email']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['legal_address'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <strong>Юридический адрес:</strong> <?=$content['legal_address']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['real_address'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <strong>Фактический адрес:</strong> <?=$content['real_address']; ?>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <?php if (isset($content['ceo'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-user-tie" aria-hidden="true"></i>
                            <strong><?=$content['ceo']['position']; ?>:</strong>
                            <a href="" onclick="showContact(<?=$content['ceo']['id'] ;?>); return false;">
                                <?=
                                $content['ceo']['surname'].' '.
                                $content['ceo']['firstname'].' '.
                                $content['ceo']['secondname']
                                ;?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['accountant'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-user-tie" aria-hidden="true"></i>
                            <strong><?=$content['accountant']['position']; ?>:</strong>
                            <a href="" onclick="showContact(<?=$content['accountant']['id'] ;?>); return false;">
                                <?=
                                $content['accountant']['surname'].' '.
                                $content['accountant']['firstname'].' '.
                                $content['accountant']['secondname']
                                ;?>
                            </a>

                        </div>
                    <?php endif; ?>
                    <hr>
                    <?php if (isset($content['inn'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ИНН:</strong> <?=$content['inn']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['kpp'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>КПП:</strong> <?=$content['kpp']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['okpo'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ОКПО:</strong> <?=$content['okpo']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['oktmo'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ОКТМО:</strong> <?=$content['oktmo']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['ogrn'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ОГРН:</strong> <?=$content['ogrn']; ?>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <?php if (isset($content['bank_name'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <strong>Банк:</strong> <?=$content['bank_name']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['bank_address'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <strong>Адрес банка:</strong> <?=$content['bank_address']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['bik'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>БИК:</strong> <?=$content['bik']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['checking_account'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-money-bill-alt" aria-hidden="true"></i>
                            <strong>Расчетный счет:</strong> <?=$content['checking_account']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($content['correspondent_account'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-money-bill-alt" aria-hidden="true"></i>
                            <strong>Кореспондентский счет:</strong> <?=$content['correspondent_account']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>