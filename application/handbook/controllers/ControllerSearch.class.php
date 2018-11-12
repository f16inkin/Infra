<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 06.11.2018
 * Time: 11:55
 */

namespace application\handbook\controllers;


use application\handbook\models\Search;
use core\base\Controller;

class ControllerSearch extends Controller
{
    private $_search;
    
    public function __construct()
    {
        parent::__construct();
        $this->_search = new Search();
    }

    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
    }

    public function actionContact(){
        $search_value = $_POST['search'];
        $contacts = $this->_search->getContact($search_value);
        if (isset($contacts)){
            echo json_encode($contacts);
        }
    }

    public function actionCompany(){
        //Поиск компании при вводе значения в поле поиска
    }

}