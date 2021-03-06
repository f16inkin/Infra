<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 09.05.2018
 * Time: 13:06
 */
define('ROOT', dirname(__FILE__)); //Константа корневая директория
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
date_default_timezone_set('Asia/Vladivostok');
use core\libs\Router;
//autoload #1
function __autoload($className)
{
    try {
        $fileName = str_replace('\\', '/', $className) . '.class.php';
        if (!file_exists($fileName)) {
            throw new Exception('Class not found!'.$className);
        }
        require_once $fileName;
    }
    catch (Exception $e){
        echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
    }
}
$router = new Router();
$router->Start();