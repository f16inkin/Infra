<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 12.11.2018
 * Time: 13:58
 */

namespace application\handbook\models;


use core\base\Model;
use core\libs\DatabaseException;

class Email extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getByContact(int $contact_id){
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