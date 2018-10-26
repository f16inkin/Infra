<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 25.10.2018
 * Time: 15:31
 */

namespace application\handbook\controllers;


use application\base\ControllerApplication;
use application\handbook\models\Contact;

class ControllerHandbook extends ControllerApplication
{
    private $_contacts;
    public function __construct()
    {
        parent::__construct();
        $this->_contacts = new Contact();
    }

    public function actionIndex(){
        $this->_view->setTitle('Контакты и Компании');
        $this->_view->render($this->_device.'/handbook/start.page');
    }

    public function actionContacts(){
        $content = $this->_contacts->getContacts();
        $this->_view->setTitle('Контакты и Компании');
        $this->_view->render($this->_device.'/handbook/contacts.page', $content);
    }

    public function actionView($id){
        $content = $this->_contacts->getContact($id);
        include $this->_view->returnPagePath('application', $this->_device.'/handbook/ajax/successed/contact.page');
    }

}