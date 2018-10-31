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
    public function __construct()
    {
        parent::__construct();
    }

    public function getContacts(){
        try{
            $query = ("SELECT `contacts`.`id`, `contacts`.`surname`, `contacts`.`firstname`, `contacts`.`secondname`,
            `contacts`.`position`, `contacts`.`foto`, `companies`.`short_name` as `company`, 
            `companies`.`id` as `company_id`
            FROM `contacts`
            LEFT JOIN `companies` ON `contacts`.`company` = `companies`.`id`
            ORDER BY `contacts`.`id` ASC
            LIMIT 10
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
                    $contacts[$i]['email'] = $this->getContactEmails($row['id'])[0]['email'];
                    $contacts[$i]['phone'] = $this->getContactPhones($row['id'])[0]['phone_number'];
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
                    $contact['phones'] = $this->getContactPhones($id);
                    $contact['emails'] = $this->getContactEmails($id);
                }
                return $contact;
            }
            return null;
        }
        catch (DatabaseException $e){
            echo "Troubles with database";
        }
    }

    private function getContactPhones(int $contact_id){
        try{
            $query = ("SELECT * FROM `contact_phones`
                       WHERE `contact` = :contact_id");
            $result = $this->_db->prepare($query);
            $result->execute([
                'contact_id' => $contact_id
            ]);
            if ($result->rowCount() > 0){
                $phones = $result->fetchAll();
                return $phones;
            }
            return null;
        }catch (DatabaseException $e){
            echo "Troubles with database";
        }
    }

    private function getContactEmails(int $contact_id){
        try{
            $query = ("SELECT * FROM `contact_emails`
                       WHERE `contact` = :contact_id");
            $result = $this->_db->prepare($query);
            $result->execute([
                'contact_id' => $contact_id
            ]);
            if ($result->rowCount() > 0){
                $emails = $result->fetchAll();
                return $emails;
            }
            return null;
        }catch (DatabaseException $e){
            echo "Troubles with database";
        }
    }

}