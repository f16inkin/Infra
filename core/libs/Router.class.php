<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 09.05.2018
 * Time: 15:57
 */

namespace core\libs;


class Router
{
    private $_routes;           //Маршруты
    private $_matches;
    private $_isConstruct;

    /**
     * Router constructor.
     *
     * Получает сверенные с заданными в конфигурации сегменты, для маршрутизации
     */
    public function __construct()
    {
        $this->_routes = Configurator::getRoutes();
        $this->getSegmentsFromUrl();
    }

    /**
     * Вернет URI, с удаленными с начала и сконца / - слэшами
     *
     * @return string
     */
    private function getUrl()
    {
        return @trim($_SERVER['REQUEST_URI'], '/');
    }

    /**
     * Вернет совпадение маршрутов из файла конфигурации или установит по умолчанию сегменты для стартового контроллера
     *
     * @return array
     */
    private function  getSegmentsFromUrl()
    {
        //Получаю УРЛ
        $url = $this->getUrl();
        //Если не пустой УРЛ
        if ($url){
            //Получаю роуты для всего приложения
            $routing_rules = $this->_routes;
            //Проверяю соответствие правил роутинга, адресу в строке бразуера
                for ($i = 0; $i < count($routing_rules); $i++){
                    $urlPattern = (key($this->_routes[$i]));
                    $path = $this->_routes[$i][$urlPattern];
                    $construct = $this->_routes[$i]['construct'];
                    $isModule = $this->_routes[$i]['module'];
                if (preg_match("~$urlPattern~", $url)) { //"~$uriPattern~" тильда это важно, иначе будет ругаться если поставить / - слэш
                    $internalRoute = preg_replace("~$urlPattern~", $path, $url);
                    //Разбиваю внутренние роуты на сегменты
                    $segments = explode('/', $internalRoute);
                    //Поучаю сегменты сверенные с роутами
                    if ($isModule){
                        $matches['folder_name'] = $segments[0];
                        $matches['module_name'] = $segments[1];
                        $matches['controller'] = $segments[2];
                        $matches['action'] = $segments[3];
                        $matches['parameter1'] = @$segments[4];
                        $matches['parameter2'] = @$segments[5];
                    }else{
                        $matches['folder_name'] = $segments[0];
                        $matches['module_name'] = null;
                        $matches['controller'] = $segments[1];
                        $matches['action'] = $segments[2];
                        $matches['parameter1'] = @$segments[3];
                        $matches['parameter2'] = @$segments[4];
                    }
                    $this->_matches = $matches;
                    $this->_isConstruct = $construct;
                }
            }
        }
        //Иначе, определяю роуты стратового модуля самостоятельно
        else{
            $this->_matches = [
                'folder_name' => 'application',
                'module_name' => 'start',
                'controller' => 'start',
                'action' => 'index'
            ];
            $this->_isConstruct = false;
        }
    }


    /**
     * Вернет сегмент
     *
     * @param $key
     * @return mixed
     */
    private function getMatch($key){
        $matches = $this->_matches;
        return @$matches[$key]; //@ аналог if(!empty) - проверка на пустоту
    }

    /**
     * Вернет имя контроллера или null если файл или класс еще не созданны
     *
     * @return bool|string
     */
    private function getController(){
        $controllerFolder = $this->getMatch('folder_name');
        $controllerModule = $this->getMatch('module_name');
        $controllerName = $this->getMatch('controller');
        if ($controllerModule){
            if(file_exists($controllerFolder.'/'.$controllerModule.'/controllers/Controller'.ucfirst($controllerName).'.class.php')){
                $controller = $controllerFolder.'\\'.$controllerModule.'\controllers\Controller' . ucfirst($controllerName);
                return $controller;
            }
            else {
                return null;
            }
        }else{
            if(file_exists($controllerFolder.'/controllers/Controller'.ucfirst($controllerName).'.class.php')){
                $controller = $controllerFolder.'\controllers\Controller' . ucfirst($controllerName);
                return $controller;
            }
            else {
                return null;
            }
        }
    }

    /**
     * Вернет имя экшена контроллера
     *
     * @return string
     */
    private function getAction(){
        $actionName = $this->getMatch('action');
        $action = 'action'.ucfirst($actionName);
        return $action;
    }

    /**
     * Запуск роутинга, для приложения
     */
    public function Start(){
        $controller = $this->getController();
        $action = $this->getAction();
        $parameter1 = $this->getMatch('parameter1');
        $parameter2 = $this->getMatch('parameter2');
        //Проверю. Если метод вернет не пустой контроллер то создам экзмепляр класса и запущу его
        if ($controller !=null) {
            //Далее решаем, отдавать ли в конструктор первый параметр или нет?
            if ($this->_isConstruct){
                $object = new $controller($parameter1);
                if (method_exists($object, $action)) {
                    $object->$action($parameter2); //Будет всегда два параметра
                }
            }
            else{
                $object = new $controller;
                if (method_exists($object, $action)) {
                    $object->$action($parameter1,$parameter2); //Будет всегда два параметра
                }
            }
        }
        else {
            $controller = 'core\controllers\ControllerError';
            $action = 'actionIndex';
            $object = new $controller;
            $object->$action();
        }
    }
}