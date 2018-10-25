<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 09.07.2018
 * Time: 21:37
 */

namespace core\models;


use core\base\Model;
use core\libs\DatabaseException;

class Subdivision extends Model
{
    private $_user_subdivisions;    //Подразделения доступные пользователю
    private $_all_subdivisions;     //Все подразделения доступные в системе
    const GAS_STATION = 1;          //Подразделения АЗС
    const COMMON_SUBDIVISION = 2;   //Подразделения общей группы
    const TANK_FARM = 3;            //Нефтебазы

    /**
     * Subdivision constructor.
     *
     * Создает объект для работы с подразделениями системы
     *
     * @param $user_id
     */
    public function __construct(int $user_id = 0, bool $initAll = false)
    {
        parent::__construct();
        $this->initUserSubdivisions($user_id);
        if ($initAll){
            $this->initAllSubdivisions();
        }
    }

    /**
     * Инициализирует подразделения доступные пользователю
     *
     * @param $user_id
     * @return bool
     */
    private function initUserSubdivisions($user_id){
        try{
            $this->_user_subdivisions = [];
            $query = ("SELECT `subdivisions`.`id`, `subdivisions`.`section`, `subdivisions`.`name` 
                      FROM `user_subdivision`
                      INNER JOIN `subdivisions` ON `subdivisions`.`id` = `user_subdivision`.`subdivision_id`
                      WHERE `user_id` = :user_id");
            $result = $this->_db->prepare($query);
            $result->execute([
                'user_id' => $user_id
            ]);
            if ($result->rowCount() > 0){
                while ($row = $result->fetch()){
                    $this->_user_subdivisions[$row['section']][$row['id']]['id'] = $row['id'];
                    $this->_user_subdivisions[$row['section']][$row['id']]['name'] = $row['name'];
                }
                return true;
            }
            return false;
        }catch (DatabaseException $e){
            echo 'Выброшено исключение: ',  $e->getMessage();
            echo '<br>';
            echo 'Выброшено исключение на строке: ',  $e->getLine();
            echo '<br>';
            echo 'Выброшено исключение в файле: ',  $e->getFile();
        }
    }

    /**
     * Инициализация всех подразделений существующих в системе
     */
    private function initAllSubdivisions(){
        try{
            $query = ("SELECT * FROM `subdivisions`");
            $result = $this->_db->prepare($query);
            $result->execute();
            if ($result->rowCount() > 0){
                while ($row = $result->fetch()){
                    $this->_all_subdivisions[$row['section']][$row['id']]['id'] = $row['id'];
                    $this->_all_subdivisions[$row['section']][$row['id']]['name'] = $row['name'];
                }
            }else{
                return null;
            }


        }catch (DatabaseException $e){
            echo 'Выброшено исключение: ',  $e->getMessage();
            echo '<br>';
            echo 'Выброшено исключение на строке: ',  $e->getLine();
            echo '<br>';
            echo 'Выброшено исключение в файле: ',  $e->getFile();
        }
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getAllUserSubdivisions(){
        return $this->_user_subdivisions;
    }

    /**
     * Getter
     *
     * Возвращает все подразделения которые относятся к секции АЗС (Gas Stations)
     *
     * @return mixed
     */
    public function getUserGasStations(){
        return $this->_user_subdivisions[self::GAS_STATION];
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getUserCommonSubdivisions(){
        return $this->_user_subdivisions[self::COMMON_SUBDIVISION];
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getUserTankFarms(){
        return $this->_user_subdivisions[self::TANK_FARM];
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getAllSubdivisions(){
        return $this->_all_subdivisions;
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getAllGasStations(){
        return $this->_all_subdivisions[self::GAS_STATION];
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getAllCommonSubdivisions(){
        return $this->_all_subdivisions[self::COMMON_SUBDIVISION];
    }

    /**
     * Getter
     *
     * @return mixed
     */
    public function getAllTankFarms(){
        return $this->_all_subdivisions[self::TANK_FARM];
    }

}