<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 25.10.2018
 * Time: 15:31
 */

namespace application\handbook\controllers;


use application\base\ControllerApplication;

class ControllerHandbook extends ControllerApplication
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionIndex(){
        $this->_view->setTitle('Контакты и Компании');
        $this->_view->render($this->_device.'/handbook/start.page');
    }

}