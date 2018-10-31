<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 31.10.2018
 * Time: 14:47
 */

namespace application\handbook\models;


use core\base\Model;
use core\libs\DatabaseException;

class Company extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCompanies(){
        try{
            $query = ("SELECT `companies`.`id`, `companies`.`short_name`, `companies`.`phone`, `companies`.`email`,
            `companies`.`inn`, `companies`.`kpp`, `companies`.`okpo`, `companies`.`oktmo`, `companies`.`ogrn`, 
            `companies`.`ceo`, `companies`.`accountant`, `companies`.`legal_address`, `companies`.`real_address`,
            `companies`.`logo`
            FROM `companies`
            LIMIT 10");
            $result = $this->_db->prepare($query);
            $result->execute();
            if ($result->rowCount() > 0){
                $i = 0;
                while ($row = $result->fetch()){
                    $companies[$i]['id'] = $row['id'];
                    $companies[$i]['short_name'] = $row['short_name'];
                    $companies[$i]['ceo'] = $this->getContact($row['ceo']);
                    $companies[$i]['accountant'] = $this->getContact($row['accountant']);
                    $companies[$i]['logo'] = $row['logo'];
                    $companies[$i]['phone'] = $row['phone'];
                    $companies[$i]['email'] = $row['email'];
                    $i++;
                }
                return $companies;
            }
            return null;
        }
        catch (DatabaseException $e){

        }
    }

    public function getCompany($id){

    }

    private function getContact(int $contact_id){
        try{
            $query = ("SELECT `id`, `surname`, `firstname`, `secondname`, `position` FROM `contacts`
            WHERE `id` = :contact_id");
            $result = $this->_db->prepare($query);
            $result->execute([
                'contact_id' => $contact_id
            ]);
            if ($result->rowCount() > 0){
                while ($row = $result->fetch()){
                    $contact['id'] = $row['id'];
                    $contact['surname'] = $row['surname'];
                    $contact['firstname'] = $row['firstname'];
                    $contact['secondname'] = $row['secondname'];
                    $contact['position'] = $row['position'];
                }
                return $contact;
            }
            return null;
        }
        catch (DatabaseException $e){

        }
    }

}