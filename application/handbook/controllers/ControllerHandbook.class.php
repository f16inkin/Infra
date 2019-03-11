<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 25.10.2018
 * Time: 15:31
 */

namespace application\handbook\controllers;


use application\base\ControllerApplication;
use application\handbook\models\Company;
use application\handbook\models\Contact;

class ControllerHandbook extends ControllerApplication
{
    private $_contacts;
    private $_companies;
    public function __construct()
    {
        parent::__construct();
        $this->_contacts = new Contact();
        $this->_companies = new Company();
    }

    public function actionIndex(){
        $this->_view->setTitle('Контакты и Компании');
        $this->_view->render($this->_device.'/handbook/handbook.page');
    }

}