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
            if ($result){
                $user_id = $this->_db->lastInsertId();
                if(isset($phones)){
                    //Удаляю массивы с пустыми значениями
                    for ($i = 0; $i < count($phones); $i++){
                        $name = preg_replace('/[^а-яА-Я.]/', '', $phones[$i]['name']);
                        $number = preg_replace('/[^0-9.]/', '', $phones[$i]['number']);
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
                    $query = rtrim($query, ',');
                    $result = $this->_db->prepare($query);
                    $result->execute();

                }
            }

        }catch (DatabaseException $e){

        }
    }

}