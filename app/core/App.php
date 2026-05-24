<?php
class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function split_url()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL));
        return $URL;
    }


    public function loadController()
    {
        $URL = $this->split_url();
        $method = 
        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
        } else {
            require "../app/controllers/_404.php";
            $this->controller= '_404';
        }
        $controller = new $this->controller;
        if(!empty($URL[1]) && method_exists($controller, $URL[1])){
            $this->method =$URL[1];
        }
        call_user_func([$controller, $this->method], [$URL]);

    }

}