<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 10.07.2018
 * Time: 19:04
 */

namespace core\libs;


use core\base\Model;
use core\models\Subdivision;

class AccessChecker extends Model
{
    private $_subdivisions;   //Подразделения

    /**
     * AccessChecker constructor.
     *
     * Выбирает все доступные пользователю подразделения в массив
     *
     * @param $user_id
     */
    public function __construct($user_id)
    {
        parent::__construct();
        $this->_subdivisions = (new Subdivision($user_id))->getAllUserSubdivisions();
    }

    /**
     * Проверяет доступ к конкретной АЗС по ее id
     *
     * @param $station
     * @return bool
     */
    public function hasAccessToStation($station){
        return array_key_exists($station, $this->_subdivisions[1]);
    }

    /**
     * Проверяте доступ к любому подразделению из имеющихся в системе по его id
     *
     * @param int $subdivision
     * @return bool
     */
    public function hasAccessToSubdivision(int $subdivision){
        //проверяет доступ ко всем подразделениям
        foreach ($this->_subdivisions as $section){
            if (array_key_exists($subdivision, $section)){
                return true;
            };
        }
    }

    /**
     * Проверка прав доступа к подразделению по его id в секции с заданным id
     * Секции: 1 - АЗС, 2 - Общая, 3 - Нефтебазы
     *
     * @param int $subdivision
     * @param int $section
     * @return bool
     */
    public function hasAccessFromSection(int $subdivision, int $section){
        return array_key_exists($subdivision, $this->_subdivisions[$section]);
    }

    /**
     * Оповещение о закрытом доступе
     */
    public function accessDenied(){
        echo 'Метод accessDenied класса AccessChecker: Доступ закрыт';
    }

    public static function systemOffline(){
        echo 'Система приостановленна для технических работ';
        exit();
    }

}