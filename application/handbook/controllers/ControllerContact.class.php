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

    /**
     * Сохраняет данные контакта в базу данных
     */
    public function actionSave(){
        $surname = isset($_POST['surname']) ? $_POST['surname'] : null;
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
        $secondname = $_POST['secondname'];
        $position = $_POST['position'];
        $company = (empty($_POST['company'])) ? null : $_POST['company'];
        $phone_objects = isset($_POST['phone_objects']) ? $_POST['phone_objects'] : null;
        $email_objects = isset($_POST['email_objects']) ? $_POST['email_objects'] : null;
        /**
         * Получаю ответ от модели, о результате выполнения запроса:
         * added - данные успшно добавлены. Создан новый контакт.
         * notAdded - даннные пок акой либо причине не добавлены. Конатакт не создан.
         * noDataGiven - сообщенре о том, что гнеобхожимые данные не были передаын (Имя и Фамилия на стеущий момент).
         * dbError - ошибка при работе с базой данных. Данные не были вставлены в БД. Контакт не создан
         */
        $result = $this->_contact->insert($surname, $firstname, $secondname, $position, $company, $phone_objects, $email_objects);
        /**
         * Так как нет необходимости в дополнительных сообщения[. Отправляю результат во View,
         * для обработки ответов в JS.
         */
        echo json_encode($result);
    }
}