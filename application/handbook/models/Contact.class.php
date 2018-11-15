<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 26.10.2018
 * Time: 13:59
 */

namespace application\handbook\models;


use core\base\Model;
use core\libs\DatabaseException;

class Contact extends Model
{
    private $_email;
    private $_phone;

    public function __construct()
    {
        parent::__construct();
        $this->_email = new Email();
        $this->_phone = new Phone();
    }

    /**
     * Вставка телефонов
     *
     * Валидирует входящие значения в соответствие с регулярными выражениями. Собирает все данные в один запрос и разом
     * добавляет их в таблицу
     *
     * @param int $user_id
     * @param array $phones
     */
    private function insertPhones(int $user_id, array $phones){
        //Определяю размер входящего массива: в том числе и пустые значения
        $array_weight = count($phones);
        for ($i = 0; $i < $array_weight; $i++){
            //Валидация по регулярке
            $name = preg_replace('/[^а-яА-Я.]/', '', $phones[$i]['name']);
            $number = preg_replace('/[^0-9.]/', '', $phones[$i]['number']);
            //Так как могут придти пустые значения: нет названия телефона или нет номера, удаляю эти строки из массива
            if ($name == '' or $number == ''){
                unset($phones[$i]);
            }
        }
        //Формирую запросы
        $query = ("INSERT INTO `contact_phones` (`contact`, `phone_number`, `phone_description`) VALUES ");
        foreach ($phones as $phone){
            $query .= sprintf("(%s, %s, '%s'),",
                $user_id,
                $phone['number'],
                $phone['name']
            );
        }
        //Обрезаю запятую в конце строки, чтобы сформировать валидный запрос
        $query = rtrim($query, ',');
        $result = $this->_db->prepare($query);
        //Верну ответ о выполнении true : false
        return $result->execute();
    }

    private function insertEmails(int $user_id, array $emails){
        $array_weight = count($emails);
        for ($i = 0; $i < $array_weight; $i++){
            $name = preg_replace('/[^а-яА-Я.]/', '', $emails[$i]['name']);
            $address = preg_replace('/[^a-zA-Z.]/', '', $emails[$i]['address']);
            if ($name == '' or $address == ''){
                unset($emails[$i]);
            }
        }
        $query = ("INSERT INTO `contact_emails` (`contact`, `email`, `email_description`) VALUES ");
        foreach ($emails as $email){
            $query .= sprintf("(%s, '%s', '%s'),",
                $user_id,
                $email['address'],
                $email['name']
            );
        }
        $query = rtrim($query, ',');
        $result = $this->_db->prepare($query);
        $result->execute();
    }

    public function getContacts(){
        try{
            $query = ("SELECT `contacts`.`id`, `contacts`.`surname`, `contacts`.`firstname`, `contacts`.`secondname`,
            `contacts`.`position`, `contacts`.`foto`, `companies`.`short_name` as `company`, 
            `companies`.`id` as `company_id`
            FROM `contacts`
            LEFT JOIN `companies` ON `contacts`.`company` = `companies`.`id`
            ORDER BY `contacts`.`id` DESC
            LIMIT 5
            ");
            $result = $this->_db->prepare($query);
            $result->execute();
            if ($result->rowCount() > 0){
                $i = 0;
                while ($row = $result->fetch()){
                    $contacts[$i]['id'] = $row['id'];
                    $contacts[$i]['surname'] = $row['surname'];
                    $contacts[$i]['firstname'] = $row['firstname'];
                    $contacts[$i]['secondname'] = $row['secondname'];
                    $contacts[$i]['position'] = $row['position'];
                    $contacts[$i]['foto'] = $row['foto'];
                    $contacts[$i]['company'] = $row['company'];
                    $contacts[$i]['company_id'] = $row['company_id'];
                    $contacts[$i]['email'] = $this->_email->getByContact($row['id'])[0]['email'];
                    $contacts[$i]['phone'] = $this->_phone->getByContact($row['id'])[0]['phone_number'];
                    $i++;
                }
                return $contacts;
            }
            return null;
        }
        catch (DatabaseException $e){
            echo "Troubles with database";
        }
    }

    public function getContact($id){
        try{
            $query = ("SELECT `contacts`.`id`, `contacts`.`surname`, `contacts`.`firstname`, `contacts`.`secondname`,
            `contacts`.`position`, `contacts`.`foto`, `companies`.`short_name` as `company`, 
            `companies`.`id` as `company_id`
            FROM `contacts`
            LEFT JOIN `companies` ON `contacts`.`company` = `companies`.`id`
            WHERE `contacts`.`id` = :id");
            $result = $this->_db->prepare($query);
            $result->execute([
                'id' => $id
            ]);
            if ($result->rowCount() > 0){
                while ($row = $result->fetch()){
                    $contact['id'] = $row['id'];
                    $contact['surname'] = $row['surname'];
                    $contact['firstname'] = $row['firstname'];
                    $contact['secondname'] = $row['secondname'];
                    $contact['position'] = $row['position'];
                    $contact['foto'] = $row['foto'];
                    $contact['company'] = $row['company'];
                    $contact['company_id'] = $row['company_id'];
                    $contact['phones'] = $this->_phone->getByContact($id);
                    $contact['emails'] = $this->_email->getByContact($id);
                }
                return $contact;
            }
            return null;
        }
        catch (DatabaseException $e){
            echo "Troubles with database";
        }
    }

    /**
     * Вставка данных о контакте. Основаня информация, теелфоны, емайл.
     *
     * Три этапа вставки: Вставка основной информации, вставка телефонов если такие есть, вставка адресов электронных
     * почт если такие имеются.
     *
     * @param string $surname
     * @param string $firstname
     * @param string $secondname
     * @param string $position
     * @param int $company
     * @param $phones
     * @param $emails
     */
    public function insert(string $surname, string $firstname, string $secondname, string $position, int $company,
                           $phones, $emails){
        try{
            $query = ("INSERT INTO `contacts` (`surname`, `firstname`, `secondname`, `position`, `company`)
                       VALUES (:surname, :firstname, :secondname, :position, :company)");
            $result = $this->_db->prepare($query);
            $result->execute([
                'surname' => $surname,
                'firstname' => $firstname,
                'secondname' => $secondname,
                'position' => $position,
                'company' => $company
            ]);
            $messages = [];
            if ($result){
                $user_id = $this->_db->lastInsertId();
                if(isset($phones)){
                    if ($this->insertPhones($user_id, $phones)){
                        $messages['success']['in_phones'] = 'Телефон добавлен';
                    }else{
                        $messages['error']['in_phones'] = 'Данные не могут быть вставленны в связанные телефоны';
                    }
                }
                if (isset($emails)){
                    if ($this->insertEmails($user_id, $emails)){
                        $messages['success']['in_emails'] = 'Эелектронная почта добавлена';
                    }else{
                        $messages['error']['in_emails'] = 'Данные не могут быть вставленны в связанные email';
                    }
                }
                $messages['success']['in_contact'] = 'Контакт успешно сохранен';
            }else{
                $messages['error']['in_contact'] = 'Данный контакт не может быть добавлен';
            }
            return $messages;

        }catch (DatabaseException $e){

        }
    }

}