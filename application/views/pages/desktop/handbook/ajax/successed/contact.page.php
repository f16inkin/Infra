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
                <img class="full-handbook-foto" src="<?='/application/handbook/storage/foto/'.$content['foto']?>">
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
                    <strong><?=$content['surname'].' '.$content['firstname'].' '.$content['secondname'] ;?></strong>
                </div>
                <div class="handbook-card-info-content">
                    <?php if (isset($content['company'])):?>
                    <div class="handbook-card-info-content-line">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Компания: <a href="" onclick="showCompany(<?=$content['company_id'] ;?>); return false;"><?=$content['company']; ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($content['position'])):?>
                    <div class="handbook-card-info-content-line">
                        <i class="fa fa-user-tie" aria-hidden="true"></i>
                        <?='Должность: '.$content['position']; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($content['phones'])):?>
                        <?php foreach ($content['phones'] as $phone) :?>
                            <div class="handbook-card-info-content-line">
                               <i class="fa fa-phone-square" aria-hidden="true"></i>
                               <?=$phone['phone_description'].': '.$phone['phone_number'] ;?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($content['emails'])):?>
                        <?php foreach ($content['emails'] as $phone) :?>
                            <div class="handbook-card-info-content-line">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <?=$phone['email_description'].': '.$phone['email'] ;?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>