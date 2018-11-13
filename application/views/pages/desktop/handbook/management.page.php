<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 06.11.2018
 * Time: 10:03
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
                    <a href="" onclick="addContact(); return false;" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addModalCenter">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить контакт</a>
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCompanyModalCenter">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить компанию</a>
                </div>
                <div class="cards-content">

                </div>
            </div>
        </div>
    </div>
</div>

<script src="/application/views/layouts/desktop/template/js/handbook.js"></script>

<!-- Modal Добавить контакт-->
<div class="modal fade bd-example-modal-lg" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div id="contact-modal-content" class="modal-content">

        </div>
    </div>
</div>
