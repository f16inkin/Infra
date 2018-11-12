<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 12.11.2018
 * Time: 14:25
 */

namespace application\handbook\controllers;


use application\base\ControllerApplication;
use application\handbook\models\Company;

class ControllerCompany extends ControllerApplication
{
    private $_company;

    public function __construct()
    {
        parent::__construct();
        $this->_company = new Company();
    }

}