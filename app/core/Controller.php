<?php

class Controller{

public function view($name, $data = []){
    extract($data);
    $filename = "../app/views/" . $name . ".view.php";
    if(file_exists($filename)) $content = $name;
    else $content = 404;
    require "../app/views/partials/layout.view.php";
}
}