<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 13.11.2018
 * Time: 10:31
 */
?>
<div class="container-fluid">
    <div class="row padding-left15">
        <div class="col">
            <div class="cards-toolbar">
                <a href="/handbook/" class="btn background-darkred btn-sm">
                    <i class="fa fa-address-book" aria-hidden="true"></i> Назад в Справочник</a>
            </div>
            <div class="cards-workplace">
                <div class="cards-content">
                    <h5 style="text-align: center;">Доступ для <?=$content['short_name'] ;?> закрыт!</h5>
                    <p style="text-align: center;">Если у вас был доступ к этому разделу. То обратитесь к админисратору.</p>
                    <div style="margin-left: calc(50% - 100px);"><img style="width: 200px; height: 200px;" src="/application/handbook/storage/system/access_denied.png"></div>
                </div>
            </div>
        </div>
    </div>
</div>