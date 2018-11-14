<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 09.05.2018
 * Time: 15:59
 */
return[
    /*----------------------------------------Система-------------------------------------------------*/
    /*#####################################################################################################*/
    //Работа системы приостановлена
    [
        'error/offline'  => 'core/error/offline',
        'construct'     =>  false,
        'module' => false
    ],
    //Ошибка доступа
    [
        'error/deny'  => 'core/error/deny',
        'construct'     =>  false,
        'module' => false
    ],
    //Авторизация
    [
        '^login$'       =>  'core/login/login',
        'construct'     =>  false,
        'module' => false
    ],
    [
        '^logout$' => 'core/login/logout',
        'construct' => false,
        'module' => false
    ],
    /*----------------------------------------Админ панель-------------------------------------------------*/
    /*#####################################################################################################*/
    //Главная страница административной части
    [
        '^admin$' => 'administrator/start/start/index',
        'construct' => false,
        'module' => true
    ],
    /*----------------------------------------Приложение---------------------------------------------------*/
    /*#####################################################################################################*/
    //Главная страница
    [
        '^start$' => 'application/start/start/index',
        'construct' => false,
        'module' => true
    ],
    [
        '^start/view$' => 'application/start/start/view/$1',
        'construct' => false,
        'module' => true
    ],
    //Справочник контактов и компаний
    [
        '^handbook$' => 'application/handbook/handbook/index',
        'construct' => false,
        'module' => true
    ],
    //Панель управления и настройки из приложения
    [
        '^handbook/management$' => 'application/handbook/management/index',
        'construct' => false,
        'module' => true
    ],
    //Контакты
    [
        '^handbook/contacts$' => 'application/handbook/handbook/contacts',
        'construct' => false,
        'module' => true
    ],
    //Компании
    [
        '^handbook/companies$' => 'application/handbook/handbook/companies',
        'construct' => false,
        'module' => true
    ],
    //Для AJAX
    [
        '^handbook/get/contacts$' => 'application/handbook/contact/contacts',
        'construct' => false,
        'module' => true
    ],
    [
        '^handbook/get/companies$' => 'application/handbook/company/companies',
        'construct' => false,
        'module' => true
    ],
    [
        '^handbook/contact/view/([0-9a-z]+)$' => 'application/handbook/contact/contact/$1',
        'construct' => false,
        'module' => true
    ],
    [
        '^handbook/company/view/([0-9a-z]+)$' => 'application/handbook/company/company/$1',
        'construct' => false,
        'module' => true
    ],
    [
        '^handbook/contact/save$' => 'application/handbook/contact/save',
        'construct' => false,
        'module' => true
    ],
    //Поиск контактов
    [
        '^handbook/search/contact$' => 'application/handbook/search/contact/',
        'construct' => false,
        'module' => true
    ],
];
