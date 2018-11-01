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
                <img class="full-handbook-foto" src="<?='/application/handbook/storage/logos/'.$selectedCompany['logo']?>">
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
                    <strong><?=$selectedCompany['full_name'] ;?></strong>
                </div>
                <div class="handbook-card-info-content">
                    <?php if (isset($selectedCompany['short_name'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <strong>Краткое название:</strong> <?=$selectedCompany['short_name']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['phone'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                            <strong>Телефон:</strong> <?=$selectedCompany['phone']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['email'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <strong>Email:</strong> <?=$selectedCompany['email']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['legal_address'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <strong>Юридический адрес:</strong> <?=$selectedCompany['legal_address']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['real_address'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <strong>Фактический адрес:</strong> <?=$selectedCompany['real_address']; ?>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <?php if (isset($selectedCompany['ceo'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-user-tie" aria-hidden="true"></i>
                            <strong><?=$selectedCompany['ceo']['position']; ?>:</strong>
                            <?=
                            $selectedCompany['ceo']['surname'].' '.
                            $selectedCompany['ceo']['firstname'].' '.
                            $selectedCompany['ceo']['secondname']
                            ;?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['accountant'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-user-tie" aria-hidden="true"></i>
                            <strong><?=$selectedCompany['accountant']['position']; ?>:</strong>
                            <?=
                            $selectedCompany['accountant']['surname'].' '.
                            $selectedCompany['accountant']['firstname'].' '.
                            $selectedCompany['accountant']['secondname']
                            ;?>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <?php if (isset($selectedCompany['inn'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ИНН:</strong> <?=$selectedCompany['inn']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['kpp'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>КПП:</strong> <?=$selectedCompany['kpp']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['okpo'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ОКПО:</strong> <?=$selectedCompany['okpo']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['oktmo'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ОКТМО:</strong> <?=$selectedCompany['oktmo']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['ogrn'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>ОГРН:</strong> <?=$selectedCompany['ogrn']; ?>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <?php if (isset($selectedCompany['bank_name'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <strong>Банк:</strong> <?=$selectedCompany['bank_name']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['bank_address'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <strong>Адрес банка:</strong> <?=$selectedCompany['bank_address']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['bik'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <strong>БИК:</strong> <?=$selectedCompany['bik']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['checking_account'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-money-bill-alt" aria-hidden="true"></i>
                            <strong>Расчетный счет:</strong> <?=$selectedCompany['checking_account']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($selectedCompany['correspondent_account'])):?>
                        <div class="handbook-card-info-content-line">
                            <i class="fa fa-money-bill-alt" aria-hidden="true"></i>
                            <strong>Кореспондентский счет:</strong> <?=$selectedCompany['correspondent_account']; ?>
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