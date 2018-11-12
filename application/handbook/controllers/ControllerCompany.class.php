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

    private function loadPage(string $page, array $content){
        include $this->_view->returnPagePath('application', $this->_device.$page);
    }

    public function actionCompany(int $id){
        $selectedCompany = $this->_company->getCompany($id);
        $this->loadPage('/handbook/ajax/successed/company.page', $selectedCompany);
    }

    public function actionCompanies(){
        $content = $this->_company->getCompanies();
        $this->loadPage('/handbook/ajax/successed/companies.page', $content);
    }

}