<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 06.11.2018
 * Time: 11:28
 */

namespace application\handbook\controllers;


use application\base\ControllerApplication;
use application\handbook\models\Contact;

class ControllerContact extends ControllerApplication
{
    private $_contact;

    public function __construct()
    {
        parent::__construct();
        $this->_contact = new Contact();
    }

    private function loadPage(string $page, array $content){
        include $this->_view->returnPagePath('application', $this->_device.$page);
    }

    /**
     * Подгрузит AJAX с сформированной карточкой контакта
     *
     * @param int $id
     */
    public function actionContact(int $id){
        $selectedContact = $this->_contact->getContact($id);
        $this->loadPage('/handbook/ajax/successed/contact.page', $selectedContact);
    }

    /*
     * Подргужает AJAX страницу с таблицей контактов. Не рендерит полностью страницу
     */
    public function actionContacts(){
        $content = $this->_contact->getContacts();
        $this->loadPage('/handbook/ajax/successed/contacts.page', $content);
    }
}