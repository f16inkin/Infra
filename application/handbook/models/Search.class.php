<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 06.11.2018
 * Time: 13:59
 */

namespace application\handbook\models;


use core\base\Model;
use core\libs\DatabaseException;

class Search extends Model
{
    private $_email;
    private $_phone;

    public function __construct()
    {
        parent::__construct();
        $this->_email = new Email();
        $this->_phone = new Phone();
    }

    public function getContact($value){
        try{
            if (strlen($value) >= 5){
                $query = ("SELECT `contacts`.`id`, `contacts`.`surname`, `contacts`.`firstname`, `contacts`.`secondname`,
                `contacts`.`position`, `contacts`.`foto`, `companies`.`short_name` as `company_name`, 
                `companies`.`id` as `company_id`
                FROM `contacts`
                LEFT JOIN `companies` ON `contacts`.`company` = `companies`.`id`
                WHERE `companies`.`short_name` LIKE '%$value%' OR CONCAT (`contacts`.`surname`,' ', `contacts`.`firstname`) LIKE '%$value%'
                ORDER BY `contacts`.`id` ASC
                
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
                        $contacts[$i]['company_name'] = $row['company_name'];
                        $contacts[$i]['company_id'] = $row['company_id'];
                        $contacts[$i]['email'] = $this->_email->getByContact($row['id'])[0]['email'];
                        $contacts[$i]['phone'] = $this->_phone->getByContact($row['id'])[0]['phone_number'];
                        $i++;
                    }
                    return $contacts;
                }
                return null;
            }
            return null;
        }
        catch (DatabaseException $e){
            echo 'Database error';
        }
    }

    public function getCompany(string $value){
        try{
            if (strlen($value) >= 3){

            }
        }
        catch (DatabaseException $e){
            echo 'Database error';
        }
    }
}