<?php
    class App{

        private $__controller, $__action, $__params;

        function __construct(){
            global $routes;

            if(!empty($routes['default_controller'])){
                $this -> __controller = $routes['default_controller'];
            }

            if(!empty($routes['default_action'])){
                $this -> __action = $routes['default_action'];
            }
        
            $this -> __params = [];

            $this -> handleUrl();
        }

        function getUrl(){
            if(!empty($_SERVER['PATH_INFO'])){
                $url = $_SERVER['PATH_INFO'];
            }
            else{
                $url = '/';
            }

            return $url;
        }

        public function handleUrl(){
            $url = $this -> getUrl();

            $urlArr = array_filter(explode('/', $url));

            $urlArr = array_values($urlArr);

            if(!empty($urlArr[0])){
                $this -> __controller = ucfirst($urlArr[0]);
            }
            else{
                $this -> __controller = ucfirst($this -> __controller);
            }

            if(file_exists('app/controllers/'.$this ->__controller.'.php')){
                require_once('app/controllers/'.$this ->__controller.'.php');
                if(class_exists($this -> __controller)){
                    $this -> __controller = new $this -> __controller;
                    unset($urlArr[0]);
                }
                else{
                    $this -> loadError('404');
                    return false;
                }
            }
            else{
                $this -> loadError('404');
                return false;
            }

            if(!empty($urlArr[1])){
                if(method_exists($this -> __controller, $urlArr[1])){
                    $this -> __action = $urlArr[1];
                    unset($urlArr[1]);
                }
            }

            $this -> __params = $urlArr;

            

            call_user_func_array([$this -> __controller, $this -> __action], $this -> __params );

        }

        public function loadError($name){
            if(file_exists('app/errors/'.$name.'.php')){
                require_once('app/errors/'.$name.'.php');
            }
        }
    }
?>