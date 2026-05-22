<?php
class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function split_url()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', $URL);
        return $URL;
    }


    public function loadController()
    {
        $URL = $this->split_url();

        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
        } else {
            require "../app/controllers/_404.php";
            $this->controller= '_404';
        }
        show($this->controller);
        $controller = new $this->controller;
        var_dump($controller);
        var_dump($this->method);
        call_user_func([$controller, $this->method], ['a' => "somevalue"]);

    }

}