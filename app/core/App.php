<?php
class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function razdeliUrl()
    {
        $url = $_GET['url'] ?? 'home';
        $url = explode('/', trim($url));
        return $url;
    }

    public function naloziKontroler()
    {
        $url = $this->razdeliUrl();
        $filename = "../app/controllers/" . ucfirst($url[0]) . ".php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($url[0]);
        } else {
            require "../app/controllers/_404.php";
            $this->controller = '_404';
        }
        $controller = new $this->controller;
        if(!empty($url[1]) && method_exists($controller, $url[1])){
            $this->method = $url[1];
        }
        $params = array_slice($url, 2);
        call_user_func([$controller, $this->method], $params);
    }
}