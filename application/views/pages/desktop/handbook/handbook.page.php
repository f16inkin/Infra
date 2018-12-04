<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 04.12.2018
 * Time: 14:50
 */
?>
<div class="container-fluid">
    <div class="row padding-left15">
        <div class="col module-wrapper">
            <div id="handbook-menu">
                <a href="" id="handbook-button" class="btn background-darkred btn-sm" onclick="">
                    <i class="fa fa-address-book" aria-hidden="true"></i> Справочник</a>
                <a href="" id="management-button" class="btn background-darkred btn-sm">
                    <i class="fa fa-cog" aria-hidden="true"></i> Управление</a>
            </div>
            <div id="handbook-content">

            </div>
        </div>
    </div>
</div>


<!-- Modal Посмотреть компанию, контакт-->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content"></div>
    </div>
</div>

<!-- Modal Добавить контакт-->
<div class="modal fade bd-example-modal-lg" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div id="contact-modal-content" class="modal-content">

        </div>
    </div>
</div>
<script src="/application/views/layouts/desktop/template/js/handbook.js"></script>