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
            echo "Troubles with database";
        }
    }

    public function getCompany($id){
        try{
            $query = ("SELECT `companies`.`id` AS `company_id`, `companies`.`full_name` , `companies`.`short_name`, `companies`.`phone`,
                      `companies`.`email`, `companies`.`inn`, `companies`.`kpp`, `companies`.`okpo`, `companies`.`oktmo`,
                      `companies`.`ogrn`, `companies`.`ceo`, `companies`.`accountant`, `companies`.`legal_address`,
                      `companies`.`real_address`, `companies`.`bank` AS `bank_id`, `companies`.`logo`, `banks`.`name`
                      AS `bank_name`, `banks`.`address` AS `bank_address`, `banks`.`bik`, `banks`.`checking_account`, 
                      `banks`.`correspondent_account`
                      FROM `companies`
                      LEFT JOIN `banks` ON `companies`.`bank` = `banks`.`id`
                      WHERE `companies`.`id` = :id");
            $result = $this->_db->prepare($query);
            $result->execute([
                'id' => $id
            ]);
            if ($result->rowCount() > 0){
                while ($row = $result->fetch()){
                    $company['id'] = $row['company_id'];
                    $company['full_name'] = $row['full_name'];
                    $company['short_name'] = $row['short_name'];
                    $company['phone'] = $row['phone'];
                    $company['email'] = $row['email'];
                    $company['inn'] = $row['inn'];
                    $company['kpp'] = $row['kpp'];
                    $company['okpo'] = $row['okpo'];
                    $company['oktmo'] = $row['oktmo'];
                    $company['ogrn'] = $row['ogrn'];
                    $company['ceo'] = $this->getContact($row['ceo']);
                    $company['accountant'] = $this->getContact($row['accountant']);
                    $company['real_address'] = $row['real_address'];
                    $company['legal_address'] = $row['legal_address'];
                    $company['logo'] = $row['logo'];
                    $company['bank_name'] = $row['bank_name'];
                    $company['bank_address'] = $row['bank_address'];
                    $company['bik'] = $row['bik'];
                    $company['checking_account'] = $row['checking_account'];
                    $company['correspondent_account'] = $row['correspondent_account'];
                }
                return $company;
            }
            return null;
        }
        catch (DatabaseException $e){
            echo "Troubles with database";
        }
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