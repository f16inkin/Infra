<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 19.08.2018
 * Time: 15:25
 */

namespace administrator\base;


use core\base\Controller;

class ControllerAdministrator extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->_user->hasPermission('admin_access')){
            $this->_view->setLayout('administrator', $this->_device.'/template');
            $this->_view->setPages('administrator/views/pages/');
        }else{
            header("location: /error/deny");
        }
    }

    public function actionIndex()
    {
        // TODO: Implement actionIndex() method.
    }

}