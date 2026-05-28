<?php

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
require 'SetUp.php';

require '../app/models/UporabnikiModel.php';
require '../app/models/CenitveModel.php';
require '../app/models/NamenCenitveModel.php';
require '../app/models/PodlagaVrednostiModel.php';
require '../app/models/PremisaVrednostiModel.php';

$setUp = new SetUp();
try {
    $setUp->query("SELECT 1 FROM uporabniki LIMIT 1");
} catch (Exception $e) {
    $setUp->reset();
}