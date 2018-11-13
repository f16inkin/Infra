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
                <a href="/handbook/management/" class="btn background-darkred btn-sm">
                    <i class="fa fa-cog" aria-hidden="true"></i> Управление</a>
            </div>
            <div class="cards-workplace">
                <div class="cards-nav-bar">
                    <a href="" onclick="loadContacts(); return false;" class="btn btn-success btn-sm">Контакты</a>
                    <a href="" onclick="loadCompanies(); return false;" class="btn btn-success btn-sm">Компании</a>
                </div>
                <div class="cards-content">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="/application/views/layouts/desktop/template/js/handbook.js"></script>