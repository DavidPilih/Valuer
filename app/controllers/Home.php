<?php
class Home extends Controller
{
   use Database;
   public function index()
   {
      $this->view('home');
   }
}