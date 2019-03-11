<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 13.11.2018
 * Time: 10:21
 */

namespace application\handbook\controllers;


use application\base\ControllerApplication;

class ControllerManagement extends ControllerApplication
{
    private $_hasAccessPermission;    //Флаг о том, что у пользователя есть доступ к работе с этим функционалом
    public function __construct()
    {
        parent::__construct();
        $this->_hasAccessPermission = $this->_user->hasPermission('handbook_management');
    }

    private function loadPage(string $page, array $content){
        include $this->_view->returnPagePath('application', $this->_device.$page);
    }

    public function actionIndex()
    {
        /*if ($this->_hasAccessPermission){
            $data[0] = ['id' => 1, 'received' => 100, 'sold' => 1000];
            $data[1] = ['id' => 2, 'received' => 200, 'sold' => 2000];
            $message = ['access' => 'allowed', 'data' => $data];
        }
        else{
            $message = ['access' => 'denied', 'user' => $this->_user->getShortname()];
        }
        echo json_encode($message);*/


        if ($this->_hasAccessPermission){
            $content['title'] = 'Управление';
            $this->loadPage('/handbook/ajax/successed/management.page', $content);
        }else{
            $content['short_name'] = $this->_user->getShortname();
            $content['title'] = 'Доступ закрыт';
            $this->loadPage('/handbook/ajax/successed/access-denied.page', $content);
        }
    }

}