<?php
class Home extends Controller{
     public function index() {
         $db = new Database();
         $qeury = "CREATE TABLE IF NOT EXISTS users(
         UserId INT PRIMARY KEY,
         FirstName VARCHAR(50),
         LastName VARCHAR(50),
         Country VARCHAR(50)
         );";

         $db->query($qeury);
         
        echo " this is the home controler";
        $this->view('home');
     }
}

