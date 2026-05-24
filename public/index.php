<?php
session_start();
require "../app/core/init.php";
// $setup = new SetUp;
// $setup->reset();
$app =new App;
$app->loadController();
