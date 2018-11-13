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

    private function accessDenied(){
        $content['short_name'] = $this->_user->getShortname();
        $this->_view->setTitle('Закрыт доступ');
        $this->_view->render($this->_device.'/handbook/access-denied.page', $content);
    }

    public function actionIndex()
    {
        if ($this->_hasAccessPermission){
            $this->_view->setTitle('Справочник. Управление');
            $this->_view->render($this->_device.'/handbook/management.page');
        }else{
            $this->accessDenied();
        }
    }


}