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
];
