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
<div class="contact-card-body">
    <div class="row">
        <div class="col-4">
            <div class="contact-card-foto">
                <img class="full-contact-foto" src="<?='/application/handbook/storage/foto/'.$selectedContact['foto']?>">
            </div>
        </div>
        <div class="col-8">
            <div class="contact-card-info">
                <div class="contact-card-info-fullname">
                    <strong><?=$selectedContact['surname'].' '.$selectedContact['firstname'].' '.$selectedContact['secondname'] ;?></strong>
                </div>
                <div class="contact-card-info-content">
                    <?php if (isset($selectedContact['company'])):?>
                    <div class="contact-card-info-content-line">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Компания: <a href="<?='/company/'.$selectedContact['company_id']; ?>"><?=$selectedContact['company']; ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($selectedContact['position'])):?>
                    <div class="contact-card-info-content-line">
                        <i class="fa fa-user-tie" aria-hidden="true"></i>
                        <?='Должность: '.$selectedContact['position']; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($selectedContact['phones'])):?>
                        <?php foreach ($selectedContact['phones'] as $phone) :?>
                            <div class="contact-card-info-content-line">
                               <i class="fa fa-phone-square" aria-hidden="true"></i>
                               <?=$phone['phone_description'].': '.$phone['phone_number'] ;?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($selectedContact['emails'])):?>
                        <?php foreach ($selectedContact['emails'] as $phone) :?>
                            <div class="contact-card-info-content-line">
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